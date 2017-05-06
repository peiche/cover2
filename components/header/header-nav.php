<?php
/**
 * The template for displaying header nav buttons.
 *
 * @package Cover2
 */

$has_sidebar = false;
if ( is_active_sidebar( 'sidebar-overlay' ) || has_nav_menu( 'top' ) || has_nav_menu( 'jetpack-social-menu' ) ) :
	$has_sidebar = true; ?>
	<button class="nav-toggle menu-toggle" aria-label="toggle menu" aria-expanded="false">
		<svg id="svg-icon-menu-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1536 1792">
			<g id="svg-icon-menu-close" style="display: none;">
				<path d="M1298 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"/>
			</g>
			<g id="svg-icon-menu">
				<path d="M1536 1344v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19h-1408q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45z"/>
			</g>
		</svg>
	</button>
<?php endif;

$search_button_class = '';
if ( $has_sidebar ) :
	$search_button_class = ' has-sidebar';
endif;
?>

<button type="button" class="nav-toggle search-toggle<?php echo $search_button_class; ?>" aria-label="toggle search" aria-expanded="false">
	<svg id="svg-icon-search-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1536 1792">
		<g id="svg-icon-search-close" style="display: none;">
			<path d="M1298 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"/>
		</g>
		<g id="svg-icon-search">
			<path d="M1152 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/>
		</g>
	</svg>
</button>

<?php if ( is_object( $post ) && has_shortcode( $post->post_content, 'aesop_chapter' ) ) : ?>

<button type="button" class="nav-toggle chapter-toggle" aria-label="toggle chapter list" aria-expanded="false">
	<svg id="svg-icon-bookmark-icon" class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1536 1792">
		<g id="svg-icon-bookmark-close" style="display: none;">
			<path d="M1298 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"/>
		</g>
		<g id="svg-icon-bookmark">
			<path d="M1164 128q23 0 44 9 33 13 52.5 41t19.5 62v1289q0 34-19.5 62t-52.5 41q-19 8-44 8-48 0-83-32l-441-424-441 424q-36 33-83 33-23 0-44-9-33-13-52.5-41t-19.5-62v-1289q0-34 19.5-62t52.5-41q21-9 44-9h1048z"/>
		</g>
	</svg>
</button>

<?php endif; ?>
