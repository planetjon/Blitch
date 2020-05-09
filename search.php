<?php get_header() ?>

<section class="content-container search-index index">
	<h1 class="search-title title"><?php printf( __( 'Searched: %s', 'blitch' ), get_search_query() ) ?></h1>
	<?php get_template_part( 'loop', 'search' ) ?>
</section>

<?php get_footer() ?>
