<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AboutMe;

class AboutSchool extends Component
{
    public $aboutMe;
    public $selectedSection = 'history';
    public $isLoading = false;

    public function mount()
    {
        $this->aboutMe = AboutMe::first() ?? new AboutMe();
    }

    public function selectSection($section)
    {
        $this->isLoading = true;
        $this->selectedSection = $section;

        // Simular una pequeña carga para mejor UX
        $this->dispatch('section-changed', ['section' => $section]);

        // Reset loading después de un momento
        $this->js('setTimeout(() => $wire.set("isLoading", false), 300)');
    }

    public function render()
    {
        return view('livewire.about-school');
    }
}
