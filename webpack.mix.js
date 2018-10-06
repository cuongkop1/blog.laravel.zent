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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
//    .sass('resources/assets/sass/main.scss', 'public/css');
// mix.styles(['resources/assets/sass/app.scss','resources/assets/sass/main.scss'
// 	],'public/css/all.css');
	mix.babel('resources/assets/css/adminlte.css','public/admin_assets/dist/css/adminlte.min.css');
	mix.babel('resources/assets/js/jquery.js','public/admin_assets/dist/js/jquery.min.js');
	mix.babel('resources/assets/js/adminlte.js','public/admin_assets/dist/js/adminlte.min.js');
	mix.babel('resources/assets/js/bootstrap.bundle.js','public/admin_assets/dist/js/bootstrap.bundle.min.js');
	mix.babel('resources/assets/js/demo.js','public/admin_assets/dist/js/demo.min.js');
	mix.babel('resources/assets/js/fastclick.js','public/admin_assets/dist/js/fastclick.min.js');
if (mix.inProduction()) {
    mix.version();
}