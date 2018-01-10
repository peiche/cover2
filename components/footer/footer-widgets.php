<?php
/**
 * The template for displaying footer widgets.
 *
 * @package Cover2
 */

?>

<?php if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
    <div class="footer-widgets">
        <div class="container">
            
            <?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
                <div class="col-3">
                    <?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
                <div class="col-3">
                    <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
                <div class="col-3">
                    <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
<?php endif; ?>
