<?php
/**
 * Editor Blocks Compatibility File.
 *
 * @link https://editorblockswp.com/
 *
 * @package Cover2
 */

/**
 * Dequeue default Editor Blocks styles and enqueue our own.
 */
function cover2_editor_blocks_styles() {
	wp_register_style( 'cover2-editor-blocks-style', get_template_directory_uri() . '/dist/css/plugins/editor-blocks.css', array(), filemtime( get_template_directory() . '/dist/css/plugins/editor-blocks.css' ) );
	if ( defined( 'EB_BLOCKS_VERSION' ) ) {
		wp_dequeue_style( 'editor-blocks-style-css' );
		wp_enqueue_style( 'cover2-editor-blocks-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'cover2_editor_blocks_styles' );
