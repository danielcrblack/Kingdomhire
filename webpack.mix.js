let mix = require('laravel-mix');

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

if (mix.inProduction()) {
    mix.version();
}

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/datepicker.js', 'public/js')
    .js('resources/assets/js/modal-gallery.js', 'public/js')
    .js('resources/assets/js/vehicle-image-order.js', 'public/js')
    .js('resources/assets/js/vehicle-search.js', 'public/js')
    .js('resources/assets/js/vehicle-search-admin.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
