<?php
//テーマサポート
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );
add_theme_support('post-thumbnails');

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

//ヒストリーページ　閲覧履歴の保存
function save_view_history() {
    if (is_single()) {
        $post_id = get_the_ID();
        $history = isset($_COOKIE['view_history']) ? json_decode(stripslashes($_COOKIE['view_history']), true) : [];

        // 過去の履歴から現在の投稿IDを削除（重複防止）
        $history = array_diff($history, [$post_id]);
        // 配列の先頭に追加
        array_unshift($history, $post_id);
        // 保存する履歴の最大数（例: 10件まで）
        $history = array_slice($history, 0, 10);
        // クッキーに保存（30日間有効）
        setcookie('view_history', json_encode($history), time() + 30 * 86400, COOKIEPATH, COOKIE_DOMAIN);
    }
}
add_action('wp', 'save_view_history');

//閲覧履歴を取得する関数
function get_view_history_posts($limit = 10) {
    if (!isset($_COOKIE['view_history'])) {
        return [];
    }

    $history = json_decode(stripslashes($_COOKIE['view_history']), true);

    if (empty($history)) {
        return [];
    }

    return array_slice($history, 0, $limit);
}

//投稿ページのみ検索
function my_post_search($search) {
    if(is_search()) {
    $search .= " AND post_type = 'post'";
    }
    return $search;
    }

    add_filter('posts_search', 'my_post_search');

    add_action( 'init', function() {
        error_log( 'この functions.php はちゃんと読み込まれてる' );
    });

//空欄検索でTOPページにリダイレクト
function empty_search_redirect( $wp_query ) {
if ( $wp_query->is_main_query() && $wp_query->is_search() && ! $wp_query->is_admin() ) {
    // メインのクエリ且つ検索結果ページで、かつ管理画面でない場合の処理
    $s = $wp_query->get( 's' );
    //URL に ?s=検索ワード がある場合、その「検索ワード」がここで取得される
    $s = trim( $s );
    //trim()で前後の空白を削除
    //空白の場合、トップページにリダイレクト
    if ( empty( $s ) ) {
    wp_safe_redirect( home_url('/') );
    exit; }
    } }
    add_action( 'parse_query', 'empty_search_redirect' );

//サイドバーのウィジェットエリアを作成 「メニューの位置」に新しく項目を登録
add_action('after_setup_theme',function(){
    register_nav_menus( array(
        'sidebar-menu' => 'サイドバーのメニュー',
        'footer-menu' => 'フッターのメニュー'
    ));
});

//サイドバーカスタム 第２階層のスタイリング
class custom_walker_nav_menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="l-sidebar__menu__list">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}
class custom_walker_nav_footermenu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="p-footer__text">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}

//サイドバーのaタグにクラスを追加
function add_menu_link_class($atts, $item, $args,$depth) {
    if ($args->theme_location === 'sidebar-menu') {
        if($depth==0){
            $atts['class'] = 'l-sidebar__title--small c-menuItem__link';
            }// １階層目　aタグにクラスを追加
            elseif($depth==1){
                $atts['class'] = 'c-menuItem__link';
            } // 2階層目 aタグにクラスを追加

        $args->theme_location == 'sidebar-menu'; // ここでメニューの位置を指定
        }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 4);

//aタグにクラスを追加
function add_menu_footerLink_class($atts, $item, $args,$depth) {
    if ($args->theme_location === 'footer-menu') {
        if($depth==0){
            $atts['class'] = 'p-link__footer';
            }// １階層目　aタグにクラスを追加
        
        $args->theme_location == 'footer-menu'; // ここでメニューの位置を指定
    }
        return $atts;
    }
add_filter('nav_menu_link_attributes', 'add_menu_footerLink_class', 10, 4);

function add_span($content) {
    if (is_page(974,'index')) {
    // 正規表現で <h2> タグを探してその中身を <span> で囲む
    $content = preg_replace_callback(
        '/<h2(.*?)>(.*?)<\/h2>/is',
        function($matches) {
            // $matches[1] は h2 の属性、$matches[2] は中のテキスト
            return '<h2' . $matches[1] . '><span>' . $matches[2] . '</span></h2>';
        },
        $content
    );
}
return $content;
}
add_filter('the_content', 'add_span');

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


//the_archive_title　前半部分削除
add_filter( 'get_the_archive_title', function ($title) {
    if (is_category()) {
    $title = single_cat_title('',false);
        } elseif (is_tag()) {
            $title = single_tag_title('',false);
        } elseif (is_tax()) {
            $title = single_term_title('',false);
        } elseif (is_post_type_archive() ){
            $title = post_type_archive_title('',false);
        } elseif (is_date()) {
            $title = get_the_time('Y年n月');
        } elseif (is_search()) {
            $title = ''.esc_html( get_search_query(false) );
        } elseif (is_404()) {
            $title = '「404」ページが見つかりません';
        } else {
        }
        return $title;
    });


// カスタム投稿タイプにリビジョン追加
function add_posttype_revisions() {
    add_post_type_support( 'column', 'revisions' );
}
add_action('init', 'add_posttype_revisions');

//独自スタイルの追加
function custom_block_styles() {
    // 独自のブロックスタイルを登録する
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-left', // スタイル名
            'label'        => '左のカード', // スタイルの表示名
        )
    );
    register_block_style(
        'core/column', // ブロック名
        array(
            'name'         => 'card-right', // スタイル名
            'label'        => '右のカード', // スタイルの表示名
        )
    );
    register_block_style(
        'core/cover', // ブロック名
        array(
            'name'         => 'hero', // スタイル名
            'label'        => '上部メインビジュアル', // スタイルの表示名
        )
    );
    register_block_style(
        'core/cover', // ブロック名
        array(
            'name'         => 'map', // スタイル名
            'label'        => 'map画像レイアウト', // スタイルの表示名
        )
    );
    register_block_style(
        'core/cover', // ブロック名
        array(
            'name'         => 'map-ray', // スタイル名
            'label'        => 'mapの上の濃いオーバーレイ', // スタイルの表示名
        )
    );
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
        'core/image', // ブロック名
        array(
            'name'         => 'img-upper', // スタイル名
            'label'        => '最上部の画像レイアウト', // スタイルの表示名
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
        'core/group', // ブロック名
        array(
            'name'         => 'map-textarea', // スタイル名
            'label'        => 'map上のテキストエリア', // スタイルの表示名
        )
    );
    register_block_style(
        'core/heading', // ブロック名
        array(
            'name'         => 'map-heading', // スタイル名
            'label'        => 'map上の見出し', // スタイルの表示名
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
        'core/post-featured-image', // ブロック名
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