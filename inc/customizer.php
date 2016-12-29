<?php
/**
 * ReCover Theme Customizer.
 *
 * @package ReCover
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function recover_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'recover_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'recover_customize_partial_blogdescription',
	) );

	// Remove the core header textcolor control.
	$wp_customize->remove_control( 'header_textcolor' );

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
		'sanitize_callback' => 'recover_sanitize_overlay_colorscheme',
	) );

	// Add control for accent color.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'    => __( 'Accent Color', 'recover' ),
		'mode'     => 'hue',
		'section'  => 'colors',
		'priority' => 5,
	) ) );

	// Add control for overlay color scheme.
	$wp_customize->add_control( 'overlay_colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Overlay Color Scheme', 'recover' ),
		'choices'  => array(
			'light'  => __( 'Light', 'recover' ),
			'dark'   => __( 'Dark', 'recover' ),
		),
		'section'  => 'colors',
		'priority' => 6,
	) );

}
add_action( 'customize_register', 'recover_customize_register' );

/**
 * Sanitize the overlay_colorscheme.
 *
 * @param String $input The input to sanitize.
 */
function recover_sanitize_overlay_colorscheme( $input ) {
	$valid = array( 'light', 'dark' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since ReCover 1.0
 * @see recover_customize_register()
 *
 * @return void
 */
function recover_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since ReCover 1.0
 * @see recover_customize_register()
 *
 * @return void
 */
function recover_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function recover_customize_preview_js() {
	wp_enqueue_script( 'recover_customizer', get_template_directory_uri() . '/dist/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'recover_customize_preview_js' );
