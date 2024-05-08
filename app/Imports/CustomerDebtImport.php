<?php

namespace App\Imports;

use App\Models\CustomerDebt;
use App\Models\CustomerDebtCategory;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerDebtImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow
{
    public function model(array $row)
    {

        $category = CustomerDebtCategory::firstOrCreate(
            ['name' => $row['customer_debt_category']],
        );

        $debtor = User::firstOrCreate([
            'name' => $row['debtor_name'],
            'email' => $row['debtor_email'],
        ]);

        $creditor = User::firstOrCreate([
            'name' => $row['creditor_name'],
            'email' => $row['creditor_email'],
        ]);

        CustomerDebt::create([
            'name' => $row['name'],
            'status' => $row['status'],
            'customer_debt_category_id' => $category->id,
            'debtor_id' => $debtor->id,
            'creditor_id' => $creditor->id,
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
