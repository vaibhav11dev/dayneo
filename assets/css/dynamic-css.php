<?php
global $post, $wp_query, $dd_options;
$dayneo_dynamic_css	 = '';
$dayneo_template_url	 = get_template_directory_uri();

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( function_exists( 'is_buddypress' ) ) {
        if ( is_buddypress() ) {
            $post_id = restora_bp_get_id();
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
$dd_width_layout		 = $dd_options[ 'dd_width_layout' ];
$dd_width_px			 = $dd_options[ 'dd_width_px' ];
$dd_custom_width_px		 = $dd_options[ 'dd_custom_width_px' ];
$dd_container_width_px		 = (int)$dd_width_px - 30;
$dd_container_custom_width_px	 = (int)$dd_custom_width_px - 30;

//General - Layout Width
if ( $dd_width_px != "custom" && ( $dd_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$dayneo_dynamic_css .= '
		body {
	width: ' . esc_attr($dd_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($dd_width_px) . 'px) {
    .container {
        width: ' . esc_attr($dd_container_width_px) . 'px;
    }
}
';
} elseif ( $dd_width_px != "custom" ) {
	$dayneo_dynamic_css .= '
@media (min-width: ' . esc_attr($dd_width_px) . 'px) {
    .container {
        width: ' . esc_attr($dd_container_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
} elseif ( $dd_width_px == "custom" && ( $dd_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$dayneo_dynamic_css .= '
body {
	width: ' . esc_attr($dd_custom_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($dd_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($dd_container_custom_width_p) . 'px;
    }
}
';
} elseif ( $dd_width_px == "custom" ) {
	$dayneo_dynamic_css .= '
@media (min-width: ' . esc_attr($dd_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($dd_container_custom_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
}

// Body bg color when layout style is boxed
//$dayneo_dynamic_css .= '
//body {
//    background-color: #ecebe9;
//}
//';

// General - Fullwidth - Fluid Template Left/Right Padding
$dd_hundredp_padding		 = $dd_options[ 'dd_hundredp_padding' ];
$dayneo_hundredp_padding	 = get_post_meta( $post_id, 'dayneo_hundredp_padding', true );
if ( is_page_template( 'fullwidth-fluid.php' ) ) {
	if ( $dayneo_hundredp_padding ) {
		$dayneo_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($dayneo_hundredp_padding) . ';
			    padding-right: ' . esc_attr($dayneo_hundredp_padding) . ';
			}
		';
	} else {
		$dayneo_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($dd_hundredp_padding) . ';
			    padding-right: ' . esc_attr($dd_hundredp_padding) . ';
			}
		';
	}
}

// General - Content Top & Bottom Padding
$dd_content_top_bottom_padding = $dd_options[ 'dd_content_top_bottom_padding' ];
$dayneo_content_top_bottom_padding	 = get_post_meta( $post_id, 'dayneo_content_top_bottom_padding', true );
if ( $dayneo_content_top_bottom_padding ) {
	$dayneo_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($dayneo_content_top_bottom_padding) . ';
		padding-bottom:' . esc_attr($dayneo_content_top_bottom_padding) . ';
		padding-left: 0;
		padding-right: 0;
}
';
} elseif( $dd_content_top_bottom_padding ) {
	$dayneo_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($dd_content_top_bottom_padding[ 'padding-top' ]) . ';
		padding-bottom:' . esc_attr($dd_content_top_bottom_padding[ 'padding-bottom' ]) . ';
		padding-left: 0;
		padding-right: 0;
}
';
}

/* -----------------------------------------------------------------
  [Header Section Style]
 */

// For Sticky Header
if ( is_user_logged_in() ) {
	$dayneo_dynamic_css .= '
	.is_stuck {
		margin-top: 32px;
	}
';
}

if ( $dd_options[ 'dd_sticky_header' ] == 0 ) {
	$dayneo_dynamic_css .= '
	.is_stuck {
		display: none;
	}
';
}

//Header Topbar Color
if ( isset( $dd_options[ 'dd_topbar_color' ] ) ) {
	$dayneo_dynamic_css .= '
	.top-bar.top-bar-color {
		background: ' . esc_attr($dd_options[ 'dd_topbar_color' ]) . ';
	}
';
}

// Hero Header Custom Height
$dayneo_hero_height_custom	 = get_post_meta( $post_id, 'dayneo_hero_height_custom', true );
$dayneo_dynamic_css		 .= '
.hero-height-custom {
	height: ' . esc_attr($dayneo_hero_height_custom) . 'vh;
}
';


/* -----------------------------------------------------------------
  [Page Title Bar Style]
 */
$dd_pagetitlebar_height			 = dayneo_get_option( 'dd_pagetitlebar_height', 'medium' );
$dayneo_page_title_bar_height		 = get_post_meta( $post_id, 'dayneo_page_title_bar_height', true );
$dd_pagetitlebar_custom			 = dayneo_get_option( 'dd_pagetitlebar_custom', '' );
$dayneo_page_title_bar_height_custom	 = get_post_meta( $post_id, 'dayneo_page_title_bar_height_custom', true );

// 1.1 Page Title Bar Custom Height
if ( $dayneo_page_title_bar_height == 'custom' && $dayneo_page_title_bar_height_custom ) {
	$dayneo_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($dayneo_page_title_bar_height_custom) . 'px 0;
}
';
} elseif ( $dayneo_page_title_bar_height == 'default' && $dd_pagetitlebar_height == 'custom' && $dd_pagetitlebar_custom ) {
	$dayneo_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($dd_pagetitlebar_custom) . 'px 0;
}
';
}

