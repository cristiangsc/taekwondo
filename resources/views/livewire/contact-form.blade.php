<section class="bg-[#EE5E10] py-12 relative z-0" id="contacto" data-section="contacto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-white dark:text-white pb-10">
                Contáctanos
            </h1>
            <p class="mt-4 text-lg text-gray-200 max-w-2xl mx-auto">
                ¿Tienes alguna pregunta o estás interesado en nuestras clases?
                Completa el formulario y nos pondremos en contacto contigo lo antes posible.
            </p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-[#000E27] rounded-xl shadow-lg overflow-hidden">

                {{-- Mensaje de éxito --}}
                <div
                    x-data="{ show: @entangle('showSuccess') }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="bg-green-50 border-l-4 border-green-400 p-6 m-6 rounded-r-lg"
                >
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-medium text-green-800">¡Mensaje enviado correctamente!</h3>
                            <p class="mt-2 text-sm text-green-700">
                                Gracias por contactarnos. Nos pondremos en contacto contigo lo antes posible.
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button
                                wire:click="hideSuccess"
                                type="button"
                                class="inline-flex text-green-400 hover:text-green-600 focus:outline-none"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Mensaje de error general --}}
                @if($errorMessage)
                    <div class="bg-red-50 border-l-4 border-red-400 p-6 m-6 rounded-r-lg">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Error al enviar el mensaje</h3>
                                <p class="mt-2 text-sm text-red-700">{{ $errorMessage }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Formulario --}}
                <form wire:submit="submit" class="p-8 space-y-6">
                    {{-- Nombre completo --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-200 mb-2">
                            Nombre completo <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="name"
                                wire:model.live.debounce.300ms="name"
                                class="w-full px-4 py-3 bg-gray-100 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200
                                       @error('name') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-gray-300 @enderror"
                                placeholder="Ingresa tu nombre completo"
                                autocomplete="name"
                            >
                            @if(!$errors->has('name') && !empty($name))
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        @error('name')
                        <p class="mt-2 text-sm text-red-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-200 mb-2">
                                Correo electrónico <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    type="email"
                                    id="email"
                                    wire:model.live.debounce.500ms="email"
                                    class="w-full px-4 py-3 bg-gray-100 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200
                                           @error('email') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-gray-300 @enderror"
                                    placeholder="tu@email.com"
                                    autocomplete="email"
                                >
                                @if(!$errors->has('email') && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-red-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-200 mb-2">
                                Teléfono (opcional)
                            </label>
                            <div class="relative">
                                <input
                                    type="tel"
                                    id="phone"
                                    wire:model.live.debounce.500ms="phone"
                                    class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200
                                           @error('phone') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror"
                                    placeholder="+56 9 1234 5678"
                                    autocomplete="tel"
                                >
                            </div>
                            @error('phone')
                            <p class="mt-2 text-sm text-red-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Asunto --}}
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-200 mb-2">
                            Asunto <span class="text-red-400">*</span>
                        </label>
                        <select
                            id="subject"
                            wire:model="subject"
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        >
                            <option value="Información general">Información general</option>
                            <option value="Inscripción">Inscripción a clases</option>
                            <option value="Horarios">Consulta de horarios</option>
                            <option value="Precios">Información de precios</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    {{-- Mensaje --}}
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-200 mb-2">
                            Mensaje <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <textarea
                                id="message"
                                wire:model.live.debounce.300ms="message"
                                rows="5"
                                maxlength="1000"
                                class="w-full px-4 py-3 bg-gray-100 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none
                                       @error('message') border-red-300 focus:border-red-500 focus:ring-red-200 @else border-gray-300 @enderror"
                                placeholder="¿En qué podemos ayudarte? Cuéntanos sobre tu consulta..."
                            ></textarea>
                            <div class="absolute bottom-3 right-3 text-sm text-gray-400">
                                {{ $this->messageCharacterCount }}/1000
                            </div>
                        </div>
                        @error('message')
                        <p class="mt-2 text-sm text-red-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Botón de envío --}}
                    <div class="pt-4">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            @if(!$this->canSubmit) disabled @endif
                            class="w-full flex justify-center items-center px-6 py-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white
                                   transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]
                                   @if($this->canSubmit)
                                       bg-[#EE5E10] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 cursor-pointer
                                   @else
                                       bg-gray-400 cursor-not-allowed
                                   @endif"
                        >
                            <span wire:loading.remove wire:target="submit">
                                @if($this->canSubmit)
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Enviar mensaje
                                @else
                                    Completa todos los campos requeridos
                                @endif
                            </span>
                            <span wire:loading wire:target="submit" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>
                    </div>

                    {{-- Información adicional --}}
                    <div class="text-center pt-4 border-t border-gray-600">
                        <p class="text-sm text-gray-400">
                            <span class="text-red-400">*</span> Campos requeridos.
                            Nos comprometemos a responder en menos de 24 horas.
                        </p>
                    </div>
                </form>
            </div>

            {{-- Información de contacto --}}
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3 text-center">
                {{-- Teléfono --}}
                <div class="flex flex-col items-center group">
                    <div class="rounded-full bg-blue-100 p-4 text-blue-600 group-hover:bg-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-white">Teléfono</h3>
                    <a href="tel:+56912345678" class="mt-2 text-gray-200 hover:text-white transition-colors duration-200">
                        +56 9 1234 5678
                    </a>
                </div>

                {{-- Email --}}
                <div class="flex flex-col items-center group">
                    <div class="rounded-full bg-blue-100 p-4 text-blue-600 group-hover:bg-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-white">Correo</h3>
                    <a href="mailto:contacto@taekwondo.cl" class="mt-2 text-gray-200 hover:text-white transition-colors duration-200">
                        contacto@taekwondo.cl
                    </a>
                </div>

                {{-- Ubicación --}}
                <div class="flex flex-col items-center group">
                    <div class="rounded-full bg-blue-100 p-4 text-blue-600 group-hover:bg-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-white">Ubicación</h3>
                    <p class="mt-2 text-gray-200">Chillán, Chile</p>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript para mejoras adicionales --}}
    @script
    <script>
        $wire.on('form-submitted', (event) => {
            // Scroll suave hacia arriba para mostrar mensaje de éxito
            document.getElementById('contacto').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

            // Opcional: mostrar notificación del navegador
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('Taekwondo - Mensaje enviado', {
                    body: event.message || '¡Tu mensaje ha sido enviado correctamente!',
                    icon: '/favicon.ico'
                });
            }
        });

        // Auto-resize del textarea
        document.addEventListener('alpine:init', () => {
            Alpine.data('autoResize', () => ({
                init() {
                    this.$el.addEventListener('input', () => {
                        this.$el.style.height = 'auto';
                        this.$el.style.height = this.$el.scrollHeight + 'px';
                    });
                }
            }));
        });
    </script>
    @endscript
</section>
