<?php

namespace App\View\Components;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoticiasDestacadas extends Component
{

    public $noticias;

    public function __construct()
    {
        $this->noticias = News::latest()
            ->take(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.noticias-destacadas', [
            'noticias' => $this->noticias,
        ]);
    }
}
