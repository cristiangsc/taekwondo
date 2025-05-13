<div>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo2.png') }}" class="h-12 md:h-16" alt="Logo Kim's Ñuble Taekwondo" />
                <span class="self-center text-xl md:text-2xl font-semibold whitespace-nowrap dark:text-white hidden sm:block">Kim's Ñuble Taekwondo</span>
            </a>
            <!-- Botón móvil -->
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Abrir menú principal</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="/" class="block py-2 px-3 {{ request()->is('/') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" aria-current="page">Inicio</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            Acerca de
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Menú desplegable -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li><a href="/historia" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request()->is('historia') ? 'text-blue-700' : '' }}">Historia</a></li>
                                <li><a href="/mision" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request()->is('mision') ? 'text-blue-700' : '' }}">Misión</a></li>
                                <li><a href="/vision" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request()->is('vision') ? 'text-blue-700' : '' }}">Visión</a></li>
                                <li><a href="/valores" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request()->is('valores') ? 'text-blue-700' : '' }}">Valores</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/noticias" class="block py-2 px-3 {{ request()->is('noticias') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Noticias</a>
                    </li>
                    <li>
                        <a href="/alianzas" class="block py-2 px-3 {{ request()->is('alianzas') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Alianzas</a>
                    </li>
                    <li>
                        <a href="/preguntas-frecuentes" class="block py-2 px-3 {{ request()->is('preguntas-frecuentes') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Preguntas Frecuentes</a>
                    </li>
                    <li>
                        <a href="/galeria" class="block py-2 px-3 {{ request()->is('galeria') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Galería</a>
                    </li>
                    <li>
                        <a href="/testimonios" class="block py-2 px-3 {{ request()->is('testimonios') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Testimonios</a>
                    </li>
                    <li>
                        <a href="/contacto" class="block py-2 px-3 {{ request()->is('contacto') ? 'text-blue-700' : 'text-gray-900' }} rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
