<?php get_header(); ?>
<main class="l-main l-main__font">
                        <p class="p-page404__title--area u-margin__bottom--textBlock u-margin__middle--top">
                            <span class="p-hero__title--menu">not found</span>
                            <span class="c-article">ページが見つかりません</span>
                        </p>
                <article class="p-page404__text--area u-lineheight c-article p-page404__margin--bottom">
                    お探しのページは、削除されたか、名前が変更された可能性があります。<br class="p-page404__br--tb">
                    直接アドレスを入力された場合は<br class="p-page404__br--tb">アドレスが正しく入力されているか<span class="p-page404__text--sp">、</span>もう一度ご確認ください。<br>
                    <br>
                    ブラウザの再読み込みを行ってもこのページが表示される場合は<span class="p-page404__text--sp">、</span><br class="p-page404__br--tb">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="p-page404__link--bottom">トップページ</a>から目的のページをお探しください。
                </article> 
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>