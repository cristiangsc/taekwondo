<?php

namespace App\Filament\Deportista\Resources\BalanceResource\Pages;

use App\Filament\Deportista\Resources\BalanceResource;
use App\Filament\Deportista\Resources\BalanceResource\Widgets\BalanceStatsWidget;
use Filament\Resources\Pages\ListRecords;

class ListBalances extends ListRecords
{
    protected static string $resource = BalanceResource::class;
    protected static ?string $title = 'Balance General';

    public function getHeaderWidgets(): array
    {
        return [
            BalanceStatsWidget::make([
                'filterData' => $this->getTableFiltersForm()->getRawState(),
            ]),
        ];

    }

    public function getTableRecordKey($record): string
    {
        return $record->id ?? md5($record->tipo); // Usamos el tipo como fallback para generar un ID único
    }

    public function updatedTableFilters(): void
    {
        $this->dispatch('filterApplied', filterData: $this->tableFilters);
    }


}
