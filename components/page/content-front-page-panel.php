<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<?php $panel_class = is_customize_preview() ? 'panel panel-' . get_query_var( 'panel' ) : 'panel'; ?>
<article id="panel-<?php the_ID(); ?>" <?php post_class( $panel_class ); ?>>

	<!--
	<header class="page-header">
		<div class="page-header__image"></div>

		<div class="page-header__content">
			<?php if ( function_exists( 'has_post_video' ) && has_post_video() ) { ?>
				<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false"><?php echo cover2_get_svg( array( 'icon' => 'play' ) ); ?></button>
			<?php } ?>

			<?php the_title( '<h1 class="page-title text-align-center">', '</h1>' ); ?>
			
			<?php
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
	-->
	
	<!-- TODO background image if exists, white text -->
	<?php
	$has_img = false;
	$img = cover2_get_featured_image( get_the_ID() );
	if ( $img != '' ) :
		$has_img = true;
	endif;
	?>
	<header class="panel-header<?php echo $has_img ? ' panel-header--image' : ''; ?>">
		<div class="panel-header__image"<?php echo $has_img ? ' style="background-image: url(' . $img . ');"' : ''; ?>></div>
		<div class="panel-header__content">
			<?php the_title( '<h2>', '</h2>' ); ?>
		</div>
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
