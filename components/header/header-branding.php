<?php
/**
 * The template for displaying header branding.
 *
 * @package Cover2
 */

?>

<div class="site-branding">
	<div class="site-meta">
		<?php
		if ( has_custom_logo() ) :
			the_custom_logo();
		endif;
		?>
		
		<?php if ( ! has_custom_logo() || ( has_custom_logo() && ( ! is_front_page() || ! is_page() ) ) ) : ?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
		<?php endif; ?>
		
		<?php if ( has_custom_logo() && ( ! is_front_page() || ! is_page() ) ) : ?>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php endif; ?>
	</div>
	
	<?php if ( has_nav_menu( 'mini' ) ) : ?>
		<?php wp_nav_menu( array( 'theme_location' => 'mini', 'container_class' => 'mini-menu-container' ) ); ?>
	<?php endif; ?>
</div>
