<?php
// Define global options.
define( 'DAYNEO_IMAGEFOLDER', get_template_directory_uri() . '/themeoptions/options/images/' );
define( 'DAYNEO_IMAGEPATH', get_template_directory_uri() . '/themeoptions/options/images/functions/' );
define( 'DAYNEO_DEFAULT', get_template_directory_uri() . '/assets/images/default/' );

// -> BEGIN Themeoption Setup

if ( ! class_exists( 'Redux' ) ) {
	return;
}

global $dd_options;

$dd_options		 = "dd_options"; // This is your option name where all the Redux data is stored.
$dayneo_theme		 = wp_get_theme(); // For use with some settings. Not necessary.
$dayneo_rss_url	 = get_bloginfo( 'rss_url' );
$dayneo_site_url	 = esc_url( "http://themevedanta.com/" );
$dayneo_fb_url	 = '#';

$args = array(
	'opt_name'		 => $dd_options,
	'display_name'		 => $dayneo_theme->get( 'Name' ),
	'display_name'		 => '<img width="128" height="34" src="' . esc_url(get_template_directory_uri() . '/admin/assets/images/light-logo.png').'" alt="'. esc_attr(get_bloginfo( 'name' )) .'">',
	'page_type'		 => 'submenu',
	'allow_sub_menu'	 => false,
	'menu_title'		 => __( 'Theme Options', 'dayneo' ),
	'page_title'		 => __( 'Theme Options', 'dayneo' ),
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
	'page_slug'		 => 'dayneo_options',
	'ajax_save'		 => true,
	'default_show'		 => false,
	'default_mark'		 => '',
	'disable_tracking'	 => true,
	'customizer_only'	 => false,
	'save_defaults'		 => true,
	'footer_credit'		 => __( 'Thank you for using the Dayneo Theme', 'dayneo' ),
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
	'intro_text'		 => '<a href="http://dayneo.themevedanta.com/" title="Theme Homepage" target="_blank"><i class="fa fa-home"></i> Theme Homepage</a><a href="' . esc_url($dayneo_site_url . 'docs/').'" title="Documentation" target="_blank"><i class="fa fa-book"></i> Documentation</a><a href="' . esc_url($dayneo_site_url . 'support-forums/').'" title="Support" target="_blank"><i class="fa fa-life-bouy"></i> Support</a><a href="' . esc_url($dayneo_fb_url) . '" title="Facebook" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>',
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Dayneo Themes on Facebook',
	'icon'	 => 'fa fa-facebook',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Dayneo Themes on Twitter',
	'icon'	 => 'fa fa-twitter',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Dayneo Themes on Instagram',
	'icon'	 => 'fa fa-instagram',
);

Redux::setArgs( $dd_options, $args );

// -> END Themeoption Setup
// -> START Basic Configuration


global $wp_registered_sidebars;
$sidebar_options[] = 'None';
// GET All Register Sidebars
for ( $i = 0; $i < 1; $i ++ ) {
	$sidebars = $wp_registered_sidebars;
	if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
		foreach ( $sidebars as $key => $sidebar ) {
			$sidebar_options[ $key ] = $sidebar[ 'name' ];
		}
	}
}

// GET Custom Sidebars
if ( class_exists( 'sidebar_generator' ) ) {
	$sidebars2 = sidebar_generator::get_sidebars();
	if ( is_array( $sidebars2 ) && ! empty( $sidebars2 ) ) {
		foreach ( $sidebars2 as $key ) {
			$sidebar_options[ $key ] = $key; //$key
		}
	}
}


