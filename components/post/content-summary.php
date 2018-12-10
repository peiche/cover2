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
	
	<?php
		$icon = '';
		$icon_title = '';
		$svg = '';
		
		if ( is_sticky() ) :
			$icon = 'pin';
			$icon_title = __( 'Sticky Post', 'cover2' );
		elseif ( get_post_format() ) :
			$format = get_post_format();
			switch ( $format ) {
				case 'video':
					$icon = 'video';
					$icon_title = __( 'Video', 'cover2' );
					break;
				case 'audio':
					$icon = 'audio';
					$icon_title = __( 'Audio', 'cover2' );
					break;
				case 'gallery':
					$icon = 'gallery';
					$icon_title = __( 'Gallery', 'cover2' );
					break;
				case 'image':
					$icon = 'image';
					$icon_title = __( 'Image', 'cover2' );
					break;
				case 'quote':
					$icon = 'quote';
					$icon_title = __( 'Quote', 'cover2' );
					break;
				case 'aside':
					$icon = 'aside';
					$icon_title = __( 'Aside', 'cover2' );
					break;
				case 'link':
					$icon = 'link';
					$icon_title = __( 'Link', 'cover2' );
					break;
				case 'chat':
					$icon = 'chat';
					$icon_title = __( 'Chat', 'cover2' );
					break;
				case 'status':
					$icon = 'status';
					$icon_title = __( 'Status', 'cover2' );
					break;
			}
		endif;
		
		if ( 'timeline' == get_post_type() ) :
			$icon = 'timeline';
			$icon_title = __( 'Timeline', 'cover2' );
		endif;
		
		if ( '' != $icon ) :
			$svg = cover2_get_svg( array( 'icon' => $icon, 'title' => $icon_title ) );
		endif;
	?>
	
	<?php
		$featured_image = cover2_get_featured_image( get_the_ID() );
		if ( '' != $featured_image && get_theme_mod( 'blog_feature_image', false ) ) :
	?>
		<figure class="entry-featured-image">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<span class="entry-image" style="background-image: url('<?php echo $featured_image; ?>');">
					<?php if ( '' != $svg ) : ?>
						<span class="post-format-icon">
							<?php echo $svg; ?>
						</span>
					<?php endif; ?>
				</span>
			</a>
		</figure>
	<?php
		endif;
	?>
	
	<header class="entry-header">

		<?php
			if ( '' == $featured_image || ! get_theme_mod( 'blog_feature_image', false ) ) :
				echo $svg;
			endif;
			
			if ( 'post' == get_post_type() && 'quote' == get_post_format( $post->ID ) ) : ?>
				<div class="entry-summary">
					<!--<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">-->
						<?php echo cover2_get_blockquote_in_content(); ?>
					<!--</a>-->
				</div>
			<?php else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			
			if ( 'post' === get_post_type() ) :
				get_template_part( 'components/post/content', 'meta' );
			endif;
		?>
	</header>
	
	<?php if ( 'quote' != get_post_format( $post->ID ) ) : ?>
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
	<?php endif; ?>
</article>
