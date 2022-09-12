<div class="post-meta post-classification">
<?php if( has_category() || has_tag() ) : ?>
	<span class="label"><?php _e( 'posted under', 'blitch' ) ?></span>
	<?php if( has_category() ) : ?>
		<div class="categorized data">
			<?php the_category( new \planetjon\blitch\templates\DummySeparator ) ?>
		</div>
	<?php endif ?>
	<?php if( has_tag() ) : ?>
		<div class="tagged data">
			<?php the_tags( '', new \planetjon\blitch\templates\DummySeparator, '' ) ?>
		</div>
	<?php endif ?>
<?php endif ?>
</div>
