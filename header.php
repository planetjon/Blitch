<!DOCTYPE html>
<html <?php language_attributes() ?>>
    <head>
		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?>>
		<div id="page-container" class="container">

		<?php do_action( 'blitch_topbar' ) ?>

		<a class="assistive-text" href="#page-content" title="<?php esc_attr_e( 'Skip to content', 'blitch' ) ?>"><?php _e( 'Skip to content', 'blitch' ) ?></a>

		<header id="site-header">
			<div class="container">
				<div class="search-and-nav">
					<?php \planetjon\blitch\templates\showNavigation( 'primary' ) ?>
					<?php \planetjon\blitch\templates\showSearch() ?>
				</div>

				<div class="site-banner">
					<div class="container">
						<?php has_custom_logo() && the_custom_logo() ?>
						<h1 class="site-banner-title">
							<a href="<?php echo esc_url( home_url() ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" rel="home">
								<span class="site-banner-title-text"><?php bloginfo( 'name' ) ?></span>
							</a>
						</h1>
						<h2 class="site-banner-subtitle"><span class="site-banner-subtitle-text"><?php bloginfo( 'description' ) ?></span></h2>
					</div>
				</div>

				<?php do_action( 'blitch_site_header' ) ?>
			</div>
		</header>

		<main id="page-content">
			<div class="container">
			<?php do_action( 'blitch_before_content' ) ?>
