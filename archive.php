<?php get_header(); ?>
<?php get_sidebar(); ?>
            <main class="l-main l-main__font">
                <div class="p-hero__imageArea">
                    <div class="p-hero__blackScreen">
                        <p class="p-hero__title--area">
                            <span class="p-hero__title--menu">Menu:</span>
                            <span class="p-hero__title--menucontent"><?php the_archive_title(); ?></span>
                        </p>
                    </div>
                    <img src="<?php echo get_theme_file_uri( 'image/three-burgers-on-brown-wooden-tray-between-white-ceramic-sp.jpg' ); ?>" class="c-image__threeBurgers--sp" alt="3つのハンバーガー">
                    <img src="<?php echo get_theme_file_uri( 'image/three-burgers-on-brown-wooden-tray-between-white-ceramic-tb.jpg' ); ?>" class="c-image__threeBurgers--tb" alt="3つのハンバーガー">
                    <img src="<?php echo get_theme_file_uri( 'image/three-burgers-on-brown-wooden-tray-between-white-ceramic-pc.jpg' ); ?>" class="c-image__threeBurgers--pc" alt="3つのハンバーガー">
                </div>
                
                <!--管理画面から編集可能なテキストエリアを作成-->
                <?php
                        // スラッグで "archive-headertext" の固定ページを取得
                        $header_page = get_page_by_path('archive-headertext');

                        if ($header_page) {
                        echo '<section class="p-article__area">';
                        // タイトルを表示（h2など任意のタグ）
                        echo '<h2>' . esc_html(get_the_title($header_page->ID)) . '</h2>';
                        // 本文のブロックエディタを表示
                        echo apply_filters('the_content', $header_page->post_content);
                        echo '</section>';
                        }
                ?>    
                
                <!--アーカイブページのループ-->
                <?php if (have_posts()) :
                     while (have_posts()) :
                      the_post(); ?>
               
               <!--繰り返す内容-->
                <section class="p-article p-article__cardList">
                    <figure class="p-card__figure--arcive">
                        <div class="p-card__arcive">
                            <?php if(has_post_thumbnail()):the_post_thumbnail();
                                else:?>
                                <img src="<?php echo get_theme_file_uri( '/image/noimage.jpg' ); ?>"  class="attachment-post-thumbnail" alt="窓辺のハンバーガー">
                            <?php endif; ?>
                            
                            <figcaption class="p-card__textarea">
                                <h3 class="p-card__title--arcive"><?php the_title(); ?></h3>
                                <h4 class="p-card__title--arcive--small">
                                    <!-- 小見出し（今回はh2)をコンテンツより取得-->
                                    <?php
                                        $content = get_the_content(); // 投稿本文を取得（ループ内で）
                                        preg_match_all('/<h2[^>]*>(.*?)<\/h2>/u', $content, $h2_list);
                                        foreach ($h2_list[0] as $h2) {
                                        echo strip_tags($h2); //でテキストだけ出力も可
                                        }
                                        ?>
                                </h4>
                                <p class="p-card__text--arcive"><?php echo get_the_excerpt(); ?></p>
                                <div class="p-card__button--area">   
                                    <button type="button" onclick="location.href='<?php the_permalink(); ?>'" class="c-button__transmit">
                                        <a class="c-button__text">詳しく見る</a>
                                    </button>
                                </div>
                            </figcaption>
                        </div>
                    </figure>
                </section>
                <?php endwhile; ?>
                <?php else : ?>
                    <div class="u-margin__center u-width no-post">
                        <p class="">まだ投稿はありません。</p>
                    </div>
                <?php endif; ?> 
                
                <!--SPページネーション-->
                <nav class="p-pagenation">
                    <?php
                        $current = max(1, get_query_var('paged'));
                        $max_page = $wp_query->max_num_pages;
                        ?>
                    <div class="p-pagenation__prev">
                        <?php if ($current > 1): ?>
                            <a rel="prev" href="<?php echo get_pagenum_link(1); ?>" class="c-pagenation__link">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--prev"></span>
                                </div>
                            </a>
                        
                            <span class="p-pagenation__text--prev">
                                <a rel="prev" href="<?php
                                        global $paged;
                                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                        $prev_page = max(1, $paged - 1);
                                        echo get_pagenum_link($prev_page);
                                        ?>" class="c-pagenation__link">前へ</a>
                            </span>
                        <?php endif; ?>
                    </div>   

                    <div class="p-pagenation__next">
                        <?php if ($current < $max_page): ?>
                            <span class="p-pagenation__text--next">
                                <a rel="next" href="<?php 
                                global $paged;
                                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                $next_page = $paged + 1;
                                echo get_pagenum_link($next_page);?>" class="c-pagenation__link">次へ</a>
                            </span> 

                        
                            <a rel="next" href="<?php echo get_pagenum_link($max_page); ?>" class="c-pagenation__link">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--next"></span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
                <!--TBPCページネーション-->
                <nav class="p-pagenationTBPC">
                    <!--現ページ/総ページ数を表示--> 
                    <div class="p-pagenationTBPC__pagenumber">
                        page <?php echo max(1, get_query_var('paged')) . ' / ' . max(1,$wp_query->max_num_pages); ?>
                    </div>
                    <!--最初のページアイコン-->
                    <?php
                        $current = max(1, get_query_var('paged'));
                        $max_page = $wp_query->max_num_pages;
                        ?>
                    <?php if ($current > 1): ?>
                        <a rel="prev" href="<?php echo get_pagenum_link(1); ?>" class="c-pagenation__link">
                            <div class="p-pagenation__prev">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--prev"></span>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                    <!--PageNaviプラグイン-->
                    <?php wp_pagenavi();?>
                    
                    <!--最後のページアイコン-->
                    <?php if ($current < $max_page): ?>
                    <a rel="next" href="<?php echo get_pagenum_link($max_page); ?>" class="c-pagenation__link">
                        <div class="p-pagenation__next"> 
                            <div class="p-pagenation__icon--area">
                                <span class="p-pagenation__icon--next"></span>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </nav>
            </main>
<?php get_footer(); ?>

                