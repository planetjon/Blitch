<?php

define( 'blogfolio', true );

// Load administrative panel functionality.
if( is_admin() && !wp_doing_ajax() ) {
	include( get_template_directory() . '/admin-functions.php' );
}

// Set WordPress content width magic global.
if( !isset( $content_width ) ) {
	$content_width = 600;
}

// Installation hooks
register_activation_hook( __FILE__, [ 'Blogfolio', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'Blogfolio', 'deactivate' ] );
register_uninstall_hook( __FILE__, [ 'Blogfolio', 'uninstall' ] );

// run theme setup after theme is loaded.
add_action( 'after_setup_theme', [ 'Blogfolio', 'after_setup_theme' ] );

// Run initializations.
add_action( 'init', [ 'Blogfolio', 'init' ] );

// Run widgets initializations.
add_action( 'widgets_init', [ 'Blogfolio', 'widgets_init' ] );

// Run delayed initializations relying on WP environment
add_action( 'wp', [ 'Blogfolio', 'wp' ] );

// Load scripts and styles
add_action( 'wp_enqueue_scripts', [ 'Blogfolio', 'wp_enqueue_scripts' ] );
add_action( 'comment_form_before', [ 'Blogfolio', 'comment_form_before' ] );

add_filter( 'body_class', [ 'Blogfolio', 'body_class' ] );

/**
 * Provides functions that must be hooked into WordPress hooks.
 *
 */
class Blogfolio {
	const options = 'Blogfolio';
	const version = 1.8;

	private static $config = null;
	private static $template = null;

	private static $isFullWidth = false;

	static function isFullWidth() {
		return self::$isFullWidth;
	}

	// Get the template instance. Use this if you need to unregister any of the hooked functions.
	static function template() {
		if( !self::$template ) {
			self::$template = new BlogfolioTemplate;
		}

		return self::$template;
	}

	// Run when Blogfolio is activated.
	static function activate() {}

	// Run when Blogfolio is deactivated.
	static function deactivate() {}

	// Run when BLogfolio is uninstalled.
	static function uninstall() {
		delete_option( self::options );
	}

	// Registry for accessing theme settings.
	static function config( $key = null ) {
		if( null === self::$config ) {
			return null;
		}

		if( $key !== null ) {
			return isset( self::$config[ $key ] ) ? self::$config[ $key ] : null;
		}
		else {
			return (array) self::$config;
		}
	}

	// To be hooked into after_setup_theme
	static function after_setup_theme() {
		$defaults = [
			'version' => self::version,
			'search-in-menubar' => 1,
			'feature-newest-post' => 1,
			'credit-in-footer' => 1,
			'site-title-colour' => 'white',
			'site-subtitle-colour' => 'white',
			'post-tile-background-colour' => '#ddd',
			'post-tile-font-colour' => '#444'
		];

		self::$config = get_option( self::options, $defaults );

		// i18n support.
		load_theme_textdomain( self::options, get_template_directory() . '/resources/languages' );

		// HTML5 support
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );

		// Title tag
		add_theme_support( 'title-tag' );

		// Custom logo support
		add_theme_support( 'custom-logo',[
			'width' => 718,
			'height' => 80,
			'flex-height' => true,
			'flex-width' => true,
			'header-text' => array( 'site-banner-title-text' ),
		] );

		// Custom background support
		add_theme_support( 'custom-background', [
			'default-color' => '1e73be',
		] );

		// Automatic feed links support
		add_theme_support( 'automatic-feed-links' );

		// Post formats support
		add_theme_support( 'post-formats', [ 'audio', 'video', 'image', 'gallery', 'link', 'chat', 'quote', 'status', 'aside' ] );

