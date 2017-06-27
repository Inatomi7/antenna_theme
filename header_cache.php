<!DOCTYPE HTML>
<html lang="ja">
<head>

<?php //サイトマスターjson読み込み 
$site_json = file_get_contents('../json/site_master.json');
$site_json = mb_convert_encoding($site_json , 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$site_json = json_decode( $site_json , true );

// アンテナサイトのサブドメインを抽出
$server_domain = $_SERVER['HTTP_HOST'];
preg_match('/(.*)\.fuuuuuuuck\.com/', $server_domain , $sub_domain );

if($sub_domain[1] == "kikaku"){
  $sitename_description = "企画";
}elseif($sub_domain[1] == "shirouto"){
  $sitename_description = "素人";
}elseif($sub_domain[1] == "wife-madam"){
  $sitename_description = "人妻熟女";
}elseif($sub_domain[1] == "rape"){
  $sitename_description = "レイプ";
}elseif($sub_domain[1] == "chakuero"){
  $sitename_description = "着エロ";
}elseif($sub_domain[1] == "magicmirror"){
  $sitename_description = "マジックミラー";
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=320,user-scalable=0" />
<meta name="format-detection" content="telephone=no">

<?php if(is_home()): ?>
<title><?php bloginfo('name'); ?>｜掲載動画数<?php echo $wp_query->found_posts; ?>件</title>

<meta name="description" content="<?php echo $sitename_description ; ?>の無料エロ動画<?php echo $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />

<?php elseif(is_category()): ?>
<title><?php $cat_info = get_category( $cat ); ?><?php echo wp_specialchars( $cat_info->name ); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件｜<?php bloginfo('name'); ?><?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?></title>
<meta name="description" content="<?php $cat_info = get_category( $cat ); ?><?php echo wp_specialchars( $cat_info->name ); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />


<?php elseif(is_tax( 'sitename' )): ?>
<title><?php single_term_title(); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件｜<?php bloginfo('name'); ?><?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?></title>
<meta name="description" content="<?php single_term_title(); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />

<?php elseif(is_404()): ?>
<title>404error｜お探しのページが見つかりませんでした</title>

<?php elseif(is_search()): ?>
<title><?php the_search_query(); ?>のエロ動画<?php echo $wp_query->found_posts; ?>件｜<?php bloginfo('name'); ?><?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?></title>
<meta name="description" content="<?php the_search_query(); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />

<?php elseif (is_tag()): ?>
<title><?php single_tag_title(); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件｜<?php bloginfo('name'); ?><?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?></title>
<meta name="description" content="<?php single_tag_title(); ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />

<?php elseif(is_month()): ?>
<title><?php echo $year.'年'.$monthnum.'月'; ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件｜<?php bloginfo('name'); ?><?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?></title>
<meta name="description" content="<?php echo $year.'年'.$monthnum.'月'; ?>のエロ動画<?php echo  $wp_query->found_posts; ?>件。<?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。<?php if(get_query_var('paged')) echo ' - ページ'.get_query_var('paged'); ?>" />

<?php elseif(is_page()): ?>
<title><?php single_post_title() ?>｜<?php bloginfo('name'); ?></title>
<meta name="description" content="<?php single_post_title() ?><?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。" />
<?php elseif(is_single()): ?>
<title><?php single_post_title() ?>｜<?php bloginfo('name'); ?></title>
<meta name="description" content="<?php single_post_title() ?><?php echo $sitename_description ; ?>アンテナは無料エロ動画検索サイトです。お探しの無料エロ動画を簡単に検索できます。" />
<?php endif; ?>

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/<?php echo $sub_domain[1]; ?>/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="<?php echo  get_template_directory_uri(); ?>/img/<?php echo $sub_domain[1]; ?>/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="<?php echo  get_template_directory_uri(); ?>/img/<?php echo $sub_domain[1]; ?>/favicon-114.png">

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/pc.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sp.css" media="screen and (min-width:0px) and (max-width:480px)" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/drawer.css" media="screen and (min-width:0px) and (max-width:480px)" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie1.4.1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/yuga.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.page-scroller-308.js"></script>
<?php if (!is_mobile()): ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/heightLine.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/iscroll.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/drawer.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/dropdown.js"></script>

<script type="text/javascript">
var sub_domain = location.href.split(/http:\/\/(.*)\.fuuuuuuuck.com/)[1];
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".drawer").drawer();
    });
</script>
<script>
$(function(){
    //画像が見つからないときにエラーイベント発生
    $('img').error(function() {
        //置換処理
        $(this).attr({
            src: '<?php echo get_template_directory_uri(); ?>/img/no-image.gif',
            alt: 'none image',
        });
    });
});
</script>
<?php

