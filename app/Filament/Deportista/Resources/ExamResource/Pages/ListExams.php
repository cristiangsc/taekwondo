<?php

namespace App\Filament\Deportista\Resources\ExamResource\Pages;

use App\Filament\Deportista\Resources\ExamResource;
use Filament\Resources\Pages\ListRecords;

class ListExams extends ListRecords
{
    protected static string $resource = ExamResource::class;
    protected static ?string $title = 'Historial de Exámenes';

}
