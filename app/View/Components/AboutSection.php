<?php

namespace App\View\Components;

use App\Models\AboutMe;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AboutSection extends Component
{
   public $aboutMe;

    public function __construct()
    {
        $this->aboutMe = AboutMe::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.about-section', [
            'aboutMe' => $this->aboutMe
        ]);
    }
}
