<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bigbo
 */
function bigbo_after_setup() {

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
	add_theme_support( 'custom-background', apply_filters( 'bigbo_custom_background_args', array(
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

	add_editor_style( 'editor-style.css' );

	$ved_width_px		 = bigbo_get_option( 'ved_width_px', '1200' );
	$ved_custom_width_px	 = bigbo_get_option( 'ved_custom_width_px', '1200' );
	if ( $ved_width_px != "custom" ) {
		$ved_width_px	 = apply_filters( 'bigbo_header_image_width', $ved_width_px );
		//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'bigbo_header_image_width', $ved_width_px ) );
		//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bigbo_header_image_height', 170 ) );
		//define( 'HEADER_TEXTCOLOR', '' );
		//define( 'NO_HEADER_TEXT', true );
		$args		 = array(
			'flex-width'	 => true,
			'width'		 => $ved_width_px,
			'flex-height'	 => true,
			'height'	 => 200,
			'header-text'	 => false,
		);
		add_theme_support( 'custom-header', $args );
	} elseif ( $ved_width_px == "custom" ) {
		$ved_custom_width_px	 = apply_filters( 'bigbo_header_image_width', $ved_custom_width_px );
		//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'bigbo_header_image_width', $ved_width_px ) );
		//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bigbo_header_image_height', 170 ) );
		//define( 'HEADER_TEXTCOLOR', '' );
		//define( 'NO_HEADER_TEXT', true );
		$args			 = array(
			'flex-width'	 => true,
			'width'		 => $ved_custom_width_px,
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

	$ved_width_layout = bigbo_get_option( 'ved_width_layout', 'fixed' );

	if ( $ved_width_layout == "fixed" ) {
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

	load_theme_textdomain( 'bigbo', get_template_directory() . '/languages' );

	register_nav_menu( 'primary-menu', esc_html__( 'Primary Menu', 'bigbo' ) );
	register_nav_menu( 'top-menu', esc_html__( 'Top Menu', 'bigbo' ) );
	register_nav_menu( 'department-menu', esc_html__( 'Department Menu', 'bigbo' ) );

	$ved_container_width_px		 = (int)$ved_width_px - 30;
	$ved_container_custom_width_px	 = (int)$ved_custom_width_px - 30;

	if ( ! isset( $content_width ) ) {
		if ( $ved_width_px != "custom" ) {
			$content_width = $ved_container_width_px;
		} else {
			$content_width = $ved_container_custom_width_px;
		}
	}
}
add_action( 'after_setup_theme', 'bigbo_after_setup' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bigbo_body_classes( $classes ) {
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
add_filter( 'body_class', 'bigbo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 * 
 * 
 */
function bigbo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bigbo_pingback_header' );

/**
 * bbPress Integration
 *
 * @since 1.0.0
 */
function bigbo_pretty( $content ) {
	if ( ! is_attachment() ) {
		$content = preg_replace( "/<a/", "<a rel=\"prettyPhoto[postimages]\"", $content, 1 );
	}

	return $content;
}
add_filter( 'wp_get_attachment_link', 'bigbo_pretty' );

/**
 * Import demo data success message!
 * 
 * 
 */
function bigbo_importer_admin_notice() {
	if ( isset( $_GET[ 'imported' ] ) && $_GET[ 'imported' ] == 'success' ) {
		echo '<div id="setting-error-settings_updated" class="updated settings-error"><p>';
		echo esc_html__( 'Successfully imported demo data!', 'bigbo' );
		echo "</p></div>";
	}
}
add_action( 'admin_notices', 'bigbo_importer_admin_notice' );

/**
 * Custom RSS Link
 * 
 * @param type $output
 * @param type $feed
 * @return type
 */
function bigbo_feed_link( $output, $feed ) {
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
add_filter( 'feed_link', 'bigbo_feed_link', 1, 2 );

/**
 * Change in bbpress breadcrumb
 * 
 * @return string
 */
function bigbo_custom_bbp_breadcrumb() {
	$args[ 'sep' ] = ' / ';
	return $args;
}
add_filter( 'bbp_before_get_breadcrumb_parse_args', 'bigbo_custom_bbp_breadcrumb' );

/**
 * Add Comment reply script
 * 
 * 
 */
function bigbo_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bigbo_enqueue_comment_reply' );

/**
 * Register default function when plugin not activated
 * 
 * 
 */
function bigbo_plugins_loaded() {
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
add_action( 'wp_head', 'bigbo_plugins_loaded' );

/**
 * Theme Activation Hook
 * 
 * @global type $pagenow
 * 
 */
function bigbo_theme_activation() {
	global $pagenow;
	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET[ 'activated' ] ) ) {
		update_option( 'shop_catalog_image_size', array( 'width' => 500, 'height' => '', 0 ) );
		update_option( 'shop_single_image_size', array( 'width' => 500, 'height' => '', 0 ) );
		update_option( 'shop_thumbnail_image_size', array( 'width' => 120, 'height' => '', 0 ) );
	}
}
add_action( 'admin_init', 'bigbo_theme_activation' );

/**
 * Upload custom mimes
 * 
 * 
 */
function bigbo_custom_upload_mimes( $existing_mimes ) {
	$existing_mimes[ 'otf' ]	 = 'application/x-font-otf';
	$existing_mimes[ 'woff' ]	 = 'application/x-font-woff';
	$existing_mimes[ 'ttf' ]	 = 'application/x-font-ttf';
	$existing_mimes[ 'svg' ]	 = 'image/svg+xml';
	$existing_mimes[ 'eot' ]	 = 'application/vnd.ms-fontobject';
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'bigbo_custom_upload_mimes' );

/**
 *  polylang plugin if active than filter custom post type  
 * 
 * 
 */
function bigbo_pll_get_post_types( $types ) {
	return array_merge( $types, array( 'vedanta_portfolio' => 'vedanta_portfolio', 'slide' => 'slide' ) );
}
add_filter( 'pll_get_post_types', 'bigbo_pll_get_post_types' );

/**
 * Add Lightbox link
 * 
 * @param type $attachment_link
 * @return type
 * 
 */
function add_lighbox_rel( $attachment_link ) {
	if ( strpos( $attachment_link, 'a href' ) != false && strpos( $attachment_link, 'img src' ) != false )
		$attachment_link = str_replace( 'a href', 'a rel="gallery" href', $attachment_link );
	return $attachment_link;
}
add_filter( 'wp_get_attachment_link', 'add_lighbox_rel' );

/**
 * Adds quick view modal on the footer
 * 
 * 
 */
if ( ! function_exists( 'bigbo_quick_view_modal' ) ) :
    function bigbo_quick_view_modal() {
            if ( is_page_template( 'template-coming-soon-page.php' ) || is_404() ) {
                    return;
            }
    ?>
    <!-- START QUICK VIEW MODAL -->
    <div id="ved-quick-view-modal" class="ved-quick-view-modal single-product woocommerce modal fade" tabindex="-1">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close" aria-hidden="true"></i></button>
            <div class="product-modal-content"></div>
        </div>
        <div class="ved-loading"></div>
    </div>
    <!-- START QUICK VIEW MODAL -->
    <?php
    }
endif;
add_action( 'wp_footer', 'bigbo_quick_view_modal' );

/**
 * Add newsletter popup on the footer
 * 
 * 
 */
if ( ! function_exists( 'bigbo_newsletter_popup' ) ) :
	function bigbo_newsletter_popup() {
		if ( ! bigbo_get_option( 'ved_popup' ) ) {
			return;
		}

		$ved_newletter = '';
		if ( isset( $_COOKIE['ved_newletter'] ) ) {
			$ved_newletter = $_COOKIE['ved_newletter'];
		}

		if ( ! empty( $ved_newletter ) ) {
			return;
		}

		$output = array();
                
                if ( $title = bigbo_get_option( 'ved_popup_heading' ) ) {
			$output[] = sprintf( '<div class="newsletter_title"><h3 class="h3">%s</h3></div>', esc_html($title) );
		}

		if ( $desc = bigbo_get_option( 'ved_popup_content' ) ) {
			$output[] = sprintf( '<div class="ddContent">%s</div>', esc_html($desc) );
		}

		if ( $form = bigbo_get_option( 'ved_popup_form' ) ) {
			$output[] = sprintf( '<div class="form-wrap">%s</div>', do_shortcode($form) );
		}

                if ( $ved_popup_bg = bigbo_get_option( 'ved_popup_bg', '' ) ) {
                        $image = $ved_popup_bg['url'];
                } ?>
                <!-- START NEWSLETTER POPUP -->
                <div id="ddPopupnewsletter" class="modal fade" tabindex="-1" role="dialog">  
                    <div class="ddPopupnewsletter-i" role="document">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close" aria-hidden="true"></i></button>
                        <div class="itpopupnewsletter" style="background-image: url(<?php echo esc_url($image); ?>);">
                            <div id="newsletter_block_popup" class="block">     
                                <div class="block_content">             
                                    <?php echo implode( '', $output ) ?>                                      
                                </div>          
                                <div class="newsletter_block_popup-bottom check-fancy m-t-15">
                                    <a href="#" class="newsletter_show_again"><?php echo esc_html_e( 'Don\'t show this popup again', 'bigbo' ); ?></a>         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END NEWSLETTER POPUP -->
		<?php
	}
endif;
add_action( 'wp_footer', 'bigbo_newsletter_popup' );

/**
 * Add Search popup on the footer
 * 
 * 
 */
if ( ! function_exists( 'bigbo_search_popup' ) ) :
	function bigbo_search_popup() {
		$ved_show_search = bigbo_get_option( 'ved_show_search' );
		$ved_header_type = bigbo_get_option( 'ved_header_type' );
		if ( ! $ved_show_search || $ved_header_type == 'h1' ) {
			return;
		}
		?>
		<!-- Search Popup -->
		<div id="search_popup" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<?php 
					bigbo_header_search(); 
				?>
			  </div>
			</div>
		  </div>
		</div>
		<!-- END Search Popup -->
		<?php
	}
endif;
add_action( 'wp_footer', 'bigbo_search_popup' );

/**
 * Add Cookies Info on the footer
 * 
 */
function bigbo_cookie_notice(){
	global $ved_options;
	if(isset($ved_options['ved_cookies_info']) && $ved_options['ved_cookies_info']){
		if(isset($_COOKIE['bigbo_cookies']) && $_COOKIE['bigbo_cookies']=='accepted'){
			return;
		}

		$page_id = false;
		if( isset($ved_options['ved_cookies_policy_page']) ){
			$page_id=$ved_options['ved_cookies_policy_page'];
		}
		?>
		<div class="bigbo-cookies-info">
			<div class="bigbo-cookies-inner">
				<div class="cookies-info-text">
					<?php echo do_shortcode( $ved_options['ved_cookies_text'] ); ?>
				</div>
				<div class="cookies-buttons">
					<a href="#" class="cookies-info-accept-btn"><?php esc_html_e( 'Accept', 'bigbo' ); ?></a>
					<?php if ( $page_id ): ?>
						<a href="<?php echo esc_url(get_permalink($page_id));?>" class="cookies-more-btn"><?php esc_html_e( 'More info' , 'bigbo' ); ?></a>
					<?php endif ?>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'wp_footer', 'bigbo_cookie_notice' );