<?php

namespace App\Livewire;

use App\Models\News;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class NewsDetail extends Component
{
    public $slug;
    public $news;
    public bool $viewRecorded = false;

    public function mount($slug): void
    {
        $this->news = News::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        // Registrar vista cuando se monta el componente
        $this->viewRecorded = $this->news->recordView();
    }

    public function render():Renderable
    {
        return view('livewire.news-detail', [
            'news' => $this->news,
        ]);
    }
}
