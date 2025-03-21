<?php
//CSSファイルの読み込み ress.cssの後にstyle.cssを読み込む
function my_enqueue_style(){
    wp_enqueue_style('style',get_theme_file_uri('style.css'),array(),false,'all');
    wp_enqueue_script('jquery','https://code.jquery.com/jquery-3.7.1.js','','3.7.1',false);
    wp_enqueue_script('main',get_theme_file_uri('/js/main.js'),'jquery','',true);
}
add_action('wp_enqueue_scripts','my_enqueue_style');

//サイドバーのウィジェットエリアを作成 「メニューの位置」に新しく項目を登録
add_action('after_setup_theme',function(){
    register_nav_menus( array(
        'sidebar-menu' => 'サイドバーのメニュー'
    ));
});

//サイドバーカスタム
class custom_walker_nav_menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="l-sidebar__menu__list">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}

//サイドバーのaタグにクラスを追加
function add_menu_link_class($atts, $item, $args,$depth) {
    if($depth==0){
        $atts['class'] = 'l-sidebar__title--small';
        }// ここで１階層目　a タグにクラスを追加
        elseif($depth==1){
            $atts['class'] = 'c-menuItem__link';
        } // ここで2階層目 a タグにクラスを追加

    $args->theme_location = 'sidebar-menu'; // ここでメニューの位置を指定

    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 4);

// 投稿アーカイブページの表示設定 
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'menu'; //URLとして使いたい文字列
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);




//サイドバー　管理画面上にウィジェットの設定メニューを表示
/*function register_custom_menus(){
    register_nav_menus(array(
        'sidebar-menu' => 'サイドバーのメニュー'
    ));
}

add_action('after_setup_theme', 'register_custom_menus');*/