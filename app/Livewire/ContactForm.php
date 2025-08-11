<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactForm extends Component
{
    #[Validate('required|string|min:2|max:100', message: 'El nombre debe tener entre 2 y 100 caracteres')]
    public string $name = '';

    #[Validate('required|email|max:255', message: 'Ingresa un email válido')]
    public string $email = '';

    #[Validate('nullable|string|max:20|regex:/^[\+]?[0-9\s\-\(\)]+$/', message: 'El teléfono no tiene un formato válido')]
    public string $phone = '';

    #[Validate('required|string|min:10|max:1000', message: 'El mensaje debe tener entre 10 y 1000 caracteres')]
    public string $message = '';

    #[Validate('required|string|in:Información general,Inscripción,Horarios,Precios,Otro')]
    public string $subject = 'Información general';

    public bool $isSubmitting = false;
    public bool $showSuccess = false;
    public ?string $errorMessage = null;

    protected $listeners = [
        'resetForm' => 'resetForm',
    ];

    #[Computed]
    public function canSubmit(): bool
    {
        return !empty($this->name) &&
            !empty($this->email) &&
            !empty($this->message) &&
            !$this->isSubmitting &&
            filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    #[Computed]
    public function messageCharacterCount(): int
    {
        return strlen($this->message);
    }

    public function updated($propertyName): void
    {
        // Validación en tiempo real para mejorar UX
        if (in_array($propertyName, ['name', 'email', 'phone', 'message'])) {
            $this->validateOnly($propertyName);
        }

        // Limpiar mensajes de error cuando el usuario comience a escribir
        if ($this->errorMessage) {
            $this->errorMessage = null;
        }

        // Ocultar mensaje de éxito si el usuario empieza a editar
        if ($this->showSuccess && $propertyName !== 'showSuccess') {
            $this->showSuccess = false;
        }
    }

    public function submit(): void
    {
        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;
        $this->errorMessage = null;

        try {
            // Rate limiting para evitar spam
            $key = 'contact-form:' . request()->ip();

            if (RateLimiter::tooManyAttempts($key, 3)) {
                $seconds = RateLimiter::availableIn($key);
                throw ValidationException::withMessages([
                    'email' => "Demasiados intentos. Intenta de nuevo en {$seconds} segundos."
                ]);
            }

            RateLimiter::hit($key, 300); // 5 minutos

            $this->validate();

            // Simular procesamiento (remover en producción)
            sleep(1);

            // Envío de correo con manejo de errores
            $this->sendEmail();

            // Limpiar formulario
            $this->resetForm();
            $this->showSuccess = true;

            // Dispatch evento para JavaScript
            $this->dispatch('form-submitted', [
                'message' => '¡Gracias! Tu mensaje ha sido enviado correctamente.',
                'type' => 'success'
            ]);

            // Log para auditoría
            Log::info('Formulario de contacto enviado', [
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'ip' => request()->ip()
            ]);

        } catch (ValidationException $e) {
            $this->errorMessage = 'Por favor corrige los errores en el formulario.';
            throw $e;
        } catch (\Exception $e) {
            $this->errorMessage = 'Hubo un error al enviar tu mensaje. Por favor intenta más tarde.';

            Log::error('Error en formulario de contacto', [
                'error' => $e->getMessage(),
                'email' => $this->email,
                'ip' => request()->ip()
            ]);
        } finally {
            $this->isSubmitting = false;
        }
    }

    private function sendEmail(): void
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: 'No proporcionado',
            'message' => $this->message,
            'subject' => $this->subject,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()->format('d/m/Y H:i:s')
        ];

        Mail::send('emails.contact', $data, function ($message) {
            $message->to(config('mail.contact_email', 'contacto@taekwondo.cl'))
                ->subject("[Sitio Web] {$this->subject}")
                ->replyTo($this->email, $this->name);
        });
    }

    public function resetForm(): void
    {
        $this->reset(['name', 'email', 'phone', 'message']);
        $this->subject = 'Información general';
        $this->showSuccess = false;
        $this->errorMessage = null;
        $this->resetValidation();
    }

    public function hideSuccess(): void
    {
        $this->showSuccess = false;
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
