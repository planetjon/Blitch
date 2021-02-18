<?php

namespace planetjon\blitch;

const blitch = 'blitch';

require 'templates.php';

// Configure theme support
function after_setup_theme() {
	// i18n support.
	load_theme_textdomain( blitch, get_template_directory() . '/assets/languages' );

	// HTML5 support
	add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );

	// Title tag
	add_theme_support( 'title-tag' );

	// Automatic feed links support
	add_theme_support( 'automatic-feed-links' );

	// Custom logo support
	add_theme_support( 'custom-logo',[
		'width' => 718,
		'height' => 80,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => array( 'site-banner-title-text' ),
	] );

	// Post thumbnails support
	add_theme_support( 'post-thumbnails' );

	// Custom menu support
	register_nav_menu( 'primary', __( 'Primary Navigation', 'blitch' ) );
}

// Initialize widget zones
function widgets_init() {
	// Site Sidebar
	register_sidebar( [
		'name' => __( 'Site Sidebar', 'blitch' ),
		'id' => 'site-sidebar-widget-container',
		'description' => __( 'For placing widgets alongside the site', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="site-sidebar-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Site Topbar
	register_sidebar( [
		'name' => __( 'Site Topbar', 'blitch' ),
		'id' => 'site-topbar-widget-container',
		'description' => __( 'For placing widgets at the top of the site', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="site-topbar-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Site Header
	register_sidebar( [
		'name' => __( 'Site Header', 'blitch' ),
		'id' => 'site-header-widget-container',
		'description' => __( 'For placing widgets immediately after the site header', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="site-header-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Pre content
	register_sidebar( [
		'name' => __( 'Before Content', 'blitch' ),
		'id' => 'before-content-widget-container',
		'description' => __( 'For placing widgets before the content', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="before-content-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Post content
	register_sidebar( [
		'name' => __( 'After Content', 'blitch' ),
		'id' => 'after-content-widget-container',
		'description' => __( 'For placing widgets after the content', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="after-content-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Homepage content
	register_sidebar( [
		'name' => __( 'Homepage Sidebar', 'blitch' ),
		'id' => 'home-page-widget-container',
		'description' => __( 'For placing widgets on the homepage', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="home-page-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );
}

// Queue scripts and styles
function wp_enqueue_scripts() {
	wp_register_style( 'blitch-normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
	wp_register_style( 'blitch-html', get_template_directory_uri() . '/assets/css/html-styles.css' );
	wp_register_style( 'blitch-styles', get_template_directory_uri() . '/style.css', [ 'blitch-normalize', 'blitch-html' ] );
	wp_register_style( 'blitch-responsive', get_template_directory_uri() . '/assets/css/responsive.css', [ 'blitch-styles' ] );
	wp_register_style( 'blitch-wordpress', get_template_directory_uri() . '/assets/css/wordpress-styles.css', [ 'blitch-styles' ] );
	wp_register_style( 'blitch-wordpress-comments', get_template_directory_uri() . '/assets/css/wordpress-comments.css', [ 'blitch-wordpress' ] );

	wp_enqueue_style( 'blitch-styles' );
	wp_enqueue_style( 'blitch-wordpress' );
	if( is_singular() ) {
		wp_enqueue_style( 'blitch-wordpress-comments' );		
	}
	wp_enqueue_style( 'blitch-responsive' );
}

// Queue core comment styling
function comment_form_before() {
	if( !get_option( 'thread_comments' ) ) {
		return;
	}

	wp_enqueue_script( 'comment-reply' );
}

// Inject header meta
function wp_head() {
	printf( '<meta charset="%s"/>', get_bloginfo( 'charset' ) );
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
}

// When The Loop is empty
function blitch_no_results() {
	printf( '<p>%s</p>', __( 'Hmmm, there\'s nothing here.', 'blitch' ) );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\after_setup_theme' );
add_action( 'widgets_init', __NAMESPACE__ . '\widgets_init' );
add_action( 'wp_head', __NAMESPACE__ . '\wp_head' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\wp_enqueue_scripts' );
add_action( 'comment_form_before', __NAMESPACE__ . '\comment_form_before' );
add_action( 'blitch_no_results', __NAMESPACE__ . '\blitch_no_results' );
