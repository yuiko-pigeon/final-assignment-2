<?php get_header(); ?>
<?php get_sidebar(); ?>
<main class="l-main l-main__font">
                        <p class="p-404__title--area u-margin__bottom--textBlock u-margin__middle--top">
                            <span class="p-hero__title--menu">NOT FOUND</span>
                            <span class="c-article">ページが見つかりません</span>
                        </p>
                <article class="p-404__text--area u-lineheight c-article">
                    お探しのページは、削除されたか、名前が変更された可能性があります。<br>
                    直接アドレスを入力された場合は<br class="u-404__br--tb">アドレスが正しく入力されているかもう一度ご確認ください。<br>
                    <br>
                    ブラウザの再読み込みを行ってもこのページが表示される場合は<span class="u-404__text--sp">、</span><br class="u-404__br--tbPc">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="p-404__linkBottom">トップページ</a>から目的のページをお探しください。
                </article> 
</main>
<?php get_footer(); ?>