<?php
/**
 * The template for displaying header branding.
 *
 * @package Cover2
 */

?>

<div class="site-branding">
	<?php the_custom_logo(); ?>
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

	<?php if ( has_nav_menu( 'mini' ) ) : ?>
		<?php wp_nav_menu( array( 'theme_location' => 'mini', 'container_class' => 'mini-menu-container' ) ); ?>
	<?php endif; ?>
</div><!-- .site-branding -->
