<?php
// Define global options.
define( 'DAYDREAM_IMAGEFOLDER', get_template_directory_uri() . '/themeoptions/options/images/' );
define( 'DAYDREAM_IMAGEPATH', get_template_directory_uri() . '/themeoptions/options/images/functions/' );
define( 'DAYDREAM_DEFAULT', get_template_directory_uri() . '/assets/images/default/' );

// -> BEGIN Themeoption Setup

if ( ! class_exists( 'Redux' ) ) {
	return;
}

global $dd_options;

$dd_options		 = "dd_options"; // This is your option name where all the Redux data is stored.
$daydream_theme		 = wp_get_theme(); // For use with some settings. Not necessary.
$daydream_rss_url	 = get_bloginfo( 'rss_url' );
$daydream_site_url	 = esc_url( "http://themevedanta.com/" );
$daydream_fb_url	 = '#';

$args = array(
	'opt_name'		 => $dd_options,
	'display_name'		 => $daydream_theme->get( 'Name' ),
	'display_name'		 => '<img width="128" height="34" src="' . esc_url(get_template_directory_uri() . '/admin/assets/images/light-logo.png').'" alt="'. esc_attr(get_bloginfo( 'name' )) .'">',
	'page_type'		 => 'submenu',
	'allow_sub_menu'	 => false,
	'menu_title'		 => __( 'Theme Options', 'daydream' ),
	'page_title'		 => __( 'Theme Options', 'daydream' ),
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
	'page_slug'		 => 'daydream_options',
	'ajax_save'		 => true,
	'default_show'		 => false,
	'default_mark'		 => '',
	'disable_tracking'	 => true,
	'customizer_only'	 => false,
	'save_defaults'		 => true,
	'footer_credit'		 => __( 'Thank you for using the Daydream Theme', 'daydream' ),
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
	'intro_text'		 => '<a href="http://daydream.themevedanta.com/" title="Theme Homepage" target="_blank"><i class="fa fa-home"></i> Theme Homepage</a><a href="' . esc_url($daydream_site_url . 'docs/').'" title="Documentation" target="_blank"><i class="fa fa-book"></i> Documentation</a><a href="' . esc_url($daydream_site_url . 'support-forums/').'" title="Support" target="_blank"><i class="fa fa-life-bouy"></i> Support</a><a href="' . esc_url($daydream_fb_url) . '" title="Facebook" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>',
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Daydream Themes on Facebook',
	'icon'	 => 'fa fa-facebook',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Daydream Themes on Twitter',
	'icon'	 => 'fa fa-twitter',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow Daydream Themes on Instagram',
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
	'title'	 => __( 'General', 'daydream' ),
	'icon'	 => 'fa fa-dashboard',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-fav-tab',
	'title'		 => __( 'Favicon', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload custom favicon.', 'daydream' ),
			'id'		 => 'dd_favicon',
			'type'		 => 'media',
			'title'		 => __( 'Custom Favicon', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone (57px x 57px).', 'daydream' ),
			'id'		 => 'dd_iphone_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Icon Upload', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone Retina Version (114px x 114px).', 'daydream' ),
			'id'		 => 'dd_iphone_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Retina Icon Upload', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad (72px x 72px).', 'daydream' ),
			'id'		 => 'dd_ipad_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Icon Upload', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad Retina Version (144px x 144px).', 'daydream' ),
			'id'		 => 'dd_ipad_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Retina Icon Upload', 'daydream' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-loader-tab',
	'title'		 => __( 'Site Loader', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display loader in site', 'daydream' ),
			'id'		 => 'dd_siteloader',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Site Loader', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Upload custom loader.', 'daydream' ),
			'id'		 => 'dd_loaderfile',
			'type'		 => 'media',
			'title'		 => __( 'Custom Loader', 'daydream' ),
			'url'		 => true,
			'required'	 => array( array( "dd_siteloader", '=', 1 ) ),
			'default'	 => array(
				'url' => DAYDREAM_DEFAULT . 'loader.gif'
			),
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-lay-tab',
	'title'		 => __( 'Layout', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select main content and sidebar alignment.', 'daydream' ),
			'id'		 => 'dd_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1c'	 => DAYDREAM_IMAGEPATH . '1c.png',
				'2cl'	 => DAYDREAM_IMAGEPATH . '2cl.png',
				'2cr'	 => DAYDREAM_IMAGEPATH . '2cr.png',
				'3cm'	 => DAYDREAM_IMAGEPATH . '3cm.png',
				'3cr'	 => DAYDREAM_IMAGEPATH . '3cr.png',
				'3cl'	 => DAYDREAM_IMAGEPATH . '3cl.png',
			),
			'title'		 => __( 'Select layout', 'daydream' ),
			'default'	 => '2cl',
		),
		array(
			'subtitle'	 => __( '<strong>Boxed version</strong> automatically enables custom background', 'daydream' ),
			'id'		 => 'dd_width_layout',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'fixed'	 => __( 'Boxed', 'daydream' ),
				'fluid'	 => __( 'Wide', 'daydream' ),
			),
			'title'		 => __( 'Layout Style', 'daydream' ),
			'default'	 => 'fluid',
		),
		array(
			'subtitle'	 => __( 'Select the width for your website', 'daydream' ),
			'id'		 => 'dd_width_px',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				800	 => '800px',
				985	 => '985px',
				1200	 => '1200px',
				1600	 => '1600px',
				'custom' => __( 'Custom', 'daydream' ),
			),
			'title'		 => __( 'Layout Width', 'daydream' ),
			'default'	 => '1200',
		),
		array(
			'title'		 => __( 'Custom Layout Width', 'daydream' ),
			'subtitle'	 => __( 'Add the custom width in px (ex: 1024)', 'daydream' ),
			'id'		 => "dd_custom_width_px",
			'type'		 => "text",
			'required'	 => array( array( "dd_width_px", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => __( 'Select the left and right padding for the Fullwidth-Fluid main content area. Enter value in px. ex: 20px', 'daydream' ),
			'id'		 => 'dd_hundredp_padding',
			'type'		 => 'text',
			'title'		 => __( 'Fullwidth - Fluid Template Left/Right Padding', 'daydream' ),
			'default'	 => '40px',
		),
		array(
			'subtitle'	 => __( 'Enter the page content top & bottom padding.', 'daydream' ),
			'id'		 => 'dd_content_top_bottom_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Content Top & Bottom Padding', 'daydream' ),
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
			'subtitle'	 => __( '<h3>Content and One Sidebar Width</h3>', 'daydream' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s2cl.png" /> <img style="float:left, display:inline" src="%2$s2cr.png" />', 'daydream' ), esc_url(DAYDREAM_IMAGEPATH), esc_url(DAYDREAM_IMAGEPATH) ),
			'id'		 => 'dd_info_consid1_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'daydream' ),
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
			'title'		 => __( 'Content Width', 'daydream' ),
			'default'	 => '9',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'daydream' ),
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
			'title'		 => __( 'Sidebar 1 Width', 'daydream' ),
			'default'	 => '3',
		),
		array(
			'id'		 => 'dd_info_consid2',
			'type'		 => 'info',
			'subtitle'	 => __( '<h3>Content and Two Sidebars Width</h3>', 'daydream' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s3cm.png" /> <img style="float:left, display:inline" src="%2$s3cr.png" /> <img style="float:left, display:inline" src="%3$s3cl.png" />', 'daydream' ), esc_url(DAYDREAM_IMAGEPATH), esc_url(DAYDREAM_IMAGEPATH), esc_url(DAYDREAM_IMAGEPATH) ),
			'id'		 => 'dd_info_consid2_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'daydream' ),
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
			'title'		 => __( 'Content Width', 'daydream' ),
			'default'	 => '6',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'daydream' ),
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
			'title'		 => __( 'Sidebar 1 Width', 'daydream' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 2', 'daydream' ),
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
			'title'		 => __( 'Sidebar 2 Width', 'daydream' ),
			'default'	 => '3',
		),
	),
)
);

