// ## Globals
/*global $:true*/
var $ = require('gulp-load-plugins')();
var argv = require('yargs').argv;
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var gulp = require('gulp');
var lazypipe = require('lazypipe');
var shell = require('gulp-shell');

var path = {
    source: 'assets/',
    dist: 'dist/'
};

// CLI options
var enabled = {
    // Enable static asset revisioning when `--production`
    rev: argv.production,
    // Disable source maps when `--production`
    maps: !argv.production,
    // Fail styles task on error when `--production`
    failStyleTask: argv.production
};

var cssTasks = function () {
    return lazypipe()
        .pipe(function () {
            return $.if(!enabled.failStyleTask, $.plumber());
        })
        .pipe(function () {
            return $.if(enabled.maps, $.sourcemaps.init());
        })
        .pipe(function () {
            return $.compass({
                config_file: './config.rb',
                css: 'dist/css',
                sass: 'assets/styles'
            });
        })
        //.pipe($.concat)
        .pipe($.pleeease, {
            autoprefixer: {
                browsers: [
                    'last 2 versions', 'ie 9', 'android 2.3', 'android 4',
                    'opera 12'
                ]
            }
        })
        .pipe(function () {
            return $.if(enabled.maps, $.sourcemaps.write('.'));
        })();
};

// ### JS processing pipeline
// Example
// ```
// gulp.src(jsFiles)
//   .pipe(jsTasks('main.js')
//   .pipe(gulp.dest(path.dist + 'scripts'))
// ```
var jsTasks = function (filename) {
    return lazypipe()
        .pipe(function () {
            return $.if(enabled.maps, $.sourcemaps.init());
        })
        .pipe($.concat, filename)
        .pipe($.uglify)
        .pipe(function () {
            return $.if(enabled.maps, $.sourcemaps.write('.'));
        })();
};

gulp.task('scripts', function () {
    return gulp.src(path.source + 'scripts/main.js')
        .pipe(jsTasks('main.js'))
        .pipe(gulp.dest(path.dist + 'scripts'))
        .pipe(reload({stream: true}));
});

gulp.task('rjs-shell', shell.task([
    'r.js -o build/rjs-build.js'
]));

// ### JSHint
// `gulp jshint` - Lints configuration JSON and project JS.
gulp.task('jshint', function () {
    return gulp.src([
        'bower.json', 'gulpfile.js', 'assets/scripts/**/*'
    ])
        .pipe($.jshint())
        .pipe($.jshint.reporter('jshint-stylish'))
        .pipe($.jshint.reporter('fail'));
});

gulp.task('styles', function () {
    return gulp.src([
        path.source + "styles/main.scss",
        path.source + "styles/editor-style.scss"
    ])
        .pipe(cssTasks())
        .pipe(gulp.dest('dist/styles'))
        .pipe(reload({stream: true}));
});

// ### Fonts
// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
gulp.task('fonts', function () {
    return gulp.src(["assets/fonts/**/*"])
        .pipe($.flatten())
        .pipe(gulp.dest(path.dist + 'fonts'));
});


// ### Images
// `gulp images` - Run lossless compression on all the images.
gulp.task('images', function () {
    return gulp.src([
        "assets/images/**/*",
        "!assets/images/_debug/",
        "!assets/images/_debug/**"
    ])
        .pipe($.imagemin({
            progressive: true,
            interlaced: true,
            svgoPlugins: [{removeUnknownsAndDefaults: false}]
        }))
        .pipe(gulp.dest(path.dist + 'images'));
});

gulp.task('watch', function () {
    browserSync({
        proxy: "http://makingpress.mw",
        snippetOptions: {
            whitelist: ['/wp-admin/admin-ajax.php'],
            blacklist: ['/wp-admin/**']
        }
    });
    //console.log(path.source + 'styles/**/*');
    gulp.watch([path.source + 'styles/**/*'], ['styles']);
    gulp.watch([path.source + 'scripts/**/*'], ['jshint', 'scripts']);
    gulp.watch([path.source + 'fonts/**/*'], ['fonts']);
    gulp.watch([path.source + 'images/**/*'], ['images']);

    gulp.watch('**/*.php', function () {
        browserSync.reload();
    });
});

// ### Build
// `gulp build` - Run all the build tasks but don't clean up beforehand.
// Generally you should be running `gulp` instead of `gulp build`.
gulp.task('build', ['styles', 'scripts', 'fonts', 'images']);

// ### Clean
// `gulp clean` - Deletes the build folder entirely.
gulp.task('clean', require('del').bind(null, [path.dist]));

gulp.task('bower-install', function () {
    return $.bower().on('end', function () {
        console.log('Bower components installed');
    });
});

// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.
gulp.task('default', ['clean'], function () {
    gulp.start('build');
});

// ### Setup
// `gulp setup` - Set up the project
gulp.task('setup', ['clean', 'bower-install'], function () {
    gulp.start('build');
});
