<div class="ved_metabox">
    <?php
    $this->dayneo_select( 'slider_type', __( 'Slider Type', 'dayneo' ), array(
	'no'	 => __( 'No Slider', 'dayneo' ),
	'layer'	 => __( 'LayerSlider', 'dayneo' ),
	'rev'	 => __( 'Revolution Slider', 'dayneo' ),
	'flex'	 => __( 'ThemeVedanta Slider', 'dayneo' ),
    ), ''
    );

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active( 'LayerSlider/layerslider.php' ) ) {
	    global $wpdb;
	    $slides_array[ 0 ]	 = __( 'Select a slider', 'dayneo' );
	    // Table name
	    $table_name		 = $wpdb->prefix . "layerslider";

	    // Get sliders
	    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                                                    WHERE flag_hidden = '0' AND flag_deleted = '0'
                                                                    ORDER BY date_c ASC" );

	    if ( ! empty( $sliders ) ):
		    foreach ( $sliders as $key => $item ):
			    $slides[ $item->id ] = '';
		    endforeach;
	    endif;

	    if ( isset( $slides ) && $slides ) {
		    foreach ( $slides as $key => $val ) {
			    $slides_array[ $key ] = 'LayerSlider #' . ( $key );
		    }
	    }
	    $this->dayneo_select( 'slider', __( 'Select LayerSlider', 'dayneo' ), $slides_array, ''
	    );
    }

    if ( is_plugin_active( 'revslider/revslider.php' ) ) {
	    global $wpdb;
	    $revsliders[ 0 ] = __( 'Select a slider', 'dayneo' );
	    if ( function_exists( 'rev_slider_shortcode' ) ) {
		    $get_sliders = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders' );
		    if ( $get_sliders ) {
			    foreach ( $get_sliders as $slider ) {
				    $revsliders[ $slider->alias ] = $slider->title;
			    }
		    }
	    }
	    $this->dayneo_select( 'revslider', __( 'Select Revolution Slider', 'dayneo' ), $revsliders, ''
	    );
    }

    $slides_array		 = array();
    $slides			 = array();
    $slides_array[ 0 ]	 = __( 'Select a slider', 'dayneo' );
    $slides			 = get_terms( 'slide-page' );
    if ( $slides && ! isset( $slides->errors ) ) {
	    $slides = is_array( $slides ) ? $slides : unserialize( $slides );
	    foreach ( $slides as $key => $val ) {
		    $slides_array[ $val->slug ] = $val->name;
	    }
    }
    $this->dayneo_select( 'wooslider', __( 'Select ThemeVedanta Slider', 'dayneo' ), $slides_array, ''
    );
    ?>
</div>