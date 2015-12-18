# Livestock Framing

This document contains general information about the base configuration of this website.

## Grunt

Grunt is used to automate some tasks
* Find, convert (LESS to CSS), concatenate and minify CSS
* Find, concatenate and minify JavaScript

If you don't already have grunt installed you can do so by running `npm -g install grunt` in terminal.

If/When grunt is installed run `npm install` to pull down the required node packages.

Once that's complete run `grunt` in terminal. No additional setup should be required, but the grunt taks must be running while making edits to the site javascript and styles.


### CSS

* Template CSS is in ./css/src/hani/hani.css
* style.css only contains template data. _DO NOT_ enter styles here.
* less.js is not used to compile the LESS to css. Use grunt.
* All LESS files are imported into ./assets/hani/hani.less which should be concatenated and minified to assets/css/compiled.min.css.
** Compiled CSS should be minified.
** BLESS is to be used to make sure we don't hit any css selector limits (For IE).

### JavaScript

* All javascript should be minified and concatenated.

## Server Dependencies

* Unix ( Preferrably Ubuntu 14.04+ )
* Apache 2.2+
** Rewrites enabled
** Per directory .htaccess
* PHP 5.3.2+
* MySQL or MariaDB 5.5+
