<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerDebtResource\Pages;
use App\Filament\Resources\CustomerDebtResource\RelationManagers;
use App\Models\CustomerDebt;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CustomerDebtResource extends Resource
{
    protected static ?string $model = CustomerDebt::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                RichEditor::make('description'),

                Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('Rp')
                ->required(),

                Forms\Components\Select::make('customer_debt_category_id')
                ->relationship('customer_debt_category', 'name') //! The name of relationship MUST same as relation and FOREIGN KEY
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),

                Forms\Components\Select::make('debtor_id')
                ->relationship('debtor', 'name') //! The name of relationship MUST same as relation and FOREIGN KEY
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),

                Forms\Components\Select::make('creditor_id')
                ->relationship('creditor', 'name') //! The name of relationship MUST same as relation and FOREIGN KEY
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),

                Forms\Components\DatePicker::make('deadline')
                ->required(),

                // Selected Input
                Forms\Components\Select::make('status')
                ->options([
                    'unpaid' => 'unpaid',
                    'paid' => 'paid',
                ])
                ->required(),

                FileUpload::make('attachment')
                ->directory('customer_debt_evidence')
                ->image()
                ->imageEditor()
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_debt_category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('debtor.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('creditor.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable(),
                ImageColumn::make('attachment'),
                Tables\Columns\TextColumn::make('created_by.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListCustomerDebts::route('/'),
            'create' => Pages\CreateCustomerDebt::route('/create'),
            'edit' => Pages\EditCustomerDebt::route('/{record}/edit'),
        ];
    }
}
