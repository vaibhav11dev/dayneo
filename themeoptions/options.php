<?php
// Define global options.
define( 'BIGBO_IMAGEFOLDER', get_template_directory_uri() . '/themeoptions/options/images/' );
define( 'BIGBO_IMAGEPATH', get_template_directory_uri() . '/themeoptions/options/images/functions/' );
define( 'BIGBO_DEFAULT', get_template_directory_uri() . '/assets/images/default/' );

// -> BEGIN Themeoption Setup
if ( ! class_exists( 'Redux' ) ) {
        $ved_options = get_option( 'ved_options' );
	return;
}

global $ved_options;

$ved_options		 = "ved_options"; // This is your option name where all the Redux data is stored.
$bigbo_theme		 = wp_get_theme(); // For use with some settings. Not necessary.
$bigbo_rss_url	 = get_bloginfo( 'rss_url' );
$bigbo_site_url	 = esc_url( "http://themevedanta.com/" );
$bigbo_fb_url	 = '#';

$args = array(
	'opt_name'		 => $ved_options,
	'display_name'		 => $bigbo_theme->get( 'Name' ),
	'display_name'		 => '<img width="128" height="34" src="' . esc_url(get_template_directory_uri() . '/admin/assets/images/light-logo.png').'" alt="'. esc_attr(get_bloginfo( 'name' )) .'">',
	'page_type'		 => 'submenu',
	'allow_sub_menu'	 => false,
	'menu_title'		 => esc_html__( 'Theme Options', 'bigbo' ),
	'page_title'		 => esc_html__( 'Theme Options', 'bigbo' ),
	'google_api_key'	 => '',
	'google_update_weekly'	 => false,
	'async_typography'	 => false,
	'admin_bar'		 => true,
	'admin_bar_icon'	 => 'dashicons-portfolio',
	'admin_bar_priority'	 => 50,
	'use_cdn'		 => true,
	'dev_mode'		 => false,
	'forced_dev_mode_off'	 => true,
	'update_notice'		 => false,
	'customizer'		 => false,
	'page_priority'		 => 50,
	'page_parent'		 => 'themes.php',
	'page_permissions'	 => 'manage_options',
	'menu_icon'		 => '',
	'page_icon'		 => 'fa fa-cog',
	'page_slug'		 => 'bigbo_options',
	'ajax_save'		 => true,
	'default_show'		 => false,
	'default_mark'		 => '',
	'disable_tracking'	 => true,
	'customizer_only'	 => false,
	'save_defaults'		 => true,
	'footer_credit'		 => esc_html__( 'Thank you for using the Bigbo Theme', 'bigbo' ),
	'hints'			 => array(
		'icon'		 => 'fa fa-question-circle',
		'icon_position'	 => 'right',
		'icon_color'	 => '#444',
		'icon_size'	 => 'normal',
		'tip_style'	 => array(
			'color'		 => 'dark',
			'shadow'	 => true,
			'rounded'	 => false,
			'style'		 => '',
		),
		'tip_position'	 => array(
			'my'	 => 'top left',
			'at'	 => 'bottom right',
		),
		'tip_effect'	 => array(
			'show'	 => array(
				'effect'	 => 'slide',
				'duration'	 => '500',
				'event'		 => 'mouseover',
			),
			'hide'	 => array(
				'effect'	 => 'slide',
				'duration'	 => '500',
				'event'		 => 'click mouseleave',
			),
		),
	),
	'intro_text'		 => '<a href="http://bigbo.themevedanta.com/" title="Theme Homepage" target="_blank"><i class="fa fa-home"></i> Theme Homepage</a><a href="' . esc_url($bigbo_site_url . 'docs/').'" title="Documentation" target="_blank"><i class="fa fa-book"></i> Documentation</a><a href="' . esc_url($bigbo_site_url . 'support-forums/').'" title="Support" target="_blank"><i class="fa fa-life-bouy"></i> Support</a><a href="' . esc_url($bigbo_fb_url) . '" title="Facebook" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>',
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Bigbo Themes on Facebook',
	'icon'	 => 'fa fa-facebook',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Bigbo Themes on Twitter',
	'icon'	 => 'fa fa-twitter',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Bigbo Themes on Instagram',
	'icon'	 => 'fa fa-instagram',
);

Redux::setArgs( $ved_options, $args );
// -> END Themeoption Setup

// -> START Basic Fields
Redux::setSection( $ved_options, array(
	'id'	 => 'ved-general-main-tab',
	'title'	 => esc_html__( 'General', 'bigbo' ),
	'icon'	 => 'fa fa-dashboard',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-fav-tab',
	'title'		 => esc_html__( 'Favicon', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload custom favicon.', 'bigbo' ),
			'id'		 => 'ved_favicon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Favicon', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPhone (57px x 57px).', 'bigbo' ),
			'id'		 => 'ved_iphone_icon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPhone Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPhone Retina Version (114px x 114px).', 'bigbo' ),
			'id'		 => 'ved_iphone_icon_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPhone Retina Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPad (72px x 72px).', 'bigbo' ),
			'id'		 => 'ved_ipad_icon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPad Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPad Retina Version (144px x 144px).', 'bigbo' ),
			'id'		 => 'ved_ipad_icon_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPad Retina Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-loader-tab',
	'title'		 => esc_html__( 'Site Loader', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display loader in site', 'bigbo' ),
			'id'		 => 'ved_siteloader',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Enable Site Loader', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload custom loader.', 'bigbo' ),
			'id'		 => 'ved_loaderfile',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Loader', 'bigbo' ),
			'url'		 => true,
			'required'	 => array( array( "ved_siteloader", '=', 1 ) ),
			'default'	 => array(
				'url' => BIGBO_DEFAULT . 'loader.gif'
			),
		),
	),
)
);


Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-lay-tab',
	'title'		 => esc_html__( 'Layout', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
                array(
			'id'		 => 'ved_demo_style',
			'type'		 => 'select',
			'compiler'	 => false,
			'options'	 => array(
				'dddemo1'	 => esc_html__( 'Demo1', 'bigbo' ),
				'dddemo2'	 => esc_html__( 'Demo2', 'bigbo' ),
				'dddemo3'	 => esc_html__( 'Demo3', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Demo Style', 'bigbo' ),
			'default'	 => 'dddemo1',
			'class'	 => 'demo_style_opt',
		),
		array(
			'subtitle'	 => esc_html__( 'Select main content and sidebar alignment.', 'bigbo' ),
			'id'		 => 'ved_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1c'	 => BIGBO_IMAGEPATH . '1c.png',
				'2cl'	 => BIGBO_IMAGEPATH . '2cl.png',
				'2cr'	 => BIGBO_IMAGEPATH . '2cr.png',
				'3cm'	 => BIGBO_IMAGEPATH . '3cm.png',
				'3cr'	 => BIGBO_IMAGEPATH . '3cr.png',
				'3cl'	 => BIGBO_IMAGEPATH . '3cl.png',
			),
			'title'		 => esc_html__( 'Select layout', 'bigbo' ),
			'default'	 => '2cr',
		),
		array(
			'subtitle'	 => esc_html__( 'Boxed version automatically enables custom background', 'bigbo' ),
			'id'		 => 'ved_width_layout',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'fluid'	 => esc_html__( 'Wide', 'bigbo' ),
				'fixed'	 => esc_html__( 'Boxed', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Layout Style', 'bigbo' ),
			'default'	 => 'fluid',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your website', 'bigbo' ),
			'id'		 => 'ved_width_px',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				800	 => '800px',
				985	 => '985px',
				1200	 => '1200px',
				1600	 => '1600px',
				'custom' => esc_html__( 'Custom', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Layout Width', 'bigbo' ),
			'default'	 => 'custom',
		),
		array(
			'title'		 => esc_html__( 'Custom Layout Width', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Add the custom width in px (ex: 1024)', 'bigbo' ),
			'id'		 => "ved_custom_width_px",
			'type'		 => "text",
			'required'	 => array( array( "ved_width_px", '=', 'custom' ) ),
			'default'	 => '1340',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the left and right padding for the Fullwidth-Fluid main content area. Enter value in px. ex: 20px', 'bigbo' ),
			'id'		 => 'ved_hundredp_padding',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Fullwidth - Fluid Template Left/Right Padding', 'bigbo' ),
			'default'	 => '40px',
		),
		array(
			'subtitle'	 => esc_html__( 'Enter the page content top & bottom padding.', 'bigbo' ),
			'id'		 => 'ved_content_top_bottom_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => esc_html__( 'Content Top & Bottom Padding', 'bigbo' ),
			'left'		 => false,
			'right'		 => false,
			'default'	 => array(
				'padding-top'	 => '30px',
				'padding-bottom' => '40px',
				'units'		 => 'px',
			),
		),
		array(
			'id'		 => 'ved_info_consid1',
			'type'		 => 'info',
			'subtitle'	 => sprintf( '<h3>%s</h3>', esc_html__( 'Content and One Sidebar Width', 'bigbo' ) ),
		),
		array(
			'subtitle'	 => sprintf('<span class="subtitleription">%1$s</span> <img style="float:left, display:inline" src="%2$s2cl.png" /> <img style="float:left, display:inline" src="%3$s2cr.png" />', esc_html__( 'These options apply for the following layouts', 'bigbo' ), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH) ),
			'id'		 => 'ved_info_consid1_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your content', 'bigbo' ),
			'id'		 => 'ved_opt1_width_content',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Content Width', 'bigbo' ),
			'default'	 => '9',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 1', 'bigbo' ),
			'id'		 => 'ved_opt1_width_sidebar1',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 1 Width', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'id'		 => 'ved_info_consid2',
			'type'		 => 'info',
			'subtitle'	 => sprintf( '<h3>%s</h3>', esc_html__( 'Content and Two Sidebars Width', 'bigbo' ) ),
		),
		array(
			'subtitle'	 => sprintf( '<span class="subtitleription">%1$s</span> <img style="float:left, display:inline" src="%2$s3cm.png" /> <img style="float:left, display:inline" src="%3$s3cr.png" /> <img style="float:left, display:inline" src="%4$s3cl.png" />', esc_html__( 'These options apply for the following layouts', 'bigbo' ), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH) ),
			'id'		 => 'ved_info_consid2_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your content', 'bigbo' ),
			'id'		 => 'ved_opt2_width_content',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Content Width', 'bigbo' ),
			'default'	 => '6',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 1', 'bigbo' ),
			'id'		 => 'ved_opt2_width_sidebar1',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 1 Width', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 2', 'bigbo' ),
			'id'		 => 'ved_opt2_width_sidebar2',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 2 Width', 'bigbo' ),
			'default'	 => '3',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-popup-tab',
	'title'		 => esc_html__( 'Newslatter Popup', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display newslatter popup in site', 'bigbo' ),
			'id'		 => 'ved_popup',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Enable Newslatter Popup', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload background image will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'ved_popup_bg',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Newslatter Popup Background', 'bigbo' ),
			'url'		 => true,
			'default'	 => array(
				'url' => BIGBO_DEFAULT . 'newslater-bg.jpg'
			),
		),
            array(
			'subtitle'	 => esc_html__( 'Add heading will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'ved_popup_heading',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Heading', 'bigbo' ),
			'default'	 => 'Newsletter',
		),
            array(
			'subtitle'	 => esc_html__( 'Add content will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'ved_popup_content',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Content', 'bigbo' ),
			'default'	 => 'Sign up here to get 20% off on your next purchase, special offers and other discount information.',
		),
            array(
			'subtitle'	 => esc_html__( 'Add form shortcode will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'ved_popup_form',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Form Shortcode', 'bigbo' ),
		),
            
	),
)
);

