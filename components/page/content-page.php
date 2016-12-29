<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ReCover
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<div class="page-header__image"></div>

		<div class="page-header__content">
			<?php the_title( '<h1 class="page-title text-align-center">', '</h1>' ); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'recover' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'recover' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<div class="edit-link">' . recover_get_svg( array( 'icon' => 'pencil', 'title' => __( 'Edit Post', 'recover' ) ) ),
				'</div>'
			);
		?>
	</footer>
</article><!-- #post-## -->
