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
                <!--TOPが固定・投稿どちらかでタイトルh1それ以外のページはpタグ-->
                <?php if ( is_front_page() || is_home() ) : ?>
                    <h1 class="l-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                    <p class="l-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>
        <?php get_search_form(); ?>
                </div>
            </header>