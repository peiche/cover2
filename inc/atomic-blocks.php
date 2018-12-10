<?php
/**
 * Atomic Blocks Compatibility File.
 *
 * @link https://atomicblocks.com/
 *
 * @package Cover2
 */

/**
 * Enqueue additional Atomic Blocks styles.
 */
function cover2_atomic_blocks_styles() {
	wp_register_style( 'cover2-atomic-blocks-style', get_template_directory_uri() . '/dist/css/plugins/atomic-blocks.css', array(), filemtime( get_template_directory() . '/dist/css/plugins/atomic-blocks.css' ) );
	// TODO detect active plugin so we don't load the stylesheet for everyone!
	//if ( defined( 'EB_BLOCKS_VERSION' ) ) {
		//wp_dequeue_style( 'atomic-blocks-style-css' );
		wp_enqueue_style( 'cover2-atomic-blocks-style' );
	//}
}
add_action( 'wp_enqueue_scripts', 'cover2_atomic_blocks_styles' );
