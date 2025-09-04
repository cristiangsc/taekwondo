<?php

namespace App\Filament\Deportista\Resources\EquipmentResource\Pages;

use App\Filament\Deportista\Resources\EquipmentResource;
use Filament\Resources\Pages\ListRecords;

class ListEquipment extends ListRecords
{
    protected static string $resource = EquipmentResource::class;
    protected static ?string $title = 'Listado de equipamiento del Club';


    protected function getHeaderWidgets(): array
    {
        return [
            EquipmentResource\Widgets\EquipmentOverview::class,
        ];
    }
}
