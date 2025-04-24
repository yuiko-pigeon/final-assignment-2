<?php 
/*
Template Name: 閲覧履歴
*/
    get_header(); ?>

<?php 
    if( have_posts()):
        while( have_posts()):
            the_post(); ?>
    <main class="l-main l-main__font l-main__color">
        <div class="p-hero__singleArea">
                    <img src="<?php the_field('hero'); ?>" class="c-image__hero--sp">
                    <img src="<?php the_field('hero_tb'); ?>" class="c-image__hero--tb">
                    <img src="<?php the_field('hero_pc'); ?>" class="c-image__hero--pc">
                    <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
        </div>
        <!--閲覧履歴取得-->
        <?php
            $viewed_posts = get_view_history_posts(10);
           
            if (!empty($viewed_posts)) {
                $args = [
                    'post__in' => $viewed_posts,
                    'orderby' => 'post__in',
                    'posts_per_page' => 10
                ]; ?>

        <div class="u-margin__center u-width">

                <?php
                // WP_Queryを使用して、閲覧履歴の投稿を取得

                $history_query = new WP_Query($args);

                if ($history_query->have_posts()) :
                    echo '<h3 class="title">閲覧履歴</h3>';

                    echo '<ul class="p-article">';
                    while ($history_query->have_posts()) : $history_query->the_post(); ?>
                        <li class="p-card__textarea">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile;
                    echo '</ul>';
                    wp_reset_postdata();
                endif;
            } else {
                echo '<p>閲覧履歴はありません。</p>';
            }; ?>
        </div>


    </main>
    <?php endwhile;
        else:?>
        <p>表示する記事がありません</p>
    <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>