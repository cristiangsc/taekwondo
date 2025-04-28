<?php

namespace App\Filament\Resources\PartnershipResource\Pages;

use App\Filament\Resources\PartnershipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartnership extends EditRecord
{
    protected static string $resource = PartnershipResource::class;
    protected static ?string $title = 'Editar Alianza';


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar Alianza'),
        ];
    }
}
