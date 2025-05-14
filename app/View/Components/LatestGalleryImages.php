<?php

namespace App\View\Components;

use App\Models\Gallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestGalleryImages extends Component
{

    public \Illuminate\Support\Collection $images;
    public $gallery;
    public function __construct()
    {
        $this->gallery = Gallery::latest()->first();
        $this->images = $this->gallery ? $this->gallery->getMedia('gallery')->take(5) : collect();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-gallery-images', [
            'images' => $this->images
        ]);
    }
}
