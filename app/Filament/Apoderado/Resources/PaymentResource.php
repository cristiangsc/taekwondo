<?php

namespace App\Filament\Apoderado\Resources;

use App\Filament\Apoderado\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'hugeicons-money-receive-square';
    protected static ?string $navigationLabel = 'Pagos Mensualidad';
    protected static ?string $breadcrumb = 'Pagos Mensualidad';

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
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año')
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Deportista')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('student.representative.name')
                    ->label('Apoderado/a')
                    ->icon('heroicon-o-user')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8')),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Fecha de Pago')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto')
                    ->prefix('$ ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_payment_due')
                    ->label('Próximo Pago')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_start_date')
                    ->label('Fecha clases desde el')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_end_date')
                    ->label('Fecha clases hasta el')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Efectivo' => 'info',
                        'Transferencia bancaria' => 'success',
                        'Otro' => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                SelectFilter::make('anio')
                    ->label('Año')
                    ->options(function () {
                        return Payment::query()
                            ->select('anio')
                            ->distinct()
                            ->orderBy('anio', 'desc')
                            ->pluck('anio', 'anio')
                            ->toArray();
                    })
                    ->default(now()->year)
            ])
            ->actions([
                MediaAction::make()
                    ->media(fn($record) => $record->getFirstMediaUrl('comprobante'))
                    ->label('')
                    ->tooltip('Ver Comprobante')
                    ->icon('hugeicons-file-view')
                    ->color('info')
                    ->visible(function (Payment $record) {
                        return $record->getMedia('comprobante')
                            ->isNotEmpty();
                    }),
                Action::make('pdf')
                    ->label('')
                    ->icon('hugeicons-pdf-02')
                    ->color('success')
                    ->action(function ($record) {
                        $record->payment_date = Carbon::parse($record->payment_date);
                        $record->next_payment_due = Carbon::parse($record->next_payment_due);
                        $record->payment_start_date = Carbon::parse($record->payment_start_date);
                        $record->payment_end_date = Carbon::parse($record->payment_end_date);
                        $pdf = Pdf::loadView('pdf.payment', ['payment' => $record]);
                        return response()->streamDownload(fn() => print($pdf->stream()), 'comprobante_pago_' . $record->id . '.pdf');
                    }),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
        ];
    }
}
