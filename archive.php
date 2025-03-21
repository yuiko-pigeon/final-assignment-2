<?php get_header(); ?>
<?php get_sidebar(); ?>
main class="l-main l-main__font">
                <div class="p-hero__imageArea">
                    <div class="p-hero__blackScreen">
                        <p class="p-hero__title--area">
                            <span class="p-hero__title--menu">Menu:</span>
                            <span class="p-hero__title--menucontent"><?php the_archive_title(); ?></span>
                        </p>
                    </div>
                    <img src="../../picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-sp.jpg" class="c-image__threeBurgers--sp" alt="3つのハンバーガー">
                    <img src="../../picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-tb.jpg" class="c-image__threeBurgers--tb" alt="3つのハンバーガー">
                    <img src="../../picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-pc.jpg" class="c-image__threeBurgers--pc" alt="3つのハンバーガー">
                </div>
                <section class="p-article__area">
                    <h2 class="c-title__arcive">小見出しが入ります</h2>
                    <p class="c-article c-article__lineheight u-weight__mediumBold">
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                    </p>
                </section>
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <!--繰り返す内容-->
                <section class="p-article p-article__cardList">
                    <figure class="p-card__figure--arcive">
                        <div class="p-card__arcive">
                            <img src="picture/window-zoom.jpg"  class="c-image__window--pc" alt="窓辺のハンバーガー">
                            <img src="picture/window-tb.jpg"  class="c-image__window--tb" alt="窓辺のハンバーガー">
                            <img src="picture/window.jpg"  class="c-image__window--sp" alt="窓辺のハンバーガー">
                            <figcaption class="p-card__textarea">
                                <h3 class="p-card__title--arcive">チーズバーガー</h3>
                                <h4 class="p-card__title--arcive--small">小見出しが入ります</h4>
                                <p class="p-card__text--arcive">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                                                                テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                                                                テキストが入ります。</p>
                                <div class="p-card__button--area">   
                                    <button type="button" onclick="location.href='#'" class="c-button__transmit">
                                        <a class="c-button__text">詳しく見る</a>
                                    </button>
                                </div>
                            </figcaption>
                        </div>
                    </figure>
                    <?php endwhile; ?>
                    <?php else : ?>
                        <p>まだ投稿はありません。</p>
                    <?php endif; ?>
                    <?php get_footer(); ?>