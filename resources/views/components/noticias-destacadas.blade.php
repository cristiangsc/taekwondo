<section id="noticias">
    <div class="bg-[#000E27] py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-white dark:text-white pb-10">
                Noticias Destacadas
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6 ">
                @foreach($noticias as $noticia)
                    <div class="bg-[#000E16] rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img
                                src="{{ $noticia->getFirstMediaUrl('image') }}"
                                alt="{{ $noticia->title }}"
                                class="w-full h-48 md:h-56 lg:h-48 object-cover"
                            >
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white mb-2">
                                <a href="{{ route('news.show', $noticia->slug) }}" class="hover:text-orange-400">
                                    {{ $noticia->title }}
                                </a>
                            </h3>
                            <p class="text-gray-300 mb-4 text-justify">
                                {!! Str::limit(strip_tags($noticia->content), 150) !!}
                            </p>
                            <div class="text-sm text-gray-400 mb-4">
                                {{ $noticia->created_at->format('d/m/Y') }}
                            </div>
                            <a href="{{ route('news.show', $noticia->slug) }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-1 px-3 rounded text-sm">
                                Leer más
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('news.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded">
                    Ver todas las noticias
                </a>
            </div>
        </div>
    </div>
</section>
