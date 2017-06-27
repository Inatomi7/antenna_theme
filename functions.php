<?php

//+++++++++++++++++++++++++++++++++++++++++
//wp_head情報停止
//WordPressのバージョン情報の出力を停止
remove_action('wp_head', 'wp_generator');
//外部ツールを使ったブログ更新用のURL
//remove_action('wp_head', 'rsd_link');
//wlwmanifestWindows Live Writerを使った記事投稿URL
//remove_action('wp_head', 'wlwmanifest_link');
//デフォルトパーマリンクのURL
//remove_action('wp_head', 'wp_shortlink_wp_head');
//前の記事と後の記事のURL
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
//フィード（ベタでheadに記述）
//remove_action('wp_head', 'feed_links_extra', 3);
//ショートリンク
remove_action('wp_head', 'wp_shortlink_wp_head');
//重複コンテンツの自動指定
//remove_action('wp_head', 'rel_canonical');
//出力されたリンク先が、現在の文書に対する「索引（インデックス）」であることを示す。
//remove_action('wp_head', 'index_rel_link' );
//wpの更新情報の停止
add_filter( 'do_mu_upgrade','__return_false');
// 自動バックグラウンド更新を無効にするフィルターフック
add_filter( 'automatic_updater_disabled', '__return_true' );
//+++++++++++++++++++++++++++++++++++++++++


//+++++++++++++++++++++++++++++++++++++++++
//htmlへのfeedリンク削除
remove_action('wp_head', 'feed_links', 2); /* サイト全体のフィード */
remove_action('wp_head', 'feed_links_extra', 3); /* その他のフィード */
//+++++++++++++++++++++++++++++++++++++++++


//+++++++++++++++++++++++++++++++++++++++++
//投稿一覧で表示される記事数を変更する。
//function my_edit_posts_per_page($posts_per_page) {
//   return 50; // ここの数字を表示したい記事数に変更してください。
//}
//add_filter('edit_posts_per_page', 'my_edit_posts_per_page');
//+++++++++++++++++++++++++++++++++++++++++


//抜粋のpタグ除去
remove_filter('the_excerpt', 'wpautop');
//コンテンツのpタグ除去
remove_filter('the_content', 'wpautop');
//カテゴリ説明のpタグ除去
remove_filter('term_description','wpautop');


//+++++++++++++++++++++++++++++++++++++++++
//RSSフィードのキャッシュ0
add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 100;' ) );
//RSSフィードにカスタムフィールドの画像を挿入
function fields_in_feed($content) {
    if(is_feed()) {
        $post_id = get_the_ID();
        $output = '<p style="width:128px;"><img src="' . get_post_meta($post_id, 'thumbnail_url', true) . '" /></p>';
		$content = $content.$output;
    }
    return $content;
}
add_filter('the_content_feed','fields_in_feed');
add_filter('the_excerpt_rss', 'fields_in_feed');
//+++++++++++++++++++++++++++++++++++++++++


//+++++++++++++++++++++++++++++++++++++++++
//RSSをテーマ内から読み込む
remove_filter('do_feed_rss2', 'do_feed_rss2', 10);
function custom_feed_rss2(){
$template_file = '/feed-rss2.php';
load_template(get_template_directory() . $template_file);
}
add_action('do_feed_rss2', 'custom_feed_rss2', 10);

//+++++++++++++++++++++++++++++++++++++++++

class My_Taxonomy {
  //パーマリンク設定を空更新しなければ一覧ページが404エラーになる
  function __construct() {
    // initアクションのフック
    add_action( 'init', array( $this, 'my_init' ),10 );
  }

  function my_init() {
    // カスタムタクソノミーの登録
    register_taxonomy(
      'sitename', 'post', array(
        'public'            => true,
        'hierarchical'      => false,
        'show_admin_column' => true,
        'query_var' => 'sitename',
        'rewrite' => $rewrite['sitename'],
        'show_ui' => true,
        '_builtin' => true,
        'labels' => array(
          'name'         => 'サイト',
          'add_new_item' => 'サイトの新規追加',
          'edit_item'    => 'サイトの編集',
        ),
      )
    );

  }

} // class end

new My_Taxonomy();

//+++++++++++++++++++++++++++++++++++++++++
//ユーザーエージェント切り替え
function is_mobile(){
	$useragents = array(
		'iPhone',          // iPhone
		'iPod',            // iPod touch
		'Android',         // 1.5+ Android
		'dream',           // Pre 1.5 Android
		'CUPCAKE',         // 1.5+ Android
		'blackberry9500',  // Storm
		'blackberry9530',  // Storm
		'blackberry9520',  // Storm v2
		'blackberry9550',  // Storm v2
		'blackberry9800',  // Torch
		'webOS',           // Palm Pre Experimental
		'incognito',       // Other iPhone browser
		'webmate'          // Other iPhone browser
	);
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
//+++++++++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++++
//カスタムフィールド検索
add_filter( 'query_vars', 'my_query_vars' );
function my_query_vars( $public_query_vars ) {
    return array_merge( $public_query_vars, array( 'meta_key', 'meta_value' ) );
}
//+++++++++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++++
//投稿日時を経過日時に変更

function time_ago( $type = 'post' ) {
$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
return human_time_diff($d('U'), current_time('timestamp')) . "" . __('前');
}

//+++++++++++++++++++++++++++++++++++++++++


//+++++++++++++++++++++++++++++++++++++++++
//プラグインampのSchema.orgによる構造化データを編集

add_filter( 'amp_post_template_metadata', 'xyz_amp_modify_json_metadata', 10, 2 );
function xyz_amp_modify_json_metadata( $metadata, $post ) {

    /*
    // アンテナサイトのサブドメインを抽出
    $server_domain = $_SERVER['HTTP_HOST'];
    preg_match('/(.*)\.fuuuuuuuck\.com/', $server_domain , $sub_domain );

    $logosize = getimagesize(get_template_directory_uri() . "/img/" . $sub_domain[1] ."/logo.png"); 

    $metadata['publisher']['logo'] = array(
        '@type' => 'ImageObject',
        'url' => get_template_directory_uri() . "/img/" . $sub_domain[1] ."/logo.png",
        'height' => $logosize[1],
        'width' => $logosize[0]
    );
    */
    $metadata = false ; //カルーセル表示のための構造化データは条件が厳しいため。いったん記載をやめる
    return $metadata;
}

//+++++++++++++++++++++++++++++++++++++++++

