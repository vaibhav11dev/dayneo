<?php
global $post, $wp_query, $ved_options;
$bigbo_dynamic_css	 = '';
$bigbo_template_url	 = get_template_directory_uri();

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( function_exists( 'is_buddypress' ) ) {
        if ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }
} elseif ( function_exists( 'is_shop' ) ) {
        if ( is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }
} else {
    $post_id = isset( $post->ID ) ? $post->ID : '';
}

/* -----------------------------------------------------------------
  [General Layout Options]
 */
$ved_width_layout		 = $ved_options[ 'ved_width_layout' ];
$ved_width_px			 = $ved_options[ 'ved_width_px' ];
$ved_custom_width_px		 = $ved_options[ 'ved_custom_width_px' ];
$ved_container_width_px		 = (int)$ved_width_px - 30;
$ved_container_custom_width_px	 = (int)$ved_custom_width_px - 30;

//General - Layout Width
if ( $ved_width_px != "custom" && ( $ved_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$bigbo_dynamic_css .= '
		body {
	width: ' . esc_attr($ved_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
}
';
} elseif ( $ved_width_px != "custom" ) {
	$bigbo_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
} elseif ( $ved_width_px == "custom" && ( $ved_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$bigbo_dynamic_css .= '
body {
	width: ' . esc_attr($ved_custom_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
}
';
} elseif ( $ved_width_px == "custom" ) {
	$bigbo_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
}

// General - Fullwidth - Fluid Template Left/Right Padding
$ved_hundredp_padding		 = $ved_options[ 'ved_hundredp_padding' ];
$bigbo_hundredp_padding	 = get_post_meta( $post_id, 'bigbo_hundredp_padding', true );
if ( is_page_template( 'fullwidth-fluid.php' ) ) {
	if ( $bigbo_hundredp_padding ) {
		$bigbo_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($bigbo_hundredp_padding) . ';
			    padding-right: ' . esc_attr($bigbo_hundredp_padding) . ';
			}
		';
	} else {
		$bigbo_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($ved_hundredp_padding) . ';
			    padding-right: ' . esc_attr($ved_hundredp_padding) . ';
			}
		';
	}
}

// General - Content Top & Bottom Padding
$ved_content_top_bottom_padding = $ved_options[ 'ved_content_top_bottom_padding' ];
$bigbo_content_top_bottom_padding	 = get_post_meta( $post_id, 'bigbo_content_top_bottom_padding', true );
if ( $bigbo_content_top_bottom_padding ) {
	$bigbo_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($bigbo_content_top_bottom_padding) . ';
		padding-bottom:' . esc_attr($bigbo_content_top_bottom_padding) . ';
		padding-left: 0;
		padding-right: 0;
}
';
} elseif( $ved_content_top_bottom_padding ) {
	$bigbo_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($ved_content_top_bottom_padding[ 'padding-top' ]) . ';
		padding-bottom:' . esc_attr($ved_content_top_bottom_padding[ 'padding-bottom' ]) . ';
		padding-left: 0;
		padding-right: 0;
}
';
}

/* -----------------------------------------------------------------
  [Header Section Style]
 */

//Header Topbar Color
if ( isset( $ved_options[ 'ved_topbar_bg_color' ] ) ) {
	$bigbo_dynamic_css .= '
	.top-bar.top-bar-color {
		background: ' . esc_attr($ved_options[ 'ved_topbar_bg_color' ]) . ';
	}
';
}

// Hero Header Custom Height
$bigbo_hero_height_custom	 = get_post_meta( $post_id, 'bigbo_hero_height_custom', true );
if ( $bigbo_hero_height_custom ) {
$bigbo_dynamic_css		 .= '
.hero-height-custom {
	height: ' . esc_attr($bigbo_hero_height_custom) . 'vh;
}
';
}

//Header Background Color
$bigbo_dynamic_css .= '
	#header {
		background: ' . esc_attr($ved_options[ 'ved_header_bg_color' ]) . ';
	}
';


//Header Text Color
$bigbo_dynamic_css .= '
	.top-bar p,.top-bar-list a, .top-bar-right .dropdown > .expand-more, #_desktop_wishtlistTop .yith-contents,.cart-hover .cart-content-right > span,
	.cart-hover .cart-content-right .nav-total,.mobile-logo-bar #menu-icon,#_mobile_cart .header-ajax-cart .icon-box {
		color: ' . esc_attr($ved_options[ 'ved_header_text_color' ]) . ';
	}
