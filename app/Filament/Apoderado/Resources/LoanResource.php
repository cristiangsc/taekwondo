<?php

namespace App\Filament\Apoderado\Resources;

use App\Filament\Apoderado\Resources\LoanResource\Pages;
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
    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 2;


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
                Tables\Actions\ViewAction::make()->label(''),
            ])
            ->defaultSort('loaned_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'view' => Pages\ViewLoan::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->whereHas('student', function (Builder $query) {
            $query->where('representative_id', auth()->id());
        });

        // Actualizar préstamos vencidos
        Loan::where('status', 'activo')
            ->where('expected_return_date', '<', now())
            ->update(['status' => 'vencido']);

        return $query;
    }


}
