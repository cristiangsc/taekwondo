<section id="gallery">
    <div class="bg-[#000E27] py-8 pb-12 relative z-0">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Galería de
                Imágenes</h2>
            @if($images->isNotEmpty())
                <div class="grid grid-cols-3 gap-3">
                    {{-- Imagen principal --}}
                    <div class="col-span-2 row-span-2 relative overflow-hidden">
                        <img src="{{ $images[0]->getUrl() }}"
                             alt="Imagen de galería"
                             class="w-full h-[462px] object-cover object-top rounded-lg shadow-lg transition-all duration-300 hover:scale-105"
                             loading="lazy">
                    </div>

                    {{-- Imágenes secundarias --}}
                    <div class="grid gap-3">
                        @foreach($images->skip(1)->take(2) as $image)
                            <div class="relative overflow-hidden">
                                <img src="{{ $image->getUrl() }}"
                                     alt="Imagen de galería"
                                     class="w-full h-[225px] object-cover object-top rounded-lg shadow-md transition-all duration-300 hover:scale-105"
                                     loading="lazy">
                            </div>
                        @endforeach
                    </div>

                    {{-- Imágenes inferiores --}}
                    <div class="col-span-3 grid grid-cols-2 gap-3">
                        @foreach($images->skip(3)->take(2) as $image)
                            <div class="relative overflow-hidden">
                                <img src="{{ $image->getUrl() }}"
                                     alt="Imagen de galería"
                                     class="w-full h-80 object-cover object-top rounded-lg shadow-md transition-all duration-300 hover:scale-105"
                                     loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    No hay imágenes disponibles en la galería
                </div>
            @endif
        </div>
    </div>
</section>
