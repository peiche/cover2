<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ReCover
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<div class="page-header__content">
			<h1 class="page-title text-align-center"><?php esc_html_e( 'Nothing Found', 'recover' ); ?></h1>
		</div>
	</header>
	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php /* translators: %s: New post link */ ?>
			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'recover' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'recover' ); ?></p>
			<?php

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'recover' ); ?></p>
			<?php

		endif; ?>
	</div>
</section><!-- .no-results -->
