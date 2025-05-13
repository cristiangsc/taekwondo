<?php

namespace App\View\Components;

use App\Models\Valores;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ValoresCard extends Component
{

    public $valores;

    public function __construct()
    {
        $this->valores = Valores::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.valores-card', [
            'valores' => $this->valores
        ]);
    }
}
