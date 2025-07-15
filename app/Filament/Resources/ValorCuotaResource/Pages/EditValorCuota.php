<?php

namespace App\Filament\Resources\ValorCuotaResource\Pages;

use App\Filament\Resources\ValorCuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValorCuota extends EditRecord
{
    protected static string $resource = ValorCuotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
