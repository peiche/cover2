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
	</header>

	<div class="entry-content aesop-entry-content">
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
