<form class="p-searchform-for-php" method="get" name="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="p-searchform-for-php__box">
                            <input  type="search" name="s" value="<?php echo isset($_GET['s']) ? htmlspecialchars($_GET['s'], ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="" class="p-searchform-for-php__input"  id="s">
                        </div>
                            <input class="p-searchform-for-php__button" type="submit" value="検索">
                    </form>