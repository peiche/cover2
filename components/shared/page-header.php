<?php
/**
 * Template part for displaying post and page header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<header class="page-header<?php if ( '' != cover2_get_featured_image( get_the_ID() ) && ! is_archive() ) : echo ' full-height'; endif; ?>">
	<div class="page-header__image"></div>

	<div class="page-header__content">

		<?php if ( function_exists( 'has_post_video' ) && has_post_video() ) : ?>
			<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false">
				<?php echo cover2_get_svg( array( 'icon' => 'play' ) ); ?>
			</button>
		<?php endif; ?>
		
		<?php if ( is_author() ) : ?>
			<div class="profile-avatar text-align-center">
				<?php
				echo get_avatar( get_the_author_meta( 'ID' ), 120, '', __( 'Profile Picture for ', 'cover2' ) . esc_html( get_the_author() ) ); ?>
			</div>
		<?php endif; ?>

		<?php
		if ( is_archive() ) :
		    the_archive_title( '<h1 class="page-title text-align-center">', '</h1>' );
		else :
		    the_title( '<h1 class="page-title text-align-center">', '</h1>' );
		endif;

		if ( 'post' === get_post_type() && ! is_archive() ) :
			get_template_part( 'components/post/content', 'meta' );
		endif;
		
		if ( '' != get_the_archive_description() ) : ?>
			<hr>
			<?php the_archive_description( '<div class="page-description">', '</div>' ); ?>
		<?php endif;

		$post_content_excerpt = preg_split( '/<!--more(.*?)?-->/', get_post()->post_content );
		if ( has_excerpt() && strcasecmp( trim( get_the_excerpt() ), trim( $post_content_excerpt[0] ) ) != 0 ) : ?>
			<hr>
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php if ( '' != cover2_get_featured_image( get_the_ID() ) && ! is_archive() ) : ?>
		<div class="page-header__scroll-container">
			<a class="page-header__scroll-link" href="#post-<?php the_ID(); ?>-content">
				<?php echo cover2_get_svg( array( 'icon' => 'chevron-down' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

</header>
