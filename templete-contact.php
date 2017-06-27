<?php
/**
 * Template Name: template-contact
 *
 */
?>
<?php include( TEMPLATEPATH . '/header.php' ); ?>

    <div id="left_wrap" class="clearfix">
            <div id="main">
              <?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="wrap_box wrap_box_index">
                <h2 class="post_title"><?php the_title(); ?></h2>

                <form action="http://fuuuuuuuck.com/contact/#wpcf7-f5-p7-o1" method="post" class="wpcf7-form" novalidate="novalidate">
                <div style="display: none;">
                <input type="hidden" name="_wpcf7" value="5" />
                <input type="hidden" name="_wpcf7_version" value="4.5" />
                <input type="hidden" name="_wpcf7_locale" value="ja" />
                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5-p7-o1" />
                <input type="hidden" name="_wpnonce" value="22bf3972c4" />
                </div>
                <dl class="contact">
                <dt>お名前 (必須)</dt>
                <dd><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></dd>
                <dt>メールアドレス (必須)</dt>
                <dd><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span></dd>
                <dt style="display:none;">お問い合わせ元</dt>
                <dd style="display:none;"><span class="wpcf7-form-control-wrap site-name"><input type="text" name="site-name" value="<?php bloginfo('name'); ?>" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span></dd>
                <dt>題名</dt>
                <dd><span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span></dd>
                <dt>メッセージ本文</dt>
                <dd><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span></dd>
                </dl>
                <p class="submit"><input type="submit" value="送信" class="wpcf7-form-control wpcf7-submit" /></p>
                <div class="wpcf7-response-output wpcf7-display-none"></div></form>
                
                </div>
                <?php endwhile; else: ?>
                <?php endif; ?>
            </div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
        </div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>