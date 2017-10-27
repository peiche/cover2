<?php
/**
 * Components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cover2
 */

if ( ! function_exists( 'cover2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * This function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cover2_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'cover2' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cover2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'cover2-featured-image', 1600, 9999 );
	add_image_size( 'cover2-large', 2000, 1500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top'		=> esc_html__( 'Top Menu', 'cover2' ),
		'mini'	=> esc_html__( 'Mini Menu', 'cover2' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'video',
		'audio',
		'quote',
		'aside',
		'link',
		'chat',
		'status',
	) );

	/*
	 * Enable support for widget selective refresh.
	 * See https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for the Gutenberg editor.
	 * See http://gutenberg-devdoc.surge.sh/reference/theme-support/
	 */
	add_theme_support( 'gutenberg', array(
		'wide-images' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'cover2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * We're giving it an extra large size to accommodate large screens.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cover2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cover2_content_width', 1600 );
}
add_action( 'after_setup_theme', 'cover2_content_width', 0 );

/**
 * Register custom fonts.
 */
function cover2_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$monserrat = _x( 'on', 'Montserrat font: on or off', 'cover2' );
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'cover2' );
	$source_code_pro = _x( 'on', 'Source Code Pro font: on or off', 'cover2' );

	if ( 'off' !== $monserrat && 'off' !== $open_sans && 'off' !== $source_code_pro ) {
		$font_families = array();

		$font_families[] = 'Montserrat|Open+Sans:300,300i,600|Source+Code+Pro:300';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Cover2 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function cover2_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'cover2-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'cover2_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cover2_widgets_init() {
	// Overlay widgets.
	register_sidebar( array(
		'name'          => esc_html__( 'Overlay', 'cover2' ),
		'id'            => 'sidebar-overlay',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'cover2' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cover2_widgets_init' );

/**
 * Display custom color CSS.
 */
function cover2_colors_css_wrap() {
	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'accent_color', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo cover2_custom_colors_css(); ?>
	</style>
	<meta name="theme-color" content="hsl(<?php echo $hue; ?>, 75%, 50%)">
<?php }
add_action( 'wp_head', 'cover2_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function cover2_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'cover2-fonts', cover2_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_register_style( 'cover2-style', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) );
	wp_enqueue_style( 'cover2-style' );

	wp_enqueue_script( 'cover2-headroom', get_template_directory_uri() . '/dist/js/headroom.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/dist/js/headroom.min.js' ), true );

	wp_enqueue_script( 'cover2-morpheus-svg', get_template_directory_uri() . '/dist/js/svg-morpheus.js', array(), filemtime( get_template_directory() . '/dist/js/svg-morpheus.js' ), true );

	wp_enqueue_script( 'cover2-main', get_template_directory_uri() . '/dist/js/main.js', array( 'jquery' ), filemtime( get_template_directory() . '/dist/js/main.js' ), true );
	wp_localize_script( 'cover2-main', 'menuToggleText', array(
		'open'   => esc_html__( 'Open child menu', 'cover2' ),
		'close'  => esc_html__( 'Close child menu', 'cover2' ),
		'icon'   => cover2_get_svg( array( 'icon' => 'icon_bg_angle-down', 'fallback' => true ) ),
	) );

	wp_enqueue_script( 'cover2-navigation', get_template_directory_uri() . '/dist/js/navigation.js', array(), filemtime( get_template_directory() . '/dist/js/navigation.js' ), true );

	wp_enqueue_script( 'cover2-skip-link-focus-fix', get_template_directory_uri() . '/dist/js/skip-link-focus-fix.js', array(), filemtime( get_template_directory() . '/dist/js/skip-link-focus-fix.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( cover2_has_multiple_featured_posts() ) {
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/dist/js/jquery.flexslider-min.js', array( 'jquery' ), filemtime( get_template_directory() . '/dist/js/jquery.flexslider-min.js' ), true );
		wp_enqueue_script( 'cover2-flexslider', get_template_directory_uri() . '/dist/js/flexslider.js', array( 'flexslider' ), filemtime( get_template_directory() . '/dist/js/flexslider.js' ), true );
	}

	// Featured Video Plus plugin compatibility.
	if ( function_exists( 'has_post_video' ) && has_post_video() ) {
		wp_enqueue_script( 'vimeo', get_template_directory_uri() . '/dist/js/player.min.js', array(), filemtime( get_template_directory() . '/dist/js/player.min.js' ), true );
		wp_enqueue_script( 'cover2-featured-video-plus', get_template_directory_uri() . '/dist/js/featured-video-plus.js', array(), filemtime( get_template_directory() . '/dist/js/featured-video-plus.js' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'cover2_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Load Aesop Story Engine compatibility.
 */
require get_template_directory() . '/inc/aesop.php';

/**
 * Load Algolia compatibility.
 */
require get_template_directory() . '/inc/algolia.php';
