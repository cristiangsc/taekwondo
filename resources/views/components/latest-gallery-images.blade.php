<section id="gallery">
    <div class="bg-[#000E27] py-8 pb-12 relative z-0">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Galería de
                Imágenes</h2>
            @if($images->isNotEmpty() && $gallery)
                <div class="grid grid-cols-3 gap-3">
                    {{-- Imagen principal --}}
                    <div class="col-span-2 row-span-2 relative overflow-hidden">
                        <a href="{{ route('gallery.show', $gallery->id) }}" class="block">
                            <img src="{{ $images[0]->getUrl() }}"
                                alt="Imagen de galería"
                                class="w-full h-[462px] object-cover object-top rounded-lg shadow-lg transition-all duration-300 hover:scale-105"
                                loading="lazy">
                        </a>
                    </div>

                    {{-- Imágenes secundarias --}}
                    <div class="grid gap-3">
                        @foreach($images->skip(1)->take(2) as $image)
                            <div class="relative overflow-hidden">
                                <a href="{{ route('gallery.show', $gallery->id) }}" class="block">
                                    <img src="{{ $image->getUrl() }}"
                                        alt="Imagen de galería"
                                        class="w-full h-[225px] object-cover object-top rounded-lg shadow-md transition-all duration-300 hover:scale-105"
                                        loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Imágenes inferiores --}}
                    <div class="col-span-3 grid grid-cols-2 gap-3">
                        @foreach($images->skip(3)->take(2) as $image)
                            <div class="relative overflow-hidden">
                                <a href="{{ route('gallery.show', $gallery->id) }}" class="block">
                                    <img src="{{ $image->getUrl() }}"
                                        alt="Imagen de galería"
                                        class="w-full h-80 object-cover object-top rounded-lg shadow-md transition-all duration-300 hover:scale-105"
                                        loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('gallery.show', $gallery->id) }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded mr-2">
                        Ver galería completa
                    </a>
                    <a href="{{ route('gallery.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                        Ver todas las galerías
                    </a>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    No hay imágenes disponibles en la galería
                </div>
            @endif
        </div>
    </div>
</section>
