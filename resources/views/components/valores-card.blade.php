
    {{-- resources/views/components/valores-card.blade.php --}}
    <div>
        <div class="bg-white py-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-full">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center">
                        Nuestros Valores
                    </h2>

                    <div class="mt-10 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach($valores as $valor)
                            <div class="text-center">
                                <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-blue-100">
                                    <img
                                        src="{{ $valor->getFirstMediaUrl('valores') }}"
                                        alt="{{ $valor->valor }}"
                                        class="h-20 w-20 object-contain p-2"
                                    >
                                </div>
                                <h3 class="mt-6 text-lg font-semibold leading-7 tracking-tight text-gray-900">
                                    {{ $valor->valor }}
                                </h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    {{ $valor->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
