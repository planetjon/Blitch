<div class="search-and-nav">
	<?php \planetjon\blitch\templates\showNavigation( 'primary' ) ?>
	<?php \planetjon\blitch\templates\showSearch() ?>
</div>

<div class="site-banner">
	<div class="container">
		<?php has_custom_logo() && the_custom_logo() ?>
		<h1 class="site-banner-title">
			<a class="site-banner-title-text" href="<?php echo esc_url( home_url() ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" rel="home">
				<?php bloginfo( 'name' ) ?>
			</a>
		</h1>
		<div class="site-banner-subtitle"><span class="site-banner-subtitle-text"><?php bloginfo( 'description' ) ?></span></div>
	</div>
</div>