';


/* -----------------------------------------------------------------
  [Page Title Bar Style]
 */
$ved_pagetitlebar_height			 = bigbo_get_option( 'ved_pagetitlebar_height', 'medium' );
$bigbo_page_title_bar_height		 = get_post_meta( $post_id, 'bigbo_page_title_bar_height', true );
if ( !$bigbo_page_title_bar_height ) {
        $bigbo_page_title_bar_height = 'default';
}
$ved_pagetitlebar_custom			 = bigbo_get_option( 'ved_pagetitlebar_custom', '' );
$bigbo_page_title_bar_height_custom	 = get_post_meta( $post_id, 'bigbo_page_title_bar_height_custom', true );

// 1.1 Page Title Bar Custom Height
if ( $bigbo_page_title_bar_height == 'custom' && $bigbo_page_title_bar_height_custom ) {
	$bigbo_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($bigbo_page_title_bar_height_custom) . 'px 0;
}
';
} elseif ( $bigbo_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'custom' && $ved_pagetitlebar_custom ) {
	$bigbo_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($ved_pagetitlebar_custom) . 'px 0;
}
';
}

$bigbo_enable_page_title	 = get_post_meta( $post_id, 'bigbo_enable_page_title', true );
if (empty($bigbo_enable_page_title)) {
    $bigbo_enable_page_title = 'default';
}
$ved_pagetitlebar_background_color	 = bigbo_get_option( 'ved_pagetitlebar_background_color', '' );
$bigbo_page_title_bar_bg_color	 = get_post_meta( $post_id, 'bigbo_page_title_bar_bg_color', true );
// 1.2 Page Title Bar Background Color
if ( $bigbo_page_title_bar_bg_color ) {
	$bigbo_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($bigbo_page_title_bar_bg_color) . ';
}
';
} elseif ( $bigbo_enable_page_title == 'default' && $ved_pagetitlebar_background_color ) {
	$bigbo_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($ved_pagetitlebar_background_color) . ';
}
';
}

$ved_pagetitlebar_background	 = bigbo_get_option( 'ved_pagetitlebar_background', '' );
$bigbo_page_title_bar_bg	 = get_post_meta( $post_id, 'bigbo_page_title_bar_bg', true );
// 1.3 Page Title Bar Background Image
if ( $bigbo_page_title_bar_bg ) {
	$bigbo_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url(wp_get_attachment_url( $bigbo_page_title_bar_bg )) . '");
}
.titlebar-bg *{
	color:#fff
}
';
} elseif ( $bigbo_enable_page_title == 'default' && isset( $ved_pagetitlebar_background[ 'url' ] ) && $ved_pagetitlebar_background[ 'url' ] ) {
	$bigbo_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url($ved_pagetitlebar_background[ 'url' ]) . '");
}
.titlebar-bg *{
	color:#fff
}
';
}

/* -----------------------------------------------------------------
  [Footer Style]
 */
$ved_main_pattern	 = bigbo_get_option( 'ved_pattern', '' );
$ved_image_patten_array	 = array( 'none', 'pattern_1_thumb.png', 'pattern_2_thumb.png', 'pattern_3_thumb.png', 'pattern_4_thumb.png', 'pattern_5_thumb.png', 'pattern_6_thumb.png', 'pattern_7_thumb.png', 'pattern_8_thumb.png' );
if ( ! empty( $ved_main_pattern ) && $ved_main_pattern != 'none' && in_array( $ved_main_pattern, $ved_image_patten_array ) ) {
	$ved_main_pattern	 = $bigbo_template_url . '/assets/images/pattern/' . $ved_main_pattern;
	$bigbo_dynamic_css	 .= '
    .footer {
	background-image: url(' .  esc_url($ved_main_pattern) . ');
    }
    ';
} else {
	$ved_footer_image_src		 = bigbo_get_option( 'ved_footer_background_image' );
	$ved_footer_image		 = bigbo_get_option( 'ved_footer_image', 'cover' );
	$ved_footer_background_repeat	 = bigbo_get_option( 'ved_footer_image_background_repeat', 'no-repeat' );
	$ved_footer_background_position	 = bigbo_get_option( 'ved_footer_image_background_position', 'center top' );
	if ( isset($ved_footer_image_src[ 'url' ]) && $ved_footer_image_src[ 'url' ] ) {
		$bigbo_dynamic_css .= '
.footer {
	background-image: url("' . esc_url( $ved_footer_image_src[ 'url' ] ) . '");
	background-position: ' . esc_attr($ved_footer_background_position) . ';
	background-repeat: ' . esc_attr($ved_footer_background_repeat) . ';
	border-bottom: 0;
	background-size: ' . esc_attr($ved_footer_image) . ';
	width: 100%;
}
';
	}

	$ved_footer_bg_color = bigbo_get_option( 'ved_footer_bg_color', '' );
	if ( ! empty( $ved_footer_bg_color ) ) {
		$bigbo_dynamic_css .= '
.footer,.dddemo2 .before-footer .social-icons,.dddemo3 .before-footer .social-icons {
	background-color: ' . esc_attr($ved_footer_bg_color) . ';
}
';
	}

	$ved_footer_parallax = bigbo_get_option( 'ved_footer_parallax', '' );
	if ( $ved_footer_parallax == 1 ) {
		$bigbo_dynamic_css .= '
.footer {
	background-attachment: fixed;
}
';
	}
}

