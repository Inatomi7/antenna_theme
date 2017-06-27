<!--side_right_start-->
<div id="side_right">
    <div class="wrap_box">
        <h3 class="search">サイト内検索</h3>
        <div class="search_box">
            <form class="firstChild lastChild" method="get" id="searchform" action="<?php bloginfo('url'); ?>">
            <p class="search submit firstChild lastChild">
                <input class="search-txt firstChild empty" value="" name="s" id="s" type="text">
                <input class="SE4_btn lastChild empty" id="searchsubmit" value="検索" type="submit">
            </p>
            </form>
        </div>
    </div>

    <div class="wrap_box">
        <h3 class="pickup">ピックアップ記事</h3>
        <ul class="pickup">

                <?php
                $rank_count = 0 ;
                foreach ( $ga_json as $key => $value ){
                  if( $site_json[$key]['name'] == null ){ continue; } // 当てはまるドメインでなければスキップ
                  $rank_count++;

                  if (is_mobile()){
                    if($rank_count > 5){ break; } // 6位以降はブレイク
                  }else{
                    if($rank_count > 10){ break; } // 11位以降はブレイク
                  }

                  $args = array(/* 配列に複数の引数を追加 */
                    'posts_per_page' => 1,
                    'offset' => 1,
                    'sitename' => $site_json[$key]['name'],
                    'post_type' => array(
                        'post'
                      )
                  ); 
                  $my_query = new WP_Query($args); 
                   while ( $my_query->have_posts() ) : $my_query->the_post(); 
                ?>
                <li class="clearfix">
                    <div class="thumbnail_box">
                        <a href="<?php echo get_permalink(); ?>">
                            <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/>
                        </a>
                    </div>
                    <p class="sub_title"><a href="<?php echo get_permalink(); ?>"><?php echo mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                </li>

                <?php
                  endwhile; // end of the loop.
                  wp_reset_postdata(); 
                }


                /* ランキング形成される前の表示　ここから */

                  if (is_mobile()){
                     $count_limit = 5 ;
                  }else{
                     $count_limit = 10 ;
                  }

                if($rank_count < $count_limit){

                          foreach ($random_count as $key => $value) {

                            if (is_mobile()){
                              if($rank_count > 4){ break; } // 6位以降はブレイク
                            }else{
                              if($rank_count > 9){ break; } // 11位以降はブレイク
                            }

                            $args = array(// 配列に複数の引数を追加
                              'posts_per_page' => 1,
                              'offset' => 1,
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
                              <p class="sub_title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
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
</div>
<!--side_right_end-->