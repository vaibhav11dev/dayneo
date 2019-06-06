<?php
/**
 * The template for displaying all slider 
 * like ls slider, rev slider and tv slider 
 * below and above header.
 *
 *
 * @package bigbo
 */
?>
<div class="slider-content">
<?php
$bigbo_slider_page_id = '';
    if (!empty($post->ID)) {
        if (!is_home() && !is_front_page() && !is_archive()) {
            $bigbo_slider_page_id = $post->ID;
        }
        if (!is_home() && is_front_page()) {
            $bigbo_slider_page_id = $post->ID;
        }
    }
    if (is_home() && !is_front_page()) {
        $bigbo_slider_page_id = get_option('page_for_posts');
    }

// LayerSlider Slider
    if ( get_post_meta( $bigbo_slider_page_id, 'bigbo_slider_type', true ) == 'layer' ):
	    $ved_layerslider = bigbo_get_option( 'ved_layerslider', '1' );
	    if ( $ved_layerslider == "1" ):
		    bigbo_layerslider();
	    endif;
    endif;

// Revolution Slider
    if ( get_post_meta( $bigbo_slider_page_id, 'bigbo_slider_type', true ) == 'rev' && get_post_meta( $bigbo_slider_page_id, 'bigbo_revslider', true ) && function_exists( 'putRevSlider' ) ) {
	    putRevSlider( get_post_meta( $bigbo_slider_page_id, 'bigbo_revslider', true ) );
    }

// ThemeVedanta Slider
    if ( get_post_meta( $bigbo_slider_page_id, 'bigbo_slider_type', true ) == 'flex' && ! is_product() && (get_post_meta( $bigbo_slider_page_id, 'bigbo_wooslider', true ) || get_post_meta( $bigbo_slider_page_id, 'bigbo_wooslider', true ) != 0) ) {
	    bigbo_tvslider( get_post_meta( $bigbo_slider_page_id, 'bigbo_wooslider', true ) );
	    bigbo_tvsliderjs( get_post_meta( $bigbo_slider_page_id, 'bigbo_wooslider', true ) );
    }
    ?>
</div>