//アナリティクス用のデータ取得
$ga_tracking = file_get_contents( "../json/tabs.json");
$ga_tracking = mb_convert_encoding($ga_tracking, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$ga_tracking = json_decode($ga_tracking,true);

?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $ga_tracking[ $sub_domain[1]]['tracking_code']; ?>' , 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript">jQuery(function() {  
    jQuery("a").click(function(e) {        
        var ahref = jQuery(this).attr('href');
        if (ahref.indexOf("<?php echo $sub_domain[1] . '.fuuuuuuuck.com'; ?>") != -1 || ahref.indexOf("http") == -1 ) {
            ga('send', 'event', '内部リンク', 'クリック', ahref);} 
        else { 
            ga('send', 'event', '外部リンク', 'クリック', ahref);}
        });
    });
</script>
<?php wp_head(); ?>

</head>

<body id="top" class="drawer drawer--right <?php echo $sub_domain[1]; ?>_body">

<header>
    <h1>
      <a href="<?php echo home_url(); ?>/">
        <img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $sub_domain[1]; ?>/logo.png" alt="<?php echo "無料エロ動画検索" . $sitename_description . "アンテナ" ; ?>" /></a>
    </h1>
</header>

<?php if (is_mobile()):
    include( TEMPLATEPATH . '/sp_tab.php' );
else:
    include( TEMPLATEPATH . '/pc_tab.php' );
endif; ?>

<div class="sp_wrap">
	<?php include( TEMPLATEPATH . '/breadcrumb.php' ); ?>
</div>

<?php 

$ga_json  = file_get_contents( "../ga/ga.json");
$ga_json = mb_convert_encoding($ga_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$ga_json = json_decode($ga_json,true);

$ga_conversion_json  = file_get_contents( "../ga/ga_conversion.json");
$ga_conversion_json = mb_convert_encoding($ga_conversion_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$ga_conversion_json = json_decode($ga_conversion_json,true);


?>
<!--ranking_head_start-->
<div class="sp_wrap"><!-- ランキング1位〜5位 -->
    <div id="accessbox_top">
        <ul class="clearfix">
                <?php
                $rank_count = 0 ;
                foreach ( $ga_conversion_json as $key => $value ){
                  if( $site_json[$key]['name'] == null ){ continue; } // 当てはまるドメインでなければスキップ
                  $rank_count++;
                  if($rank_count > 5){ break; } // 6位以降はブレイク
                  $args = array(/* 配列に複数の引数を追加 */
                    'posts_per_page' => 1,
                    'sitename' => $site_json[$key]['name'],
                    'post_type' => array(
                        'post'
                      )
                  ); 
                  $my_query = new WP_Query($args); 
                   while ( $my_query->have_posts() ) : $my_query->the_post(); 
                ?>
                  <li class="clearfix">
                      <div class="thumbnail_box"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/></a></div>
                      <p class="sub_title"><a href="<?php echo get_permalink(); ?>"><?php echo  mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                      <p class="ranking <?php echo $sub_domain[1]; ?>_bgc"><?php echo $rank_count; ?>位</p>
                  </li>
                <?php
                  endwhile; // end of the loop.
                  wp_reset_postdata();
                }

                $random_count_set = false ;

                /* ランキング形成される前の表示　ここから */
                if($rank_count < 5){

                          foreach ($site_json as $key => $value) {
                            $belong_site = $site_json[$key]['belong'] ; //jsonからbelong配列取得
                            $server_domain = in_array($sub_domain[1], $belong_site) ; 
                            if($server_domain){ //当サイトのサブドメインが含まれるサイト名は配列に
                              $this_site_belong[] = $site_json[$key]['name'] ;
                            }
                          }

                          $site_count = count($this_site_belong) -1 ; //配列の要素数-1の数を取得

                          $random_count = range( 0, $site_count ); //属しているサイトの数だけ配列要素を作成
                          $random_count_set = true ;

                          shuffle( $random_count ); //数字をかき混ぜる

                          foreach ($random_count as $key => $value) {

                            if($rank_count >= 5){ break ; }

                            $args = array(// 配列に複数の引数を追加
                              'posts_per_page' => 1,
                              'sitename' => $this_site_belong[$value],
                              'post_type' => array(
                                  'post'
                                )
                            ); 
                            $my_query = new WP_Query($args); 

                          if(have_posts()): while ( $my_query->have_posts() ) : $my_query->the_post(); 
                          ?>

                           <li class="clearfix">
                              <div class="thumbnail_box">
                                <a href="<?php echo get_permalink(); ?>">
                                  <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/>
                                </a>
                              </div>
                              <p class="sub_title"><a href="<?php echo get_permalink(); ?>"><?php echo  mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                              <p class="ranking <?php echo $sub_domain[1]; ?>_bgc">pickup!!</p>
                          </li>

                          <?php

                            $rank_count++; //記事があった場合はサイトカウントを増やす
                            endwhile; else: endif; // end of the loop.
                            wp_reset_postdata();

                          }

                }
                
                /* ランキング形成される前の表示　ここまで */

                ?>
        </ul>
    </div>
<!-- /ランキング1位〜5位 --></div>
<!--ranking_head_end-->

<div class="sp_wrap">
    <div id="contents" class="clearfix">