<?php get_header() ?>

<section class="content-container">
	<h1 class="404-heading heading"><?php _e( 'Not Found', 'blitch' ) ?></h1>

	<div class="error404 not-found">
		<p><?php _e( 'Apologies, but the requested content could not be found.', 'blitch' ) ?></p>
		<?php do_action( 'blitch_404' ) ?>
	</div>
</section>

<?php get_footer() ?>
