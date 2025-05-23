<?php

namespace App\Filament\Pages;

use App\Enums\Asistencia;
use App\Enums\Group;
use App\Enums\Meses;
use App\Exports\AttendanceReportExport;
use App\Models\Attendance;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


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
            Forms\Components\Placeholder::make('')
                ->content('Seleccione el año, mes y tipo de grupo para generar el reporte de asistencia.'),
            Forms\Components\Grid::make(3)
                ->schema([
                    Select::make('year')
                        ->label('Año')
                        ->options(
                                Attendance::query()
                                ->selectRaw('YEAR(date) as year')
                                ->distinct()
                                ->orderBy('year', 'desc')
                                ->pluck('year', 'year')
                                ->toArray()
                        )
                        ->required()
                        ->default(now()->year)
                        ->reactive()
                        ->afterStateUpdated(fn($state) => $this->year = $state),

                    Select::make('month')
                        ->label('Mes')
                        ->options(array_column(Meses::cases(), 'name', 'value'))
                        ->native(false)
                        ->required()
                        ->default($this->month)
                        ->reactive()
                        ->afterStateUpdated(fn($state) => $this->month = $state),

                    Select::make('group')
                        ->label('Grupos')
                        ->options(collect(Group::cases())->pluck('value', 'value'))
                        ->searchable()
                        ->nullable()
                        ->reactive()
                        ->afterStateUpdated(fn($state) => $this->group = $state),
                ])
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
            $row = ['name' => $student->full_name ?? "{$student->name} {$student->last_name_paternal}"];
            $attendanceByDate = $student->attendances->keyBy(fn($a) => Carbon::parse($a->date)->format('Y-m-d'));
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

    public function exportToExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $days = $this->getDaysInMonth();
        $data = $this->getAttendanceData()->toArray();
        $month = $this->month;
        $year = $this->year;
        $group = $this->group;

        return Excel::download(new AttendanceReportExport($data, $days, $month, $year, $group), 'reporte_asistencia.xlsx');
    }

    public function exportToPdf(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        setlocale(LC_ALL, 'es_ES.UTF-8');
        $days = $this->getDaysInMonth();
        $data = $this->getAttendanceData();
        $monthName = Carbon::create()->month((int) $this->month)->locale('es')->isoFormat('MMMM');
        $year = $this->year;
        $group = $this->group;
        $logoPath = public_path('images/logo2.png'); // Ruta del logo

        $pdf = Pdf::loadView('filament.pages.attendance-report-pdf', [
            'days' => $days,
            'data' => $data,
            'monthName' => ucfirst($monthName),
            'year' => $year,
            'group' => $group,
            'logoPath' => $logoPath,
        ])->setPaper('legal', 'landscape');
        return response()->streamDownload(fn() => print($pdf->stream()), 'reporte_asistencia.pdf');

    }


}
