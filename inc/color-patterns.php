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
   .headroom--not-top .mini-menu-container .menu > .menu-item.button.ghost:not(.default) a {
    border-color: ' . $header_text_color . ';
    color: ' . $header_text_color . ';
   }
   .headroom--not-top .mini-menu-container .menu > .menu-item.button.ghost:not(.default) a:hover {
    border-color: ' . $header_text_color . ';
    background-color: ' . $header_text_color . ';
    color: ' . ( ( hexdec( $header_color ) > 0xffffff / 2 ) ? '#fff' : '#404040' ) . ';
   }
   .site-header,
   .blog .site-header.headroom.headroom--top,
   body:not(.has-featured-image) .page-header {
     background-color: hsl(' . $hue . ', 75%, 50%);
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
   .entry-content > blockquote {
     border-color: hsl(' . $hue . ', 75%, 50%);
   }
   button.default,
   input[type="button"].default,
   input[type="reset"].default,
   input[type="submit"].default,
   .button.default:not(.menu-item),
   .page-header .button.default,
   .entry-content .wp-block-button.default .wp-block-button__link,
   .entry-content .wp-block-button .wp-block-button__link.has-accent-background-color,
   .mini-menu-container .menu > .menu-item.button.default > a,
   .menu .menu-item.button.default > a,
   .comment-navigation .nav-next a,
   .posts-navigation .nav-next a,
   .entry-summary .page-links > a,
   .entry-content .page-links > a,
   .site-main #infinite-handle span,
   .aesop-story-collection .aesop-collection-load-more {
     border-color: hsl(' . $hue . ', 75%, 50%);
     background-color: hsl(' . $hue . ', 75%, 50%);
   }
   button.default:not(.menu-item):hover,
   input[type="button"].default:hover,
   input[type="reset"].default:hover,
   input[type="submit"].default:hover,
   .button.default:not(.menu-item):hover,
   .page-header .button.default:hover,
   .entry-content .wp-block-button.default .wp-block-button__link:hover,
   .entry-content .wp-block-button .wp-block-button__link.has-accent-background-color:hover,
   .mini-menu-container .menu > .menu-item.button.default > a:hover,
   .menu .menu-item.button.default > a:hover,
   .comment-navigation .nav-next a:hover,
   .posts-navigation .nav-next a:hover,
   .entry-summary .page-links > a:hover,
   .entry-content .page-links > a:hover,
   .site-main #infinite-handle span:hover,
   .aesop-story-collection .aesop-collection-load-more:hover {
     background-color: hsl(' . $hue . ', 75%, 40%);
     border-color: hsl(' . $hue . ', 75%, 40%);
   }
   button.default.ghost,
   input[type="button"].default.ghost,
   input[type="reset"].default.ghost,
   input[type="submit"].default.ghost,
   .button.default.ghost:not(.menu-item),
   .page-header .button.default.ghost,
   .entry-content .wp-block-button.default.ghost .wp-block-button__link,
   .mini-menu-container .menu > .menu-item.button.default.ghost > a,
   .menu .menu-item.button.ghost.default > a {
     border-color: hsl(' . $hue . ', 75%, 50%);
     color: hsl(' . $hue . ', 75%, 50%);
   }
   
   .entry-content .wp-block-button .wp-block-button__link.has-accent-color {
    color: hsl(' . $hue . ', 75%, 50%);
   }
   .entry-content .wp-block-button .wp-block-button__link.has-accent-color:hover {
    color: hsl(' . $hue . ', 75%, 40%);
   }
   
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color:active,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color:focus {
    color: hsl(' . $hue . ', 75%, 50%);
   }
   
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color:hover,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color:active:hover {
    color: hsl(' . $hue . ', 75%, 40%);
   }
   
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-background-color,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-background-color:active,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-background-color:focus {
    background-color: transparent;
    border-color: hsl(' . $hue . ', 75%, 50%);
   }
   
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-background-color:hover,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-background-color:active:hover {
    background-color: hsl(' . $hue . ', 75%, 40%);
    border-color: hsl(' . $hue . ', 75%, 40%);
   }
   
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color.has-background:hover,
   .entry-content .wp-block-button.is-style-outline .wp-block-button__link.has-accent-color.has-background:active:hover {
    color: #fff;
   }
   
   button.default.ghost:active,
   button.default.ghost:focus,
   input[type="button"].default.ghost:active,
   input[type="button"].default.ghost:focus,
   input[type="reset"].default.ghost:active,
   input[type="reset"].default.ghost:focus,
   input[type="submit"].default.ghost:active,
   input[type="submit"].default.ghost:focus,
   .button.default.ghost:not(.menu-item):active,
   .button.default.ghost:not(.menu-item):focus,
   .page-header .button.default.ghost:active,
   .page-header .button.default.ghost:focus,
   .entry-content .wp-block-button.default.ghost .wp-block-button__link:active,
   .entry-content .wp-block-button.default.ghost .wp-block-button__link:focus,
   .mini-menu-container .menu > .menu-item.button.default.ghost > a:active,
   .mini-menu-container .menu > .menu-item.button.default.ghost > a:focus,
   .menu .menu-item.button.ghost.default > a:active,
   .menu .menu-item.button.ghost.default > a:focus {
    color: hsl(' . $hue . ', 75%, 50%);
   }
   button.default.ghost:hover,
   input[type="button"].default.ghost:hover,
   input[type="reset"].default.ghost:hover,
   input[type="submit"].default.ghost:hover,
   .button.default.ghost:not(.menu-item):hover,
   .page-header .button.default.ghost:hover,
   .entry-content .wp-block-button.default.ghost .wp-block-button__link:hover,
   .mini-menu-container .menu > .menu-item.button.default.ghost > a:hover,
   .menu .menu-item.button.ghost.default > a:hover {
     background-color: hsl(' . $hue . ', 75%, 50%);
     border-color: hsl(' . $hue . ', 75%, 50%);
     color: #fff;
   }
   .infinite-loader .spinner {
	   border-top-color: hsl(' . $hue . ', 75%, 50%);
   }
   .fotorama__thumb-border {
    border-color: hsl(' . $hue . ', 75%, 50%);
   }
   .footer-accent .site-footer {
    background-color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-hierarchical-menu--item__active .ais-hierarchical-menu--link,
   .ais-menu--item__active .ais-menu--link {
    background-color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-menu--item__active .ais-menu--count,
   .ais-hierarchical-menu--item__active .ais-hierarchical-menu--count {
    color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-menu--count,
   .ais-hierarchical-menu--count,
   .ais-refinement-list--count {
    background-color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-refinement-list--checkbox:checked ~ .ais-refinement-list--label::before {
    background-color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-pagination--item__active .ais-pagination--link {
    background-color: hsl(' . $hue . ', 75%, 50%);
    border-color: hsl(' . $hue . ', 75%, 50%);
   }
   .ais-pagination--item__active .ais-pagination--link:hover {
    background-color: hsl(' . $hue . ', 75%, 40%);
    border-color: hsl(' . $hue . ', 75%, 40%);
   }
   .icon-accent .svg-icon use {
    stroke: hsl(' . $hue . ', 75%, 50%);
   }
   p.has-accent-background-color {
    background-color: hsl(' . $hue . ', 75%, 50%);
   }
   p.has-accent-color {
    color: hsl(' . $hue . ', 75%, 50%);
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
