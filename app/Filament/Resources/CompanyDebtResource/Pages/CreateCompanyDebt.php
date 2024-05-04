<?php

namespace App\Filament\Resources\CompanyDebtResource\Pages;

use App\Filament\Resources\CompanyDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyDebt extends CreateRecord
{
    protected static string $resource = CompanyDebtResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by_id'] = auth()->id();
        $data['updated_by_id'] = auth()->id();

        return $data;
    }
}
