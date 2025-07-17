<?php

namespace App\Filament\Resources\IncomeTypeResource\Pages;

use App\Filament\Resources\IncomeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomeTypes extends ListRecords
{
    protected static string $resource = IncomeTypeResource::class;
    protected static ?string $title = 'Tipos de Ingresos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar Tipo de Ingreso')
            ->modalHeading('Registrar Tipo de Ingreso'),
        ];
    }
}
