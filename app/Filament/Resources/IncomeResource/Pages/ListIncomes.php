<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use App\Imports\IncomeImport;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
            ->color("primary")
            ->use(IncomeImport::class),
            Actions\CreateAction::make(),
        ];
    }
}
