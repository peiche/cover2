<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cover2
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="page-header__image"></div>
				<div class="page-header__content">
					<?php /* translators: %s: Search query */ ?>
					<h1 class="page-title text-align-center"><?php printf( esc_html__( 'Search Results for: %s', 'cover2' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'summary' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</section>
<?php
get_footer();
