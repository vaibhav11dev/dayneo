<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function dayneo_admin_menu() {
	add_menu_page( esc_html__( 'About dayneo', 'dayneo' ), esc_html__( 'dayneo', 'dayneo' ), 'manage_options', 'dayneo-menu', 'dayneo_welcome', get_template_directory_uri() . '/admin/assets/images/admin-icon.png', 2 );
}

add_action( 'admin_menu', 'dayneo_admin_menu' );

function dayneo_admin_submenu() {
	if ( in_array( 'vedanta-core/vedanta-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_submenu_page( 'dayneo-menu', esc_html__( 'Install Demos', 'dayneo' ), esc_html__( 'Install Demos', 'dayneo' ), 'manage_options', 'dayneo_demos', 'dayneo_demo' );
	}

	add_submenu_page( 'dayneo-menu', esc_html__( 'Theme Options', 'dayneo' ), esc_html__( 'Theme Options', 'dayneo' ), 'manage_options', 'dayneo_options', 'dayneo_option' );

	global $submenu;
	$submenu[ 'dayneo-menu' ][ 0 ][ 0 ] = esc_html__( 'About dayneo', 'dayneo' );
}

add_action( 'admin_menu', 'dayneo_admin_submenu' );

function dayneo_welcome() {
	get_template_part( 'admin/dayneo_menu/dayneo', 'welcome' );
}

function dayneo_demo() {
	get_template_part( 'admin/dayneo_menu/dayneo', 'install_demo' );
}

function dayneo_support() {
	get_template_part( 'admin/dayneo_menu/dayneo', 'support' );
}

function dayneo_option() {
	get_template_part( 'admin/dayneo_menu/dayneo', 'options' );
}
