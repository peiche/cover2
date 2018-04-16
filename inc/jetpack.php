<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Cover2
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function cover2_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'cover2_infinite_scroll_render',
		'footer'    => 'page',
		'footer_widgets' => array(
			'sidebar-footer-1',
			'sidebar-footer-2',
			'sidebar-footer-3',
		),
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Featured Content.
	add_theme_support( 'featured-content', array(
        'filter'      => 'cover2_get_featured_posts',
        'description' => esc_html__( 'The featured content section displays on the index page below the header.', 'cover2' ),
        'max_posts'   => 10,
        'post_types'  => array( 'post' ),
    ) );
}
add_action( 'after_setup_theme', 'cover2_jetpack_setup' );

/**
 * Enqueue Jetpack styles.
 */
function cover2_jetpack_styles() {
	wp_register_style( 'cover2-jetpack-style', get_template_directory_uri() . '/dist/css/plugins/jetpack.css', array(), filemtime( get_template_directory() . '/dist/css/plugins/jetpack.css' ) );
	if ( class_exists( 'Jetpack' ) ) {
		wp_enqueue_style( 'cover2-jetpack-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'cover2_jetpack_styles' );

/**
 * Custom render function for Infinite Scroll.
 */
function cover2_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'components/post/content', 'summary' );
	}
}

/**
 * Custom render function for Social Menu.
 */
function cover2_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}
}

/**
 * Check if there are any Featured Posts.
 */
function cover2_has_featured_post() {
  $featured_posts = apply_filters( 'cover2_get_featured_posts', array() );
  if ( is_array( $featured_posts ) && 0 < count( $featured_posts ) ) {
  	return true;
  }
  return false;
}

/**
 * Check if there are more than one Featured Posts.
 */
function cover2_has_multiple_featured_posts() {
  $featured_posts = apply_filters( 'cover2_get_featured_posts', array() );
  if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
  	return true;
  }
  return false;
}

/**
 * Get Featured Posts.
 */
function cover2_get_featured_posts() {
  return apply_filters( 'cover2_get_featured_posts', false );
}

/**
 * Display custom color CSS.
 */
function cover2_featured_posts_css() {
        $css = '';

        $featured_posts = cover2_get_featured_posts();
        if ( ! empty( $featured_posts ) ) {
			foreach ( $featured_posts as $post ) {
					setup_postdata( $post );
					$img = cover2_get_featured_image( $post->ID );
					$css .= '
					.featured-content .post-' . $post->ID . ' .page-header__image {
							background-image: url(' . $img . ');
					}
					';
			}
			wp_reset_postdata();

			printf( '<style type="text/css" id="featured-posts-css">%s</style>', $css );
		}
}
add_action( 'wp_head', 'cover2_featured_posts_css' );