/* -----------------------------------------------------------------
  [Portfolio Style]
 */
$ved_portfolio_hover_color	 = bigbo_get_option( 'ved_portfolio_hover_color', '' );
$rgb				 = bigbo_hex2rgb( $ved_portfolio_hover_color );
if ( is_array( $rgb ) ) {
	$bigbo_dynamic_css .= '
.works-grid .work-overlay {
	background: rgba(' . esc_attr($rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ]) . ', 0.8);
}
';
}

/* -----------------------------------------------------------------
  [Retina Support Style]
 */
$ved_header_logo_retina = bigbo_get_option( 'ved_header_logo_retina', '' );
if ( $ved_header_logo_retina != "" ) {
	$bigbo_dynamic_css .= '
@media only screen and (-webkit-min-device-pixel-ratio: 1.3),
only screen and (-o-min-device-pixel-ratio: 13/10),
only screen and (min-resolution: 120dpi) {
    .site-identity .normal-logo {
        display: none;
    }
    .site-identity .retina-logo {
        display: inline-block;
    }
}
';
}

/* -----------------------------------------------------------------
  [Typography Style]
 */

// Custom Fonts
$ved_custom_font_woff	 = bigbo_get_option( 'ved_custom_font_woff' );
$ved_custom_font_ttf	 = bigbo_get_option( 'ved_custom_font_ttf' );
$ved_custom_font_svg	 = bigbo_get_option( 'ved_custom_font_svg' );
$ved_custom_font_eot	 = bigbo_get_option( 'ved_custom_font_eot' );
if ( isset( $ved_custom_font_woff[ 'url' ] ) && $ved_custom_font_woff[ 'url' ] 
    && isset($ved_custom_font_svg[ 'url' ]) && $ved_custom_font_svg[ 'url' ] 
    && isset($ved_custom_font_eot[ 'url' ]) && $ved_custom_font_eot[ 'url' ] 
    && isset($ved_custom_font_ttf[ 'url' ]) && $ved_custom_font_ttf[ 'url' ] ) {
	$bigbo_dynamic_css .= '
@font-face {
    font-family: "CustomFont";
    src: url("' .  esc_url($ved_custom_font_eot[ 'url' ]) . '");
    src: url("' .  esc_url($ved_custom_font_eot[ 'url' ]) . '?#iefix") format("eot"), url("' .  esc_url($ved_custom_font_woff[ 'url' ]) . '") format("woff"), url("' .  esc_url($ved_custom_font_ttf[ 'url' ]) . '") format("truetype"), url("' .  esc_url($ved_custom_font_svg[ 'url' ]) . '#CustomFont") format("svg");
    font-weight: 400;
    font-style: normal;
}

body,
.text-title {
    font-family: "CustomFont";
}
';
} else {

	//Blog Title Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_title_font', '#blog-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Blog Tagline Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_tagline_font', '#tagline', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Main Menu Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_menu_font', '.primary-nav .inner-nav > li > a', $additional_color_css_class = '', $imp = '' );

	//Top Menu Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_top_menu_font', '.top-bar-list', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Post Title Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_post_font', '.entry-header .post-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Post Content Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_content_font', '.entry-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Widget Title Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_widget_title_font', '.widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );
	
	//Widget Content Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_widget_content_font', '.widget-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Footer Widget Title Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_footer_widget_title_font', '.footer .widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Footer Widget Content Font
	$bigbo_dynamic_css		 .= bigbo_print_fonts( 'ved_footer_widget_content_font', '.footer .widget-content,.footer .widget-content a,.footer > .footer-bg-black > .container p', $additional_color_css_class = '', $imp = '' );
        
        //ThemeVedanta Slider Heading Font 
        $bigbo_dynamic_css        .= bigbo_print_fonts( 'ved_slider_heading_font', '.tvslider .slide-heading', $additional_css = '', $additional_color_css_class = '', $imp = '' ); 
        
        //ThemeVedanta Slider Caption Font 
        $bigbo_dynamic_css        .= bigbo_print_fonts( 'ved_slider_caption_font', '.tvslider .slide-caption', $additional_css = '', $additional_color_css_class = '', $imp = '' ); 

	//H1 to H6 Font
	for ( $i = 1; $i < 7; $i ++ ) {
		//we get all h1 to h6 Fonts, ved_content_h1_font ... to ved_content_h6_font values.
		$bigbo_dynamic_css	 .= bigbo_print_fonts( 'ved_content_h' . $i . '_font', "h{$i}", $additional_css = '' );
	}
}

