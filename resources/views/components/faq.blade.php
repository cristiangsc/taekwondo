<section id="faq">
<div class="bg-[#EE5E10] py-8 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl text-center mb-8">Preguntas Frecuentes</h2>

        <div class="max-w-5xl mx-auto space-y-2">
            @foreach($faqs as $index => $faq)
                <div class="border border-[#000E27] rounded-lg overflow-hidden">
                    <details class="group" {{ $index === 0 ? 'open' : '' }}>
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-4 bg-[#000E27] hover:bg-[#00255C] transition-all duration-300">
                            <span class="text-gray-200 font-semibold">{!!  $faq->question !!}</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24"  shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <div class="p-4 border-t border-gray-200 bg-[#000E27]">
                            <div class="text-gray-200">{!! $faq->answer !!}</div>
                        </div>
                    </details>
                </div>
            @endforeach
        </div>
    </div>
</div>
</section>
