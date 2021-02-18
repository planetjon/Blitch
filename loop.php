<?php if( !have_posts() ) : ?>
	<div class="no-results">
		<?php do_action( 'blitch_no_results' ) ?>
	</div>
<?php endif; ?>

<?php while( have_posts() ) : the_post() ?>
	<article id="post-<?php the_ID() ?>" <?php post_class( 'blog-post' ) ?>>
	<?php do_action( 'blitch_loop_post' ) ?>
	</article>
<?php endwhile ?>

<?php \planetjon\blitch\templates\showPagination( 'loop' ) ?>
