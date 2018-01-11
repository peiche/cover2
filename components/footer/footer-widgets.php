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
            
            <div class="col-3">
                <?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
                <?php endif; ?>
            </div>
            
            <div class="col-3">
                <?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
                <?php endif; ?>
            </div>
            
            <div class="col-3">
                <?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
<?php endif; ?>
