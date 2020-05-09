<div class="post-meta post-classification">
<?php if( has_category() || has_tag() ) : ?>
	<span class="label"><?php _e( 'tagged', 'blitch' ) ?></span>
	<?php if( has_category() ) : ?>
		<div class="categorized data">
			<span><?php the_category( new \planetjon\blitch\templates\DummySeparator ) ?></span>
		</div>
	<?php endif ?>
	<?php if( has_tag() ) : ?>
		<div class="tagged data">
			<span><?php the_tags( '', new \planetjon\blitch\templates\DummySeparator, '' ) ?></span>
		</div>
	<?php endif ?>
<?php endif ?>
</div>