<section id="about">

    <div class="bg-[#000E27] dark:bg-gray-900 py-16">
        <!-- Título Principal -->
        <div class="container mx-auto px-4 mb-14">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-white">
                Sobre la Escuela
            </h1>
            <div class="w-20 h-1 bg-orange-500 mx-auto"></div>
        </div>

        <!-- Historia, Misión y Visión -->
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Historia -->
                <div class="card bg-blue-950 dark:bg-gray-800 rounded-xl shadow-lg transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-blue-700/70 to-blue-800/70 rounded-t-xl"></div>
                        <div class="relative p-8">
                            <div
                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-white rounded-full">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-center text-white mb-2">Historia</h2>
                        </div>
                    </div>
                    <div class="p-6 text-white">
                        <div>
                            {!! $aboutMe->history ?? '<p>No hay información disponible sobre la historia.</p>' !!}
                        </div>
                    </div>
                </div>

                <!-- Misión -->
                <div
                    class="card bg-orange-950 dark:bg-gray-800 rounded-xl shadow-lg transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-orange-400/70 to-orange-500/70 rounded-t-xl"></div>
                        <div class="relative p-8">
                            <div
                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-white rounded-full">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-center text-white mb-2">Misión</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-white">
                            {!! $aboutMe->mission ?? '<p>No hay información disponible sobre la misión.</p>' !!}
                        </div>
                    </div>
                </div>

                <!-- Visión -->
                <div
                    class="card bg-purple-950 dark:bg-gray-800 rounded-xl shadow-lg transition-transform duration-300 hover:transform hover:scale-105">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-purple-700/70 to-purple-900/70 rounded-t-xl"></div>
                        <div class="relative p-8">
                            <div
                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-white rounded-full">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-center text-white mb-2">Visión</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-white">
                            {!! $aboutMe->vision ?? '<p>No hay información disponible sobre la visión.</p>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .prose-content {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #374151;
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }

        .prose-content p {
            margin-bottom: 1rem;
        }

        .prose-content p:last-child {
            margin-bottom: 0;
        }

        .prose-content img {
            max-width: 100%;
            height: auto;
        }

        .prose-content h1,
        .prose-content h2,
        .prose-content h3,
        .prose-content h4 {
            font-weight: 600;
            line-height: 1.25;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .prose-content ul,
        .prose-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .prose-content li {
            margin-bottom: 0.5rem;
        }

        .prose-content a {
            color: #2563eb;
            text-decoration: underline;
        }

        .dark .prose-content a {
            color: #60a5fa;
        }

        /* Asegurarse de que las tablas no desborden */
        .prose-content table {
            width: 100%;
            table-layout: fixed;
        }

        .prose-content td,
        .prose-content th {
            word-wrap: break-word;
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .prose-content {
                font-size: 0.9rem;
            }
        }

        /* Asegurar que las cards tengan una altura mínima consistente */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card > div:last-child {
            flex-grow: 1;
        }
    </style>
</section>

