    <section id="valores">
        <div class="bg-[#EE5E10] pb-20 pt-10">
            <div class="mx-auto max-w-full">
                <div class="container mx-auto">
                    <h1 class="text-4xl md:text-5xl font-bold text-center text-white dark:text-white pb-4">
                        Nuestros Valores
                    </h1>
                    <div class="mt-6 grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 bg-[#000E27] rounded-lg p-2">
                        @foreach($valores as $valor)
                            <div class="text-center hover:bg-orange-800 transition duration-300 ease-in-out p-6 rounded-lg">
                                <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-50 to-blue-100">
                                    <img
                                        src="{{ $valor->getFirstMediaUrl('valores') }}"
                                        alt="{{ $valor->valor }}"
                                        class="h-20 w-20 object-contain p-2"
                                    >
                                </div>
                                <p class="mt-6 text-xl font-semibold  text-white">
                                    {{ $valor->valor }}
                                </p>
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
