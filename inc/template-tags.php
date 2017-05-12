<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cover2
 */

if ( ! function_exists( 'cover2_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cover2_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' .
		get_avatar( get_the_author_meta( 'ID' ), 35, '', 'Profile Picture for ' . esc_html( get_the_author() ) ) .
		'<span class="author-text">' . esc_html( get_the_author() ) . '</span></a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span> &mdash; <span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'cover2_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cover2_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'cover2' ) );
		if ( $categories_list && cover2_categorized_blog() ) {
			printf( '<div class="cat-links">' . cover2_get_svg( array( 'icon' => 'icon_bg_folder', 'title' => __( 'Categories', 'cover2' ) ) ) . $categories_list . '</div>' ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'cover2' ) );
		if ( $tags_list ) {
			if ( count( get_tags() ) > 1 ) {
				$tag_str = 'icon_bg_tags';
			} else {
				$tag_str = 'icon_bg_tag';
			}
			printf( '<div class="tags-links">' . cover2_get_svg( array( 'icon' => $tag_str, 'title' => __( 'Tags', 'cover2' ) ) ) . $tags_list . '</div>' ); // WPCS: XSS OK.
		}
	}
	if ( 'jetpack-portfolio' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', esc_html__( ', ', 'cover2' ) );
		if ( $categories_list && cover2_categorized_blog() ) {
			printf( '<div class="cat-links">' . cover2_get_svg( array( 'icon' => 'icon_bg_folder', 'title' => __( 'Categories', 'cover2' ) ) ) . $categories_list . '</div>' ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', esc_html__( ', ', 'cover2' ) );
		if ( $tags_list ) {
			$tag_str = 'icon_bg_tag';
			if ( count( wp_get_post_terms( get_the_ID(), 'jetpack-portfolio-tag' ) ) > 1 ) {
				$tag_str = 'icon_bg_tags';
			}
			printf( '<div class="tags-links">' . cover2_get_svg( array( 'icon' => $tag_str, 'title' => __( 'Tags', 'cover2' ) ) ) . $tags_list . '</div>' ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'cover2' ), esc_html__( '1 Comment', 'cover2' ), esc_html__( '% Comments', 'cover2' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'cover2' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<div class="edit-link">' . cover2_get_svg( array( 'icon' => 'icon_bg_pencil', 'title' => __( 'Edit Post', 'cover2' ) ) ),
		'</div>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cover2_categorized_blog() {
	$all_the_cool_cats = get_transient( 'cover2_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cover2_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cover2_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cover2_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cover2_categorized_blog.
 */
function cover2_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cover2_categories' );
}
add_action( 'edit_category', 'cover2_category_transient_flusher' );
add_action( 'save_post',     'cover2_category_transient_flusher' );
