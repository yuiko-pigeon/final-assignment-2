<?php
//テーマサポート
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );

//タイトル出力
function hamburger_title( $title ) {
    if ( is_front_page() && is_home() ) { //トップページなら
        $title = get_bloginfo( 'name', 'display' );
    } elseif ( is_singular() ) { //シングルページなら
        $title = single_post_title( '', false );
    }
        return $title;
    }
add_filter( 'pre_get_document_title', 'hamburger_title' );

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
        'sidebar-menu' => 'サイドバーのメニュー',
        'footer-menu' => 'フッターのメニュー'
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


// カスタム投稿タイプにリビジョン追加
function add_posttype_revisions() {
    add_post_type_support( 'column', 'revisions' );
}
add_action('init', 'add_posttype_revisions');

//独自スタイルの追加
function custom_block_styles() {
    // 独自のブロックスタイルを登録する
    register_block_style(
        'core/media-text', // ブロック名
        array(
            'name'         => 'text-right', // スタイル名
            'label'        => 'テキストが右', // スタイルの表示名
        )
    );
    register_block_style(
        'core/media-text', // ブロック名
        array(
            'name'         => 'text-left', // スタイル名
            'label'        => 'テキストが左', // スタイルの表示名
        )
    );
    register_block_style(
        'core/list', // ブロック名
        array(
            'name'         => 'list-1', // スタイル名
            'label'        => 'number', // スタイルの表示名
        )
    );
    register_block_style(
        'core/list', // ブロック名
        array(
            'name'         => 'list-2', // スタイル名
            'label'        => 'none', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'group-gray', // スタイル名
            'label'        => 'gray', // スタイルの表示名
        )
    );
    register_block_style(
        'core/group', // ブロック名
        array(
            'name'         => 'link', // スタイル名
            'label'        => 'リンク下線色なし', // スタイルの表示名
        )
    );
    register_block_style(
        'core/preformatted', // ブロック名
        array(
            'name'         => 'tag-1', // スタイル名
            'label'        => 'tag-1', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'tb-large', // スタイル名
            'label'        => 'タブレット広め', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'margin-listtop', // スタイル名
            'label'        => 'リスト上', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'margin-listbottom', // スタイル名
            'label'        => 'リスト下', // スタイルの表示名
        )
    );
    register_block_style(
        'core/spacer', // ブロック名
        array(
            'name'         => 'card-gap', // スタイル名
            'label'        => 'カラム間のスペース', // スタイルの表示名
        )
    );
    register_block_style(
        'core/image', // ブロック名
        array(
            'name'         => 'image-upper', // スタイル名
            'label'        => '投稿上部の画像サイズ', // スタイルの表示名
        )
    );
    register_block_style(
        'core/gallery', // ブロック名
        array(
            'name'         => 'gallery-9', // スタイル名
            'label'        => '9枚のギャラリー', // スタイルの表示名
        )
    );
}
add_action( 'init', 'custom_block_styles' );


//特定の位置のタグにクラスを追加
/*function add_paragraph_class($content) {
    if (is_single()) {
    // DOMを使用してより確実に処理
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    //$paragraphs = $dom->getElementsByTagName('p');
    
    // 2番目のpタグにクラスを追加（インデックスは0から始まるので、1を指定。サイドバーのpは除外）
    if ($paragraphs->length > 1) {
        $paragraph = $paragraphs->item(1);
        $paragraph->setAttribute('class', "second-paragraph");
    }
    
    if ($paragraphs->length > 2) {
        $paragraph = $paragraphs->item(2);
        $paragraph->setAttribute('class', "third-paragraph");
    }

    $figures = $dom->getElementsByTagName('figure');

    if ($figures->length > 0) {
        $figure = $figures->item(0);
        $figure->setAttribute('class', "first-figure");
    }
    
     $content=$dom->saveHTML();
}
return $content;
}
add_filter('the_content', 'add_paragraph_class');*/

//エディタスタイル　cssファイルの読み込み
/*function my_theme_add_editor_styles() {
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');
}
add_action('after_setup_theme', 'my_theme_add_editor_styles');*/

//サイドバー　管理画面上にウィジェットの設定メニューを表示
/*function register_custom_menus(){
    register_nav_menus(array(
        'sidebar-menu' => 'サイドバーのメニュー'
    ));
}

add_action('after_setup_theme', 'register_custom_menus');*/