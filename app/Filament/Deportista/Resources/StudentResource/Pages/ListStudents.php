<?php

namespace App\Filament\Deportista\Resources\StudentResource\Pages;

use App\Filament\Deportista\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;
    protected static ?string $title = 'Mis Antecedentes de Deportista';

}
