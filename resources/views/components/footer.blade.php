<footer class="relative overflow-hidden">
    <!-- Fondo con gradiente y elementos decorativos -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
    <div class="absolute inset-0 opacity-20">
        <!-- Elementos decorativos animados -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-orange-500/40 to-transparent"></div>
        <div class="absolute top-1/4 left-1/6 w-64 h-64 bg-gradient-to-r from-orange-500/10 to-red-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/6 w-96 h-96 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <!-- Patrón de puntos decorativo -->
        <div class="absolute inset-0 opacity-30">
            <div class="w-2 h-2 bg-white/10 rounded-full absolute top-20 left-20 animate-ping delay-1000"></div>
            <div class="w-1 h-1 bg-orange-400/20 rounded-full absolute top-40 right-32 animate-ping delay-2000"></div>
            <div class="w-3 h-3 bg-blue-400/10 rounded-full absolute bottom-32 left-1/3 animate-ping delay-3000"></div>
        </div>
    </div>

    <div class="relative py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Contenido principal del footer -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12" x-data="{ visible: false }" x-intersect="visible = true">

                <!-- Logo y Descripción -->
                <div class="col-span-1 md:col-span-2 transform transition-all duration-1000 ease-out"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">

                    <!-- Logo con efecto -->
                    <div class="flex items-center mb-6 group">
                        <div class="relative">
                            <div class="absolute -inset-2 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>
                            <div class="relative bg-gradient-to-r from-orange-600 to-red-600 p-3 rounded-lg shadow-xl">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 ml-4">
                            Taekwondo Kim's Ñuble
                        </span>
                    </div>

                    <!-- Descripción mejorada -->
                    <p class="text-gray-300 mb-8 leading-relaxed text-lg max-w-lg">
                        Formando <span class="text-orange-400 font-semibold">campeones</span> en el deporte y en la vida.
                        Nuestra escuela se dedica a enseñar disciplina, respeto y excelencia a través de las artes marciales.
                    </p>

                    <!-- Estadísticas rápidas -->
                    <div class="grid grid-cols-3 gap-4 mb-8 p-6 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-orange-400">100+</div>
                            <div class="text-xs text-gray-400">Estudiantes</div>
                        </div>
                        <div class="text-center border-x border-white/10">
                            <div class="text-2xl font-bold text-blue-400">15+</div>
                            <div class="text-xs text-gray-400">Años</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-400">50+</div>
                            <div class="text-xs text-gray-400">Medallas</div>
                        </div>
                    </div>

                    <!-- Redes sociales mejoradas -->
                    <div class="flex space-x-4">
                        <a href="#" class="group relative">
                            <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>
                            <div class="relative bg-blue-600 hover:bg-blue-700 p-3 rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="group relative">
                            <div class="absolute -inset-2 bg-gradient-to-r from-pink-500 to-rose-500 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>
                            <div class="relative bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 p-3 rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>

