<div x-data="galleryLightbox({{ $allImages->toJson() }})"
     x-on:keydown.escape.window="closeLightbox()"
     x-on:keydown.arrow-left.window="previousImage()"
     x-on:keydown.arrow-right.window="nextImage()">

    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl mb-4">{{ $gallery->name }}</h1>
                <div class="inline-flex items-center space-x-4 text-gray-300">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                       {{ $allImages->count() }} imágenes
                    </span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Creada el {{ $gallery->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <!-- Images grid -->
            @if($images->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                    @foreach($images as $index => $image)
                        <div class="group relative aspect-square cursor-pointer"
                            @click="openLightbox({{ $allImages->search(fn($img) => $img['id'] === $image->id) }})">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 rounded-lg"></div>
                            <img
                                src="{{ $image->getUrl('thumb') }}"
                                alt="{{ $gallery->name }} - Imagen {{ $loop->iteration }}"
                                class="w-full h-full object-cover rounded-lg shadow-md group-hover:shadow-xl group-hover:scale-105 transition-all duration-300"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                                <div class="bg-white/90 rounded-full p-2">
                                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button (si hay más páginas) -->
                @if($hasMore)
                    <div class="text-center mt-8">
                        <button wire:click="loadMore"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                            <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span wire:loading.remove>Cargar más imágenes</span>
                            <span wire:loading>
                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                Cargando...
            </span>
                        </button>
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-[#001A41] rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-300 mb-2">No hay imágenes</h3>
                    <p class="text-gray-400">Esta galería no contiene imágenes.</p>
                </div>
            @endif

            <!-- Navigation buttons -->
            <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('gallery.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a galerías
                </a>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Inicio
                </a>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
         style="display: none;"
         @click="closeLightbox()">

        <!-- Close button -->
        <button @click="closeLightbox()"
                class="absolute top-4 right-4 z-60 text-white hover:text-gray-300 transition-colors duration-200">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Previous button -->
        <button x-show="canGoPrevious()"
                @click.stop="previousImage()"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 z-60 text-white hover:text-gray-300 transition-all duration-200 bg-black/50 rounded-full p-2 hover:bg-black/70">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Next button -->
        <button x-show="canGoNext()"
                @click.stop="nextImage()"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 z-60 text-white hover:text-gray-300 transition-all duration-200 bg-black/50 rounded-full p-2 hover:bg-black/70">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>

        </button>

        <!-- Image container -->
        <div class="relative max-w-7xl max-h-full mx-4" @click.stop>
            <img x-show="currentImage"
                 :src="currentImage?.full"
                 :alt="currentImage?.alt"
                 class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">

            <!-- Image info -->
            <div class="absolute bottom-4 left-4 right-4 text-center">
                <div class="bg-black/70 text-white px-4 py-2 rounded-lg inline-block">
                    <span x-text="currentImage?.alt"></span>
                    <span class="mx-2">•</span>
                    <span x-text="`${currentIndex + 1} de ${images.length}`"></span>
                </div>
            </div>
        </div>

        <!-- Thumbnails strip -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 max-w-full overflow-x-auto">
            <div class="flex space-x-2 px-4">
                <template x-for="(img, index) in images" :key="img.id">
                    <button @click.stop="currentIndex = index"
                            :class="currentIndex === index ? 'ring-2 ring-orange-500' : 'ring-1 ring-white/30'"
                            class="flex-shrink-0 w-16 h-16 rounded overflow-hidden transition-all duration-200 hover:ring-2 hover:ring-orange-300">
                        <img :src="img.thumb" :alt="img.alt" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <script>
        function galleryLightbox(images) {
            return {
                images: images,
                isOpen: false,
                currentIndex: 0,

                get currentImage() {
                    return this.images[this.currentIndex] || null;
                },

                openLightbox(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeLightbox() {
                    this.isOpen = false;
                    document.body.style.overflow = 'auto';
                },

                nextImage() {
                    if (this.canGoNext()) {
                        this.currentIndex++;
                    }
                },

                previousImage() {
                    if (this.canGoPrevious()) {
                        this.currentIndex--;
                    }
                },

                canGoNext() {
                    return this.currentIndex < this.images.length - 1;
                },

                canGoPrevious() {
                    return this.currentIndex > 0;
                }
            }
        }
    </script>
</div>
