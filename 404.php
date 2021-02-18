<?php get_header() ?>

<section class="content-container">
	<h1 class="404-heading heading"><?php _e( '404', 'blitch' ) ?></h1>

	<div class="not-found">
		<?php do_action( 'blitch_404' ) ?>
	</div>
</section>

<?php get_footer() ?>
