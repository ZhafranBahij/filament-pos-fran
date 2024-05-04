<?php

namespace App\Filament\Resources\CustomerDebtResource\Pages;

use App\Filament\Resources\CustomerDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerDebts extends ListRecords
{
    protected static string $resource = CustomerDebtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
