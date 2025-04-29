<?php

namespace App\Filament\Resources;

use App\Enums\MetodoPago;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
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
                            ->relationship('student', 'name')
                            ->label('Estudiante')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Fecha de Pago')
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Monto')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('payment_method')
                            ->options(collect(MetodoPago::cases())->pluck('value', 'value'))
                            ->label('Método de Pago')
                            ->required()
                    ]),
                Section::make('Detalle de la próxima mensualidad')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('next_payment_due')
                            ->label('Próximo Pago')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_start_date')
                            ->label('Fecha clases desde el')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_end_date')
                            ->label('Fecha clases hasta el')
                            ->required()
                    ]),
                Forms\Components\Textarea::make('notes')
                    ->label('Observaciones')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_payment_due')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
