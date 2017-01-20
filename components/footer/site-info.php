<?php
/**
 * The template for displaying footer information.
 *
 * @package Cover2
 */

?>

<div class="site-info">
	<?php printf( esc_html__( 'Powered by', 'cover2' ) ); ?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cover2' ) ); ?>"><?php printf( esc_html__( 'WordPress', 'cover2' ) ); ?></a>
	<span class="sep"> <?php printf( esc_html__( 'and', 'cover2' ) ); ?> </span>
	<?php printf( '<a href="https://eichefam.net/projects/cover2">Cover2</a>' ); ?>
</div><!-- .site-info -->
