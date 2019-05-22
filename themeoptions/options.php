<?php
// Define global options.
define( 'BIGBO_IMAGEFOLDER', get_template_directory_uri() . '/themeoptions/options/images/' );
define( 'BIGBO_IMAGEPATH', get_template_directory_uri() . '/themeoptions/options/images/functions/' );
define( 'BIGBO_DEFAULT', get_template_directory_uri() . '/assets/images/default/' );

// -> BEGIN Themeoption Setup

if ( ! class_exists( 'Redux' ) ) {
	return;
}

global $dd_options;

$dd_options		 = "dd_options"; // This is your option name where all the Redux data is stored.
$bigbo_theme		 = wp_get_theme(); // For use with some settings. Not necessary.
$bigbo_rss_url	 = get_bloginfo( 'rss_url' );
$bigbo_site_url	 = esc_url( "http://themevedanta.com/" );
$bigbo_fb_url	 = '#';

$args = array(
	'opt_name'		 => $dd_options,
	'display_name'		 => $bigbo_theme->get( 'Name' ),
	'display_name'		 => '<img width="128" height="34" src="' . esc_url(get_template_directory_uri() . '/admin/assets/images/light-logo.png').'" alt="'. esc_attr(get_bloginfo( 'name' )) .'">',
	'page_type'		 => 'submenu',
	'allow_sub_menu'	 => false,
	'menu_title'		 => __( 'Theme Options', 'bigbo' ),
	'page_title'		 => __( 'Theme Options', 'bigbo' ),
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
	'footer_credit'		 => __( 'Thank you for using the Bigbo Theme', 'bigbo' ),
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
	'title'	 => __( 'General', 'bigbo' ),
	'icon'	 => 'fa fa-dashboard',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-fav-tab',
	'title'		 => __( 'Favicon', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload custom favicon.', 'bigbo' ),
			'id'		 => 'dd_favicon',
			'type'		 => 'media',
			'title'		 => __( 'Custom Favicon', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone (57px x 57px).', 'bigbo' ),
			'id'		 => 'dd_iphone_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPhone Retina Version (114px x 114px).', 'bigbo' ),
			'id'		 => 'dd_iphone_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPhone Retina Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad (72px x 72px).', 'bigbo' ),
			'id'		 => 'dd_ipad_icon',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Favicon for Apple iPad Retina Version (144px x 144px).', 'bigbo' ),
			'id'		 => 'dd_ipad_icon_retina',
			'type'		 => 'media',
			'title'		 => __( 'Apple iPad Retina Icon Upload', 'bigbo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-loader-tab',
	'title'		 => __( 'Site Loader', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display loader in site', 'bigbo' ),
			'id'		 => 'dd_siteloader',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Enable Site Loader', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Upload custom loader.', 'bigbo' ),
			'id'		 => 'dd_loaderfile',
			'type'		 => 'media',
			'title'		 => __( 'Custom Loader', 'bigbo' ),
			'url'		 => true,
			'required'	 => array( array( "dd_siteloader", '=', 1 ) ),
			'default'	 => array(
				'url' => BIGBO_DEFAULT . 'loader.gif'
			),
		),
	),
)
);


Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-lay-tab',
	'title'		 => __( 'Layout', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
                array(
			'id'		 => 'dd_demo_style',
			'type'		 => 'select',
			'compiler'	 => false,
			'options'	 => array(
				'dddemo1'	 => __( 'Demo1', 'bigbo' ),
				'dddemo2'	 => __( 'Demo2', 'bigbo' ),
				'dddemo3'	 => __( 'Demo3', 'bigbo' ),
			),
			'title'		 => __( 'Demo Style', 'bigbo' ),
			'default'	 => 'dddemo1',
			'class'	 => 'demo_style_opt',
		),
		array(
			'subtitle'	 => __( 'Select main content and sidebar alignment.', 'bigbo' ),
			'id'		 => 'dd_layout',
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
			'title'		 => __( 'Select layout', 'bigbo' ),
			'default'	 => '2cr',
		),
		array(
			'subtitle'	 => __( '<strong>Boxed version</strong> automatically enables custom background', 'bigbo' ),
			'id'		 => 'dd_width_layout',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'fixed'	 => __( 'Boxed', 'bigbo' ),
				'fluid'	 => __( 'Wide', 'bigbo' ),
			),
			'title'		 => __( 'Layout Style', 'bigbo' ),
			'default'	 => 'fluid',
		),
		array(
			'subtitle'	 => __( 'Select the width for your website', 'bigbo' ),
			'id'		 => 'dd_width_px',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				800	 => '800px',
				985	 => '985px',
				1200	 => '1200px',
				1600	 => '1600px',
				'custom' => __( 'Custom', 'bigbo' ),
			),
			'title'		 => __( 'Layout Width', 'bigbo' ),
			'default'	 => 'custom',
		),
		array(
			'title'		 => __( 'Custom Layout Width', 'bigbo' ),
			'subtitle'	 => __( 'Add the custom width in px (ex: 1024)', 'bigbo' ),
			'id'		 => "dd_custom_width_px",
			'type'		 => "text",
			'required'	 => array( array( "dd_width_px", '=', 'custom' ) ),
			'default'	 => '1340',
		),
		array(
			'subtitle'	 => __( 'Select the left and right padding for the Fullwidth-Fluid main content area. Enter value in px. ex: 20px', 'bigbo' ),
			'id'		 => 'dd_hundredp_padding',
			'type'		 => 'text',
			'title'		 => __( 'Fullwidth - Fluid Template Left/Right Padding', 'bigbo' ),
			'default'	 => '40px',
		),
		array(
			'subtitle'	 => __( 'Enter the page content top & bottom padding.', 'bigbo' ),
			'id'		 => 'dd_content_top_bottom_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Content Top & Bottom Padding', 'bigbo' ),
			'left'		 => false,
			'right'		 => false,
			'default'	 => array(
				'padding-top'	 => '30',
				'padding-bottom' => '40',
				'units'		 => 'px',
			),
		),
		array(
			'id'		 => 'dd_info_consid1',
			'type'		 => 'info',
			'subtitle'	 => __( '<h3>Content and One Sidebar Width</h3>', 'bigbo' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s2cl.png" /> <img style="float:left, display:inline" src="%2$s2cr.png" />', 'bigbo' ), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH) ),
			'id'		 => 'dd_info_consid1_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'bigbo' ),
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
			'title'		 => __( 'Content Width', 'bigbo' ),
			'default'	 => '9',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'bigbo' ),
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
			'title'		 => __( 'Sidebar 1 Width', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'id'		 => 'dd_info_consid2',
			'type'		 => 'info',
			'subtitle'	 => __( '<h3>Content and Two Sidebars Width</h3>', 'bigbo' ),
		),
		array(
			'subtitle'	 => sprintf( __( '<span class="subtitleription">These options apply for the following layouts</span> <img style="float:left, display:inline" src="%1$s3cm.png" /> <img style="float:left, display:inline" src="%2$s3cr.png" /> <img style="float:left, display:inline" src="%3$s3cl.png" />', 'bigbo' ), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH), esc_url(BIGBO_IMAGEPATH) ),
			'id'		 => 'dd_info_consid2_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => __( 'Select the width for your content', 'bigbo' ),
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
			'title'		 => __( 'Content Width', 'bigbo' ),
			'default'	 => '6',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 1', 'bigbo' ),
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
			'title'		 => __( 'Sidebar 1 Width', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => __( 'Select the width for your Sidebar 2', 'bigbo' ),
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
			'title'		 => __( 'Sidebar 2 Width', 'bigbo' ),
			'default'	 => '3',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-general-subsec-popup-tab',
	'title'		 => __( 'Newslatter Popup', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display newslatter popup in site', 'bigbo' ),
			'id'		 => 'dd_popup',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Enable Newslatter Popup', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Upload background image will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'dd_popup_bg',
			'type'		 => 'media',
			'title'		 => __( 'Newslatter Popup Background', 'bigbo' ),
			'url'		 => true,
			'default'	 => array(
				'url' => BIGBO_DEFAULT . 'newslater-bg.jpg'
			),
		),
            array(
			'subtitle'	 => __( 'Add heading will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'dd_popup_heading',
			'type'		 => 'text',
			'title'		 => __( 'Newslatter Popup Heading', 'bigbo' ),
			'default'	 => 'Newsletter',
		),
            array(
			'subtitle'	 => __( 'Add content will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'dd_popup_content',
			'type'		 => 'text',
			'title'		 => __( 'Newslatter Popup Content', 'bigbo' ),
			'default'	 => 'Sign up here to get 20% off on your next purchase, special offers and other discount information.',
		),
            array(
			'subtitle'	 => __( 'Add form shortcode will display in the newslatter popup.', 'bigbo' ),
			'id'		 => 'dd_popup_form',
			'type'		 => 'text',
			'title'		 => __( 'Newslatter Popup Form Shortcode', 'bigbo' ),
		),
            
	),
)
);

// Header Main Sections
Redux::setSection( $dd_options, array(
	'id'	 => 'dd-header-main-tab',
	'title'	 => __( 'Header', 'bigbo' ),
	'icon'	 => 'fa fa-window-maximize icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-header-tab',
	'title'		 => __( 'Header', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose your Header Type', 'bigbo' ),
			'id'		 => 'dd_header_type',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'h1'	 => BIGBO_IMAGEFOLDER . '/header/header-1.png',
				'h2'	 => BIGBO_IMAGEFOLDER . '/header/header-2.png',
				'h3'	 => BIGBO_IMAGEFOLDER . '/header/header-3.png',
			),
			'title'		 => __( 'Choose Header Type', 'bigbo' ),
			'default'	 => 'h1',
		),
		array(
			'subtitle'	 => __( 'Control the background color of topbar header.', 'bigbo' ),
			'id'		 => 'dd_topbar_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => __( 'Top Bar Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
        array(
			'subtitle'	 => __( 'Control the background color of header.', 'bigbo' ),
			'id'		 => 'dd_bg_header',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => __( 'Header Background Color', 'bigbo' ),
			'default'	 => '#000000',
			'required'	 => array( array( "dd_header_type", '=', 'h2' ) ),
		),
		array(
			'subtitle'	 => __( 'Control the Text color of header.', 'bigbo' ),
			'id'		 => 'dd_text_header',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => __( 'Header Text Color', 'bigbo' ),
			'default'	 => '#ffffff',
			'required'	 => array( array( "dd_header_type", '=', 'h2' ) ),
		),
        array(
            'id'       => 'menu_extras',
            'type'     => 'checkbox',
            'title'    => __('Menu Extras', 'bigbo'), 
            'options'  => array(
                'search' => 'Search',
                'cart' => 'Cart',
                'department' => 'Category Menu',
                'headerbar' => 'Header Bar',
            ),
            'default' => array(
                'search' => '1',
                'cart' => '1',
                'department' => '1',
                'headerbar' => '0',
            ),
        ),
        array(
			'id'		 => 'dd_vmenu_title',
			'type'		 => 'text',
			'title'		 => __( 'Vertical Menu Title', 'bigbo' ),
			'default'	 => 'Shop By Category',
		),
		),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-topbar-tab',
	'title'		 => __( 'Top Bar', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select which content displays in the top left area of the header.', 'bigbo' ),
			'id'		 => 'dd_header_left_content',
			'type'		 => 'select',
			'options'	 => array(
				'contact_info'	 => __( 'Contact Info', 'bigbo' ),
				'social_links'	 => __( 'Social Links', 'bigbo' ),
				'navigation'	 => __( 'Navigation', 'bigbo' ),
				'content_text'	 => __( 'Content Text', 'bigbo' ),
				'empty'		 => __( 'Leave Empty', 'bigbo' ),
			),
			'title'		 => __( 'Header Top Left Content', 'bigbo' ),
			'default'	 => 'contact_info',
		),
		array(
			'subtitle'	 => __( 'Phone number will display in the Contact Info section of your top header.', 'bigbo' ),
			'id'		 => 'dd_header_number',
			'type'		 => 'text',
			'title'		 => __( 'Header Phone Number', 'bigbo' ),
			'default'	 => '+01 7890 123 456',
		),
		array(
			'subtitle'	 => __( 'Email address will display in the Contact Info section of your top header.', 'bigbo' ),
			'id'		 => 'dd_header_email',
			'type'		 => 'text',
			'title'		 => __( 'Header Email Address', 'bigbo' ),
			'default'	 => 'contact@example.com',
		),
                array(
			'subtitle'	 => __( 'Text will display in the Content Text section of your top header.', 'bigbo' ),
			'id'		 => 'dd_content_text',
			'type'		 => 'text',
			'title'		 => __( 'Content Text', 'bigbo' ),
			'default'	 => 'Welcome to website',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-logo-tab',
	'title'		 => __( 'Logo', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload a logo for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_header_logo',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Select an image file for the retina version of the custom logo. It should be exactly 2x the size of main logo.', 'bigbo' ),
			'id'		 => 'dd_header_logo_retina',
			'type'		 => 'media',
			'title'		 => __( 'Custom Logo (Retina Version @2x)', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. In px.', 'bigbo' ),
			'id'		 => 'dd_header_logo_retina_width',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Width for Retina Logo', 'bigbo' ),
		),
		array(
			'subtitle'	 => __( 'If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. In px.', 'bigbo' ),
			'id'		 => 'dd_header_logo_retina_height',
			'type'		 => 'text',
			'title'		 => __( 'Standard Logo Height for Retina Logo', 'bigbo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-search-content-tab',
	'title'		 => __( 'Header Search Content', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'		 => 'search_content_type',
			'type'		 => 'select',
			'options'	 => array(
				'all'	 => __( 'Search for everything', 'bigbo' ),
				'product'	 => __( 'Search for products', 'bigbo' ),
			),
			'title'		 => __( 'Search Content Type', 'bigbo' ),
			'default'	 => 'product',
		),
            array(
			'id'		 => 'custom_categories_text',
			'type'		 => 'text',
			'title'		 => __( 'Categories Text', 'bigbo' ),
                        'default'	 => 'All Categories',
		),
            array(
			'id'		 => 'custom_categories_depth',
			'type'		 => 'text',
			'title'		 => __( 'Categories Depth', 'bigbo' ),
		),
            array(
			'subtitle'	 => __( 'Enter Category IDs to include. Divide every category by comma(,)', 'bigbo' ),
			'id'		 => 'custom_categories_include',
			'type'		 => 'text',
			'title'		 => __( 'Categories Include', 'bigbo' ),
		),
            array(
			'subtitle'	 => __( 'Enter Category IDs to exclude. Divide every category by comma(,)', 'bigbo' ),
			'id'		 => 'custom_categories_exclude',
			'type'		 => 'text',
			'title'		 => __( 'Categories Exclude', 'bigbo' ),
		),
            array(
			'id'		 => 'custom_search_text',
			'type'		 => 'text',
			'title'		 => __( 'Search Text', 'bigbo' ),
                        'default'	 => 'Search entire store...',
		),
            array(
			'id'		 => 'custom_search_button',
			'type'		 => 'text',
			'title'		 => __( 'Button Text', 'bigbo' ),
		),
            array(
			'id'		 => 'header_ajax_search',
			'type'		 => 'switch',
			'title'		 => __( 'AJAX Search', 'bigbo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-header-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display title of your blog', 'bigbo' ),
			'id'		 => 'dd_blog_title',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Title', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you don\'t want to display tagline of your blog', 'bigbo' ),
			'id'		 => 'dd_blog_tagline',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Blog Tagline', 'bigbo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-footer-main-tab',
	'title'	 => __( 'Footer', 'bigbo' ),
	'icon'	 => 'fa fa-columns icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-footer-widgets-tab',
	'title'		 => __( 'Footer Widgets', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select how many footer widget areas you want to display.', 'bigbo' ),
			'id'		 => 'dd_footer_widget_col',
			'type'		 => 'image_select',
			'options'	 => array(
				'disable'	 => BIGBO_IMAGEPATH . '1c.png',
				'one'		 => BIGBO_IMAGEPATH . 'footer-widgets-1.png',
				'two'		 => BIGBO_IMAGEPATH . 'footer-widgets-2.png',
				'three'		 => BIGBO_IMAGEPATH . 'footer-widgets-3.png',
				'four'		 => BIGBO_IMAGEPATH . 'footer-widgets-4.png',
			),
			'title'		 => __( 'Number of Widget Cols in Footer', 'bigbo' ),
			'default'	 => 'disable',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-footer-subsec-custom-footer-tab',
	'title'		 => __( 'Custom Footer', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Available <strong>HTML</strong> tags and attributes:<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code>', 'bigbo' ),
			'id'		 => 'dd_footer_content',
			'type'		 => 'textarea',
			'title'		 => __( 'Custom Footer', 'bigbo' ),
			'default'	 => '<p id="copyright"><span class="credits"><a href="' . esc_url($bigbo_site_url . 'bigbo-multipurpose-wordpress-theme/').'">Bigbo</a> theme by ThemeVedanta</span></p>',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-header-footer-tab',
	'title'		 => __( 'Footer Styles', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Custom background color of footer', 'bigbo' ),
			'id'		 => 'dd_footer_bg_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Footer Background color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Upload a footer background image for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_background_image',
			'type'		 => 'media',
			'title'		 => __( 'Footer Background Image', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Select if the footer background image should be displayed in cover or contain size.', 'bigbo' ),
			'id'		 => 'dd_footer_image',
			'type'		 => 'select',
			'options'	 => array(
				'cover'		 => __( 'Cover', 'bigbo' ),
				'contain'	 => __( 'Contain', 'bigbo' ),
				'none'		 => __( 'None', 'bigbo' ),
			),
			'title'		 => __( 'Background Responsiveness Style', 'bigbo' ),
			'default'	 => 'cover',
		),
		array(
			'id'		 => 'dd_footer_image_background_repeat',
			'type'		 => 'select',
			'options'	 => array(
				'no-repeat'	 => __( 'no-repeat', 'bigbo' ),
				'repeat'	 => __( 'repeat', 'bigbo' ),
				'repeat-x'	 => __( 'repeat-x', 'bigbo' ),
				'repeat-y'	 => __( 'repeat-y', 'bigbo' ),
			),
			'title'		 => __( 'Background Repeat', 'bigbo' ),
			'default'	 => 'no-repeat',
		),
		array(
			'id'		 => 'dd_footer_image_background_position',
			'type'		 => 'select',
			'options'	 => array(
				'center top'	 => __( 'center top', 'bigbo' ),
				'center center'	 => __( 'center center', 'bigbo' ),
				'center bottom'	 => __( 'center bottom', 'bigbo' ),
				'left top'	 => __( 'left top', 'bigbo' ),
				'left center'	 => __( 'left center', 'bigbo' ),
				'left bottom'	 => __( 'left bottom', 'bigbo' ),
				'right top'	 => __( 'right top', 'bigbo' ),
				'right center'	 => __( 'right center', 'bigbo' ),
				'right bottom'	 => __( 'right bottom', 'bigbo' ),
			),
			'title'		 => __( 'Background Position', 'bigbo' ),
			'default'	 => 'center top',
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'bigbo' ),
			'id'		 => 'dd_footer_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'bigbo' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => __( '<h3 style=\'margin: 0;\'>Footer Default Pattern</h3>', 'bigbo' ),
			'id'		 => 'dd_header_footer',
			'type'		 => 'info',
		),
		array(
			'subtitle'	 => __( 'Choose the pattern for footer background', 'bigbo' ),
			'id'		 => 'dd_pattern',
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
			'title'		 => __( 'Footer pattern', 'bigbo' ),
			'default'	 => 'none',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-payment-footer-tab',
	'title'		 => __( 'Footer Payment Icon', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon1',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon One', 'bigbo' ),
			'url'		 => true,
                        'default'	 => array(
				'url' => BIGBO_DEFAULT . 'visa.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link1',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon One Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon2',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon Two', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'mastercard.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link2',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon Two Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon3',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon Three', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'paypal.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link3',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon Three Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon4',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon Four', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'american_express.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link4',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon Four Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon5',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon Five', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'discover.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link5',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon Five Link', 'bigbo' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => __( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'bigbo' ),
			'id'		 => 'dd_footer_payment_icon6',
			'type'		 => 'media',
			'title'		 => __( 'Footer Payment Icon Six', 'bigbo' ),
			'url'		 => true,
                'default'	 => array(
				'url' => BIGBO_DEFAULT . 'diners.png'
			),
		),
                array(
			'subtitle'	 => __( 'Add a footer payment link for your theme', 'bigbo' ),
			'id'		 => 'dd_footer_payment_link6',
			'type'		 => 'text',
			'title'		 => __( 'Payment Icon Six Link', 'bigbo' ),
                    'default'	 => '#',
		),
		
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-pagetitlebar-tab',
	'title'	 => __( 'Page Title Bar', 'bigbo' ),
	'icon'	 => 'fa fa-pencil-square-o icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display page titlebar above the content and sidebar area', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_layout',
			'compiler'	 => true,
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Page Title Bar', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose the display option to show the page title', 'bigbo' ),
			'id'		 => 'dd_display_pagetitlebar',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'bigbo' ),
				'titlebar'		 => __( 'Only Title', 'bigbo' ),
				'breadcrumb'		 => __( 'Only Breadcrumb', 'bigbo' ),
			),
			'title'		 => __( 'Page Title & Breadcrumbs', 'bigbo' ),
			'default'	 => 'titlebar_breadcrumb',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => __( 'Choose your page titlebar layout', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_layout_opt',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'title'		 => __( 'Page Title Bar Layout Type', 'bigbo' ),
			'options'	 => array(
				'titlebar_left'		 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_left.png',
				'titlebar_center'	 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_center.png',
				'titlebar_right'	 => BIGBO_IMAGEFOLDER . '/titlebarlayout/titlebar_right.png',
			),
                        'default'	 => 'titlebar_left',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => __( 'Select the height for your pagetitle bar', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_height',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'small'	 => 'Small',
				'medium' => 'Medium',
				'large'	 => 'Large',
				'custom' => __( 'Custom', 'bigbo' ),
			),
			'title'		 => __( 'Page Title Bar Height', 'bigbo' ),
			'default'	 => 'small',
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'title'		 => __( 'Custom Page Title Bar Height', 'bigbo' ),
			'subtitle'	 => __( 'Add the custom height for page title bar. All height in px. Ex: 70', 'bigbo' ),
			'id'		 => "dd_pagetitlebar_custom",
			'type'		 => "text",
			'required'	 => array( array( "dd_pagetitlebar_height", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => __( 'Custom background color of page title bar', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_background_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Page Title Bar Background Color', 'bigbo' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => __( 'Select an image or insert an image url to use for the page title bar background.', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_background',
			'type'		 => 'media',
			'title'		 => __( 'Page Title Bar Background', 'bigbo' ),
			'required'	 => array(
				array( 'dd_pagetitlebar_layout', '=', '1' )
			),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Check to enable parallax background image when scrolling.', 'bigbo' ),
			'id'		 => 'dd_pagetitlebar_background_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => __( 'Parallax Background Image', 'bigbo' ),
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
	'title'	 => __( 'Blog', 'bigbo' ),
	'icon'	 => 'fa fa-newspaper-o icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-general-tab',
	'title'		 => __( 'General', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the blog style that will display on the blog pages.', 'bigbo' ),
			'id'		 => 'dd_blog_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'classic'		 => __( 'Classic', 'bigbo' ),
				'thumbnail_on_side'	 => __( 'Thumbnail On Side', 'bigbo' ),
				'grid'			 => __( 'Grid', 'bigbo' ),
			),
			'title'		 => __( 'Blog Style', 'bigbo' ),
			'default'	 => 'classic',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> posts per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'bigbo' ),
			'id'		 => 'dd_post_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Blog Grid layout', 'bigbo' ),
			'default'	 => '3',
			'required'	 => array(
				array( 'dd_blog_style', '=', 'grid' )
			),
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will display on the archive/category pages.', 'bigbo' ),
			'id'		 => 'dd_blog_archive_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Blog Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Sidebar 1',
		),
		array(
			'subtitle'	 => __( 'Choose placement of the \'Share This\' buttons', 'bigbo' ),
			'id'		 => 'dd_share_this',
			'type'		 => 'select',
			'options'	 => array(
				'single'	 => __( 'Single Posts', 'bigbo' ),
				'page'		 => __( 'Single Pages', 'bigbo' ),
				'all'		 => __( 'All', 'bigbo' ),
				'disable'	 => __( 'Disable', 'bigbo' ),
			),
			'title'		 => __( '\'Share This\' buttons placement', 'bigbo' ),
			'default'	 => 'single',
		),
		array(
			'subtitle'	 => __( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'bigbo' ),
			'id'		 => 'dd_pagination_type',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'pagination'		 => __( 'Default Pagination', 'bigbo' ),
				'number_pagination'	 => __( 'Number Pagination', 'bigbo' ),
			),
			'title'		 => __( 'Pagination Type', 'bigbo' ),
			'default'	 => 'number_pagination',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display edit post link', 'bigbo' ),
			'id'		 => 'dd_edit_post',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Edit Post Link', 'bigbo' ),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-post-tab',
	'title'		 => __( 'Posts', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta header', 'bigbo' ),
			'id'		 => 'dd_header_meta',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Header', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta date', 'bigbo' ),
			'id'		 => 'dd_meta_date',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Date', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta author', 'bigbo' ),
			'id'		 => 'dd_meta_author',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Author', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display post author avatar', 'bigbo' ),
			'id'		 => 'dd_author_avatar',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Enable Post Author Avatar', 'bigbo' ),
                        'default'	 => 0,
		),
                array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta categories', 'bigbo' ),
			'id'		 => 'dd_meta_cats',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Categories', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta tags', 'bigbo' ),
			'id'		 => 'dd_meta_tags',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Tags', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display post meta comments', 'bigbo' ),
			'id'		 => 'dd_meta_comments',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Post Meta Comments', 'bigbo' ),
                        'default'	 => 0,
		),
		array(
			'subtitle'	 => __( 'Choose the position of the <strong>Previous/Next Post</strong> links', 'bigbo' ),
			'id'		 => 'dd_post_links',
			'type'		 => 'select',
			'options'	 => array(
				'after'	 => __( 'After posts', 'bigbo' ),
				'before' => __( 'Before posts', 'bigbo' ),
				'both'	 => __( 'Both', 'bigbo' ),
			),
			'title'		 => __( 'Position of Previous/Next Posts Links', 'bigbo' ),
			'default'	 => 'after',
		),
		array(
			'subtitle'	 => __( 'Choose if you want to display <strong>Similar posts</strong> in articles', 'bigbo' ),
			'id'		 => 'dd_similar_posts',
			'type'		 => 'select',
			'options'	 => array(
				'disable'	 => __( 'Disable', 'bigbo' ),
				'category'	 => __( 'Match by categories', 'bigbo' ),
				'tag'		 => __( 'Match by tags', 'bigbo' ),
			),
			'title'		 => __( 'Display Similar Posts', 'bigbo' ),
			'default'	 => 'category',
		),
                array(
			'subtitle'	 => __( 'Choose enable button if you want to display <strong>Similar posts</strong> in slider', 'bigbo' ),
			'id'		 => 'dd_similar_posts_carousel',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Display Similar Posts Carousel', 'bigbo' ),
                        'default'	 => 1,
		),
                array(
			'subtitle'	 => __( 'Choose number of similar posts', 'bigbo' ),
			'id'		 => 'dd_similar_posts_number',
			'type'		 => 'select',
			'options'	 => array(
				'3'	 => __( 'Three', 'bigbo' ),
				'4'	 => __( 'Four', 'bigbo' ),
				'5'	 => __( 'Five', 'bigbo' ),
				'6'	 => __( 'Six', 'bigbo' ),
				'7'	 => __( 'Seven', 'bigbo' ),
				'8'	 => __( 'Eight', 'bigbo' ),
			),
			'title'		 => __( 'No of Similar Posts', 'bigbo' ),
			'default'	 => '4',
		),
            
	),
)
);
Redux::setSection( $dd_options, array(
	'id'		 => 'dd-blog-subsec-featured-tab',
	'title'		 => __( 'Featured Image', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on blog page', 'bigbo' ),
			'id'		 => 'dd_featured_images',
			'type'		 => 'switch',
			'title'		 => __( 'Enable Featured Images', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured image on Single Blog Posts', 'bigbo' ),
			'id'		 => 'dd_blog_featured_image',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Enable Featured Image on Single Blog Posts', 'bigbo' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-portfolio-main-tab',
	'title'	 => __( 'Portfolio', 'bigbo' ),
	'icon'	 => 'fa fa-th icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-general-tab',
	'title'		 => __( 'General', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Insert the number of posts to display per page.', 'bigbo' ),
			'id'		 => 'dd_portfolio_no_item_per_page',
			'type'		 => 'text',
			'title'		 => __( 'Number of Portfolio Items Per Page', 'bigbo' ),
			'default'	 => '10',
		),
		array(
			'subtitle'	 => __( 'Select the portfolio style that will display on the portfolio pages.', 'bigbo' ),
			'id'		 => 'dd_portfolio_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'grid'		 => __( 'Grid', 'bigbo' ),
				'grid_no_space'	 => __( 'Grid No Space', 'bigbo' ),
			),
			'title'		 => __( 'Portfolio Style', 'bigbo' ),
			'default'	 => 'grid',
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> portfolio per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'bigbo' ),
			'id'		 => 'dd_portfolio_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Portfolio Grid Layout', 'bigbo' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => __( 'Custom hover color of portfolio works', 'bigbo' ),
			'id'		 => 'dd_portfolio_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Portfolio Hover Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will be added to the archive/category portfolio pages.', 'bigbo' ),
			'id'		 => 'dd_portfolio_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Portfolio Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Sidebar 1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-portfolio-subsec-single-post-page-tab',
	'title'		 => __( 'Single Portfolio Page', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display featured images on single post pages.', 'bigbo' ),
			'id'		 => 'dd_portfolio_featured_image',
			'type'		 => 'switch',
			'title'		 => __( 'Featured Image on Single Portfolio', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to enable Author on portfolio items.', 'bigbo' ),
			'id'		 => 'dd_portfolio_author',
			'type'		 => 'switch',
			'title'		 => __( 'Show Author', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display the social sharing box.', 'bigbo' ),
			'id'		 => 'dd_portfolio_sharing',
			'type'		 => 'switch',
			'title'		 => __( 'Social Sharing Box', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to display related portfolio.', 'bigbo' ),
			'id'		 => 'dd_portfolio_related_posts',
			'type'		 => 'switch',
			'title'		 => __( 'Related Portfolio', 'bigbo' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable previous/next pagination.', 'bigbo' ),
			'id'		 => 'dd_portfolio_pagination',
			'type'		 => 'switch',
			'title'		 => __( 'Previous/Next Pagination', 'bigbo' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-woocommerce-main-tab',
	'title'	 => __( 'WooCommerce', 'bigbo' ),
	'icon'	 => 'fa  fa-shopping-cart icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Insert the number of products to display per page.', 'bigbo' ),
			'id'		 => 'dd_woo_items',
			'type'		 => 'text',
			'title'		 => __( 'Number of Products Per Page', 'bigbo' ),
			'default'	 => '12',
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to disable the ordering boxes displayed on the shop page.', 'bigbo' ),
			'id'		 => 'dd_woocommerce_bigbo_ordering',
			'type'		 => 'switch',
			'title'		 => __( 'Disable Woocommerce Shop Page Ordering Boxes', 'bigbo' ),
		),
		array(
			'subtitle'	 => __( 'Grid layout with <strong>3 and 4</strong> products per row is recommended to use with disabled <strong>Sidebar(s)</strong>', 'bigbo' ),
			'id'		 => 'dd_woocommerce_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => BIGBO_IMAGEPATH . 'two-posts.png',
				'3'	 => BIGBO_IMAGEPATH . 'three-posts.png',
				'4'	 => BIGBO_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => __( 'Product Grid layout', 'bigbo' ),
			'default'	 => '4',
		),
		array(
			'subtitle'	 => __( 'Select the sidebar that will display on the shop archive/category pages.', 'bigbo' ),
			'id'		 => 'dd_shop_archive_sidebar',
			'type'		 => 'select',
			'options'	 => $sidebar_options,
			'title'		 => __( 'Shop Archive/Category Sidebar', 'bigbo' ),
			'default'	 => 'Siderbar 1',
		),         
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-typography-main-tab',
	'title'	 => __( 'Typography', 'bigbo' ),
	'icon'	 => 'fa fa-font icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-custom',
	'title'		 => __( 'Custom Fonts', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'raw'	 => __( '<h3 style=\'margin: 0;\'>Custom fonts for all elements.</h3><p style="margin-bottom:0;">This will override the Google / standard font options. All 4 files are required.</h3>', 'bigbo' ),
			'id'	 => 'dd_custom_fonts',
			'type'	 => 'info',
		),
		array(
			'subtitle'	 => __( 'Upload the .woff font file.', 'bigbo' ),
			'id'		 => 'dd_custom_font_woff',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .woff', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .ttf font file.', 'bigbo' ),
			'id'		 => 'dd_custom_font_ttf',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .ttf', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .svg font file.', 'bigbo' ),
			'id'		 => 'dd_custom_font_svg',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .svg', 'bigbo' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => __( 'Upload the .eot font file.', 'bigbo' ),
			'id'		 => 'dd_custom_font_eot',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => __( 'Custom Font .eot', 'bigbo' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-title-tagline-tab',
	'title'		 => __( 'Title & Tagline', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_title_font',
			'type'		 => 'typography',
			'title'		 => __( 'Blog Title Font', 'bigbo' ),
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
			'subtitle'	 => __( 'Select the typography you want for your blog tagline. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_tagline_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Blog Tagline Font', 'bigbo' ),
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

Redux::setSection( $dd_options, array(
    'id'         => 'dd-typography-subsec-tvslider-tab',
    'title'      => __( 'ThemeVedanta Slider', 'bigbo' ),
    'subsection' => true,
    'fields'     => array(
        array(
            'subtitle'    => __( 'Select the typography you want for your slider heading. * non web-safe font.', 'bigbo' ),
            'id'          => 'dd_slider_heading_font',
            'type'        => 'typography',
            'title'       => __( 'Slider Heading Font', 'bigbo' ),
            'text-align'  => false,
            'line-height' => false,
            'default'     => array(
                'font-size'   => '58px',
                'color'       => '#ffffff',
                'font-family' => 'Poppins',
                'font-weight' => '400',
            ),
        ),
        array(
            'subtitle'    => __( 'Select the typography you want for your slider caption. * non web-safe font.', 'bigbo' ),
            'id'          => 'dd_slider_caption_font',
            'type'        => 'typography',
            'text-align'  => false,
            'line-height' => false,
            'title'       => __( 'Slider Caption Font', 'bigbo' ),
            'default'     => array(
                'font-size'   => '20px',
                'font-family' => 'Poppins',
                'color'       => '#ffffff',
                'font-weight' => '400',
            ),
        ),
    ),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-menu-tab',
	'title'		 => __( 'Menu', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your main menu. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Main Menu Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#999999',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '300',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your top menu. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_top_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Top Menu Font', 'bigbo' ),
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


Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-post-tab',
	'title'		 => __( 'Post Title & Content', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your post titles. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_post_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Post Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Content Font', 'bigbo' ),
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

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-widget-tab',
	'title'		 => __( 'Widget', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Widget Content Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget title. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_footer_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Title Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '18px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your widget content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_footer_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'Footer Widget Content Font', 'bigbo' ),
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

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-typography-subsec-headings-tab',
	'title'		 => __( 'Headings', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Select the typography you want for your H1 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h1_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H1 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '32px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H2 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h2_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H2 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '26px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H3 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h3_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H3 Font', 'bigbo' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => __( 'Select the typography you want for your H4 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h4_font',
			'type'		 => 'typography',
			'title'		 => __( 'H4 Font', 'bigbo' ),
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
			'subtitle'	 => __( 'Select the typography you want for your H5 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h5_font',
			'type'		 => 'typography',
			'title'		 => __( 'H5 Font', 'bigbo' ),
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
			'subtitle'	 => __( 'Select the typography you want for your H6 tag in blog content. * non web-safe font.', 'bigbo' ),
			'id'		 => 'dd_content_h6_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => __( 'H6 Font', 'bigbo' ),
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

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-styling-main-tab',
	'title'	 => __( 'Styling', 'bigbo' ),
	'icon'	 => 'fa fa-paint-brush icon-large',
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-main-scheme-tab',
	'title'		 => __( 'Main Color Scheme', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'		 => 'dd_color_palettes',
			'type'		 => 'palette',
			'title'		 => __( 'Main Color Scheme', 'bigbo' ),
			'subtitle'	 => __( 'Please select the predefined color scheme of your website', 'bigbo' ),
			'default'	 => 'color_palette_1',
			'palettes'	 => array(
				'color_palette_1'	 => array(
					'#3ab54a',
					'#3ab54a',
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
			'subtitle'	 => __( 'Primary color of site', 'bigbo' ),
			'id'		 => 'dd_primary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Primary Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => __( 'Secondry color of site', 'bigbo' ),
			'id'		 => 'dd_secondry_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Secondry Color', 'bigbo' ),
			'default'	 => '#0c3e3e',
		),		
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-styling-subsec-menu-tab',
	'title'		 => __( 'Menu', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Set the font size for mega menu column titles. In pixels, ex: 15px', 'bigbo' ),
			'id'		 => 'dd_megamenu_title_size',
			'type'		 => 'text',
			'title'		 => __( 'Mega Menu Column Title Size', 'bigbo' ),
			'default'	 => '15px',
		),
		array(
			'subtitle'	 => __( 'Set padding between menu items.', 'bigbo' ),
			'id'		 => 'dd_main_menu_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => __( 'Padding Between Menu Items', 'bigbo' ),
			'default'	 => array(
				'padding-top'	 => '0',
				'padding-right' => '15',
				'padding-bottom' => '0',
				'padding-left' => '15',
				'units'		 => 'px',
			),
		),
		array(
			'subtitle'	 => __( 'Main menu text transform', 'bigbo' ),
			'id'		 => 'dd_menu_text_transform',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'none'		 => __( 'none', 'bigbo' ),
				'lowercase'	 => __( 'lowercase', 'bigbo' ),
				'capitalize'	 => __( 'Capitalize', 'bigbo' ),
				'uppercase'	 => __( 'UPPERCASE', 'bigbo' ),
			),
			'title'		 => __( 'Set the main menu text transform', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => __( 'Main menu hover font color', 'bigbo' ),
			'id'		 => 'dd_main_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Menu Hover Font Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => __( 'Sub menu hover font color', 'bigbo' ),
			'id'		 => 'dd_sub_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Submenu Hover Font Color', 'bigbo' ),
			'default'	 => '#3ab54a',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'		 => 'dd-element-colors',
	'title'		 => __( 'Element Colors', 'bigbo' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => __( 'Controls the background color of form fields.', 'bigbo' ),
			'id'		 => 'dd_form_bg_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Background Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => __( 'Controls the text color for forms.', 'bigbo' ),
			'id'		 => 'dd_form_text_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Text Color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Controls the border color of form fields.', 'bigbo' ),
			'id'		 => 'dd_form_border_color',
			'type'		 => 'color',
			'title'		 => __( 'Form Border Color', 'bigbo' ),
			'default'	 => '#e2e2e2',
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-sharing-main-tab',
	'title'	 => __( 'Social Sharing Box', 'bigbo' ),
	'icon'	 => 'fa fa-group icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Select a custom social icon color.', 'bigbo' ),
			'id'		 => 'dd_sharing_box_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Custom Icons Color', 'bigbo' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => __( 'Select a custom social icon box color.', 'bigbo' ),
			'id'		 => 'dd_sharing_box_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Sharing Box Icons Custom Box Color', 'bigbo' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'bigbo' ),
			'id'		 => 'dd_sharing_box_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Sharing Box Icons Boxed Radius', 'bigbo' ),
			'default'	 => '50%',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons in the sharing box.', 'bigbo' ),
			'id'		 => 'dd_sharing_box_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'bigbo' ),
				'right'	 => __( 'Right', 'bigbo' ),
				'bottom' => __( 'Bottom', 'bigbo' ),
				'left'	 => __( 'Left', 'bigbo' ),
				'none'	 => __( 'None', 'bigbo' ),
			),
			'title'		 => __( 'Social Sharing Box Icons Tooltip Position', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => __( 'Show the facebook sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_facebook',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Facebook', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the twitter sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_twitter',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Twitter', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the linkedin sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_linkedin',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'LinkedIn', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the g+ sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_google',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Google Plus', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the pinterest sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_pinterest',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Pinterest', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the email sharing icon in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_email',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Email', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Show the more options button in blog posts.', 'bigbo' ),
			'id'		 => 'dd_sharing_more_options',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'More Options Button', 'bigbo' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-social-links-main-tab',
	'title'	 => __( 'Social Media Links', 'bigbo' ),
	'icon'	 => 'fa fa-share-square-o icon-larg',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icons', 'bigbo' ),
			'id'		 => 'dd_social_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icons Color', 'bigbo' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => __( 'Choose yes option if you want to display icon in boxed', 'bigbo' ),
			'id'		 => 'dd_social_boxed',
			'type'		 => 'select',
			'options'	 => array(
				'no'	 => __( 'No', 'bigbo' ),
				'yes'	 => __( 'Yes', 'bigbo' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'bigbo' ),
			'default'	 => 'no',
		),
		array(
			'subtitle'	 => __( 'Choose the color scheme of social icon boxed', 'bigbo' ),
			'id'		 => 'dd_social_boxed_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => __( 'Social Icon Boxed Background Color', 'bigbo' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => __( 'Box radius for the social icons. In pixels, ex: 4px.', 'bigbo' ),
			'id'		 => 'dd_social_boxed_radius',
			'type'		 => 'text',
			'title'		 => __( 'Social Icon Boxed Radius', 'bigbo' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => __( 'Choose _blank option if you want to open link in new window tab.', 'bigbo' ),
			'id'		 => 'dd_social_target',
			'type'		 => 'select',
			'options'	 => array(
				'_blank' => __( '_blank', 'bigbo' ),
				'_self'	 => __( '_self', 'bigbo' ),
			),
			'title'		 => __( 'Social Icons Boxed', 'bigbo' ),
			'default'	 => '_blank',
		),
		array(
			'subtitle'	 => __( 'Controls the tooltip position of the social icons', 'bigbo' ),
			'id'		 => 'dd_social_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => __( 'Top', 'bigbo' ),
				'right'	 => __( 'Right', 'bigbo' ),
				'bottom' => __( 'Bottom', 'bigbo' ),
				'left'	 => __( 'Left', 'bigbo' ),
				'none'	 => __( 'None', 'bigbo' ),
			),
			'title'		 => __( 'Social Box Icons Tooltip Position', 'bigbo' ),
			'default'	 => 'none',
		),
		array(
			'id'		 => 'dd_social_link_facebook',
			'type'		 => 'text',
			'title'		 => __( 'Facebook', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Facebook URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_twitter',
			'type'		 => 'text',
			'title'		 => __( 'Twitter', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your Twitter URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_google-plus',
			'type'		 => 'text',
			'title'		 => __( 'Google Plus', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your google-plus URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_dribbble',
			'type'		 => 'text',
			'title'		 => __( 'Dribbble', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your dribbble URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_linkedin',
			'type'		 => 'text',
			'title'		 => __( 'LinkedIn', 'bigbo' ),
			'default'	 => '#',
			'subtitle'	 => __( 'Insert your linkedin URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_tumblr',
			'type'		 => 'text',
			'title'		 => __( 'Tumblr', 'bigbo' ),
			'subtitle'	 => __( 'Insert your tumblr URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_reddit',
			'type'		 => 'text',
			'title'		 => __( 'Reddit', 'bigbo' ),
			'subtitle'	 => __( 'Insert your reddit URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_yahoo',
			'type'		 => 'text',
			'title'		 => __( 'Yahoo', 'bigbo' ),
			'subtitle'	 => __( 'Insert your yahoo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_deviantart',
			'type'		 => 'text',
			'title'		 => __( 'Deviantart', 'bigbo' ),
			'subtitle'	 => __( 'Insert your deviantart URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_vimeo',
			'type'		 => 'text',
			'title'		 => __( 'Vimeo', 'bigbo' ),
			'subtitle'	 => __( 'Insert your vimeo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_youtube',
			'type'		 => 'text',
			'title'		 => __( 'Youtube', 'bigbo' ),
			'subtitle'	 => __( 'Insert your youtube URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_pinterest',
			'type'		 => 'text',
			'title'		 => __( 'Pinterest', 'bigbo' ),
			'subtitle'	 => __( 'Insert your pinterest URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_digg',
			'type'		 => 'text',
			'title'		 => __( 'Digg', 'bigbo' ),
			'subtitle'	 => __( 'Insert your digg URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_flickr',
			'type'		 => 'text',
			'title'		 => __( 'Flickr', 'bigbo' ),
			'subtitle'	 => __( 'Insert your flickr URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_skype',
			'type'		 => 'text',
			'title'		 => __( 'Skype', 'bigbo' ),
			'subtitle'	 => __( 'Insert your skype URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_instagram',
			'type'		 => 'text',
			'title'		 => __( 'Instagram', 'bigbo' ),
			'subtitle'	 => __( 'Insert your instagram URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_vk',
			'type'		 => 'text',
			'title'		 => __( 'VK', 'bigbo' ),
			'subtitle'	 => __( 'Insert your vk URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_paypal',
			'type'		 => 'text',
			'title'		 => __( 'PayPal', 'bigbo' ),
			'subtitle'	 => __( 'Insert your paypal URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_dropbox',
			'type'		 => 'text',
			'title'		 => __( 'Dropbox', 'bigbo' ),
			'subtitle'	 => __( 'Insert your dropbox URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_soundcloud',
			'type'		 => 'text',
			'title'		 => __( 'Soundcloud', 'bigbo' ),
			'subtitle'	 => __( 'Insert your soundcloud URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Foursquare', 'bigbo' ),
			'subtitle'	 => __( 'Insert your foursquare URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => __( 'Vine', 'bigbo' ),
			'subtitle'	 => __( 'Insert your vine URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_wordpress',
			'type'		 => 'text',
			'title'		 => __( 'Wordpress', 'bigbo' ),
			'subtitle'	 => __( 'Insert your wordpress URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_behance',
			'type'		 => 'text',
			'title'		 => __( 'Behance', 'bigbo' ),
			'subtitle'	 => __( 'Insert your behance URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_stumbleupo',
			'type'		 => 'text',
			'title'		 => __( 'Stumbleupo', 'bigbo' ),
			'subtitle'	 => __( 'Insert your stumbleupo URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_github',
			'type'		 => 'text',
			'title'		 => __( 'Github', 'bigbo' ),
			'subtitle'	 => __( 'Insert your github URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_lastfm',
			'type'		 => 'text',
			'title'		 => __( 'Lastfm', 'bigbo' ),
			'subtitle'	 => __( 'Insert your lastfm URL', 'bigbo' ),
		),
		array(
			'id'		 => 'dd_social_link_rss',
			'type'		 => 'text',
			'title'		 => __( 'RSS Feed', 'bigbo' ),
			'default'	 => $bigbo_rss_url,
			'subtitle'	 => __( 'Insert custom RSS Feed URL, e.g. <strong>http://feeds.feedburner.com/Example</strong>', 'bigbo' ),
		),
	)
) );




Redux::setSection( $dd_options, array(
	'id'	 => 'dd-extra-main-tab',
	'title'	 => __( 'Extra', 'bigbo' ),
	'icon'	 => 'fa  fa-gears icon-large',
	'fields' => array(
		array(
			'subtitle'	 => __( 'Choose enable button if you want to display Back to Top button.', 'bigbo' ),
			'id'		 => 'dd_back_to_top',
			'type'		 => 'switch',
			'on'		 => __( 'Enabled', 'bigbo' ),
			'off'		 => __( 'Disabled', 'bigbo' ),
			'title'		 => __( 'Back to Top button', 'bigbo' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => __( 'Choose Enable button if you want to add rel="nofollow" attribute to social sharing box and social links.', 'bigbo' ),
			'id'		 => 'dd_nofollow_social_links',
			'type'		 => 'switch',
			'on'		 => __( 'Yes', 'bigbo' ),
			'off'		 => __( 'No', 'bigbo' ),
			'title'		 => __( 'Add rel="nofollow" to social links', 'bigbo' ),
		),
	),
)
);

Redux::setSection( $dd_options, array(
	'id'	 => 'dd-import-export-main-tab',
	'title'	 => __( 'Import / Export', 'bigbo' ),
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
 */
function bigbo_override_content() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_register_style( 'bigbo-redux-custom-css', get_template_directory_uri() . '/themeoptions/options/css/style.css', false, 258 );
	wp_enqueue_style( 'bigbo-redux-custom-css' );
	wp_dequeue_style( 'select2-css' );
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}

add_action( 'redux-enqueue-dd_options', 'bigbo_override_content' );

/*
 * Hide Demo Mode Link
 */

function bigbo_remove_demo() {

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

add_action( 'redux/loaded', 'bigbo_remove_demo' );

/*
 * Override Colorplate Options
 */

function bigbo_colorpalettes() {
	wp_enqueue_script( 'bigbo-colorpalettes', get_template_directory_uri() . '/themeoptions/options/js/colorpalettes.js', array(), '', true );
}

add_action( "redux/page/{$dd_options}/enqueue", "bigbo_colorpalettes" );

