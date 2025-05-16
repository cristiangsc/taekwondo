<section id="testimonials">
    <div class="bg-[#000E27] py-8 relative z-0" x-data="carousel({{ $testimonials->toJson() }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Testimonios</h2>

            @if($testimonials->isNotEmpty())
                <div class="relative">
                    <!-- Carrusel -->
                    <div class="flex overflow-hidden relative">
                        <div
                            class="flex transition-transform duration-500 ease-in-out"
                            :style="{ transform: `translateX(-${currentIndex * 33.333}%)` }"
                        >
                            <template x-for="(testimonial, index) in testimonials" :key="index">
                                <div class="w-1/3 flex-shrink-0 px-2">
                                    <div
                                        class="bg-gray-200 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 h-full flex flex-col">
                                        <div class="flex items-start mb-4">
                                            <div class="flex-shrink-0 mr-4">
                                                <template x-if="testimonial.student && testimonial.student.avatar">
                                                    <img :src="testimonial.student.avatar"
                                                         :alt="testimonial.student.full_name"
                                                         class="h-14 w-14 rounded-full object-cover border-2 border-blue-500">
                                                </template>
                                                <template x-if="!testimonial.student || !testimonial.student.avatar">
                                                    <div
                                                        class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 border-2 border-blue-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                                             fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                </template>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800"
                                                    x-text="testimonial.student ? testimonial.student.full_name : 'Estudiante'"></h3>
                                                <p class="text-sm text-gray-500"
                                                   x-text="testimonial.student && testimonial.student.grade ? testimonial.student.grade.name : 'Estudiante de Taekwondo'"></p>
                                            </div>
                                        </div>
                                        <div class="relative flex-grow">
                                            <svg
                                                class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-8 w-8 text-gray-200"
                                                fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                                <path
                                                    d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/>
                                            </svg>
                                            <p class="relative pl-6 text-gray-700" x-text="testimonial.content"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Botón Anterior -->
                        <button @click="prev"
                                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white opacity-50 rounded-full hover:opacity-100 p-2 shadow hover:bg-blue-600"
                                :class="{ 'hidden': currentIndex === 0 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <!-- Botón Siguiente -->
                        <button @click="next"
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white opacity-50 hover:opacity-100 rounded-full p-2 shadow hover:bg-blue-600"
                                :class="{ 'hidden': currentIndex >= testimonials.length - 3 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    No hay testimonios disponibles
                </div>
            @endif
        </div>
    </div>

    <script>
        function carousel(testimonials) {
            return {
                testimonials: testimonials,
                currentIndex: 0,
                next() {
                    if (this.currentIndex < this.testimonials.length - 3) {
                        this.currentIndex++;
                    }
                },
                prev() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    }
                }
            };
        }
    </script>
</section>
