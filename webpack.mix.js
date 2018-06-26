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

mix.copyDirectory('node_modules/bootstrap/dist', 'assets/bootstrap');
mix.copyDirectory('node_modules/font-awesome/css', 'assets/font-awesome/css');
mix.copyDirectory('node_modules/font-awesome/fonts', 'assets/font-awesome/fonts');
mix.copyDirectory('node_modules/ionicons/dist/css', 'assets/ionicons/css');
mix.copyDirectory('node_modules/ionicons/dist/fonts', 'assets/ionicons/fonts');
mix.copy('node_modules/jquery-autosize/jquery.autosize.min.js', 'assets/plugins/autosize/jquery.autosize.min.js');
mix.copyDirectory('node_modules/chosen-js', 'assets/plugins/chosen');
mix.copyDirectory('node_modules/bootstrap-datepicker/dist/locales', 'assets/plugins/datepicker/locales');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'assets/plugins/datepicker/bootstrap-datepicker.js');
mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'assets/plugins/datepicker/datepicker3.css');
mix.copy('node_modules/daterangepicker/daterangepicker.css', 'assets/plugins/daterangepicker/daterangepicker.css');
mix.copy('node_modules/daterangepicker/daterangepicker.js', 'assets/plugins/daterangepicker/daterangepicker.js');
mix.copy('node_modules/daterangepicker/moment.min.js', 'assets/plugins/daterangepicker/moment.min.js');
mix.copy('node_modules/fastclick/lib/fastclick.js', 'assets/plugins/fastclick/fastclick.js');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'assets/plugins/jQuery/jquery.min.js');
mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'assets/plugins/jQueryUI/jquery-ui.min.js');
mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'assets/plugins/slimScroll/jquery.slimscroll.min.js');
mix.copy('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'assets/plugins/timepicker/bootstrap-timepicker.min.css');
mix.copy('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js', 'assets/plugins/timepicker/bootstrap-timepicker.min.js');
mix.copy('node_modules/typeahead.js/dist/typeahead.bundle.js', 'assets/plugins/typeahead/typeahead.bundle.js');
mix.copyDirectory('node_modules/sweetalert2/dist', 'assets/plugins/sweetalert2');
mix.copyDirectory('node_modules/datatables.net', 'assets/plugins/datatables.net');
mix.copyDirectory('node_modules/datatables.net-bs', 'assets/plugins/datatables.net-bs');
mix.copyDirectory('node_modules/datatables.net-buttons', 'assets/plugins/datatables.net-buttons');
mix.copyDirectory('node_modules/datatables.net-buttons-bs', 'assets/plugins/datatables.net-buttons-bs');
//mix.copyDirectory('node_modules/admin-lte/dist/css', 'assets/dist/css');
mix.copyDirectory('node_modules/admin-lte/dist/img', 'assets/dist/img');
mix.copy('node_modules/admin-lte/dist/js/adminlte.js', 'assets/dist/js/adminlte.js');
mix.copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'assets/dist/js/adminlte.min.js');