<?php get_header() ?>

<section class="content-container">
<?php while( have_posts() ) : the_post() ?>
	<article id="page-<?php the_ID() ?>" <?php post_class( 'main-content page' ) ?>>
		<header>
			<?php do_action( 'blogfolio_page_header' ) ?>
		</header>
		<div class="page-content">
			<?php the_content( __( 'Continue reading &rarr;', 'blogfolio' ) ) ?>
			<?php BlogfolioTemplate::paginate( 'post' ) ?>
		</div>
		<footer>
			<?php do_action( 'blogfolio_page_footer' ) ?>
		</footer>
	</article>
<?php endwhile ?>
</section>

<?php get_footer() ?>
