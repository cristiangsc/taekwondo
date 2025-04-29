<?php

namespace App\Filament\Resources\ChampionshipCategoryResource\Pages;

use App\Filament\Resources\ChampionshipCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChampionshipCategories extends ListRecords
{
    protected static string $resource = ChampionshipCategoryResource::class;
    protected static ?string $title = 'Categorías de campeonato';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Registrar categoría')
            ->modalHeading('Registrar categoría')
        ];
    }
}
