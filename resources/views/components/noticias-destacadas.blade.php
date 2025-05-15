    <div class="bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mb-8">Noticias Destacadas</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($noticias as $noticia)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <img
                                src="{{ $noticia->getFirstMediaUrl('image') }}"
                                alt="{{ $noticia->title }}"
                                class="w-full h-48 object-cover"
                            >
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $noticia->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                {!! Str::limit(strip_tags($noticia->content), 150) !!}
                            </p>
                            <div class="text-sm text-gray-500">
                                {{ $noticia->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

