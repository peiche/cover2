<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header<?php if ( cover2_get_featured_image( get_the_ID() ) != '' ): echo ' full-height'; endif; ?>">
		<div class="page-header__image"></div>

		<div class="page-header__content">

			<?php if ( function_exists( 'has_post_video' ) && has_post_video() ) { ?>
				<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false">
					<?php echo cover2_get_svg( array( 'icon' => 'play' ) ); ?>
				</button>
			<?php } ?>

			<?php
			the_title( '<h1 class="page-title text-align-center">', '</h1>' );

			if ( 'post' === get_post_type() ) :
				get_template_part( 'components/post/content', 'meta' );
			endif;

			$post_content_excerpt = preg_split( '/<!--more(.*?)?-->/', get_post()->post_content );
			if ( has_excerpt() && strcasecmp( trim( get_the_excerpt() ), trim( $post_content_excerpt[0] ) ) != 0 ) : ?>
				<hr>
				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>

		</div>

		<?php if ( cover2_get_featured_image( get_the_ID() ) != '' ) : ?>
			<a class="page-header__scroll-to-content" href="#post-<?php the_ID(); ?>-content">
				<?php echo cover2_get_svg( array( 'icon' => 'chevron-down' ) ); ?>
			</a>
		<?php endif; ?>

	</header>

	<div id="post-<?php the_ID(); ?>-content" class="entry-content aesop-entry-content">
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
