<div>
    <div x-data="{
    activeSlide: 0,
    slides: {{ count($slides) }},
    autoplay: 5000,
    init() {
        if (this.slides > 1) {
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides
            }, this.autoplay)
        }
    }
}" class="relative w-full">
        <div class="relative h-64 overflow-hidden rounded-lg md:h-[500px]">
            @foreach ($slides as $index => $slide)
                <div
                    x-show="activeSlide === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform -translate-x-full"
                    class="absolute top-0 left-0 w-full h-full"
                    style="display: {{ $index == 0 ? 'block' : 'none' }};"
                >
                    <img
                        src="{{ $slide->getFirstMediaUrl('carrusel') }}"
                        class="absolute block w-full h-full object-cover object-center"
                        alt="{{ $slide->title }}"
                    >
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40">
                        <div class="text-center px-4 py-6">
                            <h3 class="text-white text-3xl md:text-4xl font-bold tracking-wider">
                                {{ $slide->title }}
                            </h3>
                            @if($slide->subtitle)
                                <p class="text-white/90 mt-4 text-lg md:text-xl max-w-3xl mx-auto">
                                    {{ $slide->subtitle }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($slides) > 1)
            <!-- Controles de navegación -->
            <button
                @click="activeSlide = activeSlide === 0 ? {{ count($slides) - 1 }} : activeSlide - 1"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-r-lg p-2 text-white transition-colors duration-300"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <button
                @click="activeSlide = activeSlide === {{ count($slides) - 1 }} ? 0 : activeSlide + 1"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-l-lg p-2 text-white transition-colors duration-300"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <!-- Indicadores -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach ($slides as $index => $slide)
                    <button
                        @click="activeSlide = {{ $index }}"
                        :class="{'bg-white': activeSlide === {{ $index }}, 'bg-white/50': activeSlide !== {{ $index }}}"
                        class="w-3 h-3 rounded-full transition-all duration-300"
                    ></button>
                @endforeach
            </div>
        @endif
    </div>
</div>
