<?php

namespace App\Filament\Resources\ChampionshipRegistrationResource\Pages;

use App\Filament\Resources\ChampionshipRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChampionshipRegistrations extends ListRecords
{
    protected static string $resource = ChampionshipRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
