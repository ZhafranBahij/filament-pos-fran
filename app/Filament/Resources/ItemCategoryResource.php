<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemCategoryResource\Pages;
use App\Filament\Resources\ItemCategoryResource\RelationManagers;
use App\Models\ItemCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ItemCategoryResource extends Resource
{
    protected static ?string $model = ItemCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Product';

    protected static ?string $navigationParentItem = 'Items';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemCategories::route('/'),
            'create' => Pages\CreateItemCategory::route('/create'),
            'edit' => Pages\EditItemCategory::route('/{record}/edit'),
        ];
    }
}
