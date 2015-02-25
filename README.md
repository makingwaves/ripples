WordPress Grunt Starter Theme
=============================

[![endorse](https://api.coderwall.com/felixarntz/endorsecount.png)](https://coderwall.com/felixarntz)

A simple blank [WordPress](http://wordpress.org/) starter theme intended to use with [YeoPress](https://github.com/wesleytodd/YeoPress), [Grunt](http://gruntjs.com/) and [Bower](http://bower.io/). It is a solid flexible base, and gives you an efficient workflow since all the necessary stylesheets and scripts are compiled automatically whenever you change the source files. Of course you can also build them manually with one simple task.

Features
--------

* blank WordPress theme with 1 nav menu and 1 sidebar predefined
* sticks to current WordPress guidelines
* preconfigured Gruntfile for efficient development (creates production CSS, JavaScript and POT file for translation)
* uses [LESS](http://lesscss.org/) syntax for stylesheet development
* refreshes the theme's `style.css` header automatically
* comes with a lightweight version of [Bootstrap](http://getbootstrap.com/) (not much more than reset and grid system), however it can be replaced or removed if necessary
* comes with [FancyBox](http://fancybox.net/) and automatically applies it to all images; this behavior can easily be disabled or you can remove FancyBox completely
* automatically makes embeds appear responsive in 16:9 aspect ratio; this behavior can easily be disabled
* ready to be used with YeoPress (automatic slug, text-domain and prefixing based on theme directory name)

Getting Started
---------------

To enjoy the full advantages of this starter theme, you should know how to use the console.
You don't necessarily need to know how to use [Grunt](http://gruntjs.com/), but it will be easier if you already do.

After having installed the necessary tools (see above), simply use this theme as the default theme when executing `yo wordpress`. The theme's slug, name and all prefixes inside the code will be automatically created based on what you entered as `themeDir` during the YeoPress configuration (replacing the weird `mywptheme` you see there now when browsing through the code on Github). Make sure that whatever you enter there is lowercase and without any whitespace.

That's it already! This theme is prepared for YeoPress so that grunt and bower are automatically setup. You don't need to do anything more here.

However, it is recommended to open the theme's `package.json` and change all the other fields like version, author, homepage, repository and such accordingly. When you will run the `grunt build` process later, the theme header will automatically be created from these values: therefore make sure that, after you have changed the values in `package.json` to run `grunt build` really quick (read more below).

Automatic File Processing
-------------------------

Now let's get into the real business: Go into your theme's directory. The stylesheets and scripts you should edit yourself are `assets/dev/style.less` and `assets/dev/scripts.js`. The files located in `assets/dist/` will be regenerated everytime you run grunt, so DO NOT EDIT THESE. The theme's `style.css` is only used for the theme header (since WordPress requires it), but you should not use it as an actual stylesheet.

The default procedure you will be using over and over is the following: By simply typing `grunt` into Terminal, you enable `watch` mode. This means that whenever you save a modified file, it is automatically processed so that you instantly see your changes.

To build the files manually, enter `grunt build` into terminal. This will also refresh the theme header in `style.css` so that possible changes in your `package.json` are properly reflected. You can also build scripts, stylesheets and the POT file independently from each other, by using `grunt scripts`, `grunt stylesheets` or `grunt translations`.

Contributions
-------------

If you have ideas on how the WordPress Grunt Starter Theme could be improved, feel free to [raise an issue](https://github.com/felixarntz/wordpress-grunt-starter-theme/issues) or [send a pull request](https://github.com/felixarntz/wordpress-grunt-starter-theme/pulls). But please remember that this is supposed to be a simple starter theme, so let's not bloat it up with cool functionality which some people will not need. But, especially regarding Grunt, I'm excited for your ideas.
