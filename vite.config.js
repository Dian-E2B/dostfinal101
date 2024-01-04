import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: false,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                sourcemapExcludeSources: true, // Exclude source maps for specific filesccc
            }
        },
        sourcemap: false
    }
});
