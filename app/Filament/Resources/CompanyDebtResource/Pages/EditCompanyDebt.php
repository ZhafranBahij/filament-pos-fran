<?php

namespace App\Filament\Resources\CompanyDebtResource\Pages;

use App\Filament\Resources\CompanyDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyDebt extends EditRecord
{
    protected static string $resource = CompanyDebtResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by_id'] = auth()->id();

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
