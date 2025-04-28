<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;
    protected static ?string $title = 'Testimonios';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Ingresar testimonio'),
        ];
    }
}
