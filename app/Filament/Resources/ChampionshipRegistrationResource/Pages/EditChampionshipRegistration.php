<?php

namespace App\Filament\Resources\ChampionshipRegistrationResource\Pages;

use App\Filament\Resources\ChampionshipRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChampionshipRegistration extends EditRecord
{
    protected static string $resource = ChampionshipRegistrationResource::class;
    protected static ?string $title = 'Editar inscripción';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar inscripción'),
        ];
    }
}
