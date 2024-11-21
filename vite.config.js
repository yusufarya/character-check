import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // CSS utama
                'resources/js/app.js',    // JS utama

                'resources/js/character_check/index.js',
                'resources/js/character_frequency/index.js',
                'resources/js/character_frequency/create.js'
            ],
            refresh: true,
        }),
    ],
});
