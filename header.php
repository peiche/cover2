<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cover2
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'ase_theme_body_inside_top' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cover2' ); ?></a>

	<?php
	$has_chapters = '';
	if ( cover2_has_ase_chapters( $post ) ) :
		$has_chapters = ' has-chapters';
	endif;
	?>
	
	<header id="masthead" class="site-header<?php echo $has_chapters; ?>" role="banner">

		<?php get_template_part( 'components/header/header', 'nav' ); ?>

		<?php get_template_part( 'components/header/header', 'branding' ); ?>

	</header>

	<?php get_template_part( 'components/header/header', 'overlay' ); ?>

	<div id="content" class="site-content">
