<?php

namespace App\View\Components;

use App\Models\Slide;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $slides;

    public function __construct()
    {
        $this->slides = Slide::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carousel', [
            'slides' => $this->slides
        ]);

    }
}
