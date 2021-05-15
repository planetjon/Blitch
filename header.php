<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<head>
		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?>>
		<?php wp_body_open() ?>
		<div id="page-container" class="container">

		<?php do_action( 'blitch_topbar' ) ?>

		<a class="assistive-text" href="#page-content" title="<?php esc_attr_e( 'Skip to content', 'blitch' ) ?>"><?php _e( 'Skip to content', 'blitch' ) ?></a>

		<header id="site-header">
			<div class="container">
				<?php do_action( 'blitch_site_header' ) ?>
			</div>
		</header>

		<main id="page-content">
			<div class="container">
			<?php do_action( 'blitch_before_content' ) ?>
