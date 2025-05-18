<?php

namespace App\Filament\Resources;

use App\Enums\Asistencia;
use App\Enums\Group;
use App\Enums\Meses;
use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;


class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'Asistencia';
    protected static ?string $breadcrumb = 'Asistencia';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('student_id')
                ->label('Deportista')
                ->options(Student::all()->pluck('full_name', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\DatePicker::make('date')
                ->label('Fecha')
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Estado')
                ->options(collect(Asistencia::cases())->pluck('value', 'value'))
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('student.full_name')
                ->label('Deportista')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('date')
                ->label('Fecha')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('student.group')
                ->label('Grupo')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    Group::Preinfantil->value => 'primary',
                    Group::Infantil->value => 'warning',
                    Group::JuvenilAdulto->value => 'success',
                }),
            Tables\Columns\TextColumn::make('status')
                ->label('Estado')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    Asistencia::Presente->value => 'success',
                    Asistencia::Ausente->value => 'warning',
                    Asistencia::Justificado->value => 'danger',
                })
        ])->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options(collect(Asistencia::cases())->pluck('value', 'value')),
                Tables\Filters\SelectFilter::make('student.group')
                    ->label('Grupo')
                    ->relationship('student', 'group')
                    ->options(collect(Group::cases())->pluck('value', 'value')),
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')->label('Desde'),
                        Forms\Components\DatePicker::make('end_date')->label('Hasta'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['start_date'], fn($q) => $q->where('date', '>=', $data['start_date']))
                            ->when($data['end_date'], fn($q) => $q->where('date', '<=', $data['end_date']));
                    }),
                Tables\Filters\SelectFilter::make('month')
                    ->label('Mes')
                    ->options(array_column(Meses::cases(), 'name', 'value'))
                    ->query(function ($query, $data) {
                        if ($data['value'] == null) {
                            return $query;
                        }
                        return $query->whereMonth('date', $data);
                    }),

                Tables\Filters\SelectFilter::make('year')
                    ->label('Año')
                    ->options(function () {
                        return DB::table('attendances')
                            ->selectRaw('YEAR(date) as year')
                            ->distinct()
                            ->orderByDesc('year')
                            ->pluck('year', 'year')
                            ->toArray();
                    })->default(now()->year)
                    ->query(function ($query, $data) {
                        if ($data['value'] == null) {
                            return $query;
                        }
                        return $query->whereYear('date', $data);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->modalHeading('Actualizar Asistencia'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->modalHeading('Eliminar Asistencia'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            //  'create' => Pages\CreateAttendance::route('/create'),
            //  'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
