<?php if( is_active_sidebar( 'site-sidebar-widget-container' ) ) : ?>
<aside id="site-sidebar">
	<div class="site-sidebar-widget-container widget-container container">
		<?php dynamic_sidebar( 'site-sidebar-widget-container' ) ?>
	</div>
</aside>
<?php endif ?>
