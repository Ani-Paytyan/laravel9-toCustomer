const mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'public/build/js')
    .js('resources/js/uniqueItem/unique-item.js', 'public/build/js')
    .sass('resources/sass/app.scss', 'public/build/css')
    .version();
