<?php

namespace App\Exports;


use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class AttendanceReportExport  implements FromArray,  WithCustomStartCell, WithEvents
{
    protected $data;
    protected $days;
    protected $month;
    protected $year;
    protected $group;

    public function __construct(array $data, array $days, string $month, string $year, ?string $group = null)
    {
        $this->data = $data;
        $this->days = $days;
        $this->month = $month;
        $this->year = $year;
        $this->group = $group;
    }

    public function startCell(): string
    {
        return 'A1'; // Los datos comienzan en la celda A1
    }


    public function array(): array
    {
        $monthName = Carbon::create()->month((int) $this->month)->locale('es')->isoFormat('MMMM');
        $header = "Reporte de asistencia correspondiente al mes de " . ucfirst($monthName) . " del año " . $this->year;

        if ($this->group) {
            $header .= " - Grupo: " . $this->group;
        }

        $daysFormatted = array_map(function ($day) {
            return Carbon::parse($day)->locale('es')->isoFormat('dd D');
        }, $this->days);


        $rows = collect($this->data)->map(function ($row) {
            return array_values($row);
        })->toArray();

        return [
            [$header], // Primera fila con el mensaje
            array_merge(['DEPORTISTAS'], $daysFormatted), // Encabezados reales
            ...$rows, // Datos
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columnCount = count($this->days) + 1;
                $rowCount = count($this->data) + 2;
                $endColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);

                // Título
                $event->sheet->mergeCells("A1:{$endColumn}1");
                $event->sheet->getStyle("A1")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Rango de encabezados + datos
                $tableRange = "A2:{$endColumn}{$rowCount}";
                $event->sheet->getStyle($tableRange)->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Alinear columna A (nombres) a la izquierda, desde fila 3 en adelante
                $nameColumnRange = "A3:A{$rowCount}";
                $event->sheet->getStyle($nameColumnRange)->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }


}
