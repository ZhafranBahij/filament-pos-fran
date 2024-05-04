<?php

namespace App\Filament\Resources\CustomerDebtResource\Pages;

use App\Filament\Resources\CustomerDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerDebt extends CreateRecord
{
    protected static string $resource = CustomerDebtResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by_id'] = auth()->id();
        $data['updated_by_id'] = auth()->id();

        return $data;
    }
}
