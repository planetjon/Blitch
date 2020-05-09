<?php get_header() ?>

<section id="homepage-features" class="content-container home-index index">
	<?php \planetjon\blitch\templates\showWidgetContainer( 'homepage' ) ?>

	<div class="latest-posts">
	<?php while( have_posts() ) : the_post() ?>
		<article id="post-<?php the_ID() ?>" <?php post_class( 'blog-post' ) ?>>
		<?php do_action( 'blitch_loop_post' ) ?>
		</article>
	<?php endwhile ?>
	</div>

	<?php \planetjon\blitch\templates\showPagination( 'loop' ) ?>
</section>

<?php get_footer() ?>
