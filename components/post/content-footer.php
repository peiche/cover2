<?php
/**
 * The template for displaying post footer information.
 *
 * @package Cover2
 */

?>

<footer class="entry-footer">
	<?php
	if ( 'timeline' != get_post_type() ) :
		get_template_part( 'components/author/author', 'bio' );
	endif;
	?>
	<?php cover2_entry_footer(); ?>
</footer><!-- .entry-footer -->
