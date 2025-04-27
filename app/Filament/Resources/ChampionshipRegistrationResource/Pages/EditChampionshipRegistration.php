<?php

namespace App\Filament\Resources\ChampionshipRegistrationResource\Pages;

use App\Filament\Resources\ChampionshipRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChampionshipRegistration extends EditRecord
{
    protected static string $resource = ChampionshipRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
