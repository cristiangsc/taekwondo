<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeTypeResource\Pages;
use App\Models\IncomeType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class IncomeTypeResource extends Resource
{
    protected static ?string $model = IncomeType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Club';
    protected static ?string $navigationLabel = 'Tipos de Ingresos';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tipo de Ingreso')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tipo de Ingreso')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('')
                ->modalHeading('Editar Tipo de Ingreso'),
                Tables\Actions\DeleteAction::make()
                ->label('')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncomeTypes::route('/'),
         //   'create' => Pages\CreateIncomeType::route('/create'),
         //   'edit' => Pages\EditIncomeType::route('/{record}/edit'),
        ];
    }
}
