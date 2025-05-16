<?php

namespace App\View\Components;

use App\Models\Testimonial;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonials extends Component
{
    /**
     * The testimonials collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $testimonials;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get approved testimonials with their student relationship
        $this->testimonials = Testimonial::with('student')
            ->approved()
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($testimonial) {
                return [
                    'content' => $testimonial->content,
                    'student' => $testimonial->student ? [
                        'full_name' => $testimonial->student->full_name,
                        'grade' => $testimonial->student->grade ? $testimonial->student->grade->name : null,
                        'avatar' => $testimonial->student->getFirstMediaUrl('avatars') ?: null,
                    ] : null,
                ];
            });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.testimonials', [
            'testimonials' => $this->testimonials,
        ]);
    }
}
