<?php
/**
 * The template for displaying a page or post without the header.
 *
 * Template Name: No header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'components/page/content', 'page-noheader' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
				?>
					<div class="comments-wrapper">
						<?php comments_template(); ?>
					</div>
				<?php
				endif;

			endwhile; // End of the loop.
			?>

		</main>
	</div>
<?php
get_footer();
