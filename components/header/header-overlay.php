<?php if ( is_active_sidebar( 'sidebar-overlay' ) || has_nav_menu( 'top' ) || has_nav_menu( 'social' ) ) : ?>

	<div class="overlay overlay--menu">
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>

		<?php recover_social_menu(); ?>

		<?php if ( is_active_sidebar( 'sidebar-overlay' ) ) {
			get_sidebar();
		} ?>
	</div>

<?php endif; ?>

<div class="overlay overlay--search">
	<?php get_search_form(); ?>
</div>
