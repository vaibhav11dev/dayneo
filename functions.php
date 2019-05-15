<?php
/**
 * bigbo functions and definitions
 *
 *
 * @package bigbo
 */
define( 'BIGBO_PHP_INCLUDE', get_template_directory() . '/includes/' );
define( 'BIGBO_PHP_LIB', get_template_directory() . '/lib/' );
define( 'BIGBO_VERSION', '1.0.0' );

/**
 * Enqueue scripts and styles.
 */
function bigbo_scripts() {
    wp_enqueue_style( 'bigbo-style', get_stylesheet_uri() );

    //Bootstrap Core CSS
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    //Icon Fonts
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css' );

    //Plugins
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
    wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css' );

    //Theme Core CSS
    wp_enqueue_style( 'ddmain', get_template_directory_uri() . '/assets/css/ddmain.css' );
    wp_enqueue_style( 'ddmedia', get_template_directory_uri() . '/assets/css/ddmedia.css' );
    wp_enqueue_style( 'dynamic-style', get_template_directory_uri() . '/assets/css/dynamic.css' );

    //Theme Dynamic CSS
    $bigbo_dynamic_css = '';
    require_once( get_template_directory() . '/assets/css/dynamic-css.php' );
    wp_add_inline_style( 'dynamic-style', $bigbo_dynamic_css );

    //JAVASCRIPT FILES
    wp_enqueue_script( 'jquery' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), BIGBO_VERSION, true );
    wp_enqueue_script( 'ddcore', get_template_directory_uri() . '/assets/js/ddcore.min.js', array( 'jquery' ), BIGBO_VERSION, true );
    wp_enqueue_script( 'ddmain', get_template_directory_uri() . '/assets/js/ddmain.js', array( 'jquery' ), BIGBO_VERSION, true );
    wp_enqueue_script( 'bigbo-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/slick/slick.min.js', array( 'jquery' ), '1.0', true );

    $menu_extras = bigbo_get_option( 'menu_extras' );
    $header_type = bigbo_get_option( 'dd_header_type' );
    wp_localize_script( 'ddmain', 'bigboData', array(
        'ajax_url'            => admin_url( 'admin-ajax.php' ),
        'nonce'               => wp_create_nonce( '_bigbo_nonce' ),
        'search_content_type' => bigbo_get_option( 'search_content_type' ),
        'ajax_search'         => intval( bigbo_get_option( 'header_ajax_search' ) ),
        'headerbar_on' => $menu_extras[ 'headerbar' ], 
        'headercart_on' => $menu_extras[ 'cart' ],
        'headertype' => $header_type,
    ) );
}

add_action( 'wp_enqueue_scripts', 'bigbo_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function bigbo_adminscripts( $hook ) {
    if ( $hook == 'toplevel_page_bigbo-menu' || $hook == 'bigbo_page_bigbo_demos' || $hook == 'appearance_page_bigbo_options' || $hook == 'bigbo_page_ved-settings' ) {
        wp_enqueue_style( 'admincss', get_template_directory_uri() . '/admin/assets/css/admin_css.css', '', '' );

        wp_enqueue_style( 'font-awesomecss', get_template_directory_uri() . '/assets/css/font-awesome.min.css', '', '4.7.0' );
    }

    if ( $hook == 'appearance_page_bigbo_options' ) {
        wp_enqueue_style( 'themeoptions', get_template_directory_uri() . '/themeoptions/options/css/themeoptions.css', false, 398 );

        wp_enqueue_script( 'theme-options-menu-mod', get_template_directory_uri() . '/themeoptions/options/js/theme-options-menu-mod.js', '', '', true );
    }

    wp_enqueue_script( 'adminjs', get_template_directory_uri() . '/admin/assets/js/admin_script.js', array( 'jquery' ), '' );
    wp_localize_script( 'adminjs', 'js_strings', array(
        'ajaxurl'            => admin_url( 'admin-ajax.php' ),
        'select_demo_notice' => __( 'select demo', 'bigbo' ),
    ) );

    wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );

    wp_enqueue_style( 'jquery-ui-datepicker' );

    wp_enqueue_script( 'jquery-ui-dialog' );

    /*
     * mega menu icon picker 
     */
