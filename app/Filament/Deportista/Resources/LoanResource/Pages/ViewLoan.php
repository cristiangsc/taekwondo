<?php

namespace App\Filament\Deportista\Resources\LoanResource\Pages;

use App\Filament\Deportista\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;


class ViewLoan extends ViewRecord
{
    protected static string $resource = LoanResource::class;

    protected static ?string $title = 'Detalle del Préstamo';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Información del Préstamo')
                    ->schema([
                        Infolists\Components\TextEntry::make('student.full_name')
                            ->label('Estudiante'),
                        Infolists\Components\TextEntry::make('equipment.name')
                            ->label('Equipo'),
                        Infolists\Components\TextEntry::make('equipment.code')
                            ->label('Código del Equipo'),
                        Infolists\Components\TextEntry::make('loaned_at')
                            ->label('Fecha de Préstamo')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('expected_return_date')
                            ->label('Fecha Esperada de Devolución')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'activo' => 'success',
                                'devuelto' => 'primary',
                                'vencido' => 'warning',
                                'perdido' => 'danger',
                                default => 'secondary'
                            }),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Condiciones del Equipo')
                    ->schema([
                        Infolists\Components\TextEntry::make('equipment_condition_loan')
                            ->label('Condición al Prestar')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'excelente' => 'success',
                                'bueno' => 'primary',
                                'regular' => 'warning',
                                'malo' => 'danger',
                                default => 'secondary'
                            }),
                        Infolists\Components\TextEntry::make('equipment_condition_return')
                            ->label('Condición al Devolver')
                            ->badge()
                            ->color(fn (?string $state): string => match($state) {
                                'excelente' => 'success',
                                'bueno' => 'primary',
                                'regular' => 'warning',
                                'malo' => 'danger',
                                default => 'secondary'
                            })
                            ->placeholder('Pendiente'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Información de Devolución')
                    ->schema([
                        Infolists\Components\TextEntry::make('returned_at')
                            ->label('Fecha de Devolución')
                            ->dateTime()
                            ->placeholder('Pendiente'),
                        Infolists\Components\TextEntry::make('returnedByUser.name')
                            ->label('Recibido por')
                            ->placeholder('Pendiente'),
                        Infolists\Components\TextEntry::make('return_notes')
                            ->label('Notas de Devolución')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Personal Involucrado')
                    ->schema([
                        Infolists\Components\TextEntry::make('loanedByUser.name')
                            ->label('Prestado por'),
                        Infolists\Components\TextEntry::make('loan_notes')
                            ->label('Notas del Préstamo')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
