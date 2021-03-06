<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @since 4.0.0
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 */
do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>

<channel>
	<title><?php wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<sy:updatePeriod><?php
		$duration = 'hourly';

		/**
		 * Filters how often to update the RSS feed.
		 *
		 * @since 2.1.0
		 *
		 * @param string $duration The update period. Accepts 'hourly', 'daily', 'weekly', 'monthly',
		 *                         'yearly'. Default 'hourly'.
		 */
		echo apply_filters( 'rss_update_period', $duration );
	?></sy:updatePeriod>
	<sy:updateFrequency><?php
		$frequency = '1';

		/**
		 * Filters the RSS update frequency.
		 *
		 * @since 2.1.0
		 *
		 * @param string $frequency An integer passed as a string representing the frequency
		 *                          of RSS updates within the update period. Default '1'.
		 */
		echo apply_filters( 'rss_update_frequency', $frequency );
	?></sy:updateFrequency>
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');

	// アンテナサイトのサブドメインを抽出
	$server_domain = $_SERVER['HTTP_HOST'];
	preg_match('/(.*)\.fuuuuuuuck\.com/', $server_domain , $sub_domain );

	$site_json = file_get_contents( '../json/site_master.json');
	$site_json = mb_convert_encoding($site_json , 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$site_json = json_decode( $site_json , true );

	$ga_json  = file_get_contents( "../ga/ga.json");
	$ag_json = mb_convert_encoding($ga_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$ga_json = json_decode($ga_json,true);


  //表示させたくないカテゴリーをサイト別に指定
  if($sub_domain[1] == "kikaku"){
  	$not_categorys =  array('レイプ', '着エロ');
  }elseif ($sub_domain[1] == "shirouto") {
  	$not_categorys =  array('企画', '着エロ');
  }elseif ($sub_domain[1] == "wife-madam") {
  	$not_categorys =  array('企画', '素人', 'レイプ', '着エロ');
  }elseif ($sub_domain[1] == "rape") {
  	$not_categorys =  array('素人', '着エロ');
  }elseif ($sub_domain[1] == "chakuero") {
  	$not_categorys =  array();
  }

	foreach ($ga_json as $key => $value) {
  	$rss_site[] = $site_json[$key]['name'];
	}

	$args = array(
	  'post_type' => 'post',
	  'orderby' => 'date',
	  'order' => 'DESC',
	  'posts_per_page' => 10,
	  'paged' => $paged,
	  'tax_query' => array(                     //(array) - タクソノミーパラメーターを指定する（バージョン3.1以降で有効）。
	  'relation' => 'AND',                      //(string) - それぞれのタクソノミーを指定するのに'AND'か'OR'が使用できる。
	    array(
	      'taxonomy' => 'sitename',             //(string) - タクソノミー。
	      'field' => 'slug',                    //(string) - IDかスラッグのどちらでタクソノミー項を選択するか
	      'terms' => $rss_site,                  //(int/string/array) - タクソノミー項
	      'operator' => 'IN'
	    ),
	    array(
	      'taxonomy' => 'category',             //(string) - タクソノミー。
	      'field' => 'slug',                    //(string) - IDかスラッグのどちらでタクソノミー項を選択するか
	      'terms' => $not_categorys,             //(int/string/array) - タクソノミー項
	      'operator' => 'NOT IN'
	    )
	  )
	);

	$my_query = new WP_Query($args);
	while ( $my_query->have_posts() ) : $my_query->the_post(); 
	?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
<?php if ( get_comments_number() || comments_open() ) : ?>
		<comments><?php comments_link_feed(); ?></comments>
<?php endif; ?>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<dc:creator><![CDATA[<?php the_author() ?>]]></dc:creator>
		<?php the_category_rss('rss2') ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
	<?php $content = get_the_content_feed('rss2'); ?>
	<?php if ( strlen( $content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
<?php if ( get_comments_number() || comments_open() ) : ?>
		<wfw:commentRss><?php echo esc_url( get_post_comments_feed_link(null, 'rss2') ); ?></wfw:commentRss>
		<slash:comments><?php echo get_comments_number(); ?></slash:comments>
<?php endif; ?>
<?php rss_enclosure(); ?>
	<?php
	/**
	 * Fires at the end of each RSS2 feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_item' );
	?>
	</item>
	<?php endwhile; ?>
</channel>
</rss>