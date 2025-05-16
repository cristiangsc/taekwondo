<section id="alianzas">
    <div class="bg-[#000E27] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Nuestras Alianzas</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                @foreach($partnerships as $partnership)
                    <div
                        class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl h-[200px]">
                        <a href="{{ $partnership->url }}" target="_blank" class="flex flex-col h-full">
                            @if($partnership->getFirstMedia('alianza'))
                                <img
                                    src="{{ $partnership->getFirstMediaUrl('alianza') }}"
                                    alt="{{ $partnership->name }}"
                                    class="w-full h-28 object-center object-contain"
                                >
                            @else
                                <div class="w-full h-28 bg-gray-200 flex items-center justify-center text-gray-500">
                                    Sin imagen
                                </div>
                            @endif
                            <div class="p-4 flex flex-col flex-grow justify-between text-center">
                                <h3 class="text-base font-semibold text-gray-800 truncate">{{ $partnership->name }}</h3>
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
    </div>
</section>
