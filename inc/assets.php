<?php

/**
 * Loads assets into the HTML
 *
 * The version is:
 * - static for user files (style.css, main.css, main.js...)
 * - vendor specific for 3rd-party libraries
 *
 * It can be:
 * - forced by the ACF plugin (field 'assets-version' in the options)
 * - random (no cache) if the site is not public (search engine protected)
 */
add_action('wp_enqueue_scripts', function () {
    # Specify the static version
    $version = '0.0.0';

    # If ACF plugin is loaded and the field exists, use it
    if (function_exists('get_field') and $fieldVersion = get_field('assets-version', 'option')) {
        $version = $fieldVersion;
    }

    # If the blog is not public, randomize
    if (!get_option('blog_public')) {
        $version = random_int(0, 999999);
    }

    wp_enqueue_script('main', WP_THEME_URI . '/js/main.min.js', array(), $version, true );

    wp_enqueue_style('main', WP_THEME_URI . '/css/main.min.css', array(), $version );

    /**
     * Loading of the style.css file
     *
     * My best practice is not to use style.css for styling, but only for
     * Wordpress theme variables. Here I include it since I've seen it's kinda
     * useful to have it so that you can modify the styling directly from the
     * Wordpress backend!
     *
     * !!! CAUTION !!!
     * If you don't want Wordpress administrator to edit this file, simply
     * remove the following line!
     */
    wp_enqueue_style('style', WP_THEME_URI . '/style.css', array(), $version);
});