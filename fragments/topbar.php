<?php if( is_active_sidebar( 'site-topbar-widget-container' ) ) : ?>
<aside id="site-topbar">
	<div class="site-topbar-widget-container widget-container container">
		<?php dynamic_sidebar( 'site-topbar-widget-container' ) ?>
	</div>
</aside>
<?php endif ?>