// Header Main Sections
Redux::setSection( $ved_options, array(
	'id'	 => 'ved-header-main-tab',
	'title'	 => esc_html__( 'Header', 'bigbo' ),
	'icon'	 => 'fa fa-window-maximize icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-header-tab',
	'title'		 => esc_html__( 'Header', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose your Header Type', 'bigbo' ),
			'id'		 => 'ved_header_type',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'h1'	 => BIGBO_IMAGEFOLDER . '/header/header1.jpg',
				'h2'	 => BIGBO_IMAGEFOLDER . '/header/header2.jpg',
				'h3'	 => BIGBO_IMAGEFOLDER . '/header/header3.jpg',
				'h4'	 => BIGBO_IMAGEFOLDER . '/header/header4.jpg',
				'h5'	 => BIGBO_IMAGEFOLDER . '/header/header5.jpg',
			),
			'title'		 => esc_html__( 'Choose Header Type', 'bigbo' ),
			'default'	 => 'h1',
		),		
		array(
			'id'         => 'ved_cat_menu_status',
			'type'       => 'button_set',
			'title'      => esc_html__('Categories Menu', 'bigbo' ),
			'options'    => array(
				'enable' => esc_html__('Enable', 'bigbo' ),
				'disable' => esc_html__('Disable', 'bigbo' ),
			),
			'default'    => 'enable',
			'required'   => array(
				array('ved_header_type', '=', array('h1', 'h2', 'h4') ),
			)
		),
        array(
			'id'		 => 'ved_cat_menu_title',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Menu Title', 'bigbo' ),
			'default'	 => 'Shop By Category',
			'required'   => array(
				array('ved_cat_menu_status', '=', array('enable') ),
			)
		),
		array(
			'id'         => 'ved_header_width',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Header Width', 'bigbo' ),
			'options'    => array(
				'full_width' => esc_html__( 'Full Width', 'bigbo' ),
				'fixed_width'=> esc_html__( 'Fixed Width', 'bigbo' ),
			),
			'default'    => 'full_width',
			'required'   => array(
				array( 'ved_width_layout', '=', 'fluid' ),
				array( 'ved_header_type', '=', array( 'h3' ) ),
			),
		),
		array(
			'id'       => 'ved_header_transparent',
			'type'     => 'switch',
			'title'    => esc_html__('Header Transparent', 'bigbo' ), 
			'subtitle'     => esc_html__('This will display the header above the page content. This is useful when displaying here or slider section below the header.', 'bigbo' ),
			'default'  => '0',
			'on'       => 'Enabled',
			'off'      => 'Disabled',
			'required'   => array(
				array( 'ved_header_type', '=', array( 'h3' ) ),
			),
		),
		array(
			'id'      => 'ved_woocommerce_icons-start',
			'type'    => 'section',
			'title'   => esc_html__('WooCommerce Icons', 'bigbo' ),
			'indent'  => true
		),
		array(
			'id'     => 'ved_show_header_cart',
			'type'   => 'switch',
			'title'  => esc_html__('Show Cart Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_cart_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Cart Icon', 'bigbo' ),
			'options'  => array(
				'fa fa-shopping-cart'                             => '<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>',
				'fa fa-shopping-basket'                           => '<i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i>',
				'fa fa-shopping-bag'                              => '<i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-empty-shopping-cart'=> '<i class="glyph-icon pgsicon-ecommerce-empty-shopping-cart fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-shopping-cart-1'    => '<i class="glyph-icon pgsicon-ecommerce-shopping-cart-1 fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-shopping-bag-4'     => '<i class="glyph-icon pgsicon-ecommerce-shopping-bag-4 fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-commerce-1'         => '<i class="glyph-icon pgsicon-ecommerce-commerce-1 fa-2x" aria-hidden="true"></i>',
			),
			'default' => 'fa fa-shopping-cart',
			'class'   => 'cart-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_cart', '=', 1),
			),
		),
		array(
			'id'     => 'ved_show_header_compare',
			'type'   => 'switch',
			'title'  => esc_html__('Show Compare Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_compare_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Compare Icon', 'bigbo' ),
			'options'  => array(
				'fa fa-compress'                       => '<i class="fa fa-compress fa-2x" aria-hidden="true"></i>',
				'fa fa-expand'                         => '<i class="fa fa-expand fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-arrows-9'=> '<i class="glyph-icon pgsicon-ecommerce-arrows-9 fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-repeat-2'=> '<i class="glyph-icon pgsicon-ecommerce-repeat-2 fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-shuffle' => '<i class="glyph-icon pgsicon-ecommerce-shuffle fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-arrows-7'=> '<i class="glyph-icon pgsicon-ecommerce-arrows-7 fa-2x" aria-hidden="true"></i>',
			),
			'default' => 'fa fa-compress',
			'class'   => 'compare-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_compare', '=', 1),
			),
		),
		array(
			'id'     => 'ved_show_header_wishlist',
			'type'   => 'switch',
			'title'  => esc_html__('Show Wishlist Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_wishlist_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Wishlist Icon', 'bigbo' ),
			'options'  => array(
				'fa fa-heart'                          => '<i class="fa fa-heart fa-2x" aria-hidden="true"></i>',
				'fa fa-heart-o'                        => '<i class="fa fa-heart-o fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-heart'   => '<i class="glyph-icon pgsicon-ecommerce-heart fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-shapes-1'=> '<i class="glyph-icon pgsicon-ecommerce-shapes-1 fa-2x" aria-hidden="true"></i>',
				'pgsicon-ecommerce-like'    => '<i class="glyph-icon pgsicon-ecommerce-like fa-2x" aria-hidden="true"></i>',
			),
			'default' => 'fa fa-heart',
			'class'   => 'wishlist-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_wishlist', '=', 1),
			),
		),
		array(
			'id'      => 'ved_woocommerce_icons-end',
			'type'   => 'section',
			'indent' => false,
		),

		array(
			'id'      => 'ved_topbar_colors-start',
			'type'    => 'section',
			'title'   => esc_html__('Topbar Colors', 'bigbo' ),
			'indent'  => true
		),
		array(
			'id'         => 'ved_topbar_bg_type',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Background Color Type', 'bigbo' ),
			'options'    => array(
				'default'    => esc_html__( 'Default', 'bigbo' ),
				'custom'     => esc_html__( 'Custom', 'bigbo' ),
			),
			'default'    => 'default',
		),
		array(
			'id'		 => 'ved_topbar_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'      => esc_html__('Background Color', 'bigbo' ),
			'default'	 => '#ffffff',
			'required'   => array(
				array('ved_topbar_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'		 => 'ved_topbar_text_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'      => esc_html__('Text Color', 'bigbo' ),
			'default'	 => '#323232',
			'required'   => array(
				array('ved_topbar_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'      => 'ved_topbar_colors-end',
			'type'   => 'section',
			'indent' => false,
		),

		array(
			'id'      => 'ved_header_colors-start',
			'type'    => 'section',
			'title'   => esc_html__('Header (Main) Colors', 'bigbo' ),
			'indent'  => true
		),
		array(
			'id'         => 'ved_header_bg_type',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Background Color Type', 'bigbo' ),
			'options'    => array(
				'default'    => esc_html__( 'Default', 'bigbo' ),
				'custom'     => esc_html__( 'Custom', 'bigbo' ),
			),
			'default'    => 'default',
		),
		array(
			'id'		 => 'ved_header_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Header Background Color', 'bigbo' ),
			'default'	 => '#ffffff',
			'required'   => array(
				array('ved_header_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'		 => 'ved_header_text_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Header Text Color', 'bigbo' ),
			'default'	 => '#323232',
			'required'   => array(
				array('ved_header_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'      => 'ved_header_colors-end',
			'type'   => 'section',
			'indent' => false,
		),
		),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-sticky-header-tab',
	'title'		 => esc_html__( 'Sticky Header', 'bigbo' ),
	'subsection'	 => true,
	'fields'          => array(
		array(
			'id'         => esc_html__('ved_sticky_header', 'bigbo' ),
			'type'       => 'switch',
			'title'      => esc_html__('Sticky Header', 'bigbo' ),
			'subtitle'   => esc_html__('Enable/disable sticky header.', 'bigbo' ),
			'default'    => true,
		),
		array(
			'id'         => esc_html__('ved_mobile_sticky_header', 'bigbo' ),
			'type'       => 'switch',
			'title'      => esc_html__('Mobile Sticky', 'bigbo' ),
			'subtitle'   => esc_html__('Enable/disable mobile sticky header.', 'bigbo' ),
			'default'    => true,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'      => 'ved_woocommerce_sticky_icons-start',
			'type'    => 'section',
			'title'   => esc_html__('WooCommerce Icons', 'bigbo' ),
			'indent'  => true
		),
		array(
			'id'     => 'ved_show_sticky_header_cart',
			'type'   => 'switch',
			'title'  => esc_html__('Show Cart Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'     => 'ved_show_sticky_header_compare',
			'type'   => 'switch',
			'title'  => esc_html__('Show Compare Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'     => 'ved_show_sticky_header_wishlist',
			'type'   => 'switch',
			'title'  => esc_html__('Show Wishlist Icon', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true, 
		),
		array(
			'id'      => 'ved_woocommerce_sticky_icons-end',
			'type'   => 'section',
			'indent' => false,
		),
		array(
			'id'   =>'divider_1',
			'type' => 'divide'
		),
		array(
			'id'         => 'ved_sticky_color_section_start',
			'type'       => 'section',
			'title'      => esc_html__( 'Sticky Color Settings', 'bigbo' ),
			'indent'     => true,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => esc_html__('ved_sticky_header_color', 'bigbo' ),
			'type'       => 'color',
			'title'      => esc_html__('Sticky Header Background Color', 'bigbo' ),
			'subtitle'   => esc_html__('Set sticky header background color.', 'bigbo' ),
			'default'    => '#ffffff',
			'transparent'=> false,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => esc_html__('ved_sticky_header_text_color', 'bigbo' ),
			'type'       => 'color',
			'title'      => esc_html__('Sticky Header Text Color', 'bigbo' ),
			'subtitle'   => esc_html__('Set sticky header text color.', 'bigbo' ),
			'default'    => '#969696',
			'transparent'=> false,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => 'ved_sticky_header_link_color',
			'type'       => 'color',
			'title'      => esc_html__('Link Color', 'bigbo' ),
			'subtitle'   => esc_html__('Set sticky header link color.', 'bigbo' ),
			'mode'       => 'background-color',
			'validate'   => 'color',
			'transparent'=> false,
			'default'    => '#04d39f',
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => 'ved_sticky_color_section_end',
			'type'       => 'section',
			'indent'     => false,
			'required'   => array('ved_sticky_header', '=', true),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-topbar-tab',
	'title'		 => esc_html__( 'Top Bar', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'      => 'ved_topbar_enable',
			'type'    => 'switch',
			'title'   => esc_html__('Topbar', 'bigbo' ),
			'default' => true,
		),
		array(
			'id'      => 'ved_topbar_mobile_enable',
			'type'    => 'switch',
			'title'   => esc_html__('Topbar Mobile', 'bigbo' ),
			'default' => true,
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'id'         => 'ved_topbar_layout',
			'type'       => 'sorter',
			'title'      => 'Layout',
			'subtitle'   => 'Select layout contents.',
			'description'=> '<p>'
				. '<strong>' . esc_html__( 'Notes', 'bigbo' ) .':</strong>'
				. '<ol>'
				. '<li>'. sprintf( wp_kses( __('<strong>Language</strong>: This content is <a href="%1$s" target="_blank">WPML</a> dependant and it will be available only if <a href="%1$s" target="_blank">WPML</a> is installed.', 'bigbo' ),
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
							),
							'strong' => true,
						)
					),
					'https://wpml.org/'
				) . '</li>'
				. '<li>'. sprintf( wp_kses( __('<strong>Currency</strong>: This content is <a href="%1$s" target="_blank">WooCommerce Currency Switcher</a> dependant and it will be available only if <a href="%1$s" target="_blank">WooCommerce Currency Switcher</a> is installed.', 'bigbo' ),
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
							),
							'strong' => true
						)
					),
					'https://wordpress.org/plugins/woocommerce-currency-switcher/'
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Topbar Menu</strong>: You can manage topbar menu from <strong>Appearance > Menus</strong>.', 'bigbo' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Social Profiles</strong>: You can manage social profiles from <strong>Theme Options > Social Media Links</strong>.', 'bigbo' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Phone Number/Email</strong>: You can manage phone number and email with <strong>below options</strong>.', 'bigbo' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				,
			'options'    => array(
				'Left'                => array(
					'email'           => esc_html__('Email', 'bigbo' ),
					'phone_number'    => esc_html__('Phone Number', 'bigbo' ),
				),
				'Right'               => array(
					'topbar_menu'     => esc_html__('Topbar Menu', 'bigbo' ),
					'social_profiles' => esc_html__('Social Profiles', 'bigbo' ),
				),
				'Available Items'     => array(
					'currency'        => esc_html__('Currency', 'bigbo' ),
					'language'        => esc_html__('Language', 'bigbo' ),
					
				),
			),
			'limits'   => array(
			),
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Phone number will display in the Contact Info section of your top header.', 'bigbo' ),
			'id'		 => 'ved_header_number',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Phone Number', 'bigbo' ),
			'default'	 => '+01 7890 123 456',
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Email address will display in the Contact Info section of your top header.', 'bigbo' ),
			'id'		 => 'ved_header_email',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Email Address', 'bigbo' ),
			'default'	 => 'contact@example.com',
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-logo-tab',
	'title'		 => esc_html__( 'Logo', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload a logo for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_header_logo',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Logo', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Select an image file for the retina version of the custom logo. It should be exactly 2x the size of main logo.', 'bigbo' ),
			'id'		 => 'ved_header_logo_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Logo (Retina Version @2x)', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. In px.', 'bigbo' ),
			'id'		 => 'ved_header_logo_retina_width',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Standard Logo Width for Retina Logo', 'bigbo' ),
		),
		array(
			'subtitle'	 => esc_html__( 'If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. In px.', 'bigbo' ),
			'id'		 => 'ved_header_logo_retina_height',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Standard Logo Height for Retina Logo', 'bigbo' ),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-search-content-tab',
	'title'		 => esc_html__( 'Search', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'     => 'ved_show_search',
			'type'   => 'switch',
			'title'  => esc_html__('Enable Search', 'bigbo' ),
			'on'     => esc_html__('Yes', 'bigbo' ),
			'off'    => esc_html__('No', 'bigbo' ),
			'default'=> true,
		),
		array(
			'id'         => 'ved_search_background_type',
			'type'       => 'button_set',
			'title'      => esc_html__('Search Box Background', 'bigbo' ),
			'options'    => array(
				'search-bg-default' => esc_html__('Default', 'bigbo' ),
				'search-bg-transparent' => esc_html__('Transparent', 'bigbo' ),
				'search-bg-white' => esc_html__('White', 'bigbo' ),
				'search-bg-dark'  => esc_html__('Dark', 'bigbo' ),
				'search-bg-theme'  => esc_html__('Theme', 'bigbo' ),
			),
			'default' => 'search-bg-default',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'         => 'ved_search_box_shape',
			'type'       => 'button_set',
			'title'      => esc_html__('Search Box Shape', 'bigbo' ),
			'options'    => array(
				'square'    => esc_html__('Square', 'bigbo' ),
				'rounded'   => esc_html__('Rounded', 'bigbo' ),
			),
			'default' => 'square',
			'required'=> array(
				array( 'ved_show_search', '=', 1 ),
			)
		),
		array(
			'id'		 => 'ved_search_content_type',
			'type'		 => 'select',
			'options'	 => array(
				'all'	 => esc_html__( 'Search for everything', 'bigbo' ),
				'product'	 => esc_html__( 'Search for products', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Search Content Type', 'bigbo' ),
			'default'	 => 'product',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'      => 'ved_show_categories',
			'type'    => 'switch',
			'title'   => esc_html__('Show Categories', 'bigbo' ),
			'on'      => esc_html__('Yes', 'bigbo' ),
			'off'     => esc_html__('No', 'bigbo' ),
			'default' => true,
			'required'=> array(
				array('ved_search_content_type', '=', array('product') ),
			)
		),
		array(
			'id'		 => 'ved_custom_categories_text',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Text', 'bigbo' ),
			'default'	 => 'All Categories',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_custom_categories_depth',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Depth', 'bigbo' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'subtitle'	 => esc_html__( 'Enter Category IDs to include. Divide every category by comma(,)', 'bigbo' ),
			'id'		 => 'ved_custom_categories_include',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Include', 'bigbo' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'subtitle'	 => esc_html__( 'Enter Category IDs to exclude. Divide every category by comma(,)', 'bigbo' ),
			'id'		 => 'ved_custom_categories_exclude',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Exclude', 'bigbo' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_custom_search_text',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Search Text', 'bigbo' ),
			'default'	 => 'Search entire store...',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_header_ajax_search',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'AJAX Search', 'bigbo' ),
			'default'	 => '1',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'   =>'divider_1',
			'type' => 'divide'
		),
		array(
			'id'         => 'ved_search_icon_title',
			'type'       => 'section',
			'title'      => esc_html__( 'Search Keyword', 'bigbo' ),
			'indent'     => true,
		),
		array(
			'id'       => 'ved_search_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Search Icon', 'bigbo' ),
			'options'  => array(
				'fa fa-search'                             => '<i class="fa fa-search fa-2x" aria-hidden="true"></i>',
				'flaticon-search'=> '<i class="flaticon-search"></i>',
				'pgsicon-ecommerce-shopping-cart-1'    => '<i class="glyph-icon pgsicon-ecommerce-shopping-cart-1 fa-2x" aria-hidden="true"></i>',
			),
			'default' => 'fa fa-search',
			'class'   => 'cart-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_cart', '=', 1),
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-title-tagline-tab',
	'title'		 => esc_html__( 'Title & Tagline', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you don\'t want to display title of your blog', 'bigbo' ),
			'id'		 => 'ved_blog_title',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Blog Title', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you don\'t want to display tagline of your blog', 'bigbo' ),
			'id'		 => 'ved_blog_tagline',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Blog Tagline', 'bigbo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-footer-main-tab',
	'title'	 => esc_html__( 'Footer', 'bigbo' ),
	'icon'	 => 'fa fa-columns icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-footer-subsec-footer-widgets-tab',
	'title'		 => esc_html__( 'Footer Widgets', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select how many footer widget areas you want to display.', 'bigbo' ),
			'id'		 => 'ved_footer_widget_col',
			'type'		 => 'image_select',
			'options'	 => array(
				'disable'	 => BIGBO_IMAGEPATH . '1c.png',
				'one'		 => BIGBO_IMAGEPATH . 'footer-widgets-1.png',
				'two'		 => BIGBO_IMAGEPATH . 'footer-widgets-2.png',
				'three'		 => BIGBO_IMAGEPATH . 'footer-widgets-3.png',
				'four'		 => BIGBO_IMAGEPATH . 'footer-widgets-4.png',
			),
			'title'		 => esc_html__( 'Number of Widget Cols in Footer', 'bigbo' ),
			'default'	 => 'disable',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-footer-subsec-custom-footer-tab',
	'title'		 => esc_html__( 'Custom Footer', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Available HTML tags and attributes:<b> <i> <a href="" > <blockquote> <del >
										<ins > <img /> <ul> <ol> <li>
										<code> <em> <strong> <div> <span> <h1> <h2> <h3> <h4> <h5> <h6>
										<table> <tbody> <tr> <td> <br /> <hr />', 'bigbo' ),
			'id'		 => 'ved_footer_content',
			'type'		 => 'textarea',
			'title'		 => esc_html__( 'Custom Footer', 'bigbo' ),
			'default'	 => '<p id="copyright"><span class="credits"><a href="' . esc_url($bigbo_site_url . 'bigbo-multipurpose-wordpress-theme/').'">Bigbo</a> theme by ThemeVedanta</span></p>',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-header-footer-tab',
	'title'		 => esc_html__( 'Footer Styles', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Custom background color of footer', 'bigbo' ),
			'id'		 => 'ved_footer_bg_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Footer Background color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Upload a footer background image for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_background_image',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Background Image', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Select if the footer background image should be displayed in cover or contain size.', 'bigbo' ),
			'id'		 => 'ved_footer_image',
			'type'		 => 'select',
			'options'	 => array(
				'cover'		 => esc_html__( 'Cover', 'bigbo' ),
				'contain'	 => esc_html__( 'Contain', 'bigbo' ),
				'none'		 => esc_html__( 'None', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Background Responsiveness Style', 'bigbo' ),
			'default'	 => 'cover',
		),
		array(
			'id'		 => 'ved_footer_image_background_repeat',
			'type'		 => 'select',
			'options'	 => array(
				'no-repeat'	 => esc_html__( 'no-repeat', 'bigbo' ),
				'repeat'	 => esc_html__( 'repeat', 'bigbo' ),
				'repeat-x'	 => esc_html__( 'repeat-x', 'bigbo' ),
				'repeat-y'	 => esc_html__( 'repeat-y', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Background Repeat', 'bigbo' ),
			'default'	 => 'no-repeat',
		),
		array(
			'id'		 => 'ved_footer_image_background_position',
			'type'		 => 'select',
			'options'	 => array(
				'center top'	 => esc_html__( 'center top', 'bigbo' ),
				'center center'	 => esc_html__( 'center center', 'bigbo' ),
				'center bottom'	 => esc_html__( 'center bottom', 'bigbo' ),
				'left top'	 => esc_html__( 'left top', 'bigbo' ),
				'left center'	 => esc_html__( 'left center', 'bigbo' ),
				'left bottom'	 => esc_html__( 'left bottom', 'bigbo' ),
				'right top'	 => esc_html__( 'right top', 'bigbo' ),
				'right center'	 => esc_html__( 'right center', 'bigbo' ),
				'right bottom'	 => esc_html__( 'right bottom', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Background Position', 'bigbo' ),
			'default'	 => 'center top',
		),
		array(
			'subtitle'	 => esc_html__( 'Check to enable parallax background image when scrolling.', 'bigbo' ),
			'id'		 => 'ved_footer_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Parallax Background Image', 'bigbo' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => sprintf( '<h3 style=\'margin: 0;\'>%s</h3>', esc_html__( 'Footer Default Pattern', 'bigbo' ) ),
			'id'		 => 'ved_header_footer',
			'type'		 => 'info',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the pattern for footer background', 'bigbo' ),
			'id'		 => 'ved_pattern',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'none'			 => BIGBO_IMAGEPATH . 'none.jpg',
				'pattern_1_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_1_thumb.png',
				'pattern_2_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_2_thumb.png',
				'pattern_3_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_3_thumb.png',
				'pattern_4_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_4_thumb.png',
				'pattern_5_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_5_thumb.png',
				'pattern_6_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_6_thumb.png',
				'pattern_7_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_7_thumb.png',
				'pattern_8_thumb.png'	 => BIGBO_IMAGEFOLDER . '/pattern/pattern_8_thumb.png',
			),
			'title'		 => esc_html__( 'Footer pattern', 'bigbo' ),
			'default'	 => 'none',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-payment-footer-tab',
	'title'		 => esc_html__( 'Footer Payment Icon', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon1',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon One', 'bigbo' ),
			'url'		 => true,
                        'default'	 => array(
				'url' => BIGBO_DEFAULT . 'visa.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link1',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon One Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon2',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Two', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'mastercard.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link2',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Two Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon3',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Three', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'paypal.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link3',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Three Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon4',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Four', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'american_express.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link4',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Four Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon5',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Five', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'discover.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link5',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Five Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'ved_footer_payment_icon6',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Six', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'diners.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'ved_footer_payment_link6',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Six Link', 'bigbo' ),
                    'default'	 => '#',
		),
		
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-pagetitlebar-tab',
	'title'	 => esc_html__( 'Page Title Bar', 'bigbo' ),
	'icon'	 => 'fa fa-pencil-square-o icon-large',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display page titlebar above the content and sidebar area', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_layout',
			'compiler'	 => true,
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Page Title Bar', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the display option to show the page title', 'bigbo' ),
			'id'		 => 'ved_display_pagetitlebar',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'titlebar_breadcrumb'	 => esc_html__( 'Title + Breadcrumb', 'bigbo' ),
				'titlebar'		 => esc_html__( 'Only Title', 'bigbo' ),
				'breadcrumb'		 => esc_html__( 'Only Breadcrumb', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Page Title & Breadcrumbs', 'bigbo' ),
			'default'	 => 'titlebar_breadcrumb',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Choose your page titlebar layout', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_layout_opt',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'title'		 => esc_html__( 'Page Title Bar Layout Type', 'bigbo' ),
			'options'	 => array(
				'titlebar_left'		 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_left.png',
				'titlebar_center'	 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_center.png',
				'titlebar_right'	 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_right.png',
			),
                        'default'	 => 'titlebar_left',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the height for your pagetitle bar', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_height',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'small'	 => 'Small',
				'medium' => 'Medium',
				'large'	 => 'Large',
				'custom' => esc_html__( 'Custom', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Page Title Bar Height', 'bigbo' ),
			'default'	 => 'small',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'title'		 => esc_html__( 'Custom Page Title Bar Height', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Add the custom height for page title bar. All height in px. Ex: 70', 'bigbo' ),
			'id'		 => "ved_pagetitlebar_custom",
			'type'		 => "text",
			'required'	 => array( array( "ved_pagetitlebar_height", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => esc_html__( 'Custom background color of page title bar', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_background_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Page Title Bar Background Color', 'bigbo' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => esc_html__( 'Select an image or insert an image url to use for the page title bar background.', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_background',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Page Title Bar Background', 'bigbo' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Check to enable parallax background image when scrolling.', 'bigbo' ),
			'id'		 => 'ved_pagetitlebar_background_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Parallax Background Image', 'bigbo' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-blog-main-tab',
	'title'	 => esc_html__( 'Blog', 'bigbo' ),
	'icon'	 => 'fa fa-newspaper-o icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-general-tab',
	'title'		 => esc_html__( 'General', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the blog style that will display on the blog pages.', 'bigbo' ),
			'id'		 => 'ved_blog_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'classic'		 => esc_html__( 'Classic', 'bigbo' ),
				'thumbnail_on_side'	 => esc_html__( 'Thumbnail On Side', 'bigbo' ),
				'grid'			 => esc_html__( 'Grid', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Blog Style', 'bigbo' ),
			'default'	 => 'classic',
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 posts per row is recommended to use with disabled Sidebar(s)', 'bigbo' ),
			'id'		 => 'ved_post_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Blog Grid layout', 'bigbo' ),
			'default'	 => '3',
			'required'	 => array(
				array( 'ved_blog_style', '=', 'grid' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will display on the archive/category pages.', 'bigbo' ),
			'id'		 => 'ved_blog_archive_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Blog Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Sidebar 1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose placement of the \'Share This\' buttons', 'bigbo' ),
			'id'		 => 'ved_share_this',
			'type'		 => 'select',
			'options'	 => array(
				'single'	 => esc_html__( 'Single Posts', 'bigbo' ),
				'page'		 => esc_html__( 'Single Pages', 'bigbo' ),
				'all'		 => esc_html__( 'All', 'bigbo' ),
				'disable'	 => esc_html__( 'Disable', 'bigbo' ),
			),
			'title'		 => esc_html__( '\'Share This\' buttons placement', 'bigbo' ),
			'default'	 => 'single',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'bigbo' ),
			'id'		 => 'ved_pagination_type',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'pagination'		 => esc_html__( 'Default Pagination', 'bigbo' ),
				'number_pagination'	 => esc_html__( 'Number Pagination', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Pagination Type', 'bigbo' ),
			'default'	 => 'number_pagination',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display edit post link', 'bigbo' ),
			'id'		 => 'ved_edit_post',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Edit Post Link', 'bigbo' ),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-post-tab',
	'title'		 => esc_html__( 'Posts', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta header', 'bigbo' ),
			'id'		 => 'ved_header_meta',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Header', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta date', 'bigbo' ),
			'id'		 => 'ved_meta_date',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Date', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta author', 'bigbo' ),
			'id'		 => 'ved_meta_author',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Author', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display post author avatar', 'bigbo' ),
			'id'		 => 'ved_author_avatar',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Enable Post Author Avatar', 'bigbo' ),
                        'default'	 => 0,
		),
                array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta categories', 'bigbo' ),
			'id'		 => 'ved_meta_cats',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Categories', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta tags', 'bigbo' ),
			'id'		 => 'ved_meta_tags',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Tags', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta comments', 'bigbo' ),
			'id'		 => 'ved_meta_comments',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Post Meta Comments', 'bigbo' ),
                        'default'	 => 0,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the position of the Previous/Next Post links', 'bigbo' ),
			'id'		 => 'ved_post_links',
			'type'		 => 'select',
			'options'	 => array(
				'after'	 => esc_html__( 'After posts', 'bigbo' ),
				'before' => esc_html__( 'Before posts', 'bigbo' ),
				'both'	 => esc_html__( 'Both', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Position of Previous/Next Posts Links', 'bigbo' ),
			'default'	 => 'after',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose if you want to display Similar posts in articles', 'bigbo' ),
			'id'		 => 'ved_similar_posts',
			'type'		 => 'select',
			'options'	 => array(
				'disable'	 => esc_html__( 'Disable', 'bigbo' ),
				'category'	 => esc_html__( 'Match by categories', 'bigbo' ),
				'tag'		 => esc_html__( 'Match by tags', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Display Similar Posts', 'bigbo' ),
			'default'	 => 'category',
		),
                array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display Similar posts in slider', 'bigbo' ),
			'id'		 => 'ved_similar_posts_carousel',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Display Similar Posts Carousel', 'bigbo' ),
                        'default'	 => 1,
		),
                array(
			'subtitle'	 => esc_html__( 'Choose number of similar posts', 'bigbo' ),
			'id'		 => 'ved_similar_posts_number',
			'type'		 => 'select',
			'options'	 => array(
				'3'	 => esc_html__( 'Three', 'bigbo' ),
				'4'	 => esc_html__( 'Four', 'bigbo' ),
				'5'	 => esc_html__( 'Five', 'bigbo' ),
				'6'	 => esc_html__( 'Six', 'bigbo' ),
				'7'	 => esc_html__( 'Seven', 'bigbo' ),
				'8'	 => esc_html__( 'Eight', 'bigbo' ),
			),
			'title'		 => esc_html__( 'No of Similar Posts', 'bigbo' ),
			'default'	 => '4',
		),
            
	),
)
);
Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-featured-tab',
	'title'		 => esc_html__( 'Featured Image', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured images on blog page', 'bigbo' ),
			'id'		 => 'ved_featured_images',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Featured Images', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured image on Single Blog Posts', 'bigbo' ),
			'id'		 => 'ved_blog_featured_image',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Enable Featured Image on Single Blog Posts', 'bigbo' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-portfolio-main-tab',
	'title'	 => esc_html__( 'Portfolio', 'bigbo' ),
	'icon'	 => 'fa fa-th icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-portfolio-subsec-general-tab',
	'title'		 => esc_html__( 'General', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Insert the number of posts to display per page.', 'bigbo' ),
			'id'		 => 'ved_portfolio_no_item_per_page',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Number of Portfolio Items Per Page', 'bigbo' ),
			'default'	 => '10',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the portfolio style that will display on the portfolio pages.', 'bigbo' ),
			'id'		 => 'ved_portfolio_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'grid'		 => esc_html__( 'Grid', 'bigbo' ),
				'grid_no_space'	 => esc_html__( 'Grid No Space', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Portfolio Style', 'bigbo' ),
			'default'	 => 'grid',
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 portfolio per row is recommended to use with disabled Sidebar(s)', 'bigbo' ),
			'id'		 => 'ved_portfolio_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Portfolio Grid Layout', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => esc_html__( 'Custom hover color of portfolio works', 'bigbo' ),
			'id'		 => 'ved_portfolio_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Portfolio Hover Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will be added to the archive/category portfolio pages.', 'bigbo' ),
			'id'		 => 'ved_portfolio_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Portfolio Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Sidebar 1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-portfolio-subsec-single-post-page-tab',
	'title'		 => esc_html__( 'Single Portfolio Page', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured images on single post pages.', 'bigbo' ),
			'id'		 => 'ved_portfolio_featured_image',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Featured Image on Single Portfolio', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to enable Author on portfolio items.', 'bigbo' ),
			'id'		 => 'ved_portfolio_author',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Show Author', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display the social sharing box.', 'bigbo' ),
			'id'		 => 'ved_portfolio_sharing',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Social Sharing Box', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display related portfolio.', 'bigbo' ),
			'id'		 => 'ved_portfolio_related_posts',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Related Portfolio', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to disable previous/next pagination.', 'bigbo' ),
			'id'		 => 'ved_portfolio_pagination',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Previous/Next Pagination', 'bigbo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-main-tab',
	'title'	 => esc_html__( 'WooCommerce', 'bigbo' ),
	'icon'	 => 'fa  fa-shopping-cart icon-large',
	)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-General-tab',
	'title'	 => esc_html__( 'General', 'bigbo' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Insert the number of products to display per page.', 'bigbo' ),
			'id'		 => 'ved_woo_items',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Number of Products Per Page', 'bigbo' ),
			'default'	 => '12',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to disable the ordering boxes displayed on the shop page.', 'bigbo' ),
			'id'		 => 'ved_woocommerce_bigbo_ordering',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Disable Woocommerce Shop Page Ordering Boxes', 'bigbo' ),
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 products per row is recommended to use with disabled Sidebar(s)', 'bigbo' ),
			'id'		 => 'ved_woocommerce_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Product Grid layout', 'bigbo' ),
			'default'	 => '4',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will display on the shop archive/category pages.', 'bigbo' ),
			'id'		 => 'ved_shop_archive_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Shop Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Siderbar 1',
		),         
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-prolisting-tab',
	'title'	 => esc_html__( 'Products Listing', 'bigbo' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'id' => 'ved_product_hover_style',
			'type' => 'ved_select_image',
			'title' => esc_html__('Product Hover Style', 'bigbo' ),
			'placeholder' => esc_html__('Select product hover style.', 'bigbo' ),
			'select2' => array(
				'allowClear' => 0,
			),
			'options' => Array(
				'default' => array(
					'alt' => esc_html__('Default', 'bigbo' ),
					'title' => esc_html__('Default', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/default.jpg'),
				),
				'icon-top-left' => array(
					'alt' => esc_html__('Icon Top Left', 'bigbo' ),
					'title' => esc_html__('Icon Top Left', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/icon-top-left.jpg'),
				),
				'image-center' => array(
					'alt' => esc_html__('Image Center', 'bigbo' ),
					'title' => esc_html__('Image Center', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/image-center.jpg'),
				),
				'image-left' => array(
					'alt' => esc_html__('Image Left', 'bigbo' ),
					'title' => esc_html__('Image Left', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/image-left.jpg'),
				),
				'image-bottom' => array(
					'alt' => esc_html__('Image Bottom', 'bigbo' ),
					'title' => esc_html__('Image Bottom', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/image-bottom.jpg'),
				),
				'image-bottom-2' => array(
					'alt' => esc_html__('Image Bottom 2', 'bigbo' ),
					'title' => esc_html__('Image Bottom 2', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/image-bottom-2.jpg'),
				),
				'image-bottom-bar' => array(
					'alt' => esc_html__('Image Bottom Bar', 'bigbo' ),
					'title' => esc_html__('Image Bottom Bar', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/image-bottom-bar.jpg'),
				),
				'info-bottom' => array(
					'alt' => esc_html__('Info Bottom', 'bigbo' ),
					'title' => esc_html__('Info Bottom', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/info-bottom.jpg'),
				),
				'info-bottom-bar' => array(
					'alt' => esc_html__('Info Bottom Bar', 'bigbo' ),
					'title' => esc_html__('Info Bottom Bar', 'bigbo' ),
					'img' => esc_url(BIGBO_IMAGEFOLDER.'/product_hover_style/info-bottom-bar.jpg'),
				),
			),
			'default' => 'image-center',
		),    
		array(
			'id' => 'ved_product_image_swap',
			'type' => 'switch',
			'title' => esc_html__('Swape Image On Hover', 'bigbo' ),
			'subtitle' => esc_html__('Product image change on hover.', 'bigbo' ),
			'on' => esc_html__('Yes', 'bigbo' ),
			'off' => esc_html__('No', 'bigbo' ),
			'default' => true,
		),
		array(
			'id' => 'ved_product_title_length',
			'type' => 'button_set',
			'title' => esc_html__('Product Title Length', 'bigbo' ),
			'options' => array(
				'full' => esc_html__('Full', 'bigbo' ),
				'single_line' => esc_html__('Single Line', 'bigbo' ),
			),
			'default' => 'single_line',
		),
		array(
			'id' => 'ved_product_hover_button_shape',
			'type' => 'button_set',
			'title' => esc_html__('Button Shape', 'bigbo' ),
			'options' => array(
				'square' => esc_html__('Square', 'bigbo' ),
				'round' => esc_html__('Round', 'bigbo' ),
			),
			'default' => 'square',
			'required' => array('ved_product_hover_style', '=', array('image-center', 'image-left', 'image-bottom', 'image-bottom-2', 'info-bottom')),
		),
		array(
			'id' => 'ved_product_hover_button_style',
			'type' => 'button_set',
			'title' => esc_html__('Button Style', 'bigbo' ),
			'options' => array(
				'flat' => esc_html__('Flat', 'bigbo' ),
				'border' => esc_html__('Border', 'bigbo' ),
			),
			'default' => 'flat',
			'required' => array('ved_product_hover_style', '=', array('image-center', 'image-left', 'image-bottom')),
		),
		array(
			'id' => 'ved_product_hover_bar_style',
			'type' => 'button_set',
			'title' => esc_html__('Bar Style', 'bigbo' ),
			'options' => array(
				'flat' => esc_html__('Flat', 'bigbo' ),
				'border' => esc_html__('Border', 'bigbo' ),
			),
			'default' => 'flat',
			'required' => array('ved_product_hover_style', '=', array('image-bottom-bar', 'info-bottom-bar')),
		),
		array(
			'id' => 'ved_product_hover_add_to_cart_position',
			'type' => 'button_set',
			'title' => esc_html__('"Add to Cart" Position', 'bigbo' ),
			'options' => array(
				'center' => esc_html__('Center', 'bigbo' ),
				'left' => esc_html__('Left', 'bigbo' ),
			),
			'default' => 'center',
			'required' => array('ved_product_hover_style', '=', array('image-bottom-bar', 'info-bottom', 'info-bottom-bar')),
		),
		array(
			'id' => 'ved_product_hover_default_button_style',
			'type' => 'button_set',
			'title' => esc_html__('Button Style', 'bigbo' ),
			'options' => array(
				'dark' => esc_html__('Dark', 'bigbo' ),
				'light' => esc_html__('Light', 'bigbo' ),
			),
			'default' => 'dark',
			'required' => array('ved_product_hover_style', '=', array('default', 'icon-top-left')),
		),
		array(
			'id' => 'ved_product_hover_icon_type',
			'type' => 'button_set',
			'title' => esc_html__('Product Icons Type', 'bigbo' ),
			'subtitle' => esc_html__('Overall Product Hover Icon Type.', 'bigbo' ),
			'options' => array(
				'fill-icon' => esc_html__('Flat Icons', 'bigbo' ),
				'line-icon' => esc_html__('Line Icons', 'bigbo' ),
			),
			'default' => 'fill-icon',
		),
		array(
			'id'         => 'ved_product_pagination',
			'type'       => 'button_set',
			'title'      => esc_html__('Product Pagination', 'bigbo' ),
			'options'    => array(
				'pagination'   		=> esc_html__('Pagination', 'bigbo' ),
				'load_more'			=> esc_html__('Load More', 'bigbo' ),
				'infinite_scroll'   => esc_html__('Infinite Scroll', 'bigbo' ),
			),
			'default' => 'pagination',
		),	
		array(
                'id' => 'ved_product_hover_icon_type',
                'type' => 'button_set',
                'title' => esc_html__('Product Icons Type', 'bigbo' ),
                'subtitle' => esc_html__('Overall Product Hover Icon Type.', 'bigbo' ),
                'options' => array(
                    'fill-icon' => esc_html__('Flat Icons', 'bigbo' ),
                    'line-icon' => esc_html__('Line Icons', 'bigbo' ),
                ),
                'default' => 'fill-icon',
            ),
		array(
                'id' => 'ved_product-out-of-stock-icon',
                'type' => 'switch',
                'title' => esc_html__('Display "Out of stock" Label', 'bigbo' ),
                'default' => true,
                'on' => esc_html__('Yes', 'bigbo' ),
                'off' => esc_html__('No', 'bigbo' ),
            ),
		array(
                'id' => 'ved_woocommerce_catalog_mode',
                'type' => 'switch',
                'title' => esc_html__('Just Catalog', 'bigbo' ),
                'subtitle' => esc_html__('Disable "Add To Cart" button and shopping cart', 'bigbo' ),
                'default' => false,
            ),
		array(
			'id' => 'ved_woocommerce_price_hide',
			'type' => 'switch',
			'title' => esc_html__('Hide Price', 'bigbo' ),
			'subtitle' => esc_html__('Hide product price on Product pages', 'bigbo' ),
			'default' => false,
			'required' => array('ved_woocommerce_catalog_mode', '=', true)
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-typography-main-tab',
	'title'	 => esc_html__( 'Typography', 'bigbo' ),
	'icon'	 => 'fa fa-font icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-custom',
	'title'		 => esc_html__( 'Custom Fonts', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'raw'	 => sprintf( '<h3 style=\'margin: 0;\'>%s</h3><p style="margin-bottom:0;">%s</h3>', esc_html__( 'Custom fonts for all elements.', 'bigbo' ), esc_html__( 'This will override the Google / standard font options. All 4 files are required.', 'bigbo' ) ),
			'id'	 => 'ved_custom_fonts',
			'type'	 => 'info',
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .woff font file.', 'bigbo' ),
			'id'		 => 'ved_custom_font_woff',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .woff', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .ttf font file.', 'bigbo' ),
			'id'		 => 'ved_custom_font_ttf',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .ttf', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .svg font file.', 'bigbo' ),
			'id'		 => 'ved_custom_font_svg',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .svg', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .eot font file.', 'bigbo' ),
			'id'		 => 'ved_custom_font_eot',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .eot', 'bigbo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-title-tagline-tab',
	'title'		 => esc_html__( 'Title & Tagline', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_title_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'Blog Title Font', 'bigbo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '20px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog tagline. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_tagline_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Blog Tagline Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-menu-tab',
	'title'		 => esc_html__( 'Menu', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your main menu. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Main Menu Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#999999',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '300',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your top menu. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_top_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Top Menu Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#777777',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '400',
			),
		),
	),
)
);


Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-post-tab',
	'title'		 => esc_html__( 'Post Title & Content', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your post titles. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_post_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Post Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Content Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'color'		 => '#777777',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-widget-tab',
	'title'		 => esc_html__( 'Widget', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Widget Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Widget Content Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_footer_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Footer Widget Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '18px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_footer_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Footer Widget Content Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#ffffff',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-headings-tab',
	'title'		 => esc_html__( 'Headings', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H1 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h1_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H1 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '32px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H2 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h2_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H2 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '26px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H3 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h3_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H3 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H4 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h4_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'H4 Font', 'bigbo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '16px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H5 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h5_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'H5 Font', 'bigbo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H6 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'ved_content_h6_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H6 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-styling-main-tab',
	'title'	 => esc_html__( 'Styling', 'bigbo' ),
	'icon'	 => 'fa fa-paint-brush icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-main-scheme-tab',
	'title'		 => esc_html__( 'Main Color Scheme', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Primary color of site', 'bigbo' ),
			'id'		 => 'ved_primary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Primary Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => esc_html__( 'Secondry color of site', 'bigbo' ),
			'id'		 => 'ved_secondry_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Secondry Color', 'bigbo' ),
			'default'	 => '#0c3e3e',
		),	
		array(
			'subtitle'	 => esc_html__( 'Tertiary color of site', 'bigbo' ),
			'id'		 => 'ved_tertiary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Tertiary Color', 'bigbo' ),
			'default'	 => '#969696',
		),	
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-menu-tab',
	'title'		 => esc_html__( 'Menu', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Set the font size for mega menu column titles. In pixels, ex: 15px', 'bigbo' ),
			'id'		 => 'ved_megamenu_title_size',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Mega Menu Column Title Size', 'bigbo' ),
			'default'	 => '15px',
		),
		array(
			'subtitle'	 => esc_html__( 'Main menu text transform', 'bigbo' ),
			'id'		 => 'ved_menu_text_transform',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'none'		 => esc_html__( 'none', 'bigbo' ),
				'lowercase'	 => esc_html__( 'lowercase', 'bigbo' ),
				'capitalize'	 => esc_html__( 'Capitalize', 'bigbo' ),
				'uppercase'	 => esc_html__( 'UPPERCASE', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Set the main menu text transform', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => esc_html__( 'Main menu hover font color', 'bigbo' ),
			'id'		 => 'ved_main_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Menu Hover Font Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Sub menu hover font color', 'bigbo' ),
			'id'		 => 'ved_sub_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Submenu Hover Font Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-element-colors',
	'title'		 => esc_html__( 'Element Colors', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Controls the background color of form fields.', 'bigbo' ),
			'id'		 => 'ved_form_bg_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Background Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the text color for forms.', 'bigbo' ),
			'id'		 => 'ved_form_text_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Text Color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the border color of form fields.', 'bigbo' ),
			'id'		 => 'ved_form_border_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Border Color', 'bigbo' ),
			'default'	 => '#e2e2e2',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-social-sharing-main-tab',
	'title'	 => esc_html__( 'Social Sharing Box', 'bigbo' ),
	'icon'	 => 'fa fa-group icon-large',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Select a custom social icon color.', 'bigbo' ),
			'id'		 => 'ved_sharing_box_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Sharing Box Custom Icons Color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Select a custom social icon box color.', 'bigbo' ),
			'id'		 => 'ved_sharing_box_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Sharing Box Icons Custom Box Color', 'bigbo' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => esc_html__( 'Box radius for the social icons. In pixels, ex: 4px.', 'bigbo' ),
			'id'		 => 'ved_sharing_box_radius',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Social Sharing Box Icons Boxed Radius', 'bigbo' ),
			'default'	 => '50%',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the tooltip position of the social icons in the sharing box.', 'bigbo' ),
			'id'		 => 'ved_sharing_box_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => esc_html__( 'Top', 'bigbo' ),
				'right'	 => esc_html__( 'Right', 'bigbo' ),
				'bottom' => esc_html__( 'Bottom', 'bigbo' ),
				'left'	 => esc_html__( 'Left', 'bigbo' ),
				'none'	 => esc_html__( 'None', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Social Sharing Box Icons Tooltip Position', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => esc_html__( 'Show the facebook sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_facebook',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Facebook', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the twitter sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_twitter',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Twitter', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the linkedin sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_linkedin',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'LinkedIn', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the g+ sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_google',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Google Plus', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the pinterest sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_pinterest',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Pinterest', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the email sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_email',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Email', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the more options button in blog posts.', 'bigbo' ),
			'id'		 => 'ved_sharing_more_options',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'More Options Button', 'bigbo' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-social-links-main-tab',
	'title'	 => esc_html__( 'Social Media Links', 'bigbo' ),
	'icon'	 => 'fa fa-share-square-o icon-larg',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose the color scheme of social icons', 'bigbo' ),
			'id'		 => 'ved_social_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icons Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose yes option if you want to display icon in boxed', 'bigbo' ),
			'id'		 => 'ved_social_boxed',
			'type'		 => 'select',
			'options'	 => array(
				'no'	 => esc_html__( 'No', 'bigbo' ),
				'yes'	 => esc_html__( 'Yes', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Social Icons Boxed', 'bigbo' ),
			'default'	 => 'no',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the color scheme of social icon boxed', 'bigbo' ),
			'id'		 => 'ved_social_boxed_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icon Boxed Background Color', 'bigbo' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => esc_html__( 'Box radius for the social icons. In pixels, ex: 4px.', 'bigbo' ),
			'id'		 => 'ved_social_boxed_radius',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Social Icon Boxed Radius', 'bigbo' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose _blank option if you want to open link in new window tab.', 'bigbo' ),
			'id'		 => 'ved_social_target',
			'type'		 => 'select',
			'options'	 => array(
				'_blank' => esc_html__( '_blank', 'bigbo' ),
				'_self'	 => esc_html__( '_self', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Social Icons Boxed', 'bigbo' ),
			'default'	 => '_blank',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the tooltip position of the social icons', 'bigbo' ),
			'id'		 => 'ved_social_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => esc_html__( 'Top', 'bigbo' ),
				'right'	 => esc_html__( 'Right', 'bigbo' ),
				'bottom' => esc_html__( 'Bottom', 'bigbo' ),
				'left'	 => esc_html__( 'Left', 'bigbo' ),
				'none'	 => esc_html__( 'None', 'bigbo' ),
			),
			'title'		 => esc_html__( 'Social Box Icons Tooltip Position', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'id'		 => 'ved_social_link_facebook',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Facebook', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your Facebook URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_twitter',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Twitter', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your Twitter URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_google-plus',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Google Plus', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your google-plus URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_dribbble',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Dribbble', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your dribbble URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_linkedin',
			'type'		 => 'text',
			'title'		 => esc_html__( 'LinkedIn', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your linkedin URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_tumblr',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Tumblr', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your tumblr URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_reddit',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Reddit', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your reddit URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_yahoo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Yahoo', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your yahoo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_deviantart',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Deviantart', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your deviantart URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_vimeo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Vimeo', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your vimeo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_youtube',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Youtube', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your youtube URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_pinterest',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Pinterest', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your pinterest URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_digg',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Digg', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your digg URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_flickr',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Flickr', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your flickr URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_skype',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Skype', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your skype URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_instagram',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Instagram', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your instagram URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_vk',
			'type'		 => 'text',
			'title'		 => esc_html__( 'VK', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your vk URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_paypal',
			'type'		 => 'text',
			'title'		 => esc_html__( 'PayPal', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your paypal URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_dropbox',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Dropbox', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your dropbox URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_soundcloud',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Soundcloud', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your soundcloud URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Foursquare', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your foursquare URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Vine', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your vine URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_wordpress',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Wordpress', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your wordpress URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_behance',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Behance', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your behance URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_stumbleupo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Stumbleupo', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your stumbleupo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_github',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Github', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your github URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_lastfm',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Lastfm', 'bigbo' ),
			'subtitle'	 => esc_html__( 'Insert your lastfm URL', 'bigbo' ),
		),
		array(
			'id'		 => 'ved_social_link_rss',
			'type'		 => 'text',
			'title'		 => esc_html__( 'RSS Feed', 'bigbo' ),
			'default'	 => $bigbo_rss_url,
			'subtitle'	 => esc_html__( 'Insert custom RSS Feed URL, e.g. http://feeds.feedburner.com/Example', 'bigbo' ),
		),
	)
) );

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-extra-main-tab',
	'title'	 => esc_html__( 'Extra', 'bigbo' ),
	'icon'	 => 'fa  fa-gears icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'              => 'ved-miscellaneous-sub-tab',
	'title'           => esc_html__('Miscellaneous', 'bigbo' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display Back to Top button.', 'bigbo' ),
			'id'		 => 'ved_back_to_top',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'bigbo' ),
			'off'		 => esc_html__( 'Disabled', 'bigbo' ),
			'title'		 => esc_html__( 'Back to Top button', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to add rel="nofollow" attribute to social sharing box and social links.', 'bigbo' ),
			'id'		 => 'ved_nofollow_social_links',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Yes', 'bigbo' ),
			'off'		 => esc_html__( 'No', 'bigbo' ),
			'title'		 => esc_html__( 'Add rel="nofollow" to social links', 'bigbo' ),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'              => 'ved-maintenance-sub-tab',
	'title'           => esc_html__('Maintenance', 'bigbo' ),
	'subsection'	 => true,
	'fields'          => array(
		array(
			'id'         => 'ved_enable_maintenance',
			'type'       => 'switch',
			'title'      => esc_html__('Enable Maintenance?', 'bigbo' ),
			'on'         => esc_html__('Yes', 'bigbo' ),
			'off'        => esc_html__('No', 'bigbo' ),
			'default'    => '0',
		),
		array(
			'id'       => 'ved_maintenance_mode',
			'type'     => 'button_set',
			'title'    => esc_html__('Maintenance Mode', 'bigbo' ),
			'options'  => array(
				'maintenance' => esc_html__('Maintenance', 'bigbo' ),
				'comingsoon'  => esc_html__('Coming Soon', 'bigbo' ),
			),
			'default'      => 'maintenance',
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'           => 'ved_maintenance_title',
			'type'         => 'text',
			'title'        => esc_html__('Maintenance Title', 'bigbo' ),
			'default'      => esc_html__('Site is Under Maintenance', 'bigbo' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'maintenance' ),
		),
		array(
			'id'           => 'ved_maintenance_subtitle',
			'type'         => 'text',
			'title'        => esc_html__('Maintenance Subtitle', 'bigbo' ),
			'default'      => esc_html__('This Site is Currently Under Maintenance. We will back shortly', 'bigbo' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'maintenance' ),
		),
		array(
			'subtitle'	 => esc_html__( 'Upload background image will display in the Comingsoon Background.', 'bigbo' ),
			'id'		 => 'ved_comingsoon_bg',
			'type'		 => 'media',
			'title'        => esc_html__('Coming Soon BG Image', 'bigbo' ),
			'url'		 => true,
			'default'	 => array(
				'url' => BIGBO_DEFAULT . 'comingsoon-bg.jpg'
			),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
		),
		array(
			'id'           => 'ved_comingsoon_title',
			'type'         => 'text',
			'title'        => esc_html__('Coming Soon Title', 'bigbo' ),
			'default'      => esc_html__('Coming soon', 'bigbo' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
		),
		array(
			'id'           => 'ved_comingsoon_subtitle',
			'type'         => 'text',
			'title'        => esc_html__('Coming Soon Subtitle', 'bigbo' ),
			'default'      => esc_html__('We are currently working on a website and won\'t take long. Don\'t forget to check out our Social updates.', 'bigbo' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
		),
		array(
			'id'           => 'ved_comingsoon_date',
			'type'         => 'date',
			'title'        => esc_html__('Coming Soon Date', 'bigbo' ),
			'subtitle'     => esc_html__('Select coming soon date.', 'bigbo' ),
			'placeholder'  => esc_html__('Click to enter a date', 'bigbo' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
			'default'      => date( 'm/d/Y', strtotime('+1 months') ),
		),
		array(
			'id'           => 'ved_comming_soon_social_icons',
			'type'         => 'switch',
			'title'        => esc_html__('Social Icons', 'bigbo' ),
			'subtitle'     => esc_html__('Show/hide social icons.', 'bigbo' ),
			'default'      => true,
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'           => 'ved_comming_soon_newsletter',
			'type'         => 'switch',
			'title'        => esc_html__('Display Newsletter', 'bigbo' ),
			'subtitle'     => esc_html__('Show/hide newsletter.', 'bigbo' ),
			'default'      => false,
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'           => 'ved_comming_page_newsletter_shortcode',
			'type'         => 'select',
			'title'        => esc_html__('Newsletter Form', 'bigbo' ),    
			'subtitle'     => esc_html__('Select newsletter form for display newsletter box on Comming Soon/Maintenance Page.', 'bigbo' ),   
			'data'         => 'posts',
			'args'         => array(
				'post_type'=> 'mc4wp-form',
			),
			'required'     => array(
				array( 'ved_enable_maintenance', '=', '1' ),
				array( 'ved_comming_soon_newsletter', '=', '1' ),
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-import-export-main-tab',
	'title'	 => esc_html__( 'Import / Export', 'bigbo' ),
	'icon'	 => 'fa fa-exchange icon-large',
	'fields' => array(
		array(
			'id'		 => 'redux_import_export',
			'type'		 => 'import_export',
			'full_width'	 => true,
		)
	),
)
);
// -> END Basic Fields

/*
 * Override Redux Content with Bigbo Content
 * 
 * 
 */
function bigbo_override_content() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_dequeue_style( 'select2-css' );
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}
add_action( 'redux-enqueue-ved_options', 'bigbo_override_content' );

/*
 * Hide Demo Mode Link
 * 
 * 
 */
function bigbo_remove_demo() {

	// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
	}
}
add_action( 'redux/loaded', 'bigbo_remove_demo' );

/*
 * Hide Demo Mode Link
 * 
 * 
 */
function bigbo_headerdefault() {
    wp_enqueue_script('bigbo-headerdefault', get_template_directory_uri() . '/themeoptions/options/js/headerdefault.js', array(), '', true);
}
add_action("redux/page/{$ved_options}/enqueue", "bigbo_headerdefault");