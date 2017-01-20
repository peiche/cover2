<?php
/**
 * The template for displaying Author bios
 *
 * @package Cover2
 */

?>

<div class="profile">
	<div class="profile-avatar">
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', 'Profile Picture for ' . esc_html( get_the_author() ) ); ?></a>
	</div>

  <div class="profile-info">
    <h4 class="profile-name"><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h4>
  </div>
	<div class="profile-bio">
		<?php the_author_meta( 'description' ); ?>
	</div>
</div>
