<section id="faq" class="relative overflow-hidden" data-section="faq">
    <!-- Fondo con gradiente y elementos decorativos -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#EE5E10] via-[#FF6B1A] to-[#E55100]"></div>
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/50 to-transparent"></div>
        <div class="absolute bottom-0 right-0 w-full h-px bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
        <div class="absolute top-1/4 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative pt-16 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Título animado -->
            <div class="text-center mb-16" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-1000 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-center text-white mb-6 tracking-tight leading-tight
                               drop-shadow-lg">
                        Preguntas Frecuentes
                    </h1>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-white via-orange-200 to-white mx-auto rounded-full
                                shadow-lg shadow-white/25 animate-pulse mb-6"></div>
                    <p class="text-white/90 text-lg max-w-3xl mx-auto drop-shadow-md">
                        Encuentra respuestas rápidas a las consultas más comunes de nuestros usuarios
                    </p>
                </div>
            </div>

            <!-- Container de FAQs -->
            <div class="max-w-4xl mx-auto space-y-4" x-data="{ openFaq: 0 }">
                @foreach($faqs as $index => $faq)
                    <div class="transform transition-all duration-500 ease-out"
                         x-data="{ visible: false }"
                         x-intersect="setTimeout(() => visible = true, {{ $index * 100 }})"
                         :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">

                        <!-- FAQ Item -->
                        <div class="group bg-white/95 backdrop-blur-sm rounded-2xl overflow-hidden
                                    shadow-xl hover:shadow-2xl transition-all duration-500 ease-out
                                    border border-white/50 hover:border-white/80
                                    transform hover:-translate-y-1">

                            <!-- Pregunta (Header) -->
                            <div class="relative cursor-pointer transition-all duration-300 ease-out
                                        bg-gradient-to-r from-[#000E27] via-[#001133] to-[#000E27]
                                        hover:from-[#001133] hover:via-[#001a4d] hover:to-[#001133]"
                                 @click="openFaq = openFaq === {{ $index }} ? -1 : {{ $index }}"
                                 :class="openFaq === {{ $index }} ? 'bg-gradient-to-r from-[#001133] via-[#001a4d] to-[#001133]' : ''">

                                <!-- Efecto de brillo -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent
                                            transform -translate-x-full group-hover:translate-x-full
                                            transition-transform duration-1000 ease-out"></div>

                                <div class="relative flex justify-between items-center p-6">
                                    <!-- Número de pregunta -->
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500
                                                    rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white text-sm font-bold">{{ $index + 1 }}</span>
                                        </div>
                                        <span class="text-white font-semibold text-lg pr-4 leading-relaxed">
                                            {!! $faq->question !!}
                                        </span>
                                    </div>

                                    <!-- Icono animado -->
                                    <div class="flex-shrink-0 ml-4">
                                        <div class="w-8 h-8 rounded-full bg-orange-500/20 flex items-center justify-center
                                                    transition-all duration-300 ease-out"
                                             :class="openFaq === {{ $index }} ? 'rotate-180 bg-orange-500/30' : 'rotate-0'">
                                            <svg class="w-5 h-5 text-orange-400 transition-transform duration-300"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Respuesta (Content) -->
                            <div class="overflow-hidden transition-all duration-500 ease-out"
                                 :class="openFaq === {{ $index }} ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'">
                                <div class="p-6 bg-gradient-to-br from-gray-50 to-white border-t border-gray-100">
                                    <!-- Contenido de la respuesta -->
                                    <div class="flex items-start space-x-4">
                                        <!-- Icono de respuesta -->
                                        <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-green-500 to-emerald-500
                                                    rounded-full flex items-center justify-center mt-1">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>

                                        <!-- Texto de la respuesta -->
                                        <div class="flex-1 text-gray-700 leading-relaxed prose prose-gray max-w-none">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer con información adicional -->
            <div class="mt-16 text-center" x-data="{ visible: false }" x-intersect="visible = true">
                <div class="transform transition-all duration-700 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">

                    <!-- Card de contacto -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto
                                border border-white/30 shadow-xl">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4">¿No encontraste tu respuesta?</h3>
                        <p class="text-white/90 mb-6 leading-relaxed">
                            Nuestro equipo de soporte está listo para ayudarte con cualquier consulta adicional que puedas tener.
                        </p>

                        <a href="#contacto"
                           class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-800
                                  font-bold py-4 px-8 rounded-2xl shadow-xl hover:shadow-2xl
                                  transform hover:-translate-y-1 hover:scale-105
                                  transition-all duration-300 ease-out group">

                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>

                            <span>Contáctanos</span>

                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
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
    /* Animación suave para el contenido del FAQ */
    .faq-content {
        transition: max-height 0.5s ease-out, opacity 0.3s ease-out;
    }

    /* Estilo para el prose (contenido de respuestas) */
    .prose p {
        margin-bottom: 1rem;
    }

    .prose p:last-child {
        margin-bottom: 0;
    }

    .prose ul, .prose ol {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }

    .prose li {
        margin: 0.5rem 0;
    }

    /* Animación para elementos de fondo */
    @keyframes float-bg {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }

    .animate-float-bg {
        animation: float-bg 8s ease-in-out infinite;
    }
</style>
