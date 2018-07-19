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
//    .sass('resources/assets/sass/app.scss', 'public/css');
//dist
//adminlte

mix.copyDirectory('node_modules/bootstrap/dist', 'public/assets/bootstrap');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/assets/font-awesome/css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/font-awesome/webfonts');
mix.copyDirectory('node_modules/ionicons/dist/css', 'public/assets/ionicons/css');
mix.copyDirectory('node_modules/ionicons/dist/fonts', 'public/assets/ionicons/fonts');
mix.copy('node_modules/jquery-autosize/jquery.autosize.min.js', 'public/assets/plugins/autosize/jquery.autosize.min.js');
mix.copyDirectory('node_modules/chosen-js', 'public/assets/plugins/chosen');
mix.copyDirectory('node_modules/bootstrap-datepicker/dist/locales', 'public/assets/plugins/datepicker/locales');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'public/assets/plugins/datepicker/bootstrap-datepicker.js');
mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'public/assets/plugins/datepicker/datepicker3.css');
mix.copy('node_modules/daterangepicker/daterangepicker.css', 'public/assets/plugins/daterangepicker/daterangepicker.css');
mix.copy('node_modules/daterangepicker/daterangepicker.js', 'public/assets/plugins/daterangepicker/daterangepicker.js');
mix.copy('node_modules/daterangepicker/moment.min.js', 'public/assets/plugins/daterangepicker/moment.min.js');
mix.copy('node_modules/fastclick/lib/fastclick.js', 'public/assets/plugins/fastclick/fastclick.js');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/plugins/jQuery/jquery.min.js');
mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/assets/plugins/jQueryUI/jquery-ui.min.js');
mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/assets/plugins/slimScroll/jquery.slimscroll.min.js');
mix.copy('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'public/assets/plugins/timepicker/bootstrap-timepicker.min.css');
mix.copy('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js', 'public/assets/plugins/timepicker/bootstrap-timepicker.min.js');
mix.copy('node_modules/typeahead.js/dist/typeahead.bundle.js', 'public/assets/plugins/typeahead/typeahead.bundle.js');
mix.copyDirectory('node_modules/sweetalert2/dist', 'public/assets/plugins/sweetalert2');
mix.copyDirectory('node_modules/datatables.net', 'public/assets/plugins/datatables.net');
mix.copyDirectory('node_modules/datatables.net-bs', 'public/assets/plugins/datatables.net-bs');
mix.copyDirectory('node_modules/datatables.net-buttons', 'public/assets/plugins/datatables.net-buttons');
mix.copyDirectory('node_modules/datatables.net-buttons-bs', 'public/assets/plugins/datatables.net-buttons-bs');
//mix.copyDirectory('node_modules/admin-lte/dist/css', 'public/assets/dist/css');
mix.copyDirectory('node_modules/admin-lte/dist/img', 'public/assets/dist/img');
mix.copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/assets/dist/js/adminlte.js');
mix.copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/assets/dist/js/adminlte.min.js');