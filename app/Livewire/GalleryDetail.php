<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryDetail extends Component
{
    public $galleryId;
    public $gallery;

    public function mount($id)
    {
        $this->galleryId = $id;
        $this->gallery = Gallery::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.gallery-detail', [
            'gallery' => $this->gallery,
            'images' => $this->gallery->getMedia('gallery'),
        ])->layout('components.layouts.app', [
            'title' => $this->gallery->name
        ]);
    }
}
