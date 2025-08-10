<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name, $email, $phone, $message, $subject = 'Información general';

    public function submit(): void
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|min:10',
            'subject' => 'required',
        ]);

        // Enviar correo
        Mail::raw("Mensaje: {$this->message}\nTeléfono: {$this->phone}", function($msg) {
            $msg->to('contacto@taekwondo.cl')
                ->subject($this->subject);
        });

        $this->reset(['name', 'email', 'phone', 'message', 'subject']);
        $this->subject = 'Información general';

        $this->dispatch('form-sent'); // Para que Alpine.js muestre éxito
    }

    public function render():View
    {
        return view('livewire.contact-form');
    }
}
