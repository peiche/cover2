<?php
/**
 * Algolia Search Compatibility File
 *
 * @package Cover2
 */

/**
 * Enqueue Algolia styles.
 */
function cover2_algolia_styles() {
	wp_register_style( 'cover2-algolia-style', get_template_directory_uri() . '/dist/css/plugins/algolia.css', array(), filemtime( get_template_directory() . '/dist/css/plugins/algolia.css' ) );
	if ( class_exists( 'Algolia_Plugin' ) ) {
	    wp_enqueue_style( 'cover2-algolia-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'cover2_algolia_styles' );

/**
 * Dequeue default CSS files.
 *
 * Hooked to the wp_print_styles action, with a late priority (100),
 * so that it is after the stylesheets were enqueued.
 */
function cover2_dequeue_styles() {
  wp_dequeue_style( 'algolia-autocomplete' );
  wp_dequeue_style( 'algolia-instantsearch' );
}
add_action( 'wp_print_styles', 'cover2_dequeue_styles', 100 );

/**
 * Set custom template path. Don't forget the trailing slash!
 *
 * @link https://community.algolia.com/wordpress/customize-templates.html#customize-templates-folder-name
 */
function cover2_algolia_templates_path() {
  return 'components/algolia/';
}
add_filter( 'algolia_templates_path', 'cover2_algolia_templates_path' );

/**
 * @param array   $record
 * @param WP_User $user
 *
 * @return array
 */
// function cover2_algolia_user_record( array $record, WP_User $user ) {
//     $record['custom_field'] = get_user_meta( $user->ID, 'custom_field', true );
//     /* Add as many as you want. */

//     return $record;
// }
// add_filter( 'algolia_user_record', 'cover2_algolia_user_record', 10, 2 );


/**
 * Set image thumbnail size to full width.
 * 
 * @link https://community.algolia.com/wordpress/frequently-asked-questions.html#can-i-use-custom-thumbnail-sizes-
 */
function cover2_algolia_post_images_sizes( $sizes ) {
    $sizes[] = 'single-post-thumbnail';

    return $sizes;
}
add_filter( 'algolia_post_images_sizes', 'cover2_algolia_post_images_sizes' );
