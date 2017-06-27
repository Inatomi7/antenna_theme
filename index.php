<?php include( TEMPLATEPATH . '/header.php' ); ?>
    <div id="left_wrap" class="clearfix">
        <div id="list">
            <ul class="list_box clearfix">
                <div class="wrap_box wrap_box_index">
                  <p class="cat_title">
                  新着記事一覧：<?php echo number_format($wp_query->found_posts); ?>件
                  </p>
                </div>
                <?php
                  $args = array(/* 配列に複数の引数を追加 */
                     'post_type' => array(
                      'post',
                      ),
                     'paged' => $paged
                ); ?>
                <?php query_posts( $args ); ?>
                <?php while ( have_posts() ) : the_post(); ?>

                <li class="heightLine-group1">
                      <div class="wrap_box clearfix">
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

                <?php endwhile; // end of the loop. ?>
            </ul>

            <div class="wp_pagenavi_box clearfix"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
            <?php wp_reset_query(); ?>
            <!-- /#list --></div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
    </div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>