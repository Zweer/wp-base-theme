<?php

/**
 * Adds the i18n text domain
 *
 * The default directory is "language" inside the theme folder
 */
add_action('after_setup_theme', function () {
    load_theme_textdomain(WP_THEME_SLUG, WP_THEME_PATH . DIRECTORY_SEPARATOR . 'languages');
});
