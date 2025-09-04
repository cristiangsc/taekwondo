<?php

namespace App\Filament\Deportista\Resources;

use App\Filament\Deportista\Resources\ExamResource\Pages;
use App\Models\Exam;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Historial de Exámenes';
    protected static ?string $breadcrumb = 'Exámenes';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('student_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Estudiante')
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_date')
                    ->icon('heroicon-o-calendar')
                    ->label('Fecha del examen')
                    ->date()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('previousGrade.name')
                    ->label('Grado actual')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currentGrade.name')
                    ->label('Grado al que postula')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('result')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aprobado' => 'info',
                        'Reprobado' => 'success',
                        'Pendiente' => 'warning',
                    })
                    ->label('Resultado')
                    ->alignCenter()
            ])->defaultSort('exam_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
        ];
    }
}
