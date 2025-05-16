<section class="bg-[#EE5E10] py-12 relative z-0" id="contacto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Contáctanos</h2>
            <p class="mt-4 text-lg text-gray-200 max-w-2xl mx-auto">¿Tienes alguna pregunta o estás interesado en nuestras clases? Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-[#000E27] rounded-xl shadow-lg overflow-hidden" x-data="{
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    message: '',
                    subject: 'Información general'
                },
                loading: false,
                success: false,
                error: false,
                submitForm() {
                    this.loading = true;
                    this.success = false;
                    this.error = false;

                    // Simulate form submission (replace with actual form submission)
                    setTimeout(() => {
                        this.loading = false;
                        this.success = true;
                        this.formData = {
                            name: '',
                            email: '',
                            phone: '',
                            message: '',
                            subject: 'Información general'
                        };
                    }, 1500);
                }
            }">
                <!-- Success Message -->
                <div x-show="success" x-transition class="bg-green-50 p-6 mb-6 rounded-lg border border-green-200">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <h3 class="text-green-800 font-medium">¡Mensaje enviado con éxito!</h3>
                    </div>
                    <p class="mt-2 text-green-700">Gracias por contactarnos. Nos pondremos en contacto contigo lo antes posible.</p>
                    <button @click="success = false" class="mt-3 text-sm text-green-600 hover:text-green-800 font-medium">Enviar otro mensaje</button>
                </div>

                <!-- Error Message -->
                <div x-show="error" x-transition class="bg-red-50 p-6 mb-6 rounded-lg border border-red-200">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-red-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <h3 class="text-red-800 font-medium">Error al enviar el mensaje</h3>
                    </div>
                    <p class="mt-2 text-red-700">Ha ocurrido un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.</p>
                    <button @click="error = false" class="mt-3 text-sm text-red-600 hover:text-red-800 font-medium">Cerrar</button>
                </div>

                <!-- Contact Form -->
                <form x-show="!success" @submit.prevent="submitForm" class="p-8 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                    <!-- Name Field -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-200">Nombre completo</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" x-model="formData.name" required
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-gray-200 rounded-md"
                                placeholder="Tu nombre">
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200">Correo electrónico</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" x-model="formData.email" required
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-gray-200 rounded-md"
                                placeholder="tu@email.com">
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-200">Teléfono</label>
                        <div class="mt-1">
                            <input type="tel" name="phone" id="phone" x-model="formData.phone"
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-gray-200 rounded-md"
                                placeholder="+56 9 1234 5678">
                        </div>
                    </div>

                    <!-- Subject Field -->
                    <div class="sm:col-span-2">
                        <label for="subject" class="block text-sm font-medium text-gray-200">Asunto</label>
                        <div class="mt-1">
                            <select name="subject" id="subject" x-model="formData.subject"
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-gray-200 rounded-md">
                                <option value="Información general">Información general</option>
                                <option value="Inscripción">Inscripción a clases</option>
                                <option value="Horarios">Consulta de horarios</option>
                                <option value="Precios">Información de precios</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message Field -->
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-200">Mensaje</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" x-model="formData.message" required
                                class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 bg-gray-200 rounded-md"
                                placeholder="¿En qué podemos ayudarte?"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white cursor-pointer  bg-[#EE5E10] hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                            :class="{ 'opacity-75 cursor-not-allowed': loading }">
                            <span x-show="!loading">Enviar mensaje</span>
                            <span x-show="loading" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3 text-center">
                <!-- Phone -->
                <div class="flex flex-col items-center">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-lg font-medium text-gray-800">Teléfono</h3>
                    <p class="mt-1 text-gray-200">+56 9 1234 5678</p>
                </div>

                <!-- Email -->
                <div class="flex flex-col items-center">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-lg font-medium text-gray-800">Correo</h3>
                    <p class="mt-1 text-gray-200">contacto@taekwondo.cl</p>
                </div>

                <!-- Location -->
                <div class="flex flex-col items-center">
                    <div class="rounded-full bg-blue-100 p-3 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-lg font-medium text-gray-800">Ubicación</h3>
                    <p class="mt-1 text-gray-200">Chillán, Chile</p>
                </div>
            </div>
        </div>
    </div>
</section>
