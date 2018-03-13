<?php
/**
 * Aesop Story Engine Compatibility File
 *
 * @package Cover2
 */

/**
 * Enqueue Aesop styles.
 */
function cover2_aesop_styles() {
	wp_register_style( 'cover2-aesop-style', get_template_directory_uri() . '/dist/css/plugins/aesop.css', array(), filemtime( get_template_directory() . '/dist/css/plugins/aesop.css' ) );
	
	// Check for the first shortcode ASE registers.
	if ( shortcode_exists( 'aesop_chapter' ) ) {
    	wp_enqueue_style( 'cover2-aesop-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'cover2_aesop_styles' );

/**
 * Override the font size unit
 */
function cover2_quote_size_unit() {
  return 'rem';
}
add_filter( 'aesop_quote_size_unit', 'cover2_quote_size_unit' );

function cover2_content_overlay() {
    echo '<div class="aesop-content-darken"></div>';
    return;
}
add_action('aesop_cbox_content_inside_top', 'cover2_content_overlay');
