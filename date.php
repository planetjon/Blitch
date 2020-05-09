<?php get_header() ?>

 <section class="content-container date-archive archive">
	<h1 class="date-heading heading">
	<?php if( is_day() ) : ?>
		<?php printf( __( 'Posted: %s', 'blitch' ), get_the_date() ) ?>
	<?php elseif( is_month() ) : ?>
		<?php printf( __( 'Posted: %s', 'blitch' ), get_the_date( _x( 'F Y', 'monthly date format', 'blitch' ) ) ) ?>
	<?php elseif( is_year() ) : ?>
		<?php printf( __( 'Posted: %s', 'blitch' ), get_the_date( _x( 'Y', 'yearly date format', 'blitch' ) ) ) ?>
	<?php endif ?>
	</h1>
	<?php get_template_part( 'loop', 'date' ) ?>
</section>

<?php get_footer() ?>
