<?php
/**
 * PToys functions and definitions
 */

/**
 * PToys only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'ptoys_setup' ) ) :

function ptoys_setup() {

	load_theme_textdomain( 'ptoys', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' =>        __( 'Main Menu', 'ptoys' ),
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
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
}
endif; // ptoys_setup
add_action( 'after_setup_theme', 'ptoys_setup' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 */
function ptoys_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ptoys_content_width', 840 );
}
add_action( 'after_setup_theme', 'ptoys_content_width', 0 );


/**
 * Registers a widget area.
 */
function ptoys_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ptoys' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'ptoys' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ptoys_widgets_init' );


if ( ! function_exists( 'ptoys_fonts_url' ) ) :
/**
 * Register Google fonts for PToys.
 */
function ptoys_fonts_url() {
	$fonts_url = 'https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic';
	return $fonts_url;
}
endif;

/**
 * Enqueues scripts and styles.
 */
function ptoys_scripts() {

	// Add Bootstrap, used in the main stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap-theme.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/vendor/bxslider/jquery.bxslider.css', array(), '20160114' );

	// Theme stylesheet.
	wp_enqueue_style( 'ptoys-style', get_stylesheet_uri() );
    wp_enqueue_style( 'ptoys-responsive', get_template_directory_uri() . '/css/style-responsive.css', array( 'ptoys-style' ) );

	// Load the html5 shiv.
	wp_enqueue_script( 'ptoys-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'ptoys-html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'ptoys-jquery-slider', get_template_directory_uri() . '/js/slides.min.jquery.js', array(), '20160114' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_script( 'ptoys-bxslider', get_template_directory_uri() . '/vendor/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '20160114', true );
    wp_enqueue_script( 'ptoys-bootstrap', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    wp_enqueue_script( 'ptoys-maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.js', array( 'jquery' ), '20160114', true );
    wp_enqueue_script( 'ptoys-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160114', true );

}
add_action( 'wp_enqueue_scripts', 'ptoys_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'ptoys_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'ptoys_wrapper_end', 10);

function ptoys_wrapper_start() {
    echo '<section id="main">';
}

function ptoys_wrapper_end() {
    echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'ptoys_override_checkout_fields' );
function ptoys_override_checkout_fields( $address_fields ) {

    $address_fields['address_1']['required'] = false;
    $address_fields['address_1']['placeholder'] = 'Город, улица и т.д.';

    unset($address_fields['country']);
    unset($address_fields['last_name']);
    unset($address_fields['company']);
    unset($address_fields['address_2']);
    unset($address_fields['city']);
    unset($address_fields['state']);
    unset($address_fields['postcode']);

    return $address_fields;
}

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'ptoys_override_checkout_billing_fields' );
function ptoys_override_checkout_billing_fields( $fields ) {

    $fields['billing']['billing_email']['required'] = false;
    return $fields;
}