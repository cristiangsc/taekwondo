<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;

    public function render()
    {
        // Get the latest news for the banner
        $latestNews = News::latest()->first();

        // Get all news with pagination, excluding the latest one
        $news = News::latest()
            ->when($latestNews, function($query) use ($latestNews) {
                return $query->where('id', '!=', $latestNews->id);
            })
            ->paginate(9);

        return view('livewire.news-list', [
            'latestNews' => $latestNews,
            'news' => $news,
        ]);
    }
}
