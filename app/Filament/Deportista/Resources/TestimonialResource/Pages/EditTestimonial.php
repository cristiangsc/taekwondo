<?php

namespace App\Filament\Deportista\Resources\TestimonialResource\Pages;

use App\Filament\Deportista\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;
    protected static ?string $title = 'Editar testimonio';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar testimonio'),
        ];
    }
}
