<?php

namespace App\Filament\Resources\CuotaResource\Pages;

use App\Filament\Resources\CuotaResource;
use App\Models\Student;
use App\Models\ValorCuota;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreateCuota extends CreateRecord
{
    protected static string $resource = CuotaResource::class;
    protected static ?string $title = 'Registrar Pago de cuota';

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['year'] = ValorCuota::where('id', $data['cuota_id'])->first()->anio_cuota;
        $cuotas = [];
        $months = $data['month'];
        unset($data['month']);

        foreach ($months as $month) {
            $cuotaData = $data;
            $cuotaData['month'] = $month;
            $cuotas[] = $cuotaData;
        }

        return $cuotas;
    }

    public function create(bool $another = false): void
    {
        $data = $this->form->getState();
        $cuotas = $this->mutateFormDataBeforeCreate($data);

        foreach ($this->form->getComponents() as $section) {
            if ($section->getChildComponentContainer()) {
                foreach ($section->getChildComponentContainer()->getComponents() as $component) {
                    if ($component->getName() === 'Comprobante') {
                        $comprobanteComponent = $component;
                        break 2; // Salir de ambos bucles si se encuentra el componente
                    }
                }
            }
        }

        $comprobanteState = $comprobanteComponent->getState();

        // Mover los archivos temporales a una ubicación permanente
        $storedFiles = [];
        if (is_array($comprobanteState)) {
            foreach ($comprobanteState as $file) {
                $storedFiles[] = $file->store('comprobantes', 'public'); // Guardar en storage/app/public/comprobantes
            }
        } elseif ($comprobanteState) {
            $storedFiles[] = $comprobanteState->store('comprobantes', 'public');
        }

        foreach ($cuotas as $cuotaData) {
            $record = $this->getModel()::create($cuotaData);
            $tempFiles = [];
            foreach ($storedFiles as $storedFile) {
                $originalPath = storage_path('app/public/' . $storedFile);
                $tempPath = storage_path('app/temp/' . basename($storedFile));
                if (!file_exists(storage_path('app/temp'))) {
                    mkdir(storage_path('app/temp'), 0755, true); // Crear la carpeta temporal si no existe
                }
                copy($originalPath, $tempPath);
                $tempFiles[] = $tempPath;
            }

            // Adjuntar los archivos almacenados al registro creado
            foreach ($tempFiles as $tempFile) {
                $record->addMedia($tempFile)
                    ->toMediaCollection('cuotaClub');
            }
        }

        // Eliminar las copias temporales después de procesar todos los registros

        foreach ($storedFiles as $storedFile) {
            $filePath = storage_path('app/public/' . $storedFile); // Ruta completa del archivo
            if (file_exists($filePath)) {
                unlink($filePath); // Elimina el archivo
            }
        }

        $months = array_column($cuotas, 'month');

        // $this->sendEmail($record, $months);

        if ($another) {
            $this->redirect($this->getResource()::getUrl('create'));
        } else {
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }

//    public function sendEmail($record, $months): void
//    {
//        $student = Student::find($record['student_id']);
//        $email = $student->users->first() ? $student->users->first()->email : $student->email;
//        $valorCuota = ValorCuota::find($record['cuota_id']);
//        $amount_total = count($months) * $record['amount'];
//        $dataToSend = [
//            'fee' => 'Cuota Mensual Club',
//            'student' => $student->full_name,
//            'anio' => $record['year'],
//            'amount' => $valorCuota->valor_cuota,
//            'amount_total' => $amount_total,
//            'date' => Carbon::parse($record['payment_date'])->format('d-m-Y'),
//            'user' => $student->users->first() ? $student->users->first()->full_name : '',
//            'email' => $email,
//            'observaciones' => $record['observation'],
//            'responsable' => auth()->user()->full_name,
//            'cargo' => auth()->user()->getRoleNames()->last(),
//            'monthsPaid' => implode(', ', $months),
//        ];
//
//        try {
//            Mail::to($dataToSend['email'])->send(new PayFee($dataToSend));
//        } catch (\Exception $e) {
//            Log::error('Error al enviar el correo: ' . $e->getMessage());
//            throw new \Exception('No se pudo enviar el correo.');
//        }
//
//        try {
//            $student_user = $student->users->first() ? $student->users->first() : $student;
//            Notification::make()
//                ->title('Envío de Correo electrónico')
//                ->body("Se ha enviado un email a $email con la información del registro del pago")
//                ->success()
//                ->sendToDatabase([auth()->user(), $student_user]);
//        } catch (\Exception $e) {
//            Log::error('Error al enviar notificación: ' . $e->getMessage());
//        }
//
//    }

}
