    <!-- /.sp_wrap --></div>
<!-- /#contents --></div>
<!--ranking_foot_start-->
<div class="sp_wrap"><!-- ランキング6位〜10位 -->
    <div id="accessbox_top">
        <ul class="clearfix">
                <?php
                $rank_count = 0 ;
                foreach ( $ga_conversion_json as $key => $value ){
                  if( $site_json[$key]['name'] == null ){ continue; } // 当てはまるドメインでなければスキップ

                  $rank_count++ ;
                  $rank_count2 = $rank_count ;

                  if( $rank_count <= 5 ){ continue; } // 5位まではスキップ
                  if( $rank_count >= 11 ){ break; } // 11位からブレイク
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
                      <div class="thumbnail_box">
                        <a href="<?php echo get_permalink(); ?>">
                          <img src="<?php echo get_post_meta($post->ID, 'thumbnail_url', true); ?>" alt="<?php the_title(); ?>" />
                        </a>
                      </div>
                      <p class="sub_title"><a href="<?php echo get_permalink(); ?>"><?php echo  mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                      <p class="ranking <?php echo $sub_domain[1]; ?>_bgc"><?php echo $rank_count; ?>位</p>
                  </li>
                <?php
                  endwhile; // end of the loop.
                  wp_reset_postdata(); 
                }


                /* ランキング形成される前の表示　ここから */
                if($rank_count < 10){

                          if($random_count_set == false){//header.phpで $random_countが生成されていない場合は

                              foreach ($site_json as $key => $value) {
                                $belong_site = $site_json[$key]['belong'] ; //jsonからbelong配列取得
                                $server_domain = in_array($sub_domain[1], $belong_site) ; 
                                if($server_domain){ //当サイトのサブドメインが含まれるサイト名は配列に
                                  $this_site_belong[] = $site_json[$key]['name'] ;
                                }
                              }

                              $site_count = count($this_site_belong) -1 ; //配列の要素数-1の数を取得

                              $random_count_r = range( 0, $site_count ); //属しているサイトの数だけ配列要素を作成

                              shuffle( $random_count_r ); //数字をかき混ぜる

                          }else{
                            //header.phpで $random_countが生成されてある場合は逆にして活用
                            $random_count_r = array_reverse( $random_count ); //配列を逆にする
                          }


                          $i = 0 ;

                          foreach ($random_count_r as $key => $value) {

                            if(($rank_count >= 10) || ($i >= 5 )){ break ; }

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
                              <p class="sub_title"><a href="<?php echo get_permalink(); ?>">
                                <?php echo mb_substr(get_the_title() , 0, 29); ?> …</a></p>
                              <p class="ranking <?php echo $sub_domain[1]; ?>_bgc">pickup!!</p>
                          </li>

                          <?php

                            $rank_count++; //記事があった場合はサイトカウントを増やす
                            $i++ ; //処理の数だけ増やす
                            endwhile; else: endif; // end of the loop.
                            wp_reset_postdata();

                          }

                }
                
                /* ランキング形成される前の表示　ここまで */

                ?>
        </ul>
    </div>
<!-- /ランキング6位〜10位 --></div>
<!--ranking_foot_end-->

<?php if (is_mobile()):
    include( TEMPLATEPATH . '/sp_tab2.php' );
else:
    include( TEMPLATEPATH . '/pc_tab2.php' );
endif; ?>

