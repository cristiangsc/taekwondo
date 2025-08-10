<?php

namespace App\Livewire;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryList extends Component
{
    use WithPagination;

    public $perPage = 12;
    public $sortBy = 'latest'; // latest, oldest, name, images_count

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function loadMore(): void
    {
        $this->perPage += 12;
    }

    public function render(): Renderable
    {
        $query = Gallery::query();

        // Apply sorting
        switch ($this->sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'images_count':
                $query->withCount(['media' => function ($query) {
                    $query->where('collection_name', 'gallery');
                }])->orderBy('media_count', 'desc');
                break;
            default: // latest
                $query->latest();
                break;
        }

        $galleries = $query->paginate($this->perPage);

        // Add image count and preview for each gallery
        $galleries->getCollection()->transform(function ($gallery) {
            $media = $gallery->getMedia('gallery');
            $gallery->images_count = $media->count();
            $gallery->preview_image = $media->first();
            $gallery->recent_images = $media->take(4); // For preview mosaic
            return $gallery;
        });

        return view('livewire.gallery-list', [
            'galleries' => $galleries,
        ]);
    }
}
