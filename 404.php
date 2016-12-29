<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ReCover
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="page-header__content text-align-center">
						<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'recover' ); ?></h1>
					</div>
				</header>
				<div class="entry-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'recover' ); ?></p>
				</div>
			</section>
		</main>
	</div>
<?php
get_footer();
