<section id="noticias" class="relative overflow-hidden" data-section="noticias">
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#000E27] via-[#001133] to-[#000E27]"></div>
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-orange-500/30 to-transparent"></div>

    <div class="relative py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título animado -->
            <div class="text-center mb-12 transform transition-all duration-1000 ease-out" x-data="{ visible: false }" x-intersect="visible = true" :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-100 to-white mb-6 tracking-tight leading-tight">
                    Noticias destacadas
                </h1>
                <div class="w-24 h-1.5 bg-gradient-to-r from-red-500 via-orange-500 to-red-500 mx-auto rounded-full shadow-lg shadow-orange-500/25 animate-pulse"></div>
                <p class="text-gray-400 mt-4 text-lg max-w-2xl mx-auto">
                    Mantente al día con las últimas novedades y acontecimientos más relevantes
                </p>
            </div>

            <!-- Grid de noticias con animaciones escalonadas -->
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @foreach($noticias as $index => $noticia)
                    <div class="group transform transition-all duration-500 ease-out hover:scale-105"
                         x-data="{ visible: false }"
                         x-intersect="setTimeout(() => visible = true, {{ $index * 100 }})"
                         :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-12 opacity-0'">

                        <!-- Contenedor principal con efectos glassmorphism -->
                        <div class="bg-gradient-to-br from-[#001122]/80 to-[#000E16]/90 backdrop-blur-sm rounded-2xl overflow-hidden
                                    border border-white/10 hover:border-orange-500/30
                                    shadow-xl hover:shadow-2xl hover:shadow-orange-500/10
                                    transition-all duration-500 ease-out relative">

                            <!-- Efecto de brillo al hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent
                                        transform -translate-x-full group-hover:translate-x-full
                                        transition-transform duration-1000 ease-out"></div>

                            <!-- Imagen con overlay -->
                            <div class="relative aspect-w-16 aspect-h-9 overflow-hidden">
                                <img src="{{ $noticia->getFirstMediaUrl('image') }}"
                                     alt="{{ $noticia->title }}"
                                     class="w-full h-48 md:h-56 lg:h-48 object-cover
                                            transform transition-transform duration-700 ease-out
                                            group-hover:scale-110"
                                     loading="lazy">

                                <!-- Overlay gradiente -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent
                                            opacity-60 group-hover:opacity-40 transition-opacity duration-300"></div>

                                <!-- Indicador de categoría -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-orange-600/90 backdrop-blur-sm text-white text-xs font-medium
                                                px-3 py-1 rounded-full shadow-lg">
                                        Destacada
                                    </span>
                                </div>

                                <!-- Fecha flotante -->
                                <div class="absolute top-3 right-3">
                                    <span class="bg-black/70 backdrop-blur-sm text-white text-xs font-medium
                                                px-2 py-1 rounded-lg shadow-lg">
                                        {{ $noticia->created_at->format('d/m') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="p-6 relative">
                                <!-- Título con animación -->
                                <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 leading-tight">
                                    <a href="{{ route('news.show', $noticia->slug) }}"
                                       class="hover:text-orange-400 transition-colors duration-300
                                              group-hover:text-transparent group-hover:bg-clip-text
                                              group-hover:bg-gradient-to-r group-hover:from-orange-400 group-hover:to-red-400">
                                        {{ $noticia->title }}
                                    </a>
                                </h3>

                                <!-- Resumen -->
                                <p class="text-gray-300 mb-4 text-sm leading-relaxed line-clamp-3">
                                    {!! Str::limit(strip_tags($noticia->content), 120) !!}
                                </p>

                                <!-- Footer de la tarjeta -->
                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div class="text-xs text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $noticia->created_at->diffForHumans() }}
                                    </div>

                                    <a href="{{ route('news.show', $noticia->slug) }}"
                                       class="inline-flex items-center bg-gradient-to-r from-orange-600 to-red-600
                                              hover:from-orange-700 hover:to-red-700 text-white font-semibold
                                              py-2 px-4 rounded-lg text-sm shadow-lg hover:shadow-xl
                                              transform hover:-translate-y-0.5 transition-all duration-300
                                              group/btn">
                                        Leer más
                                        <svg class="w-4 h-4 ml-1 transform group-hover/btn:translate-x-1 transition-transform duration-300"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón "Ver todas las noticias" mejorado -->
            <div class="mt-12 text-center" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-700 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <a href="{{ route('news.index') }}"
                       class="inline-flex items-center bg-gradient-to-r from-orange-600 via-red-600 to-orange-600
                              hover:from-orange-700 hover:via-red-700 hover:to-orange-700
                              text-white font-bold py-4 px-8 rounded-2xl text-lg
                              shadow-2xl hover:shadow-orange-500/25
                              transform hover:-translate-y-1 hover:scale-105
                              transition-all duration-300 ease-out
                              border border-white/20 hover:border-orange-400/50
                              group relative overflow-hidden">

                        <!-- Efecto de brillo animado -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent
                                    transform -translate-x-full group-hover:translate-x-full
                                    transition-transform duration-1000 ease-out"></div>

                        <span class="relative">Ver todas las noticias</span>

                        <svg class="w-6 h-6 ml-2 transform group-hover:translate-x-2 transition-transform duration-300 relative"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Estilos CSS adicionales (agregar al final del layout o en un archivo CSS separado) -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animación de pulso personalizada */
    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);
        }
        50% {
            box-shadow: 0 0 30px rgba(249, 115, 22, 0.6);
        }
    }

    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite;
    }
</style>
