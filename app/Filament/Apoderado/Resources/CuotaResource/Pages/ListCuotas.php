<?php

namespace App\Filament\Apoderado\Resources\CuotaResource\Pages;

use App\Filament\Apoderado\Resources\CuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuotas extends ListRecords
{
    protected static string $resource = CuotaResource::class;
    protected static ?string $title = 'Cuotas del Club';

}
