<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cover2
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cover2_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( 'timeline' == get_post_type() ) {
		$classes[] = 'timeline';
	}

	// Add a class of has-featured-image when there is a featured image.
	if ( is_singular() && get_the_post_thumbnail() ) {
  		$classes[] = 'has-featured-image';
	} else if ( is_singular() && 'timeline' == get_post_type() ) {
		$has_term_image = false;
		$term_id = 0;

		// Timelines plugin compatibility.
		if ( function_exists( 'cftpb_get_term_id' ) ) {
			$term_id = cftpb_get_term_id( 'timelines', get_the_ID() );

			// Category Images plugin compatibility.
			if ( function_exists( 'z_taxonomy_image_url' ) && '' != z_taxonomy_image_url( $term_id ) ) {
				$has_term_image = true;
			}
		}

		if ( $has_term_image ) {
			$classes[] = 'has-featured-image';
		}
	} else if ( ! is_singular() && '' != cover2_get_first_featured_image() ) {
		$classes[] = 'has-featured-image';
	}

	// Get the overlay colorscheme or the default if there isn't one.
	$overlay_colorscheme = cover2_sanitize_overlay_colorscheme( get_theme_mod( 'overlay_colorscheme', 'light' ) );
	$classes[] = 'overlay-' . $overlay_colorscheme;
	
	// Get the footer colorscheme or the default if there isn't one.
	$footer_colorscheme = cover2_sanitize_footer_colorscheme( get_theme_mod( 'footer_colorscheme', 'light' ) );
	$classes[] = 'footer-' . $footer_colorscheme;
	
	// Set accent colored icons.
	$icon_accent = cover2_sanitize_checkbox( get_theme_mod( 'icon_accent', false ) );
	if ( $icon_accent ) {
		$classes[] = 'icon-accent';
	}
	
	if ( cover2_has_featured_post() ) {
		$classes[] = 'has-featured-post';
	}

	if ( function_exists( 'has_post_video' ) && has_post_video() ) {
		$classes[] = 'has-featured-video';
	}

	return $classes;
}
add_filter( 'body_class', 'cover2_body_classes' );

/**
 * Returns the first featured image from a collection of posts.
 *
 * @return String
 */
function cover2_get_first_featured_image() {
	$img = '';
	while ( have_posts() ) : the_post();
		$img = cover2_get_featured_image( get_the_ID() );

		if ( '' != $img ) {
			break;
		}
	endwhile;
	rewind_posts();

	return $img;
}

/**
 * Returns the featured image of the post.
 *
 * @param int $post_id The post id for the thumbnail.
 * @return String
 */
function cover2_get_featured_image( $post_id ) {
	$img = '';
	if ( '' != get_the_post_thumbnail( $post_id ) ) {
		$img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
		$img = $img_arr[0];
	}

	return $img;
}

/**
 * Remove the "Taxonomy: " prefix from the_archive_title().
 *
 * @param String $title The title to filter.
 */