		// Post thumbnails support
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 272, 204, true );
		add_image_size( 'feature-thumbnail', 552, 416, true );

		// Custom menu support
		register_nav_menu( 'primary', __( 'Primary Navigation', 'blogfolio' ) );

		// Hook into Blogfolio template hooks.
		add_action( 'blogfolio_topbar', [ self::template(), 'topbar' ] );
		add_action( 'blogfolio_site_header', [ self::template(), 'siteHeader' ] );
		add_action( 'blogfolio_before_content', [ self::template(), 'beforeContent' ] );
		add_action( 'blogfolio_post_feature', [ self::template(), 'postFeature' ] );
		add_action( 'blogfolio_loop_header', [ self::template(), 'loopHeader' ] );
		add_action( 'blogfolio_page_header', [ self::template(), 'pageHeader' ] );
		add_action( 'blogfolio_page_footer', [ self::template(), 'pageFooter' ] );
		add_action( 'blogfolio_single_header', [ self::template(), 'singleHeader' ] );
		add_action( 'blogfolio_single_footer', [ self::template(), 'singleFooter' ] );
		add_action( 'blogfolio_attachment_header', [ self::template(), 'attachmentHeader' ] );
		add_action( 'blogfolio_attachment_footer', [ self::template(), 'attachmentFooter' ] );
		add_action( 'blogfolio_after_content', [ self::template(), 'afterContent' ] );
		add_action( 'blogfolio_site_footer', [ self::template(), 'siteFooter' ] );
	}

	// To be hooked into init
	static function init() {
		add_filter( 'wp_link_pages_args', ['BlogfolioTemplate', 'wpLinkPagesArgs' ] );
	}

	// To be hooked into widget_init
	static function widgets_init() {
		// Content Sidebar.
		register_sidebar( [
			'name' => __( 'Content Sidebar', 'blogfolio' ),
			'id' => 'content-sidebar',
			'description' => __( 'For placing widgets alongside content', 'blogfolio' ),
			'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title title"><span class="text">',
			'after_title' => '</span></h3>'
		] );

		// Site Header widget area.
		register_sidebar( [
			'name' => __( 'Site Header Widget Area', 'blogfolio' ),
			'id' => 'site-header-widget-container',
			'description' => __( 'For placing widgets immediately after the site header', 'blogfolio' ),
			'before_widget' => '<div id="%1$s" class="site-header-widget widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title title"><span class="text">',
			'after_title' => '</span></h3>'
		] );

		// Homepage widget area.
		register_sidebar( [
			'name' => __( 'Home Page Widget Area', 'blogfolio' ),
			'id' => 'home-page-widget-container',
			'description' => __( 'For placing widgets on the home page', 'Blogfolio' ),
			'before_widget' => '<div id="%1$s" class="home-widget widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title title"><span class="text">',
			'after_title' => '</span></h2>'
		] );

		// Pre content Widget area.
		register_sidebar( [
			'name' => __( 'Before Content Widget Area', 'blogfolio' ),
			'id' => 'before-content-widget-container',
			'description' => __( 'For placing widgets before the content', 'blogfolio' ),
			'before_widget' => '<div id="%1$s" class="before-content-widget widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title title"><span class="text">',
			'after_title' => '</span></h3>'
		] );

		// Post content Widget area.
		register_sidebar( [
			'name' => __( 'After Content Widget Area', 'blogfolio' ),
			'id' => 'after-content-widget-container',
			'description' => __( 'For placing widgets after the content', 'blogfolio' ),
			'before_widget' => '<div id="%1$s" class="after-content-widget widget-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title title"><span class="text">',
			'after_title' => '</span></h3>'
		] );
	}

	// To be hooked into wp for initializations that depend on the query.
	static function wp() {
		if( !is_active_sidebar( 'content-sidebar' ) || is_page_template( 'fullwidthpage.php' ) ) {
			self::$isFullWidth = true;
		}
	}

	// To be hooked into wp_enqueue_scripts
	static function wp_enqueue_scripts() {
		wp_register_style( 'blogfolio-normalize', get_template_directory_uri() . '/resources/css/normalize.css' );
		wp_register_style( 'blogfolio-html', get_template_directory_uri() . '/resources/css/html-styles.css' );
		wp_register_style( 'blogfolio-wordpress', get_template_directory_uri() . '/resources/css/wordpress-styles.css' );
		wp_register_style( 'blogfolio-wordpress-comments', get_template_directory_uri() . '/resources/css/wordpress-comments.css' );
		wp_register_style( 'blogfolio-styles', get_template_directory_uri() . '/style.css', [ 'blogfolio-normalize', 'blogfolio-html', 'blogfolio-wordpress', 'blogfolio-wordpress-comments' ] );
		wp_register_style( 'blogfolio-responsive', get_stylesheet_directory_uri() . '/resources/css/responsive.css', [ 'blogfolio-styles' ] );

		wp_enqueue_style( 'blogfolio-styles' );
		wp_enqueue_style( 'blogfolio-responsive' );

		wp_add_inline_style( 'blogfolio-styles', self::_themeSettingStyles() );
	}

	static function comment_form_before() {
		if( !get_option( 'thread_comments' ) ) {
			return;
		}

		wp_enqueue_script( 'comment-reply' );
	}

	// add category nicenames in body and post class
	static function body_class( $classes ) {
		if( self::isFullWidth() ) {
			$classes []= 'full-width-content';
		}

		return $classes;
	}

	// Creates css style rules from theme styling options.
	private static function _themeSettingStyles() {
		$styles = [];

		if( $sitetitlecolour = esc_html( self::config( 'site-title-colour' ) ) ) {
			$styles []= "#site-header .site-banner-title-text { color: {$sitetitlecolour}; }";
		}

		if( $sitesubtitlecolour = esc_html( self::config( 'site-subtitle-colour' ) ) ) {
			$styles []= "#site-header .site-banner-subtitle-text { color: {$sitesubtitlecolour}; }";
		}

		if( $posttilebackgroundcolour = esc_html( self::config( 'post-tile-background-colour' ) ) ) {
			$styles []= ".post-tile .post-preview {background-color: {$posttilebackgroundcolour}; }";
		}

		if( $posttilefontcolour = esc_html( self::config( 'post-tile-font-colour' ) ) ) {
			$styles []= ".post-tile .post-preview {color: {$posttilefontcolour}; }";
		}

		return implode( PHP_EOL, $styles );
	}
}

