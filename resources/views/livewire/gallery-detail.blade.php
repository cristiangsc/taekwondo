<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">{{ $gallery->name }}</h1>

            <!-- Gallery info -->
            <div class="text-center mb-8">
                <p class="text-gray-300">
                    {{ $images->count() }} imágenes • Creada el {{ $gallery->created_at->format('d/m/Y') }}
                </p>
            </div>

            <!-- Images grid -->
            @if($images->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($images as $image)
                    <div class="bg-[#001A41] rounded-lg shadow-lg overflow-hidden">
                        <a href="{{ $image->getUrl() }}" target="_blank" class="block">
                            <img
                                src="{{ $image->getUrl('thumb') }}"
                                alt="{{ $gallery->name }} - Imagen {{ $loop->iteration }}"
                                class="w-full h-64 object-cover hover:opacity-80 transition-opacity"
                            >
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-[#001A41] rounded-lg">
                    <p class="text-xl text-gray-300">Esta galería no contiene imágenes.</p>
                </div>
            @endif

            <!-- Navigation buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('gallery.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded text-center">
                    Volver al listado de galerías
                </a>
                <a href="{{ route('home') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded text-center">
                    Volver a la página principal
                </a>
            </div>
        </div>
    </div>
</div>
