<?php

namespace App\Livewire;

use App\Models\News;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class NewsDetail extends Component
{
    public $slug;
    public $news;

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->news = News::where('slug', $slug)->firstOrFail();
    }

    public function render():Renderable
    {
        return view('livewire.news-detail', [
            'news' => $this->news,
        ]);
    }
}
