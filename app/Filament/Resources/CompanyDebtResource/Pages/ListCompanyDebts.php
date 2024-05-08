<?php

namespace App\Filament\Resources\CompanyDebtResource\Pages;

use App\Filament\Resources\CompanyDebtResource;
use App\Imports\CompanyDebtImport;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use EightyNine\ExcelImport\ExcelImportAction;

class ListCompanyDebts extends ListRecords
{
    protected static string $resource = CompanyDebtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
            ->color("secondary")
            ->use(CompanyDebtImport::class),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                ])->color("secondary"),
            Actions\CreateAction::make(),
        ];
    }
}
