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
mix.copyDirectory('resources/img', 'public/img');
mix.copyDirectory('resources/css', 'public/css');
// mix.copyDirectory('node_modules/bootstrap/dist', 'public/bootstrap');
// mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/font-awesome/css');
// mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/font-awesome/webfonts');
// mix.copyDirectory('node_modules/ionicons/dist/css', 'public/ionicons/css');
// mix.copyDirectory('node_modules/ionicons/dist/fonts', 'public/ionicons/fonts');
mix.copy('node_modules/jquery-autosize/jquery.autosize.min.js', 'public/plugins/autosize/jquery.autosize.min.js');
mix.copyDirectory('node_modules/chosen-js', 'public/plugins/chosen');
mix.copyDirectory('node_modules/bootstrap-datepicker/dist/locales', 'public/plugins/datepicker/locales');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'public/plugins/datepicker/bootstrap-datepicker.js');
mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'public/plugins/datepicker/datepicker3.css');
mix.copy('node_modules/daterangepicker/daterangepicker.css', 'public/plugins/daterangepicker/daterangepicker.css');
mix.copy('node_modules/daterangepicker/daterangepicker.js', 'public/plugins/daterangepicker/daterangepicker.js');
mix.copy('node_modules/daterangepicker/moment.min.js', 'public/plugins/daterangepicker/moment.min.js');
//mix.copy('node_modules/fastclick/lib/fastclick.js', 'public/plugins/fastclick/fastclick.js');
//mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/plugins/jQuery/jquery.min.js');
// mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/plugins/jQueryUI/jquery-ui.min.js');
// mix.copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/plugins/slimScroll/jquery.slimscroll.min.js');
// mix.copy('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'public/plugins/timepicker/bootstrap-timepicker.min.css');
// mix.copy('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js', 'public/plugins/timepicker/bootstrap-timepicker.min.js');
mix.copyDirectory('node_modules/sweetalert2/dist', 'public/plugins/sweetalert2');
mix.copyDirectory('node_modules/datatables.net', 'public/plugins/datatables.net');
mix.copyDirectory('node_modules/datatables.net-bs4', 'public/plugins/datatables.net-bs4');
mix.copyDirectory('node_modules/datatables.net-buttons', 'public/plugins/datatables.net-buttons');
mix.copyDirectory('node_modules/datatables.net-buttons-bs4', 'public/plugins/datatables.net-buttons-bs4');
//mix.copyDirectory('node_modules/admin-lte/dist/css', 'public/dist/css');
mix.copyDirectory('node_modules/admin-lte/dist/img', 'public/img');
// mix.copy('node_modules/admin-lte/dist/js/adminlte.js', 'public/dist/js/adminlte.js');
// mix.copy('node_modules/admin-lte/dist/js/adminlte.4min.js', 'public/dist/js/adminlte.min.js');
mix.copyDirectory('node_modules/bootstrap-switch/dist/css/bootstrap3', 'public/plugins/bootstrap-switch/css');
mix.copyDirectory('node_modules/bootstrap-switch/dist/js', 'public/plugins/bootstrap-switch/js');
mix.copyDirectory('node_modules/angular', 'public/plugins/angular');
mix.copyDirectory('node_modules/bootstrap-colorpicker/dist', 'public/plugins/bootstrap-colorpicker');
mix.copyDirectory('node_modules/fullcalendar/dist', 'public/plugins/fullcalendar');
mix.copyDirectory('node_modules/jquery-datetimepicker/build', 'public/plugins/jquery-datetimepicker');
mix.copyDirectory('node_modules/jquery-validation/dist', 'public/plugins/jquery-validation');
mix.copy('node_modules/morris.js.so/morris.css', 'public/plugins/morris.js.so/morris.css');
mix.copy('node_modules/morris.js.so/morris.js', 'public/plugins/morris.js.so/morris.js');
mix.copy('node_modules/morris.js.so/morris.min.js', 'public/plugins/morris.js.so/morris.min.js');
mix.copy('node_modules/raphael/raphael.js', 'public/plugins/raphael/raphael.js');
mix.copy('node_modules/raphael/raphael.min.js', 'public/plugins/raphael/raphael.min.js');
mix.copy('node_modules/moment/moment.js', 'public/plugins/moment/moment.js');
mix.copy('node_modules/moment/min/moment.min.js', 'public/plugins/moment/moment.min.js');
