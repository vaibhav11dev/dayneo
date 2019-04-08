<?php
/**
 * The template for displaying all slider 
 * like ls slider, rev slider and tv slider 
 * below and above header.
 *
 *
 * @package dayneo
 */
?>
<div class="slider-content">
<?php
$dayneo_slider_page_id = '';
    if (!empty($post->ID)) {
        if (!is_home() && !is_front_page() && !is_archive()) {
            $dayneo_slider_page_id = $post->ID;
        }
        if (!is_home() && is_front_page()) {
            $dayneo_slider_page_id = $post->ID;
        }
    }
    if (is_home() && !is_front_page()) {
        $dayneo_slider_page_id = get_option('page_for_posts');
    }

// LayerSlider Slider
    if ( get_post_meta( $dayneo_slider_page_id, 'dayneo_slider_type', true ) == 'layer' ):
	    $dd_layerslider = dayneo_get_option( 'dd_layerslider', '1' );
	    if ( $dd_layerslider == "1" ):
		    dayneo_layerslider();
	    endif;
    endif;

// Revolution Slider
    if ( get_post_meta( $dayneo_slider_page_id, 'dayneo_slider_type', true ) == 'rev' && get_post_meta( $dayneo_slider_page_id, 'dayneo_revslider', true ) && function_exists( 'putRevSlider' ) ) {
	    putRevSlider( get_post_meta( $dayneo_slider_page_id, 'dayneo_revslider', true ) );
    }

// ThemeVedanta Slider
    if ( get_post_meta( $dayneo_slider_page_id, 'dayneo_slider_type', true ) == 'flex' && ! is_product() && (get_post_meta( $dayneo_slider_page_id, 'dayneo_wooslider', true ) || get_post_meta( $dayneo_slider_page_id, 'dayneo_wooslider', true ) != 0) ) {
	    dayneo_tvslider( get_post_meta( $dayneo_slider_page_id, 'dayneo_wooslider', true ) );
	    dayneo_tvsliderjs( get_post_meta( $dayneo_slider_page_id, 'dayneo_wooslider', true ) );
    }
    ?>
</div>