<?php

if ( class_exists( 'Redux' ) ) {
	$dd_options = 'dd_options';
	Redux::setExtensions( $dd_options, dirname( __FILE__ ) . '/extensions/' );
}

add_action( "redux/extension/customizer/control/includes", "dayneo_info_customizer" );

function dayneo_info_customizer() {
	if ( !class_exists( 'Redux_Customizer_Control_info' ) ) {

		class Redux_Customizer_Control_info extends Redux_Customizer_Control {

			public $type = "redux-info";

		}

	}
}