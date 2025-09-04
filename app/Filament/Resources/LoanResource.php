<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Models\Equipment;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationLabel = 'Préstamos';
    protected static ?string $modelLabel = 'Préstamo';
    protected static ?string $pluralModelLabel = 'Préstamos';
    protected static ?string $navigationGroup = 'Gestión';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Préstamo')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->label('Estudiante')
                            ->relationship('student', 'full_name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('equipment_id')
                            ->label('Equipo')
                            ->relationship('equipment','name',
                                modifyQueryUsing: function (Builder $query) {
                                    // Mostrar solo equipos disponibles; al editar, permitir el equipo actual del préstamo
                                    $query->where('status', 'disponible');

                                    // Si estamos editando un registro existente, incluir su equipo para que el select sea válido
                                    if ($record = request()->route('record')) {
                                        // $record puede ser un modelo o un id; Filament usa la clave {record}
                                        $loanId = is_object($record) ? $record->getKey() : $record;
                                        if ($loanId) {
                                            $query->orWhereIn('id', function ($sub) use ($loanId) {
                                                $sub->select('equipment_id')
                                                    ->from('loans')
                                                    ->where('id', $loanId);
                                            });
                                        }
                                    }
                                }
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} - {$record->code}")
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $equipment = Equipment::find($state);
                                    if ($equipment) {
                                        $set('equipment_condition_loan', $equipment->condition);
                                    }
                                }
                            }),

                        Forms\Components\DateTimePicker::make('loaned_at')
                            ->label('Fecha y Hora de Préstamo')
                            ->default(now())
                            ->required(),

                        Forms\Components\DateTimePicker::make('expected_return_date')
                            ->label('Fecha Esperada de Devolución')
                            ->default(now()->addDays(7))
                            ->required(),

                        Forms\Components\Select::make('equipment_condition_loan')
                            ->label('Condición del Equipo al Prestar')
                            ->options([
                                'excelente' => 'Excelente',
                                'bueno' => 'Bueno',
                                'regular' => 'Regular',
                                'malo' => 'Malo',
                            ])
                            ->default('excelente')
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'activo' => 'Activo',
                                'devuelto' => 'Devuelto',
                                'vencido' => 'Vencido',
                                'perdido' => 'Perdido',
                            ])
                            ->default('activo')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                if ($state === 'activo' && $get('returned_at')) {
                                    // Si el estado cambia a activo y hay una fecha de devolución, la eliminamos
                                    $set('returned_at', null);
                                    $set('equipment_condition_return', null);
                                    $set('returned_by', null);
                                    $set('return_notes', null);

                                    // También actualizamos el estado del equipo a prestado
                                    if ($equipment = Equipment::find($get('equipment_id'))) {
                                        $equipment->update(['status' => 'prestado']);
                                    }
                                }
                            }),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Información de Devolución')
                    ->schema([
                        Forms\Components\DateTimePicker::make('returned_at')
                            ->label('Fecha y Hora de Devolución')
                            ->visible(fn(Get $get) => in_array($get('status'), ['devuelto'])),

                        Forms\Components\Select::make('equipment_condition_return')
                            ->label('Condición del Equipo al Devolver')
                            ->options([
                                'excelente' => 'Excelente',
                                'bueno' => 'Bueno',
                                'regular' => 'Regular',
                                'malo' => 'Malo',
                            ])
                            ->visible(fn(Get $get) => in_array($get('status'), ['devuelto'])),

                        Forms\Components\Select::make('returned_by')
                            ->label('Recibido por')
                            ->relationship('returnedByUser', 'name')
                            ->visible(fn(Get $get) => in_array($get('status'), ['devuelto'])),

                        Forms\Components\Textarea::make('return_notes')
                            ->label('Notas de Devolución')
                            ->rows(3)
                            ->visible(fn(Get $get) => in_array($get('status'), ['devuelto']))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Notas Adicionales')
                    ->schema([
                        Forms\Components\Textarea::make('loan_notes')
                            ->label('Notas del Préstamo')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Deportista')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('equipment.name')
                    ->label('Equipo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('equipment.code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('loaned_at')
                    ->label('Fecha Préstamo')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('expected_return_date')
                    ->label('Fecha Esperada')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('returned_at')
                    ->label('Fecha Devolución')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Pendiente'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'activo' => 'Activo',
                        'devuelto' => 'Devuelto',
                        'vencido' => 'Vencido',
                        'perdido' => 'Perdido',
                        default => $state
                    })
                    ->badge()
                    ->color(fn(Loan $record): string => match ($record->status) {
                        'activo' => $record->isOverdue() ? 'danger' : 'success',
                        'devuelto' => 'primary',
                        'vencido' => 'warning',
                        'perdido' => 'danger',
                        default => 'secondary'
                    }),

                Tables\Columns\TextColumn::make('days_overdue')
                    ->label('Días Vencido')
                    ->getStateUsing(function (Loan $record): string {
                        if ($record->isOverdue()) {
                            return $record->days_overdue . ' días';
                        }
                        return '-';
                    })
                    ->color('danger')
                    ->visible(fn() => true),

                Tables\Columns\TextColumn::make('loanedByUser.name')
                    ->label('Prestado por')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'activo' => 'Activo',
                        'devuelto' => 'Devuelto',
                        'vencido' => 'Vencido',
                        'perdido' => 'Perdido',
                    ]),

                Tables\Filters\Filter::make('overdue')
                    ->label('Préstamos Vencidos')
                    ->query(fn(Builder $query): Builder => $query->where('status', 'activo')->where('expected_return_date', '<', now()))
                    ->indicator('Vencidos'),

                Tables\Filters\Filter::make('active')
                    ->label('Préstamos Activos')
                    ->query(fn(Builder $query): Builder => $query->where('status', 'activo'))
                    ->indicator('Activos'),

                Tables\Filters\SelectFilter::make('student_id')
                    ->label('Estudiante')
                    ->relationship('student', 'full_name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('return')
                    ->label('Devolver')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->visible(fn(Loan $record): bool => $record->status != 'devuelto')
                    ->form([
                        Forms\Components\DateTimePicker::make('returned_at')
                            ->label('Fecha y Hora de Devolución')
                            ->default(now())
                            ->required(),
                        Forms\Components\Select::make('equipment_condition_return')
                            ->label('Condición del Equipo')
                            ->options([
                                'excelente' => 'Excelente',
                                'bueno' => 'Bueno',
                                'regular' => 'Regular',
                                'malo' => 'Malo',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('return_notes')
                            ->label('Notas de Devolución')
                            ->rows(3),
                    ])
                    ->action(function (Loan $record, array $data): void {
                        $record->update([
                            'status' => 'devuelto',
                            'returned_at' => $data['returned_at'],
                            'equipment_condition_return' => $data['equipment_condition_return'],
                            'return_notes' => $data['return_notes'],
                            'returned_by' => auth()->id(),
                        ]);

                        // Actualizar el estado del equipo
                        $record->equipment->update([
                            'status' => 'disponible',
                            'condition' => $data['equipment_condition_return'],
                        ]);
                    }),

                Tables\Actions\Action::make('mark_lost')
                    ->label('Marcar Perdido')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('danger')
                    ->visible(fn(Loan $record): bool => in_array($record->status, ['activo', 'vencido']))
                    ->requiresConfirmation()
                    ->action(function (Loan $record): void {
                        $record->update(['status' => 'perdido']);
                        $record->equipment->update(['status' => 'perdido']);
                    }),

                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('loaned_at', 'desc');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'view' => Pages\ViewLoan::route('/{record}'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Actualizar préstamos vencidos
        Loan::where('status', 'activo')
            ->where('expected_return_date', '<', now())
            ->update(['status' => 'vencido']);

        return $query;
    }

}
