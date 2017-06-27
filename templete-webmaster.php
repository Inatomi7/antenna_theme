<?php
/**
 * Template Name: template-webmaster
 *
 */
?>
<?php include( TEMPLATEPATH . '/header.php' ); ?>

    <div id="left_wrap" class="clearfix">
            <div id="main">
              <?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="wrap_box wrap_box_index">
                <h2 class="post_title"><?php the_title(); ?></h2>

                  <dl class="webmaster">
                    <dt>ご挨拶</dt>
                      <dd>
                        いつもお世話になっております。<?php bloginfo('name'); ?>の管理人です。<br>
                      </dd>
                      
                      <dt>掲載について</dt>
                      <dd class="bullet">
                        <span class="bullet">・</span>RSSで記事の内容が取得可能（サムネイル含む）。<br>
                        <span class="bullet">・</span>動画共有サイトへのリンク及び、埋め込み動画が掲載さている。<br>
                        <span class="bullet">・</span>無修正、児童ポルノ、またはそれに準ずる動画を掲載及び、リンクしていない。<br>
                        <span class="bullet">・</span>無修正のサムネイル及び、画像を掲載していない。<br>
                        <span class="bullet">・</span>当サイトへのリンク及び、RSSを掲載している。<br>
                        <span class="bullet">・</span>ワンクリック詐欺を掲載していない。<br>
                        <span class="bullet">・</span>他サイトの記事を転載及び、スクレイピングしていない。<br>
                        <span class="bullet">・</span>関係の無い画像やテキスト及び、POPなどからの騙しリンクでアクセスを送る行為。<br>
                        <span class="bullet">・</span>登録申請は <a href="http://contact.fuuuuuuuck.com/" target="_blank">こちら</a> から<br>
                      </dd>

                     <dt>優遇措置</dt>
                      <dd class="bullet">
                        <span class="bullet">・</span>逆アクセスランキング（過去3日間で集計）1位〜5位のサイト様はヘッダー部に記事を表示します。<br>
                        <span class="bullet">・</span>逆アクセスランキング（過去3日間で集計）6位〜10位のサイト様はフッター部に記事を表示します。<br>
                        <span class="bullet">・</span>（掲示板でのお声を元に、新たな優遇措置ルールを追加する予定です。）<br>
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