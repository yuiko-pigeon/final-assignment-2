<aside class="l-sidebar">
                <div class="l-sidebar__background"></div>
                <nav class="l-sidebar__nav">
                    <div class="l-sidebar__inline">
                        <div class="c-button__close__area" id="js-close">
                            <div class="c-button__close"></div>
                        </div>
                        <p class="l-sidebar__title"><span class="c-menu">Menu</span></p>
                        <?php if (has_nav_menu('sidebar-menu')) : ?>
                        <?php wp_nav_menu( array(
                              'menu' => '',
                              'menu_class' => 'l-sidebar__menu',
                              'fallback_cb' => 'wp_page_menu',
                              'echo' => true,
                              'depth' => 2,
                              'walker' => new custom_walker_nav_menu,
                              'theme_location' => 'sidebar-menu',
                              'item_spacing' => 'false'
                         ) ); ?>
                        <?php else : ?>
                            <p class="l-sidebar__menu__list">メニューはまだ設定されていません。</p>
                        <?php endif; ?>
                        
                    </div>
                </nav>
            </aside> 