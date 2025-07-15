<?php

namespace App\Filament\Resources\CuotaResource\Pages;

use App\Filament\Resources\CuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuotas extends ListRecords
{
    protected static string $resource = CuotaResource::class;
    protected static ?string $title = 'Listado de Cuotas Pagadas Club Taekwondo';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar Cuota')
            ->modalHeading('Registrar Cuota'),
        ];
    }
}
