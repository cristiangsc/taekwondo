<nav
    x-data="{
        isOpen: false,
        isScrolled: false,
        activeSection: 'home',
        scrollProgress: 0,
        isDesktop: window.innerWidth >= 768,

        init() {
            // Detectar scroll y calcular progreso
            this.handleScroll();
            window.addEventListener('scroll', () => this.handleScroll());

            // Intersection Observer para secciones activas (solo en la página principal)
            if (this.isHomePage()) {
                this.observeSections();
            }

            // Resize reactivo: actualiza isDesktop y cierra menú si entramos a escritorio
              window.addEventListener('resize', () => {
                this.isDesktop = window.innerWidth >= 768;
                if (this.isDesktop) {
                  this.isOpen = false;
                  document.body.style.overflow = '';
                }
              });

            // Detectar sección activa desde URL hash
            this.detectActiveFromUrl();
        },

        isHomePage() {
            return window.location.pathname === '/' || window.location.pathname === '/home';
        },

        detectActiveFromUrl() {
            const hash = window.location.hash;
            if (hash && hash.length > 1) {
                const sectionId = hash.substring(1);
                if (this.isValidSection(sectionId)) {
                    this.activeSection = sectionId;
                }
            }
        },

        isValidSection(section) {
            const validSections = ['home', 'about', 'noticias', 'alianzas', 'faq', 'gallery', 'contacto'];
            return validSections.includes(section);
        },

        handleScroll() {
            const scrolled = window.scrollY > 50;
            this.isScrolled = scrolled;

            // Calcular progreso de scroll
            const maxHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = maxHeight > 0 ? (window.scrollY / maxHeight) * 100 : 0;
            this.scrollProgress = Math.min(scrollPercent, 100);
        },

        observeSections() {
            const sections = document.querySelectorAll('[data-section]');
            if (sections.length === 0) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > 0.3) {
                        const sectionId = entry.target.getAttribute('data-section');
                        if (sectionId && this.isValidSection(sectionId)) {
                            this.activeSection = sectionId;
                            // Actualizar URL sin recargar la página
                            if (history.replaceState) {
                                const newUrl = window.location.pathname + '#' + sectionId;
                                history.replaceState(null, null, newUrl);
                            }
                        }
                    }
                });
            }, {
                threshold: [0.3],
                rootMargin: '-20% 0px -20% 0px'
            });

            sections.forEach(section => observer.observe(section));
        },

        toggleMenu() {
              this.isOpen = !this.isOpen;
                  if (this.isOpen && !this.isDesktop) {
                    document.body.style.overflow = 'hidden';
                  } else {
                    document.body.style.overflow = '';
                  }
        },

        closeMenu() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },

        navigateToSection(sectionId) {
            // Si estamos en la página principal, hacer scroll directo
            if (this.isHomePage()) {
                this.scrollToSection(sectionId);
                return;
            }

            // Si estamos en otra página, navegar a la página principal con el hash
            const homeUrl = sectionId === 'home' ? '/' : '/#' + sectionId;
            window.location.href = homeUrl;
        },

        scrollToSection(sectionId) {
            const element = document.querySelector(`[data-section='${sectionId}']`);
            if (element) {
                const navHeight = 80;
                const elementPosition = element.getBoundingClientRect().top + window.scrollY;
                const offsetPosition = elementPosition - navHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Actualizar estado activo
                this.activeSection = sectionId;

                // Actualizar URL
                if (history.replaceState) {
                    const newUrl = window.location.pathname + (sectionId === 'home' ? '' : '#' + sectionId);
                    history.replaceState(null, null, newUrl);
                }
            } else if (sectionId === 'home') {
                // Si es home y no encuentra elemento, ir al top
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                this.activeSection = 'home';
                if (history.replaceState) {
                    history.replaceState(null, null, window.location.pathname);
                }
            }

            // Cerrar menú móvil
            if (window.innerWidth < 768) {
                this.closeMenu();
            }
        },

        isActiveSection(section) {
            return this.activeSection === section;
        }
    }"
    class="top-0 left-0 right-0 z-[9999] transition-all duration-500 ease-in-out sticky"
    :class="{
        'bg-[#000E27]/95 backdrop-blur-lg shadow-2xl border-b border-[#EE5E10]/30': isScrolled,
        'bg-[#000E27] border-b border-gray-700/50': !isScrolled
    }"
    @keydown.escape.window="closeMenu()"
    style="will-change: transform;"
