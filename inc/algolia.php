<?php
/**
 * Algolia Search Compatibility File
 *
 * @package Cover2
 */

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
