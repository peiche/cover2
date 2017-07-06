<?php
/**
 * Aesop Story Engine Compatibility File
 *
 * @package Cover2
 */

 /**
  * Override the font size unit
  */
function cover2_quote_size_unit() {
  return 'rem';
}
add_filter( 'aesop_quote_size_unit', 'cover2_quote_size_unit' );

function cover2_content_overlay() {
    echo '<div class="aesop-content-darken"></div>';
    return;
}
add_action('aesop_cbox_content_inside_top', 'cover2_content_overlay');
