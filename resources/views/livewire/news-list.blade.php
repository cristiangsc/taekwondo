<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header con animación -->
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-white pb-4 animate-fade-in">
                    Noticias
                </h1>
                <div class="w-24 h-1 bg-orange-600 mx-auto rounded-full"></div>
            </div>

            <!-- Filtros y búsqueda -->
            <div class="mb-8 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Buscar noticias..."
                            class="w-full px-4 py-2 pl-10 bg-[#000E16] border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <div wire:loading wire:target="search" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <div class="animate-spin rounded-full h-4 w-4 border-2 border-orange-500 border-t-transparent"></div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select wire:model.live="sortBy" class="px-3 py-2 bg-[#000E16] border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="created_at">Más recientes</option>
                        <option value="title">Alfabético</option>
                    </select>
                    <select wire:model.live="perPage" class="px-3 py-2 bg-[#000E16] border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="6">6 por página</option>
                        <option value="9">9 por página</option>
                        <option value="12">12 por página</option>
                    </select>
                </div>
            </div>

            <!-- Loading state para búsquedas -->
            <div wire:loading.delay wire:target="search,sortBy,perPage" class="mb-4">
                <div class="bg-[#000E16] rounded-lg p-4">
                    <div class="flex items-center justify-center text-gray-400">
                        <div class="animate-spin rounded-full h-6 w-6 border-2 border-orange-500 border-t-transparent mr-3"></div>
                        Cargando noticias...
                    </div>
                </div>
            </div>

            @if($latestNews && !$search)
                <!-- Banner with latest news - Mejorado -->
                <div class="mb-12 bg-gradient-to-r from-[#000E16] to-[#001122] rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                    <div class="md:flex">
                        <div class="md:w-1/2 relative overflow-hidden group">
                            <img
                                src="{{ $latestNews->getFirstMediaUrl('image') }}"
                                alt="{{ $latestNews->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                loading="lazy"
                            >
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold animate-pulse">
                                    DESTACADO
                                </span>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-between">
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 hover:text-orange-400 transition-colors duration-300">
                                    {{ $latestNews->title }}
                                </h2>
                                <p class="text-gray-300 mb-4 text-justify leading-relaxed">
                                    {!! Str::limit(strip_tags($latestNews->content), 500) !!}
                                </p>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm text-gray-400 mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $latestNews->created_at->format('d/m/Y') }}
                                    @if($latestNews->views ?? false)
                                        <span class="ml-4 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($latestNews->views) }} vistas
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('news.show', $latestNews->slug) }}"
                                   class="group inline-flex items-center bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                    Leer más
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contador de resultados -->
            @if($search)
                <div class="mb-6 text-gray-400">
                    <p>{{ $news->total() }} resultado(s) encontrado(s) para "<span class="text-orange-400 font-semibold">{{ $search }}</span>"</p>
                </div>
            @endif

            <!-- News grid with pagination - Mejorado -->
            @if($news->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class.delay="opacity-50">
                    @foreach($news as $index => $item)
                        <article class="bg-gradient-to-br from-[#000E16] to-[#001122] rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl group animate-fade-in-up"
                                 style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="relative overflow-hidden">
                                <div class="aspect-w-16 aspect-h-9">
                                    <img
                                        src="{{ $item->getFirstMediaUrl('image') }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 md:h-56 lg:h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-3 line-clamp-2">
                                    <a href="{{ route('news.show', $item->slug) }}"
                                       class="hover:text-orange-400 transition-colors duration-300"
                                      >
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-300 mb-4 text-justify leading-relaxed line-clamp-3">
                                    {!! Str::limit(strip_tags($item->content), 150) !!}
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                    @if($item->views ?? false)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($item->views ?? 0) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Botón de acción -->
                                <div class="mt-4 pt-4 border-t border-gray-700">
                                    <a href="{{ route('news.show', $item->slug) }}"
                                       class="group inline-flex items-center text-orange-400 hover:text-orange-300 font-medium transition-colors duration-300">
                                        Leer artículo completo
                                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-3">No hay noticias disponibles</h3>
                        <p class="text-gray-400 mb-6">
                            @if($search)
                                No encontramos noticias que coincidan con tu búsqueda.
                            @else
                                Parece que aún no hay noticias publicadas.
                            @endif
                        </p>
                        @if($search)
                            <button wire:click="$set('search', '')"
                                    class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                Limpiar búsqueda
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Pagination mejorada -->
            @if($news->hasPages())
                <div class="mt-12">
                    <div class="flex justify-center">
                        {{ $news->links() }}
                    </div>
                </div>
            @endif

            <!-- Back to home link mejorado -->
            <div class="mt-12 text-center">
                <a href="{{ route('home') }}"
                   class="group inline-flex items-center bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Volver a la página principal
                </a>
            </div>
        </div>
    </div>

    <!-- Estilos CSS personalizados -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out both;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
