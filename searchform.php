<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<label for="s" class="assistive">Search for: </label>
	<input type="search" placeholder="<?php _e( 'Search...', 'blitch') ?>" size="14" value="<?php the_search_query() ?>" name="s" id="s"/><button type="submit">&#8981;</button>
</form>
