import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        host: '0.0.0.0',        // écoute sur toutes les interfaces
        port: 5173,
        hmr: {
            host: '54.38.146.214',  // ton IP publique
        },
    },
});
