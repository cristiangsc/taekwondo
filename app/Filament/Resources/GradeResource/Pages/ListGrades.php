<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrades extends ListRecords
{
    protected static string $resource = GradeResource::class;
    protected static ?string $title = 'Grados';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar grado'),
        ];
    }
}
