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

// mix.js('resources/assets/js/app.js', 'resources/assets/js')
//    .sass('resources/assets/sass/app.scss', 'resources/assets/css');

mix.styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/bootstrap-switch.css',
    'resources/assets/css/bootstrap-toggle.min.css',
    'resources/assets/css/core.css',
    'resources/assets/css/components.css',
    'resources/assets/css/top.css',
    'resources/assets/css/news.css',
    'resources/assets/css/main.css'
], 'public/css/app.css');

mix.styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/core.css',
    'resources/assets/css/components.css',
    'resources/assets/css/colors.css'
], 'public/css/auth.css');

mix.styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/bootstrap-switch.css',
    'resources/assets/css/bootstrap-toggle.min.css',
    'resources/assets/css/core.css',
    'resources/assets/css/components.css',
    'resources/assets/css/colors.css',
    'resources/assets/css/rSlider.min.css',
    'resources/assets/css/admin.css',
], 'public/css/admin.css');

mix.styles([
    'resources/assets/css/docs.css'
], 'public/css/docs.css');

mix.scripts([
    'resources/assets/js/core/libraries/jquery.min.js',
    'resources/assets/js/libraries/bootstrap.min.js',
    'resources/assets/js/plugins/forms/styling/uniform.min.js',
    'resources/assets/js/plugins/forms/styling/bootstrap-switch.js',
    'resources/assets/js/plugins/forms/styling/switchery.min.js',
    'resources/assets/js/plugins/media/fancybox.min.js',
    'resources/assets/js/scrollreveal.min.js',
    'resources/assets/js/jquery.easing.1.3.js',
    'resources/assets/js/news.js',
    'resources/assets/js/main.js'
], 'public/js/app.js');

mix.scripts([
    'resources/assets/js/core/libraries/jquery.min.js',
    'resources/assets/js/core/libraries/bootstrap.min.js',
    'resources/assets/js/plugins/forms/styling/uniform.min.js',
    'resources/assets/js/core/app.js',
    'resources/assets/js/pages/login.js'
], 'public/js/auth.js');

mix.scripts([
    'resources/assets/js/plugins/loaders/pace.min.js',
    'resources/assets/js/core/libraries/jquery.min.js',
    'resources/assets/js/core/libraries/bootstrap.min.js',
    'resources/assets/js/plugins/forms/styling/uniform.min.js',
    'resources/assets/js/plugins/forms/styling/switchery.min.js',
    'resources/assets/js/plugins/forms/styling/bootstrap-switch.js',
    'resources/assets/js/plugins/forms/styling/bootstrap-toggle.min.js',
    'resources/assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js',
    'resources/assets/js/plugins/forms/inputs/typeahead/handlebars.min.js',
    'resources/assets/js/plugins/ui/moment/moment.min.js',
    'resources/assets/js/plugins/pickers/daterangepicker.js',
    'resources/assets/js/plugins/pickers/anytime.min.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.date.js',
    'resources/assets/js/plugins/pickers/pickadate/picker.time.js',
    'resources/assets/js/plugins/pickers/pickadate/legacy.js',
    'resources/assets/js/pages/picker_date.js',
    'resources/assets/js/plugins/tables/datatables/datatables.min.js',
    'resources/assets/js/plugins/forms/selects/select2.min.js',
    'resources/assets/js/plugins/media/fancybox.min.js',
    'resources/assets/js/pages/datatables_basic.js',
    'resources/assets/js/pages/gallery.js',
    'resources/assets/js/plugins/pickers/color/spectrum.js',
    'resources/assets/js/core/main.controls.js',
    'resources/assets/js/pages/picker_color.js',
    'resources/assets/js/jquery.maskedinput.min.js',
    'resources/assets/js/plugins/ui/nicescroll.min.js',
    'resources/assets/js/core/app.js',
    'resources/assets/js/rSlider.min.js',
    'resources/assets/js/admin.js'
], 'public/js/admin.js');

mix.scripts([
    'resources/assets/js/core/libraries/jquery.min.js',
    'resources/assets/js/docs.js'
], 'public/js/docs.js');