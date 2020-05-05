<?php
// There should really be a more API-centric way of getting the author metadata. $author_name and $author are magical globals.
$author = isset( $_GET['author_name'] ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
?>

<?php get_header() ?>

<section class="content-container author-page">
	<h1>Published by <?php echo $author->display_name ?></h1>
	<?php if( $author->description || $author->user_url ) : ?>
	<div class="synopsis">
		<p class="description"><?php esc_html_e( $author->description ) ?></p>
		<dl>
			<?php if( $author->user_url ) : ?>
			<dt>Website</dt>
			<dd><a href="<?php echo esc_url( $author->user_url ) ?>"><?php echo esc_url( $author->user_url ) ?></a></dd>
			<?php endif ?>
		</dl>
	</div>
	<?php endif ?>

	<?php get_template_part( 'loop', 'author' ) ?>
</section>

<?php get_footer() ?>
