<?php
  $pop_pages_json  = file_get_contents( "../ga/pop_pages.json");
  $pop_pages_json = mb_convert_encoding($pop_pages_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $pop_pages_json = json_decode($pop_pages_json,true);
?>

<!--side_left_start-->
<div id="side_left">
    <div class="wrap_box">
        <h3 class="osusume">昨日の人気記事</h3>
        <ul>
                <?php

                  if (is_mobile()){
                    $i = 5 ;
                  }else{
                    $i = 0 ;
                  }

                  while ($i < 10){ //$i=9が10位なので、11位以降はループ停止

                      $pop_pages = str_replace("/archives/", "", $pop_pages_json[$i][0]); //文字列/archives/を取り除き変数へ

                      $args = array(/* 配列に複数の引数を追加 */
                        'posts_per_page' => 1,
                        'name' =>  $pop_pages, //投稿名を指定
                        'post_type' => array(
                            'post'
                          )
                      ); 

                      $my_query = new WP_Query($args); 

                       if(have_posts()):
                       while ( $my_query->have_posts() ) : $my_query->the_post(); 
                      ?>

                      <li class="clearfix">
                          <div class="thumbnail_box">
                              <a href="<?php echo get_permalink(); ?>">
                                  <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>"/>
                              </a>
                          </div>
                          <p class="sub_title"><a href="<?php echo get_permalink(); ?>">
                            <?php echo mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                          <p class="pageview <?php echo $sub_domain[1]; ?>_bgc"><?php echo number_format($pop_pages_json[$i][1]); ?> pv</p>
                      </li>

                      <?php
                      endwhile; // end of the loop.
                      else:endif;
                      $i++ ;
                      wp_reset_postdata(); 
                  }
                ?>
        </ul>
    </div>
</div>
<!--side_left_end-->