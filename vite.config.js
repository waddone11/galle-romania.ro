import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ command }) => ({
    // In dev, Vite serveste CSS-ul de pe originea lui, deci url('/images/...')
    // din app.css se cere de la serverul Vite. Servim public/ doar pe `serve`
    // (la build ramane dezactivat — altfel ar copia tot public/ in build/).
    publicDir: command === 'serve' ? 'public' : false,
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Bricolage Grotesque', {
                    weights: [400, 500, 600, 700, 800],
                }),
                bunny('DM Sans', {
                    weights: [400, 500, 600, 700],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
}));
