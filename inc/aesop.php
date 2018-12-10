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
	// NOTE if shortcodes will be removed in the future, this will have to change.
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

/**
 * Add overlay element to content component, so we don't rely on pseudo-elements
 */
function cover2_content_overlay() {
    echo '<div class="aesop-content-darken"></div>';
    return;
}
add_action('aesop_cbox_content_inside_top', 'cover2_content_overlay');

/**
 * Chapter check
 */
function cover2_has_ase_chapters( $post ) {
    if ( defined( 'AI_CORE_VERSION' ) && is_object( $post ) && ( is_single() || is_page() ) ) :
        if ( has_shortcode( $post->post_content, 'aesop_chapter' ) ) :
            return true;
        endif;
        
        if ( function_exists( 'has_blocks' ) && has_blocks( $post->post_content ) ) :
            
            $blocks = cover2_parse_blocks( $post->post_content );
    		
    		foreach ( $blocks as $block ) {
    			if ( is_array( $block ) && array_key_exists('blockName', $block) && $block['blockName'] == 'ase/chapter' ) :
    				return true;
    			endif;
    		}
        endif;
    endif;

    return false;
}
