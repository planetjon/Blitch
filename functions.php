<?php

namespace planetjon\blitch;

const blitch = 'blitch';

require 'templates.php';

// run theme setup after theme is loaded.
add_action( 'after_setup_theme', __NAMESPACE__ . '\after_setup_theme' );

// Run widgets initializations.
add_action( 'widgets_init', __NAMESPACE__ . '\widgets_init' );

// Load scripts and styles
add_action( 'wp_head', __NAMESPACE__ . '\wp_head' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\wp_enqueue_scripts' );
add_action( 'comment_form_before', __NAMESPACE__ . '\comment_form_before' );

// To be hooked into after_setup_theme
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

// To be hooked into widget_init
function widgets_init() {
	// Content Sidebar.
	register_sidebar( [
		'name' => __( 'Content Sidebar', 'blitch' ),
		'id' => 'content-sidebar',
		'description' => __( 'For placing widgets alongside content', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Site Header widget area.
	register_sidebar( [
		'name' => __( 'Site Top Widget Area', 'blitch' ),
		'id' => 'site-topbar-widget-container',
		'description' => __( 'For placing widgets at the top of the site', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="site-topbar-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Site Header widget area.
	register_sidebar( [
		'name' => __( 'Site Header Widget Area', 'blitch' ),
		'id' => 'site-header-widget-container',
		'description' => __( 'For placing widgets immediately after the site header', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="site-header-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Pre content Widget area.
	register_sidebar( [
		'name' => __( 'Before Content Widget Area', 'blitch' ),
		'id' => 'before-content-widget-container',
		'description' => __( 'For placing widgets before the content', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="before-content-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );

	// Post content Widget area.
	register_sidebar( [
		'name' => __( 'After Content Widget Area', 'blitch' ),
		'id' => 'after-content-widget-container',
		'description' => __( 'For placing widgets after the content', 'blitch' ),
		'before_widget' => '<div id="%1$s" class="after-content-widget widget-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title title"><span class="text">',
		'after_title' => '</span></h3>'
	] );
}

// To be hooked into wp_enqueue_scripts
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

function comment_form_before() {
	if( !get_option( 'thread_comments' ) ) {
		return;
	}

	wp_enqueue_script( 'comment-reply' );
}

// inject header meta
function wp_head() {
	printf( '<meta charset="%s"/>', get_bloginfo( 'charset' ) );
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
}
