<?php

namespace App\Filament\Deportista\Resources;

use App\Filament\Deportista\Resources\EquipmentResource\Pages;
use App\Models\Equipment;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Equipamiento';
    protected static ?string $modelLabel = 'Equipo';
    protected static ?string $pluralModelLabel = 'Equipos';
    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('size')
                    ->label('Talla')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('color')
                    ->label('Color')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('condition')
                    ->label('Condición')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'excelente' => 'Excelente',
                        'bueno' => 'Bueno',
                        'regular' => 'Regular',
                        'malo' => 'Malo',
                        default => $state
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'excelente' => 'success',
                        'bueno' => 'primary',
                        'regular' => 'warning',
                        'malo' => 'danger',
                        default => 'secondary'
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'disponible' => 'Disponible',
                        'prestado' => 'Prestado',
                        'en_mantenimiento' => 'En Mantenimiento',
                        'perdido' => 'Perdido',
                        'dañado' => 'Dañado',
                        default => $state
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'disponible' => 'success',
                        'prestado' => 'warning',
                        'en_mantenimiento' => 'info',
                        'perdido' => 'danger',
                        'dañado' => 'present',
                        default => 'secondary'
                    })
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'disponible' => 'Disponible',
                        'prestado' => 'Prestado',
                        'en_mantenimiento' => 'En Mantenimiento',
                        'perdido' => 'Perdido',
                        'dañado' => 'Dañado',
                    ]),
                Tables\Filters\SelectFilter::make('condition')
                    ->label('Condición')
                    ->options([
                        'excelente' => 'Excelente',
                        'bueno' => 'Bueno',
                        'regular' => 'Regular',
                        'malo' => 'Malo',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquipment::route('/'),
            'view' => Pages\ViewEquipment::route('/{record}'),
        ];
    }
}
