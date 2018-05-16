<?php
/**
 * The template for displaying Featured Content
 *
 * @package Cover2
 */

$featured_posts = cover2_get_featured_posts();
if ( empty( $featured_posts ) ) {
    return;
}
?>

<div id="featured-content" class="featured-content no-js">
    <div class="featured-content--inner">
      <?php
      foreach ( $featured_posts as $post ) {
        setup_postdata( $post );
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-header featured-content--slide' ); ?>>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="featured-link"></a>
        <div class="page-header__image"></div>
        <div class="page-header__content">
          <header class="entry-header text-align-center">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
          </header>

          <?php if ( has_excerpt() ) : ?>
    				<hr>
    				<div class="entry-excerpt">
    					<?php the_excerpt(); ?>
    				</div>
    			<?php endif; ?>

        </div>
      </article>

      <?php
      }

      wp_reset_postdata();
      ?>
    </div>
</div>
