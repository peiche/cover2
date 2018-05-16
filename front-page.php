<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php
			if ( is_home() && ! is_paged() ) {
			  // Include the featured content template.
			  get_template_part( 'components/post/content', 'featured' );
			}
		
			if ( have_posts() ) :
	
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
					if ( ! is_home() ) :
	
						get_template_part( 'components/page/content', 'front-page' );
					
					else :
						
						get_template_part( 'components/post/content', 'summary' );
						
					endif;
	
				endwhile;
	
				the_posts_navigation();
	
			else :
	
				get_template_part( 'components/post/content', 'none' );
	
			endif;
			
			if ( cover2_has_featured_post() && get_theme_mod( 'static_featured_bool', false ) ) : ?>
				<div class="home-featured-posts container large">
					<?php get_template_part( 'components/post/content', 'featured' ); ?>
				</div>
			<?php endif;
			
			// Single-page includes, defined in the Customizer.
			if ( ! is_home() && ( 0 !== cover2_panel_count() || is_customize_preview() ) ) : // If we have pages to show.
				$num_sections = apply_filters( 'cover2_front_page_sections', 4 );
				global $cover2counter;
				// Create a setting and control for each of the sections available in the theme.
				for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
					$cover2counter = $i;
					cover2_front_page_sections( null, $i );
				}
			endif;
			?>

			<?php if ( get_theme_mod( 'static_posts_bool', false ) ) : ?>
				<div class="home-latest-posts">
					<div class="container align-center">
						<h1>Latest Posts</h1>
					</div>
					
					<?php
					$posts_count = get_theme_mod( 'static_posts_count', 3 );
				    $query = new WP_Query( array (
				    	'posts_per_page' => $posts_count,
				    	'ignore_sticky_posts' => true,
				    	'orderby' => 'date',
				    	'order' => 'DESC',
				    ) );
					while ( $query->have_posts() ) :
					    $query->the_post();
					    get_template_part( 'components/post/content', 'summary' );
					endwhile;
					?>
					
					<nav class="navigation posts-navigation align-center" role="navigation">
						<h2 class="screen-reader-text">Posts navigation</h2>
						<a class="button default" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">View more</a>
					</nav>
				</div>
			<?php endif; ?>
			
		</main>
	</div>
<?php
get_footer();
