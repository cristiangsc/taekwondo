    <section id="valores">
        <div class="bg-[#EE5E10] py-6">
            <div class="mx-auto max-w-full">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center">
                        Nuestros Valores
                    </h2>
                    <div
                        class="mt-6 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 bg-[#000E27] rounded-lg p-6">
                        @foreach($valores as $valor)
                            <div class="text-center">
                                <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-blue-100">
                                    <img
                                        src="{{ $valor->getFirstMediaUrl('valores') }}"
                                        alt="{{ $valor->valor }}"
                                        class="h-20 w-20 object-contain p-2"
                                    >
                                </div>
                                <h3 class="mt-6 text-lg font-semibold leading-7 tracking-tight text-white">
                                    {{ $valor->valor }}
                                </h3>
                                <p class="mt-2 text-base leading-7 text-gray-300">
                                    {{ $valor->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
