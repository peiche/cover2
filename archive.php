<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ReCover
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="page-header__image"></div>
				<div class="page-header__content">

					<?php if ( is_author() ) : ?>
						<div class="profile-avatar text-align-center">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', __( 'Profile Picture for ' . esc_html( get_the_author() ), 'recover' ) ); ?>
						</div>
					<?php endif; ?>

					<?php the_archive_title( '<h1 class="page-title text-align-center">', '</h1>' ); ?>
					<?php if ( get_the_archive_description() != '' ): ?>
						<hr>
						<?php the_archive_description( '<div class="page-description">', '</div>' ); ?>
					<?php endif; ?>
				</div>
			</header>
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
