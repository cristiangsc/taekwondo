<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;
    protected static ?string $title = 'Editar noticia';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Está Eliminando la noticia'),
        ];
    }
}
