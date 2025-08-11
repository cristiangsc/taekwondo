<section id="valores" class="scroll-mt-20" data-section="valores">
    <div class="bg-gradient-to-br from-[#EE5E10] via-[#F47B20] to-[#FF8C42] pb-20 pt-16 relative overflow-hidden">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-xl"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-white rounded-full blur-2xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white rounded-full blur-3xl opacity-5"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header mejorado -->
            <div class="text-center mb-16" x-data="{ inView: false }" x-intersect="inView = true">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-6 tracking-tight"
                    x-show="inView"
                    x-transition:enter="transition-all duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    Nuestros Valores
                </h1>

                <div class="flex justify-center mb-6"
                     x-show="inView"
                     x-transition:enter="transition-all duration-800 delay-500"
                     x-transition:enter-start="opacity-0 transform scale-x-0"
                     x-transition:enter-end="opacity-100 transform scale-x-100">
                    <div class="w-32 h-2 bg-gradient-to-r from-white via-yellow-200 to-white rounded-full shadow-lg"></div>
                </div>

                <p class="text-lg sm:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed"
                   x-show="inView"
                   x-transition:enter="transition-all duration-1000 delay-700"
                   x-transition:enter-start="opacity-0 transform translate-y-4"
                   x-transition:enter-end="opacity-100 transform translate-y-0">
                    Los principios fundamentales que guían cada decisión y acción en nuestra organización
                </p>
            </div>

            <!-- Grid de valores con animaciones mejoradas -->
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4
                        bg-gradient-to-br from-[#000E27] via-[#001122] to-[#000A1A]
                        rounded-3xl p-8 shadow-2xl backdrop-blur-sm border border-white/10"
                 x-data="{
                    hoveredIndex: null,
                    show: false
                 }"
                 x-init="setTimeout(() => show = true, 100)"
                 x-intersect="show = true"

            @foreach($valores as $index => $valor)
                <article class="group relative"
                         x-show="show"
                         x-transition:enter="transition-all duration-700 ease-out"
                         x-transition:enter-start="opacity-0 transform translate-y-12 scale-95"
                         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                         style="transition-delay: {{ $index * 150 }}ms"
                         @mouseenter="hoveredIndex = {{ $index }}"
                         @mouseleave="hoveredIndex = null">

                    <!-- Card principal -->
                    <div class="relative bg-gradient-to-br from-slate-800/50 to-slate-900/50
                                   hover:from-orange-800/30 hover:to-red-800/30
                                   backdrop-blur-sm border border-white/10 hover:border-orange-400/30
                                   rounded-2xl p-8 h-full
                                   transition-all duration-500 ease-out
                                   hover:shadow-2xl hover:shadow-orange-500/20
                                   hover:transform hover:scale-[1.02] hover:-translate-y-2
                                   cursor-pointer overflow-hidden">

                        <!-- Efecto de brillo en hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent
                                       transform -translate-x-full group-hover:translate-x-full
                                       transition-transform duration-1000 ease-out"></div>

                        <!-- Ícono mejorado -->
                        <div class="mx-auto mb-6 relative">
                            <div class="h-20 w-20 mx-auto flex items-center justify-center rounded-2xl
                                           bg-gradient-to-br from-blue-400/20 to-cyan-400/20
                                           group-hover:from-orange-400/30 group-hover:to-red-400/30
                                           border border-blue-300/20 group-hover:border-orange-300/40
                                           transition-all duration-500 ease-out
                                           group-hover:scale-110 group-hover:rotate-3
                                           backdrop-blur-sm shadow-lg">
                                <img src="{{ $valor->getFirstMediaUrl('valores') }}"
                                     alt="{{ $valor->valor }}"
                                     class="h-12 w-12 object-contain transition-all duration-500
                                               group-hover:scale-110 group-hover:brightness-110"
                                     loading="lazy">
                            </div>

                            <!-- Pulso animado -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-400/20 to-cyan-400/20
                                           group-hover:from-orange-400/20 group-hover:to-red-400/20
                                           animate-pulse opacity-0 group-hover:opacity-100
                                           transition-opacity duration-500 -z-10"></div>
                        </div>

                        <!-- Título -->
                        <h3 class="text-xl sm:text-2xl font-bold text-white mb-4 text-center
                                      group-hover:text-orange-200 transition-colors duration-300
                                      leading-tight">
                            {{ $valor->valor }}
                        </h3>

                        <!-- Descripción -->
                        <p class="text-gray-300 group-hover:text-gray-200 text-center leading-relaxed
                                     transition-colors duration-300 text-sm sm:text-base">
                            {{ $valor->description }}
                        </p>

                        <!-- Indicador de interactividad -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100
                                       transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                            <div class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Elementos adicionales para UX -->
        <div class="mt-12 text-center">
            <div class="inline-flex items-center gap-2 text-white/70 text-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                </svg>
                Estos valores son el corazón de nuestra cultura organizacional
            </div>
        </div>
    </div>

</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Precargar imágenes para mejor rendimiento
            const images = @json($valores->pluck('media.*.original_url')->flatten());
            images.forEach(src => {
                if (src) {
                    const img = new Image();
                    img.src = src;
                }
            });

            // Implementar lazy loading personalizado si es necesario
            const cards = document.querySelectorAll('[data-valor-card]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => observer.observe(card));
        });
    </script>
@endpush

@push('styles')
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }

        /* Mejoras de accesibilidad */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Optimización para pantallas táctiles */
        @media (hover: none) and (pointer: coarse) {
            .group:hover {
                transform: none !important;
            }
        }
    </style>
@endpush
