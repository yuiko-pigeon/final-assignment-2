<?php get_header(); ?>
<?php get_sidebar(); ?>
<main class="l-main l-main__font l-main__color">
                <div class="p-hero__singleArea">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/ham-burger-with-vegetables-1639557.jpg')); ?>" class="c-image__hero--sp" alt="ズームされたチーズバーガー">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/ham-burger-with-vegetables-TB.jpg')); ?>" class="c-image__hero--tb" alt="ズームされたチーズバーガー">
                    <img src="<?php echo esc_url(get_theme_file_uri('image/ham-burger-with-vegetables-PC.jpg')); ?>" class="c-image__hero--pc" alt="ズームされたチーズバーガー">
                    <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>
            </main>
<?php get_footer(); ?>