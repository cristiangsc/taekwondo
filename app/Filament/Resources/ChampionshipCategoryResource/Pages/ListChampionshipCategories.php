<?php

namespace App\Filament\Resources\ChampionshipCategoryResource\Pages;

use App\Filament\Resources\ChampionshipCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChampionshipCategories extends ListRecords
{
    protected static string $resource = ChampionshipCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