/**
 * Defines template fragment loader, an enhanced version of get_template_part().
 * Implements behaviour for displaying major sections of site, heavily leveraging template fragments.
 * Also Provides some utility functionality for showing core components of the site.
 *
 */
class BlogfolioTemplate {
	const fragments = 'fragments/';

	// Utility method for rendering a navigation menu.
	static function showNavigation( $themeposition ) {
		self::loadFragment( 'navigation', $themeposition, compact( 'themeposition' ) );
	}

	// Utility method for rendering the search bar.
	static function showSearch() {
		if( Blogfolio::config( 'search-in-menubar' ) ) {
			get_search_form();
		}
	}

	// Utility method for rendering a widget area.
	static function showWidgetContainer( $widgetcontainer ) {
		self::loadFragment( 'sidebar', $widgetcontainer, compact( 'widgetcontainer' ) );
	}

	// Renders a theme preview, customized based on the post format.
	static function showPostPreview( $context = false ) {
		$postformat = get_post_format() or $postformat = 'standard';
		self::loadFragment( 'postpreview', false, compact( 'postformat' ) );
	}

	// Utility method for rendering a pagination navigation menu.
	static function paginate( $location ) {
		self::loadFragment( 'pagination', $location);
	}

	// For inserting a new render type 'next_and_number' in wp_link_pages(). Makes output consistent with paginate_links()
	static function wpLinkPagesArgs( $args ) {
		global $page, $numpages, $more, $pagenow;

		if ( !$more || $args[ 'next_or_number' ] != 'next_and_number' ) {
			return $args;
		}

		$args[ 'next_or_number' ] = 'number';

		if( $page - 1 ) {
			$args[ 'before' ] =
				$args[ 'before' ]
				. _wp_link_page( $page - 1 )
				. $args[ 'link_before' ]
				. $args[ 'previouspagelink' ]
				. $args[ 'link_after' ]
				. '</a>';
		}

		if( $page < $numpages ) {
			$args[ 'after' ] =
				' '
				. _wp_link_page( $page + 1 )
				. $args[ 'link_before' ]
				. $args[ 'nextpagelink' ]
				. $args['link_after']
				. '</a>'
				.$args[ 'after' ];
		}

		return $args;
	}

	/*
		Template Fragment loader, based loosely on get_template_part(). Looks in the child theme first and then the parent theme.
		The reasoning behind this over get_template_part() is to be able to pass variables to the fragments.
	*/
	static function loadFragment( $slug, $name = null, array $args = [] ) {
		$fragments = [];

		if( isset( $name ) ) {
			$fragments[] = self::fragments . "{$slug}-{$name}.php";
		}

		$fragments []= self::fragments . "{$slug}.php";

		if( $template = locate_template( $fragments ) ) {
			self::_loadFragment( $template, $args );
		}

		return $template;
	}

	// Does the actual loading once a template is found.
	private static function _loadFragment( $template, array $args = [] ) {
		extract( $args );
		include( $template );
	}

	/*	Following are implementations that have been hooked into the Blogfolio template hooks.
	*/

	function topbar() {
		if( Blogfolio::config( 'search-in-menubar' ) || has_nav_menu( 'primary' ) )
		self::loadFragment( 'topbar' );
	}

	function siteHeader() {
		self::showWidgetContainer( 'siteheader' );
	}

	function beforeContent() {
		self::showWidgetContainer( 'beforecontent' );
	}

	function postFeature() {
		if( is_archive() || is_search() ) {
			self::loadFragment( 'thumbnail', 'loop' );
		}
		else {
			self::loadFragment( 'thumbnail' );
		}
	}

	function loopHeader() {
		self::loadFragment( 'header', 'loop' );
		self::loadFragment( 'postmeta', 'publication' );
	}

	function pageHeader() {
		self::loadFragment( 'header', 'page' );
	}

	function pageFooter() {}

	function singleHeader() {
		self::loadFragment( 'header', 'single' );
		self::loadFragment( 'postmeta', 'publication' );
	}

	function singleFooter() {
		self::loadFragment( 'postmeta', 'classification' );
	}

	function attachmentHeader() {
		self::loadFragment( 'header', 'attachment' );
		self::loadFragment( 'postmeta', 'authorship' );

		if( has_excerpt() ) {
			printf( '<div class="excerpt">%s</div>', get_the_excerpt() );
		}
	}

	function attachmentFooter() {
		global $post;
		$link = get_permalink( $post->post_parent );
		$linktext = sprintf( __( 'Return to %s', 'blogfolio' ), get_the_title( $post->post_parent ) );

		printf( '<div class="post-meta"><a class="parent-link" href="%s">%s</a></div>', $link, $linktext );
	}

	function afterContent() {
		self::showWidgetContainer( null );

		self::showWidgetContainer( 'aftercontent' );

		if( is_single() ) {
			self::loadFragment( 'comments' );
		}
	}

	function siteFooter() {
		self::loadFragment( 'sitefooter' );
	}
}
