<?php

namespace App\Filament\Resources;

use App\Enums\MetodoPago;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\Summarizers\Sum;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'hugeicons-money-receive-square';
    protected static ?string $navigationLabel = 'Pagos Mensualidad';
    protected static ?string $breadcrumb = 'Pagos Mensualidad';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalle del pago de la mensualidad ')
                    ->columns(4)
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'full_name')
                            ->label('Estudiante')
                            ->prefixIcon('heroicon-o-user')
                            ->required(),
                        TextInput::make('anio')
                            ->prefixIcon('heroicon-o-calendar')
                            ->label('Año')
                            ->required()
                            ->numeric()
                            ->minLength(4)
                            ->maxLength(4),
                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Fecha de Pago')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Monto')
                            ->prefix('$ ')
                            ->placeholder('Ingrese el monto')
                            ->minValue(0)
                            ->maxValue(999999)
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('payment_method')
                            ->options(collect(MetodoPago::cases())->pluck('value', 'value'))
                            ->label('Método de Pago')
                            ->prefixIcon('heroicon-o-credit-card')
                            ->required()
                    ]),
                Section::make('Detalle de la próxima mensualidad')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('next_payment_due')
                            ->label('Próximo Pago')
                            ->after('payment_date')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_start_date')
                            ->label('Fecha clases desde el')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_end_date')
                            ->label('Fecha clases hasta el')
                            ->after('payment_start_date')
                            ->required()
                    ]),
                Forms\Components\Textarea::make('notes')
                    ->label('Observaciones')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('Comprobante')
                    ->collection('comprobante')
                    ->image()
                    ->responsiveImages()
                    ->imageEditor()
                    ->openable()
                    ->optimize('jpg')
                    ->resize(40)
                    ->columnSpanFull()
            ]);
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
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Fecha de Pago')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto')
                    ->prefix('$ ')
                    ->numeric()
                    ->summarize([Sum::make()->label('Totales')->prefix('$ ')])
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
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label(''),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
