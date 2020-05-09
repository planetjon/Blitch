<?php get_header() ?>

<section class="content-container">
<?php while( have_posts() ) : the_post() ?>
	<article id="post-<?php the_ID() ?>" <?php post_class( 'main-content attachment' ) ?>>
		<header>
			<?php do_action( 'blitch_attachment_header' ) ?>
		</header>
		<div class="entry-content">
			<?php echo wp_get_attachment_link( $post->ID, 'large', false, true, false ) ?>
			<?php the_content( __( 'Continue reading &mldr;', 'blitch' ) ) ?>
		</div>
		<footer>
			<?php do_action( 'blitch_attachment_footer' ) ?>
		</footer>
	</article>
<?php endwhile ?>
</section>

<?php get_footer() ?>
