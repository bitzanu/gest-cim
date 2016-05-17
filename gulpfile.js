var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var elixir = require('laravel-elixir');

var paths = {
'bower_base_path': './vendor/bower_components/',
'bootstrap': './vendor/bower_components/bootstrap-sass/assets/'
};

elixir(function (mix) {
mix.sass('app.scss')
.copy(paths.bootstrap + 'stylesheets/', 'resources/assets/sass')
.copy(paths.bootstrap + 'fonts/bootstrap', 'public/fonts')
.copy(paths.bootstrap + 'javascripts/bootstrap.min.js', 'public/js/vendor/bootstrap.min.js')
.copy(paths.bower_base_path + 'jquery-ui/ui/datepicker.js', 'public/js/vendor/datepicker.js')
.copy(paths.bower_base_path + 'jquery/dist/jquery.min.js', 'public/js/vendor/jquery.min.js')
.copy(paths.bower_base_path + 'font-awesome/css/font-awesome.min.css', 'public/css/vendor/font-awesome.css')
.copy(paths.bower_base_path + 'moment/min/moment.min.js', 'public/js/vendor/moment.min.js')
.copy(paths.bower_base_path + 'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 'public/js/vendor/bootstrap-datetimepicker.min.js')
.copy(paths.bower_base_path + 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 'public/css/vendor/bootstrap-datetimepicker.min.css')

});
