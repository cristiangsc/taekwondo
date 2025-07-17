<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Models\Income;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Club';
    protected static ?string $navigationLabel = 'Ingresos';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('monto_ingreso')
                    ->label('Monto Ingreso')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('income_type_id')
                    ->relationship('income_type', 'name')
                    ->required(),
                Forms\Components\TextInput::make('anio')
                    ->label('Año')
                    ->default(date('Y'))
                    ->required(),
                Forms\Components\DatePicker::make('fecha')
                    ->label('Fecha')
                    ->default(date('Y-m-d'))
                    ->required(),
                Forms\Components\Textarea::make('observacion')
                    ->label('Observaciones')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('monto_ingreso')
                    ->label('Monto Ingreso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('income_type.name')
                    ->label('Tipo de Ingreso')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año'),
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
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
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label('')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

}

public
static function getPages(): array
{
    return [
        'index' => Pages\ListIncomes::route('/'),
      //  'create' => Pages\CreateIncome::route('/create'),
      //  'edit' => Pages\EditIncome::route('/{record}/edit'),
    ];
}
}
