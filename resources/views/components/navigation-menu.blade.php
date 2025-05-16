<div>
    <nav class="bg-[#000E27] border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-12 md:h-18" alt="Logo Kim's Ñuble Taekwondo" />
                <span class="self-center text-xl md:text-2xl font-semibold whitespace-nowrap text-white hidden sm:block">Kim's Ñuble Taekwondo</span>
            </a>
            <!-- Botón móvil -->
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-[#001845] focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Abrir menú principal</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-[#000E27] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#000E27]">
                    <li>
                        <a href="/" class="block py-2 px-3 {{ request()->is('/') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300" aria-current="page">Inicio</a>
                    </li>
                    <li>
                        <a href="#about" class="block py-2 px-3 {{ request()->is('about') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Acerca de</a>
                    </li>
                    <li>
                        <a href="#valores" class="block py-2 px-3 {{ request()->is('valores') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Valores</a>
                    </li>
                    <li>
                        <a href="#noticias" class="block py-2 px-3 {{ request()->is('noticias') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Noticias</a>
                    </li>
                    <li>
                        <a href="#alianzas" class="block py-2 px-3 {{ request()->is('alianzas') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Alianzas</a>
                    </li>
                    <li>
                        <a href="#faq" class="block py-2 px-3 {{ request()->is('faq') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Preguntas Frecuentes</a>
                    </li>
                    <li>
                        <a href="#gallery" class="block py-2 px-3 {{ request()->is('gallery') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Galería</a>
                    </li>
                    <li>
                        <a href="#testimonials" class="block py-2 px-3 {{ request()->is('testimonials') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Testimonios</a>
                    </li>
                    <li>
                        <a href="#contacto" class="block py-2 px-3 {{ request()->is('contacto') ? 'text-[#EE5E10]' : 'text-white' }} rounded hover:bg-[#001845] md:hover:bg-transparent md:border-0 md:hover:text-[#EE5E10] md:p-0 transition-colors duration-300">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
