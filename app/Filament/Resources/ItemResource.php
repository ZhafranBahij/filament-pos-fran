<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('stock')
                ->numeric()
                ->required(),

                Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('Rp')
                ->required(),

                Forms\Components\Select::make('item_category_id')
                ->relationship('item_category', 'name') //! The name of relationship MUST same as relation and FOREIGN KEY
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('item_category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
