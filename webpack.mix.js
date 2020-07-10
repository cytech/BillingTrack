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
mix.copyDirectory('resources/public', 'public');
mix.copyDirectory('resources/img', 'public/img');
mix.copyDirectory('resources/css', 'public/css');
mix.copyDirectory('node_modules/jquery-ui-built-themes', 'public/css/jquery-ui-themes');
mix.copy('node_modules/jquery-autosize/jquery.autosize.min.js', 'public/plugins/autosize/jquery.autosize.min.js');
mix.copyDirectory('node_modules/chosen-js', 'public/plugins/chosen');
mix.copy('node_modules/daterangepicker/daterangepicker.css', 'public/plugins/daterangepicker/daterangepicker.css');
mix.copy('node_modules/daterangepicker/daterangepicker.js', 'public/plugins/daterangepicker/daterangepicker.js');
mix.copyDirectory('node_modules/datatables.net', 'public/plugins/datatables.net');
mix.copyDirectory('node_modules/datatables.net-bs4', 'public/plugins/datatables.net-bs4');
mix.copyDirectory('node_modules/datatables.net-buttons', 'public/plugins/datatables.net-buttons');
mix.copyDirectory('node_modules/datatables.net-buttons-bs4', 'public/plugins/datatables.net-buttons-bs4');
mix.copyDirectory('node_modules/bootstrap-colorpicker/dist', 'public/plugins/bootstrap-colorpicker');
mix.copy('node_modules/fullcalendar/main.min.js', 'public/plugins/fullcalendar/main.min.js')
mix.copy('node_modules/fullcalendar/main.min.css', 'public/plugins/fullcalendar/main.min.css')
mix.copyDirectory('node_modules/jquery-datetimepicker/build', 'public/plugins/jquery-datetimepicker');
mix.copyDirectory('node_modules/jquery-validation/dist', 'public/plugins/jquery-validation');
mix.copy('node_modules/morris.js.so/morris.css', 'public/plugins/morris.js.so/morris.css');
mix.copy('node_modules/morris.js.so/morris.js', 'public/plugins/morris.js.so/morris.js');
mix.copy('node_modules/morris.js.so/morris.min.js', 'public/plugins/morris.js.so/morris.min.js');
mix.copy('node_modules/raphael/raphael.js', 'public/plugins/raphael/raphael.js');
mix.copy('node_modules/raphael/raphael.min.js', 'public/plugins/raphael/raphael.min.js');
mix.copy('node_modules/moment/moment.js', 'public/plugins/moment/moment.js');
mix.copy('node_modules/moment/min/moment.min.js', 'public/plugins/moment/moment.min.js');
