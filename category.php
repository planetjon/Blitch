<?php get_header() ?>

 <section class="content-container category-archive archive">
	<h1 class="category-heading heading"><?php single_cat_title() ?></h1>
	<?php if( category_description() ) : ?>
	<div class="synopsis"><blockquote><?php echo category_description() ?></blockquote></div>
	<?php endif ?>

	<?php get_template_part( 'loop', 'category' ) ?>
</section>

<?php get_footer() ?>
