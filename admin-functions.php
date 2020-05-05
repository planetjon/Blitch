<?php

// Register admin functionality.
add_action( 'admin_menu', array( 'BlogfolioAdmin', 'admin_menu' ) );
add_action( 'admin_init', array( 'BlogfolioAdmin', 'admin_init' ) );

/**
 * Sets up custom options administrative panel and menu.
 *
 */
class BlogfolioAdmin {
	const settings_page = 'blogfolio-theme-settings';
	private static $registeredfields = array();

	// To be hooked into admin_init
	static function admin_init() {
		register_setting( Blogfolio::options, Blogfolio::options, array( __CLASS__, 'validateFields' ) );
		self::addSection( 'general-settings-section', __( 'General Settings', 'blogfolio' ) );

		// Add theme options here
		self::addField( 'checkbox', 'search-in-menubar', __( 'Include SearchBox in menubar?', 'blogfolio' ) );
		self::addField( 'checkbox', 'feature-newest-post', __( 'Feature most recent post?', 'blogfolio' ) );
		self::addField( 'checkbox', 'credit-in-footer', __( 'Include developer credit in footer?', 'blogfolio' ) );
		self::addField( 'colorpicker', 'site-title-colour', __( 'Site title colour', 'blogfolio' ), '' );
		self::addField( 'colorpicker', 'site-subtitle-colour', __( 'Site subtitle colour', 'blogfolio' ), '' );
		self::addField( 'colorpicker', 'post-tile-background-colour', __( 'Post tile background colour', 'blogfolio' ), '' );
		self::addField( 'colorpicker', 'post-tile-font-colour', __( 'Post tile font colour', 'blogfolio' ), '' );

		add_editor_style( 'editor-style.css' );
	}

	// To be hooked into wp_enqueue_scripts or another appropriate hook suitable for enqueuing scripts.
	static function admin_print_scripts( $context ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'blogfolio-admin-scripts', get_template_directory_uri() . '/resources/js/admin-scripts.js' , array( 'wp-color-picker' ) );
	}

	// To be hooked into admin_menu.
	static function admin_menu() {
		$pagehook = add_theme_page(
			__('Blogfolio theme settings', 'blogfolio'),
			__('Blogfolio Settings', 'blogfolio'),
			'edit_theme_options',
			self::settings_page,
			array( __CLASS__, 'showThemeSettings' )
		);

		// Only load admin scripts when on Blogfolio admin page.
		add_action( 'admin_print_scripts-' . $pagehook, array( __CLASS__, 'admin_print_scripts' ) );
	}

	// Use this for adding sections to the admin page.
	static function addSection( $id, $title ) {
		add_settings_section($id, $title, array( __CLASS__, 'sectionHeader'), self::settings_page );
	}

	// Use this for adding theme options to the admin page. See code below for available types (renderers).
	static function addField( $type, $id, $title, $value = 1, $label = null, $args = array(), $section = 'general-settings-section' ) {
		self::_addFieldFilter( $type, $id, $title, $value );
		add_settings_field( $id, $title, array(__CLASS__, $type . 'Renderer'), self::settings_page, $section, compact( 'type', 'id', 'value', 'label', 'args', 'section' ) );
	}

	// Callback for loading the admin view.
	static function showThemeSettings() {
		BlogfolioTemplate::loadFragment( 'admin/settings' );
	}

	// Callback for displaying a section header.
	static function sectionHeader( $args ) {
		BlogfolioTemplate::loadFragment( 'admin/sectionheader', $args['id'] );
	}

	// Renders a colourpicker field. Gracefully falls back to regular input box when not supported.
	static function colorpickerRenderer( $args ) {
		$id = Blogfolio::options . '_' . $args[ 'id' ];
		$name = Blogfolio::options . "[{$args[ 'id' ]}]";
		$default = $args[ 'value' ];
		$value = esc_attr( Blogfolio::config( $args[ 'id' ] ) ) or $value = $default;
		$label = $args[ 'label' ] or $label = '';

		self::_fieldRenderer( 'colorpicker', compact( 'id', 'name', 'value', 'default', 'label' ) );
	}

	// Renders a checkbox. If multiple values are provided, an option group will be rendered.
	static function checkboxRenderer( $args ) {
		$multivalue = is_array( $args[ 'value' ] );
		$settings = (array) Blogfolio::config( $args[ 'id' ] );

		$id = Blogfolio::options . '_' . $args[ 'id' ];
		$name = Blogfolio::options . "[{$args[ 'id' ]}]" . ( $multivalue ? '[]' : '' );
		$values = (array) $args[ 'value' ];
		array_walk( $values, 'esc_attr' );
		$labels = (array) $args[ 'label' ];
		$checked = array();

		foreach( $values as $index => $value )
			$checked[$index] = checked( in_array( $value, $settings ), true, false );

		self::_fieldRenderer( 'checkbox', compact( 'id', 'name', 'values', 'checked', 'labels' ) );
	}

	// Renders a radiobox. More than one value should be provided as an option group.
	static function radiobuttonRenderer( $args ) {
		$setting = Blogfolio::config( $args[ 'id' ] );

		$id = Blogfolio::options . '_' . $args[ 'id' ];
		$name = Blogfolio::options . "[{$args[ 'id' ]}]";
		$values = (array) $args[ 'value' ];
		array_walk( $values, 'esc_attr' );
		$checked = array();
		$labels = (array) $args[ 'label' ];

		foreach( $values as $index => $value )
			$checked[$index] = checked( $value, $setting, false );

		self::_fieldRenderer( 'radiobutton', compact( 'id', 'name', 'values', 'checked', 'labels' ) );
	}

	// Validates raw input from option submission.
	static function validateFields( $fields ) {
		$validated = array();

		foreach( $fields as $field => $value ) {
			$sanction = isset( self::$registeredfields[ $field ] ) ? self::$registeredfields[ $field ] : false;

			if( ! $sanction )
				continue;

			$valid = true;
			switch( $sanction[ 'type' ] ) {
				case 'colorpicker' :
					$value = sanitize_text_field( $value );
					if( '' != $value && ! preg_match( '/^#([[:xdigit:]]{3}|[[:xdigit:]]{6})$/' , $value ) ) {
						$valid = false;
						add_settings_error( Blogfolio::options, 'invalid-value', "'{$sanction[ 'title' ]}' <strong>Not a hex value</strong>" );
					}
					break;
				case 'checkbox' :
				case 'radiobox' :
				default :
					if( is_scalar( $sanction[ 'value' ] ) && $value != $sanction[ 'value' ] ) {
						$valid = false;
						add_settings_error( Blogfolio::options, 'invalid-value', "'{$sanction[ 'title' ]}' <strong>Invalid input</strong>" );
					}
					elseif( is_array( $sanction[ 'value' ] ) && array_diff( (array) $value, $sanction[ 'value' ] ) ) {
						$valid = false;
						add_settings_error( Blogfolio::options, 'invalid-value', "'{$sanction[ 'title' ]}' <strong>Invalid input</strong>" );
					}
			}

			if( $valid ) $validated[ $field ] = $value;
		}

		return apply_filters( 'blogfolio_validate_fields', $validated, $fields );
	}

	// Adds theme option to sanctioned list. Should be called when a field is added.
	private static function _addFieldFilter( $type, $id, $title, $value ) {
		self::$registeredfields[ $id ] = compact( 'type', 'title', 'value' );
	}

	// Delegates UI rendering to the template fragment loader.
	private static function _fieldRenderer( $type, $params ) {
		BlogfolioTemplate::loadFragment( 'admin/optionsfield', $type, $params );
	}
}

?>
