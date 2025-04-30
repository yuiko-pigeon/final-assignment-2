<?php get_header(); ?>
<?php 
    if( have_posts()):
        while( have_posts()):
            the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <main class="l-main l-main__font l-main__color">
                <div class="p-hero__singleArea">
                            <img src="<?php the_field('hero'); ?>" class="c-image__hero--sp">
                            <img src="<?php the_field('hero_tb'); ?>" class="c-image__hero--tb">
                            <img src="<?php the_field('hero_pc'); ?>" class="c-image__hero--pc">
                            <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>
            </main>
        </article>
    <?php endwhile;
        else:?>
        <p>表示する記事がありません</p>
    <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>