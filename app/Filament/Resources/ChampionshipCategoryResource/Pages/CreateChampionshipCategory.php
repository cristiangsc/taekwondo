<?php

namespace App\Filament\Resources\ChampionshipCategoryResource\Pages;

use App\Filament\Resources\ChampionshipCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChampionshipCategory extends CreateRecord
{
    protected static string $resource = ChampionshipCategoryResource::class;
    protected static ?string $title = 'Registrar categoría de campeonato';
}
