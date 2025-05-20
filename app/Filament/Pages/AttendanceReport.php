<?php

namespace App\Filament\Pages;

use App\Enums\Asistencia;
use App\Enums\Group;
use App\Enums\Meses;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Illuminate\Support\Carbon;

class AttendanceReport extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static string $view = 'filament.pages.attendance-report';
    protected static ?string $title = 'Reporte de Asistencia';

    public $month;
    public $group;
    public $year;

    public function mount(): void
    {
        $this->form->fill([
            'month' => now()->month,
            'year' => now()->year,
            'group' => null,
        ]);
        $this->month = now()->month;
        $this->year = now()->year;
    }

    protected function getFormSchema(): array
    {

        return [
            Select::make('year')
                ->label('Año')
                ->options([
                    2024 => '2024',
                    2025 => '2025',
                    2026 => '2026',
                ])
                ->required()
                ->default(now()->year)
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->year = $state),

            Select::make('month')
                ->label('Mes')
                ->options(array_column(Meses::cases(), 'name', 'value'))
                ->native(false)
                ->required()
                ->default($this->month)
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->month = $state),

            Select::make('group')
                ->label('Grupos')
                ->options(collect(Group::cases())->pluck('value', 'value'))
                ->searchable()
                ->nullable()
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->group = $state),
        ];
    }

    public function getDaysInMonth(): array
    {
        $start = Carbon::create($this->year, $this->month, 1);
        $end = $start->copy()->endOfMonth();

        return collect(range(0, $start->diffInDays($end)))
            ->map(fn($i) => $start->copy()->addDays($i)->format('Y-m-d'))
            ->toArray();

    }

    public function getAttendanceData()
    {
        $days = $this->getDaysInMonth();

        $students = Student::query()
            ->when($this->group, fn($q) => $q->where('group', $this->group))
            ->with(['attendances' => fn($q) => $q->whereBetween('date', [
                Carbon::create($this->year, $this->month, 1)->startOfMonth(),
                Carbon::create($this->year, $this->month, 1)->endOfMonth()
                ])
            ])
            ->get();


        return $students->map(function ($student) use ($days) {
            $row = [
                'name' => $student->full_name ?? "{$student->name} {$student->last_name_paternal}",
            ];

            $attendanceByDate = $student->attendances->keyBy(fn($a) => Carbon::parse($a->date)->format('Y-m-d')
            );
            foreach ($days as $day) {
                $status = isset($attendanceByDate[$day]) ? $attendanceByDate[$day]->status : null;
                $row[$day] = match ($status) {
                    Asistencia::Presente->value => '✓',
                    Asistencia::Ausente->value => '✗',
                    Asistencia::Justificado->value => 'J',
                    default => '-',
                };
            }
            return $row;
        });
    }
}
