<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cover2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'components/post/content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
			?>
				<div class="comments-wrapper">
					<?php comments_template(); ?>
				</div>
			<?php
			endif;

			if ( 'timeline' != get_post_type() ) {

				// Previous/next post navigation.
				the_post_navigation( array(
						'next_text' => '<span class="nav-next__image"></span><span class="meta-nav text-align-right" aria-hidden="true">' . cover2_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'Next', 'cover2' ) ) ) .
						'</span> <span class="screen-reader-text">' . __( 'Next post:', 'cover2' ) . '</span><hr><span class="post-title text-align-center">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . cover2_get_svg( array( 'icon' => 'arrow-left', 'title' => __( 'Previous', 'cover2' ) ) ) .
						'</span><span class="screen-reader-text">' . __( 'Previous post:', 'cover2' ) . '</span><hr><span class="post-title text-align-center">%title</span>',
				) );

			}

		endwhile; // End of the loop.
		?>

		</main>
	</div>
<?php
get_footer();
