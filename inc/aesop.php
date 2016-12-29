<?php
/**
 * Aesop Story Engine Compatibility File
 *
 * @package ReCover
 */

 /**
  * Override the font size unit
  */
 function recover_quote_size_unit() {
 	return 'rem';
 }
  add_filter( 'aesop_quote_size_unit', 'recover_quote_size_unit' );
