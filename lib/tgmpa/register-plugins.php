<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage bigbo
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once( BIGBO_PHP_LIB . 'tgmpa/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'bigbo_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function bigbo_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'			 => 'Vedanta Core', // The plugin name.
			'slug'			 => 'vedanta-core', // The plugin slug (typically the folder name).
			'source'		 => BIGBO_PHP_LIB . 'plugins/vedanta-core.zip', // The plugin source.
			'required'		 => true, // If false, the plugin is only 'recommended' instead of required.
			'version'		 => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'	 => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation'	 => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'		 => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'		 => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'		 => esc_html__( 'Elementor Page Builder', 'bigbo' ),
			'slug'		 => 'elementor',
			'required'	 => false,
		),
		array(
			'name'		 => esc_html__( 'WooCommerce', 'bigbo' ),
			'slug'		 => 'woocommerce',
			'required'	 => false,
		),
		array(
			'name'		 => esc_html__( 'YITH WooCommerce Wishlist', 'bigbo' ),
			'slug'		 => 'yith-woocommerce-wishlist',
			'required'	 => false,
		),
                array(
			'name'		 => esc_html__( 'YITH WooCommerce Compare', 'bigbo' ),
			'slug'		 => 'yith-woocommerce-compare',
			'required'	 => false,
		),
                array(
			'name'		 => esc_html__( 'Mailchimp for WordPress', 'bigbo' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => false,
		),
		array(
			'name'		 => esc_html__( 'Contact Form 7', 'bigbo' ),
			'slug'		 => 'contact-form-7',
			'required'	 => false,
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'		 => 'bigbotheme', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'		 => 'bigbotheme-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => false, // Automatically activate plugins after installation or not.
		'message'	 => '', // Message to output right before the plugins table.
		'strings'	 => array(
			'page_title'				 => esc_html__( 'Install Required Plugins', 'bigbo' ),
			'menu_title'				 => esc_html__( 'Install Plugins', 'bigbo' ),
			'installing'				 => esc_html__( 'Installing Plugin: %s', 'bigbo' ), // %s = plugin name.
			'oops'					 => esc_html__( 'Something went wrong with the plugin API.', 'bigbo' ),
			'notice_can_install_required'		 => _n_noop(
			'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'	 => _n_noop(
			'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_cannot_install'			 => _n_noop(
			'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'			 => _n_noop(
			'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'		 => _n_noop(
			'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_cannot_update'			 => _n_noop(
			'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'		 => _n_noop(
			'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended'	 => _n_noop(
			'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'bigbo'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'		 => _n_noop(
			'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'bigbo'
			), // %1$s = plugin name(s).
			'install_link'				 => _n_noop(
			'Begin installing plugin', 'Begin installing plugins', 'bigbo'
			),
			'update_link'				 => _n_noop(
			'Begin updating plugin', 'Begin updating plugins', 'bigbo'
			),
			'activate_link'				 => _n_noop(
			'Begin activating plugin', 'Begin activating plugins', 'bigbo'
			),
			'return'				 => esc_html__( 'Return to Required Plugins Installer', 'bigbo' ),
			'plugin_activated'			 => esc_html__( 'Plugin activated successfully.', 'bigbo' ),
			'activated_successfully'		 => esc_html__( 'The following plugin was activated successfully:', 'bigbo' ),
			'plugin_already_active'			 => esc_html__( 'No action taken. Plugin %1$s was already active.', 'bigbo' ), // %1$s = plugin name(s).
			'plugin_needs_higher_version'		 => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'bigbo' ), // %1$s = plugin name(s).
			'complete'				 => esc_html__( 'All plugins installed and activated successfully. %1$s', 'bigbo' ), // %s = dashboard link.
			'contact_admin'				 => esc_html__( 'Please contact the administrator of this site for help.', 'bigbo' ),
			'nag_type'				 => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
	);

	tgmpa( $plugins, $config );
}
