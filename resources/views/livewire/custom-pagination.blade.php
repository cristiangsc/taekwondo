@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-600 cursor-default leading-5 rounded-md">
                    Anterior
                </span>
            @else
                <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled"
                        rel="prev"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#000E16] border border-gray-600 leading-5 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-150">
                    Anterior
                </button>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled"
                        rel="next"
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-[#000E16] border border-gray-600 leading-5 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-150">
                    Siguiente
                </button>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-600 cursor-default leading-5 rounded-md">
                    Siguiente
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-400 leading-5">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span class="font-medium text-white">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span class="font-medium text-white">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="Anterior">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray-800 border border-gray-600 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled"
                                rel="prev"
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-[#000E16] border border-gray-600 rounded-l-md leading-5 hover:bg-gray-700 hover:text-white focus:z-10 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-150"
                                aria-label="Anterior">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray-800 border border-gray-600 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-orange-600 border border-orange-600 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-300 bg-[#000E16] border border-gray-600 leading-5 hover:bg-gray-700 hover:text-white focus:z-10 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-150"
                                            aria-label="Ir a la página {{ $page }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled"
                                rel="next"
                                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-[#000E16] border border-gray-600 rounded-r-md leading-5 hover:bg-gray-700 hover:text-white focus:z-10 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition ease-in-out duration-150"
                                aria-label="Siguiente">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="Siguiente">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray-800 border border-gray-600 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
