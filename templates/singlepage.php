<?php
/**
 * The template for displaying a single page built out of many sub-pages.
 * Displays the content of the current page by default, followed by <section>s
 * of child pages.
 *
 * Template Name: Single Page
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

				get_template_part( 'components/page/content', 'page-singlepage' );

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