/* -----------------------------------------------------------------
  [General Style Options]
 */

$ved_main_menu_hover_font_color	 = $ved_options[ 'ved_main_menu_hover_font_color' ];
$ved_sub_menu_hover_font_color	 = $ved_options[ 'ved_sub_menu_hover_font_color' ];
$ved_form_bg_color		 = $ved_options[ 'ved_form_bg_color' ];
$ved_form_text_color		 = $ved_options[ 'ved_form_text_color' ];
$ved_form_border_color		 = $ved_options[ 'ved_form_border_color' ];

$bigbo_dynamic_css .= '
.sub-menu li > a:hover, 
.sub-menu li > a:focus, 
.sub-menu li.submenu-open > a {
	color: ' . esc_attr($ved_sub_menu_hover_font_color) . ';
}
.form-control,.form-control, input[type=text],.woocommerce-input-wrapper .select2-selection,.select2-selection,
.select2-container--default .select2-selection--single,
.woocommerce .woocommerce-Input, .woocommerce-form-coupon .input-text, .widget_product_search .widget-content .search-field, .wpcf7-text, .wpcf7-number, .wpcf7-date, .wpcf7-textarea, .wpcf7-select, .mc4wp-form-fields .input-wrapper input,select {
	background-color: ' . esc_attr($ved_form_bg_color) . ';
	color: ' . esc_attr($ved_form_text_color) . ';
	border-color: ' . esc_attr($ved_form_border_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Sharing Box Options]
 */

$ved_sharing_box_icon_color	 = $ved_options[ 'ved_sharing_box_icon_color' ];
$ved_sharing_box_color		 = $ved_options[ 'ved_sharing_box_color' ];
$ved_sharing_box_radius		 = $ved_options[ 'ved_sharing_box_radius' ];

$bigbo_dynamic_css .= '
.share-this a {
	background: ' . esc_attr($ved_sharing_box_color) . ';
	border-radius: ' . esc_attr($ved_sharing_box_radius) . ';
	color: ' . esc_attr($ved_sharing_box_icon_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Media Links Options]
 */
$ved_social_color	 = $ved_options[ 'ved_social_color' ];
$ved_social_boxed_color	 = $ved_options[ 'ved_social_boxed_color' ];
$ved_social_boxed_radius	 = $ved_options[ 'ved_social_boxed_radius' ];

$bigbo_dynamic_css .= '
.header-social.social-icons > li > a {
	color: ' . esc_attr($ved_social_color) . ';
}
.header-social.boxed-icons > li > a {
	background: ' . esc_attr($ved_social_boxed_color) . ';
	border-radius: ' . esc_attr($ved_social_boxed_radius) . ';
	border-color: ' . esc_attr($ved_social_boxed_color) . ';
}
';


/* -----------------------------------------------------------------
  [Menu Style]
 */
$ved_main_menu_padding	 = bigbo_get_option( 'ved_main_menu_padding', '15px' );
$ved_menu_text_transform	 = bigbo_get_option( 'ved_menu_text_transform', 'none' );
$bigbo_dynamic_css	 .= '
.primary-nav .inner-nav > li > a {
	text-transform: ' . esc_attr($ved_menu_text_transform) . ';
	padding-top: ' . esc_attr($ved_main_menu_padding[ 'padding-top' ]) . ';
	padding-right: ' . esc_attr($ved_main_menu_padding[ 'padding-right' ]) . ';
	padding-bottom: ' . esc_attr($ved_main_menu_padding[ 'padding-bottom' ]) . ';
	padding-left: ' . esc_attr($ved_main_menu_padding[ 'padding-left' ]) . ';
}
.products-cats-menu .cats-menu-title{
	padding-top: ' . esc_attr($ved_main_menu_padding[ 'padding-top' ]) . ';
	padding-bottom: ' . esc_attr($ved_main_menu_padding[ 'padding-bottom' ]) . ';
}
';

/* -----------------------------------------------------------------
  [Mega Menu Style]
 */


$ved_megamenu_title_size	 = bigbo_get_option( 'ved_megamenu_title_size', '15px' );
$ved_menu_font		 = bigbo_get_option( 'ved_menu_font' );
$ved_widget_content_font	 = bigbo_get_option( 'ved_widget_content_font' );

if ( $ved_width_px != "custom" ) {
	$bigbo_width_col_span_1	 = (int)$ved_container_width_px / 4;
	$bigbo_width_col_span_2	 = (int)$bigbo_width_col_span_1 * 2;
	$bigbo_width_col_span_3	 = (int)$bigbo_width_col_span_1 * 3;

	$bigbo_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($bigbo_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($bigbo_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($bigbo_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
}
';
} else {

	$bigbo_width_col_span_1	 = (int)$ved_container_custom_width_px / 4;
	$bigbo_width_col_span_2	 = (int)$bigbo_width_col_span_1 * 2;
	$bigbo_width_col_span_3	 = (int)$bigbo_width_col_span_1 * 3;

	$bigbo_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($bigbo_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($bigbo_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($bigbo_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
}
';
}

	$bigbo_dynamic_css .= '
 .ved-megamenu-wrapper .ved-megamenu-title {
    font-family: ' . esc_attr($ved_menu_font[ 'font-family' ]) . ';
    font-size: ' . esc_attr($ved_megamenu_title_size) . ';
    text-transform: ' . esc_attr($ved_menu_text_transform) . ';
}
.vertical-megamenu .ved-megamenu-menu.has-submenu .ved-megamenu-wrapper .ved-megamenu-title a{
	font-size: ' . esc_attr($ved_megamenu_title_size) . ';
	text-transform: ' . esc_attr($ved_menu_text_transform) . ';
}
.ved-megamenu-wrapper .ved-megamenu-bullet,
.ved-megamenu-bullet {
    border-left: 3px solid ' . esc_attr($ved_menu_font[ 'color' ]) . ';
}

ul.nav-menu .ved-megamenu-menu .widget-content a {
    color: ' . esc_attr($ved_widget_content_font[ 'color' ]) . ' ;
}

ul.nav-menu li li:hover .ved-megamenu-title,
ul.nav-menu li li:hover .ved-megamenu-title a,
ul.nav-menu li li.current-menu-item .ved-megamenu-title, 
ul.nav-menu li li.current-menu-item .ved-megamenu-title a, 
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title,
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title a,
.inner-nav > li > a:hover, .inner-nav > li > a:focus, .ved-main-megamenu .inner-nav > li.submenu-open > a {
    color: ' . esc_attr($ved_main_menu_hover_font_color) . ';
}
';

/* -----------------------------------------------------------------
  [Main Color Scheme Style]
 */

$ved_primary_color	 = bigbo_get_option( 'ved_primary_color', '#3ab54a' );
$ved_secondry_color	 = bigbo_get_option( 'ved_secondry_color', '#3ab54a' );
$bigbo_dynamic_css	 .= '
::-moz-selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

::-webkit-selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

::selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

a:hover, 
a:focus,
.post-meta>li>a:hover,
.post-meta>li>a:focus,
.top-bar-right .dropdown > .expand-more:hover, #_desktop_wishtlistTop .yith-contents:hover,
.ved-post-item .ved-post-link .read-more:hover
{
    color: ' . esc_attr($ved_primary_color) . ';
}

.divider-line:after,
.alert-brand,
.label-base,
.btn.btn-base:hover,
button[type=submit]:hover,
.ved-read-more-button:hover,
.nav-text-tabs>li>a:after,
.owl-controls-brand .owl-page span,
.owl-page span,
.cart-badge,
.post.format-quote,
.post.format-quote blockquote,
.social-icons>li>a:hover,
.share-this a:focus,
.share-this a:hover,
.divider-line::after,
.button.wc-backward:hover,
.button.wc-forward,
.wishlist_table .product-add-to-cart .button:hover,
.main-slider .ved-image-slider .owl-buttons > div,
.flex-direction-nav > li,
.main-slider .ved-image-slider .owl-pagination > div:hover,
.owl-pagination > div.active,
.flex-control-nav > li > a.flex-active,
.ved-woo-cats-slider .item .categoryName:after,
.ddPopupnewsletter-i .close,
.ved-pricing .ved-pricing-button:hover
{
    background: ' . esc_attr($ved_primary_color) . ';
}

.btn.btn-base.btn-outline,
.btn.btn-base.btn-fade:focus,
.btn.btn-base.btn-fade:hover,
.btn.btn-base.btn-link:hover,
.btn.btn-base.btn-link:focus,
.breadcrumb a:focus,
.breadcrumb a:hover,
.box-icon .icon-box-icon,
.box-icon-left .icon-box-icon,
.box-icon-right .icon-box-icon,
.nav-text-tabs>li.active>a,
.career-tags,
.comment-tools a:focus,
.comment-tools a:hover,
.icons-list a:focus,
.icons-list a:hover,
.widget .widget-content ul li a:hover,
.vertical-megamenu .inner-nav > li:hover > a,
.cart-hover .sub-cart-menu .list-product .list-product-detail a:hover,
.shop-item-title .woocommerce-loop-product__title a:hover,
.footer-center .widget_nav_menu .menu > li > a:before,
.footer-center .widget_nav_menu .sub-menu > li > a:before,
.footer-center .widget_nav_menu ul.sub-menu:not(.menu) > li > a:hover,
.post .entry-meta .read-more:hover,.navigation-links a:hover,
.woocommerce div.product div.summary .yith-wcwl-add-to-wishlist a:hover, .woocommerce div.product div.summary .compare:hover,
.ddNextPrev .nextPrevProduct a.button,
.cart-table .product-name a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,
.ved-woo-cats-slider .item .sub-cat li a:hover,
.ved-woo-cats-slider .item .categoryName a:hover,
.service-sec .service-box .elementor-image-box-img,
.widget.woocommerce .widget-content ul li a:hover + .count,
.ved-testimonial-user,
.slick-dots li.slick-active button:before,
.portfolio-info .social-icons li a:hover,
.wc_payment_method a:hover,
.footer a:hover,
.ved-quick-view-modal .modal-content .close:hover,
.page-search article .entry-meta .read-more:hover,
input[type="checkbox"] + label:after, input[type="checkbox"] + span:after, .newsletter_show_again:after
{
    color: ' . esc_attr($ved_primary_color) . ';
}

.color-brand {
    color: ' . esc_attr($ved_primary_color) . ';
}

.bg-brand,
.progress-bar,
.products-search .search-submit:hover,
.main-menu,
.products-cats-menu .cats-menu-title,
.header-1 .main-menu,
.footer .copyright,.owl-carousel .owl-buttons>*:hover,
.ved-post-item .ved-post-preview .meta_date,.ved-post-item .ved-post-preview .blogicons a.icon:hover,
#_mobile_cart .icon-box .mini-item-counter,
.mobile-search-bar,.widget_shopping_cart .woocommerce-mini-cart__buttons .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.shop-item-tools a:hover, .button.wishlist .yith-wcwl-add-button a.aved_to_wishlist:hover,
.product .onsale,
.single-product .product .single_aved_to_cart_button:hover, #review_form .submit:hover, .woocommerce-address-fields .button:hover, .woocommerce-form-coupon .button:hover, .woocommerce .woocommerce-Button:hover, .widget_product_search .widget-content button:hover, .wpcf7-submit:hover,.order-again a:hover,
.woocommerce div.product .product-slider .slick-arrow:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active:before, .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover:before,
.service-sec .service-box .elementor-image-box-img,
body .elementor-button:hover,
.filters > li > a:after,
.ved-modalbox-open-button:hover,
.sec-head-style:before,.wishlist-title:before,
.sec-head-style h3:before, .sec-head-style h3:after, .wishlist-title h2:before, .wishlist-title h2:after,
.scroll-top:hover,
.ved-price-list .featured-highlight .highlight-box,
.wishlist_table .product-name .yith-wcqv-button:hover,
.sidebar .yith-woocompare-widget a.compare,
input[type="radio"] + label:after, input[type="radio"] + span:after,
button[type=submit]:hover,
.vedanta-slider .slides .owl-buttons > div
{
    background-color: ' . esc_attr($ved_primary_color) . ';
}
.ved-post-item .ved-post-preview .ved-post-thumbnail:after{
	background: -moz-linear-gradient(top,rgba(255,255,255,0) 0%, '. esc_attr($ved_primary_color) .' 100%);
    background: -webkit-gradient(left top,left bottom,color-stop(0%,rgba(255,255,255,0)),color-stop(100%,'. esc_attr($ved_primary_color) .'));
    background: -webkit-linear-gradient(top,rgba(255,255,255,0) 0%, '. esc_attr($ved_primary_color) .' 100%);
    background: -o-linear-gradient(top,rgba(255,255,255,0) 0%,'. esc_attr($ved_primary_color) .' 100%);
    background: -ms-linear-gradient(top,rgba(255,255,255,0) 10%,'. esc_attr($ved_primary_color) .' 100%);
    background: linear-gradient(rgba(0,0,0,0) 0%,'. esc_attr($ved_primary_color) .' 100%);
}

.scroll-top:hover,
.form-control:focus,input[type=text]:focus,
.header-row .extras-menu .icon-wrap-circle .icon-wrap,.owl-carousel .owl-buttons>*:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.widget.woocommerce .tagcloud a:hover,
.woocommerce .woocommerce-Input:focus,
.quantity .input-text:focus,
.wpcf7-text:focus,
.wpcf7-number:focus,
.wpcf7-date:focus,
.wpcf7-textarea:focus,
.wpcf7-select:focus,
.mc4wp-form-fields .input-wrapper input:focus,
.product-slider .slider-nav .slider-item-nav.slick-current img,
.woocommerce div.product .product-slider .slick-arrow:hover,
.main-slider .ved-image-slider .owl-buttons > div,
.flex-direction-nav > li,
.scroll-top:hover:before,
.ved-price-list .featured-highlight,
input[type="radio"] + label:before, input[type="radio"] + span:before, input[type="checkbox"] + label:before, input[type="checkbox"] + span:before,
.newsletter_show_again:before,
.vedanta-slider .slides .owl-buttons > div
{
    border-color: ' . esc_attr($ved_primary_color) . ';
}
.dddemo3 .sec-head-style h3:before,.dddemo3 .wishlist-title h2:before{
	border-right-color: ' . esc_attr($ved_primary_color) . ';
}
.pagination>.active>a,
.pagination>.active>span,
.pagination>.active:hover>span{
    background: ' . esc_attr($ved_secondry_color) . ';
    border-color: ' . esc_attr($ved_secondry_color) . ';
    color: #fff
}

.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span:focus,
.pagination>.active>span:hover,
.pagination>li>a:focus,
.pagination>li>a:hover,
.pagination>li>span:focus,
.pagination>li>span:hover,
.pager li>a:focus,
.pager li>a:hover,
.pager li>span:focus,
.pager li>span:hover {
    background: ' . esc_attr($ved_primary_color) . ';
    border-color: ' . esc_attr($ved_primary_color) . ';
    color: #fff
}

.color-brand-hvr,
.service-sec .service-box:hover .elementor-image-box-img {
    color: ' . esc_attr($ved_secondry_color) . ';
}

.bg-brand-hvr,
.main-menu,
.header-1 .products-cats-menu .cats-menu-title,
.ved-main-megamenu .inner-nav > li:hover > a,
.products-search .search-submit,
.extras-menu .icon-wrap .icon-box .mini-item-counter,
.extras-menu .icon-wrap-circle:hover .icon-wrap .icon-box,
.main-slider .ved-image-slider .owl-buttons > div:hover,
.flex-direction-nav > li:hover,
.service-sec .service-box:hover .elementor-image-box-img,
.ved-woo-product-tab .ved-nav-tab li.active a,.ved-woo-product-tab .ved-nav-tab li a:hover,
.dddemo1 .footer .social-icons > li > a,
.vedanta-slider .slides .owl-buttons > div:hover{
    background-color: ' . esc_attr($ved_secondry_color) . ';
}

.main-slider .ved-image-slider .owl-buttons > div:hover,
.flex-direction-nav > li:hover,
.vedanta-slider .slides .owl-buttons > div:hover{
	border-color: ' . esc_attr($ved_secondry_color) . ';
}
';