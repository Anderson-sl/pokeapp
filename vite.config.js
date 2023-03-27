import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const config = defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/jquery-3.5.1.min.js',
                'resources/js/script-cacar.js',
                'resources/js/script-dados-usuario.js',
                'resources/img/logo-crud-3.png',
                'resources/img/menu-mobile-hover.png',
                'resources/img/menu-mobile.png',
                'resources/img/pokemon.png',
            ],
            refresh: true,
        }),
    ],
    base: 'https://asset.kind-cheetah-34.telebit.io',
    envDir: './'
});

console.log('Conf - ', {...config.plugins.configureServer}, {...config.plugins.config})

export default config;