<?php

/**
 * Defining auxiliary constants
 *
 * Now there's no need to execute those functions every time you have to
 * include a file or asset.
 */

define('WP_THEME_PATH', get_template_directory());
define('WP_THEME_URI', get_template_directory_uri());

/**
 * Defining a constant for the theme slug
 *
 * In this way we don't have to remember the theme slug every time we need it,
 * and, much more important, don't have to change it every time we begin a new
 * project!!
 */

define('WP_THEME_SLUG', 'base_theme');

/**
 * Including auxiliary files
 *
 * All these files are placed in the 'inc' directory.
 */

$directoryPath = __DIR__ . '/inc';
$directoryPointer = opendir($directoryPath);

while ($fileName = readdir($directoryPointer)) {
    $filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    $extension = substr(strstr($fileName, '.'), 1);

    if (!is_dir($filePath) and $extension === 'php') {
        require_once $filePath;
    }
}