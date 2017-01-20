<?php
/**
 * The template for displaying header branding.
 *
 * @package Cover2
 */

?>

<div class="site-branding">
	<?php cover2_the_custom_logo(); ?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
</div><!-- .site-branding -->
