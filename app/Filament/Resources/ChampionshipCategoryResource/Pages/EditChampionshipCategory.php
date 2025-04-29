<?php

namespace App\Filament\Resources\ChampionshipCategoryResource\Pages;

use App\Filament\Resources\ChampionshipCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChampionshipCategory extends EditRecord
{
    protected static string $resource = ChampionshipCategoryResource::class;
    protected static ?string $title = 'Editar categoría de campeonato';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->modalHeading('Eliminar categoría de campeonato'),
        ];
    }
}
