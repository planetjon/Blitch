<div class="post-meta post-classification">
	<?php if( has_category() ) : ?><span class="categorized data"><?php _e( 'Categorized ', 'blogfolio' ) ?><?php the_category( ' &#183; ' ) ?></span><?php endif ?>
	<?php if( has_tag() ) : ?><span class="tagged data"><?php _e( 'Tagged ', 'blogfolio' ) ?><?php the_tags( '', ' &#183; ', '' ) ?></span><?php endif ?>
</div>
