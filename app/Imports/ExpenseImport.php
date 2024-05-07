<?php

namespace App\Imports;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ExpenseImport implements ToCollection, WithBatchInserts, WithChunkReading
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
            $ItemCategory = ExpenseCategory::firstOrCreate(
                ['name' => $item[1]],
            );

            Expense::create([
                'name' => $item[0],
                'expense_category_id' => $ItemCategory->id,
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
