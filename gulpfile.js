var $ = require('gulp-load-plugins')(),
    gulp = require('gulp'),
    argv = require('yargs').argv,
    browserSync = require('browser-sync'),
    reload = browserSync.reload,
    filter = require('gulp-filter'),
    lazypipe = require('lazypipe'),
    shell = require('gulp-shell');

var devUrl = "http://example.dev",
    path = {
        source: 'assets/',
        dist: 'dist/'
    },
    enabled = { // CLI options
        // Optimize and combine related scripts together into build layers and minify them via UglifyJS when `--production`
        rjs: argv.production,
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
                css: 'dist/styles',
                sass: 'assets/styles'
            });
        })
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

// ### Scripts
// `gulp scripts`
// and project JS.
gulp.task('scripts', ['jshint'], function () {
    if (enabled.rjs) {
        //prod
        gulp.start(shell.task(['r.js -o build/rjs-build.js']));
    } else {
        //dev
        return gulp.src(path.source + 'scripts/main.js')
            .pipe(reload({stream: true}));
    }
});

// ### JSHint
// `gulp jshint` - Lints configuration JSON and project JS.
gulp.task('jshint', function () {
    return gulp.src([
        'bower.json', 'gulpfile.js', path.source + 'scripts/**/*'
    ])
        .pipe($.jshint())
        .pipe($.jshint.reporter('jshint-stylish'))
        .pipe($.jshint.reporter('fail'));
});

gulp.task('styles', function () {
    return gulp.src(path.source + "styles/*.scss")
        .pipe(cssTasks().on('error', function (err) {
            console.error(err.message);
            this.emit('end');
        }))
        .pipe(gulp.dest('dist/styles'))
        .pipe(filter('**/*.css')) // Filtering stream to only css files
        .pipe(reload({stream: true}));
});

// ### Fonts
// `gulp fonts` - Grabs all the fonts and outputs them in a flattened directory
// structure. See: https://github.com/armed/gulp-flatten
gulp.task('fonts', function () {
    return gulp.src([path.source + "fonts/**/*"])
        .pipe($.flatten())
        .pipe(gulp.dest(path.dist + 'fonts'));
});


// ### Images
// `gulp images` - Run lossless compression on all the images.
gulp.task('images', function () {
    return gulp.src([
        path.source + "images/**/*",
        "!" + path.source + "images/_debug/",
        "!"+ path.source + "images/_debug/**"
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
        proxy: devUrl,
        snippetOptions: {
            whitelist: ['/wp-admin/admin-ajax.php'],
            blacklist: ['/wp-admin/**']
        }
    });
    gulp.watch([path.source + 'styles/**/*'], ['styles']);
    gulp.watch([path.source + 'scripts/**/*'], ['jshint', 'scripts']);
    gulp.watch([path.source + 'fonts/**/*'], ['fonts']);
    gulp.watch([path.source + 'images/**/*'], ['images']);

    gulp.watch('**/*.php', function () {
        browserSync.reload();
    });
});

// ### Clean
// `gulp clean` - Deletes the build folder entirely.
gulp.task('clean', require('del').bind(null, [path.dist]));

gulp.task('bower-install', function () {
    return $.bower().on('end', function () {
        console.log('Bower components installed');
    });
});

// ### Copy
// `gulp copy` - Copy modernizr to dist folder for production
gulp.task('copy', function () {
    return gulp.src(['bower_components/modernizr/modernizr.js'])
        .pipe(gulp.dest(path.dist + 'scripts'));
});

// ### Build
// `gulp build` - Run all the build tasks but don't clean up beforehand.
// Generally you should be running `gulp` instead of `gulp build`.
gulp.task('build', ['styles', 'scripts', 'fonts', 'images']);

// ### Gulp
// `gulp` - Run a complete build. To compile for production run `gulp --production`.
gulp.task('default', ['clean'], function () {
    gulp.start('build');
});

// ### Setup
// `gulp setup` - Set up the project
gulp.task('setup', ['clean', 'bower-install'], function () {
    gulp.start('copy');
    gulp.start('build');
});
