<?php include( TEMPLATEPATH . '/header.php' ); ?>
    <div id="left_wrap" class="clearfix">
        <div id="list">
            <ul class="list_box clearfix">

                <?php if(is_category()): ?>
                <div class="wrap_box wrap_box_index">
                  <p class="cat_title">
                  <?php single_cat_title(); ?>の一覧ページ：<?php echo number_format($wp_query->found_posts); ?>件
                  </p>
                </div>
                <?php elseif(is_month()): ?>
                <div class="wrap_box wrap_box_index"><p class="cat_title"><?php echo $year.'年'.$monthnum.'月'; ?>の一覧ページ</p></div>
                <?php elseif (is_tag()): ?>
                <div class="wrap_box wrap_box_index"><p class="cat_title"><?php single_tag_title(); ?>の一覧ページ</p></div>
                <?php elseif ( is_tax( 'sitename' )): ?>
                <div class="wrap_box wrap_box_index">
                  <p class="cat_title">
                    サイト名：<?php single_term_title(); ?>の一覧ページ：<?php echo number_format($wp_query->found_posts); ?>件
                  </p>
                </div>
                <?php endif; ?>

            	<?php
                    $year = get_query_var('year');
                    $monthnum = get_query_var('monthnum');
                    $current_term = single_term_title("", false);

            				$args = array(
            					'cat' => $cat,
                      'tag' => $tag,
                      'tax_query' => array(
                          'relation' => 'OR',
                          array(
                              'taxonomy' => 'sitename',
                              'field' => 'name',
                              'terms' => $current_term
                          )
                      ),
                      'year' => $year,
                      'monthnum' => $monthnum,
            					'post_type' => array(
            					   'post'
            					 ),
            					'posts_per_page' => 10,
            					'paged' => $paged
            			); ?>

            			<?php query_posts( $args ); ?>
            			<?php while ( have_posts() ) : the_post(); ?>
                        
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
                  <?php endwhile; // end of the loop. ?>
            <!-- /.list_box --></ul>

            <div class="wp_pagenavi_box clearfix"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
            <?php wp_reset_query(); ?>
            <!-- /#list --></div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
    <!-- /#left_wrap --></div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>