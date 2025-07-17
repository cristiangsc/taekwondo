<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEquipment extends ListRecords
{
    protected static string $resource = EquipmentResource::class;
    protected static ?string $title = 'Listado de equipamiento del Club';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Registrar Equipamiento'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EquipmentResource\Widgets\EquipmentOverview::class,
        ];
    }
}
