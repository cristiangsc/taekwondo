<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewEquipment extends ViewRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Información General')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nombre'),
                        Infolists\Components\TextEntry::make('code')
                            ->label('Código'),
                        Infolists\Components\TextEntry::make('category.name')
                            ->label('Categoría')
                            ->badge(),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Descripción'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Detalles del Producto')
                    ->schema([
                        Infolists\Components\TextEntry::make('size')
                            ->label('Talla/Tamaño'),
                        Infolists\Components\TextEntry::make('color')
                            ->label('Color'),
                        Infolists\Components\TextEntry::make('brand')
                            ->label('Marca'),
                        Infolists\Components\TextEntry::make('condition')
                            ->label('Condición')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'excelente' => 'success',
                                'bueno' => 'primary',
                                'regular' => 'warning',
                                'malo' => 'danger',
                                default => 'secondary'
                            }),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'disponible' => 'success',
                                'prestado' => 'warning',
                                'en_mantenimiento' => 'info',
                                'perdido' => 'danger',
                                'dañado' => 'danger',
                                default => 'secondary'
                            }),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Información de Compra')
                    ->schema([
                        Infolists\Components\TextEntry::make('purchase_price')
                            ->label('Precio de Compra')
                            ->money('USD'),
                        Infolists\Components\TextEntry::make('purchase_date')
                            ->label('Fecha de Compra')
                            ->date(),
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
