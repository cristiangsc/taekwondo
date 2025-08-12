<div>
    <div class="bg-gradient-to-b from-[#000E27] to-[#001B3D] py-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('news.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200">
                            Noticias
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-gray-300 truncate max-w-xs" title="{{ $news->title }}">
                        {{ Str::limit($news->title, 40) }}
                    </li>
                </ol>
            </nav>

            <!-- Title with animation -->
            <h1 class="text-4xl md:text-5xl font-bold text-center text-white pb-10 animate-fade-in-up">
                Noticias
            </h1>

            <!-- News detail card with enhanced styling -->
            <article class="bg-gradient-to-br from-[#000E16] to-[#001A25] rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:shadow-3xl border border-gray-800/50">
                <!-- Image container with loading state -->
                <div class="relative aspect-w-16 aspect-h-9 bg-gray-900">
                    <img
                        src="{{ $news->getFirstMediaUrl('image') }}"
                        alt="{{ $news->title }}"
                        class="w-full h-auto object-cover transition-transform duration-700 hover:scale-105"
                        loading="lazy"
                        onload="this.classList.add('loaded')"
                    >
                    <!-- Image overlay for better text readability if needed -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="p-6 md:p-8 lg:p-10">
                    <!-- Article header -->
                    <header class="mb-6">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight animate-fade-in-up">
                            {{ $news->title }}
                        </h1>

                        <!-- Article meta information -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-2">
                            <time datetime="{{ $news->created_at->format('Y-m-d') }}" class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $news->created_at->format('d/m/Y') }}
                            </time>

                            @if($news->author)
                                <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $news->author }}
                            </span>
                            @endif

                            <!-- Reading time estimation -->
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ ceil(str_word_count(strip_tags($news->content)) / 200) }} min de lectura
                            </span>
                        </div>

                        <!-- Tags or categories if available -->
                        @if($news->tags && $news->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($news->tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-600/20 text-orange-300 border border-orange-600/30">
                                {{ $tag->name }}
                            </span>
                                @endforeach
                            </div>
                        @endif
                    </header>

                    <!-- Article content with enhanced typography -->
                    <div class="prose prose-lg prose-invert max-w-none text-gray-300 leading-relaxed">
                        <div class="article-content animate-fade-in-up" style="animation-delay: 0.2s;">
                            {!! $news->content !!}
                        </div>
                    </div>

                    <!-- Social sharing buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-700">
                        <h3 class="text-lg font-semibold text-white mb-4">Compartir artículo</h3>
                        <div class="flex flex-wrap gap-3">
                            <button onclick="shareOnFacebook()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Facebook
                            </button>
                            <button onclick="shareOnTwitter()" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                Twitter
                            </button>
                            <button onclick="shareOnWhatsApp()" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Enhanced navigation with better UX -->
            <nav class="mt-10 flex flex-col sm:flex-row justify-center gap-4" aria-label="Navegación de artículo">
                <a href="{{ route('news.index') }}"
                   class="group inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Ver más noticias
                </a>
                <a href="{{ route('home') }}"
                   class="group inline-flex items-center justify-center gap-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Ir al inicio
                </a>
            </nav>
        </div>
    </div>

    <!-- Add custom styles and JavaScript -->
    <style>
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.5);
        }

        img.loaded {
            opacity: 1;
        }

        .article-content {
            line-height: 1.8;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2, .article-content h3, .article-content h4 {
            color: #ffffff;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
    </style>

    <script>
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('{{ addslashes($news->title) }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
        }

        function shareOnWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('{{ addslashes($news->title) }} - ');
            window.open(`https://wa.me/?text=${text}${url}`, '_blank');
        }

        // Smooth scroll animation for better reading experience
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-fade-in-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            });

            elements.forEach(el => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });
        });
    </script>
</div>
