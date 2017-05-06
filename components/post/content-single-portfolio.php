<?php
/**
 * Template part for displaying portfolio items.
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
				<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false">
					<?php echo cover2_get_svg( array( 'icon' => 'icon_bg_play-circle-o' ) ); ?>
				</button>
			<?php } ?>

			<?php
			the_title( '<h1 class="page-title text-align-center">', '</h1>' );

			if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'components/post/content', 'meta' ); ?>
			<?php
			endif; ?>

			<?php if ( has_excerpt() ) : ?>
				<hr>
				<div class="entry-excerpt">
					<?php echo the_excerpt(); ?>
				</div>
			<?php endif; ?>

		</div>
	</header>

	<div class="entry-content aesop-entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cover2' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cover2' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php get_template_part( 'components/post/content', 'footer' ); ?>
	
</article><!-- #post-## -->