// -> END Basic Configuration
// -> START Basic Fields

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-general-main-tab',
	'title'	 => __( 'General', 'dayneo' ),
	'icon'	 => 'fa fa-dashboard',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-fav-tab',
	'title'		 => __( 'Favicon', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload custom favicon.', 'dayneo' ),
			'id'		 => 'dd_favicon',
			'type'		 => 'media',
			'title'		 => __( 'Custom Favicon', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone (57px x 57px).', 'dayneo' ),
			'id'		 => 'dd_iphone_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Icon Upload', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone Retina Version (114px x 114px).', 'dayneo' ),
			'id'		 => 'dd_iphone_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Retina Icon Upload', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad (72px x 72px).', 'dayneo' ),
			'id'		 => 'dd_ipad_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Icon Upload', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad Retina Version (144px x 144px).', 'dayneo' ),
			'id'		 => 'dd_ipad_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Retina Icon Upload', 'dayneo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-loader-tab',
	'title'		 => __( 'Site Loader', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display loader in site', 'dayneo' ),
			'id'		 => 'dd_siteloader',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Site Loader', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Upload custom loader.', 'dayneo' ),
			'id'		 => 'dd_loaderfile',
			'type'		 => 'media',
			'title'		 => __( 'Custom Loader', 'dayneo' ),
			'url'		 => true,
			'required'	 => array( array( "dd_siteloader", '=', 1 ) ),
			'default'	 => array(
				'url' => DAYNEO_DEFAULT . 'loader.gif'
			),
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-lay-tab',
	'title'		 => __( 'Layout', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select main content and sidebar alignment.', 'dayneo' ),
			'id'		 => 'dd_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1c'	 => DAYNEO_IMAGEPATH . '1c.png',
				'2cl'	 => DAYNEO_IMAGEPATH . '2cl.png',
				'2cr'	 => DAYNEO_IMAGEPATH . '2cr.png',
				'3cm'	 => DAYNEO_IMAGEPATH . '3cm.png',
				'3cr'	 => DAYNEO_IMAGEPATH . '3cr.png',
				'3cl'	 => DAYNEO_IMAGEPATH . '3cl.png',
			),
			'title'		 => __( 'Select layout', 'dayneo' ),
			'default'	 => '2cl',
		),
		array(
			'subtitle'	 => __( '<strong>Boxed version</strong> automatically enables custom background', 'dayneo' ),
			'id'		 => 'dd_width_layout',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'fixed'	 => __( 'Boxed', 'dayneo' ),
				'fluid'	 => __( 'Wide', 'dayneo' ),
			),
			'title'		 => __( 'Layout Style', 'dayneo' ),
			'default'	 => 'fluid',
		),
		array(
			'subtitle'	 => __( 'Select the width for your website', 'dayneo' ),
			'id'		 => 'dd_width_px',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				800	 => '800px',
				985	 => '985px',
				1200	 => '1200px',
				1600	 => '1600px',
				'custom' => __( 'Custom', 'dayneo' ),
			),
			'title'		 => __( 'Layout Width', 'dayneo' ),
			'default'	 => '1200',
		),
		array(
			'title'		 => __( 'Custom Layout Width', 'dayneo' ),
			'subtitle'	 => __( 'Add the custom width in px (ex: 1024)', 'dayneo' ),
			'id'		 => "dd_custom_width_px",
			'type'		 => "text",
			'required'	 => array( array( "dd_width_px", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => __( 'Select the left and right padding for the Fullwidth-Fluid main content area. Enter value in px. ex: 20px', 'dayneo' ),
			'id'		 => 'dd_hundredp_padding',
			'type'		 => 'text',
			'title'		 => __( 'Fullwidth - Fluid Template Left/Right Padding', 'dayneo' ),
			'default'	 => '40px',
		),
		array(
			'subtitle'	 => __( 'Enter the page content top & bottom padding.', 'dayneo' ),
			'id'		 => 'dd_content_top_bottom_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Content Top & Bottom Padding', 'dayneo' ),
			'left'		 => false,
			'right'		 => false,
			'default'	 => array(
				'padding-top'	 => '140',
				'padding-bottom' => '140',
				'units'		 => 'px',
			),
		),
		array(
			'id'		 => 'dd_info_consid1',
			'type'		 => 'info',
			'subtitle'	 => __( '<h3>Content and One Sidebar Width</h3>', 'dayneo' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s2cl.png" /> <img style="float:left, display:inline" src="%2$s2cr.png" />', 'dayneo' ), esc_url(DAYNEO_IMAGEPATH), esc_url(DAYNEO_IMAGEPATH) ),
			'id'		 => 'dd_info_consid1_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'dayneo' ),
			'id'		 => 'dd_opt1_width_content',
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
			'title'		 => __( 'Content Width', 'dayneo' ),
			'default'	 => '9',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'dayneo' ),
			'id'		 => 'dd_opt1_width_sidebar1',
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
			'title'		 => __( 'Sidebar 1 Width', 'dayneo' ),
			'default'	 => '3',
		),
		array(
			'id'		 => 'dd_info_consid2',
			'type'		 => 'info',
			'subtitle'	 => __( '<h3>Content and Two Sidebars Width</h3>', 'dayneo' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s3cm.png" /> <img style="float:left, display:inline" src="%2$s3cr.png" /> <img style="float:left, display:inline" src="%3$s3cl.png" />', 'dayneo' ), esc_url(DAYNEO_IMAGEPATH), esc_url(DAYNEO_IMAGEPATH), esc_url(DAYNEO_IMAGEPATH) ),
			'id'		 => 'dd_info_consid2_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'dayneo' ),
			'id'		 => 'dd_opt2_width_content',
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
			'title'		 => __( 'Content Width', 'dayneo' ),
			'default'	 => '6',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'dayneo' ),
			'id'		 => 'dd_opt2_width_sidebar1',
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
			'title'		 => __( 'Sidebar 1 Width', 'dayneo' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 2', 'dayneo' ),
			'id'		 => 'dd_opt2_width_sidebar2',
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
			'title'		 => __( 'Sidebar 2 Width', 'dayneo' ),
			'default'	 => '3',
		),
	),
)
);

// Header Main Sections
Redux::setSection( $dd_options, array(
	'id'	 => 'dd-header-main-tab',
	'title'	 => __( 'Header', 'dayneo' ),
	'icon'	 => 'fa fa-window-maximize icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-header-tab',
	'title'		 => __( 'Header', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display searchbox in Header', 'dayneo' ),
			'id'		 => 'dd_searchbox',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Searchbox', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display cart in Header', 'dayneo' ),
			'id'		 => 'dd_woo_cart',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Cart', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display menu in Header', 'dayneo' ),
			'id'		 => 'dd_primary_menu',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Menu', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display mobile menu', 'dayneo' ),
			'id'		 => 'dd_mobile_menu',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Mobile Menu', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display Sticky Header', 'dayneo' ),
			'id'		 => 'dd_sticky_header',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Sticky Header', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose your Header Type', 'dayneo' ),
			'id'		 => 'dd_header_type',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'h1'	 => DAYNEO_IMAGEFOLDER . '/header/header-1.png',
				'h2'	 => DAYNEO_IMAGEFOLDER . '/header/header-2.png',
				'h3'	 => DAYNEO_IMAGEFOLDER . '/header/header-3.png',
				'h4'	 => DAYNEO_IMAGEFOLDER . '/header/header-4.png',
				'h5'	 => DAYNEO_IMAGEFOLDER . '/header/header-5.png',
				'h6'	 => DAYNEO_IMAGEFOLDER . '/header/header-5.png',
			),
			'title'		 => __( 'Choose Header Type', 'dayneo' ),
			'default'	 => 'h1',
		),
		array(
			'subtitle'	 => __( 'Control the background color of topbar header.', 'dayneo' ),
			'id'		 => 'dd_topbar_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => __( 'Top Bar Color', 'dayneo' ),
			'default'	 => '#000000',
			'required'	 => array( array( "dd_header_type", '=', 'h5' ) ),
		),
        array(
            'id'       => 'menu_extras',
            'type'     => 'checkbox',
            'title'    => __('Menu Extras', 'dayneo'), 
            'options'  => array(
                'search' => 'Search',
                'compare' => 'Compare',
                'wishlist' => 'WishList',
                'cart' => 'Cart',
                'account' => 'Account',
                'department' => 'Department Menu',
                'headerbar' => 'Header Bar',
            ),
            'default' => array(
                'search' => '1',
                'compare' => '0',
                'wishlist' => '1',
                'cart' => '1',
                'account' => '1',
                'department' => '0',
                'headerbar' => '0',
            ),
        ),
        array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'dd_vmenu_title',
			'type'		 => 'text',
			'title'		 => __( 'Vertical Menu Title', 'dayneo' ),
			'default'	 => 'Shop By Category',
		),
		),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-topbar-tab',
	'title'		 => __( 'Top Bar', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select which content displays in the top left area of the header.', 'dayneo' ),
			'id'		 => 'dd_header_left_content',
			'type'		 => 'select',
			'options'	 => array(
				'contact_info'	 => __( 'Contact Info', 'dayneo' ),
				'social_links'	 => __( 'Social Links', 'dayneo' ),
				'navigation'	 => __( 'Navigation', 'dayneo' ),
				'content_text'	 => __( 'Content Text', 'dayneo' ),
				'empty'		 => __( 'Leave Empty', 'dayneo' ),
			),
			'title'		 => __( 'Header Top Left Content', 'dayneo' ),
			'default'	 => 'contact_info',
		),
