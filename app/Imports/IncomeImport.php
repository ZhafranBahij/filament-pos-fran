<?php

namespace App\Imports;

use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IncomeImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        $category = IncomeCategory::firstOrCreate(
            ['name' => $row['income_category']],
        );

        Income::create([
            'name' => $row['name'],
            'income_category_id' => $category->id,
            'price' => $row['price'],
            'created_by_id' => auth()->user()->id,
            'updated_by_id' => auth()->user()->id,
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
