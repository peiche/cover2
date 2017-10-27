<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<div class="page-header__image"></div>

		<div class="page-header__content">
			<?php if ( function_exists( 'has_post_video' ) && has_post_video() ) { ?>
				<button class="video-toggle video-play" aria-label="toggle video" aria-expanded="false"><?php echo cover2_get_svg( array( 'icon' => 'icon_bg_play-circle-o' ) ); ?></button>
			<?php } ?>

			<?php the_title( '<h1 class="page-title text-align-center">', '</h1>' ); ?>
			
			<?php
			$post_content_excerpt = preg_split( '/<!--more(.*?)?-->/', get_post()->post_content );
			if ( has_excerpt() && strcasecmp( trim( get_the_excerpt() ), trim( $post_content_excerpt[0] ) ) != 0 ) : ?>
				<hr>
				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>
		</div>
		
		<?php if ( cover2_get_featured_image( get_the_ID() ) != '' ) : ?>
			<a class="page-header__scroll-to-content" href="#post-<?php the_ID(); ?>-content">
				<?php echo cover2_get_svg( array( 'icon' => 'icon_bg_angle-down' ) ); ?>
			</a>
		<?php endif; ?>
	</header>

	<div id="post-<?php the_ID(); ?>-content" class="entry-content aesop-entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cover2' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	
	<div class="singlepage-sections">
	
		<?php
		
		$jump_pages = array();
		
		$args = array(
			'child_of' => get_the_ID()
		);
		$pages = get_pages( $args );
		$counter = 0;
		foreach ( $pages as $page ) {
			$content = $page->post_content;
			
			// Check for empty page
			if ( ! $content ) {
				continue;
			}
			
			$content = apply_filters( 'the_content', $content );
			$jump_pages[ $counter ] = $page;
			
			$img_class = '';
			$img = cover2_get_featured_image( $page->ID );
			if ( '' != $img ) {
				$img_class = ' has-featured-image';
			}
			
			?>
			
			<section id="post-<?php echo $page->ID; ?>-content" class="singlepage-content<?php echo $img_class; ?>">
				<div class="singlepage-content-bg" style="background-image: url('<?php echo $img; ?>');"></div>
				<div class="entry-content aesop-entry-content">
					<h2><?php echo $page->post_title; ?></h2>
					<?php echo $content; ?>
				</div>
			</section>
			
			<?php
			$counter++;
		}
		
		?>
	
	</div>
	
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cover2' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<div class="edit-link">' . cover2_get_svg( array( 'icon' => 'icon_bg_pencil', 'title' => __( 'Edit Post', 'cover2' ) ) ),
				'</div>'
			);
		?>
	</footer>
</article><!-- #post-## -->

<!-- TODO class/style! -->

<!--
<div class="singlepage-scroll-nav">
	<nav class="scroll-nav fixed" role="navigation">
		<div class="scroll-nav__wrapper">
			<ol class="scroll-nav__list">
				<li class="scroll-nav__item">
					<a href="#post-<?php the_ID(); ?>-content" class="scroll-nav__link">Top</a>
				</li>
				
				<?php foreach( $jump_pages as $page ) { ?>
					<li class="scroll-nav__item">
						<a href="#post-<?php echo $page->ID; ?>-content" class="scroll-nav__link"><?php echo $page->post_title; ?></a>
					</li>
				<?php } ?>
				
			</ol>
		</div>
	</nav>
</div>
-->
