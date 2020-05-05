<?php if( !have_posts() ) : ?>
	<article id="post-0" class="no-results post main-content">
		<header>
			<h2 class="loop-title title"><?php _e( 'No results found', 'blogfolio' ) ?></h2>
		</header>
		<div class="entry-content">
			<p><?php _e( 'Apologies, no results were found.', 'blogfolio' ) ?></p>
			<?php do_action( 'blogfolio_no_results' ) ?>
		</div>
		<footer>
		</footer>
	</article>
<?php endif; ?>

<?php while( have_posts() ) : the_post() ?>
	<article id="post-<?php the_ID() ?>" <?php post_class( 'main-content blog-post' ) ?>>
		<div class="post-feature">
			<?php do_action( 'blogfolio_post_feature' ) ?>
		</div>
		<header>
			<?php do_action( 'blogfolio_loop_header' ) ?>
		</header>
		<div class="post-summary">
			<?php the_excerpt() ?>
		</div>
	</article>
<?php endwhile ?>

<?php BlogfolioTemplate::paginate( 'loop' ) ?>
