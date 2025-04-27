<form class="p-searchformForPhp" method="get" name="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="p-searchformForPhp__box">
                            <input  type="search" name="s" value="<?php echo isset($_GET['s']) ? htmlspecialchars($_GET['s'], ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="" class="p-searchformForPhp__input"  id="s">
                        </div>
                            <input class="p-searchformForPhp__button" type="submit" value="検索">
                    </form>