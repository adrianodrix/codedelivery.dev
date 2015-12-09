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

//Globals Variables
var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

var config = {
    assets_path: './resources/assets',
    build_path:  './public/build',
    bower_path:  './resources/bower_components',
};

//Java Scripts
config.build_path_js = config.build_path + '/js';
config.build_vendor_path_js = config.build_path_js + '/vendor';
config.vendor_path_js = [
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-aria/angular-aria.min.js',
    config.bower_path + '/angular-material/angular-material.min.js',
    config.bower_path + '/angular-material-data-table/dist/md-data-table.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-locale-pt-br/angular-locale_pt-br.js',
    config.bower_path + '/angular-cookies/angular-cookies.min.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.min.js',
    config.bower_path + '/angular-sanitize/angular-sanitize.min.js',
    config.bower_path + '/angular-touch/angular-touch.min.js',
    config.bower_path + '/angular-loading-bar/build/loading-bar.min.js',
    config.bower_path + '/ngstorage/ngStorage.min.js',
    config.bower_path + '/angular-ui-router/release/angular-ui-router.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap-tpls.min.js',
    config.bower_path + '/oclazyload/dist/ocLazyLoad.min.js',
    config.bower_path + '/angular-loading-bar/build/loading-bar.min.js',
];

//CSS Style Sheets
config.build_path_css = config.build_path + '/css';
config.build_vendor_path_css = config.build_path_css + '/vendor';
config.vendor_path_css = [
    config.bower_path + '/angular-material/angular-material.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/angular-loading-bar/build/loading-bar.min.css',
    config.bower_path + '/animate.css/animate.min.css',
    config.bower_path + '/font-awesome/css/font-awesome.min.css',
];

//HTML, Fonts, Images
config.build_path_html   = config.build_path + '/html';
config.build_path_fonts  = config.build_path + '/fonts';
config.build_path_images = config.build_path + '/images';
config.build_path_libs   = config.build_path + '/libs';

//Tasks
gulp.task('copy-libs', function(){
    gulp.src([
            config.assets_path + '/libs/**/*'
        ])
        .pipe(gulp.dest(config.build_path_libs))
        .pipe(liveReload());
});

gulp.task('copy-fonts', function(){
    gulp.src([
            config.assets_path + '/fonts/**/*'
        ])
        .pipe(gulp.dest(config.build_path_fonts))
        .pipe(liveReload());
});

gulp.task('copy-images', function(){
    gulp.src([
            config.assets_path + '/images/**/*'
        ])
        .pipe(gulp.dest(config.build_path_images))
        .pipe(liveReload());
});

gulp.task('copy-html', function(){
    gulp.src([
            config.assets_path + '/views/**/*.html'
        ])
        .pipe(gulp.dest(config.build_path_html))
        .pipe(liveReload());
});

gulp.task('copy-styles', function () {
    //Dev Files
    gulp.src([
            config.assets_path + '/css/**/*.css'
        ])
        .pipe(gulp.dest(config.build_path_css))
        .pipe(liveReload());

    //Vendor Files
    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_vendor_path_css))
        .pipe(liveReload());
});

gulp.task('copy-scripts', function () {
    //Dev Files
    gulp.src([
            config.assets_path + '/js/**/*.js'
        ])
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());

    //Vendor Files
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_vendor_path_js))
        .pipe(liveReload());
});

//Clean
gulp.task('clear-build-folder', function(){
    clean.sync(config.build_path);
    clean.sync('./public/css');
    clean.sync('./public/js');
});

//Watch
gulp.task('watch-dev',['clear-build-folder'], function(){
    liveReload.listen();
    gulp.start(
        'copy-styles', 'copy-libs', 'copy-scripts', 'copy-html', 'copy-fonts', 'copy-images'
    );
    gulp.watch(config.assets_path + '/**',[
        'copy-styles', 'copy-libs', 'copy-scripts', 'copy-html', 'copy-fonts', 'copy-images'
    ]);
});

//Default
gulp.task('default',['clear-build-folder'], function(){
    gulp.start('copy-html', 'copy-libs', 'copy-fonts', 'copy-images');

    elixir(function(mix){
        mix.styles(
            config.vendor_path_css
                .concat([
                    config.assets_path + '/css/**/*.css'
                ]),
            'public/css/all.css', config.assets_path);

        mix.scripts(
            config.vendor_path_js
                .concat([
                    config.assets_path + '/js/**/*.js'
                ]),
            'public/js/all.js', config.assets_path);

        mix.version(['js/all.js', 'css/all.css']);
    })
});