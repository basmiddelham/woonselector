<?php
/**
 * Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package strt
 */


if ( ! defined( 'STRT_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'STRT_VERSION', '1.0.1' );
}

if ( ! function_exists( 'strt_setup' ) ) :
	function strt_setup() {
		load_theme_textdomain( 'strt', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/**
		 * Enable features from Soil when plugin is activated
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support('soil', [
			'clean-up',
			// 'disable-rest-api',
			'disable-asset-versioning',
			'disable-trackbacks',
			// 'google-analytics' => 'UA-XXXXX-Y',
			'js-to-footer',
			'nav-walker',
			'nice-search',
			'relative-urls'
		]);


		register_nav_menus(
			array(
				'primary_navigation' => esc_html__( 'Primary', 'strt' ),
				'social' => __('Social Menu', 'strt')
			)
		);

		// Add Image sizes
		add_image_size('three_natural', 260, 9999);
		add_image_size('three_wide', 260, 146.25, true);
		add_image_size('three_square', 260, 260, true);

		add_image_size('four_natural', 360, 9999);
		add_image_size('four_wide', 360, 202.5, true);
		add_image_size('four_square', 360, 360, true);

		add_image_size('six_natural', 560, 9999);
		add_image_size('six_wide', 560, 315, true);
		add_image_size('six_square', 560, 560, true);

		add_image_size('eight_natural', 760, 9999);
		add_image_size('eight_wide', 760, 427.5, true);

		add_image_size('nine_natural', 860, 9999);
		add_image_size('nine_wide', 860, 483.75, true);

		add_image_size('twelve_natural', 1160, 9999);
	}
endif;
add_action( 'after_setup_theme', 'strt_setup' );

/**
 * Make Custom Image Sizes Selectable in Admin
 */
add_filter('image_size_names_choose', function ($sizes) {
    return array_merge($sizes, array(
        'three_natural'  => '1/4',
        'three_wide'     => '1/4 Wide',
        'three_square'   => '1/4 Square',
        'four_natural'   => '1/3',
        'four_wide'      => '1/3 Wide',
        'four_square'    => '1/3 Square',
        'six_natural'    => '1/2',
        'six_wide'       => '1/2 Wide',
        'six_square'     => '1/2 Square',
        'twelve_natural' => '1/1',
    ));
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function strt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'strt_content_width', 1160 );
}
add_action( 'after_setup_theme', 'strt_content_width', 0 );

/**
 * Register widget area.
 */
function strt_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'strt' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'strt' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'strt_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function strt_scripts() {
	// Create translatable strings for navigation
	$strt_l10n['expand']   = __('Expand submenu', 'strt');
	$strt_l10n['collapse'] = __('Collapse submenu', 'strt');

	// Enqueue styles
	wp_enqueue_style( 'strt-stylesheet', get_stylesheet_directory_uri() . '/dist/css/styles.css', array(), STRT_VERSION );

	// Enqueue scripts
	wp_enqueue_script( 'strt-scripts', get_template_directory_uri() . '/dist/js/scripts.js', array( 'jquery' ), STRT_VERSION, true );

	// Enqueue Isotope
	wp_enqueue_script( 'strt-isotope', '//npmcdn.com/isotope-layout@3/dist/isotope.pkgd.min.js', array( 'jquery' ), STRT_VERSION );

	// Pass translatable strings to script
	wp_localize_script('strt-scripts', 'ScreenReaderText', $strt_l10n);

	// Load comment-reply]
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'strt_scripts' );

// Remove jQuery migrate
function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		// Check whether the script has any dependencies
		if ( $script->deps ) { 
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/**
 * Load Cutom Post Types.
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Snippets for this theme.
 */
require get_template_directory() . '/inc/snippets.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load SVG Icon system.
 */
require get_template_directory() . '/inc/icons.php';

/**
 * Load custom TinyMCE setting.
 */
require get_template_directory() . '/inc/tinymce.php';

/**
 * Load Flexbuilder file.
 */
require_once('vendor/stoutlogic/acf-builder/autoload.php');
require get_template_directory() . '/fields/flexbuilder.php';
