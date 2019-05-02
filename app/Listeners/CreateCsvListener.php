<?php

namespace App\Listeners;

use App\Events\CreateCsvEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCsvListener
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
     * @param  CreateCsvEvent  $event
     * @return void
     */
    public function handle(CreateCsvEvent $event)
    {
        $this->generateCsv($event->fileName, $event->csvDataQuery);
    }

    private function generateCsv($fileName, $csvDataQuery)
    {
        $csvData = $csvDataQuery
            ->orderByDesc('id')
            ->get()
            ->toArray();

        $csvFilePath = storage_path() . "/{$fileName}.csv";
        $csvFile = fopen($csvFilePath, 'w');

        fputcsv($csvFile, ['Age', 'Sex', 'Ethnicity', 'Health Status']);

        foreach ($csvData as $data) {
            // cast the object into an array
            $dataArray = (array) $data;
            $dataArray = array_values($dataArray);
            fputcsv($csvFile, $dataArray);
        }

        fclose($csvFile);
    }
}
