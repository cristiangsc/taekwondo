<?php

namespace App\Filament\Resources;

use App\Enums\MonthEnum;
use App\Filament\Resources\CuotaResource\Pages;
use App\Models\Cuota;
use App\Models\ValorCuota;

//use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;

//use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;

//use Filament\Tables\Actions\ExportBulkAction;
//use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

//use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;

//use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
//use pxlrbt\FilamentExcel\Columns\Column;
//use pxlrbt\FilamentExcel\Exports\ExcelExport;


class CuotaResource extends Resource
{
    protected static ?string $model = Cuota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pago de Cuotas Club';
    protected static ?string $navigationGroup = 'Club';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalle de la cuota a pagar')
                    ->columns(3)
                    ->schema([
                        Select::make('student_id')
                            ->label('Nombre del Estudiante')
                            ->placeholder('Seleccione el estudiante')
                            ->prefixIcon('heroicon-c-user')
                            ->relationship('student', 'full_name')
                            ->required(),
                        Select::make('cuota_id')
                            ->label('Cuota Año')
                            ->prefixIcon('heroicon-c-calendar')
                            ->relationship('valorCuota', 'anio_cuota', fn($query) => $query->orderByDesc('anio_cuota'))
                            ->default(fn() => ValorCuota::query()->orderByDesc('anio_cuota')->value('id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $cuota = ValorCuota::find($state);
                                $set('valor_cuota', $cuota ? $cuota->valor_cuota : null);
                            }),
                        DatePicker::make('payment_date')
                            ->label('Fecha de Pago')
                            ->date()
                            ->required()
                            ->default(date("d-m-Y")),
                        Select::make('month')
                            ->label('Mes')
                            ->placeholder('Seleccione el mes')
                            ->prefixIcon('heroicon-c-calendar')
                            ->required()
                            ->options(array_column(MonthEnum::cases(), 'name', 'value'))
                            ->multiple()
                            ->live(),
                        TextInput::make('amount')
                            ->label('Valor cuota Pagado')
                            ->placeholder('Valor de la cuota')
                            ->prefixIcon('heroicon-c-currency-dollar')
                            ->numeric()
                            ->required(),
                        Placeholder::make('valor_cuota')
                            ->label('Valor de la Cuota')
                            ->content(fn($get) => $get('cuota_id')
                                ? ('$ ' . number_format(optional(ValorCuota::find($get('cuota_id')))->valor_cuota, 0, ',', '.'))
                                : 'Seleccione una cuota'
                            )
                            ->reactive()
                            ->extraAttributes(['class' => 'text-xl text-green-600 font-bold']),

                    ]),
                Section::make('Registrar observaciones y cargar comprobante de pago')
                    ->columns(2)
                    ->schema([
                        RichEditor::make('observation')
                            ->label('Observaciones')
                            ->placeholder('Escriba aquí las observaciones')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('Comprobante')
                            ->collection('cuotaClub')
                            ->image()
                            ->responsiveImages()
                            ->imageEditor()
                            ->openable()
                            ->optimize('jpg')
                            ->resize(30)
                            ->label('Cargar Comprobante de Pago')
                            ->columnSpanFull()
                    ])
            ]);
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
                TextColumn::make('student.representative.full_name')
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
//                TextColumn::make('student.deleted_at')
//                    ->label('Estado')
//                    ->formatStateUsing(fn($state) => $state ? 'Eliminado' : 'Activo')
//                    ->badge()
//                    ->color(fn($state) => $state ? 'danger' : 'success')
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
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
//                TernaryFilter::make('student_deleted')
//                    ->label('Estudiantes Eliminados')
//                    ->placeholder('Todos los registros')
//                    ->trueLabel('Sí')
//                    ->falseLabel('No')
//                    ->queries(
//                        true: fn(Builder $query) => $query->whereHas('student', fn($q) => $q->onlyTrashed()),
//                        false: fn(Builder $query) => $query->whereHas('student', fn($q) => $q->whereNull('deleted_at')),
//                        blank: fn(Builder $query) => $query,
//                    )
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
                    }),
                EditAction::make()
                    ->label('')
                    ->tooltip('Editar'),
                DeleteAction::make()
                    ->modalHeading('Está Eliminando el registro de la Cuota')
                    ->label('')
                    ->tooltip('Eliminar'),
//                ViewAction::make()
//                    ->modalHeading('Información Pago de Cuota')
//                    ->label('')
//                    ->tooltip('Ver')
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->modalHeading('Está Eliminando el o los registros de Cuotas'),
//                    ExportBulkAction::make()
//                        ->exports([
//                            ExcelExport::make()
//                                ->withFilename('Cuotas_' . date('d-m-Y') . '_export')
//                                ->withColumns([
//                                    Column::make('type_fee.name')
//                                        ->heading('Tipo de Cuota'),
//                                    Column::make('student.full_name')
//                                        ->heading('Nombre Estudiante'),
//                                    Column::make('year')
//                                        ->heading('Año'),
//                                    Column::make('month')
//                                        ->heading('Mes'),
//                                    Column::make('amount')
//                                        ->heading('Monto pagado'),
//                                    Column::make('payment_date')
//                                        ->heading('Fecha de Pago'),
//                                ]),
//                        ])
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCuotas::route('/'),
            'create' => Pages\CreateCuota::route('/create'),
            'edit' => Pages\EditCuota::route('/{record}/edit'),
        ];
    }
}
