<div class="bg-gradient-to-br from-[#000E27] via-[#001230] to-[#000E27] min-h-screen py-16"
     x-data="{
         selectedSection: '{{ $selectedSection }}',
         isVisible: false,
         observer: null,
         isTransitioning: false
     }"
     x-init="
         observer = new IntersectionObserver((entries) => {
             entries.forEach(entry => {
                 if (entry.isIntersecting) {
                     isVisible = true;
                 }
             });
         }, { threshold: 0.1 });
         observer.observe($el);

         // Escuchar cambios de Livewire con transición suave
         $wire.on('section-changed', (data) => {
             isTransitioning = true;
             setTimeout(() => {
                 selectedSection = data[0].section;
                 setTimeout(() => {
                     isTransitioning = false;
                 }, 50);
             }, 200);
         });
     ">

    <!-- Título Principal con animación -->
    <div class="container mx-auto px-4 mb-16"
         x-show="isVisible"
         x-transition:enter="transition ease-out duration-1000 delay-200"
         x-transition:enter-start="opacity-0 transform -translate-y-8"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <h1 class="text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-orange-400 mb-6 tracking-tight">
            Sobre la Escuela
        </h1>
        <div class="w-24 h-1.5 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
    </div>

    <!-- Navegación por pestañas -->
    <div class="container mx-auto px-4 mb-12"
         x-show="isVisible"
         x-transition:enter="transition ease-out duration-1000 delay-400"
         x-transition:enter-start="opacity-0 transform translate-y-8"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button wire:click="selectSection('history')"
                    class="px-8 py-4 rounded-full font-semibold transition-all duration-500 transform hover:scale-105 shadow-lg"
                    :class="selectedSection === 'history' ?
                        'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-blue-500/30 scale-105' :
                        'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10'">
                <i class="fas fa-clock mr-2"></i> Historia
            </button>
            <button wire:click="selectSection('mission')"
                    class="px-8 py-4 rounded-full font-semibold transition-all duration-500 transform hover:scale-105 shadow-lg"
                    :class="selectedSection === 'mission' ?
                        'bg-gradient-to-r from-orange-600 to-orange-700 text-white shadow-orange-500/30 scale-105' :
                        'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10'">
                <i class="fas fa-bolt mr-2"></i> Misión
            </button>
            <button wire:click="selectSection('vision')"
                    class="px-8 py-4 rounded-full font-semibold transition-all duration-500 transform hover:scale-105 shadow-lg"
                    :class="selectedSection === 'vision' ?
                        'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-purple-500/30 scale-105' :
                        'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10'">
                <i class="fas fa-eye mr-2"></i> Visión
            </button>
        </div>
    </div>

    <!-- Contenedor del contenido con posición fija -->
    <div class="container mx-auto px-4"
         x-show="isVisible"
         x-transition:enter="transition ease-out duration-1000 delay-600"
         x-transition:enter-start="opacity-0 transform translate-y-8"
         x-transition:enter-end="opacity-100 transform translate-y-0">

        <!-- Contenedor con altura fija para evitar saltos -->
        <div class="relative min-h-[500px] md:min-h-[400px]"
             wire:loading.class="opacity-50 pointer-events-none"
             :class="isTransitioning ? 'opacity-50 pointer-events-none' : ''"
             class="transition-opacity duration-300">

            <!-- Historia -->
            <div x-show="selectedSection === 'history'"
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0 transform translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0 bg-gradient-to-br from-blue-900/40 to-blue-800/20 backdrop-blur-sm rounded-2xl border border-blue-500/20 shadow-2xl overflow-hidden">

                <div class="flex flex-col md:flex-row h-full">
                    <!-- Imagen representativa -->
                    <div class="w-full md:w-1/3 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/80 to-blue-900/80 z-10"></div>
                        <img
                            src="{{asset('images/historia.jpg')}}"
                            alt="Historia de la escuela"
                            class="w-full h-64 md:h-full object-cover">
                        <div
                            class="absolute inset-0 z-20 flex items-center justify-center md:items-end md:justify-start md:p-8">
                            <div class="text-center md:text-left">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 mx-auto md:mx-0 mb-4 w-fit">
                                    <i class="fas fa-clock text-4xl text-white"></i>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Nuestra Historia</h2>
                                <p class="text-blue-100 opacity-90 hidden md:block">El camino que nos trajo hasta
                                    aquí</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="flex-1 p-6 md:p-8 flex items-center">
                        <div class="prose-content text-white/90 leading-relaxed w-full">
                            @if($aboutMe->history)
                                {!! $aboutMe->history !!}
                            @else
                                <div class="text-center text-white/60 py-8">
                                    <i class="fas fa-info-circle text-3xl mb-4 opacity-50"></i>
                                    <p>No hay información disponible sobre la historia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Misión -->
            <div x-show="selectedSection === 'mission'"
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0 transform translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0 bg-gradient-to-br from-orange-900/40 to-orange-800/20 backdrop-blur-sm rounded-2xl border border-orange-500/20 shadow-2xl overflow-hidden">

                <div class="flex flex-col md:flex-row h-full">
                    <!-- Imagen representativa -->
                    <div class="w-full md:w-1/3 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/80 to-orange-900/80 z-10"></div>
                        <img
                            src="{{asset('images/mision.jpg')}}"
                            alt="Misión de la escuela"
                            class="w-full h-64 md:h-full object-cover">
                        <div
                            class="absolute inset-0 z-20 flex items-center justify-center md:items-end md:justify-start md:p-8">
                            <div class="text-center md:text-left">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 mx-auto md:mx-0 mb-4 w-fit">
                                    <i class="fas fa-bolt text-4xl text-white"></i>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Nuestra Misión</h2>
                                <p class="text-orange-100 opacity-90 hidden md:block">Lo que nos impulsa cada día</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="flex-1 p-6 md:p-8 flex items-center">
                        <div class="prose-content text-white/90 leading-relaxed w-full">
                            @if($aboutMe->mission)
                                {!! $aboutMe->mission !!}
                            @else
                                <div class="text-center text-white/60 py-8">
                                    <i class="fas fa-info-circle text-3xl mb-4 opacity-50"></i>
                                    <p>No hay información disponible sobre la misión.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visión -->
            <div x-show="selectedSection === 'vision'"
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0 transform translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute inset-0 bg-gradient-to-br from-purple-900/40 to-purple-800/20 backdrop-blur-sm rounded-2xl border border-purple-500/20 shadow-2xl overflow-hidden">

                <div class="flex flex-col md:flex-row h-full">
                    <!-- Imagen representativa -->
                    <div class="w-full md:w-1/3 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/80 to-purple-900/80 z-10"></div>
                        <img
                            src="{{asset('images/vision.jpg')}}"
                            alt="Visión de la escuela"
                            class="w-full h-64 md:h-full object-cover">
                        <div
                            class="absolute inset-0 z-20 flex items-center justify-center md:items-end md:justify-start md:p-8">
                            <div class="text-center md:text-left">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-4 mx-auto md:mx-0 mb-4 w-fit">
                                    <i class="fas fa-eye text-4xl text-white"></i>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">Nuestra Visión</h2>
                                <p class="text-purple-100 opacity-90 hidden md:block">Hacia dónde nos dirigimos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="flex-1 p-6 md:p-8 flex items-center">
                        <div class="prose-content text-white/90 leading-relaxed w-full">
                            @if($aboutMe->vision)
                                {!! $aboutMe->vision !!}
                            @else
                                <div class="text-center text-white/60 py-8">
                                    <i class="fas fa-info-circle text-3xl mb-4 opacity-50"></i>
                                    <p>No hay información disponible sobre la visión.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading indicator mejorado -->
        <div wire:loading
             class="absolute inset-0 flex justify-center items-center bg-black/20 backdrop-blur-sm rounded-2xl">
            <div class="flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-white/60">Cargando contenido...</p>
            </div>
        </div>
    </div>

    <!-- Elementos decorativos mejorados -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-blue-400 rounded-full animate-pulse opacity-20"></div>
        <div
            class="absolute top-3/4 right-1/4 w-2 h-2 bg-purple-400 rounded-full animate-pulse opacity-30 animation-delay-1000"></div>
        <div
            class="absolute bottom-1/4 left-1/3 w-2.5 h-2.5 bg-orange-400 rounded-full animate-pulse opacity-15 animation-delay-2000"></div>
        <div
            class="absolute top-1/2 right-1/3 w-1.5 h-1.5 bg-blue-300 rounded-full animate-pulse opacity-25 animation-delay-3000"></div>
        <div
            class="absolute bottom-1/3 right-1/4 w-2 h-2 bg-purple-300 rounded-full animate-pulse opacity-20 animation-delay-4000"></div>
    </div>


    <style>
        .prose-content {
            font-size: 1.1rem;
            line-height: 1.8;
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }

        .prose-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .prose-content p:last-child {
            margin-bottom: 0;
        }

        .prose-content h1, .prose-content h2, .prose-content h3, .prose-content h4 {
            font-weight: 600;
            line-height: 1.25;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .prose-content ul, .prose-content ol {
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .prose-content li {
            margin-bottom: 0.75rem;
        }

        .prose-content a {
            color: #60a5fa;
            text-decoration: underline;
            transition: color 0.2s ease;
        }

        .prose-content a:hover {
            color: #93c5fd;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-3000 {
            animation-delay: 3s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @media (max-width: 768px) {
            .prose-content {
                font-size: 1rem;
            }
        }

        /* Asegurar transiciones suaves */
        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }

        /* Mejorar las transiciones de Alpine.js */
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>
