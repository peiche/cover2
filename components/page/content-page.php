<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<div class="page-header__image"></div>

		<div class="page-header__content">
			<?php if ( function_exists( 'has_post_video' ) && has_post_video() ) { ?>
				<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false"><?php echo cover2_get_svg( array( 'icon' => 'icon_bg_play-circle-o' ) ); ?></button>
			<?php } ?>

			<?php the_title( '<h1 class="page-title text-align-center">', '</h1>' ); ?>
		</div>

		<?php if ( cover2_get_featured_image( get_the_ID() ) != '' ) : ?>
			<a class="page-header__scroll-to-content" href="#post-<?php the_ID(); ?>-content" aria-label="<?php echo __( 'Jump to content', 'cover2' ); ?>">
				<?php echo cover2_get_svg( array( 'icon' => 'icon_bg_angle-down' ) ); ?>
			</a>
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
				'<div class="edit-link">' . cover2_get_svg( array( 'icon' => 'icon_bg_pencil', 'title' => __( 'Edit Post', 'cover2' ) ) ),
				'</div>'
			);
		?>
	</footer>
</article><!-- #post-## -->
