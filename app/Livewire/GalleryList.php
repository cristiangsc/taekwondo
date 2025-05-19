<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryList extends Component
{
    use WithPagination;

    public function render()
    {
        // Get all galleries with pagination
        $galleries = Gallery::latest()
            ->paginate(9);

        return view('livewire.gallery-list', [
            'galleries' => $galleries,
        ])->layout('components.layouts.gallery', [
            'title' => 'Galerías de Imágenes'
        ]);
    }
}
