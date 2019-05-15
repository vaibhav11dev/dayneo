<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function bigbo_admin_menu() {
	add_menu_page( esc_html__( 'About bigbo', 'bigbo' ), esc_html__( 'bigbo', 'bigbo' ), 'manage_options', 'bigbo-menu', 'bigbo_welcome', get_template_directory_uri() . '/admin/assets/images/admin-icon.png', 2 );
}

add_action( 'admin_menu', 'bigbo_admin_menu' );

function bigbo_admin_submenu() {
	if ( in_array( 'vedanta-core/vedanta-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_submenu_page( 'bigbo-menu', esc_html__( 'Install Demos', 'bigbo' ), esc_html__( 'Install Demos', 'bigbo' ), 'manage_options', 'bigbo_demos', 'bigbo_demo' );
	}

	add_submenu_page( 'bigbo-menu', esc_html__( 'Theme Options', 'bigbo' ), esc_html__( 'Theme Options', 'bigbo' ), 'manage_options', 'bigbo_options', 'bigbo_option' );

	global $submenu;
	$submenu[ 'bigbo-menu' ][ 0 ][ 0 ] = esc_html__( 'About bigbo', 'bigbo' );
}

add_action( 'admin_menu', 'bigbo_admin_submenu' );

function bigbo_welcome() {
	get_template_part( 'admin/bigbo_menu/bigbo', 'welcome' );
}

function bigbo_demo() {
	get_template_part( 'admin/bigbo_menu/bigbo', 'install_demo' );
}

function bigbo_support() {
	get_template_part( 'admin/bigbo_menu/bigbo', 'support' );
}

function bigbo_option() {
	get_template_part( 'admin/bigbo_menu/bigbo', 'options' );
}
