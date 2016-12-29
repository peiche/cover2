<?php
/**
 * The template for displaying footer information.
 *
 * @package ReCover
 */

?>

<div class="site-info">
	<?php printf( esc_html__( 'Powered by', 'recover' ) ); ?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'recover' ) ); ?>"><?php printf( esc_html__( '%s', 'recover' ), 'WordPress' ); ?></a>
	<span class="sep"> <?php printf( esc_html__( 'and', 'recover' ) ); ?> </span>
	<?php printf( '<a href="https://eichefam.net/projects/recover">ReCover</a>' ); ?>
</div><!-- .site-info -->
