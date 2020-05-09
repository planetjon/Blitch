<?php get_header() ?>

 <section class="content-container taxonomy-archive archive">
	<h1 class="taxonomy-heading heading"><?php single_term_title() ?></h1>
	<?php if( term_description() ) : ?>
	<div class="synopsis"><blockquote><?php echo term_description() ?></blockquote></div>
	<?php endif ?>

	<?php get_template_part( 'loop', 'taxonomy' ) ?>
</section>

<?php get_footer() ?>
