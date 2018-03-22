<?php
/**
 * Cover2 Theme Customizer.
 *
 * @package Cover2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cover2_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'cover2_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'cover2_customize_partial_blogdescription',
	) );

	// Remove the core header textcolor control.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add setting for header color.
	$wp_customize->add_setting( 'header_color', array(
		'default'           => '#4020df',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	// Add setting for accent color.
	$wp_customize->add_setting( 'accent_color', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	// Add setting for overlay color scheme.
	$wp_customize->add_setting( 'overlay_colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'cover2_sanitize_overlay_colorscheme',
	) );
	
	// Add setting for footer color scheme.
	$wp_customize->add_setting( 'footer_colorscheme', array(
		'default'			=> 'light',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'cover2_sanitize_footer_colorscheme',
	) );
	
	// Add setting for icon accent color.
	$wp_customize->add_setting( 'icon_accent', array(
		'default'			=> '',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'cover2_sanitize_checkbox',
	) );
	
	// Add control for header color.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
		'label'		    	=> __( 'Navbar Color', 'cover2' ),
		'description'		=> __( 'Applied to the top bar on the blog homepage and when scrolling down the page.', 'cover2' ),
		'section'	    	=> 'colors',
		'priority'			=> 5,
	) ) );

	// Add control for accent color.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'   	 		=> __( 'Accent Color', 'cover2' ),
		'description'		=> __( 'Applied to the page header (when there is no featured image) and links.', 'cover2' ),
		'mode'     			=> 'hue',
		'section'  			=> 'colors',
		'priority' 			=> 6,
	) ) );

	// Add control for overlay color scheme.
	$wp_customize->add_control( 'overlay_colorscheme', array(
		'type'   			=> 'radio',
		'label'    			=> __( 'Overlay Color Scheme', 'cover2' ),
		'choices'  			=> array(
			'light'  			=> __( 'Light', 'cover2' ),
			'dark'   			=> __( 'Dark', 'cover2' ),
		),
		'section'  			=> 'colors',
		'priority' 			=> 7,
	) );
	
	// Add control for footer color scheme.
	$wp_customize->add_control( 'footer_colorscheme', array(
		'type'				=> 'radio',
		'label'				=> __( 'Footer Color Scheme', 'cover2' ),
		'choices'			=> array(
			'light'				=> __( 'Light', 'cover2' ),
			'dark'				=> __( 'Dark', 'cover2' ),
			'accent'			=> __( 'Accent', 'cover2' ),
		),
		'section'			=> 'colors',
		'priority'			=> 8,
	) );
	
	// Add control for icon accent color.
	$wp_customize->add_control( 'icon_accent', array(
		'type'				=> 'checkbox',
		'label'				=> __( 'Use Accent Color in theme icons', 'cover2' ),
		'section'			=> 'colors',
		'priority'			=> 9,
	) );

}
add_action( 'customize_register', 'cover2_customize_register' );

/**
 * Sanitize the overlay_colorscheme.
 *
 * @param String $input The input to sanitize.
 */
function cover2_sanitize_overlay_colorscheme( $input ) {
	$valid = array( 'light', 'dark' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Sanitize the footer_colorscheme.
 *
 * @param String $input The input to sanitize.
 */
function cover2_sanitize_footer_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'accent' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Sanitize checkbox.
 *
 * @param String $input The input to sanitize.
 */
function cover2_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Cover2 1.0
 * @see cover2_customize_register()
 *
 * @return void
 */
function cover2_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Cover2 1.0
 * @see cover2_customize_register()
 *
 * @return void
 */
function cover2_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cover2_customize_preview_js() {
	wp_enqueue_script( 'cover2_customizer', get_template_directory_uri() . '/dist/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cover2_customize_preview_js' );
