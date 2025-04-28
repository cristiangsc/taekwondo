<?php

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSlides extends ListRecords
{
    protected static string $resource = SlideResource::class;
    protected static ?string $title = 'Carrusel';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Subir imagen carrusel')
        ];
    }
}