{{--                        <a href="#" class="group relative">--}}
{{--                            <div class="absolute -inset-2 bg-gradient-to-r from-sky-400 to-sky-500 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>--}}
{{--                            <div class="relative bg-sky-500 hover:bg-sky-600 p-3 rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">--}}
{{--                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </a>--}}

                        <a href="#" class="group relative">
                            <div class="absolute -inset-2 bg-gradient-to-r from-red-500 to-red-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>
                            <div class="relative bg-red-600 hover:bg-red-700 p-3 rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="group relative">
                            <div class="absolute -inset-2 bg-gradient-to-r from-green-500 to-green-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition-opacity duration-300"></div>
                            <div class="relative bg-green-600 hover:bg-green-700 p-3 rounded-lg shadow-lg transform group-hover:-translate-y-1 transition-all duration-300">
                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="transform transition-all duration-1000 ease-out delay-200"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <div class="w-1 h-6 bg-gradient-to-b from-orange-500 to-red-500 rounded-full mr-3"></div>
                        Enlaces rápidos
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{url('/')}}" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Inicio
                            </a></li>
                        <li><a href="{{url('/#about-school-container')}}" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Sobre nosotros
                            </a></li>
                        <li><a href="#" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Clases
                            </a></li>
                        <li><a href="#" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Instructora
                            </a></li>
                        <li><a href="#" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Eventos
                            </a></li>
                        <li><a href="{{url('/#contacto')}}" class="group flex items-center text-gray-400 hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-3 transform group-hover:translate-x-1 transition-transform duration-300 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Contacto
                            </a></li>
                    </ul>
                </div>

                <!-- Información de contacto -->
                <div class="transform transition-all duration-1000 ease-out delay-400"
                     :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <div class="w-1 h-6 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full mr-3"></div>
                        Contacto
                    </h3>
                    <ul class="space-y-4">
                        <li class="group">
                            <div class="flex items-start p-3 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300 hover:bg-white/10">
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-lg mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-medium">Chillán, Chile</p>
                                    <p class="text-gray-400 text-sm">Ñuble Region</p>
                                </div>
                            </div>
                        </li>

                        <li class="group">
                            <div class="flex items-start p-3 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300 hover:bg-white/10">
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center shadow-lg mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-medium">+56 9 1234 5678</p>
                                    <p class="text-gray-400 text-sm">Lun - Vie: 8:00 - 20:00</p>
                                </div>
                            </div>
                        </li>

                        <li class="group">
                            <div class="flex items-start p-3 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300 hover:bg-white/10">
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center shadow-lg mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-medium">contacto@taekwondo.cl</p>
                                    <p class="text-gray-400 text-sm">Respuesta en 24hrs</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter subscription -->
            <div class="mt-16 text-center transform transition-all duration-1000 ease-out delay-600"
                 x-data="{ visible: false }" x-intersect="visible = true"
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <div class="bg-gradient-to-r from-orange-500/20 to-red-500/20 backdrop-blur-sm rounded-3xl p-8 border border-white/20 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold text-white mb-4">¡Mantente conectado!</h3>
                    <p class="text-gray-300 mb-6">Recibe noticias, eventos especiales y consejos de entrenamiento directamente en tu correo.</p>

                    <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                        <input type="email"
                               placeholder="tu@email.com"
                               class="flex-1 px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300">
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 whitespace-nowrap">
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>

            <!-- Línea divisoria con efecto -->
            <div class="relative mt-16 mb-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                </div>
                <div class="relative flex justify-center">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 w-12 h-1 rounded-full"></div>
                </div>
            </div>

            <!-- Copyright y enlaces legales -->
            <div class="transform transition-all duration-1000 ease-out delay-800"
                 x-data="{ visible: false }" x-intersect="visible = true"
                 :class="visible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <!-- Copyright -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-400 text-sm">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            <span class="text-white font-semibold">Taekwondo Kim's Ñuble</span>.
                            Todos los derechos reservados.
                        </p>
                    </div>

                    <!-- Enlaces legales -->
                    <div class="flex flex-wrap justify-center lg:justify-end gap-6">
                        <a href="#" class="group flex items-center text-gray-400 hover:text-white text-sm transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2 text-blue-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Política de privacidad
                        </a>
                        <a href="#" class="group flex items-center text-gray-400 hover:text-white text-sm transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2 text-green-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            Términos de servicio
                        </a>
                        <a href="#" class="group flex items-center text-gray-400 hover:text-white text-sm transition-colors duration-300">
                            <svg class="w-4 h-4 mr-2 text-yellow-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                            </svg>
                            Cookies
                        </a>
                    </div>
                </div>

                <!-- Firma del desarrollador (opcional) -->
                <div class="text-center mt-8 pt-6 border-t border-white/10">
                    <p class="text-gray-500 text-xs">
                        Desarrollado con ❤️ por
                        <span class="text-gradient bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent font-semibold">
                            CSC Developer
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Estilos CSS adicionales -->
<style>
    /* Gradiente para textos */
    .text-gradient {
        background: linear-gradient(45deg, #f97316, #ef4444);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Animación para elementos de fondo */
    @keyframes float-slow {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.1;
        }
    }

    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
    }

    /* Efecto hover para redes sociales */
    .social-link:hover {
        transform: translateY(-4px) scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    /* Glassmorphism mejorado */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Responsive para dispositivos móviles */
    @media (max-width: 768px) {
        .footer-stats {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .footer-social {
            justify-content: center;
            flex-wrap: wrap;
        }

        .newsletter-form {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
