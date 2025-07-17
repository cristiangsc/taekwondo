<?php

namespace App\Filament\Resources\BalanceResource\Widgets;

use App\Models\Expense;
use App\Models\Income;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Livewire\Attributes\On;

class BalanceStatsWidget extends BaseWidget
{
    public ?array $filterData = [];

    #[On('filterApplied')]
    public function updateFilter($filterData): void
    {
        $this->filterData = $filterData;
    }

    protected function getStats(): array
    {
        // Obtener el año seleccionado del filtro
        $year = isset($this->filterData['anio']) ? current($this->filterData['anio']) : date('Y');


        // Calcular totales filtrados por el campo anio
        $totalIngresos = Income::where('anio', $year)->sum('monto_ingreso');
        $totalGastos = Expense::where('anio', $year)->sum('monto_gasto');
        $balance = $totalIngresos - $totalGastos;

        return [
            Stat::make('Total Ingresos', '$ ' . number_format($totalIngresos, 0, ',', '.'))
                ->description('Ingresos del año ' . $year)
                ->color('success'),

            Stat::make('Total Gastos', '$ ' . number_format($totalGastos, 0, ',', '.'))
                ->description('Gastos del año ' . $year)
                ->color('danger'),

            Stat::make('Balance', '$ ' . number_format($balance, 0, ',', '.'))
                ->description('Balance del año ' . $year)
                ->color($balance >= 0 ? 'success' : 'danger'),
        ];

    }


}
