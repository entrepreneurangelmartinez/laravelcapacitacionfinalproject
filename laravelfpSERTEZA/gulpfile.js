// var gulp = require('gulp');

// gulp.task('default', function() {
//   // place code for your default task here
// });

// var elixir = require('laravel-elixir');
// require('laravel-elixir-vue-2'); // recommended for vue 2
// elixir(function(mix) {
//     // some mixes here..
//     mix.webpack('app.js');
// });

var elixir = require('laravel-elixir');

// Laravel Elixir provides a clean, fluent API for defining basic Gulp tasks for your Laravel application. Elixir supports common CSS and JavaScript pre-processors like Sass and Webpack. Using method chaining, Elixir allows you to fluently define your asset pipeline.
elixir(function(mix) {
    mix.sass('app.scss')

    .styles([
        'libs/blog-post.css',
        'libs/bootstrap.css',
        'libs/font-awesome.css',
        'libs/metisMenu.css',
        'libs/sb-admin-2.css'
    ], './public/css/libs.css')

    .scripts([
        'libs/jquery.js',
        'libs/bootstrap.js',
        'libs/metisMenu.js',
        'libs/scripts.js',
        'libs/sb-admin-2.js'
    ], './public/js/libs.js')
});