<?php

namespace App\Filament\Apoderado\Resources\DocumentResource\Pages;

use App\Filament\Apoderado\Resources\DocumentResource;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;
    protected static ?string $title = 'Listado de Documentos';


}
