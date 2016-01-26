<?php

/**
 * Utils file with some enhancements I collected over the years
 */

/**
 * Flush the rewrite rules on theme switch
 *
 * TBH I don't remember if it flushes the rewrite table on theme switch, just
 * make it for sure (:
 */
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

/**
 * Fixes an iOS bug
 *
 * It was a bug of some years ago, don't know if it already exists
 */
add_filter('nav_menu_link_attributes', function ($attributes) {
    $attributes['ontouchstart'] = ' ';

    return $attributes;
});
