<?php include( TEMPLATEPATH . '/header.php' ); ?>
    <div id="left_wrap" class="clearfix">
        <div id="list">
            <ul class="list_box clearfix">

                <div class="wrap_box wrap_box_index"><p class="cat_title"><?php the_search_query(); ?>の検索結果：<?php echo number_format($wp_query->found_posts); ?>件</p></div>
                
              <?php
    					$s = $_GET['s'];
    					$args = array(/* 配列に複数の引数を追加 */
    						's' => $s,
    						'post_type' => array(
    						   'post'
    						 ),
    						'posts_per_page' => 10,
    						'paged' => $paged
    				); ?>
    				<?php query_posts( $args ); ?>
              <?php if(have_posts()) : ?>
        			<?php while(have_posts()):the_post() ?> 
                    <li class="heightLine-group1">
                          <div class="wrap_box">
                              <div class="thumbnail_box01">
                                <a href="<?php echo get_permalink(); ?>">
                                  <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt=""/>
                                </a>
                              </div>
                              <p class="day_box"><?php echo time_ago(); ?></p>
                              <h2 class="post_title"><?php echo mb_substr(get_the_title() , 0, 29); ?> …</h2>
                              <?php $post_contents = get_post_meta($post->ID, 'post_contents', true); ?>
                              <p class="site_name"><?php echo get_the_term_list($post->ID, 'sitename'); ?></p>
                              <p class="detail_btn"><a href="<?php echo get_permalink(); ?>" class="<?php echo $sub_domain[1]; ?>_bgc">続きを読む</a></p>
                          </div>
                      </li>
              <?php endwhile; ?>
              <?php else: ?>
                <div class="wrap_box wrap_box_index"><p class="cat_title">該当する記事が見つかりません</p></div>
              <?php endif; ?>

            <!-- /.list_box --></ul>

            <div class="wp_pagenavi_box clearfix"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
            <?php wp_reset_query(); ?>
            <!-- /#list --></div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
    <!-- /#left_wrap --></div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>