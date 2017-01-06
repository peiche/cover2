<?php
/**
 * The template for displaying post footer information.
 *
 * @package ReCover
 */

if ( 'thread' != get_post_type() ) :

?>

<footer class="entry-footer">
	<?php get_template_part( 'components/author/author', 'bio' ); ?>
	<?php recover_entry_footer(); ?>
</footer><!-- .entry-footer -->

<?php endif; ?>
