<nav class="pagination navigation">
<?php

global $wp_query;
$big = 999999999;

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var( 'paged' ) ),
	'total' => $wp_query->max_num_pages,
	'prev_text'    => __( '&laquo;', 'blitch' ),
	'next_text'    => __( '&raquo;', 'blitch' )
) );

?>
</nav>
