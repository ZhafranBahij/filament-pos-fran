<?php

namespace App\Filament\Resources\CustomerDebtResource\Pages;

use App\Filament\Resources\CustomerDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerDebt extends EditRecord
{
    protected static string $resource = CustomerDebtResource::class;

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
