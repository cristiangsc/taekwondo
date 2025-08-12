<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class NewsList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url]
    public string $sortBy = 'created_at';

    #[Url]
    public int $perPage = 9;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'sortBy' => ['except' => 'created_at'],
        'perPage' => ['except' => 9],
    ];

    public function mount()
    {
        // Inicialización si es necesaria
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        // Obtener la noticia más reciente para el banner (solo si no hay búsqueda)
        $latestNews = null;
        if (empty($this->search)) {
            $latestNews = News::where('published', true)
                ->latest('created_at')
                ->first();
        }

        // Construir la consulta de noticias
        $query = News::where('published', true);

        // Aplicar búsqueda si existe
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        // Excluir la noticia del banner de la lista principal
        if ($latestNews && empty($this->search)) {
            $query->where('id', '!=', $latestNews->id);
        }

        // Aplicar ordenamiento
        switch ($this->sortBy) {
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'views':
                $query->orderBy('views', 'desc');
                break;
            case 'created_at':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginar resultados
        $news = $query->paginate($this->perPage);

        return view('livewire.news-list', [
            'latestNews' => $latestNews,
            'news' => $news,
        ]);
    }

    // Método para limpiar todos los filtros
    public function clearFilters(): void
    {
        $this->search = '';
        $this->sortBy = 'created_at';
        $this->perPage = 9;
        $this->resetPage();
    }

}
