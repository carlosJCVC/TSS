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

mix.styles([
    'resources/assets/template/css/font-awesome.min.css',
    'resources/assets/template/css/simple-line-icons.min.css',
    'resources/assets/template/css/select2.css',
    'resources/assets/template/css/style.css',
 ], 'public/css/template.css')
    .scripts([
    'resources/assets/template/js/jquery.min.js',
    'resources/assets/template/js/popper.min.js',
    'resources/assets/template/js/bootstrap.min.js',
    'resources/assets/template/js/Chart.min.js',
    'resources/assets/template/js/pace.min.js',
    'resources/assets/template/js/select2.js',
    'resources/assets/template/js/template.js',
 ], 'public/js/template.js');


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
