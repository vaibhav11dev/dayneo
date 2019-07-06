<?php
/**
 * Check to see if the current page is the login/register page
 * Use this in conjunction with is_admin() to separate the front-end from the back-end of your theme
 * @return bool
 */
if ( ! function_exists( 'bigbo_is_login_page' ) ) {
	function bigbo_is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}

//check if site is in undermaintatance
add_action( 'init', 'bigbo_under_maintenance', 21 );
function bigbo_under_maintenance(){
    global $ved_options;
	
	if( is_admin() || bigbo_is_login_page() || ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) ){
		return;
	}
	
	do_action( 'bigbo_maintenance_before' );
	
    $enable_maintenance = isset( $ved_options['ved_enable_maintenance'] ) ? $ved_options['ved_enable_maintenance'] : 0;
	
    if( $enable_maintenance ){
		add_filter( 'body_class', 'bigbo_maintenance_body_class' );
		
		$maintenance_mode = $ved_options['ved_maintenance_mode'];
		if( empty( $maintenance_mode ) ){
			$maintenance_mode = 'maintenance';
		}
		if ( !(current_user_can( 'administrator' ) || current_user_can( 'manage_network' )) ) {
			get_template_part('template-parts/maintenance/maintenance');
			die();
		}
		
	}
}

function bigbo_maintenance_body_class( $classes ) {
	global $ved_options;
	
	if( is_admin() || bigbo_is_login_page() ){
		return $classes;
	}
	
	$enable_maintenance = isset( $ved_options['ved_enable_maintenance'] ) ? $ved_options['ved_enable_maintenance'] : 0;
    if( !current_user_can('administrator') && $enable_maintenance ){
		
		$maintenance_mode = $ved_options['ved_maintenance_mode'];
		if( empty( $maintenance_mode ) ){
			$maintenance_mode = 'maintenance';
		}
		
		$classes[] = 'ved_maintenance';
		$classes[] = 'ved_maintenance_mode-' . $maintenance_mode;
	}
	return $classes;
}