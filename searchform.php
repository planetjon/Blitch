<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<label for="s">
		<span class="assistive">Search for:</span>
		<input type="search" placeholder="Search my site" size="14" value="<?php the_search_query() ?>" name="s" id="s"/>
	</label>
</form>
