<?php

namespace App\Imports;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class IncomeImport implements ToCollection, WithBatchInserts, WithChunkReading
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
            $ItemCategory = IncomeCategory::firstOrCreate(
                ['name' => $item[1]],
            );

            Income::create([
                'name' => $item[0],
                'income_category_id' => $ItemCategory->id,
                'price' => $item[2],
                'created_by_id' => auth()->user()->id,
                'updated_by_id' => auth()->user()->id,
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
