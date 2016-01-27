<!doctype html>
<html class="no-js" <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title('|', true, 'right') ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url') ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        var baseUrl = '<?= WP_THEME_URI ?>';
    </script>

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php if (function_exists('the_field')) : ?>
    <link rel="shortcut icon" href="<?php the_field('favicon', 'option') ?>" />
    <?php endif ?>

    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
<!--[if lt IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
