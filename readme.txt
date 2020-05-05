=== Blogfolio ===
Contributors: jweathe
Donate link: http://portfolio.planetjon.ca
Tags: lightweight, html5, css3, responsive, dark, blue, white, post-tiles, two-columns, right-sidebar, flexible-width, custom-background, custom-header, custom-menu, featured-images, flexible-header, sticky-post, theme-options, post-formats, translation-ready
Requires at least: 3.1.0
Tested up to: 3.5.1
Stable tag: 1.6.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A lightweight HTML5 theme geared towards portfolio-based blogging, with responsive design for mobile to large displays.

== Description ==

Blogfolio is a lightweight HTML5 theme geared towards portfolio-based blogging, with responsive design for mobile to large displays.
Features include a homepage template with tiled blog posts, and 5 widget areas.
Make it yours with a custom menu, header image, and background. Extend it through the numerous action hooks and custom template fragment system.

== Installation ==

1. Unpack the theme zip and upload the contents to the /wp-content/themes/ directory. Alternatively, upload the plugin zip via the install screen within the WordPress Themes manager
2. Activate the theme through the Themes manager in WordPress
3. Configure as desired through Theme Options pages.

== Frequently Asked Questions ==

= I don't like the new large featured post box. Can I disable this? =

Sure. If it's not your cup of tea, you can disable this with an option *Feature most recent post?* in the Blogfolio settings.

= I want my pages to automatically appear in the navigation menu. How? =

Create an empty menu in the menu administrative page and tick the option "Automatically add new top-level pages." Use this menu as your navigation menu.

== Changelog ==

= 1.6.4 =
Fixed and tidied the update detection mechanism. No new shinies for the actual theme sorry :(

= 1.6.3 =
New option of having the most recent post featured as a fullscreen tile
New post tile background
New full-width content template. Full-width can be selected manually or a page template, and activates automatically when content sidebar is empty.
New taxonomy archive
Added theme update detection

= 1.5.4 =
Fixed bug in fragment loader.
Fixed wide captions with no alignment overflowing.

= 1.5.3 =
Fixed the navigation menu to support arbitrary levels of nesting.

= 1.5.2 =
Fixed the caption borders overflowing issue by adding a 2px pad to the .main-content area.
Improved option sanitization.

= 1.5.1 =
Added a template for date archives.
Added new options to the admin page for controlling site title colour.
Improved code comments where needed.

= 1.4.5 =
Minor compliance tweaks to templates and css.
Changed role required for accessing the theme settings page to 'edit_theme_options'.
Fixed admin option validation.

= 1.4.3 =
Added author template and attachment template.
Introduced & tweaked styling. Refactored some template code and moved general HTML format elements to separate css file.
Added custom renderer & styles to wp_link__pages() to be consistent with paginate_links().
Fixed text domain loading.

= 1.3.2 =
Homepage tiles now display post preview on hover.
Introduced Post Format support.
Homepage tiles post preview shows customized thematic icons on post formats.

= 1.2.2 =
Begrudgingly moved lambda-styled hook functions to the Blogfolio class to allow compatibility with PHP 5.2.
Introduced some configurable theme options.

= 1.1.3 =
Flipped typography. Headers and links are now sans-serif and body text is now serif. Adjusted body text to be a bit bigger.

= 1.1.2 =
Added: a new widget area below the site header appropriate for social media icons.
Tweaked template code and CSS for better consistency and improved visual experience.

= 1.0.3 =
First stable version.
