<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function daydream_admin_menu() {
	add_menu_page( esc_html__( 'About daydream', 'daydream' ), esc_html__( 'daydream', 'daydream' ), 'manage_options', 'daydream-menu', 'daydream_welcome', get_template_directory_uri() . '/admin/assets/images/admin-icon.png', 2 );
}

add_action( 'admin_menu', 'daydream_admin_menu' );

function daydream_admin_submenu() {
	if ( in_array( 'vedanta-core/vedanta-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_submenu_page( 'daydream-menu', esc_html__( 'Install Demos', 'daydream' ), esc_html__( 'Install Demos', 'daydream' ), 'manage_options', 'daydream_demos', 'daydream_demo' );
	}

	add_submenu_page( 'daydream-menu', esc_html__( 'Theme Options', 'daydream' ), esc_html__( 'Theme Options', 'daydream' ), 'manage_options', 'daydream_options', 'daydream_option' );

	global $submenu;
	$submenu[ 'daydream-menu' ][ 0 ][ 0 ] = esc_html__( 'About daydream', 'daydream' );
}

add_action( 'admin_menu', 'daydream_admin_submenu' );

function daydream_welcome() {
	get_template_part( 'admin/daydream_menu/daydream', 'welcome' );
}

function daydream_demo() {
	get_template_part( 'admin/daydream_menu/daydream', 'install_demo' );
}

function daydream_support() {
	get_template_part( 'admin/daydream_menu/daydream', 'support' );
}

function daydream_option() {
	get_template_part( 'admin/daydream_menu/daydream', 'options' );
}
