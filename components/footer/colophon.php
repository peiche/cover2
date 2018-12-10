<?php
/**
 * The template for displaying footer information.
 *
 * @package Cover2
 */

?>

<div class="container large colophon">
    <div class="grid-row">
        <div class="grid-col-12 grid-col-md-6">
        	<?php printf( __( 'Powered by <a href="%1$s">WordPress</a> and <a href="%2$s">Cover2</a>', 'cover2' ), esc_url( 'https://wordpress.org/' ), esc_url( 'https://eichefam.net/projects/cover2' ) ); ?>
        </div>
        <div class="grid-col-12 grid-col-md-6 ">
            <?php cover2_social_menu(); ?>
        </div>
    </div>
</div>
