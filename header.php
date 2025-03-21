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
    <body>
        <div class="l-wrapper" id="js-wrapper">
            <header class="l-header">
                <button type="button" class="l-header__title__small" id="js-hamburger">Menu</button>
                <div class="l-header__article">
                    <h1 class="l-header__title">Hamburger</h1>
                    <form class="p-searchform" action="./arcive-search.html" method="post" name="search-form">
                        <div class="p-searchform__box">
                            <input  type="search" name="q" value="" placeholder="" class="p-searchform__input"  id="js-search">
                        </div>
                            <input class="p-searchform__button" type="submit" value="検索">
                    </form>
                </div>
            </header>