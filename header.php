<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
        <div class="l-wrapper" id="js-wrapper">
            <header class="l-header">
                <button type="button" class="l-header__title__small" id="js-hamburger">Menu</button>
                <div class="l-header__article">
                <!--TOP（固定・投稿どちらか）でタイトルh1それ以外のページはpタグ-->
                <?php if ( is_front_page() || is_home() ) : ?>
                    <h1 class="l-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                    <p class="l-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>
        <?php get_search_form(); ?>
                </div>
            </header>