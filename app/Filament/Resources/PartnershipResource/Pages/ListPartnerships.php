<?php

namespace App\Filament\Resources\PartnershipResource\Pages;

use App\Filament\Resources\PartnershipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartnerships extends ListRecords
{
    protected static string $resource = PartnershipResource::class;
    protected static ?string $title = 'Alianzas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Crear Alianza')
        ];
    }
}
