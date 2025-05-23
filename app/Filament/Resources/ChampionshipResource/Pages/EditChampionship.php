<?php

namespace App\Filament\Resources\ChampionshipResource\Pages;

use App\Filament\Resources\ChampionshipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChampionship extends EditRecord
{
    protected static string $resource = ChampionshipResource::class;
    protected static ?string $title = 'Editar campeonato';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar campeonato'),
        ];
    }
}
