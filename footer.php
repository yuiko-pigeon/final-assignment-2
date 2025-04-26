<footer class="l-footer">
                <div class="l-footer__inner">
                    <div class="p-footerForPhp__color">
                        <div class="p-footerForPhp__image">   
                            <article class="l-footer__textarea"> 
                            <?php if (has_nav_menu('footer-menu')) : ?>
                                <?php wp_nav_menu( array(
                                    'menu' => '',
                                    'menu_class' => 'p-footerForPhp__text l-footer__text', //最上位の <ul>のクラス名
                                    'fallback_cb' => 'wp_page_menu',
                                    'echo' => true,
                                    'depth' => 2,
                                    'walker' => new custom_walker_nav_footermenu,
                                    'theme_location' => 'footer-menu',
                                    'item_spacing' => 'false'
                                ) ); ?>
                                <?php else : ?>
                                    <p class="p-footer__text l-footer__text">メニューはまだ設定されていません。</p>
                                <?php endif; ?>
                                <section class="p-footerForPhp__text--small l-footer__text--small">
                                    <a>CopyRight: RaiseTech</a>
                                </section>
                                
                            </article>
                        </div>
                    </div>
                </div>  
            </footer>
        </div>
        <?php wp_footer(); ?>
        <?php if( is_user_logged_in() ) : ?>
            <style type="text/css">
                html {
                    margin: 0 0 2rem!important;
                }
                #wpadminbar {
                    top: unset !important;
                    bottom: 0;
                    position: fixed !important; 
                }
            </style>
        <?php endif; ?>
    </body>
</html>
