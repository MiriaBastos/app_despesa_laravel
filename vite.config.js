import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'public/dist/css/adminlte.min.css',

                'resources/js/app.js',
                'public/dist/js/adminlte.min.js',
            ],
            refresh: true,
        }),
    ],
});
