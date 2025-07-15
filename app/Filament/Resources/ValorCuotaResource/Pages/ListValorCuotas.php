<?php

namespace App\Filament\Resources\ValorCuotaResource\Pages;

use App\Filament\Resources\ValorCuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValorCuotas extends ListRecords
{
    protected static string $resource = ValorCuotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar Valor Cuota')
            ->modalHeading('Registrar Valor Cuota')
        ];
    }
}
