<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ReCover
 */

if ( ! is_active_sidebar( 'sidebar-overlay' ) ) {
	return;
}
?>

<aside id="overlay" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-overlay' ); ?>
</aside>
