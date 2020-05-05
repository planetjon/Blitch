<?php get_header() ?>

<section class="content-container">
	<article id="post-0" class="error404 not-found post main-content">
		<header>
			<h1 class="entry-title"><?php _e( 'Oops', 'blogfolio' ) ?></h1>
		</header>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but the requested content could not be found.', 'blogfolio' ) ?></p>
			<?php do_action( 'blogfolio_404' ) ?>
		</div>
		<footer>
		</footer>
	</article>
</section>

<?php get_footer() ?>