//	if ( $hook == 'nav-menus.php' || $hook == 'appearance_page_bigbo_options' ) {
//		wp_enqueue_script( 'iconpicker', get_template_directory_uri() . '/assets/iconpicker/fontawesome-iconpicker.js', array(), '', true, 'all' );
//
//		wp_enqueue_style( 'colorpickercss', get_template_directory_uri() . '/assets/iconpicker/fontawesome-iconpicker.css', array(), '', 'all' );
//	}
}

add_action( 'admin_enqueue_scripts', 'bigbo_adminscripts' );

// Multiple Sidebars
require_once( BIGBO_PHP_INCLUDE . 'multiple_sidebars.php' );

// load Widget functions
require_once( BIGBO_PHP_INCLUDE . 'widgets.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once( BIGBO_PHP_INCLUDE . 'functions/template-functions.php');

/**
 * Functions which enhance the basic theme functionality. 
 */
require_once( BIGBO_PHP_INCLUDE . 'functions/basic-functions.php');
require_once( BIGBO_PHP_INCLUDE . 'functions/header-functions.php');

//  ThemeVedanta Mega Menu
require_once( BIGBO_PHP_INCLUDE . 'mega-menu-framework.php' );

// Primary Menu
require_once( BIGBO_PHP_INCLUDE . 'bigbo-nav-menu.php' );

/**
 * WooCommerce configuration file
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    include_once( BIGBO_PHP_INCLUDE . 'woo-config.php' );
}

/**
 * Initialize theme admin dashboard
 */
if ( current_user_can( 'manage_options' ) ) {
    require_once( get_template_directory() . '/admin/bigbo-menu-panel.php' );
}

/**
 * Initialize Theme Options
 */
require_once( get_template_directory() . '/themeoptions/framework.php');
require_once( get_template_directory() . '/themeoptions/options.php');
require_once( get_template_directory() . '/themeoptions/options/vedanta_extension.php');

// TGMPA Library
require_once( BIGBO_PHP_LIB . 'tgmpa/register-plugins.php' );

// Metaboxes
require_once( BIGBO_PHP_INCLUDE . 'metaboxes/metaboxes.php' );

// load Semantic Classes functions
require_once( BIGBO_PHP_INCLUDE . 'extensions/semantic-classes.php' );

// Portfolio
require_once( BIGBO_PHP_INCLUDE . 'extensions/post-link-plus.php' );

// load the WP bigbo Hook System
require_once( BIGBO_PHP_INCLUDE . 'functions/hooks.php' );

// load comment functions
require_once( BIGBO_PHP_INCLUDE . 'functions/comment-functions.php' );

// load pluggable functions
require_once( BIGBO_PHP_INCLUDE . 'functions/pluggable.php' );

require_once( BIGBO_PHP_INCLUDE . 'functions/custom-header.php' );

require_once( BIGBO_PHP_INCLUDE . 'functions/template-tags.php' );

require_once( BIGBO_PHP_INCLUDE . 'functions/customizer.php' );

if ( defined( 'JETPACK__VERSION' ) ) {
    require_once( BIGBO_PHP_INCLUDE . 'functions/jetpack.php' );
}

/**
 * For auto install
 */
if ( is_admin() ) {
    load_template( BIGBO_PHP_LIB . 'auto-install/auto_install_data.php' );
    add_action( 'wp_ajax_auto_install_layout', 'auto_install_layout' );
    add_action( 'wp_ajax_nopriv_auto_install_layout', 'auto_install_layout' );
    add_action( 'wp_ajax_remove_auto_update', 'remove_auto_update' );
    add_action( 'wp_ajax_nopriv_remove_auto_update', 'remove_auto_update' );
}