<!--footer_start-->
<footer>
  <div class="f_wrap clearfix">
      <div class="left_box">
          <h4 class="sub_title">逆アクセスランキング（3day）PC＋スマホ</h4>
            <div class="wrap_box heightLine-group2">
            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<th colspan="3">アクセスランキング（UU）</th>
                    </tr>
                            <?php

                                  $rank_count = 0 ;

                                  foreach ( $ga_json as $key => $value ){
                                    
                                    if( $site_json[$key]['name'] == null ){ continue; } // 当てはまるドメインでなければスキップ

                                    $rank_count++;

                                    if($rank_count > 20){ break; } //20位まで出力

                                    echo '<tr><td class="left">'. $rank_count . '</td>';
                                    echo '<td class="center">'. $site_json[$key]['name'] . '</td>';
                                    echo '<td class="right">'. $value . '</td></tr>';

                                  }

                            ?>
                    <tr>
                        <td colspan="3" class="center2">- GoogleAnalytics -</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="center_box">
          <h4 class="sub_title">逆アクセスランキング（3day）UU x CTR</h4>
            <div class="wrap_box heightLine-group2">
            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<th colspan="3">※こちらをランキングシステムに使用</th>
                    </tr>
                            <?php

                                    $rank_count = 0 ;

                                    foreach ( $ga_conversion_json as $key => $value ){
                                      
                                      if( $site_json[$key]['name'] == null ){ continue; } // 当てはまるドメインでなければスキップ

                                      $rank_count++;

                                      if($rank_count > 20){ break; } //20位まで出力

                                      echo '<tr><td class="left">'. $rank_count . '</td>';
                                      echo '<td class="center">'. $site_json[$key]['name'] . '</td>';
                                      //echo '<td class="right">'. $value . '</td></tr>';

                                    }
                            ?>
                    <tr>
                        <td colspan="3" class="center2">- GoogleAnalytics -</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="right_box">
          <h4 class="sub_title">アクセスカウンター（pv）とお知らせ</h4>
            <div class="wrap_box heightLine-group2">
            <div class="wrap_box_in">
              <?php $today_pv  = file_get_contents( "../ga/today_pv.txt"); ?>
              <?php $yesterday_pv  = file_get_contents( "../ga/yesterday_pv.txt"); ?>
              <?php $total_pv  = file_get_contents( "../ga/total_pv.txt"); ?>
               <div class="counter1">今日のアクセス数： <?php echo number_format($today_pv) . " pv"; ?></div>
               <div class="counter1">昨日のアクセス数： <?php echo number_format($yesterday_pv) . " pv"; ?></div>
               <div class="counter1">総アクセス数： <?php echo number_format($total_pv) . " pv"; ?></div>
              	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                  	<tr>
                        <th>2016/10/5</th>
                        <td>各アンテナサイトを公開しました。</td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
    </div>
    <nav class="pc_drawer">
        <ul class="clearfix">
            <li><a href="<?php echo home_url(); ?>/">TOP</a></li>
            <li><a href="<?php echo home_url(); ?>/about">当サイトについて</a></li>
            <li><a href="<?php echo home_url(); ?>/webmaster">WEBマスター様へ</a></li>
            <li><a href="<?php echo home_url(); ?>/feed">RSS</a></li>
            <li><a href="http://contact.fuuuuuuuck.com/">お問い合わせ</a></li>
        </ul>
    </nav>
    
    <div class="sp_drawer drawer_wrap">
        <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only">toggle navigation</span>
            <span class="drawer-hamburger-icon"></span>
        </button>
 
        <nav class="drawer-nav">
            <ul class="drawer-menu dropdown">
                <!-- ドロワーメニューの中身 -->
                <li><a class="drawer-menu-item" href="<?php echo home_url(); ?>/">TOP</a></li>
                <li><a class="drawer-menu-item" href="<?php echo home_url(); ?>/about">当サイトについて</a></li>
                <li><a class="drawer-menu-item" href="<?php echo home_url(); ?>/webmaster">WEBマスター様へ</a></li>
                <li><a class="drawer-menu-item" href="<?php echo home_url(); ?>/feed">RSS</a></li>
                <li><a class="drawer-menu-item" href="<?php echo home_url(); ?>/contact">お問い合わせ</a></li>
                <li><a class="drawer-menu-item" href="#top">ページの先頭へ</a></li>
            </ul>
        </nav>
    </div>
    <div class="copy"><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></div>
</footer>
<!--footer_end-->

<?php wp_footer(); ?>
</body>
</html>