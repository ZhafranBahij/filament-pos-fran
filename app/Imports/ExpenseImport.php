<?php

namespace App\Imports;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExpenseImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{

    public function model(Array $row)
    {

        $category = ExpenseCategory::firstOrCreate(
            ['name' => $row['expense_category']],
        );

        Expense::create([
            'name' => $row['name'],
            'expense_category_id' => $category->id,
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
