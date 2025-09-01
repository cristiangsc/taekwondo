<?php

namespace App\Filament\Apoderado\Resources\RepresentativeResource\Pages;

use App\Filament\Apoderado\Resources\RepresentativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepresentatives extends ListRecords
{
    protected static string $resource = RepresentativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
