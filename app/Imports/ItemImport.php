<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Tax;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ItemImport implements ToCollection, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $item)
        {
            if ($item[0] == null || $item[0] == 'Name') {
                continue;
            }
            $ItemCategory = ItemCategory::firstOrCreate(
                ['name' => $item[1]],
            );

            $Tax = Tax::firstOrCreate(
                ['name' => $item[2]],
                ['percentange' => 10],
            );

            Item::create([
                'name' => $item[0],
                'item_category_id' => $ItemCategory->id,
                'tax_id' => $Tax->id,
                'stock' => $item[3],
                'price' => $item[4],
            ]);
        }
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
