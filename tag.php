<?php get_header() ?>

 <section class="content-container tag-archive archive">
	<h1 class="tag-heading heading"><?php single_tag_title() ?></h1>
	<?php if( tag_description() ) : ?>
	<div class="synopsis"><?php echo tag_description() ?></div>
	<?php endif ?>

	<?php get_template_part( 'loop', 'tag' ) ?>
</section>

<?php get_footer() ?>
