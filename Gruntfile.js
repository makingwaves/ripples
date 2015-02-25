'use strict';
module.exports = function( grunt ) {
	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),
		banner: '/*!\n' +
				' * <%= pkg.themeName %> Version <%= pkg.version %> (<%= pkg.homepage %>)\n' +
				' * Copyright 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author.name %>\n' +
				' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>)\n' +
				' */\n',
		themeheader: 	'/*\n' +
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

		clean: {
			scripts: [
				'assets/dist/<%= pkg.functionPrefix %>.js',
				'assets/dist/<%= pkg.functionPrefix %>.min.js'
			],
			stylesheets: [
				'assets/dist/<%= pkg.functionPrefix %>.css',
				'assets/dist/<%= pkg.functionPrefix %>.min.css'
			],
			pot: [
				'languages/<%= pkg.functionPrefix %>.pot'
			]
		},

		jshint: {
			options: {
				jshintrc: 'assets/dev/.jshintrc'
			},
			src: [
				'assets/dev/bootstrap/js/collapse.js',
				'assets/dev/bootstrap/js/dropdown.js',
				'assets/dev/bootstrap/js/transition.js',
				'assets/dev/scripts.js'
			]
		},

		concat: {
			options: {
				banner: '<%= banner %>'
			},
			dist: {
				src: [
					'assets/dev/bootstrap/js/collapse.js',
					'assets/dev/bootstrap/js/dropdown.js',
					'assets/dev/bootstrap/js/transition.js',
					'assets/dev/scripts.js'
				],
				dest: 'assets/dist/<%= pkg.functionPrefix %>.js'
			}
		},

		uglify: {
			options: {
				preserveComments: 'some',
				report: 'min'
			},
			dist: {
				src: '<%= concat.dist.dest %>',
				dest: 'assets/dist/<%= pkg.functionPrefix %>.min.js'
			}
		},

		less: {
		  dist: {
		    options: {
		    	strictMath: true
		    },
		    files: {
		    	'assets/dist/<%= pkg.functionPrefix %>.css': 'assets/dev/style.less'
		    }
		  }
		},

		autoprefixer: {
			options: {
				browsers: [
					'Android 2.3',
					'Android >= 4',
					'Chrome >= 20',
					'Firefox >= 24',
					'Explorer >= 8',
					'iOS >= 6',
					'Opera >= 12',
					'Safari >= 6'
				]
			},
			dist: {
				src: 'assets/dist/<%= pkg.functionPrefix %>.css'
			}
		},

		cssmin: {
			options: {
				compatibility: 'ie8',
				keepSpecialComments: '*',
				noAdvanced: true
			},
			dist: {
				files: {
					'assets/dist/<%= pkg.functionPrefix %>.min.css': 'assets/dist/<%= pkg.functionPrefix %>.css'
				}
			},
		},

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
					'inc/components/*.php',
					'inc/*.php',
					'comments.php',
					'footer.php',
					'functions.php',
					'header.php',
					'index.php',
					'sidebar.php'
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

		makepot: {
			dist: {
				options: {
					domainPath: '/languages',
					potComments: 'Copyright (c) 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author.name %>',
					potFilename: '<%= pkg.functionPrefix %>.pot',
					potHeaders: {
						'report-msgid-bugs-to': '<%= pkg.homepage %>',
						'x-generator': 'grunt-wp-i18n 0.4.5',
						'x-poedit-basepath': '.',
						'x-poedit-language': 'English',
						'x-poedit-country': 'UNITED STATES',
						'x-poedit-sourcecharset': 'uft-8',
						'x-poedit-keywordslist': '__;_e;_x:1,2c;_ex:1,2c;_n:1,2; _nx:1,2,4c;_n_noop:1,2;_nx_noop:1,2,3c;esc_attr__; esc_html__;esc_attr_e; esc_html_e;esc_attr_x:1,2c; esc_html_x:1,2c;',
						'x-poedit-bookmars': '',
						'x-poedit-searchpath-0': '.',
						'x-textdomain-support': 'yes'
					},
					type: 'wp-theme'
				}
			}
		},

		watch: {
			scripts: {
				files: ['assets/dev/scripts.js'],
				tasks: ['scripts'],
				options: {
					livereload: true
				}
			},
			stylesheets: {
				files: ['assets/dev/style.less'],
				tasks: ['stylesheets'],
				options: {
					livereload: true
				}
			}
		}

	});

	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-less' );
	grunt.loadNpmTasks( 'grunt-autoprefixer' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	grunt.loadNpmTasks( 'grunt-banner' );
	grunt.loadNpmTasks( 'grunt-text-replace' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	grunt.registerTask( 'scripts', [
		'clean:scripts',
		'jshint',
		'concat',
		'uglify'
	]);

	grunt.registerTask( 'stylesheets', [
		'clean:stylesheets',
		'less',
		'autoprefixer',
		'cssmin',
		'usebanner',
	]);

	grunt.registerTask( 'translations', [
		'clean:pot',
		'makepot'
	]);

	grunt.registerTask( 'default', [
		'watch'
	]);

	grunt.registerTask( 'build', [
		'scripts',
		'stylesheets',
		'translations',
		'replace:dist'
	]);

	grunt.registerTask( 'setup', [
		'replace:init',
		'bower-install',
		'build'
	]);

	grunt.registerTask( 'bower-install', function() {
		var done = this.async();
		var bower = require( 'bower' ).commands;
		bower.install().on( 'end', function( data ) {
			done();
		}).on( 'data', function( data ) {
			console.log( data );
		}).on( 'error', function( err ) {
			console.error( err );
			done();
		});
	});
};