//		array(
//			'subtitle'	 => __( 'Select which content displays in the top right area of the header.', 'dayneo' ),
//			'id'		 => 'dd_header_right_content',
//			'type'		 => 'select',
//			'options'	 => array(
//				'contact_info'	 => __( 'Contact Info', 'dayneo' ),
//				'social_links'	 => __( 'Social Links', 'dayneo' ),
//				'navigation'	 => __( 'Navigation', 'dayneo' ),
//				'empty'		 => __( 'Leave Empty', 'dayneo' ),
//			),
//			'title'		 => __( 'Header Top Right Content', 'dayneo' ),
//			'default'	 => 'navigation',
//		),
		array(
			'subtitle'	 => __( 'Phone number will display in the Contact Info section of your top header.', 'dayneo' ),
			'id'		 => 'dd_header_number',
			'type'		 => 'text',
			'title'		 => __( 'Header Phone Number', 'dayneo' ),
			'default'	 => '+49 7890 123 456',
		),
		array(
			'subtitle'	 => __( 'Email address will display in the Contact Info section of your top header.', 'dayneo' ),
			'id'		 => 'dd_header_email',
			'type'		 => 'text',
			'title'		 => __( 'Header Email Address', 'dayneo' ),
			'default'	 => 'contact@example.com',
		),
                array(
			'subtitle'	 => __( 'Text will display in the Content Text section of your top header.', 'dayneo' ),
			'id'		 => 'dd_content_text',
			'type'		 => 'text',
			'title'		 => __( 'Content Text', 'dayneo' ),
			'default'	 => 'Welcome to website',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-logo-tab',
	'title'		 => __( 'Logo', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload a logo for your theme, or specify an image URL directly.', 'dayneo' ),
			'id'		 => 'dd_header_logo',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo', 'dayneo' ),
			'url'		 => true,
		),
                array(
                    'subtitle' => __( 'Upload a logo for your transparent header, Apply only header-2', 'dayneo' ),
                    'id'       => 'dd_header2_logo',
                    'type'     => 'media',
                    'title'    => __( 'Custom Logo(For Header-2)', 'dayneo' ),
                    'url'      => true,
                ),
		array(
			'subtitle'	 => __( 'Select an image file for the retina version of the custom logo. It should be exactly 2x the size of main logo.', 'dayneo' ),
			'id'		 => 'dd_header_logo_retina',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo (Retina Version @2x)', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. In px.', 'dayneo' ),
			'id'		 => 'dd_header_logo_retina_width',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Width for Retina Logo', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. In px.', 'dayneo' ),
			'id'		 => 'dd_header_logo_retina_height',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Height for Retina Logo', 'dayneo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-search-content-tab',
	'title'		 => __( 'Header Search Content', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'search_content_type',
			'type'		 => 'select',
			'options'	 => array(
				'all'	 => __( 'Search for everything', 'dayneo' ),
				'product'	 => __( 'Search for products', 'dayneo' ),
			),
			'title'		 => __( 'Search Content Type', 'dayneo' ),
			'default'	 => 'product',
		),
            array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'custom_categories_text',
			'type'		 => 'text',
			'title'		 => __( 'Categories Text', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'custom_categories_depth',
			'type'		 => 'text',
			'title'		 => __( 'Categories Depth', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( 'Enter Category IDs to include. Divide every category by comma(,)', 'dayneo' ),
			'id'		 => 'custom_categories_include',
			'type'		 => 'text',
			'title'		 => __( 'Categories Include', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( 'Enter Category IDs to exclude. Divide every category by comma(,)', 'dayneo' ),
			'id'		 => 'custom_categories_exclude',
			'type'		 => 'text',
			'title'		 => __( 'Categories Exclude', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'custom_search_text',
			'type'		 => 'text',
			'title'		 => __( 'Search Text', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'custom_search_button',
			'type'		 => 'text',
			'title'		 => __( 'Button Text', 'dayneo' ),
		),
            array(
			'subtitle'	 => __( '', 'dayneo' ),
			'id'		 => 'header_ajax_search',
			'type'		 => 'switch',
			'title'		 => __( 'AJAX Search', 'dayneo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display title of your blog', 'dayneo' ),
			'id'		 => 'dd_blog_title',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Title', 'dayneo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display tagline of your blog', 'dayneo' ),
			'id'		 => 'dd_blog_tagline',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Tagline', 'dayneo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-footer-main-tab',
	'title'	 => __( 'Footer', 'dayneo' ),
	'icon'	 => 'fa fa-columns icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-footer-widgets-tab',
	'title'		 => __( 'Footer Widgets', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select how many footer widget areas you want to display.', 'dayneo' ),
			'id'		 => 'dd_footer_widget_col',
			'type'		 => 'image_select',
			'options'	 => array(
				'disable'	 => DAYNEO_IMAGEPATH . '1c.png',
				'one'		 => DAYNEO_IMAGEPATH . 'footer-widgets-1.png',
				'two'		 => DAYNEO_IMAGEPATH . 'footer-widgets-2.png',
				'three'		 => DAYNEO_IMAGEPATH . 'footer-widgets-3.png',
				'four'		 => DAYNEO_IMAGEPATH . 'footer-widgets-4.png',
			),
			'title'		 => __( 'Number of Widget Cols in Footer', 'dayneo' ),
			'default'	 => 'disable',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-custom-footer-tab',
	'title'		 => __( 'Custom Footer', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Available <strong>HTML</strong> tags and attributes:<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code>', 'dayneo' ),
			'id'		 => 'dd_footer_content',
			'type'		 => 'textarea',
			'title'		 => __( 'Custom Footer', 'dayneo' ),
			'default'	 => '<p id="copyright"><span class="credits"><a href="' . esc_url($dayneo_site_url . 'dayneo-multipurpose-wordpress-theme/').'">Dayneo</a> theme by ThemeVedanta</span></p>',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-header-footer-tab',
	'title'		 => __( 'Footer Styles', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Custom background color of footer', 'dayneo' ),
			'id'		 => 'dd_footer_bg_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Footer Background color', 'dayneo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Upload a footer background image for your theme, or specify an image URL directly.', 'dayneo' ),
			'id'		 => 'dd_footer_background_image',
			'type'		 => 'media',
			'title'		 => __( 'Footer Background Image', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Select if the footer background image should be displayed in cover or contain size.', 'dayneo' ),
			'id'		 => 'dd_footer_image',
			'type'		 => 'select',
			'options'	 => array(
				'cover'		 => __( 'Cover', 'dayneo' ),
				'contain'	 => __( 'Contain', 'dayneo' ),
				'none'		 => __( 'None', 'dayneo' ),
			),
			'title'		 => __( 'Background Responsiveness Style', 'dayneo' ),
			'default'	 => 'cover',
		),
		array(
			'id'		 => 'dd_footer_image_background_repeat',
			'type'		 => 'select',
			'options'	 => array(
				'no-repeat'	 => __( 'no-repeat', 'dayneo' ),
				'repeat'	 => __( 'repeat', 'dayneo' ),
				'repeat-x'	 => __( 'repeat-x', 'dayneo' ),
				'repeat-y'	 => __( 'repeat-y', 'dayneo' ),
			),
			'title'		 => __( 'Background Repeat', 'dayneo' ),
			'default'	 => 'no-repeat',
		),
		array(
			'id'		 => 'dd_footer_image_background_position',
			'type'		 => 'select',
			'options'	 => array(
				'center top'	 => __( 'center top', 'dayneo' ),
				'center center'	 => __( 'center center', 'dayneo' ),
				'center bottom'	 => __( 'center bottom', 'dayneo' ),
				'left top'	 => __( 'left top', 'dayneo' ),
				'left center'	 => __( 'left center', 'dayneo' ),
				'left bottom'	 => __( 'left bottom', 'dayneo' ),
				'right top'	 => __( 'right top', 'dayneo' ),
				'right center'	 => __( 'right center', 'dayneo' ),
				'right bottom'	 => __( 'right bottom', 'dayneo' ),
			),
			'title'		 => __( 'Background Position', 'dayneo' ),
			'default'	 => 'center top',
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'dayneo' ),
			'id'		 => 'dd_footer_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'dayneo' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( '<h3 style=\'margin: 0;\'>Footer Default Pattern</h3>', 'dayneo' ),
			'id'		 => 'dd_header_footer',
			'type'		 => 'info',
		),
		array(
			'subtitle'	 => __( 'Choose the pattern for footer background', 'dayneo' ),
			'id'		 => 'dd_pattern',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'none'			 => DAYNEO_IMAGEPATH . 'none.jpg',
				'pattern_1_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_1_thumb.png',
				'pattern_2_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_2_thumb.png',
				'pattern_3_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_3_thumb.png',
				'pattern_4_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_4_thumb.png',
				'pattern_5_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_5_thumb.png',
				'pattern_6_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_6_thumb.png',
				'pattern_7_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_7_thumb.png',
				'pattern_8_thumb.png'	 => DAYNEO_IMAGEFOLDER . '/pattern/pattern_8_thumb.png',
			),
			'title'		 => __( 'Footer pattern', 'dayneo' ),
			'default'	 => 'none',
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'	 => 'dd-pagetitlebar-tab',
	'title'	 => __( 'Page Title Bar', 'dayneo' ),
	'icon'	 => 'fa fa-pencil-square-o icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display page titlebar above the content and sidebar area', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_layout',
			'compiler'	 => true,
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Page Title Bar', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose the display option to show the page title', 'dayneo' ),
			'id'		 => 'dd_display_pagetitlebar',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'dayneo' ),
				'titlebar'		 => __( 'Only Title', 'dayneo' ),
				'breadcrumb'		 => __( 'Only Breadcrumb', 'dayneo' ),
			),
			'title'		 => __( 'Page Title & Breadcrumbs', 'dayneo' ),
			'default'	 => 'titlebar_breadcrumb',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => __( 'Choose your page titlebar layout', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_layout_opt',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'title'		 => __( 'Page Title Bar Layout Type', 'dayneo' ),
			'options'	 => array(
				'titlebar_left'		 => DAYNEO_IMAGEFOLDER . '/titlebarlayout/titlebar_left.png',
				'titlebar_center'	 => DAYNEO_IMAGEFOLDER . '/titlebarlayout/titlebar_center.png',
				'titlebar_right'	 => DAYNEO_IMAGEFOLDER . '/titlebarlayout/titlebar_right.png',
			),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => 'titlebar_center',
		),
		array(
			'subtitle'	 => __( 'Select the height for your pagetitle bar', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_height',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'small'	 => 'Small',
				'medium' => 'Medium',
				'large'	 => 'Large',
				'custom' => __( 'Custom', 'dayneo' ),
			),
			'title'		 => __( 'Page Title Bar Height', 'dayneo' ),
			'default'	 => 'medium',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'title'		 => __( 'Custom Page Title Bar Height', 'dayneo' ),
			'subtitle'	 => __( 'Add the custom height for page title bar. All height in px. Ex: 70', 'dayneo' ),
			'id'		 => "dd_pagetitlebar_custom",
			'type'		 => "text",
			'required'	 => array( array( "dd_pagetitlebar_height", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => __( 'Custom background color of page title bar', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_background_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Page Title Bar Background Color', 'dayneo' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => __( 'Select an image or insert an image url to use for the page title bar background.', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_background',
			'type'		 => 'media',
			'title'		 => __( 'Page Title Bar Background', 'dayneo' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'dayneo' ),
			'id'		 => 'dd_pagetitlebar_background_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'dayneo' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-blog-main-tab',
	'title'	 => __( 'Blog', 'dayneo' ),
	'icon'	 => 'fa fa-newspaper-o icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-general-tab',
	'title'		 => __( 'General', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the blog style that will display on the blog pages.', 'dayneo' ),
			'id'		 => 'dd_blog_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'classic'		 => __( 'Classic', 'dayneo' ),
				'thumbnail_on_side'	 => __( 'Thumbnail On Side', 'dayneo' ),
				'grid'			 => __( 'Grid', 'dayneo' ),
			),
			'title'		 => __( 'Blog Style', 'dayneo' ),
			'default'	 => 'classic',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> posts per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'dayneo' ),
			'id'		 => 'dd_post_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1'	 => DAYNEO_IMAGEPATH . 'one-post.png',
				'2'	 => DAYNEO_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYNEO_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYNEO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Blog Grid layout', 'dayneo' ),
			'default'	 => '2',
			'required'	 => array(
				array( 'dd_blog_style', '=', 'grid' )
			),
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will display on the archive/category pages.', 'dayneo' ),
			'id'		 => 'dd_blog_archive_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Blog Archive/Category Sidebar', 'dayneo' ),
			'default'	 => 'None',
		),
		array(
			'subtitle'	 => __( 'Choose placement of the \'Share This\' buttons', 'dayneo' ),
			'id'		 => 'dd_share_this',
			'type'		 => 'select',
			'options'	 => array(
				'single'	 => __( 'Single Posts', 'dayneo' ),
				'page'		 => __( 'Single Pages', 'dayneo' ),
				'all'		 => __( 'All', 'dayneo' ),
				'disable'	 => __( 'Disable', 'dayneo' ),
			),
			'title'		 => __( '\'Share This\' buttons placement', 'dayneo' ),
			'default'	 => 'single',
		),
		array(
			'subtitle'	 => __( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'dayneo' ),
			'id'		 => 'dd_pagination_type',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'pagination'		 => __( 'Default Pagination', 'dayneo' ),
				'number_pagination'	 => __( 'Number Pagination', 'dayneo' ),
			),
			'title'		 => __( 'Pagination Type', 'dayneo' ),
			'default'	 => 'pagination',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display edit post link', 'dayneo' ),
			'id'		 => 'dd_edit_post',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Edit Post Link', 'dayneo' ),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-post-tab',
	'title'		 => __( 'Posts', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta header', 'dayneo' ),
			'id'		 => 'dd_header_meta',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Header', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta date', 'dayneo' ),
			'id'		 => 'dd_meta_date',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Date', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta author', 'dayneo' ),
			'id'		 => 'dd_meta_author',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Author', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display post author avatar', 'dayneo' ),
			'id'		 => 'dd_author_avatar',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Enable Post Author Avatar', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta tags', 'dayneo' ),
			'id'		 => 'dd_meta_tags',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Tags', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta comments', 'dayneo' ),
			'id'		 => 'dd_meta_comments',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Comments', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose the position of the <strong>Previous/Next Post</strong> links', 'dayneo' ),
			'id'		 => 'dd_post_links',
			'type'		 => 'select',
			'options'	 => array(
				'after'	 => __( 'After posts', 'dayneo' ),
				'before' => __( 'Before posts', 'dayneo' ),
				'both'	 => __( 'Both', 'dayneo' ),
			),
			'title'		 => __( 'Position of Previous/Next Posts Links', 'dayneo' ),
			'default'	 => 'after',
		),
		array(
			'subtitle'	 => __( 'Choose if you want to display <strong>Similar posts</strong> in articles', 'dayneo' ),
			'id'		 => 'dd_similar_posts',
			'type'		 => 'select',
			'options'	 => array(
				'disable'	 => __( 'Disable', 'dayneo' ),
				'category'	 => __( 'Match by categories', 'dayneo' ),
				'tag'		 => __( 'Match by tags', 'dayneo' ),
			),
			'title'		 => __( 'Display Similar Posts', 'dayneo' ),
			'default'	 => 'disable',
		),
	),
)
);
Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-featured-tab',
	'title'		 => __( 'Featured Image', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on blog page', 'dayneo' ),
			'id'		 => 'dd_featured_images',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Featured Images', 'dayneo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured image on Single Blog Posts', 'dayneo' ),
			'id'		 => 'dd_blog_featured_image',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Featured Image on Single Blog Posts', 'dayneo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-portfolio-main-tab',
	'title'	 => __( 'Portfolio', 'dayneo' ),
	'icon'	 => 'fa fa-th icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-general-tab',
	'title'		 => __( 'General', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Insert the number of posts to display per page.', 'dayneo' ),
			'id'		 => 'dd_portfolio_no_item_per_page',
			'type'		 => 'text',
			'title'		 => __( 'Number of Portfolio Items Per Page', 'dayneo' ),
			'default'	 => '10',
		),
		array(
			'subtitle'	 => __( 'Select the portfolio style that will display on the portfolio pages.', 'dayneo' ),
			'id'		 => 'dd_portfolio_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'grid'		 => __( 'Grid', 'dayneo' ),
				'grid_no_space'	 => __( 'Grid No Space', 'dayneo' ),
			),
			'title'		 => __( 'Portfolio Style', 'dayneo' ),
			'default'	 => 'grid',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> portfolio per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'dayneo' ),
			'id'		 => 'dd_portfolio_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => DAYNEO_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYNEO_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYNEO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Portfolio Grid Layout', 'dayneo' ),
			'default'	 => '2',
		),
		array(
			'subtitle'	 => __( 'Custom hover color of portfolio works', 'dayneo' ),
			'id'		 => 'dd_portfolio_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Portfolio Hover Color', 'dayneo' ),
			'default'	 => '#1fa098',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will be added to the archive/category portfolio pages.', 'dayneo' ),
			'id'		 => 'dd_portfolio_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Portfolio Archive/Category Sidebar', 'dayneo' ),
			'default'	 => 'None',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-single-post-page-tab',
	'title'		 => __( 'Single Portfolio Page', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on single post pages.', 'dayneo' ),
			'id'		 => 'dd_portfolio_featured_image',
			'type'		 => 'switch',
			'title'		 => __( 'Featured Image on Single Portfolio', 'dayneo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to enable Author on portfolio items.', 'dayneo' ),
			'id'		 => 'dd_portfolio_author',
			'type'		 => 'switch',
			'title'		 => __( 'Show Author', 'dayneo' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display the social sharing box.', 'dayneo' ),
			'id'		 => 'dd_portfolio_sharing',
			'type'		 => 'switch',
			'title'		 => __( 'Social Sharing Box', 'dayneo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display related portfolio.', 'dayneo' ),
			'id'		 => 'dd_portfolio_related_posts',
			'type'		 => 'switch',
			'title'		 => __( 'Related Portfolio', 'dayneo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable previous/next pagination.', 'dayneo' ),
			'id'		 => 'dd_portfolio_pagination',
			'type'		 => 'switch',
			'title'		 => __( 'Previous/Next Pagination', 'dayneo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-woocommerce-main-tab',
	'title'	 => __( 'WooCommerce', 'dayneo' ),
	'icon'	 => 'fa  fa-shopping-cart icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Insert the number of products to display per page.', 'dayneo' ),
			'id'		 => 'dd_woo_items',
			'type'		 => 'text',
			'title'		 => __( 'Number of Products Per Page', 'dayneo' ),
			'default'	 => '12',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable the ordering boxes displayed on the shop page.', 'dayneo' ),
			'id'		 => 'dd_woocommerce_dayneo_ordering',
			'type'		 => 'switch',
			'title'		 => __( 'Disable Woocommerce Shop Page Ordering Boxes', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> products per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'dayneo' ),
			'id'		 => 'dd_woocommerce_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => DAYNEO_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYNEO_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYNEO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Product Grid layout', 'dayneo' ),
			'default'	 => '2',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will be added to the shop page.', 'dayneo' ),
			'id'		 => 'dd_shop_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Shop Sidebar', 'dayneo' ),
			'default'	 => 'None',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-typography-main-tab',
	'title'	 => __( 'Typography', 'dayneo' ),
	'icon'	 => 'fa fa-font icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-custom',
	'title'		 => __( 'Custom Fonts', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'raw'	 => __( '<h3 style=\'margin: 0;\'>Custom fonts for all elements.</h3><p style="margin-bottom:0;">This will override the Google / standard font options. All 4 files are required.</h3>', 'dayneo' ),
			'id'	 => 'dd_custom_fonts',
			'type'	 => 'info',
		),
		array(
			'subtitle'	 => __( 'Upload the .woff font file.', 'dayneo' ),
			'id'		 => 'dd_custom_font_woff',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .woff', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .ttf font file.', 'dayneo' ),
			'id'		 => 'dd_custom_font_ttf',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .ttf', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .svg font file.', 'dayneo' ),
			'id'		 => 'dd_custom_font_svg',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .svg', 'dayneo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .eot font file.', 'dayneo' ),
			'id'		 => 'dd_custom_font_eot',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .eot', 'dayneo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog title. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_title_font',
			'type'		 => 'typography',
			'title'		 => __( 'Blog Title Font', 'dayneo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '23px',
				'color'		 => '#222222',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '700',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog tagline. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_tagline_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Blog Tagline Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $dd_options, array(
    'id'         => 'dd-typography-subsec-tvslider-tab',
    'title'      => __( 'ThemeVedanta Slider', 'dayneo' ),
    'subsection' => true,
    'fields'     => array(
        array(
            'subtitle'    => __( 'Select the typography you want for your slider heading. * non web-safe font.', 'dayneo' ),
            'id'          => 'dd_slider_heading_font',
            'type'        => 'typography',
            'title'       => __( 'Slider Heading Font', 'dayneo' ),
            'text-align'  => false,
            'line-height' => false,
            'default'     => array(
                'font-size'   => '58px',
                'color'       => '#ffffff',
                'font-family' => 'Pacifico',
                'font-weight' => '400',
            ),
        ),
        array(
            'subtitle'    => __( 'Select the typography you want for your slider caption. * non web-safe font.', 'dayneo' ),
            'id'          => 'dd_slider_caption_font',
            'type'        => 'typography',
            'text-align'  => false,
            'line-height' => false,
            'title'       => __( 'Slider Caption Font', 'dayneo' ),
            'default'     => array(
                'font-size'   => '20px',
                'font-family' => 'Pacifico',
                'color'       => '#ffffff',
                'font-weight' => '400',
            ),
        ),
    ),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-menu-tab',
	'title'		 => __( 'Menu', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your main menu. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Main Menu Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '11px',
				'color'		 => '#999',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your top menu. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_top_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Top Menu Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'color'		 => '#777777',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '400',
			),
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-post-tab',
	'title'		 => __( 'Post Title & Content', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your post titles. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_post_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Post Title Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '23px',
				'color'		 => '#222222',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Content Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'color'		 => '#777777',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-widget-tab',
	'title'		 => __( 'Widget', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Title Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'color'		 => '#222222',
				'font-family'	 => 'Montserrat',
				'font-weight'	 => '700',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Content Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_footer_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Title Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'color'		 => '#ffffff',
				'font-family'	 => 'Montserrat',
				'font-weight'	 => '700',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_footer_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Content Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#ffffff',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-headings-tab',
	'title'		 => __( 'Headings', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your H1 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h1_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H1 Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '32px',
				'color'		 => '#222222',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H2 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h2_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H2 Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '26px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H3 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h3_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H3 Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '18px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H4 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h4_font',
			'type'		 => 'typography',
			'title'		 => __( 'H4 Font', 'dayneo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '16px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H5 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h5_font',
			'type'		 => 'typography',
			'title'		 => __( 'H5 Font', 'dayneo' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H6 tag in blog content. * non web-safe font.', 'dayneo' ),
			'id'		 => 'dd_content_h6_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H6 Font', 'dayneo' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-styling-main-tab',
	'title'	 => __( 'Styling', 'dayneo' ),
	'icon'	 => 'fa fa-paint-brush icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-main-scheme-tab',
	'title'		 => __( 'Main Color Scheme', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'		 => 'dd_color_palettes',
			'type'		 => 'palette',
			'title'		 => __( 'Main Color Scheme', 'dayneo' ),
			'subtitle'	 => __( 'Please select the predefined color scheme of your website', 'dayneo' ),
			'default'	 => 'color_palette_1',
			'palettes'	 => array(
				'color_palette_1'	 => array(
					'#27CBC0',
					'#1fa098',
					'#222222',
					'#777777',
				),
				'color_palette_2'	 => array(
					'#3498db',
					'#217dbb',
					'#222',
					'#777',
				),
				'color_palette_3'	 => array(
					'#444',
					'#2b2b2b',
					'#222',
					'#777',
				),
				'color_palette_4'	 => array(
					'#ff6c5c',
					'#ff3e29',
					'#222',
					'#777',
				),
				'color_palette_5'	 => array(
					'#f1c40f',
					'#c29d0b',
					'#222',
					'#777',
				),
			),
		),
		array(
			'subtitle'	 => __( 'Primary color of site', 'dayneo' ),
			'id'		 => 'dd_primary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Primary Color', 'dayneo' ),
			'default'	 => '#27CBC0',
		),
		array(
			'subtitle'	 => __( 'Secondry color of site', 'dayneo' ),
			'id'		 => 'dd_secondry_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Secondry Color', 'dayneo' ),
			'default'	 => '#1fa098',
		),		
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-menu-tab',
	'title'		 => __( 'Menu', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Set the font size for mega menu column titles. In pixels, ex: 15px', 'dayneo' ),
			'id'		 => 'dd_megamenu_title_size',
			'type'		 => 'text',
			'title'		 => __( 'Mega Menu Column Title Size', 'dayneo' ),
			'default'	 => '13px',
		),
		array(
			'subtitle'	 => __( 'Set padding between menu items.', 'dayneo' ),
			'id'		 => 'dd_main_menu_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Padding Between Menu Items', 'dayneo' ),
			'default'	 => array(
				'padding-top'	 => '33',
				'padding-right' => '15',
				'padding-bottom' => '33',
				'padding-left' => '15',
				'units'		 => 'px',
			),
		),
		array(
			'subtitle'	 => __( 'Main menu text transform', 'dayneo' ),
			'id'		 => 'dd_menu_text_transform',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'none'		 => __( 'none', 'dayneo' ),
				'lowercase'	 => __( 'lowercase', 'dayneo' ),
				'capitalize'	 => __( 'Capitalize', 'dayneo' ),
				'uppercase'	 => __( 'UPPERCASE', 'dayneo' ),
			),
			'title'		 => __( 'Set the main menu text transform', 'dayneo' ),
			'default'	 => 'uppercase',
		),
		array(
			'subtitle'	 => __( 'Main menu hover font color', 'dayneo' ),
			'id'		 => 'dd_main_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Menu Hover Font Color', 'dayneo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Sub menu hover font color', 'dayneo' ),
			'id'		 => 'dd_sub_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Submenu Hover Font Color', 'dayneo' ),
			'default'	 => '#ffffff',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-element-colors',
	'title'		 => __( 'Element Colors', 'dayneo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Controls the background color of form fields.', 'dayneo' ),
			'id'		 => 'dd_form_bg_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Background Color', 'dayneo' ),
			'default'	 => '#fff',
		),
		array(
			'subtitle'	 => __( 'Controls the text color for forms.', 'dayneo' ),
			'id'		 => 'dd_form_text_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Text Color', 'dayneo' ),
			'default'	 => '#999999',
		),
		array(
			'subtitle'	 => __( 'Controls the border color of form fields.', 'dayneo' ),
			'id'		 => 'dd_form_border_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Border Color', 'dayneo' ),
			'default'	 => '#eee',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-sharing-main-tab',
	'title'	 => __( 'Social Sharing Box', 'dayneo' ),
	'icon'	 => 'fa fa-group icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Select a custom social icon color.', 'dayneo' ),
			'id'		 => 'dd_sharing_box_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Custom Icons Color', 'dayneo' ),
			'default'	 => '#777777',
		),
		array(
			'subtitle'	 => __( 'Select a custom social icon box color.', 'dayneo' ),
			'id'		 => 'dd_sharing_box_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Icons Custom Box Color', 'dayneo' ),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'dayneo' ),
			'id'		 => 'dd_sharing_box_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Sharing Box Icons Boxed Radius', 'dayneo' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons in the sharing box.', 'dayneo' ),
			'id'		 => 'dd_sharing_box_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'dayneo' ),
				'right'	 => __( 'Right', 'dayneo' ),
				'bottom' => __( 'Bottom', 'dayneo' ),
				'left'	 => __( 'Left', 'dayneo' ),
				'none'	 => __( 'None', 'dayneo' ),
			),
			'title'		 => __( 'Social Sharing Box Icons Tooltip Position', 'dayneo' ),
			'default'	 => 'top',
		),
		array(
			'subtitle'	 => __( 'Show the facebook sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_facebook',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Facebook', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the twitter sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_twitter',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Twitter', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the linkedin sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_linkedin',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'LinkedIn', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the g+ sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_google',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Google Plus', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the pinterest sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_pinterest',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Pinterest', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the email sharing icon in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_email',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Email', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Show the more options button in blog posts.', 'dayneo' ),
			'id'		 => 'dd_sharing_more_options',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'More Options Button', 'dayneo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-links-main-tab',
	'title'	 => __( 'Social Media Links', 'dayneo' ),
	'icon'	 => 'fa fa-share-square-o icon-larg',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icons', 'dayneo' ),
			'id'		 => 'dd_social_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icons Color', 'dayneo' ),
			'default'	 => '#777777',
		),
		array(
			'subtitle'	 => __( 'Choose yes option if you want to display icon in boxed', 'dayneo' ),
			'id'		 => 'dd_social_boxed',
			'type'		 => 'select',
			'options'	 => array(
				'no'	 => __( 'No', 'dayneo' ),
				'yes'	 => __( 'Yes', 'dayneo' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'dayneo' ),
			'default'	 => 'no',
		),
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icon boxed', 'dayneo' ),
			'id'		 => 'dd_social_boxed_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icon Boxed Background Color', 'dayneo' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'dayneo' ),
			'id'		 => 'dd_social_boxed_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Icon Boxed Radius', 'dayneo' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => __( 'Choose _blank option if you want to open link in new window tab.', 'dayneo' ),
			'id'		 => 'dd_social_target',
			'type'		 => 'select',
			'options'	 => array(
				'_blank' => __( '_blank', 'dayneo' ),
				'_self'	 => __( '_self', 'dayneo' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'dayneo' ),
			'default'	 => '_blank',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons', 'dayneo' ),
			'id'		 => 'dd_social_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'dayneo' ),
				'right'	 => __( 'Right', 'dayneo' ),
				'bottom' => __( 'Bottom', 'dayneo' ),
				'left'	 => __( 'Left', 'dayneo' ),
				'none'	 => __( 'None', 'dayneo' ),
			),
			'title'		 => __( 'Social Sharing Box Icons Tooltip Position', 'dayneo' ),
			'default'	 => 'top',
		),
		array(
			'id'		 => 'dd_social_link_facebook',
			'type'		 => 'text',
			'title'		 => __( 'Facebook', 'dayneo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Facebook URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_twitter',
			'type'		 => 'text',
			'title'		 => __( 'Twitter', 'dayneo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Twitter URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_google-plus',
			'type'		 => 'text',
			'title'		 => __( 'Google Plus', 'dayneo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your google-plus URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_dribbble',
			'type'		 => 'text',
			'title'		 => __( 'Dribbble', 'dayneo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your dribbble URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_linkedin',
			'type'		 => 'text',
			'title'		 => __( 'LinkedIn', 'dayneo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your linkedin URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_tumblr',
			'type'		 => 'text',
			'title'		 => __( 'Tumblr', 'dayneo' ),
			'subtitle'	 => __( 'Insert your tumblr URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_reddit',
			'type'		 => 'text',
			'title'		 => __( 'Reddit', 'dayneo' ),
			'subtitle'	 => __( 'Insert your reddit URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_yahoo',
			'type'		 => 'text',
			'title'		 => __( 'Yahoo', 'dayneo' ),
			'subtitle'	 => __( 'Insert your yahoo URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_deviantart',
			'type'		 => 'text',
			'title'		 => __( 'Deviantart', 'dayneo' ),
			'subtitle'	 => __( 'Insert your deviantart URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_vimeo',
			'type'		 => 'text',
			'title'		 => __( 'Vimeo', 'dayneo' ),
			'subtitle'	 => __( 'Insert your vimeo URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_youtube',
			'type'		 => 'text',
			'title'		 => __( 'Youtube', 'dayneo' ),
			'subtitle'	 => __( 'Insert your youtube URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_pinterest',
			'type'		 => 'text',
			'title'		 => __( 'Pinterest', 'dayneo' ),
			'subtitle'	 => __( 'Insert your pinterest URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_digg',
			'type'		 => 'text',
			'title'		 => __( 'Digg', 'dayneo' ),
			'subtitle'	 => __( 'Insert your digg URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_flickr',
			'type'		 => 'text',
			'title'		 => __( 'Flickr', 'dayneo' ),
			'subtitle'	 => __( 'Insert your flickr URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_skype',
			'type'		 => 'text',
			'title'		 => __( 'Skype', 'dayneo' ),
			'subtitle'	 => __( 'Insert your skype URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_instagram',
			'type'		 => 'text',
			'title'		 => __( 'Instagram', 'dayneo' ),
			'subtitle'	 => __( 'Insert your instagram URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_vk',
			'type'		 => 'text',
			'title'		 => __( 'VK', 'dayneo' ),
			'subtitle'	 => __( 'Insert your vk URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_paypal',
			'type'		 => 'text',
			'title'		 => __( 'PayPal', 'dayneo' ),
			'subtitle'	 => __( 'Insert your paypal URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_dropbox',
			'type'		 => 'text',
			'title'		 => __( 'Dropbox', 'dayneo' ),
			'subtitle'	 => __( 'Insert your dropbox URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_soundcloud',
			'type'		 => 'text',
			'title'		 => __( 'Soundcloud', 'dayneo' ),
			'subtitle'	 => __( 'Insert your soundcloud URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Foursquare', 'dayneo' ),
			'subtitle'	 => __( 'Insert your foursquare URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Vine', 'dayneo' ),
			'subtitle'	 => __( 'Insert your vine URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_wordpress',
			'type'		 => 'text',
			'title'		 => __( 'Wordpress', 'dayneo' ),
			'subtitle'	 => __( 'Insert your wordpress URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_behance',
			'type'		 => 'text',
			'title'		 => __( 'Behance', 'dayneo' ),
			'subtitle'	 => __( 'Insert your behance URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_stumbleupo',
			'type'		 => 'text',
			'title'		 => __( 'Stumbleupo', 'dayneo' ),
			'subtitle'	 => __( 'Insert your stumbleupo URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_github',
			'type'		 => 'text',
			'title'		 => __( 'Github', 'dayneo' ),
			'subtitle'	 => __( 'Insert your github URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_lastfm',
			'type'		 => 'text',
			'title'		 => __( 'Lastfm', 'dayneo' ),
			'subtitle'	 => __( 'Insert your lastfm URL', 'dayneo' ),
		),
		array(
			'id'		 => 'dd_social_link_rss',
			'type'		 => 'text',
			'title'		 => __( 'RSS Feed', 'dayneo' ),
			'default'	 => $dayneo_rss_url,
			'subtitle'	 => __( 'Insert custom RSS Feed URL, e.g. <strong>http://feeds.feedburner.com/Example</strong>', 'dayneo' ),
		),
	)
) );




Redux::setSection( $dd_options, array(
	'id'	 => 'dd-extra-main-tab',
	'title'	 => __( 'Extra', 'dayneo' ),
	'icon'	 => 'fa  fa-gears icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display the theme\'s mega menu.', 'dayneo' ),
			'id'		 => 'dd_megamenu',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Mega Menu', 'dayneo' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display Back to Top button.', 'dayneo' ),
			'id'		 => 'dd_back_to_top',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'dayneo' ),
			'off'		 => __( 'Disabled', 'dayneo' ),
			'default'	 => 1,
			'title'		 => __( 'Back to Top button', 'dayneo' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to add rel="nofollow" attribute to social sharing box and social links.', 'dayneo' ),
			'id'		 => 'dd_nofollow_social_links',
			'type'		 => 'switch',
			'on'		 => __( 'Yes', 'dayneo' ),
			'off'		 => __( 'No', 'dayneo' ),
			'title'		 => __( 'Add rel="nofollow" to social links', 'dayneo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-import-export-main-tab',
	'title'	 => __( 'Import / Export', 'dayneo' ),
	'icon'	 => 'fa fa-exchange icon-large',
	'fields' => array(
		array(
			'id'		 => 'redux_import_export',
			'type'		 => 'import_export',
			//'class'      => 'redux-field-init redux_remove_th',
			//'title'      => __( '',
			'full_width'	 => true,
		)
	),
)
);

// -> END Basic Fields

/*
 * Override Redux Content with Dayneo Content
 */
function dayneo_override_content() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_register_style( 'dayneo-redux-custom-css', get_template_directory_uri() . '/themeoptions/options/css/style.css', false, 258 );
	wp_enqueue_style( 'dayneo-redux-custom-css' );
	wp_dequeue_style( 'select2-css' );
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action( 'redux-enqueue-dd_options', 'dayneo_override_content' );

/*
 * Hide Demo Mode Link
 */

function dayneo_remove_demo() {

	// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		remove_filter( 'plugin_row_meta', array(
			ReduxFrameworkPlugin::instance(),
			'plugin_metalinks'
		), null, 2 );

		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
	}
}

add_action( 'redux/loaded', 'dayneo_remove_demo' );

/*
 * Override Colorplate Options
 */

function dayneo_colorpalettes() {
	wp_enqueue_script( 'dayneo-colorpalettes', get_template_directory_uri() . '/themeoptions/options/js/colorpalettes.js', array(), '', true );
}

add_action( "redux/page/{$dd_options}/enqueue", "dayneo_colorpalettes" );

