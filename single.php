<?php get_header() ?>

<section class="content-container">
<?php while( have_posts() ) : the_post() ?>
	<article id="post-<?php the_ID() ?>" <?php post_class( 'main-content blog-post' ) ?>>
		<div class="post-feature">
			<?php do_action( 'blitch_post_feature' ) ?>
		</div>
		<header>
			<?php do_action( 'blitch_single_header' ) ?>
		</header>
		<?php if( has_excerpt() ) : ?>
			<div class="post-excerpt"><?php the_excerpt() ?></div>
		<?php endif ?>
		<div class="post-content">
			<?php the_content( __( 'Continue reading &mldr;', 'blitch' ) ) ?>
			<?php \planetjon\blitch\templates\showPagination( 'post' ) ?>
		</div>
		<footer>
			<?php do_action( 'blitch_single_footer' ) ?>
		</footer>
	</article>
<?php endwhile ?>
</section>

<?php get_footer() ?>
