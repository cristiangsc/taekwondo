<section id="testimonials" class="relative overflow-hidden" data-section="testimonials">
    <!-- Fondo con gradiente y elementos decorativos -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#000E27] via-[#001133] to-[#000E27]"></div>
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 left-1/6 w-72 h-72 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/6 w-96 h-96 bg-gradient-to-r from-orange-500/15 to-red-500/15 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="relative pt-16 pb-20" x-data="testimonialCarousel({{ $testimonials->toJson() }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título animado -->
            <div class="text-center mb-16" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-1000 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-center text-transparent bg-clip-text
                               bg-gradient-to-r from-white via-blue-200 to-white mb-6 tracking-tight leading-tight">
                        Lo que dicen nuestros estudiantes
                    </h1>
                    <div class="w-32 h-1.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 mx-auto rounded-full
                                shadow-lg shadow-blue-500/25 animate-pulse mb-6"></div>
                    <p class="text-gray-300 text-lg max-w-3xl mx-auto">
                        Conoce las experiencias y transformaciones de quienes han sido parte de nuestra comunidad
                    </p>
                </div>
            </div>

            @if($testimonials->isNotEmpty())
                <!-- Carrusel principal -->
                <div class="relative">
                    <!-- Contenedor del carrusel -->
                    <div class="overflow-hidden rounded-3xl">
                        <div class="flex transition-transform duration-700 ease-out"
                             :style="{ transform: `translateX(-${currentIndex * (100 / slidesToShow)}%)` }">

                            <template x-for="(testimonial, index) in testimonials" :key="index">
                                <div class="flex-shrink-0 px-3"
                                     :class="getSlideWidth()"
                                     :style="{ transition: 'opacity 0.5s ease-out' }">

                                    <!-- Card de testimonio -->
                                    <div class="group bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm
                                                rounded-3xl p-8 h-full flex flex-col border border-white/20
                                                hover:border-white/40 shadow-xl hover:shadow-2xl
                                                transform hover:-translate-y-2 transition-all duration-500 ease-out
                                                hover:bg-gradient-to-br hover:from-white/15 hover:to-white/10">

                                        <!-- Header con avatar y info -->
                                        <div class="flex items-center mb-6">
                                            <!-- Avatar -->
                                            <div class="relative flex-shrink-0 mr-4">
                                                <template x-if="testimonial.student && testimonial.student.avatar">
                                                    <img :src="testimonial.student.avatar"
                                                         :alt="testimonial.student.full_name"
                                                         class="h-16 w-16 rounded-full object-cover border-4 border-gradient-to-r
                                                                from-blue-400 to-purple-500 shadow-lg">
                                                </template>
                                                <template x-if="!testimonial.student || !testimonial.student.avatar">
                                                    <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-600
                                                                flex items-center justify-center shadow-lg">
                                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                </template>

                                                <!-- Indicador online -->
                                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full
                                                            border-2 border-white shadow-lg animate-pulse"></div>
                                            </div>

                                            <!-- Info del estudiante -->
                                            <div class="flex-1">
                                                <h3 class="text-xl font-bold text-white mb-1 group-hover:text-blue-300
                                                           transition-colors duration-300"
                                                    x-text="testimonial.student ? testimonial.student.full_name : 'Estudiante'"></h3>
                                                <p class="text-blue-300 text-sm font-medium"
                                                   x-text="testimonial.student && testimonial.student.grade ? testimonial.student.grade.name : 'Estudiante de Taekwondo'"></p>

                                                <!-- Estrellas de rating -->
                                                <div class="flex mt-2 space-x-1">
                                                    <template x-for="star in 5" :key="star">
                                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contenido del testimonio -->
                                        <div class="flex-1 relative">
                                            <!-- Comillas decorativas -->
                                            <div class="absolute -top-2 -left-2 text-6xl text-blue-400/30 font-serif">"</div>
                                            <div class="absolute -bottom-4 -right-2 text-6xl text-purple-400/30 font-serif rotate-180">"</div>

                                            <blockquote class="relative text-gray-200 text-lg leading-relaxed italic
                                                              px-4 py-2 group-hover:text-white transition-colors duration-300">
                                                <p x-text="testimonial.content"></p>
                                            </blockquote>
                                        </div>

                                        <!-- Footer con fecha/verificación -->
                                        <div class="mt-6 pt-4 border-t border-white/20 flex justify-between items-center">
                                            <div class="flex items-center text-sm text-gray-400">
                                                <svg class="w-4 h-4 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Testimonio verificado
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                ★★★★★
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Controles de navegación -->
                    <div class="flex justify-center items-center mt-12 space-x-6">
                        <!-- Botón anterior -->
                        <button @click="prev"
                                class="group flex items-center justify-center w-14 h-14
                                       bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700
                                       text-white rounded-full shadow-xl hover:shadow-2xl
                                       transform hover:-translate-y-1 transition-all duration-300
                                       disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                :disabled="currentIndex === 0"
                                :class="currentIndex === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:scale-110'">
                            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <!-- Indicadores de página -->
                        <div class="flex space-x-2">
                            <template x-for="(page, pageIndex) in Math.ceil(testimonials.length / slidesToShow)" :key="pageIndex">
                                <button @click="goToSlide(pageIndex)"
                                        class="w-3 h-3 rounded-full transition-all duration-300"
                                        :class="Math.floor(currentIndex / slidesToShow) === pageIndex
                                               ? 'bg-gradient-to-r from-blue-500 to-purple-500 scale-125'
                                               : 'bg-white/30 hover:bg-white/60'">
                                </button>
                            </template>
                        </div>

                        <!-- Botón siguiente -->
                        <button @click="next"
                                class="group flex items-center justify-center w-14 h-14
                                       bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700
                                       text-white rounded-full shadow-xl hover:shadow-2xl
                                       transform hover:-translate-y-1 transition-all duration-300
                                       disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                :disabled="currentIndex >= maxIndex"
                                :class="currentIndex >= maxIndex ? 'opacity-50 cursor-not-allowed' : 'hover:scale-110'">
                            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Autoplay controls -->
                    <div class="text-center mt-8">
                        <button @click="toggleAutoplay"
                                class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20
                                       text-white rounded-full text-sm transition-all duration-300
                                       border border-white/30 hover:border-white/50">
                            <template x-if="isAutoPlaying">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6"/>
                                </svg>
                            </template>
                            <template x-if="!isAutoPlaying">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M15 14h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </template>
                            <span x-text="isAutoPlaying ? 'Pausar' : 'Auto-reproducir'"></span>
                        </button>
                    </div>
                </div>

            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-16">
                    <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-12 max-w-md mx-auto border border-white/20">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">No hay testimonios disponibles</h3>
                        <p class="text-gray-400">Pronto tendremos experiencias increíbles para compartir contigo</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    function testimonialCarousel(testimonials) {
        return {
            testimonials: testimonials,
            currentIndex: 0,
            slidesToShow: 3,
            isAutoPlaying: true,
            autoplayInterval: null,

            init() {
                this.updateSlidesToShow();
                this.startAutoplay();

                // Responsive handler
                window.addEventListener('resize', () => {
                    this.updateSlidesToShow();
                });
            },

            updateSlidesToShow() {
                if (window.innerWidth < 768) {
                    this.slidesToShow = 1;
                } else if (window.innerWidth < 1024) {
                    this.slidesToShow = 2;
                } else {
                    this.slidesToShow = 3;
                }
            },

            getSlideWidth() {
                return `w-full sm:w-1/${this.slidesToShow} md:w-1/${this.slidesToShow} lg:w-1/${this.slidesToShow}`;
            },

            get maxIndex() {
                return Math.max(0, this.testimonials.length - this.slidesToShow);
            },

            next() {
                if (this.currentIndex < this.maxIndex) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0; // Loop back to start
                }
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.maxIndex; // Loop to end
                }
            },

            goToSlide(slideIndex) {
                this.currentIndex = slideIndex * this.slidesToShow;
                if (this.currentIndex > this.maxIndex) {
                    this.currentIndex = this.maxIndex;
                }
            },

            startAutoplay() {
                if (this.isAutoPlaying) {
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, 5000);
                }
            },

            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
            },

            toggleAutoplay() {
                this.isAutoPlaying = !this.isAutoPlaying;
                if (this.isAutoPlaying) {
                    this.startAutoplay();
                } else {
                    this.stopAutoplay();
                }
            }
        };
    }
</script>

<!-- Estilos CSS adicionales -->
<style>
    /* Animaciones personalizadas */
    @keyframes testimonial-fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-enter {
        animation: testimonial-fade-in 0.6s ease-out forwards;
    }

    /* Efecto glassmorphism mejorado */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Hover effects para las cards */
    .testimonial-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .testimonial-card {
            margin-bottom: 2rem;
        }
    }
</style>
