<?php get_header() ?>

 <section class="content-container search-archive">
	<h1 class="search-title title"><?php printf( __( 'Searched: %s', 'blogfolio' ), get_search_query() ) ?></h1>
	<?php get_template_part( 'loop', 'search' ) ?>
</section>

<?php get_footer() ?>
