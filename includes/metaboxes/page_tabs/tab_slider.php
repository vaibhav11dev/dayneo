<div class="ved_metabox">
    <?php
    $this->bigbo_select( 'slider_type', __( 'Slider Type', 'bigbo' ), array(
	'no'	 => __( 'No Slider', 'bigbo' ),
	'layer'	 => __( 'LayerSlider', 'bigbo' ),
	'rev'	 => __( 'Revolution Slider', 'bigbo' ),
	'flex'	 => __( 'ThemeVedanta Slider', 'bigbo' ),
    ), ''
    );

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active( 'LayerSlider/layerslider.php' ) ) {
	    global $wpdb;
	    $slides_array[ 0 ]	 = __( 'Select a slider', 'bigbo' );
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
	    $this->bigbo_select( 'slider', __( 'Select LayerSlider', 'bigbo' ), $slides_array, ''
	    );
    }

    if ( is_plugin_active( 'revslider/revslider.php' ) ) {
	    global $wpdb;
	    $revsliders[ 0 ] = __( 'Select a slider', 'bigbo' );
	    if ( function_exists( 'rev_slider_shortcode' ) ) {
		    $get_sliders = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders' );
		    if ( $get_sliders ) {
			    foreach ( $get_sliders as $slider ) {
				    $revsliders[ $slider->alias ] = $slider->title;
			    }
		    }
	    }
	    $this->bigbo_select( 'revslider', __( 'Select Revolution Slider', 'bigbo' ), $revsliders, ''
	    );
    }

    $slides_array		 = array();
    $slides			 = array();
    $slides_array[ 0 ]	 = __( 'Select a slider', 'bigbo' );
    $slides			 = get_terms( 'slide-page' );
    if ( $slides && ! isset( $slides->errors ) ) {
	    $slides = is_array( $slides ) ? $slides : unserialize( $slides );
	    foreach ( $slides as $key => $val ) {
		    $slides_array[ $val->slug ] = $val->name;
	    }
    }
    $this->bigbo_select( 'wooslider', __( 'Select ThemeVedanta Slider', 'bigbo' ), $slides_array, ''
    );
    ?>
</div>