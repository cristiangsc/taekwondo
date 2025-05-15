<div class="bg-gray-50 py-8 relative z-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mb-8">Testimonios</h2>

        @if($testimonials->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start mb-4">
                            <div class="flex-shrink-0 mr-4">
                                @if($testimonial->student && $testimonial->student->getFirstMedia('avatars'))
                                    <img src="{{ $testimonial->student->getFirstMediaUrl('avatars') }}"
                                         alt="{{ $testimonial->student->full_name }}"
                                         class="h-14 w-14 rounded-full object-cover border-2 border-blue-500">
                                @else
                                    <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 border-2 border-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $testimonial->student ? $testimonial->student->full_name : 'Estudiante' }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $testimonial->student && $testimonial->student->grade ? $testimonial->student->grade->name : 'Estudiante de Taekwondo' }}
                                </p>
                            </div>
                        </div>
                        <div class="relative">
                            <svg class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-8 w-8 text-gray-200" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                            </svg>
                            <p class="relative pl-6 text-gray-700">{{ $testimonial->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                No hay testimonios disponibles
            </div>
        @endif
    </div>
</div>