$dd_pagetitlebar_background_color	 = dayneo_get_option( 'dd_pagetitlebar_background_color', '' );
$dayneo_page_title_bar_bg_color	 = get_post_meta( $post_id, 'dayneo_page_title_bar_bg_color', true );
// 1.2 Page Title Bar Background Color
if ( $dayneo_page_title_bar_bg_color ) {
	$dayneo_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($dayneo_page_title_bar_bg_color) . ';
}
';
} elseif ( $dd_pagetitlebar_background_color ) {
	$dayneo_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($dd_pagetitlebar_background_color) . ';
}
';
}

$dd_pagetitlebar_background	 = dayneo_get_option( 'dd_pagetitlebar_background', '' );
$dayneo_page_title_bar_bg	 = get_post_meta( $post_id, 'dayneo_page_title_bar_bg', true );
// 1.3 Page Title Bar Background Image
if ( $dayneo_page_title_bar_bg ) {
	$dayneo_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url(wp_get_attachment_url( $dayneo_page_title_bar_bg )) . '");
}
';
} elseif ( isset( $dd_pagetitlebar_background[ 'url' ] ) && $dd_pagetitlebar_background[ 'url' ] ) {
	$dayneo_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url($dd_pagetitlebar_background[ 'url' ]) . '");
}
';
}

/* -----------------------------------------------------------------
  [Footer Style]
 */
$dd_main_pattern	 = dayneo_get_option( 'dd_pattern', '' );
$dd_image_patten_array	 = array( 'none', 'pattern_1_thumb.png', 'pattern_2_thumb.png', 'pattern_3_thumb.png', 'pattern_4_thumb.png', 'pattern_5_thumb.png', 'pattern_6_thumb.png', 'pattern_7_thumb.png', 'pattern_8_thumb.png' );
if ( ! empty( $dd_main_pattern ) && $dd_main_pattern != 'none' && in_array( $dd_main_pattern, $dd_image_patten_array ) ) {
	$dd_main_pattern	 = $dayneo_template_url . '/assets/images/pattern/' . $dd_main_pattern;
	$dayneo_dynamic_css	 .= '
    .footer {
	background-image: url(' .  esc_url($dd_main_pattern) . ');
    }
    ';
} else {
	$dd_footer_image_src		 = dayneo_get_option( 'dd_footer_background_image' );
	$dd_footer_image		 = dayneo_get_option( 'dd_footer_image', 'cover' );
	$dd_footer_background_repeat	 = dayneo_get_option( 'dd_footer_image_background_repeat', 'no-repeat' );
	$dd_footer_background_position	 = dayneo_get_option( 'dd_footer_image_background_position', 'center top' );
	if ( $dd_footer_image_src[ 'url' ] ) {
		$dayneo_dynamic_css .= '
.footer {
	background-image: url("' . esc_url( $dd_footer_image_src[ 'url' ] ) . '");
	background-position: ' . esc_attr($dd_footer_background_position) . ';
	background-repeat: ' . esc_attr($dd_footer_background_repeat) . ';
	border-bottom: 0;
	background-size: ' . esc_attr($dd_footer_image) . ';
	width: 100%;
}
';
	}

	$dd_footer_bg_color = dayneo_get_option( 'dd_footer_bg_color', '' );
	if ( ! empty( $dd_footer_bg_color ) ) {
		$dayneo_dynamic_css .= '
.footer {
	background-color: ' . esc_attr($dd_footer_bg_color) . ';
}
';
	}

	$dd_footer_parallax = dayneo_get_option( 'dd_footer_parallax', '' );
	if ( $dd_footer_parallax == 1 ) {
		$dayneo_dynamic_css .= '
.footer {
	background-attachment: fixed;
}
';
	}
}

