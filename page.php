<?php include( TEMPLATEPATH . '/header.php' ); ?>

		<div id="left_wrap" class="clearfix">
            <div id="main">
            	<?php if(have_posts()):while(have_posts()):the_post(); ?>
                <div class="wrap_box wrap_box_index">
                <h2 class="post_title"><?php the_title(); ?></h2>
                <?php the_content(); ?>
                </div>
                <?php endwhile; else: ?>
                <?php endif; ?>
            </div>
            <?php include( TEMPLATEPATH . '/side-left.php' ); ?>
        </div>
<?php include( TEMPLATEPATH . '/side-right.php' ); ?>

<?php include( TEMPLATEPATH . '/footer.php' ); ?>