<?php include( TEMPLATEPATH . '/header.php' ); ?>
<div id="left_wrap" class="clearfix">
    <div id="main">
        <div class="wrap_box">

            <?php while(have_posts()):the_post(); ?>

            <p class="day_box"><?php echo time_ago(); ?></p>

                <div class="line_box">
                    <h2 class="post_title"><?php the_title(); ?></h2>
                    <div class="clearfix">
                        <div class="thumbnail_box01"><img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/></div>
                        <div class="post_content_wrap">
                            <div class="clearfix">
                                <p class="cate_name">
                                    <?php 
                                    echo 'カテゴリ：' . get_the_category_list( " , " );
                                    $carrent_post_id = $post->ID ;
                                    ?>
                                </p>
                            </div>
                            <p class="post_content"><?php the_content(); ?></p>
                            <p class="site_name"><?php echo get_the_term_list($post->ID, 'sitename'); ?></p>
                    		<p class="detail_btn"><a href="<?php echo get_post_meta($post->ID, 'post_url', true); ?>" class="<?php echo $sub_domain[1]; ?>_bgc">動画を見に行く</a></p>
                        </div>
                    </div>
                </div>

             <?php endwhile; ?>
            
            <!--<div class="line_box" style="display:none;">
                <h3 class="sub_title01">動画の関連作品</h3>
                <div class="wrap_box02">
                    <div class="thumbnail_box03"><a href="#"><img src="http://common.fuuuuuuuck.com/img/img_sample04.png" alt=""/></a></div>
                    <p class="description03">マジックミラー号に夏合宿中の大学水泳部の男女が初乗車！競泳水着でお互いのオナニーを見せ合ったら火が付いて合宿中の禁欲ルールを破り‘禁断SEX’までしてしまうのか！？</p>
                </div>
            </div>-->
            
            <div class="line_box">
                <h3 class="sub_title02">関連動画</h3>
                <div class="wrap_box03">
                    <ul class="clearfix">
                        <?php
                          $cate_date = get_the_category(); //記事の所属を配列に

                          foreach ($cate_date as $key => $value) {
                              if( ($cate_date[$key]->parent != 0) ){ //親カテゴリがある投稿のみ
                                $belong_categorys = $belong_categorys . $cate_date[$key]->slug . ","; //所属category名をカンマ区切りで１つの変数に
                              }
                          }

                          $args = array(/* 配列に複数の引数を追加 */
                            'posts_per_page' => 10 ,
                            'category_name' => $belong_categorys ,//所属する親カテゴリがある投稿カテゴリ
                            'post__not_in' => array($carrent_post_id), //指定した投稿IDは含めない $carrent_post_idは現在の投稿ID
                            'post_type' => array(
                                'post'
                              )
                          ); 
                          $my_query = new WP_Query($args); 
                          while ( $my_query->have_posts() ) : $my_query->the_post(); 
                        ?>
                            <li class="clearfix">
                                <div class="thumbnail_box04"><a href="<?php echo get_permalink(); ?>">
                                    <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/></a></div>
                                <p class="sub_title03"><a href="<?php echo get_permalink(); ?>"><?php echo  mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                            </li>

                        <?php
                          endwhile; // end of the loop.
                          wp_reset_postdata(); 
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="wp_pagenavi_box clearfix"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
    <!-- /#main --></div>
    <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
<!-- /#left_wrap --></div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>