<?php

namespace App\Filament\Resources\CuotaResource\Pages;

use App\Enums\MonthEnum;
use App\Filament\Resources\CuotaResource;
use App\Models\Cuota;
use App\Models\ValorCuota;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCuota extends EditRecord
{
    protected static string $resource = CuotaResource::class;
    protected static ?string $title = 'Editar Cuota';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->modalHeading('Está Eliminando el registro de la Cuota'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['year'] = ValorCuota::where('id', $data['cuota_id'])->first()->anio_cuota;
        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Asegúrate de que solo un mes esté seleccionado al editar
        if (is_array($data['month'])) {
            $data['month'] = $data['month'][0] ?? null; // Selecciona el primer mes si hay varios
        }

        return $data;
    }

    protected function getFormSchema(): array
    {
        return [

            Section::make('Detalle de la cuota pagada')
                ->columns(3)
                ->schema([
                    Select::make('student_id')
                        ->label('Nombre del Deportista')
                        ->relationship('student', 'full_name')
                        ->required(),
                    Select::make('cuota_id')
                        ->label('Cuota Año')
                        ->prefixIcon('heroicon-c-calendar')
                        ->relationship('valorCuota', 'anio_cuota', fn($query) => $query->orderByDesc('anio_cuota'))
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->anio_cuota)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $cuota = ValorCuota::find($state);
                            $set('valor_cuota', $cuota ? $cuota->valor_cuota : null);
                        }),
                    Select::make('month')
                        ->label('Mes')
                        ->required()
                        ->options(array_column(MonthEnum::cases(), 'name', 'value'))
                        ->live(),
                    TextInput::make('amount')
                        ->label('Valor Cuota Pagada')
                        ->numeric()
                        ->prefix('$')
                        ->required(),
                    Placeholder::make('valor_cuota')
                        ->label('Valor de la Cuota')
                        ->content(fn($get) => $get('cuota_id')
                            ? ('$ ' . number_format(optional(ValorCuota::find($get('cuota_id')))->valor_cuota, 0, ',', '.'))
                            : 'Seleccione una cuota'
                        )
                        ->reactive()
                        ->extraAttributes(['class' => 'text-xl text-green-600 font-bold']),
                    DatePicker::make('payment_date')
                        ->label('Fecha de Pago')
                        ->date()
                        ->required()
                        ->default(date("d-m-Y")),
                ]),
            Section::make('Registrar observaciones y cargar comprobante de pago')
                ->columns(2)
                ->schema([
                    RichEditor::make('observation')
                        ->label('Observaciones'),
                    SpatieMediaLibraryFileUpload::make('Comprobante')
                        ->collection('cuotaClub')
                        ->image()
                        ->responsiveImages()
                        ->imageEditor()
                        ->openable()
                        ->optimize('jpg')
                        ->resize(30)
                ])

        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormSchema());
    }
}
