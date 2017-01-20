<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cover2
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<div class="page-header__content">
			<h1 class="page-title text-align-center"><?php esc_html_e( 'Nothing Found', 'cover2' ); ?></h1>
		</div>
	</header>
	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php /* translators: %s: New post link */ ?>
			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cover2' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cover2' ); ?></p>
			<?php

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cover2' ); ?></p>
			<?php

		endif; ?>
	</div>
</section><!-- .no-results -->
