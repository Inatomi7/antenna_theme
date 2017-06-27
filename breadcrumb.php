<?php if(!is_home()): ?>
<div class="breadcrumbs">
<ul class="clearfix">
		<?php if (is_page()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php the_title(); ?></span></li>
		<?php elseif (is_category()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
			<?php
					$cat_ID = get_query_var('cat'); //現在のカテゴリIDを取得する
					$cat_date = get_category($cat_ID); //IDを元にカテゴリの様々な情報を配列に入れる。

				  if( $cat_date->parent ){ //$cat_date->parentは親カテゴリの「ID」
				  		$parent_cat = get_category( $cat_date->parent ); //親カテゴリの様々な情報を配列に入れる
							echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_term_link( $cat_date->parent ) . '" itemprop="url"><span itemprop="title">' . $parent_cat->name . '</span></a>　&nbsp;&gt;&nbsp;</li>';
				  }
			?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php single_cat_title(); ?></span></li>
    <?php elseif (is_tag()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php single_tag_title(); ?></span></li>
	<?php elseif (is_tax( 'sitename' )): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php single_term_title(); ?></span></li>
	<?php elseif(is_month()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo $year.'年'.$monthnum.'月'; ?></span></li>	
	<?php elseif (is_search()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php the_search_query(); ?>の検索結果</span></li>	
	<?php elseif (is_single()): ?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>/" itemprop="url"><span itemprop="title">トップ</span></a>　&nbsp;&gt;&nbsp;</li>
			<?php 
			$cat_date = get_the_category() ; //記事が属するカテゴリ情報を配列に入れる
			foreach ($cat_date as $key => $value) {//親カテゴリが見つかるまで繰り返す
				$parent_ID = $cat_date[$key]->parent ;
				if($parent_ID){//親カテゴリのIDが0(なし)でなかった場合その子カテゴリIDを変数に入れてループを終わる
					$cat_key = $key;
					$parent_date = get_category($parent_ID); //IDを元にカテゴリの様々な情報を配列に入れる。
					echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_term_link( $parent_ID ) . '" itemprop="url"><span itemprop="title">' . $parent_date->name . '</span></a>　&nbsp;&gt;&nbsp;</li>'; 
					break ;
				}
			}
			if($parent_ID){//親カテゴリが見つかった場合は、その親カテゴリに属する子カテゴリリンクを表示
			echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_category_link( $cat_date[$cat_key]->term_id ) . '" itemprop="url"><span itemprop="title">' . $cat_date[$cat_key]->name . '</span></a>　&nbsp;&gt;&nbsp;</li>';
			}else{//親カテゴリが１つも見つからなかった場合は、属するカテゴリの最初の１つを表示
			echo '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . get_category_link( $cat_date[0]->term_id ) . '" itemprop="url"><span itemprop="title">' . $cat_date[0]->name . '</span></a>　&nbsp;&gt;&nbsp;</li>';
			}
			?>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_permalink(); ?>" itemprop="url"><span itemprop="title"><?php the_title(); ?></span></a></li>
	<?php endif; ?>
</ul>
<!-- /breadcrumb --></div>
<?php endif; ?>