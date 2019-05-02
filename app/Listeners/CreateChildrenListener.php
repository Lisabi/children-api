<?php

namespace App\Listeners;

use App\Events\CreateChildrenEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class CreateChildrenListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateChildrenEvent  $event
     * @return void
     */
    public function handle()
    {
        $this->generateDataset();
    }

    private function generateDataset()
    {
        $age = range(1, 15);
        $sex = ['Male', 'Female'];
        $ethnicity = ['Asian', 'Igbo', 'Yoruba', 'Efik', 'Ibibio'];
        $health_status = ['Healthy', 'Unhealthy'];

        $dataCreate = [];
        $recordLength = 2000000;
        $bufferLength = 1000;

        while ($recordLength > 0) {
            for ($i = 0; $i < $bufferLength; $i++) {
                $childSex = $this->generateChildProperty($sex);
                $childAge = $this->generateChildProperty($age);
                $childEthnicity = $this->generateChildProperty($ethnicity);
                $childHeatlhStatus = $this->generateChildProperty(
                    $health_status
                );

                $dataCreate[] = [
                    'id' => Uuid::uuid4(),
                    'sex' => $childSex,
                    'age' => $childAge,
                    'ethnicity' => $childEthnicity,
                    'health_status' => $childHeatlhStatus
                ];
            }

            DB::table('children')->insert($dataCreate);
            $dataCreate = [];
            $recordLength -= $bufferLength;
        }

        return true;
    }

    private function generateChildProperty($propertyList)
    {
        $index = random_int(0, count($propertyList) - 1);
        return $propertyList[$index];
    }
}
