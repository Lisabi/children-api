<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\CreateChildrenEvent;
use App\Events\CreateCsvEvent;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function generateDataset(Request $r)
    {
        $recordsLength = DB::table('children')->count();
        //

        if ($recordsLength >= 2000000) {
            return response()->json(
                [
                    'status' => "success",
                    'message' => "Records created"
                ],
                201
            );
        }
        if ($recordsLength > 0) {
            return response()->json(
                [
                    'status' => "pending",
                    'message' => "Records is still being generated"
                ],
                202
            );
        }

        //Fire background event when no record is present
        event(CreateChildrenEvent::class);
        return response()->json(
            [
                'status' => "working",
                'message' => "Creating records..."
            ],
            202
        );
    }

    public function findChild(Request $r)
    {
        $query = DB::table('children')->select(
            'age',
            'sex',
            'ethnicity',
            'health_status'
        );

        if ($r->has('sex')) {
            $query->where('sex', $r->sex);
        }

        if ($r->has('age')) {
            $query->where('age', $r->age);
        }

        if ($r->has('health_status')) {
            $query->where('health_status', $r->health_status);
        }

        if ($r->has('ethnicity')) {
            $query->where('ethnicity', $r->ethnicity);
        }

        $csvFilename = $this->generateCsvFilename();
        event(new CreateCsvEvent($csvFilename, $query));

        $results = $query->orderByDesc('id')->paginate(20);
        return response()->json($results, 200);
        // return view('children')->with(compact('results'));
    }

    public function generateCsvFilename()
    {
        $url = route('filter.children');
        $l = $_GET;
        unset($l['page']);

        $f = implode('', $l);
        $fileName = md5($url . $f);

        return md5($fileName);
    }
}
