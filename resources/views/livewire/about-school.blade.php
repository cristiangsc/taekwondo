<div class="bg-gradient-to-br from-[#000E27] via-[#001230] to-[#000E27] min-h-screen py-16"
     id="about-school-container" data-section="about-school-container">

    <!-- Título Principal -->
    <div class="container mx-auto px-4 mb-14 initial-hidden animate-on-load" data-delay="0">
        <h1 class="text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r text-white mb-6 tracking-tight">
            Sobre la Escuela
        </h1>
        <div class="w-24 h-1.5 bg-gradient-to-r from-red-500 to-orange-500 mx-auto rounded-full"></div>
    </div>

    <!-- Navegación por pestañas -->
    <div class="container mx-auto px-4 mb-12 initial-hidden animate-on-load" data-delay="200">
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button wire:click="selectSection('history')"
                    class="tab-button px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg focus:outline-none {{ $selectedSection === 'history' ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-blue-500/30 scale-105 active' : 'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10' }}">
                <i class="fas fa-clock mr-2"></i> Historia
            </button>
            <button wire:click="selectSection('mission')"
                    class="tab-button px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg focus:outline-none {{ $selectedSection === 'mission' ? 'bg-gradient-to-r from-orange-600 to-orange-700 text-white shadow-orange-500/30 scale-105 active' : 'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10' }}">
                <i class="fas fa-bolt mr-2"></i> Misión
            </button>
            <button wire:click="selectSection('vision')"
                    class="tab-button px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg focus:outline-none {{ $selectedSection === 'vision' ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-purple-500/30 scale-105 active' : 'bg-white/10 text-white/70 hover:bg-white/20 border border-white/20 hover:shadow-white/10' }}">
                <i class="fas fa-eye mr-2"></i> Visión
            </button>
        </div>
    </div>

    <!-- Contenedor del contenido -->
    <div class="container mx-auto px-4 initial-hidden animate-on-load" data-delay="400">

        <!-- Contenedor con altura fija y transición optimizada -->
        <div class="relative section-container {{ $isLoading ? 'opacity-50' : 'opacity-100' }}"
             class="transition-opacity duration-300 ease-in-out">

            <!-- Historia -->
            <div class="section-content {{ $selectedSection === 'history' ? 'active' : '' }} bg-gradient-to-br from-blue-900/40 to-blue-800/20 backdrop-blur-sm rounded-2xl border border-blue-500/20 shadow-2xl overflow-hidden">
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
                                <p class="text-blue-100 opacity-90 hidden md:block">El camino que nos trajo hasta aquí</p>
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
            <div class="section-content {{ $selectedSection === 'mission' ? 'active' : '' }} bg-gradient-to-br from-orange-900/40 to-orange-800/20 backdrop-blur-sm rounded-2xl border border-orange-500/20 shadow-2xl overflow-hidden">
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
            <div class="section-content {{ $selectedSection === 'vision' ? 'active' : '' }} bg-gradient-to-br from-purple-900/40 to-purple-800/20 backdrop-blur-sm rounded-2xl border border-purple-500/20 shadow-2xl overflow-hidden">
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

        <!-- Loading indicator -->
        <div wire:loading.flex wire:target="selectSection"
             class="absolute inset-0 justify-center items-center bg-black/20 backdrop-blur-sm rounded-2xl z-40">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-400"></div>
                <span class="text-white/70 text-sm">Cargando...</span>
            </div>
        </div>
    </div>

    <style>
        /* Animaciones CSS puras */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(2rem);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-2rem);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estados iniciales */
        .initial-hidden {
            opacity: 0;
        }

        .animate-on-load {
            animation-fill-mode: forwards;
        }

        .animate-on-load[data-delay="0"] {
            animation: fadeInDown 1s ease-out 0.2s forwards;
        }

        .animate-on-load[data-delay="200"] {
            animation: fadeInUp 1s ease-out 0.4s forwards;
        }

        .animate-on-load[data-delay="400"] {
            animation: fadeIn 1s ease-out 0.6s forwards;
        }

        /* Transiciones para contenido */
        .section-container {
            position: relative;
            min-height: 500px;
            transition: opacity 0.3s ease-in-out;
        }

        @media (min-width: 768px) {
            .section-container {
                min-height: 450px;
            }
        }

        .section-content {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateY(1rem);
        }

        .section-content.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Botones activos con mejores transiciones */
        .tab-button {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .tab-button:hover:not(.active) {
            transform: scale(1.02);
        }

        .tab-button.active {
            transform: scale(1.05);
        }

        /* Contenido de prosa */
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

        /* Optimizaciones para prevenir parpadeo */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Prevenir layout shifts */
        .container {
            will-change: auto;
        }

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }

        /* Estabilizar el DOM */
        .prose-content * {
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        /* Transiciones específicas para Livewire */
        [wire\\:loading] {
            transition: opacity 0.2s ease-in-out;
        }

        /* Prevenir FOUC (Flash of Unstyled Content) */
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar Intersection Observer para las animaciones iniciales
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -10% 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        element.classList.remove('initial-hidden');
                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            // Observar elementos para animaciones iniciales
            document.querySelectorAll('.animate-on-load').forEach(element => {
                observer.observe(element);
            });

            // Escuchar eventos de Livewire para transiciones más suaves
            document.addEventListener('livewire:navigating', () => {
                // Preparar la página para la navegación
                document.body.style.opacity = '0.8';
            });

            document.addEventListener('livewire:navigated', () => {
                // Restaurar después de la navegación
                document.body.style.opacity = '1';

                // Re-observar elementos si es necesario
                document.querySelectorAll('.animate-on-load').forEach(element => {
                    if (element.classList.contains('initial-hidden')) {
                        observer.observe(element);
                    }
                });
            });

            // Optimización: Pre-cargar imágenes para transiciones más suaves
            const images = [
                "{{asset('images/historia.jpg')}}",
                "{{asset('images/mision.jpg')}}",
                "{{asset('images/vision.jpg')}}"
            ];

            images.forEach(src => {
                const img = new Image();
                img.src = src;
            });
        });

        // Función para manejar el evento personalizado de section-changed
        window.addEventListener('section-changed', function(event) {
            // Disparar un pequeño feedback haptic si está disponible
            if ('vibrate' in navigator) {
                navigator.vibrate(50);
            }

            // Opcional: scroll suave al contenido si es necesario
            const container = document.getElementById('about-school-container');
            if (container && window.scrollY > container.offsetTop) {
                container.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    </script>
</div>
