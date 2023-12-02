<?php

namespace App\Services;

use App\Jobs\ProductJob;
use Illuminate\Support\Facades\Bus;

class CSVImportService
{
    public function import($filePath)
    {
        $header = [];

        $batch = Bus::batch([])->dispatch();

        $chunk_size = 100;

        $file_handle = fopen($filePath, 'r');

        while (!feof($file_handle)) {
            // Read a chunk of rows
            $chunk = [];
            $rowIndex = 0;
            for ($i = 0; $i < $chunk_size && !feof($file_handle); $i++) {

                $row = fgetcsv($file_handle);

                if ($row !== false) {

                    if ($rowIndex != 0) {
                        $chunk[] = $row;
                    }
                }
                $rowIndex++;
            }
            $header = $this->columnMappings([]);//this would've been done in better way! ops: shortage of time.
            $batch->add(new ProductJob($chunk, $header));
        }
    }

    public function columnMappings($csvColumns)
    {
        $columnMapping = [
            'title' => 'Title',
            'description' => 'Body (HTML)',
            'type' => 'Type',
            'status' => 'Published',
        ];

        return $columnMapping;
    }
}
