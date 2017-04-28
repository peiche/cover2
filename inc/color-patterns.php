<?php
/**
 * Cover2: Color Patterns
 *
 * @package Cover2
 * @since 1.0
 */

 /**
  * Generate the CSS for the current custom color scheme.
  */
  function cover2_custom_colors_css() {
   $header_color = get_theme_mod( 'header_color', '#4020df' );
  	$hue = absint( get_theme_mod( 'accent_color', 250 ) );
  	$header_text_color = '#fff';
  	if ( hexdec( $header_color ) > 0xffffff / 2 ) :
  	  $header_text_color = '#404040';
  	endif;

  	/**
  	 * Filter Cover2 default saturation level.
  	 *
  	 * @since Cover2 1.0
  	 *
  	 * @param $saturation integer
  	 */
  	$css = '
  /**
   * Cover2: Color Patterns
   */

   .site-header.headroom.headroom--not-top {
     background-color: ' . $header_color . ';
     color: ' . $header_text_color . ';
   }
   .headroom--not-top .site-description,
   .headroom--not-top .site-title a:hover,
   .headroom--not-top .mini-menu-container a:hover {
     border-color: ' . $header_text_color . ';
   }
   .headroom--not-top .chapter-toggle:before {
     border-color: ' . $header_text_color . ' ' . $header_text_color . ' transparent;
   }
   
   .site-header,
   .blog .site-header.headroom.headroom--top,
   .page-header,
   .comment-navigation .nav-previous a,
   .comment-navigation .nav-next a,
   .posts-navigation .nav-previous a,
   .posts-navigation .nav-next a {
     background-color: hsl(' . $hue . ', 75%, 50%);
   }
   .comment-navigation .nav-previous a:hover,
   .comment-navigation .nav-next a:hover,
   .posts-navigation .nav-previous a:hover,
   .posts-navigation .nav-next a:hover {
     background-color: hsl(' . $hue . ', 75%, 40%);
   }
   a,
   .calendar_wrap tbody a,
   .entry-title a:hover {
     color: hsl(' . $hue . ', 75%, 50%);
   }
   a:hover,
   a:focus,
   a:active,
   .calendar_wrap tbody a:hover {
     color: hsl(' . $hue . ', 75%, 40%);
   }
   .comment-navigation .nav-previous a,
   .comment-navigation .nav-next a,
   .posts-navigation .nav-previous a,
   .posts-navigation .nav-next a,
   .entry-content > blockquote {
     border-color: hsl(' . $hue . ', 75%, 50%);
   }
   .comment-navigation .nav-previous a:hover,
   .comment-navigation .nav-next a:hover,
   .posts-navigation .nav-previous a:hover,
   .posts-navigation .nav-next a:hover {
     border-color: hsl(' . $hue . ', 75%, 40%);
   }

   button.default,
   input[type="button"].default,
   input[type="reset"].default,
   input[type="submit"].default,
   .button.default {
     border-color: hsl(' . $hue . ', 75%, 50%);
     color: hsl(' . $hue . ', 75%, 50%);
   }
   button.default:hover,
   input[type="button"].default:hover,
   input[type="reset"].default:hover,
   input[type="submit"].default:hover,
   .button.default:hover {
     background-color: hsl(' . $hue . ', 75%, 40%);
     border-color: hsl(' . $hue . ', 75%, 40%);
   }
   .page-links > a,
   .entry-content .page-links > a {
     color: hsl(' . $hue . ', 75%, 50%);
     border-color: hsl(' . $hue . ', 75%, 50%);
   }
   .page-links > a:hover,
   .entry-content .page-links > a:hover {
     background-color: hsl(' . $hue . ', 75%, 50%);
     border-color: hsl(' . $hue . ', 75%, 50%);
   }
   .infinite-loader .spinner {
	   border-top-color: hsl(' . $hue . ', 75%, 50%);
   }
   ';

  /**
   * Filters Cover2 custom colors CSS.
   *
   * @since Cover2 1.0
   *
   * @param $css        string Base theme colors CSS.
   * @param $hue        int    The user's selected color hue.
   * @param $saturation string Filtered theme color saturation level.
   */
  return apply_filters( 'cover2_custom_colors_css', $css, $hue );
}
