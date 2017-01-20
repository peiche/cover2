<?php
/**
 * Template for displaying search forms in Cover2
 *
 * @package Cover2
 * @since 1.0
 * @version 1.0
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'cover2' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'cover2' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
</form>
