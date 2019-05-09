<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $age = range(1, 15);
        $sex = ['Male', 'Female'];
        $ethnicity = ['Asian', 'Igbo', 'Yoruba', 'Efik', 'Ibibio'];
        $health_status = ['Healthy', 'Unhealthy'];
        return view(
            'welcome',
            compact('age', 'sex', 'ethnicity', 'health_status')
        );
    }
}
