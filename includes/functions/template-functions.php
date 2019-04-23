<?php

/**
 * Activation redirects
 *
 * @since 1.0.0
 */
function dayneo_activate() {
	add_option( 'ved_do_activation_redirect', true );
}

add_action( 'after_switch_theme', 'dayneo_activate' );

/**
 * Redirect to options page
 *
 * @since 1.0.0
 */
function dayneo_redirect() {
	if ( get_option( 'ved_do_activation_redirect', false ) ) {
		delete_option( 'ved_do_activation_redirect' );
		if ( ! isset( $_GET[ 'activate-multi' ] ) ) {
			wp_redirect( "admin.php?page=dayneo-menu" );
		}
	}
}

add_action( 'admin_init', 'dayneo_redirect' );

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package dayneo
 */
function dayneo_after_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'custom-background', apply_filters( 'dayneo_custom_background_args', array(
		'default-color'	 => 'ffffff',
		'default-image'	 => '',
	) ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'custom-logo', array(
		'height'	 => 250,
		'width'		 => 250,
		'flex-width'	 => true,
		'flex-height'	 => true,
	) );
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 500,
	) );
	add_image_size( 'post-thumbnail', 680, 330, true );
	add_image_size( 'slider-thumbnail', 400, 280, true );
	add_image_size( 'tabs-img', 50, 50, true );
	add_image_size( 'recent-works-thumbnail', 65, 65, true );
	add_image_size( 'blog-large', 669, 272, true );
	add_image_size( 'blog-medium', 320, 202, true );
	add_image_size( 'related-img', 180, 138, true );
	add_image_size( 'portfolio-one', 540, 272, true );
	add_image_size( 'portfolio-two', 460, 295, true );
	add_image_size( 'portfolio-three', 300, 214, true );
	add_image_size( 'portfolio-four', 220, 161, true );
	add_image_size( 'portfolio-full', 940, 400, true );
	add_image_size( 'recent-posts', 660, 405, true );

	add_editor_style( 'editor-style.css' );

	$dd_width_px		 = dayneo_get_option( 'dd_width_px', '1200' );
	$dd_custom_width_px	 = dayneo_get_option( 'dd_custom_width_px', '1200' );
	if ( $dd_width_px != "custom" ) {
		$dd_width_px	 = apply_filters( 'dayneo_header_image_width', $dd_width_px );
		//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'dayneo_header_image_width', $dd_width_px ) );
		//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'dayneo_header_image_height', 170 ) );
		//define( 'HEADER_TEXTCOLOR', '' );
		//define( 'NO_HEADER_TEXT', true );
		$args		 = array(
			'flex-width'	 => true,
			'width'		 => $dd_width_px,
			'flex-height'	 => true,
			'height'	 => 200,
			'header-text'	 => false,
		);
		add_theme_support( 'custom-header', $args );
	} elseif ( $dd_width_px == "custom" ) {
		$dd_custom_width_px	 = apply_filters( 'dayneo_header_image_width', $dd_custom_width_px );
		//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'dayneo_header_image_width', $dd_width_px ) );
		//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'dayneo_header_image_height', 170 ) );
		//define( 'HEADER_TEXTCOLOR', '' );
		//define( 'NO_HEADER_TEXT', true );
		$args			 = array(
			'flex-width'	 => true,
			'width'		 => $dd_custom_width_px,
			'flex-height'	 => true,
			'height'	 => 200,
			'header-text'	 => false,
		);
		add_theme_support( 'custom-header', $args );
	}


	// Allow shortcodes in widget text
	add_filter( 'widget_text', 'do_shortcode' );

	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	/**
	 * Remove Double Cart Totals
	 * =========================
	 *
	 * @woocommerce
	 * @bugfix
	 * @jerry
	 */
	if ( class_exists( 'Woocommerce' ) ) {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 ); // Remove Duplicated Cart Totals
		//remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 ); // Remove Duplicated Checkout Button
	}

	$dd_width_layout = dayneo_get_option( 'dd_width_layout', 'fixed' );

	if ( $dd_width_layout == "fixed" ) {
		$defaults = array(
			'default-color'	 => 'e5e5e5',
			'default-image'	 => ''
		);
		add_theme_support( 'custom-background', $defaults );
	}

	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video'
	) );

	load_theme_textdomain( 'dayneo', get_template_directory() . '/languages' );

	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'dayneo' ) );
	register_nav_menu( 'top-menu', __( 'Top Menu', 'dayneo' ) );
	register_nav_menu( 'department-menu', __( 'Department Menu', 'dayneo' ) );

	$dd_container_width_px		 = (int)$dd_width_px - 30;
	$dd_container_custom_width_px	 = (int)$dd_custom_width_px - 30;

	if ( ! isset( $content_width ) ) {
		if ( $dd_width_px != "custom" ) {
			$content_width = $dd_container_width_px;
		} else {
			$content_width = $dd_container_custom_width_px;
		}
	}
}

