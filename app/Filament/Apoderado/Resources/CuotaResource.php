<?php

namespace App\Filament\Apoderado\Resources;

use App\Filament\Apoderado\Resources\CuotaResource\Pages;
use App\Models\Cuota;
use Filament\Resources\Resource;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;
use Illuminate\Database\Eloquent\Builder;


class CuotaResource extends Resource
{
    protected static ?string $model = Cuota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pago de Cuotas Club';
    protected static ?string $navigationGroup = 'Club';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('student', function (Builder $query) {
            $query->where('representative_id', auth()->id());
        });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.full_name')
                    ->label('Nombre Deportista')
                    ->icon('heroicon-o-user')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8')),
                //  ->color(fn($record) => $record->student->trashed() ? 'danger' : 'default'),
                TextColumn::make('student.representative.name')
                    ->label('Apoderado/a')
                    ->icon('heroicon-o-user')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8')),
                //     ->color(fn($record) => $record->student->trashed() ? 'danger' : 'default'),
                TextColumn::make('year')
                    ->label('Año')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('month')
                    ->label('Mes')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('valorCuota.valor_cuota')
                    ->label('Valor cuota Pactada')
                    ->numeric()
                    ->prefix('$ ')
                    ->sortable()
                    ->badge()
                    ->alignCenter(),
                TextColumn::make('amount')
                    ->label('Valor cuota Pagado')
                    ->numeric()
                    ->badge()
                    ->color('success')
                    ->prefix('$ ')
                    ->sortable()
                    ->summarize(Sum::make()->prefix('$ '))
                    ->prefix('$ ')
                    ->alignCenter(),
                TextColumn::make('payment_date')
                    ->label('Fecha de Pago')
                    ->icon('heroicon-c-calendar')
                    ->date()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('observation')
                    ->label('Observación')
                    ->icon('heroicon-o-eye')
                    ->limit(50)
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8'))->html(),
                SpatieMediaLibraryImageColumn::make('Comprobante')
                    ->label('Comprobante')
                    ->alignCenter()
                    ->collection('cuotaClub')

            ])->defaultSort('payment_date', 'desc')
            ->filters([
                SelectFilter::make('student.full_name')
                    ->label('Deportista')
                    ->relationship('student', 'full_name'),
                SelectFilter::make('year')
                    ->label('Año')
                    ->options(fn() => Cuota::query()
                        ->select('year')
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->pluck('year', 'year')
                        ->toArray())
                    ->default(fn() => Cuota::query()
                        ->select('year')
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->value('year')),
            ])
            ->actions([
                MediaAction::make()
                    ->media(fn($record) => $record->getFirstMediaUrl('cuotaClub'))
                    ->label('')
                    ->tooltip('Ver Comprobante')
                    ->icon('hugeicons-file-view')
                    ->color('rose')
                    ->visible(function (Cuota $record) {
                        return $record->getMedia('cuotaClub')
                            ->isNotEmpty();
                    })
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCuotas::route('/'),
        ];
    }
}
