<?php get_header(); ?>
<?php 
    if( have_posts()):
        while( have_posts()):
            the_post(); ?>
    <main class="l-main l-main__font l-main__color">
        <div class="p-hero__singleArea">
            <!--タイトル背景画像 画像の選択は投稿でメディアを選択する-->
            <img src="<?php the_field('hero'); ?>" class="c-image__hero--sp">
            <img src="<?php the_field('hero_tb'); ?>" class="c-image__hero--tb">
            <img src="<?php the_field('hero_pc'); ?>" class="c-image__hero--pc">
            <?php if (!is_singular()) : ?>
            <div class="c-title__hero--single"><?php the_title(); ?></h1>
            <?php endif; ?>
        </div>
        <?php the_content(); ?>           
    </main>
    <?php endwhile;
        else:?>
        <p>表示する記事がありません</p>
    <?php endif; ?>
    <?php get_sidebar(); ?>
<?php get_footer(); ?>