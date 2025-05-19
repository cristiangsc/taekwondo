<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Noticias</h1>

            @if($latestNews)
            <!-- Banner with latest news -->
            <div class="mb-12 bg-[#001A41] rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img
                            src="{{ $latestNews->getFirstMediaUrl('image') }}"
                            alt="{{ $latestNews->title }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">{{ $latestNews->title }}</h2>
                            <p class="text-gray-300 mb-4">
                                {!! Str::limit(strip_tags($latestNews->content), 500) !!}
                            </p>
                        </div>
                        <div class="mt-4">
                            <div class="text-sm text-gray-400 mb-4">
                                {{ $latestNews->created_at->format('d/m/Y') }}
                            </div>
                            <a href="{{ route('news.show', $latestNews->slug) }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded">
                                Leer más
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- News grid with pagination -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($news as $item)
                <div class="bg-[#001A41] rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        <img
                            src="{{ $item->getFirstMediaUrl('image') }}"
                            alt="{{ $item->title }}"
                            class="w-full h-48 object-cover"
                        >
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-2">
                            <a href="{{ route('news.show', $item->slug) }}" class="hover:text-orange-400">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <p class="text-gray-300 mb-4">
                            {!! Str::limit(strip_tags($item->content), 150) !!}
                        </p>
                        <div class="text-sm text-gray-400">
                            {{ $item->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $news->links() }}
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
