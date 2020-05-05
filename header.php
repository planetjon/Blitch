<!DOCTYPE html>
<html <?php language_attributes() ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ) ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?>>

		<div class="page-container container">

		<header id="site-header">
			<div class="container">
				<a class="assistive-text" href="#page-content" title="<?php esc_attr_e( 'Skip to content', 'blogfolio' ) ?>"><?php _e( 'Skip to content', 'blogfolio' ) ?></a>

				<?php do_action( 'blogfolio_topbar' ) ?>

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

				<?php do_action( 'blogfolio_site_header' ) ?>
			</div>
		</header>

		<main id="page-content">
			<div class="container">
			<?php do_action( 'blogfolio_before_content' ) ?>
