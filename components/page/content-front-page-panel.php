<?php
/**
 * Template part for displaying page content on the static front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<?php
$panel_class = is_customize_preview() ? 'panel panel-' . get_query_var( 'panel' ) : 'panel';
$has_img = false;
$img = cover2_get_featured_image( get_the_ID() );
if ( '' != $img ) :
	$has_img = true;
	$panel_class = $panel_class . ' panel--image';
endif;
?>
<section id="panel-<?php the_ID(); ?>" <?php post_class( $panel_class ); ?>>
	
	<?php
	// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
	if ( get_the_ID() === (int) get_option( 'page_for_posts' ) ) :
		
		// Show three most recent posts.
		$recent_posts = new WP_Query(
			array(
				'posts_per_page'      => get_theme_mod( 'static_posts_count', 3 ), // Custom setting?
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
	
		if ( $recent_posts->have_posts() ) : ?>

			<div class="recent-posts">
				
				<?php
				the_title( '<h1 class="home-latest-posts-title text-align-center">', '</h1>' );
				?>

				<?php
				while ( $recent_posts->have_posts() ) :
					$recent_posts->the_post();
					get_template_part( 'components/post/content', 'summary' );
				endwhile;
				wp_reset_postdata();
				?>
				
				<nav class="navigation posts-navigation align-center" role="navigation">
					<h2 class="screen-reader-text"><?php echo __( 'Posts navigation', 'cover2' ); ?></h2>
					<a class="button default" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php echo __( 'View more', 'cover2' ); ?></a>
				</nav>
				
			</div>
		<?php
		endif;
	else :
	?>
	
		<?php if ( $has_img ) : ?>
			<div class="panel__image" style="background-image: url('<?php echo $img; ?>');"></div>
		<?php endif; ?>
	
		<div id="post-<?php the_ID(); ?>-content" class="entry-content aesop-entry-content">
		
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cover2' ),
				'after'  => '</div>',
			) );
			?>
			
		</div>
	
	<?php
	endif;
	?>
	
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
	
</section>
