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
	<header class="entry-header">

		<?php
		if ( is_sticky() ) {
			echo cover2_get_svg( array( 'icon' => 'thumb-tack', 'title' => __( 'Sticky Post', 'cover2' ) ) );
		} else if ( get_post_format() ) {
			$format = get_post_format();
			switch ( $format ) {
				case 'video':
					echo cover2_get_svg( array( 'icon' => 'play-circle', 'title' => __( 'Video', 'cover2' ) ) );
					break;
				case 'audio':
					echo cover2_get_svg( array( 'icon' => 'music', 'title' => __( 'Audio', 'cover2' ) ) );
					break;
				case 'image':
					echo cover2_get_svg( array( 'icon' => 'picture-o', 'title' => __( 'Image', 'cover2' ) ) );
					break;
				case 'quote':
					echo cover2_get_svg( array( 'icon' => 'quote-right', 'title' => __( 'Quote', 'cover2' ) ) );
					break;
				case 'aside':
					echo cover2_get_svg( array( 'icon' => 'sticky-note-o', 'title' => __( 'Aside', 'cover2' ) ) );
					break;
				case 'link':
					echo cover2_get_svg( array( 'icon' => 'link', 'title' => __( 'Link', 'cover2' ) ) );
					break;
				case 'chat':
					echo cover2_get_svg( array( 'icon' => 'comments', 'title' => __( 'Chat', 'cover2' ) ) );
					break;
				case 'status':
					echo cover2_get_svg( array( 'icon' => 'comment', 'title' => __( 'Status', 'cover2' ) ) );
					break;
			}
		}

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<?php get_template_part( 'components/post/content', 'meta' ); ?>
		<?php
		endif; ?>
	</header>
	<div class="entry-summary">
		<?php
      if ( has_excerpt() ) {
        the_excerpt();
      } else if ( strpos( $post->post_content, '<!--more-->' ) ) {
        the_content( '' ); // No "more" link.
      } else {
        the_excerpt();
      }

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cover2' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-## -->
