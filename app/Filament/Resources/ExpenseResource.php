<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;

use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Gastos';
    protected static ?string $navigationGroup = 'Club';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('monto_gasto')
                    ->label('Monto Gasto')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('expense_type_id')
                    ->relationship('expense_type', 'name')
                    ->label('Tipo de Gasto')
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
                Tables\Columns\TextColumn::make('monto_gasto')
                    ->label('Monto Gasto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expense_type.name')
                    ->label('Tipo de Gasto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año')
                    ->sortable(),
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
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
          //  'create' => Pages\CreateExpense::route('/create'),
          //  'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
