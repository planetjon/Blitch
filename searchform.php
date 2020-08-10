<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<label for="s" class="assistive">Search for: </label>
	<input type="search" placeholder="&#8981;" size="14" value="<?php the_search_query() ?>" name="s" id="s"/>
</form>
