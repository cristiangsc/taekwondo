import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                `resources/views/**/*`,
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    server: {
        cors: true,
    },
});
