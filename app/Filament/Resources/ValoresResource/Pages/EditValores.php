<?php

namespace App\Filament\Resources\ValoresResource\Pages;

use App\Filament\Resources\ValoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValores extends EditRecord
{
    protected static string $resource = ValoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
