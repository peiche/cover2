<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ReCover
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php
		if ( is_sticky() ) {
			echo recover_get_svg( array( 'icon' => 'thumb-tack', 'title' => __( 'Sticky Post', 'recover' ) ) );
		} else if ( get_post_format() ) {
			$format = get_post_format();
			switch ( $format ) {
				case 'video':
					echo recover_get_svg( array( 'icon' => 'play-circle', 'title' => __( 'Video', 'recover' ) ) );
					break;
				case 'audio':
					echo recover_get_svg( array( 'icon' => 'music', 'title' => __( 'Audio', 'recover' ) ) );
					break;
				case 'image':
					echo recover_get_svg( array( 'icon' => 'picture-o', 'title' => __( 'Image', 'recover' ) ) );
					break;
				case 'quote':
					echo recover_get_svg( array( 'icon' => 'quote-right', 'title' => __( 'Quote', 'recover' ) ) );
					break;
				case 'aside':
					echo recover_get_svg( array( 'icon' => 'sticky-note-o', 'title' => __( 'Aside', 'recover' ) ) );
					break;
				case 'link':
					echo recover_get_svg( array( 'icon' => 'link', 'title' => __( 'Link', 'recover' ) ) );
					break;
				case 'chat':
					echo recover_get_svg( array( 'icon' => 'comments', 'title' => __( 'Chat', 'recover' ) ) );
					break;
				case 'status':
					echo recover_get_svg( array( 'icon' => 'comment', 'title' => __( 'Status', 'recover' ) ) );
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
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'recover' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-## -->