function cover2_archive_title( $title ) {
   if ( is_category() ) {
       $title = single_cat_title( '', false );
   } elseif ( is_tag() ) {
       $title = single_tag_title( '', false );
   } elseif ( is_author() ) {
       $title = '<span class="vcard">' . get_the_author() . '</span>';
   } elseif ( is_year() ) {
       $title = get_the_date( _x( 'Y', 'yearly archives date format', 'cover2' ) );
   } elseif ( is_month() ) {
       $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'cover2' ) );
   } elseif ( is_day() ) {
       $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'cover2' ) );
   } elseif ( is_tax( 'post_format' ) ) {
       if ( is_tax( 'post_format', 'post-format-aside' ) ) {
           $title = _x( 'Asides', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
           $title = _x( 'Galleries', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
           $title = _x( 'Images', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
           $title = _x( 'Videos', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
           $title = _x( 'Quotes', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
           $title = _x( 'Links', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
           $title = _x( 'Statuses', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
           $title = _x( 'Audio', 'post format archive title', 'cover2' );
       } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
           $title = _x( 'Chats', 'post format archive title', 'cover2' );
       }
   } elseif ( is_post_type_archive() ) {
       $title = post_type_archive_title( '', false );
   } elseif ( is_tax() ) {
       $title = single_term_title( '', false );
   } else {
       $title = __( 'Archives', 'cover2' );
   } // End if().
   return $title;
}
add_filter( 'get_the_archive_title', 'cover2_archive_title' );

/**
 * Add featured image as background image to header and post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function cover2_post_nav_background() {
	$current_image = cover2_get_first_featured_image();
	$css = '';
	
	if ( '' != get_header_image() ) :
		$css .= '
			.home.page .page-header { background-color: #333; }
			.home.page .page-header__image { background-image: url(' . get_header_image() . '); }
		';
	endif;
	
	if ( '' != $current_image ) :
		$css .= '
			.page-header__image { background-image: url(' . esc_url_raw( $current_image ) . '); }
		';
	endif;

	$term_image = '';

	// Set the featured image for Timelines.
	if ( is_singular() && 'timeline' == get_post_type() ) {
		if ( function_exists( 'cftpb_get_term_id' ) ) {
			$term_id = cftpb_get_term_id( 'timelines', get_the_ID() );

			if ( function_exists( 'z_taxonomy_image_url' ) && '' != z_taxonomy_image_url( $term_id ) ) {
				$term_image = z_taxonomy_image_url( $term_id );
			}
		}
	}

	// Set the fetaured image for archives.
	if ( function_exists( 'z_taxonomy_image_url' ) && '' != z_taxonomy_image_url() ) {
		$term_image = z_taxonomy_image_url();
	}

	if ( '' != $term_image ) {
		$css .= '
			.page-header__image { background-image: url(' . esc_url_raw( $term_image ) . '); }
		';
	}

	if ( is_single() && 'timeline' != get_post_type() ) {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( is_attachment() && 'attachment' == $previous->post_type ) {
			return;
		}

		if ( $next && has_post_thumbnail( $next->ID ) ) {
			$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
			$css .= '
				.nav-next__image { background-image: url(' . esc_url_raw( $nextthumb[0] ) . '); }
				.post-navigation .nav-next { padding-bottom: 100px; }
			';
		}
	}

	wp_add_inline_style( 'cover2-style', $css );
}
add_action( 'wp_enqueue_scripts', 'cover2_post_nav_background' );

/**
 * Add pingback to wp_head.
 */
function cover2_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'cover2_pingback_header' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function cover2_panel_count() {
	$panels = array( '1', '2', '3', '4' );
	$panel_count = 0;
	foreach ( $panels as $panel ) {
		if ( get_theme_mod( 'panel_' . $panel ) ) {
			$panel_count++;
		}
	}
	return $panel_count;
}

/**
 * Display a front page section (modified).
 * Replaced `id="' . $id . '"` with `id="' . $post->post_name . '"`.
 *
 * @param $partial WP_Customize_Partial Partial associated with a selective refresh request.
 * @param $id integer Front page section to display.
 */
function cover2_front_page_sections( $partial = null, $id = 0 ) {
 	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
 		// Find out the id and set it up during a selective refresh.
 		global $cover2counter;
 		$id = str_replace( 'panel_', '', $partial->id );
 		$cover2counter = $id;
 	}
 	global $post; // Modify the global post object before setting up post data.
 	if ( get_theme_mod( 'panel_' . $id ) ) {
 		global $post;
 		$post = get_post( get_theme_mod( 'panel_' . $id ) );
 		setup_postdata( $post );
 		set_query_var( 'panel', $id );
 		get_template_part( 'components/page/content', 'front-page-panel' );
 		wp_reset_postdata();
 	} elseif ( is_customize_preview() ) {
 		// The output placeholder anchor.
 		echo '<section class="panel-placeholder panel panel-' . $id . '" id="panel-' . $id . '"><span class="panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'cover2' ), $id ) . '</span></section>';
 	}
}

/**
 * Custom Active Callback to check for page.
 */
function cover2_is_page() {
	return ( is_front_page() && is_page() );
}

/**
 * Helper function for Gutenberg/WP5.0 parse_blocks function
 */
function cover2_parse_blocks( $content ) {
	// If the Gutenberg plugin is installed
	if ( function_exists( 'gutenberg_parse_blocks' ) ) :
		return gutenberg_parse_blocks( $content );
	// If WordPress is upgraded to 5.0
	elseif ( function_exists( 'parse_blocks' ) ) :
		return parse_blocks( $content );
	else :
		return;
	endif;
}

/**
 * Extract and return the first blockquote from content.
 */
function cover2_get_blockquote_in_content() {
	remove_filter( 'the_content', 'cover2_remove_blockquote_from_content' );

	$content = apply_filters( 'the_content', get_the_content() );

	add_filter( 'the_content', 'cover2_remove_blockquote_from_content' );

	if ( preg_match( '/<blockquote(.*)>(.+?)<\/blockquote>/is', $content, $matches ) ) :
		return $matches[0];
	else :
		return false;
	endif;
}

function cover2_remove_blockquote_from_content( $content ) {
	if ( 'quote' !== get_post_format() ) :
		return $content;
	endif;

	$content = preg_replace( '/<blockquote(.*)>(.+?)<\/blockquote>/is', '', $content, 1 );

	return $content;
}
add_filter( 'the_content', 'cover2_remove_blockquote_from_content' );
