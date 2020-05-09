<?php if( has_nav_menu( $themeposition ) ) : ?>
<nav class="<?php echo $themeposition ?>">
	<?php wp_nav_menu( array( 'theme_location' => $themeposition, 'container_class' => 'menu-container' ) ) ?>
</nav>
<?php endif ?>