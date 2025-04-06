<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php the_field('single_tag'); ?>

<main class="l-main l-main__font l-main__color">
                <div class="p-hero__singleArea">
                    <img src="<?php the_field('hero'); ?>" class="c-image__hero--sp" alt="ズームされたチーズバーガー">
                    <img src="<?php the_field('hero_tb'); ?>" class="c-image__hero--tb" alt="ズームされたチーズバーガー">
                    <img src="<?php the_field('hero_pc'); ?>" class="c-image__hero--pc" alt="ズームされたチーズバーガー">
                    <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>

                    
            </main>
<?php get_footer(); ?>