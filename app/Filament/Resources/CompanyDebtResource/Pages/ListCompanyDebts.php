<?php

namespace App\Filament\Resources\CompanyDebtResource\Pages;

use App\Filament\Resources\CompanyDebtResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyDebts extends ListRecords
{
    protected static string $resource = CompanyDebtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
