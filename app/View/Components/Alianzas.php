<?php

namespace App\View\Components;

use App\Models\Partnership;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alianzas extends Component
{

    public $partnerships;

    public function __construct()
    {
        $this->partnerships = Partnership::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alianzas', [
            'partnerships' => $this->partnerships,
        ]);
    }
}
