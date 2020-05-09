<?php

/**
 * Defines template fragment loader, an enhanced version of get_template_part().
 * Implements behaviour for displaying major sections of site, heavily leveraging template fragments.
 * Also Provides some utility functionality for showing core components of the site.
 *
 */

namespace planetjon\blitch\templates;

const fragments = 'fragments/';

// Hook into Blitch template hooks.
add_action( 'blitch_topbar', __NAMESPACE__ . '\showTopbar' );
add_action( 'blitch_site_header', __NAMESPACE__ . '\showSiteHeader' );
add_action( 'blitch_site_footer', __NAMESPACE__ . '\showSiteFooter' );
add_action( 'blitch_before_content', __NAMESPACE__ . '\showBeforeContent' );
add_action( 'blitch_after_content', __NAMESPACE__ . '\showAfterContent' );
add_action( 'blitch_post_feature', __NAMESPACE__ . '\showPostFeature' );
add_action( 'blitch_loop_post', __NAMESPACE__ . '\showLoopPost' );
add_action( 'blitch_loop_header', __NAMESPACE__ . '\showLoopHeader' );
add_action( 'blitch_page_header', __NAMESPACE__ . '\showPageHeader' );
add_action( 'blitch_page_footer', __NAMESPACE__ . '\showPageFooter' );
add_action( 'blitch_single_header', __NAMESPACE__ . '\showSingleHeader' );
add_action( 'blitch_single_footer', __NAMESPACE__ . '\showSingleFooter' );
add_action( 'blitch_attachment_header', __NAMESPACE__ . '\showAttachmentHeader' );
add_action( 'blitch_attachment_footer', __NAMESPACE__ . '\showAttachmentFooter' );

/*
	Template Fragment loader, based loosely on get_template_part(). Looks in the child theme first and then the parent theme.
	The reasoning behind this over get_template_part() is to be able to pass variables to the fragments.
*/
function loadFragment( $slug, $name = null, array $args = [] ) {
	$fragments = [];

	if( isset( $name ) ) {
		$fragments []= fragments . "{$slug}-{$name}.php";
	}

	$fragments []= fragments . "{$slug}.php";
	if( $template = locate_template( $fragments ) ) {
		_loadFragment( $template, $args );
	}

	return $template;
}

// Does the actual loading once a template is found.
function _loadFragment( $_template, array $_args = [] ) {
	extract( $_args );
	include( $_template );
}

// Utility method for rendering a navigation menu.
function showNavigation( $themeposition ) {
	loadFragment( 'navigation', $themeposition, compact( 'themeposition' ) );
}

// Utility method for rendering the search bar.
function showSearch() {
	get_search_form();
}

// Utility method for rendering a widget area.
function showWidgetContainer( $widgetcontainer ) {
	loadFragment( 'sidebar', $widgetcontainer, compact( 'widgetcontainer' ) );
}

// Utility method for rendering a pagination navigation menu.
function showPagination( $location ) {
	loadFragment( 'pagination', $location );
}

//	Following are implementations that have been hooked into the blitch template hooks.

function showTopbar() {
	if( has_nav_menu( 'primary' ) )
	loadFragment( 'topbar' );
}

function showSiteHeader() {
	showWidgetContainer( 'siteheader' );
}

function showSiteFooter() {
	loadFragment( 'sitefooter' );
}

function showBeforeContent() {
	showWidgetContainer( 'beforecontent' );
}

function showAfterContent() {
	if( is_single() ) {
		showWidgetContainer( null );
	}

	showWidgetContainer( 'aftercontent' );

	if( is_single() ) {
		loadFragment( 'comments' );
	}
}

function showPostFeature() {
	loadFragment( 'postfeature' );
}

function showLoopPost() {
	loadFragment( 'postpreview', 'loop' );
}

function showLoopHeader() {
	loadFragment( 'posttitle', 'loop' );
	loadFragment( 'postmeta', 'classification' );
}

function showPageHeader() {
	loadFragment( 'posttitle', 'page' );
}

function showPageFooter() {}

function showSingleHeader() {
	loadFragment( 'posttitle', 'single' );
	loadFragment( 'postmeta', 'publication' );
}

function showSingleFooter() {
	loadFragment( 'postmeta', 'classification' );
}

function showAttachmentHeader() {
	loadFragment( 'posttitle', 'attachment' );
	loadFragment( 'postmeta', 'authorship' );

	if( has_excerpt() ) {
		printf( '<div class="excerpt">%s</div>', get_the_excerpt() );
	}
}

function showAttachmentFooter() {
	global $post;
	$link = get_permalink( $post->post_parent );
	$linktext = sprintf( __( 'Return to %s', 'blitch' ), get_the_title( $post->post_parent ) );

	printf( '<div class="post-meta"><a class="parent-link" href="%s">%s</a></div>', $link, $linktext );
}

class DummySeparator {
	function __toString() {
		return '&#8203;';
	}
}