<nav class="pagination navigation"><?php

wp_link_pages( [
	'before' => '',
	'after' => '',
	'link_before' => '<span class="page-numbers">',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'previouspagelink' => __( '&laquo;', 'blitch' ),
	'nextpagelink' => __( '&raquo;', 'blitch' ),
] );

?></nav>
