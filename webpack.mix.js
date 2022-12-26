const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.
	js('resources/js/app.js', 'public/js/app.js').
		js('resources/js/script-cacar.js', 'public/js/script-cacar.js').
			js('resources/js/script-dados-usuario.js', 'public/js/script-dados-usuario.js').
					css('resources/css/app.css', 'public/css/app.css');
