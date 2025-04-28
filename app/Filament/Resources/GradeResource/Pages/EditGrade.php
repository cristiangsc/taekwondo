<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGrade extends EditRecord
{
    protected static string $resource = GradeResource::class;
    protected static ?string $title = 'Editar grado';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar registro del grado'),
        ];
    }
}
