<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyDebtResource\Pages;
use App\Filament\Resources\CompanyDebtResource\RelationManagers;
use App\Models\CompanyDebt;
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

class CompanyDebtResource extends Resource
{
    protected static ?string $model = CompanyDebt::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 4;

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

                Forms\Components\Select::make('company_debt_category_id')
                ->relationship('company_debt_category', 'name') //! The name of relationship MUST same as relation and FOREIGN KEY
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
                ->directory('company_debt_evidence')
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
                Tables\Columns\TextColumn::make('company_debt_category.name')
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
            'index' => Pages\ListCompanyDebts::route('/'),
            'create' => Pages\CreateCompanyDebt::route('/create'),
            'edit' => Pages\EditCompanyDebt::route('/{record}/edit'),
        ];
    }
}
