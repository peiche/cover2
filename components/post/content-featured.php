<?php
/**
 * The template for displaying Featured Content
 *
 * @package ReCover
 */
$featured_posts = recover_get_featured_posts();
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
        <div class="page-header__image"></div>
        <div class="page-header__content">
          <header class="entry-header text-align-center">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
          </header>

          <?php if ( has_excerpt() ) : ?>
    				<hr>
    				<div class="entry-excerpt">
    					<?php echo the_excerpt(); ?>
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