>
    <!-- Barra de progreso de scroll -->
    <div
        class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-[#EE5E10] via-orange-400 to-yellow-500 transition-all duration-300 ease-out shadow-lg"
        :style="`width: ${scrollProgress}%; box-shadow: 0 0 10px rgba(238, 94, 16, 0.5)`"
        x-show="isScrolled"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 scale-x-0"
        x-transition:enter-end="opacity-100 scale-x-100"
    ></div>

    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo mejorado -->
        <a href="{{ route('home') }}"
           class="flex items-center space-x-3 rtl:space-x-reverse group"
           @click.prevent="navigateToSection('home')"
        >
            <div class="relative">
                <!-- Efecto glow detrás del logo -->
                <div
                    class="absolute -inset-3 bg-gradient-to-r from-[#EE5E10]/30 to-orange-500/30 rounded-xl blur-lg opacity-0 group-hover:opacity-100 transition-all duration-500 animate-pulse"></div>

                <!-- Logo con efectos -->
                <div class="relative">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        class="h-12 md:h-16 transition-all duration-500 group-hover:scale-110 group-hover:rotate-2 drop-shadow-lg"
                        alt="Logo Kim's Ñuble Taekwondo"
                    />
                    <!-- Anillo decorativo -->
                    <div
                        class="absolute -inset-1 rounded-full border-2 border-[#EE5E10]/20 group-hover:border-[#EE5E10]/60 transition-all duration-500 group-hover:rotate-180"></div>
                </div>
            </div>

            <!-- Texto del logo con efectos mejorados -->
            <div class="hidden sm:block">
                <div class="relative">
                    <span
                        class="block text-xl md:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-100 to-white group-hover:from-[#EE5E10] group-hover:via-orange-400 group-hover:to-yellow-400 transition-all duration-500">
                        Kim's Ñuble
                    </span>
                    <span
                        class="block text-sm md:text-base text-gray-400 group-hover:text-orange-300 transition-all duration-300 font-medium">
                        Taekwondo
                    </span>

                    <!-- Línea decorativa -->
                    <div
                        class="absolute -bottom-1 left-0 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-400 w-0 group-hover:w-full transition-all duration-500"></div>
                </div>
            </div>
        </a>

        <!-- Botón menú móvil mejorado -->
        <button
            @click="toggleMenu()"
            type="button"
            class="relative inline-flex items-center p-3 w-12 h-12 justify-center text-white rounded-xl md:hidden hover:bg-[#001845]/80 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50 transition-all duration-300 group backdrop-blur-sm border border-gray-600/30"
            :class="{
                'bg-[#EE5E10]/20 border-[#EE5E10]/50': isOpen,
                'bg-gray-800/30': !isOpen
            }"
        >
            <span class="sr-only">Menú principal</span>

            <!-- Hamburguesa animada -->
            <div class="relative w-5 h-5">
                <span
                    class="absolute block w-5 h-0.5 bg-current transform transition-all duration-300 ease-in-out"
                    :class="{
                        'rotate-45 translate-y-0 top-2': isOpen,
                        'rotate-0 -translate-y-1 top-1': !isOpen
                    }"
                ></span>
                <span
                    class="absolute block w-5 h-0.5 bg-current transform transition-all duration-200 top-2"
                    :class="{ 'opacity-0 scale-0': isOpen, 'opacity-100 scale-100': !isOpen }"
                ></span>
                <span
                    class="absolute block w-5 h-0.5 bg-current transform transition-all duration-300 ease-in-out"
                    :class="{
                        '-rotate-45 translate-y-0 top-2': isOpen,
                        'rotate-0 translate-y-1 top-3': !isOpen
                    }"
                ></span>
            </div>

            <!-- Efecto de pulso cuando está abierto -->
            <div
                class="absolute -inset-1 bg-[#EE5E10]/30 rounded-xl animate-ping"
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            ></div>
        </button>

        <!-- Menú principal -->
        <div
            class="w-full md:block md:w-auto z-50"
            x-cloak
            x-show="isOpen || isDesktop"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
            @click.outside="if (!isDesktop) closeMenu()"
        >
            <ul class="flex flex-col font-medium p-6 md:p-0 mt-4 border border-gray-600/30 rounded-2xl bg-[#000E27]/95 backdrop-blur-xl md:space-x-1 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent shadow-2xl md:shadow-none">

                <!-- Inicio -->
                <li>
                    <button
                        @click="navigateToSection('home')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('home'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('home')
                        }"
                    >
                        <!-- Icono -->
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Inicio</span>

                        <!-- Indicador activo móvil -->
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('home')"></div>

                        <!-- Indicador activo desktop -->
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('home')"></div>
                    </button>
                </li>

                <!-- Acerca de -->
                <li>
                    <button
                        @click="navigateToSection('about-school-container')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('about-school-container'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('about-school-container')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">Acerca de</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('about-school-container')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('about-school-container')"></div>
                    </button>
                </li>

                <!-- Noticias -->
                <li>
                    <button
                        @click="navigateToSection('noticias')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('noticias'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('noticias')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-5"/>
                        </svg>
                        <span class="font-medium">Noticias</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('noticias')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('noticias')"></div>
                    </button>
                </li>

                <!-- Alianzas -->
                <li>
                    <button
                        @click="navigateToSection('alianzas')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('alianzas'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('alianzas')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                        <span class="font-medium">Alianzas</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('alianzas')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('alianzas')"></div>
                    </button>
                </li>

                <!-- FAQ -->
                <li>
                    <button
                        @click="navigateToSection('faq')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('faq'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('faq')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">FAQ</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('faq')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('faq')"></div>
                    </button>
                </li>

                <!-- Galería -->
                <li>
                    <button
                        @click="navigateToSection('gallery')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('gallery'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('gallery')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Galería</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('gallery')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('gallery')"></div>
                    </button>
                </li>

                <!-- Contacto -->
                <li>
                    <button
                        @click="navigateToSection('contacto')"
                        class="group relative flex items-center w-full py-3 px-4 md:py-2 md:px-3 rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#EE5E10]/50"
                        :class="{
                            'text-[#EE5E10] bg-[#EE5E10]/10 shadow-lg': isActiveSection('contacto'),
                            'text-white hover:text-[#EE5E10] hover:bg-white/5': !isActiveSection('contacto')
                        }"
                    >
                        <svg class="w-5 h-5 mr-3 md:mr-2 transition-all duration-300 group-hover:scale-110" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Contacto</span>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-gradient-to-b from-[#EE5E10] to-orange-500 rounded-r-full md:hidden"
                            x-show="isActiveSection('contacto')"></div>
                        <div
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-6 h-0.5 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-t-full hidden md:block"
                            x-show="isActiveSection('contacto')"></div>
                    </button>
                </li>

                <!-- Botón CTA especial -->
                <li class="md:ml-4 mt-4 md:mt-0">
                    <button
                        @click="navigateToSection('contacto')"
                        class="group relative w-full md:w-auto inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-xl hover:from-[#EE5E10] hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-[#EE5E10] focus:ring-offset-2 focus:ring-offset-[#000E27] transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl overflow-hidden"
                    >
                        <!-- Efecto de brillo -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

                        <svg class="w-4 h-4 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span class="relative">Clase Gratis</span>

                        <!-- Glow effect -->
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#EE5E10] to-orange-500 rounded-xl blur-lg opacity-30 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Overlay para móvil -->
    <div
        x-show="isOpen && !isDesktop"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm md:hidden"
        style="top: 80px;"
        @click="closeMenu()"
    ></div>
</nav>

