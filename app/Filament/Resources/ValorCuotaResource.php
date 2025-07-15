<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValorCuotaResource\Pages;
use App\Filament\Resources\ValorCuotaResource\RelationManagers;
use App\Models\ValorCuota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ValorCuotaResource extends Resource
{
    protected static ?string $model = ValorCuota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Club';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('valor_cuota')
                    ->label('Valor Cuota')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('anio_cuota')
                    ->label('Año de la Cuota')
                    ->numeric()
                    ->maxLength(4)
                    ->default(date('Y'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('valor_cuota')
                    ->label('Valor Cuota')
                    ->prefix('$ ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anio_cuota')
                    ->label('Año de la Cuota')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('')
                ->modalHeading('Editar Valor Cuota')
                    ->modalWidth('lg'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->modalHeading('Está Eliminando el registro del Valor Cuota'),
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
            'index' => Pages\ListValorCuotas::route('/'),
//            'create' => Pages\CreateValorCuota::route('/create'),
//            'edit' => Pages\EditValorCuota::route('/{record}/edit'),
        ];
    }
}
