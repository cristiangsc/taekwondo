<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class GalleryDetail extends Component
{
    public $galleryId;
    public $gallery;
    public $perPage = 12;

    public function mount($id): void
    {
        $this->galleryId = $id;
        $this->gallery = Gallery::findOrFail($id);
    }

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function render(): Renderable
    {
        // Lista parcial de imágenes (solo las visibles en el grid)
        $images = $this->gallery->media()
            ->where('collection_name', 'gallery')
            ->take($this->perPage)
            ->get();

        // Todas las imágenes para el lightbox
        $allImages = $this->gallery->media()
            ->where('collection_name', 'gallery')
            ->get()
            ->map(function ($image, $index) {
                return [
                    'id' => $image->id,
                    'thumb' => $image->getUrl('thumb'),
                    'full' => $image->getUrl(),
                    'alt' => $this->gallery->name . ' - Imagen ' . ($index + 1),
                    'index' => $index
                ];
            });

        return view('livewire.gallery-detail', [
            'gallery' => $this->gallery,
            'images' => $images,
            'allImages' => $allImages,
            'hasMore' => $this->gallery->media()
                    ->where('collection_name', 'gallery')
                    ->count() > $this->perPage,
        ]);
    }
}
