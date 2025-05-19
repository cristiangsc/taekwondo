<div>
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- News detail -->
            <div class="bg-[#001A41] rounded-lg shadow-lg overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    <img
                        src="{{ $news->getFirstMediaUrl('image') }}"
                        alt="{{ $news->title }}"
                        class="w-full h-[700px] object-fill"
                    >
                </div>
                <div class="p-6 md:p-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-4">{{ $news->title }}</h1>
                    <div class="text-sm text-gray-400 mb-6">
                        {{ $news->created_at->format('d/m/Y') }}
                    </div>
                    <div class="prose prose-lg prose-invert max-w-none text-gray-300">
                        {!! $news->content !!}
                    </div>
                </div>
            </div>

            <!-- Navigation buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('news.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded text-center">
                    Volver al listado de noticias
                </a>
                <a href="{{ route('home') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded text-center">
                    Volver a la página principal
                </a>
            </div>
        </div>
    </div>
</div>
