<?php

namespace App\Filament\Deportista\Resources\LoanResource\Widgets;

use App\Models\Equipment;
use App\Models\Loan;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LoanOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEquipment = Equipment::count();
        $availableEquipment = Equipment::where('status', 'disponible')->count();
        $loanedEquipment = Equipment::where('status', 'prestado')->count();
        $activeLoans = Loan::where('status', 'activo')->count();
        $overdueLoans = Loan::where('status', 'vencido')
            ->where('expected_return_date', '<', now())
            ->count();
        $activeStudents = Student::all()->count();

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

            Stat::make('Préstamos Activos', $activeLoans)
                ->description('Préstamos sin devolver')
                ->descriptionIcon('heroicon-m-arrows-right-left')
                ->color('info'),

            Stat::make('Préstamos Vencidos', $overdueLoans)
                ->description('Requieren atención')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make('Estudiantes Activos', $activeStudents)
                ->description('Estudiantes registrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
