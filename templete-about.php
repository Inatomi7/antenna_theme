<?php
/**
 * Template Name: template-about
 *
 */
?>
<?php include( TEMPLATEPATH . '/header.php' ); ?>

    <div id="left_wrap" class="clearfix">
            <div id="main">
              <?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="wrap_box wrap_box_index">
                <h2 class="post_title"><?php the_title(); ?></h2>

                <dl class="about">
                  <dt>サイト名</dt>
                    <dd><?php bloginfo('name'); ?></dd>
                    
                    <dt>開設日</dt>
                    <dd>
                      <?php
                      if($sub_domain[1] == "magicmirror"){
                          echo "2016年9月" ;
                      }
                      ?>
                    </dd>
                    
                    <dt>サイトURL</dt>
                    <dd><?php echo home_url(); ?>/</dd>
                    
                    <dt>RSSのURL</dt>
                    <dd><?php echo home_url(); ?>/feed</dd>
                    
                    <dt>サイト紹介</dt>
                    <dd><?php bloginfo('name'); ?>は、無料エロ動画の検索サイトです。</dd>
                    
                    <dt>サイトポリシー</dt>
                    <dd class="bullet">
                      <span class="bullet">・</span><?php bloginfo('name'); ?>（以下、当サイト）はアダルトサイトです。18歳未満の方は閲覧できません。<br>
                        <span class="bullet">・</span>当サイトは動画紹介サイト巡回し、リンクを抽出して表示しております。<br>
                        <span class="bullet">・</span>当サイトの表示動画が著作権者の同意のもとアップロードされているかを、当サイトは確認しておりません。表示動画に問題がございましたら、各動画共有サイトへお問い合わせください。<br>
                        <span class="bullet">・</span>当サイトは著作権の侵害を助長しておりません。表示動画のご利用につきましては、各個人の責任でお願い致します。<br>
                        <span class="bullet">・</span>当サイトは動画共有サイトへのアップロード行為や推奨、援助する行為は一切行っておりません。<br>
                        <span class="bullet">・</span>当サイトの表示動画について著作権等の問題がございましたら、該当記事を削除致します。該当ページのアドレスを明記のうえご連絡ください。
                    </dd>
                </dl>
                
                </div>
                <?php endwhile; else: ?>
                <?php endif; ?>
            </div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
        </div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>