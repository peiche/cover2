<?php
/**
 * Template part for displaying page content on the static front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<?php
$panel_class = is_customize_preview() ? 'panel panel-' . get_query_var( 'panel' ) : 'panel';
$has_img = false;
$img = cover2_get_featured_image( get_the_ID() );
if ( '' != $img ) :
	$has_img = true;
	$panel_class = $panel_class . ' panel--image';
endif;
?>
<article id="panel-<?php the_ID(); ?>" <?php post_class( $panel_class ); ?>>
	<?php if ( $has_img ) : ?>
		<div class="panel__image" style="background-image: url('<?php echo $img; ?>');"></div>
	<?php endif; ?>
	
	<div id="post-<?php the_ID(); ?>-content" class="entry-content aesop-entry-content">
		
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cover2' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cover2' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<div class="edit-link">' . cover2_get_svg( array( 'icon' => 'edit', 'title' => __( 'Edit Post', 'cover2' ) ) ),
				'</div>'
			);
		?>
	</footer>
	
</article><!-- #post-## -->
