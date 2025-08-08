<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with title and stats -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl mb-4">Galerías de Imágenes</h1>
                <div class="inline-flex items-center space-x-4 text-gray-300">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        {{ $galleries->total() }} galerías disponibles
                    </span>
                </div>
            </div>

            <!-- Filter/Sort controls -->
            @if($galleries->count() > 0)
                <div class="mb-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-300 font-medium">Ordenar por:</label>
                        <select wire:model.live="sortBy"
                                class="bg-[#001A41] text-white border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="latest">Más recientes</option>
                            <option value="oldest">Más antiguas</option>
                            <option value="name">Nombre A-Z</option>
                            <option value="images_count">Más imágenes</option>
                        </select>
                    </div>

                    <div class="text-gray-300 text-sm">
                        Mostrando {{ $galleries->firstItem() }} - {{ $galleries->lastItem() }} de {{ $galleries->total() }}
                    </div>
                </div>
            @endif

            <!-- Galleries grid -->
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleries as $gallery)
                        <div class="group bg-[#001A41] rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-[1.02]">
                            <!-- Image preview -->
                            <div class="relative aspect-video overflow-hidden">
                                @if($gallery->images_count > 0)
                                    @if($gallery->images_count == 1)
                                        <!-- Single image -->
                                        <img src="{{ $gallery->preview_image->getUrl('thumb') }}"
                                             alt="{{ $gallery->name }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @elseif($gallery->images_count <= 4)
                                        <!-- Mosaic for 2-4 images -->
                                        <div class="grid {{ $gallery->images_count == 2 ? 'grid-cols-2' : 'grid-cols-2' }} h-full gap-0.5">
                                            @foreach($gallery->recent_images as $index => $image)
                                                <div class="{{ $gallery->images_count == 3 && $index == 0 ? 'row-span-2' : '' }}">
                                                    <img src="{{ $image->getUrl('thumb') }}"
                                                         alt="{{ $gallery->name }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                </div>
                                                @if($gallery->images_count == 3 && $index == 0)
                                                    <div class="grid grid-rows-2 gap-0.5">
                                                        @foreach($gallery->recent_images->slice(1, 2) as $image)
                                                            <img src="{{ $image->getUrl('thumb') }}"
                                                                 alt="{{ $gallery->name }}"
                                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                        @endforeach
                                                    </div>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- Grid for 5+ images -->
                                        <div class="grid grid-cols-2 h-full gap-0.5">
                                            <div class="row-span-2">
                                                <img src="{{ $gallery->recent_images->first()->getUrl('thumb') }}"
                                                     alt="{{ $gallery->name }}"
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            </div>
                                            <div class="grid grid-rows-2 gap-0.5">
                                                @foreach($gallery->recent_images->slice(1, 2) as $image)
                                                    <img src="{{ $image->getUrl('thumb') }}"
                                                         alt="{{ $gallery->name }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- More images indicator -->
                                        @if($gallery->images_count > 4)
                                            <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded-full">
                                                +{{ $gallery->images_count - 4 }}
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Hover overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                    <!-- View gallery icon -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="bg-white/90 rounded-full p-3 transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <!-- Empty gallery placeholder -->
                                    <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                        <div class="text-center text-gray-400">
                                            <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-sm">Sin imágenes</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Gallery info -->
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-white mb-3 group-hover:text-orange-400 transition-colors duration-200 line-clamp-2">
                                    <a href="{{ route('gallery.show', $gallery->id) }}" class="block">
                                        {{ $gallery->name }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between text-sm text-gray-400 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $gallery->images_count }} {{ $gallery->images_count == 1 ? 'imagen' : 'imágenes' }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $gallery->created_at->format('d/m/Y') }}
                                    </span>
                                </div>

                                <!-- Action button -->
                                <a href="{{ route('gallery.show', $gallery->id) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg transform hover:scale-[1.02]">
                                    Ver galería
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button (si hay más páginas) -->
                @if($galleries->hasMorePages())
                    <div class="text-center mt-12">
                        <button wire:click="loadMore"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-8 py-3 bg-orange-600 hover:bg-orange-700 disabled:bg-orange-400 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 disabled:cursor-not-allowed">
                            <span wire:loading.remove>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Cargar más galerías
                            </span>
                            <span wire:loading class="flex items-center">
                                <svg class="animate-spin w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Cargando...
                            </span>
                        </button>
                    </div>
                @endif

            @else
                <!-- Empty state -->
                <div class="text-center py-16 bg-[#001A41] rounded-xl">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-2xl font-medium text-gray-300 mb-2">No hay galerías disponibles</h3>
                    <p class="text-gray-400 max-w-md mx-auto">
                        Parece que aún no se han creado galerías de imágenes. Vuelve más tarde para descubrir contenido nuevo.
                    </p>
                </div>
            @endif

            <!-- Back to home link -->
            <div class="mt-12 text-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>
