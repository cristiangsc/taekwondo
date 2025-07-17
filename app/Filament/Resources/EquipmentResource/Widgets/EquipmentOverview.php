<?php

namespace App\Filament\Resources\EquipmentResource\Widgets;

use App\Models\Equipment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class EquipmentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEquipment = Equipment::count();
        $availableEquipment = Equipment::where('status', 'disponible')->count();
        $loanedEquipment = Equipment::where('status', 'prestado')->count();
        $equipmentByCategory = Equipment::select('categories.name', DB::raw('count(*) as total'))
            ->join('categories', 'equipment.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->pluck('total', 'name')
            ->map(function ($total, $name) {
                return "$name: $total";
            })
            ->implode("\n");


        return [
            Stat::make('Total de Equipos', $totalEquipment)
                ->description('Equipos registrados')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Stat::make('Equipos Disponibles', $availableEquipment)
                ->description('Listos para préstamo')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Equipos Prestados', $loanedEquipment)
                ->description('Actualmente en préstamo')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color('warning'),

            Stat::make('Por Categoría', '')
                ->description($equipmentByCategory)
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('info'),


        ];
    }
}
