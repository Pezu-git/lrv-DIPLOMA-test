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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.styles([
    'resources/admin/css/normalize.css',
    'resources/admin/css/styles.css',
], 'public/css/admin_moonbase.css');

mix.styles([
    'resources/client/css/styles.css',
], 'public/css/client_moonbase.css');
mix.styles([
    'resources/client/css/normalize.css',
], 'public/css/client_normolize_moonbase.css');



mix.js([
    'resources/admin/js/accordeon.js',
    'resources/admin/js/hallPrice.js',
    'resources/admin/js/halls.js',
    'resources/admin/js/hallScreen.js',
    'resources/admin/js/movie.js',
    'resources/admin/js/popupCancelBtn.js',
    'resources/admin/js/startOfSales.js',
    'resources/admin/js/schedule.js',
],
    
    'public/js/admin_moonbase.js');
 
    mix.js([
    'resources/client/js/choosingPlace.js',
],
    
 'public/js/client_moonbase.js');