<?php

namespace App\Filament\Resources\ValoresResource\Pages;

use App\Filament\Resources\ValoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValores extends ListRecords
{
    protected static string $resource = ValoresResource::class;
    protected static ?string $title = 'Valores destacados';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Registrar valores')
                ->modalWidth('sm')
                ->modalHeading('Registrar Valor Cuota')
        ];
    }
}
