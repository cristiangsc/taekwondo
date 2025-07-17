<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;
    protected static ?string $title = 'Editar Documento';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->modalHeading('Está Eliminando el documento registrado'),
        ];
    }
}
