<div class="bg-white py-8 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mb-8">Preguntas Frecuentes</h2>

        <div class="max-w-3xl mx-auto space-y-4">
            @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <details class="group" {{ $index === 0 ? 'open' : '' }}>
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-4 bg-gray-50 hover:bg-gray-100 transition-all duration-300">
                            <span class="text-gray-800 font-semibold">{!!  $faq->question !!}</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <div class="p-4 border-t border-gray-200 bg-white">
                            <p class="text-gray-700">{!! $faq->answer !!}</p>
                        </div>
                    </details>
                </div>
            @endforeach
        </div>
    </div>
</div>
