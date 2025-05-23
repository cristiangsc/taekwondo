<?php

namespace App\Filament\Resources\AboutMeResource\Pages;

use App\Filament\Resources\AboutMeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutMes extends ListRecords
{
    protected static string $resource = AboutMeResource::class;
    protected static ?string $title = 'Acerca de';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Ingresar antecedentes')
        ];
    }
}
