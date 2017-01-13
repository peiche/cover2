<?php
/**
 * The template for displaying post footer information.
 *
 * @package ReCover
 */

?>

<footer class="entry-footer">
	<?php
	if ( 'timeline' != get_post_type() ) :
		get_template_part( 'components/author/author', 'bio' );
	endif;
	?>
	<?php recover_entry_footer(); ?>
</footer><!-- .entry-footer -->
