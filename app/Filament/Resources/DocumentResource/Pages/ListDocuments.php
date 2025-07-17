<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;
    protected static ?string $title = 'Listado de Documentos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Subir Documento'),
        ];
    }
}
