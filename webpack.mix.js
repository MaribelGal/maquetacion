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

mix.js('resources/js/admin/app.js', 'public/admin/js').version()
    .sass('resources/sass/admin/app.scss', 'public/admin/css').version()
    .js('resources/js/front/desktop/app.js', 'public/front/desktop/js').version()
    .sass('resources/sass/front/desktop/app.scss', 'public/front/desktop/css').version()
    .js('resources/js/front/mobile/app.js', 'public/front/mobile/js').version()
    .sass('resources/sass/front/mobile/app.scss', 'public/front/mobile/css').version();