/* -----------------------------------------------------------------
  [Portfolio Style]
 */
$dd_portfolio_hover_color	 = dayneo_get_option( 'dd_portfolio_hover_color', '' );
$rgb				 = dayneo_hex2rgb( $dd_portfolio_hover_color );
if ( is_array( $rgb ) ) {
	$dayneo_dynamic_css .= '
.works-grid .work-overlay {
	background: rgba(' . esc_attr($rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ]) . ', 0.8);
}
';
}

/* -----------------------------------------------------------------
  [Retina Support Style]
 */
$dd_header_logo_retina = dayneo_get_option( 'dd_header_logo_retina', '' );
if ( $dd_header_logo_retina != "" ) {
	$dayneo_dynamic_css .= '
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
$dd_custom_font_woff	 = dayneo_get_option( 'dd_custom_font_woff' );
$dd_custom_font_ttf	 = dayneo_get_option( 'dd_custom_font_ttf' );
$dd_custom_font_svg	 = dayneo_get_option( 'dd_custom_font_svg' );
$dd_custom_font_eot	 = dayneo_get_option( 'dd_custom_font_eot' );
if ( (isset( $dd_custom_font_woff[ 'url' ] ) != "") && ( $dd_custom_font_svg[ 'url' ] != "") && ($dd_custom_font_eot[ 'url' ] != "" ) && ($dd_custom_font_ttf[ 'url' ] != "" ) ) {
	$dayneo_dynamic_css .= '
@font-face {
    font-family: "CustomFont";
    src: url("' .  esc_url($dd_custom_font_eot[ 'url' ]) . '");
    src: url("' .  esc_url($dd_custom_font_eot[ 'url' ]) . '?#iefix") format("eot"), url("' .  esc_url($dd_custom_font_woff[ 'url' ]) . '") format("woff"), url("' .  esc_url($dd_custom_font_ttf[ 'url' ]) . '") format("truetype"), url("' .  esc_url($dd_custom_font_svg[ 'url' ]) . '#CustomFont") format("svg");
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
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_title_font', '#blog-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Blog Tagline Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_tagline_font', '#tagline', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Main Menu Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_menu_font', '.main-nav', $additional_css = 'line-height:20px', $additional_color_css_class = '', $imp = '' );

	//Top Menu Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_top_menu_font', '.top-bar-list', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Post Title Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_post_font', '.entry-header .post-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Post Content Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_content_font', '.entry-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Widget Title Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_widget_title_font', '.widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );
	
	//Widget Content Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_widget_content_font', '.widget-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

	//Footer Widget Title Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_footer_widget_title_font', '.footer .widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

	//Footer Widget Content Font
	$dayneo_dynamic_css		 .= dayneo_print_fonts( 'dd_footer_widget_content_font', '.footer .widget-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );
        
        //ThemeVedanta Slider Heading Font 
        $dayneo_dynamic_css        .= dayneo_print_fonts( 'dd_slider_heading_font', '.tvslider .slide-heading', $additional_css = '', $additional_color_css_class = '', $imp = '' ); 
        
        //ThemeVedanta Slider Caption Font 
        $dayneo_dynamic_css        .= dayneo_print_fonts( 'dd_slider_caption_font', '.tvslider .slide-caption', $additional_css = '', $additional_color_css_class = '', $imp = '' ); 

	//H1 to H6 Font
	for ( $i = 1; $i < 7; $i ++ ) {
		//we get all h1 to h6 Fonts, dd_content_h1_font ... to dd_content_h6_font values.
		$dayneo_dynamic_css	 .= dayneo_print_fonts( 'dd_content_h' . $i . '_font', "h{$i}", $additional_css = '' );
	}
}

/* -----------------------------------------------------------------
  [General Style Options]
 */

$dd_main_menu_hover_font_color	 = $dd_options[ 'dd_main_menu_hover_font_color' ];
$dd_sub_menu_hover_font_color	 = $dd_options[ 'dd_sub_menu_hover_font_color' ];
$dd_form_bg_color		 = $dd_options[ 'dd_form_bg_color' ];
$dd_form_text_color		 = $dd_options[ 'dd_form_text_color' ];
$dd_form_border_color		 = $dd_options[ 'dd_form_border_color' ];

$dayneo_dynamic_css .= '
.sub-menu li > a:hover, 
.sub-menu li > a:focus, 
.sub-menu li.submenu-open > a {
	color: ' . esc_attr($dd_sub_menu_hover_font_color) . ';
}
.form-control {
	background-color: ' . esc_attr($dd_form_bg_color) . ';
	color: ' . esc_attr($dd_form_text_color) . ';
	border-color: ' . esc_attr($dd_form_border_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Sharing Box Options]
 */

$dd_sharing_box_icon_color	 = $dd_options[ 'dd_sharing_box_icon_color' ];
$dd_sharing_box_color		 = $dd_options[ 'dd_sharing_box_color' ];
$dd_sharing_box_radius		 = $dd_options[ 'dd_sharing_box_radius' ];

$dayneo_dynamic_css .= '
.share-this a {
	background: ' . esc_attr($dd_sharing_box_color) . ';
	border-radius: ' . esc_attr($dd_sharing_box_radius) . ';
	color: ' . esc_attr($dd_sharing_box_icon_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Media Links Options]
 */
$dd_social_color	 = $dd_options[ 'dd_social_color' ];
$dd_social_boxed_color	 = $dd_options[ 'dd_social_boxed_color' ];
$dd_social_boxed_radius	 = $dd_options[ 'dd_social_boxed_radius' ];

$dayneo_dynamic_css .= '
.header-social.social-icons > li > a {
	color: ' . esc_attr($dd_social_color) . ';
}
.header-social.boxed-icons > li > a {
	background: ' . esc_attr($dd_social_boxed_color) . ';
	border-radius: ' . esc_attr($dd_social_boxed_radius) . ';
	border-color: ' . esc_attr($dd_social_boxed_color) . ';
}
';


/* -----------------------------------------------------------------
  [Menu Style]
 */
$dd_main_menu_padding	 = dayneo_get_option( 'dd_main_menu_padding', '15px' );
$dd_menu_text_transform	 = dayneo_get_option( 'dd_menu_text_transform', 'none' );
$dayneo_dynamic_css	 .= '
.inner-nav > li > a {
	text-transform: ' . esc_attr($dd_menu_text_transform) . ';
	padding-top: ' . esc_attr($dd_main_menu_padding[ 'padding-top' ]) . ';
	padding-right: ' . esc_attr($dd_main_menu_padding[ 'padding-right' ]) . ';
	padding-bottom: ' . esc_attr($dd_main_menu_padding[ 'padding-bottom' ]) . ';
	padding-left: ' . esc_attr($dd_main_menu_padding[ 'padding-left' ]) . ';
}
';

/* -----------------------------------------------------------------
  [Mega Menu Style]
 */


$dd_megamenu_title_size	 = dayneo_get_option( 'dd_megamenu_title_size', '13px' );
$dd_menu_font		 = dayneo_get_option( 'dd_menu_font' );
$dd_widget_content_font	 = dayneo_get_option( 'dd_widget_content_font' );

if ( $dd_width_px != "custom" ) {
	$dayneo_width_col_span_1	 = (int)$dd_container_width_px / 4;
	$dayneo_width_col_span_2	 = (int)$dayneo_width_col_span_1 * 2;
	$dayneo_width_col_span_3	 = (int)$dayneo_width_col_span_1 * 3;

	$dayneo_dynamic_css .= '
@media (min-width: ' . esc_attr($dd_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($dayneo_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($dayneo_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($dayneo_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($dd_container_width_px) . 'px;
    }
}
';
} else {

	$dayneo_width_col_span_1	 = (int)$dd_container_custom_width_px / 4;
	$dayneo_width_col_span_2	 = (int)$dayneo_width_col_span_1 * 2;
	$dayneo_width_col_span_3	 = (int)$dayneo_width_col_span_1 * 3;

	$dayneo_dynamic_css .= '
@media (min-width: ' . esc_attr($dd_custom_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($dayneo_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($dayneo_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($dayneo_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($dd_container_custom_width_px) . 'px;
    }
}
';
}

if ( $dd_options[ 'dd_megamenu' ] == '1' ) {
	$dayneo_dynamic_css .= '
 .ved-megamenu-wrapper .ved-megamenu-title {
    font-family: ' . esc_attr($dd_menu_font[ 'font-family' ]) . ';
    font-size: ' . esc_attr($dd_megamenu_title_size) . ';
    text-transform: ' . esc_attr($dd_menu_text_transform) . ';
}

 .ved-megamenu-wrapper .ved-megamenu-bullet,
.ved-megamenu-bullet {
    border-left: 3px solid ' . esc_attr($dd_menu_font[ 'color' ]) . ';
}

ul.nav-menu > li {
    float: left;
}

ul.nav-menu > li.ved-dropdown-menu {
    position: relative;
}

ul.nav-menu > li.ved-dropdown-menu li {
    position: relative;
    width: 100%;
}

ul.nav-menu li.ved-dropdown-menu li:hover ul,
ul.nav-menu li.ved-dropdown-menu li.nav-hover ul,
ul.nav-menu li.ved-dropdown-menu li li:hover ul,
ul.nav-menu li.ved-dropdown-menu li li.nav-hover ul,
ul.nav-menu li.ved-dropdown-menu li li li:hover ul,
ul.nav-menu li.ved-dropdown-menu li li li.nav-hover ul {
    left: 14em;
}

ul.nav-menu li.ved-dropdown-menu ul {
    left: 0px;
    width: 14em;
}

ul.nav-menu .ved-megamenu-menu .widget-content a {
    color: ' . esc_attr($dd_widget_content_font[ 'color' ]) . ' ;
}

ul.nav-menu .ved-megamenu-menu li .widget-content ul,
ul.nav-menu .ved-megamenu-menu li:hover .widget-content ul {
    background: transparent;
}

.center-menu ul.nav-menu li {
    display: block;
}

.ved-megamenu-wrapper.col-span-1,
.ved-megamenu-wrapper.col-span-2,
.ved-megamenu-wrapper.col-span-3 {
    margin-left: -' . esc_attr($dd_main_menu_padding[ 'padding-left' ]) . ';
}

ul.nav-menu li li:hover .ved-megamenu-title,
ul.nav-menu li li:hover .ved-megamenu-title a,
ul.nav-menu li li.current-menu-item .ved-megamenu-title, 
ul.nav-menu li li.current-menu-item .ved-megamenu-title a, 
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title,
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title a {
    color: ' . esc_attr($dd_main_menu_hover_font_color) . ';
}
';
}

/* -----------------------------------------------------------------
  [Main Color Scheme Style]
 */

$dd_primary_color	 = dayneo_get_option( 'dd_primary_color', '#27CBC0' );
$dd_secondry_color	 = dayneo_get_option( 'dd_secondry_color', '#1fa098' );
$dayneo_dynamic_css	 .= '
::-moz-selection {
    background: ' . esc_attr($dd_primary_color) . ';
    color: #fff!important
}

::-webkit-selection {
    background: ' . esc_attr($dd_primary_color) . ';
    color: #fff!important
}

::selection {
    background: ' . esc_attr($dd_primary_color) . ';
    color: #fff!important
}

a:hover, 
a:focus,
.post-meta>li>a:hover,
.post-meta>li>a:focus,
.top-bar-right .dropdown > .expand-more:hover, #_desktop_wishtlistTop .yith-contents:hover
{
    color: ' . esc_attr($dd_primary_color) . ';
}

.divider-line:after,
.alert-brand,
.label-base,
.btn.btn-base:hover,
.nav-text-tabs>li>a:after,
.owl-controls-brand .owl-page span,
.owl-page span,
.cart-badge,
.post.format-quote,
.post.format-quote blockquote,
.social-icons>li>a:hover,
.tags a:focus,
.tags a:hover,
.divider-line::after,
.button.wc-backward:hover,
.button.wc-forward
{
    background: ' . esc_attr($dd_primary_color) . ';
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
.sub-menu li > a:hover,
.sub-menu li > a:focus,
.sub-menu li.submenu-open > a,
.scroll-top:focus,
.cart-hover .sub-cart-menu .list-product .list-product-detail a:hover,
.shop-item-title .woocommerce-loop-product__title a:hover,
.footer-center .widget_nav_menu .menu > li > a:before,
.post .entry-meta .read-more:hover,.navigation-links a:hover,
.woocommerce div.product div.summary .yith-wcwl-add-to-wishlist a:hover, .woocommerce div.product div.summary .compare:hover,
.innovatoryNextPrev .nextPrevProduct a.button,
.cart-table .product-name a:hover
{
    color: ' . esc_attr($dd_primary_color) . ';
}

.color-brand {
    color: ' . esc_attr($dd_primary_color) . ';
}

.bg-brand,
.progress-bar,
.products-search .search-submit:hover,
.main-menu,
.extras-menu .icon-wrap:hover .icon-box,
.extras-menu .icon-wrap-circle:hover .icon-wrap .icon-box .mini-item-counter,
.extras-menu .icon-wrap .icon-box,
.footer .copyright,.owl-carousel .owl-buttons>*:hover,.post-columns .post .post_thumbnail .meta_date,.post-columns .post .post_thumbnail .blogicons a.icon:hover,
#_mobile_cart .icon-box .mini-item-counter,
.mobile-search-bar,.widget_shopping_cart .woocommerce-mini-cart__buttons .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.shop-item-tools a:hover, .button.wishlist .yith-wcwl-add-button a.add_to_wishlist:hover,
.product .onsale,
.single-product .product .single_add_to_cart_button:hover, #review_form .submit:hover, .woocommerce-address-fields .button:hover, .woocommerce-form-coupon .button:hover, .woocommerce .woocommerce-Button:hover, .widget_product_search .widget-content button:hover, .wpcf7-submit:hover,
.woocommerce div.product .product-slider .slick-arrow:hover
{
    background-color: ' . esc_attr($dd_primary_color) . ';
}

.post-columns .post .post_thumbnail .post-thumbnail:after{
	background: -moz-linear-gradient(top,rgba(255,255,255,0) 0%, '. esc_attr($dd_primary_color) .' 100%);
    background: -webkit-gradient(left top,left bottom,color-stop(0%,rgba(255,255,255,0)),color-stop(100%,'. esc_attr($dd_primary_color) .'));
    background: -webkit-linear-gradient(top,rgba(255,255,255,0) 0%, '. esc_attr($dd_primary_color) .' 100%);
    background: -o-linear-gradient(top,rgba(255,255,255,0) 0%,'. esc_attr($dd_primary_color) .' 100%);
    background: -ms-linear-gradient(top,rgba(255,255,255,0) 10%,'. esc_attr($dd_primary_color) .' 100%);
    background: linear-gradient(rgba(0,0,0,0) 0%,'. esc_attr($dd_primary_color) .' 100%);
}

.scroll-top:hover,
.scroll-top:focus,
.form-control:focus,
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
.woocommerce div.product .product-slider .slick-arrow:hover
{
    border-color: ' . esc_attr($dd_primary_color) . ';
}

.owl-page.active span,
.owl-controls-brand .owl-page.active span {
    box-shadow: 0 0 0 3px ' . esc_attr($dd_primary_color) . ';
}

.pagination>.active>a,
.pagination>.active>span{
    background: ' . esc_attr($dd_secondry_color) . ';
    border-color: ' . esc_attr($dd_secondry_color) . ';
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
    background: ' . esc_attr($dd_primary_color) . ';
    border-color: ' . esc_attr($dd_primary_color) . ';
    color: #fff
}

.color-brand-hvr {
    color: ' . esc_attr($dd_secondry_color) . ';
}

.bg-brand-hvr,
.products-cats-menu .cats-menu-title,
.ved-main-megamenu .inner-nav > li:hover > a,
.products-search .search-submit,
.extras-menu .icon-wrap .icon-box .mini-item-counter,
.extras-menu .icon-wrap-circle:hover .icon-wrap .icon-box {
    background-color: ' . esc_attr($dd_secondry_color) . ';
}

.header-row .extras-menu .icon-wrap-circle:hover .icon-wrap
{
	border-color: ' . esc_attr($dd_secondry_color) . ';
}
';