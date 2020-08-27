const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'node_modules/gentelella/build/css/custom.min.css'
], 'public/assets/gentelella/css/gentelella.css');

mix.scripts([
    'node_modules/gentelella/build/js/custom.min.js'
], 'public/assets/gentelella/js/gentelella.js');

mix.copy('node_modules/gentelella/vendors/', 'public/assets/gentelella/vendors');
mix.copy('node_modules/gentelella/production/images/', 'public/assets/gentelella/images');
