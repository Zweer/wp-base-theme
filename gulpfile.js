'use strict';

const gulp = require('gulp');
const $ = require('gulp-load-plugins')();
const del = require('del');
const runSequence = require('run-sequence');
const webpack = require('webpack');

const webpackConfig = require('./webpack.config.js');

// Same as bootstrap v4
const browsers = [
    'Android 2.3',
    'Android >= 4',
    'Chrome >= 35',
    'Firefox >= 31',
    'Explorer >= 9',
    'iOS >= 7',
    'Opera >= 12',
    'Safari >= 7.1'
];

const createCopyTask = function (name, dependencies, src, dest) {
    gulp.task(name, dependencies, function () {
        return gulp
            .src(src)
            .pipe(gulp.dest(dest))
            .pipe($.size({ title: name }));
    });
};

gulp.task('clean', del.bind(null, ['_scss/vendor', '_js/vendor', 'img/vendor', 'css', 'js']));
gulp.task('clean:bower', del.bind(null, ['bower_components']));

gulp.task('bower', function () {
    return $
        .bower()
        .pipe($.size({ title: 'bower' }));
});

createCopyTask('bower:js', ['bower'], [/* 'bower_components/library_not_in_npm/main.js */], '_js/vendor');
createCopyTask('bower:scss', ['bower'], [/* 'bower_components/library_with_scss_or_css/style.scss */], '_scss/vendor');
createCopyTask('bower:scss:bootstrap', ['bower'], ['bower_components/bootstrap/scss/**/*.scss'], '_scss/vendor/bootstrap');
createCopyTask('bower:scss:fontawesome', ['bower'], ['bower_components/font-awesome/scss/**/*.scss'], '_scss/vendor/font-awesome');
createCopyTask('bower:font:fontawesome', ['bower'], ['bower_components/font-awesome/fonts/*'], 'fonts/vendor/font-awesome');

gulp.task('scss', function () {
    return gulp
        .src(['_scss/*.scss'])
        .pipe($.sourcemaps.init())
        .pipe($.sass({ outputStyle: 'compressed' }).on('error', $.sass.logError))
        .pipe($.autoprefixer({ browsers: browsers, cascade: false }))
        .pipe($.rename({ suffix: '.min' }))
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest('css'))
        .pipe($.size({ title: 'scss' }));
});

gulp.task('webpack', function (done) {
    webpack(webpackConfig, function (err, stats) {
        if (err) {
            throw new $.util.PluginError('webpack', err);
        }

        $.util.log('[webpack]', stats.toString());

        done();
    });
});

gulp.task('modernizr', ['webpack'], function () {
    return gulp
        .src('_js/**/*')
        .pipe($.modernizr({
            "options": [
                "prefixed",
                "setClasses"
            ]
        }))
        .pipe($.sourcemaps.init())
        .pipe($.rename({ suffix: '.min' }))
        .pipe($.uglify())
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest('js/'));
});

gulp.task('watch', function () {
    gulp.watch(['_scss/**/*'], ['scss']);
    gulp.watch(['_js/**/*'], ['modernizr']);
});

gulp.task('default', function (done) {
    runSequence(
        'clean',
        ['bower:js', 'bower:scss', 'bower:scss:bootstrap', 'bower:scss:fontawesome', 'bower:font:fontawesome'],
        'scss',
        'clean:bower',
        'modernizr',
        done
    );
});

gulp.task('dev', ['default'], function (done) {
    runSequence(['watch'], done);
});