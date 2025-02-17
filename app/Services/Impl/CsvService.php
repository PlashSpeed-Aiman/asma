<?php

namespace App\Services\Impl;

use App\Models\Asset;
use App\Services\ICsvService;

class CsvService implements ICsvService{

    public function parseToArray(array $csv): array
    {
        /** @var array<array<string>> $assets */

        $assets = [];
        $csvData = array_map('str_getcsv', $csv);
        array_shift($csvData); // Remove header row

        foreach($csvData as $row) {
            $asset = new Asset();
            $asset->name = $row[0];
            $asset->asset_number = $row[1];
            $asset->description = $row[2];
            $assets[] = $asset;
        }
        return $assets;
    }
}

