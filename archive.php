<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php get_template_part( 'components/shared/page', 'header' ); ?>
			
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'components/post/content', 'summary' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_footer();
