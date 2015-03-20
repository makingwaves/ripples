# Ripples - Wordpress theme

Starter template for Wordpress projects in Making Waves

In depth docs can be found [here](https://www.gitbook.com/content/book/pederan/makingpress/)

## Requirements

| Prerequisite     | How to check | How to install
| --------------- -| ------------ | ------------- |
| PHP >= 5.4.x     | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js 0.12.x   | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 3.8.10   | `gulp -v`    | `npm install -g gulp` |
| Bower >= 1.3.12  | `bower -v`   | `npm install -g bower` |
| Compass >= 1.0.1 | `compass -v` | `gem install compass` |
For more installation notes, refer to the [Install gulp and Bower](#install-gulp-and-bower) section in this document.

## Features

* [gulp](http://gulpjs.com/) build script that compiles both Less and Sass, checks for JavaScript errors, optimizes images, and concatenates and minifies files
* [BrowserSync](http://www.browsersync.io/) for keeping multiple browsers and devices synchronized while testing, along with injecting updated CSS and JS into your browser while you're developing
* [Bower](http://bower.io/) for front-end package management
* [Theme wrapper](https://roots.io/sage/docs/theme-wrapper/)
* [Atomic design](http://bradfrost.com/blog/post/atomic-web-design/) folder structure 

## Installation

Clone the git repo - `git clone git@github.com:makingwaves/ripples.git` and then rename the directory to the name of your theme or website.


## Configuration

Edit `lib/config.php` to enable or disable theme features and to define a Google Analytics ID.

Edit `lib/init.php` to setup navigation menus, post thumbnail sizes, post formats, and sidebars.

## Theme development

Ripples uses [gulp](http://gulpjs.com/) as its build system and [Bower](http://bower.io/) to manage front-end packages.

### Install gulp and Bower

Building the theme requires [node.js](http://nodejs.org/download/). We recommend you update to the latest version of npm: `npm install -g npm@latest`.

From the command line:

1. Install [gulp](http://gulpjs.com) and [Bower](http://bower.io/) globally with `npm install -g gulp bower`
2. Navigate to the theme directory, then run `npm install`
3. Run `bower install`

You now have all the necessary dependencies to run the build process.

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

To use BrowserSync during `gulp watch` you need update `devUrl` at the bottom of `assets/manifest.json` to reflect your local development hostname.