add_action( 'after_setup_theme', 'dayneo_after_setup' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dayneo_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'dayneo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dayneo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'dayneo_pingback_header' );

/**
 * bbPress Integration
 *
 * @since 1.0.0
 */
function dayneo_pretty( $content ) {
	if ( ! is_attachment() ) {
		$content = preg_replace( "/<a/", "<a rel=\"prettyPhoto[postimages]\"", $content, 1 );
	}

	return $content;
}

add_filter( 'wp_get_attachment_link', 'dayneo_pretty' );

//import demo data success message!
add_action( 'admin_notices', 'dayneo_importer_admin_notice' );

function dayneo_importer_admin_notice() {
	if ( isset( $_GET[ 'imported' ] ) && $_GET[ 'imported' ] == 'success' ) {
		echo '<div id="setting-error-settings_updated" class="updated settings-error"><p>';
		echo esc_html_e( 'Successfully imported demo data!', 'dayneo' );
		echo "</p></div>";
	}
}

// Custom RSS Link
add_filter( 'feed_link', 'dayneo_feed_link', 1, 2 );

function dayneo_feed_link( $output, $feed ) {
	if ( isset( $smof_data[ 'rss_link' ] ) && $smof_data[ 'rss_link' ] ) {
		$feed_url = $smof_data[ 'rss_link' ];

		$feed_array		 = array(
			'rss'		 => $feed_url,
			'rss2'		 => $feed_url,
			'atom'		 => $feed_url,
			'rdf'		 => $feed_url,
			'comments_rss2'	 => ''
		);
		$feed_array[ $feed ]	 = $feed_url;
		$output			 = $feed_array[ $feed ];
	}

	return $output;
}

/* change in bbpress breadcrumb */

function dayneo_custom_bbp_breadcrumb() {
	$args[ 'sep' ] = ' / ';
	return $args;
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'dayneo_custom_bbp_breadcrumb' );

/**
 * Layerslider API
 */
function dayneo_layerslider_ready() {
	if ( class_exists( 'LS_Sources' ) ) {
		LS_Sources::addSkins( get_template_directory() . '/lib/ls-skins' );
	}
}

add_action( 'layerslider_ready', 'dayneo_layerslider_ready' );

function dayneo_admin_css() {
	wp_enqueue_style( 'admin-shortcode-style', get_template_directory_uri() . '/admin/assets/css/admin_shortcodes.css' );
}

add_action( 'admin_head', 'dayneo_admin_css' );

function dayneo_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'dayneo_enqueue_comment_reply' );

// Register default function when plugin not activated

function dayneo_plugins_loaded() {
	if ( ! function_exists( 'is_woocommerce' ) ) {

		function is_woocommerce() {
			return false;
		}

	}
	if ( ! function_exists( 'is_product' ) ) {

		function is_product() {
			return false;
		}

	}
	if ( ! function_exists( 'is_buddypress' ) ) {

		function is_buddypress() {
			return false;
		}

	}
	if ( ! function_exists( 'is_bbpress' ) ) {

		function is_bbpress() {
			return false;
		}

	}
}

add_action( 'wp_head', 'dayneo_plugins_loaded' );

/* Theme Activation Hook */

function dayneo_theme_activation() {
	global $pagenow;
	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET[ 'activated' ] ) ) {
		update_option( 'shop_catalog_image_size', array( 'width' => 500, 'height' => '', 0 ) );
		update_option( 'shop_single_image_size', array( 'width' => 500, 'height' => '', 0 ) );
		update_option( 'shop_thumbnail_image_size', array( 'width' => 120, 'height' => '', 0 ) );
	}
}

add_action( 'admin_init', 'dayneo_theme_activation' );

//function remove_product_shortcode() {
//	if ( class_exists( 'Woocommerce' ) ) {
//		// First remove the shortcode
//		remove_shortcode( 'product' );
//		// Then recode it
//		add_shortcode( 'product', 'dayneo_woo_product' );
//	}
//}
//
//add_action( 'wp_loaded', 'remove_product_shortcode' );

/**
 * Upload custom mimes
 */
function dayneo_custom_upload_mimes( $existing_mimes ) {
	$existing_mimes[ 'otf' ]	 = 'application/x-font-otf';
	$existing_mimes[ 'woff' ]	 = 'application/x-font-woff';
	$existing_mimes[ 'ttf' ]	 = 'application/x-font-ttf';
	$existing_mimes[ 'svg' ]	 = 'image/svg+xml';
	$existing_mimes[ 'eot' ]	 = 'application/vnd.ms-fontobject';
	return $existing_mimes;
}

add_filter( 'upload_mimes', 'dayneo_custom_upload_mimes' );

/**
 *  polylang plugin if active than filter custom post type  
 * 
 */
function dayneo_pll_get_post_types( $types ) {
	return array_merge( $types, array( 'dayneo_portfolio' => 'dayneo_portfolio', 'slide' => 'slide' ) );
}

add_filter( 'pll_get_post_types', 'dayneo_pll_get_post_types' );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

function add_lighbox_rel( $attachment_link ) {
	if ( strpos( $attachment_link, 'a href' ) != false && strpos( $attachment_link, 'img src' ) != false )
		$attachment_link = str_replace( 'a href', 'a rel="gallery" href', $attachment_link );
	return $attachment_link;
}

add_filter( 'wp_get_attachment_link', 'add_lighbox_rel' );
