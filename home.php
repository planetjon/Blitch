<?php get_header() ?>

<section id="homepage-features" class="content-container container">
	<?php BlogfolioTemplate::showWidgetContainer( 'homepage' ) ?>

	<div class="post-tiles latest-posts">
	<?php if( Blogfolio::config( 'feature-newest-post' ) && !is_paged() && have_posts() ) : the_post() ?>
		<div <?php post_class( 'latest-post blog-post post-tile' ) ?> style="<?php has_post_thumbnail() && printf('background-image: url(%s)', get_the_post_thumbnail_url( null, 'feature-thumbnail' ) ) ?>">
			<div class="post-preview">
				<?php the_excerpt() ?>
			</div>
			<a class="post-link" href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><span class="title-text"><?php the_title() ?></span></a>
		</div><!--
	<?php endif ?>
	<!--
	<?php while( have_posts() ) : the_post() ?>
		--><div <?php post_class( 'blog-post post-tile' ) ?> style="<?php has_post_thumbnail() && printf('background-image: url(%s)', get_the_post_thumbnail_url() ) ?>">
			<div class="post-preview">
				<?php the_excerpt() ?>
			</div>
			<a class="post-link" href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><span class="title-text"><?php the_title() ?></span></a>
		</div><!--
	<?php endwhile ?>
	-->
	</div>

	<?php BlogfolioTemplate::paginate( 'loop' ) ?>
</section>

<?php get_footer() ?>
