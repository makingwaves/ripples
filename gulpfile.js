// ## Globals
/*global $:true*/
var $ = require('gulp-load-plugins')();
var argv = require('yargs').argv;
var browserSync = require('browser-sync');
var gulp = require('gulp');
var lazypipe = require('lazypipe');
var merge = require('merge-stream');
var bower = require('gulp-bower');

//FIXME: Not even close


// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.
gulp.task('default', ['clean', 'bower-install'], function () {
    gulp.start('build');
});

gulp.task('bower-install', function () {
    return bower().on('end', function() {
        console.log('Bower components installed');
    });
});

// ### Setup
// `gulp setup` - Set up the project
//gulp.task('setup', ['bower-install']);