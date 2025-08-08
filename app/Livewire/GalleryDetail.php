<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryDetail extends Component
{
    use WithPagination;
    public $galleryId;
    public $gallery;
    public $perPage = 12; // Aumentamos a 12 para mejor distribución en grid

    public function mount($id): void
    {
        $this->galleryId = $id;
        $this->gallery = Gallery::findOrFail($id);
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render(): Renderable
    {
        $images = $this->gallery->media()
            ->where('collection_name', 'gallery')
            ->paginate($this->perPage);

        // Preparamos datos para el lightbox
        $allImages = $this->gallery->media()
            ->where('collection_name', 'gallery')
            ->get()
            ->map(function ($image, $index) {
                return [
                    'id' => $image->id,
                    'thumb' => $image->getUrl('thumb'),
                    'full' => $image->getUrl(), // URL completa
                    'alt' => $this->gallery->name . ' - Imagen ' . ($index + 1),
                    'index' => $index
                ];
            });

        return view('livewire.gallery-detail', [
            'gallery' => $this->gallery,
            'images' => $images,
            'allImages' => $allImages,
        ])->layout('components.layouts.gallery', [
            'title' => $this->gallery->name
        ]);
    }
}
