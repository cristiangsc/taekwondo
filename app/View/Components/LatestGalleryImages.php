<?php

namespace App\View\Components;

use App\Models\Gallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class LatestGalleryImages extends Component
{
    public Collection $images;
    public ?Gallery $gallery;

    public function __construct()
    {
        $this->gallery = Gallery::latest()->first();

        if ($this->gallery) {
            $this->images = $this->gallery->getMedia('gallery');
        } else {
            $this->images = collect([]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-gallery-images', [
            'images' => $this->images,
            'gallery' => $this->gallery,
        ]);
    }

    /**
     * Get the total count of images in the gallery
     */
    public function getTotalImagesCount(): int
    {
        return $this->gallery ? $this->gallery->getMedia('gallery')->count() : 0;
    }

    /**
     * Check if there are more images beyond the displayed ones
     */
    public function hasMoreImages(): bool
    {
        return $this->getTotalImagesCount() > 5;
    }

    /**
     * Get the count of remaining images
     */
    public function getRemainingImagesCount(): int
    {
        return max(0, $this->getTotalImagesCount() - 5);
    }
}
