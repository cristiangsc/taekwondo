<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Faq extends Component
{
    /**
     * The frequently asked questions.
     *
     * @var array
     */
    public $faqs;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // For now, we'll hardcode the FAQs, but in the future, these could come from a database
        $this->faqs = \App\Models\Faq::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faq', [
            'faqs' => $this->faqs,
        ]);
    }
}
