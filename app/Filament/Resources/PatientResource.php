<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // Normal Input
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                // Selected Input
                Forms\Components\Select::make('type')
                ->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'rabbit' => 'Rabbit',
                    'chicken' => 'Chicken',
                    'duck' => 'Duck',
                    'iguana' => 'Iguana',
                ])
                ->required(),

                // Date Input
                Forms\Components\DatePicker::make('date_of_birth')
                ->required()
                ->maxDate(now()),

                // Data Relation Input
                Forms\Components\Select::make('owner_id')
                ->relationship('owner', 'name')
                ->searchable() // with search version
                ->preload()
                // Display Modal to Create Another Data
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email address') // For Override old label
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('Phone number')
                        ->tel()
                        ->required(),
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), // Column can be searched (this feature same as search in datatable jquery)
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->searchable(), // Column can be searched (this feature same as search in datatable jquery)

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'rabbit' => 'Rabbit',
                    'chicken' => 'Chicken',
                    'duck' => 'Duck',
                    'iguana' => 'Iguana',
                ]),
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
            RelationManagers\TreatmentsRelationManager::class, // The table will display in Patient Show
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
