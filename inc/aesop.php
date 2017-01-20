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
