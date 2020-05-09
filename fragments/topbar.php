<aside id="top-bar">
	<div class="container">
	<?php if( is_active_sidebar( 'site-topbar-widget-container' ) ) : ?>
		<section class="site-topbar-widget-container widget-container container">
			<?php dynamic_sidebar( 'site-topbar-widget-container' ) ?>
		</section>
	<?php endif ?>
	</div>
</aside>
