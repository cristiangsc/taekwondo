<section id="gallery" data-section="gallery">
    <div class="bg-[#000E27] py-8 pb-12 relative z-0">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r text-white mb-6 tracking-tight">
                Galería de Imágenes Recientes
            </h1>
            <div class="w-24 h-1.5 bg-gradient-to-r from-red-500 to-orange-500 mx-auto rounded-full mb-8"></div>

            @if($images->isNotEmpty() && $gallery)
                <!-- Indicador de galería actual -->
                <div class="text-center mb-6">
                    <span class="inline-block bg-orange-600/20 text-orange-300 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $gallery->title ?? 'Galería más reciente' }} • {{ $images->count() }} imágenes
                    </span>
                </div>

                <!-- Grid responsivo mejorado -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4">
                    {{-- Imagen principal --}}
                    <div class="md:col-span-2 md:row-span-2 relative overflow-hidden group">
                        <a href="{{ route('gallery.show', $gallery->id) }}" class="block relative">
                            <img src="{{ $images[0]->getUrl() }}"
                                 alt="{{ $gallery->title ?? 'Imagen principal de galería' }}"
                                 class="w-full h-[300px] md:h-[462px] object-cover object-top rounded-lg shadow-lg transition-all duration-500 group-hover:scale-105"
                                 loading="lazy">
                            <!-- Overlay con efecto hover -->
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 rounded-lg flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <!-- Badge de imagen principal -->
                        <div class="absolute top-3 left-3 bg-orange-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                            Destacada
                        </div>
                    </div>

                    {{-- Imágenes secundarias --}}
                    @if($images->count() > 1)
                        <div class="grid gap-3 md:gap-3">
                            @foreach($images->skip(1)->take(2) as $index => $image)
                                <div class="relative overflow-hidden group">
                                    <a href="{{ route('gallery.show', $gallery->id) }}" class="block relative">
                                        <img src="{{ $image->getUrl() }}"
                                             alt="Imagen {{ $index + 2 }} de galería"
                                             class="w-full h-[180px] md:h-[225px] object-cover object-top rounded-lg shadow-md transition-all duration-500 group-hover:scale-105"
                                             loading="lazy">
                                        <!-- Overlay secundario -->
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 rounded-lg"></div>
                                    </a>
                                </div>
                            @endforeach

                            <!-- Indicador de más imágenes si hay más de 3 -->
                            @if($images->count() > 3)
                                <div class="md:hidden relative overflow-hidden group">
                                    <a href="{{ route('gallery.show', $gallery->id) }}" class="block relative">
                                        <div class="w-full h-[180px] bg-gradient-to-br from-orange-600 to-orange-800 rounded-lg shadow-md flex items-center justify-center transition-all duration-300 group-hover:scale-105">
                                            <div class="text-center text-white">
                                                <div class="text-2xl font-bold">+{{ $images->count() - 3 }}</div>
                                                <div class="text-sm opacity-90">más imágenes</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Imágenes inferiores (solo en desktop) --}}
                    @if($images->count() > 3)
                        <div class="hidden md:block md:col-span-3">
                            <div class="grid grid-cols-2 gap-3 md:gap-4">
                                @foreach($images->skip(3)->take(2) as $index => $image)
                                    <div class="relative overflow-hidden group">
                                        <a href="{{ route('gallery.show', $gallery->id) }}" class="block relative">
                                            <img src="{{ $image->getUrl() }}"
                                                 alt="Imagen {{ $index + 4 }} de galería"
                                                 class="w-full h-64 md:h-80 object-cover object-top rounded-lg shadow-md transition-all duration-500 group-hover:scale-105"
                                                 loading="lazy">
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 rounded-lg"></div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Mostrar indicador si hay más de 5 imágenes -->
                            @if($images->count() > 5)
                                <div class="text-center mt-4">
                                    <span class="text-orange-300 text-sm">
                                        Y {{ $images->count() - 5 }} imágenes más...
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Botones de acción mejorados -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('gallery.show', $gallery->id) }}"
                       class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Ver galería completa
                    </a>

                    <a href="{{ route('gallery.index') }}"
                       class="inline-flex items-center bg-transparent border-2 border-gray-400 hover:border-white text-gray-300 hover:text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 hover:bg-white/5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Todas las galerías
                    </a>
                </div>

            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-700 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">No hay imágenes disponibles</h3>
                    <p class="text-gray-400 mb-6">Aún no se han subido imágenes a la galería</p>
                    <a href="{{ route('gallery.index') }}"
                       class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Explorar otras galerías
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
