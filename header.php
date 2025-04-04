<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo esc_url(get_theme_file_uri('image/common/favicon.ico')); ?>" id="favicon">
        <title><?php echo bloginfo('name'); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="l-wrapper" id="js-wrapper">
            <header class="l-header">
                <button type="button" class="l-header__title__small" id="js-hamburger">Menu</button>
                <div class="l-header__article">
                    <h1 class="l-header__title"><?php bloginfo( 'name' ); ?></h1>
<?php get_search_form(); ?>
                </div>
            </header>