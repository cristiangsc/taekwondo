<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Nuestras Alianzas</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($partnerships as $partnership)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <a href="{{ $partnership->url }}" target="_blank" class="block">
                    @if($partnership->getFirstMedia('alianza'))
                        <img
                            src="{{ $partnership->getFirstMedia('alianza')->getUrl() }}"
                            alt="{{ $partnership->name }}"
                            class="w-full h-32 object-cover"
                        >
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $partnership->name }}</h3>
                        @if($partnership->url)
                            <p class="text-sm text-blue-600 mt-2 hover:underline">
                                Visitar sitio web
                            </p>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
