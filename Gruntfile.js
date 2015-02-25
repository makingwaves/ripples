'use strict';
module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*!\n' +
                ' * <%= pkg.themeName %> Version <%= pkg.version %> (<%= pkg.homepage %>)\n' +
                ' * Copyright 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author.name %>\n' +
                ' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>)\n' +
                ' */\n',
        themeheader:    '/*\n' +
                        'Theme Name: <%= pkg.themeName %>\n' +
                        'Theme URI: <%= pkg.homepage %>\n' +
                        'Author: <%= pkg.author.name %>\n' +
                        'Author URI: <%= pkg.author.url %>\n' +
                        'Description: <%= pkg.description %>\n' +
                        'Version: <%= pkg.version %>\n' +
                        'License: <%= pkg.license.name %>\n' +
                        'License URI: <%= pkg.license.url %>\n' +
                        'Text Domain: <%= pkg.functionPrefix %>\n' +
                        'Domain Path: /languages/\n' +
                        'Tags:\n' +
                        '*/',
        usebanner: {
            options: {
                position: 'top',
                banner: '<%= banner %>'
            },
            files: {
                src: 'assets/dist/*.css'
            }
        },
        replace: {
            dist: {
                src: ['style.css'],
                overwrite: true,
                replacements: [{
                    from: /((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/,
                    to: '<%= themeheader %>'
                }]
            },
            init: {
                src: [
                    'bower.json',
                    '**/*.php'
                ],
                overwrite: true,
                replacements: [{
                    from: 'MyWPTheme',
                    to: '<%= pkg.classPrefix %>'
                }, {
                    from: 'MYWPTHEME',
                    to: '<%= pkg.constantPrefix %>'
                }, {
                    from: 'mywptheme',
                    to: '<%= pkg.functionPrefix %>'
                }]
            }
        },

        // Watches for changes and runs tasks
        watch: {
            sass: {
                files: ['assets/src/scss/**/*.scss'],
                tasks: ['sass:dev']
            },
            css: {
                files: ['assets/dist/css/*.css'],
                options: {
                    livereload: true
                }
            },
            js: {
                files: ['assets/src/js/**/*.js'],
                tasks: ['jshint'],
                options: {
                    livereload: true
                }
            },
            php: {
                files: ['**/*.php'],
                options: {
                    livereload: true
                }
            }
        },

        // JsHint your javascript
        jshint: {
            all: ['assets/src/js/*.js', '!assets/dist/js/*.min.js', '!js/vendor/**/*.js'],
            options: {
                jshintrc: 'assets/src/.jshintrc'
            }
        },

        // Dev and production build for sass
        sass: {
            production: {
                files: {'assets/dist/css/style.css': 'assets/src/scss/style.scss'},
                options: {
                    style: 'compressed',
                    strictMath: true
                }
            },
            dev: {
                files: {'assets/dist/css/style.css': 'assets/src/scss/style.scss'},
                options: {
                    style: 'expanded',
                    strictMath: true
                }
            }
        },


        // Bower task sets up require config
        bower: {
            all: {
                rjsConfig: 'assets/src/js/main.js'
            }
        },

        // Require config
        requirejs: {
            production: {
                options: {
                    name: 'main',
                    baseUrl: 'assets/src/js',
                    mainConfigFile: 'assets/src/js/main.js',
                    out: 'assets/dist/js/main.min.js'
                }
            }
        },

        // Image min
        imagemin: {
            production: {
                files: [
                    {
                        expand: true,
                        cwd: 'images',
                        src: '**/*.{png,jpg,jpeg}',
                        dest: 'images'
                    }
                ]
            }
        },

        // SVG min
        svgmin: {
            production: {
                files: [
                    {
                        expand: true,
                        cwd: 'images',
                        src: '**/*.svg',
                        dest: 'images'
                    }
                ]
            }
        }

    });

    // Default task
    grunt.registerTask('default', ['watch']);

    // Build task
    grunt.registerTask('build', [
        'jshint',
        'sass:production',
        'imagemin:production',
        'svgmin:production',
        'requirejs:production'
    ]);

    // Template Setup Task
    grunt.registerTask('setup', [
        'replace:init',
        'sass:dev',
        'bower-install'
        //'build'
    ]);

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-bower-requirejs');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-banner');
    grunt.loadNpmTasks('grunt-text-replace');
    grunt.loadNpmTasks('grunt-svgmin');

    // Run bower install
    grunt.registerTask('bower-install', function () {
        var done = this.async();
        var bower = require('bower').commands;
        bower.install().on('end', function (data) {
            done();
        }).on('data', function (data) {
            console.log(data);
        }).on('error', function (err) {
            console.error(err);
            done();
        });
    });

};
