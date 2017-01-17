<?php
/**
 * The template for displaying header nav buttons.
 *
 * @package ReCover
 */

$has_sidebar = false;
if ( is_active_sidebar( 'sidebar-overlay' ) || has_nav_menu( 'top' ) || has_nav_menu( 'jetpack-social-menu' ) ) :
	$has_sidebar = true; ?>
	<button type="button" class="menu-toggle tcon tcon-menu--xcross" aria-label="toggle menu" aria-expanded="false">
	  <span class="tcon-menu__lines" aria-hidden="true"></span>
	  <span class="screen-reader-text"><?php echo _x( 'Toggle Menu', 'toggle menu overlay button', 'recover' ); ?></span>
	</button>
<?php endif;

$search_button_class = '';
if ( $has_sidebar ) :
	$search_button_class = ' has-sidebar';
endif;
?>

<button type="button" class="search-toggle tcon tcon-search--xcross<?php echo $search_button_class; ?>" aria-label="toggle search" aria-expanded="false">
	<span class="tcon-search__item" aria-hidden="true"></span>
	<span class="screen-reader-text"><?php echo _x( 'Toggle Search', 'toggle search overlay button', 'recover' ); ?></span>
</button>
