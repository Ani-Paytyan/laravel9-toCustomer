const mix = require('laravel-mix');
require('dotenv').config();

mix
  .js('resources/js/app.js', 'public/build/js')
  .sass('resources/scss/app.scss', 'public/build/css')
  .disableSuccessNotifications()
  .version()
  .options({
    processCssUrls: false,
    autoprefixer: { remove: false },
    terser: {
      extractComments: false,
    },
  });

if (!mix.inProduction()) {
  mix.sourceMaps().webpackConfig({ devtool: 'inline-source-map' }).browserSync({
    proxy: process.env.APP_URL,
    notify: false,
    open: false,
  });
}
