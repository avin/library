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

elixir(function (mix) {
    mix.less(['master.less'], 'public/assets/css/master.css');
    mix.less(['auth.less'], 'public/assets/css/auth.css');

    //CSS
    mix.copy('resources/assets/bower/font-awesome/fonts/', 'public/assets/fonts/');
    mix.copy('resources/assets/bower/select2/dist/css/select2.css', 'public/assets/css/');
    mix.copy('resources/assets/bower/bootstrap/dist/css/bootstrap.css', 'public/assets/css/');
    mix.copy('resources/assets/bower/font-awesome/css/font-awesome.css', 'public/assets/css/');

    //JS
    mix.copy('resources/assets/bower/jquery/dist/jquery.js', 'public/assets/js/');
    mix.copy('resources/assets/bower/bootstrap/dist/js/bootstrap.js', 'public/assets/js/');
    mix.copy('resources/assets/bower/select2/dist/js/select2.js', 'public/assets/js/');
});
