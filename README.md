# wp-base-theme

This repo tries to be a foundation for my [Wordpress](https://wordpress.org/) themes: a skeleton with only few basic 
features, but with everything necessary to build assets and with the common settings.

## Compilation & Deploy

The compilation is demanded to [Gulp](http://gulpjs.com/) and tons of plugins. 

I've put in `.gitignore` the directories with the compiled assets: usually I deploy on servers where I can SSH into, so
the compilation is demanded to the server (or to [Jenkins](https://jenkins-ci.org/)), so there's no need to put every 
minified source into the repo.

You are not used to that schema? Simply remove those directories from `.gitignore`.

Dependencies are treated in the same way: [Gulp](http://gulpjs.com/) downloads them (via [Bower](http://bower.io/) or 
[NPM](https://www.npmjs.com/) directly) and puts them in specific folders (ignored in the repo) and then uses them to 
compile the sources (via the specific pre-processor).

## CSS

The CSS pre-processor of choice is [SASS](http://sass-lang.com/) (
[mainly because](http://blog.getbootstrap.com/2015/08/19/bootstrap-4-alpha/) of [Bootstrap](http://getbootstrap.com/)
v4).

We put SASS (or SCSS as I'm used to) files into the `_scss` folder: as always, we compile only files in the root of the
directory and only without the trailing underscore. Those files (compiled and minified) will be placed in the `css` 
folder with their specific `.map` file.

## JS

The JS pre-processor of choice is [Webpack](https://webpack.github.io/).

We put JS source files in the `_js` folder (we can also use ES2015 if your NodeJS environment allows them) and we'll find
the compiled files in the `js` one, along with their `.map` file.

## Plugins

Here is a list of suggested plugins:

- Advanced Custom Fields PRO
- Broken Link Checker (finds broken links)
- DuracellTomi's Google Tag Manager (adds Google Tag Manager beacon)
- Force Regenerate Thumbnails (forces the regeneration of thumbnails)
- Google Pagespeed Insights (uses Google Pagespeed to determine page performances)
- iThemes Security Pro (security ninja!!)
- Post Thumbnail Editor (allows you to edit the post thumbnail)
- WPML
- WordPress SEO by Yoast