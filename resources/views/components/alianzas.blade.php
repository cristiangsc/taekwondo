<section id="alianzas" class="relative overflow-hidden" data-section="alianzas">
    <!-- Fondo con gradiente y efectos -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#000E27] via-[#001133] to-[#000E27]"></div>
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-orange-500/10 to-red-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título con animación -->
            <div class="text-center mb-16" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-1000 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text
                               bg-gradient-to-r from-white via-gray-100 to-white mb-6 tracking-tight leading-tight">
                        Nuestras Alianzas
                    </h1>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-red-500 via-orange-500 to-red-500 mx-auto rounded-full
                                shadow-lg shadow-orange-500/25 animate-pulse"></div>
                    <p class="text-gray-400 mt-6 text-lg max-w-3xl mx-auto">
                        Colaboramos con organizaciones líderes para crear sinergias y fortalecer nuestro impacto
                    </p>
                </div>
            </div>

            <!-- Grid de alianzas -->
            <div class="flex flex-wrap justify-center gap-6 lg:gap-8 max-w-6xl mx-auto">
                @foreach($partnerships as $index => $partnership)
                    <div class="w-full sm:w-80 md:w-72 lg:w-64 xl:w-60 group transform transition-all duration-500 ease-out"
                         x-data="{ visible: false, hovered: false }"
                         x-intersect="setTimeout(() => visible = true, {{ $index * 80 }})"
                         @mouseenter="hovered = true"
                         @mouseleave="hovered = false"
                         :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-12 opacity-0'">

                        <!-- Contenedor principal -->
                        <div class="relative bg-white rounded-3xl shadow-lg hover:shadow-2xl overflow-hidden
                                    transition-all duration-500 ease-out transform hover:-translate-y-2 hover:scale-105
                                    border border-gray-100 hover:border-orange-200 h-64 group-hover:shadow-orange-500/20">

                            <!-- Efecto de brillo -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent
                                        transform -translate-x-full group-hover:translate-x-full
                                        transition-transform duration-1000 ease-out z-10"></div>

                            <!-- Indicador de estado online -->
                            <div class="absolute top-4 right-4 z-20">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg"></div>
                            </div>

                            <a href="{{ $partnership->url }}" target="_blank"
                               class="flex flex-col h-full relative group/link">

                                <!-- Contenedor de imagen -->
                                <div class="relative h-36 bg-gradient-to-br from-gray-50 to-gray-100
                                            flex items-center justify-center overflow-hidden">
                                    @if($partnership->getFirstMedia('alianza'))
                                        <img src="{{ $partnership->getFirstMediaUrl('alianza') }}"
                                             alt="{{ $partnership->name }}"
                                             class="w-full h-full object-contain p-4 transform transition-transform duration-500
                                                    group-hover:scale-110 filter group-hover:brightness-110"
                                             loading="lazy">
                                    @else
                                        <!-- Placeholder moderno -->
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="text-sm text-gray-400 font-medium">Logo no disponible</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent
                                                opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>

                                <!-- Contenido inferior -->
                                <div class="flex-1 p-5 flex flex-col justify-between bg-white relative">
                                    <!-- Nombre de la alianza -->
                                    <div class="mb-3">
                                        <h3 class="text-lg font-bold text-gray-800 text-center leading-tight
                                                   group-hover:text-orange-600 transition-colors duration-300 line-clamp-2">
                                            {{ $partnership->name }}
                                        </h3>
                                    </div>

                                    <!-- Footer con botón de acción -->
                                    <div class="text-center">
                                        @if($partnership->url)
                                            <div class="inline-flex items-center justify-center w-full py-2 px-4
                                                        bg-gradient-to-r from-orange-500 to-red-500
                                                        hover:from-orange-600 hover:to-red-600
                                                        text-white font-semibold rounded-xl text-sm
                                                        shadow-lg hover:shadow-xl transition-all duration-300
                                                        transform hover:scale-105 group/btn">
                                                <span class="mr-2">Visitar sitio</span>
                                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300"
                                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center justify-center w-full py-2 px-4
                                                        bg-gray-100 text-gray-400 font-semibold rounded-xl text-sm cursor-not-allowed">
                                                <span>Sin enlace disponible</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>

                            <!-- Borde animado al hover -->
                            <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100
                                        bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 p-[2px]
                                        transition-opacity duration-300 -z-10">
                                <div class="bg-white rounded-3xl w-full h-full"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contador de alianzas y CTA adicional -->
            <div class="mt-16 text-center" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-700 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">

                    <!-- Estadísticas -->
                    <div class="inline-flex items-center justify-center space-x-8 mb-8 p-6
                                bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-orange-500">{{ count($partnerships) }}+</div>
                            <div class="text-sm text-gray-400">Alianzas Estratégicas</div>
                        </div>
                        <div class="w-px h-12 bg-white/20"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-orange-500">100%</div>
                            <div class="text-sm text-gray-400">Confianza Mutua</div>
                        </div>
                    </div>

                    <!-- CTA para nuevas alianzas -->
                    <div class="text-center">
                        <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
                            ¿Interesado en formar parte de nuestra red de alianzas estratégicas?
                        </p>
                        <a href="#contacto"
                           class="inline-flex items-center bg-gradient-to-r from-white to-gray-100
                                  hover:from-gray-100 hover:to-white text-gray-800 font-bold
                                  py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl
                                  transform hover:-translate-y-1 hover:scale-105
                                  transition-all duration-300 ease-out group border border-gray-200
                                  hover:border-orange-300">

                            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <span class="relative">Únete a nosotros</span>

                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Estilos CSS adicionales -->
<style>
    /* Animación de rotación suave para los elementos de fondo */
    @keyframes float-gentle {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(1deg); }
    }

    .animate-float {
        animation: float-gentle 6s ease-in-out infinite;
    }

    /* Efecto de pulsación para el indicador online */
    @keyframes pulse-dot {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-pulse-dot {
        animation: pulse-dot 2s ease-in-out infinite;
    }
</style>
