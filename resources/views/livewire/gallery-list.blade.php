<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Galerías de Imágenes</h1>

            <!-- Galleries grid with pagination -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galleries as $gallery)
                <div class="bg-[#001A41] rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        @if($gallery->getMedia('gallery')->count() > 0)
                            <img
                                src="{{ $gallery->getMedia('gallery')->first()->getUrl('thumb') }}"
                                alt="{{ $gallery->name }}"
                                class="w-full h-48 object-cover"
                            >
                        @else
                            <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-400">Sin imágenes</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-2">
                            <a href="{{ route('gallery.show', $gallery->id) }}" class="hover:text-orange-400">
                                {{ $gallery->name }}
                            </a>
                        </h3>
                        <p class="text-gray-300 mb-4">
                            {{ $gallery->getMedia('gallery')->count() }} imágenes
                        </p>
                        <div class="text-sm text-gray-400">
                            {{ $gallery->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty state -->
            @if($galleries->isEmpty())
            <div class="text-center py-12">
                <p class="text-xl text-gray-300">No hay galerías disponibles.</p>
            </div>
            @endif

            <!-- Pagination -->
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>

            <!-- Back to home link -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                    Volver a la página principal
                </a>
            </div>
        </div>
    </div>
</div>
