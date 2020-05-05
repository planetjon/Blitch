<nav class="pagination navigation">
<?php

wp_link_pages( array(
	'before' => '',
	'after' => '',
	'link_before' => '<span class="page-numbers">',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'previouspagelink' => __( '&laquo;', 'blogfolio' ),
	'nextpagelink' => __( '&raquo;', 'blogfolio' ),
) );

?>
</nav>
