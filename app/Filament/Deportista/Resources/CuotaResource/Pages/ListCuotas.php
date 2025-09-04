<?php

namespace App\Filament\Deportista\Resources\CuotaResource\Pages;

use App\Filament\Deportista\Resources\CuotaResource;
use Filament\Resources\Pages\ListRecords;

class ListCuotas extends ListRecords
{
    protected static string $resource = CuotaResource::class;
    protected static ?string $title = 'Cuotas del Club';

}