// Header Main Sections
Redux::setSection( $dd_options, array(
	'id'	 => 'dd-header-main-tab',
	'title'	 => __( 'Header', 'daydream' ),
	'icon'	 => 'fa fa-window-maximize icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-header-tab',
	'title'		 => __( 'Header', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display searchbox in Header', 'daydream' ),
			'id'		 => 'dd_searchbox',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Searchbox', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display cart in Header', 'daydream' ),
			'id'		 => 'dd_woo_cart',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Cart', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display menu in Header', 'daydream' ),
			'id'		 => 'dd_primary_menu',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Menu', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display mobile menu', 'daydream' ),
			'id'		 => 'dd_mobile_menu',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Mobile Menu', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display Sticky Header', 'daydream' ),
			'id'		 => 'dd_sticky_header',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Sticky Header', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose your Header Type', 'daydream' ),
			'id'		 => 'dd_header_type',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'h1'	 => DAYDREAM_IMAGEFOLDER . '/header/header-1.png',
				'h2'	 => DAYDREAM_IMAGEFOLDER . '/header/header-2.png',
				'h3'	 => DAYDREAM_IMAGEFOLDER . '/header/header-3.png',
				'h4'	 => DAYDREAM_IMAGEFOLDER . '/header/header-4.png',
				'h5'	 => DAYDREAM_IMAGEFOLDER . '/header/header-5.png',
			),
			'title'		 => __( 'Choose Header Type', 'daydream' ),
			'default'	 => 'h1',
		),
		array(
			'subtitle'	 => __( 'Control the background color of topbar header.', 'daydream' ),
			'id'		 => 'dd_topbar_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => __( 'Top Bar Color', 'daydream' ),
			'default'	 => '#000000',
			'required'	 => array( array( "dd_header_type", '=', 'h5' ) ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-topbar-tab',
	'title'		 => __( 'Top Bar', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select which content displays in the top left area of the header.', 'daydream' ),
			'id'		 => 'dd_header_left_content',
			'type'		 => 'select',
			'options'	 => array(
				'contact_info'	 => __( 'Contact Info', 'daydream' ),
				'social_links'	 => __( 'Social Links', 'daydream' ),
				'navigation'	 => __( 'Navigation', 'daydream' ),
				'empty'		 => __( 'Leave Empty', 'daydream' ),
			),
			'title'		 => __( 'Header Top Left Content', 'daydream' ),
			'default'	 => 'contact_info',
		),
		array(
			'subtitle'	 => __( 'Select which content displays in the top right area of the header.', 'daydream' ),
			'id'		 => 'dd_header_right_content',
			'type'		 => 'select',
			'options'	 => array(
				'contact_info'	 => __( 'Contact Info', 'daydream' ),
				'social_links'	 => __( 'Social Links', 'daydream' ),
				'navigation'	 => __( 'Navigation', 'daydream' ),
				'empty'		 => __( 'Leave Empty', 'daydream' ),
			),
			'title'		 => __( 'Header Top Right Content', 'daydream' ),
			'default'	 => 'navigation',
		),
		array(
			'subtitle'	 => __( 'Phone number will display in the Contact Info section of your top header.', 'daydream' ),
			'id'		 => 'dd_header_number',
			'type'		 => 'text',
			'title'		 => __( 'Header Phone Number', 'daydream' ),
			'default'	 => '+49 7890 123 456',
		),
		array(
			'subtitle'	 => __( 'Email address will display in the Contact Info section of your top header.', 'daydream' ),
			'id'		 => 'dd_header_email',
			'type'		 => 'text',
			'title'		 => __( 'Header Email Address', 'daydream' ),
			'default'	 => 'contact@example.com',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-logo-tab',
	'title'		 => __( 'Logo', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload a logo for your theme, or specify an image URL directly.', 'daydream' ),
			'id'		 => 'dd_header_logo',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo', 'daydream' ),
			'url'		 => true,
		),
                array(
                    'subtitle' => __( 'Upload a logo for your transparent header, Apply only header-2', 'daydream' ),
                    'id'       => 'dd_header2_logo',
                    'type'     => 'media',
                    'title'    => __( 'Custom Logo(For Header-2)', 'daydream' ),
                    'url'      => true,
                ),
		array(
			'subtitle'	 => __( 'Select an image file for the retina version of the custom logo. It should be exactly 2x the size of main logo.', 'daydream' ),
			'id'		 => 'dd_header_logo_retina',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo (Retina Version @2x)', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. In px.', 'daydream' ),
			'id'		 => 'dd_header_logo_retina_width',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Width for Retina Logo', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. In px.', 'daydream' ),
			'id'		 => 'dd_header_logo_retina_height',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Height for Retina Logo', 'daydream' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display title of your blog', 'daydream' ),
			'id'		 => 'dd_blog_title',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Title', 'daydream' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display tagline of your blog', 'daydream' ),
			'id'		 => 'dd_blog_tagline',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Tagline', 'daydream' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-footer-main-tab',
	'title'	 => __( 'Footer', 'daydream' ),
	'icon'	 => 'fa fa-columns icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-footer-widgets-tab',
	'title'		 => __( 'Footer Widgets', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select how many footer widget areas you want to display.', 'daydream' ),
			'id'		 => 'dd_footer_widget_col',
			'type'		 => 'image_select',
			'options'	 => array(
				'disable'	 => DAYDREAM_IMAGEPATH . '1c.png',
				'one'		 => DAYDREAM_IMAGEPATH . 'footer-widgets-1.png',
				'two'		 => DAYDREAM_IMAGEPATH . 'footer-widgets-2.png',
				'three'		 => DAYDREAM_IMAGEPATH . 'footer-widgets-3.png',
				'four'		 => DAYDREAM_IMAGEPATH . 'footer-widgets-4.png',
			),
			'title'		 => __( 'Number of Widget Cols in Footer', 'daydream' ),
			'default'	 => 'disable',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-custom-footer-tab',
	'title'		 => __( 'Custom Footer', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Available <strong>HTML</strong> tags and attributes:<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code>', 'daydream' ),
			'id'		 => 'dd_footer_content',
			'type'		 => 'textarea',
			'title'		 => __( 'Custom Footer', 'daydream' ),
			'default'	 => '<p id="copyright"><span class="credits"><a href="' . esc_url($daydream_site_url . 'daydream-multipurpose-wordpress-theme/').'">DayDream</a> theme by ThemeVedanta</span></p>',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-header-footer-tab',
	'title'		 => __( 'Footer Styles', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Custom background color of footer', 'daydream' ),
			'id'		 => 'dd_footer_bg_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Footer Background color', 'daydream' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Upload a footer background image for your theme, or specify an image URL directly.', 'daydream' ),
			'id'		 => 'dd_footer_background_image',
			'type'		 => 'media',
			'title'		 => __( 'Footer Background Image', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Select if the footer background image should be displayed in cover or contain size.', 'daydream' ),
			'id'		 => 'dd_footer_image',
			'type'		 => 'select',
			'options'	 => array(
				'cover'		 => __( 'Cover', 'daydream' ),
				'contain'	 => __( 'Contain', 'daydream' ),
				'none'		 => __( 'None', 'daydream' ),
			),
			'title'		 => __( 'Background Responsiveness Style', 'daydream' ),
			'default'	 => 'cover',
		),
		array(
			'id'		 => 'dd_footer_image_background_repeat',
			'type'		 => 'select',
			'options'	 => array(
				'no-repeat'	 => __( 'no-repeat', 'daydream' ),
				'repeat'	 => __( 'repeat', 'daydream' ),
				'repeat-x'	 => __( 'repeat-x', 'daydream' ),
				'repeat-y'	 => __( 'repeat-y', 'daydream' ),
			),
			'title'		 => __( 'Background Repeat', 'daydream' ),
			'default'	 => 'no-repeat',
		),
		array(
			'id'		 => 'dd_footer_image_background_position',
			'type'		 => 'select',
			'options'	 => array(
				'center top'	 => __( 'center top', 'daydream' ),
				'center center'	 => __( 'center center', 'daydream' ),
				'center bottom'	 => __( 'center bottom', 'daydream' ),
				'left top'	 => __( 'left top', 'daydream' ),
				'left center'	 => __( 'left center', 'daydream' ),
				'left bottom'	 => __( 'left bottom', 'daydream' ),
				'right top'	 => __( 'right top', 'daydream' ),
				'right center'	 => __( 'right center', 'daydream' ),
				'right bottom'	 => __( 'right bottom', 'daydream' ),
			),
			'title'		 => __( 'Background Position', 'daydream' ),
			'default'	 => 'center top',
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'daydream' ),
			'id'		 => 'dd_footer_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'daydream' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( '<h3 style=\'margin: 0;\'>Footer Default Pattern</h3>', 'daydream' ),
			'id'		 => 'dd_header_footer',
			'type'		 => 'info',
		),
		array(
			'subtitle'	 => __( 'Choose the pattern for footer background', 'daydream' ),
			'id'		 => 'dd_pattern',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'none'			 => DAYDREAM_IMAGEPATH . 'none.jpg',
				'pattern_1_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_1_thumb.png',
				'pattern_2_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_2_thumb.png',
				'pattern_3_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_3_thumb.png',
				'pattern_4_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_4_thumb.png',
				'pattern_5_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_5_thumb.png',
				'pattern_6_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_6_thumb.png',
				'pattern_7_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_7_thumb.png',
				'pattern_8_thumb.png'	 => DAYDREAM_IMAGEFOLDER . '/pattern/pattern_8_thumb.png',
			),
			'title'		 => __( 'Footer pattern', 'daydream' ),
			'default'	 => 'none',
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'	 => 'dd-pagetitlebar-tab',
	'title'	 => __( 'Page Title Bar', 'daydream' ),
	'icon'	 => 'fa fa-pencil-square-o icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display page titlebar above the content and sidebar area', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_layout',
			'compiler'	 => true,
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Page Title Bar', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose the display option to show the page title', 'daydream' ),
			'id'		 => 'dd_display_pagetitlebar',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'daydream' ),
				'titlebar'		 => __( 'Only Title', 'daydream' ),
				'breadcrumb'		 => __( 'Only Breadcrumb', 'daydream' ),
			),
			'title'		 => __( 'Page Title & Breadcrumbs', 'daydream' ),
			'default'	 => 'titlebar_breadcrumb',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => __( 'Choose your page titlebar layout', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_layout_opt',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'title'		 => __( 'Page Title Bar Layout Type', 'daydream' ),
			'options'	 => array(
				'titlebar_left'		 => DAYDREAM_IMAGEFOLDER . '/titlebarlayout/titlebar_left.png',
				'titlebar_center'	 => DAYDREAM_IMAGEFOLDER . '/titlebarlayout/titlebar_center.png',
				'titlebar_right'	 => DAYDREAM_IMAGEFOLDER . '/titlebarlayout/titlebar_right.png',
			),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => 'titlebar_center',
		),
		array(
			'subtitle'	 => __( 'Select the height for your pagetitle bar', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_height',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'small'	 => 'Small',
				'medium' => 'Medium',
				'large'	 => 'Large',
				'custom' => __( 'Custom', 'daydream' ),
			),
			'title'		 => __( 'Page Title Bar Height', 'daydream' ),
			'default'	 => 'medium',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'title'		 => __( 'Custom Page Title Bar Height', 'daydream' ),
			'subtitle'	 => __( 'Add the custom height for page title bar. All height in px. Ex: 70', 'daydream' ),
			'id'		 => "dd_pagetitlebar_custom",
			'type'		 => "text",
			'required'	 => array( array( "dd_pagetitlebar_height", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => __( 'Custom background color of page title bar', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_background_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Page Title Bar Background Color', 'daydream' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => __( 'Select an image or insert an image url to use for the page title bar background.', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_background',
			'type'		 => 'media',
			'title'		 => __( 'Page Title Bar Background', 'daydream' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'daydream' ),
			'id'		 => 'dd_pagetitlebar_background_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'daydream' ),
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
	'title'	 => __( 'Blog', 'daydream' ),
	'icon'	 => 'fa fa-newspaper-o icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-general-tab',
	'title'		 => __( 'General', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the blog style that will display on the blog pages.', 'daydream' ),
			'id'		 => 'dd_blog_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'classic'		 => __( 'Classic', 'daydream' ),
				'thumbnail_on_side'	 => __( 'Thumbnail On Side', 'daydream' ),
				'grid'			 => __( 'Grid', 'daydream' ),
			),
			'title'		 => __( 'Blog Style', 'daydream' ),
			'default'	 => 'classic',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> posts per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'daydream' ),
			'id'		 => 'dd_post_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1'	 => DAYDREAM_IMAGEPATH . 'one-post.png',
				'2'	 => DAYDREAM_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYDREAM_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYDREAM_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Blog Grid layout', 'daydream' ),
			'default'	 => '2',
			'required'	 => array(
				array( 'dd_blog_style', '=', 'grid' )
			),
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will display on the archive/category pages.', 'daydream' ),
			'id'		 => 'dd_blog_archive_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Blog Archive/Category Sidebar', 'daydream' ),
			'default'	 => 'None',
		),
		array(
			'subtitle'	 => __( 'Choose placement of the \'Share This\' buttons', 'daydream' ),
			'id'		 => 'dd_share_this',
			'type'		 => 'select',
			'options'	 => array(
				'single'	 => __( 'Single Posts', 'daydream' ),
				'page'		 => __( 'Single Pages', 'daydream' ),
				'all'		 => __( 'All', 'daydream' ),
				'disable'	 => __( 'Disable', 'daydream' ),
			),
			'title'		 => __( '\'Share This\' buttons placement', 'daydream' ),
			'default'	 => 'single',
		),
		array(
			'subtitle'	 => __( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'daydream' ),
			'id'		 => 'dd_pagination_type',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'pagination'		 => __( 'Default Pagination', 'daydream' ),
				'number_pagination'	 => __( 'Number Pagination', 'daydream' ),
			),
			'title'		 => __( 'Pagination Type', 'daydream' ),
			'default'	 => 'pagination',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display edit post link', 'daydream' ),
			'id'		 => 'dd_edit_post',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Edit Post Link', 'daydream' ),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-post-tab',
	'title'		 => __( 'Posts', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta header', 'daydream' ),
			'id'		 => 'dd_header_meta',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Header', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta date', 'daydream' ),
			'id'		 => 'dd_meta_date',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Date', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta author', 'daydream' ),
			'id'		 => 'dd_meta_author',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Author', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display post author avatar', 'daydream' ),
			'id'		 => 'dd_author_avatar',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Enable Post Author Avatar', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta tags', 'daydream' ),
			'id'		 => 'dd_meta_tags',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Tags', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta comments', 'daydream' ),
			'id'		 => 'dd_meta_comments',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 0,
			'title'		 => __( 'Post Meta Comments', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose the position of the <strong>Previous/Next Post</strong> links', 'daydream' ),
			'id'		 => 'dd_post_links',
			'type'		 => 'select',
			'options'	 => array(
				'after'	 => __( 'After posts', 'daydream' ),
				'before' => __( 'Before posts', 'daydream' ),
				'both'	 => __( 'Both', 'daydream' ),
			),
			'title'		 => __( 'Position of Previous/Next Posts Links', 'daydream' ),
			'default'	 => 'after',
		),
		array(
			'subtitle'	 => __( 'Choose if you want to display <strong>Similar posts</strong> in articles', 'daydream' ),
			'id'		 => 'dd_similar_posts',
			'type'		 => 'select',
			'options'	 => array(
				'disable'	 => __( 'Disable', 'daydream' ),
				'category'	 => __( 'Match by categories', 'daydream' ),
				'tag'		 => __( 'Match by tags', 'daydream' ),
			),
			'title'		 => __( 'Display Similar Posts', 'daydream' ),
			'default'	 => 'disable',
		),
	),
)
);
Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-featured-tab',
	'title'		 => __( 'Featured Image', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on blog page', 'daydream' ),
			'id'		 => 'dd_featured_images',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Featured Images', 'daydream' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured image on Single Blog Posts', 'daydream' ),
			'id'		 => 'dd_blog_featured_image',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Enable Featured Image on Single Blog Posts', 'daydream' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-portfolio-main-tab',
	'title'	 => __( 'Portfolio', 'daydream' ),
	'icon'	 => 'fa fa-th icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-general-tab',
	'title'		 => __( 'General', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Insert the number of posts to display per page.', 'daydream' ),
			'id'		 => 'dd_portfolio_no_item_per_page',
			'type'		 => 'text',
			'title'		 => __( 'Number of Portfolio Items Per Page', 'daydream' ),
			'default'	 => '10',
		),
		array(
			'subtitle'	 => __( 'Select the portfolio style that will display on the portfolio pages.', 'daydream' ),
			'id'		 => 'dd_portfolio_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'grid'		 => __( 'Grid', 'daydream' ),
				'grid_no_space'	 => __( 'Grid No Space', 'daydream' ),
			),
			'title'		 => __( 'Portfolio Style', 'daydream' ),
			'default'	 => 'grid',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> portfolio per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'daydream' ),
			'id'		 => 'dd_portfolio_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => DAYDREAM_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYDREAM_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYDREAM_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Portfolio Grid Layout', 'daydream' ),
			'default'	 => '2',
		),
		array(
			'subtitle'	 => __( 'Custom hover color of portfolio works', 'daydream' ),
			'id'		 => 'dd_portfolio_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Portfolio Hover Color', 'daydream' ),
			'default'	 => '#1fa098',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will be added to the archive/category portfolio pages.', 'daydream' ),
			'id'		 => 'dd_portfolio_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Portfolio Archive/Category Sidebar', 'daydream' ),
			'default'	 => 'None',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-single-post-page-tab',
	'title'		 => __( 'Single Portfolio Page', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on single post pages.', 'daydream' ),
			'id'		 => 'dd_portfolio_featured_image',
			'type'		 => 'switch',
			'title'		 => __( 'Featured Image on Single Portfolio', 'daydream' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to enable Author on portfolio items.', 'daydream' ),
			'id'		 => 'dd_portfolio_author',
			'type'		 => 'switch',
			'title'		 => __( 'Show Author', 'daydream' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display the social sharing box.', 'daydream' ),
			'id'		 => 'dd_portfolio_sharing',
			'type'		 => 'switch',
			'title'		 => __( 'Social Sharing Box', 'daydream' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display related portfolio.', 'daydream' ),
			'id'		 => 'dd_portfolio_related_posts',
			'type'		 => 'switch',
			'title'		 => __( 'Related Portfolio', 'daydream' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable previous/next pagination.', 'daydream' ),
			'id'		 => 'dd_portfolio_pagination',
			'type'		 => 'switch',
			'title'		 => __( 'Previous/Next Pagination', 'daydream' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-woocommerce-main-tab',
	'title'	 => __( 'WooCommerce', 'daydream' ),
	'icon'	 => 'fa  fa-shopping-cart icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Insert the number of products to display per page.', 'daydream' ),
			'id'		 => 'dd_woo_items',
			'type'		 => 'text',
			'title'		 => __( 'Number of Products Per Page', 'daydream' ),
			'default'	 => '12',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable the ordering boxes displayed on the shop page.', 'daydream' ),
			'id'		 => 'dd_woocommerce_daydream_ordering',
			'type'		 => 'switch',
			'title'		 => __( 'Disable Woocommerce Shop Page Ordering Boxes', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> products per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'daydream' ),
			'id'		 => 'dd_woocommerce_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => DAYDREAM_IMAGEPATH . 'two-posts.png',
				'3'	 => DAYDREAM_IMAGEPATH . 'three-posts.png',
				'4'	 => DAYDREAM_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Product Grid layout', 'daydream' ),
			'default'	 => '2',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will be added to the shop page.', 'daydream' ),
			'id'		 => 'dd_shop_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Shop Sidebar', 'daydream' ),
			'default'	 => 'None',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-typography-main-tab',
	'title'	 => __( 'Typography', 'daydream' ),
	'icon'	 => 'fa fa-font icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-custom',
	'title'		 => __( 'Custom Fonts', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'raw'	 => __( '<h3 style=\'margin: 0;\'>Custom fonts for all elements.</h3><p style="margin-bottom:0;">This will override the Google / standard font options. All 4 files are required.</h3>', 'daydream' ),
			'id'	 => 'dd_custom_fonts',
			'type'	 => 'info',
		),
		array(
			'subtitle'	 => __( 'Upload the .woff font file.', 'daydream' ),
			'id'		 => 'dd_custom_font_woff',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .woff', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .ttf font file.', 'daydream' ),
			'id'		 => 'dd_custom_font_ttf',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .ttf', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .svg font file.', 'daydream' ),
			'id'		 => 'dd_custom_font_svg',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .svg', 'daydream' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .eot font file.', 'daydream' ),
			'id'		 => 'dd_custom_font_eot',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .eot', 'daydream' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog title. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_title_font',
			'type'		 => 'typography',
			'title'		 => __( 'Blog Title Font', 'daydream' ),
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
			'subtitle'	 => __( 'Select the typography you want for your blog tagline. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_tagline_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Blog Tagline Font', 'daydream' ),
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
    'title'      => __( 'ThemeVedanta Slider', 'daydream' ),
    'subsection' => true,
    'fields'     => array(
        array(
            'subtitle'    => __( 'Select the typography you want for your slider heading. * non web-safe font.', 'daydream' ),
            'id'          => 'dd_slider_heading_font',
            'type'        => 'typography',
            'title'       => __( 'Slider Heading Font', 'daydream' ),
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
            'subtitle'    => __( 'Select the typography you want for your slider caption. * non web-safe font.', 'daydream' ),
            'id'          => 'dd_slider_caption_font',
            'type'        => 'typography',
            'text-align'  => false,
            'line-height' => false,
            'title'       => __( 'Slider Caption Font', 'daydream' ),
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
	'title'		 => __( 'Menu', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your main menu. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Main Menu Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '11px',
				'color'		 => '#999',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your top menu. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_top_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Top Menu Font', 'daydream' ),
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
	'title'		 => __( 'Post Title & Content', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your post titles. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_post_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Post Title Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '23px',
				'color'		 => '#222222',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Content Font', 'daydream' ),
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
	'title'		 => __( 'Widget', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Title Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'color'		 => '#222222',
				'font-family'	 => 'Montserrat',
				'font-weight'	 => '700',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Content Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_footer_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Title Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'color'		 => '#ffffff',
				'font-family'	 => 'Montserrat',
				'font-weight'	 => '700',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_footer_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Content Font', 'daydream' ),
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
	'title'		 => __( 'Headings', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your H1 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h1_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H1 Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '32px',
				'color'		 => '#222222',
				'font-family'	 => 'Open Sans',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H2 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h2_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H2 Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '26px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H3 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h3_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H3 Font', 'daydream' ),
			'default'	 => array(
				'font-size'	 => '18px',
				'font-family'	 => 'Open Sans',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H4 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h4_font',
			'type'		 => 'typography',
			'title'		 => __( 'H4 Font', 'daydream' ),
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
			'subtitle'	 => __( 'Select the typography you want for your H5 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h5_font',
			'type'		 => 'typography',
			'title'		 => __( 'H5 Font', 'daydream' ),
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
			'subtitle'	 => __( 'Select the typography you want for your H6 tag in blog content. * non web-safe font.', 'daydream' ),
			'id'		 => 'dd_content_h6_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H6 Font', 'daydream' ),
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
	'title'	 => __( 'Styling', 'daydream' ),
	'icon'	 => 'fa fa-paint-brush icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-main-scheme-tab',
	'title'		 => __( 'Main Color Scheme', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'		 => 'dd_color_palettes',
			'type'		 => 'palette',
			'title'		 => __( 'Main Color Scheme', 'daydream' ),
			'subtitle'	 => __( 'Please select the predefined color scheme of your website', 'daydream' ),
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
			'subtitle'	 => __( 'Primary color of site', 'daydream' ),
			'id'		 => 'dd_primary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Primary Color', 'daydream' ),
			'default'	 => '#27CBC0',
		),
		array(
			'subtitle'	 => __( 'Secondry color of site', 'daydream' ),
			'id'		 => 'dd_secondry_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Secondry Color', 'daydream' ),
			'default'	 => '#1fa098',
		),		
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-menu-tab',
	'title'		 => __( 'Menu', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Set the font size for mega menu column titles. In pixels, ex: 15px', 'daydream' ),
			'id'		 => 'dd_megamenu_title_size',
			'type'		 => 'text',
			'title'		 => __( 'Mega Menu Column Title Size', 'daydream' ),
			'default'	 => '13px',
		),
		array(
			'subtitle'	 => __( 'Set padding between menu items.', 'daydream' ),
			'id'		 => 'dd_main_menu_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Padding Between Menu Items', 'daydream' ),
			'default'	 => array(
				'padding-top'	 => '33',
				'padding-right' => '15',
				'padding-bottom' => '33',
				'padding-left' => '15',
				'units'		 => 'px',
			),
		),
		array(
			'subtitle'	 => __( 'Main menu text transform', 'daydream' ),
			'id'		 => 'dd_menu_text_transform',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'none'		 => __( 'none', 'daydream' ),
				'lowercase'	 => __( 'lowercase', 'daydream' ),
				'capitalize'	 => __( 'Capitalize', 'daydream' ),
				'uppercase'	 => __( 'UPPERCASE', 'daydream' ),
			),
			'title'		 => __( 'Set the main menu text transform', 'daydream' ),
			'default'	 => 'uppercase',
		),
		array(
			'subtitle'	 => __( 'Main menu hover font color', 'daydream' ),
			'id'		 => 'dd_main_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Menu Hover Font Color', 'daydream' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Sub menu hover font color', 'daydream' ),
			'id'		 => 'dd_sub_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Submenu Hover Font Color', 'daydream' ),
			'default'	 => '#ffffff',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-element-colors',
	'title'		 => __( 'Element Colors', 'daydream' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Controls the background color of form fields.', 'daydream' ),
			'id'		 => 'dd_form_bg_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Background Color', 'daydream' ),
			'default'	 => '#fff',
		),
		array(
			'subtitle'	 => __( 'Controls the text color for forms.', 'daydream' ),
			'id'		 => 'dd_form_text_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Text Color', 'daydream' ),
			'default'	 => '#999999',
		),
		array(
			'subtitle'	 => __( 'Controls the border color of form fields.', 'daydream' ),
			'id'		 => 'dd_form_border_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Border Color', 'daydream' ),
			'default'	 => '#eee',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-sharing-main-tab',
	'title'	 => __( 'Social Sharing Box', 'daydream' ),
	'icon'	 => 'fa fa-group icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Select a custom social icon color.', 'daydream' ),
			'id'		 => 'dd_sharing_box_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Custom Icons Color', 'daydream' ),
			'default'	 => '#777777',
		),
		array(
			'subtitle'	 => __( 'Select a custom social icon box color.', 'daydream' ),
			'id'		 => 'dd_sharing_box_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Icons Custom Box Color', 'daydream' ),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'daydream' ),
			'id'		 => 'dd_sharing_box_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Sharing Box Icons Boxed Radius', 'daydream' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons in the sharing box.', 'daydream' ),
			'id'		 => 'dd_sharing_box_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'daydream' ),
				'right'	 => __( 'Right', 'daydream' ),
				'bottom' => __( 'Bottom', 'daydream' ),
				'left'	 => __( 'Left', 'daydream' ),
				'none'	 => __( 'None', 'daydream' ),
			),
			'title'		 => __( 'Social Sharing Box Icons Tooltip Position', 'daydream' ),
			'default'	 => 'top',
		),
		array(
			'subtitle'	 => __( 'Show the facebook sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_facebook',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Facebook', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the twitter sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_twitter',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Twitter', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the linkedin sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_linkedin',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'LinkedIn', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the g+ sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_google',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Google Plus', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the pinterest sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_pinterest',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Pinterest', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the email sharing icon in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_email',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Email', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Show the more options button in blog posts.', 'daydream' ),
			'id'		 => 'dd_sharing_more_options',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'More Options Button', 'daydream' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-links-main-tab',
	'title'	 => __( 'Social Media Links', 'daydream' ),
	'icon'	 => 'fa fa-share-square-o icon-larg',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icons', 'daydream' ),
			'id'		 => 'dd_social_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icons Color', 'daydream' ),
			'default'	 => '#777777',
		),
		array(
			'subtitle'	 => __( 'Choose yes option if you want to display icon in boxed', 'daydream' ),
			'id'		 => 'dd_social_boxed',
			'type'		 => 'select',
			'options'	 => array(
				'no'	 => __( 'No', 'daydream' ),
				'yes'	 => __( 'Yes', 'daydream' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'daydream' ),
			'default'	 => 'no',
		),
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icon boxed', 'daydream' ),
			'id'		 => 'dd_social_boxed_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icon Boxed Background Color', 'daydream' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'daydream' ),
			'id'		 => 'dd_social_boxed_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Icon Boxed Radius', 'daydream' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => __( 'Choose _blank option if you want to open link in new window tab.', 'daydream' ),
			'id'		 => 'dd_social_target',
			'type'		 => 'select',
			'options'	 => array(
				'_blank' => __( '_blank', 'daydream' ),
				'_self'	 => __( '_self', 'daydream' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'daydream' ),
			'default'	 => '_blank',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons', 'daydream' ),
			'id'		 => 'dd_social_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'daydream' ),
				'right'	 => __( 'Right', 'daydream' ),
				'bottom' => __( 'Bottom', 'daydream' ),
				'left'	 => __( 'Left', 'daydream' ),
				'none'	 => __( 'None', 'daydream' ),
			),
			'title'		 => __( 'Social Sharing Box Icons Tooltip Position', 'daydream' ),
			'default'	 => 'top',
		),
		array(
			'id'		 => 'dd_social_link_facebook',
			'type'		 => 'text',
			'title'		 => __( 'Facebook', 'daydream' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Facebook URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_twitter',
			'type'		 => 'text',
			'title'		 => __( 'Twitter', 'daydream' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Twitter URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_google-plus',
			'type'		 => 'text',
			'title'		 => __( 'Google Plus', 'daydream' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your google-plus URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_dribbble',
			'type'		 => 'text',
			'title'		 => __( 'Dribbble', 'daydream' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your dribbble URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_linkedin',
			'type'		 => 'text',
			'title'		 => __( 'LinkedIn', 'daydream' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your linkedin URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_tumblr',
			'type'		 => 'text',
			'title'		 => __( 'Tumblr', 'daydream' ),
			'subtitle'	 => __( 'Insert your tumblr URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_reddit',
			'type'		 => 'text',
			'title'		 => __( 'Reddit', 'daydream' ),
			'subtitle'	 => __( 'Insert your reddit URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_yahoo',
			'type'		 => 'text',
			'title'		 => __( 'Yahoo', 'daydream' ),
			'subtitle'	 => __( 'Insert your yahoo URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_deviantart',
			'type'		 => 'text',
			'title'		 => __( 'Deviantart', 'daydream' ),
			'subtitle'	 => __( 'Insert your deviantart URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_vimeo',
			'type'		 => 'text',
			'title'		 => __( 'Vimeo', 'daydream' ),
			'subtitle'	 => __( 'Insert your vimeo URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_youtube',
			'type'		 => 'text',
			'title'		 => __( 'Youtube', 'daydream' ),
			'subtitle'	 => __( 'Insert your youtube URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_pinterest',
			'type'		 => 'text',
			'title'		 => __( 'Pinterest', 'daydream' ),
			'subtitle'	 => __( 'Insert your pinterest URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_digg',
			'type'		 => 'text',
			'title'		 => __( 'Digg', 'daydream' ),
			'subtitle'	 => __( 'Insert your digg URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_flickr',
			'type'		 => 'text',
			'title'		 => __( 'Flickr', 'daydream' ),
			'subtitle'	 => __( 'Insert your flickr URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_skype',
			'type'		 => 'text',
			'title'		 => __( 'Skype', 'daydream' ),
			'subtitle'	 => __( 'Insert your skype URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_instagram',
			'type'		 => 'text',
			'title'		 => __( 'Instagram', 'daydream' ),
			'subtitle'	 => __( 'Insert your instagram URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_vk',
			'type'		 => 'text',
			'title'		 => __( 'VK', 'daydream' ),
			'subtitle'	 => __( 'Insert your vk URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_paypal',
			'type'		 => 'text',
			'title'		 => __( 'PayPal', 'daydream' ),
			'subtitle'	 => __( 'Insert your paypal URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_dropbox',
			'type'		 => 'text',
			'title'		 => __( 'Dropbox', 'daydream' ),
			'subtitle'	 => __( 'Insert your dropbox URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_soundcloud',
			'type'		 => 'text',
			'title'		 => __( 'Soundcloud', 'daydream' ),
			'subtitle'	 => __( 'Insert your soundcloud URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Foursquare', 'daydream' ),
			'subtitle'	 => __( 'Insert your foursquare URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Vine', 'daydream' ),
			'subtitle'	 => __( 'Insert your vine URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_wordpress',
			'type'		 => 'text',
			'title'		 => __( 'Wordpress', 'daydream' ),
			'subtitle'	 => __( 'Insert your wordpress URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_behance',
			'type'		 => 'text',
			'title'		 => __( 'Behance', 'daydream' ),
			'subtitle'	 => __( 'Insert your behance URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_stumbleupo',
			'type'		 => 'text',
			'title'		 => __( 'Stumbleupo', 'daydream' ),
			'subtitle'	 => __( 'Insert your stumbleupo URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_github',
			'type'		 => 'text',
			'title'		 => __( 'Github', 'daydream' ),
			'subtitle'	 => __( 'Insert your github URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_lastfm',
			'type'		 => 'text',
			'title'		 => __( 'Lastfm', 'daydream' ),
			'subtitle'	 => __( 'Insert your lastfm URL', 'daydream' ),
		),
		array(
			'id'		 => 'dd_social_link_rss',
			'type'		 => 'text',
			'title'		 => __( 'RSS Feed', 'daydream' ),
			'default'	 => $daydream_rss_url,
			'subtitle'	 => __( 'Insert custom RSS Feed URL, e.g. <strong>http://feeds.feedburner.com/Example</strong>', 'daydream' ),
		),
	)
) );




Redux::setSection( $dd_options, array(
	'id'	 => 'dd-extra-main-tab',
	'title'	 => __( 'Extra', 'daydream' ),
	'icon'	 => 'fa  fa-gears icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display the theme\'s mega menu.', 'daydream' ),
			'id'		 => 'dd_megamenu',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Mega Menu', 'daydream' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display Back to Top button.', 'daydream' ),
			'id'		 => 'dd_back_to_top',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'daydream' ),
			'off'		 => __( 'Disabled', 'daydream' ),
			'default'	 => 1,
			'title'		 => __( 'Back to Top button', 'daydream' ),
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to add rel="nofollow" attribute to social sharing box and social links.', 'daydream' ),
			'id'		 => 'dd_nofollow_social_links',
			'type'		 => 'switch',
			'on'		 => __( 'Yes', 'daydream' ),
			'off'		 => __( 'No', 'daydream' ),
			'title'		 => __( 'Add rel="nofollow" to social links', 'daydream' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-custom-css-main-tab',
	'icon'		 => 'fa fa-css3',
	'icon_class'	 => 'icon-large',
	'title'		 => __( 'Custom CSS', 'daydream' ),
	'desc'		 => "Enter your CSS code in the field below. Do not include any tags or HTML in the field. Custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed. Don't URL encode image or svg paths. Contents of this field will be auto encoded.",
	'fields'	 => array(
		array(
			'id'		 => 'dd_css_content',
			'type'		 => 'ace_editor',
			'mode'		 => 'css',
			'theme'		 => 'monokai',
			'full_width'	 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-import-export-main-tab',
	'title'	 => __( 'Import / Export', 'daydream' ),
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
 * Override Redux Content with Daydream Content
 */
function daydream_override_content() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_register_style( 'daydream-redux-custom-css', get_template_directory_uri() . '/themeoptions/options/css/style.css', false, 258 );
	wp_enqueue_style( 'daydream-redux-custom-css' );
	wp_dequeue_style( 'select2-css' );
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action( 'redux-enqueue-dd_options', 'daydream_override_content' );

/*
 * Hide Demo Mode Link
 */

function daydream_remove_demo() {

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

add_action( 'redux/loaded', 'daydream_remove_demo' );

/*
 * Override Colorplate Options
 */

function daydream_colorpalettes() {
	wp_enqueue_script( 'daydream-colorpalettes', get_template_directory_uri() . '/themeoptions/options/js/colorpalettes.js', array(), '', true );
}

add_action( "redux/page/{$dd_options}/enqueue", "daydream_colorpalettes" );

