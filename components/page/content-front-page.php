<?php
/**
 * Template part for displaying front page content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header<?php if ( '' != cover2_get_featured_image( get_the_ID() ) || '' != get_header_image() ) : echo ' full-height'; endif; ?>">
		<div class="page-header__image"></div>
		
		<div class="page-header__content text-align-center">
			<h1 class="site-title page-title"><?php bloginfo( 'name' ); ?></h1>
			<hr />
			<div class="site-description entry-excerpt">
				<?php bloginfo( 'description' ); ?>
			</div>
		</div>
		
		<?php if ( '' != cover2_get_featured_image( get_the_ID() ) || '' != get_header_image() ) : ?>
			<div class="page-header__scroll-container">
				<a class="page-header__scroll-link" href="#post-<?php the_ID(); ?>-content">
					<?php echo cover2_get_svg( array( 'icon' => 'chevron-down' ) ); ?>
				</a>
			</div>
		<?php endif; ?>
	</header>

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
