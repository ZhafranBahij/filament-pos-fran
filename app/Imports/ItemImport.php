<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Tax;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        $ItemCategory = ItemCategory::firstOrCreate(
            ['name' => $row['item_category']],
        );

        $Tax = Tax::firstOrCreate(
            ['name' => $row['tax_name']],
            ['percentange' => 10],
        );

        Item::updateOrCreate([
            'name' => $row['name'],
        ],
        [
            'item_category_id' => $ItemCategory->id,
            'tax_id' => $Tax->id,
            'stock' => $row['stock'],
            'price' => $row['price'],
        ]);

    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
