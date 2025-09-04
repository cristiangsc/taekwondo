<?php

namespace App\Filament\Deportista\Resources\LoanResource\Pages;

use App\Filament\Deportista\Resources\LoanResource;
use Filament\Resources\Pages\ListRecords;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;
    protected static ?string $title = 'Gestión de Préstamos';

    protected function getHeaderWidgets(): array
    {
        return [
            LoanResource\Widgets\LoanOverview::class,
        ];
    }
}
