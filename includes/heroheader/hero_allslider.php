<?php
/**
 * The template for displaying all slider 
 * like ls slider, rev slider and tv slider 
 * below and above header.
 *
 *
 * @package daydream
 */
?>
<div class="slider-content">
<?php
$daydream_slider_page_id = '';
    if (!empty($post->ID)) {
        if (!is_home() && !is_front_page() && !is_archive()) {
            $daydream_slider_page_id = $post->ID;
        }
        if (!is_home() && is_front_page()) {
            $daydream_slider_page_id = $post->ID;
        }
    }
    if (is_home() && !is_front_page()) {
        $daydream_slider_page_id = get_option('page_for_posts');
    }

// LayerSlider Slider
    if ( get_post_meta( $daydream_slider_page_id, 'daydream_slider_type', true ) == 'layer' ):
	    $dd_layerslider = daydream_get_option( 'dd_layerslider', '1' );
	    if ( $dd_layerslider == "1" ):
		    daydream_layerslider();
	    endif;
    endif;

// Revolution Slider
    if ( get_post_meta( $daydream_slider_page_id, 'daydream_slider_type', true ) == 'rev' && get_post_meta( $daydream_slider_page_id, 'daydream_revslider', true ) && function_exists( 'putRevSlider' ) ) {
	    putRevSlider( get_post_meta( $daydream_slider_page_id, 'daydream_revslider', true ) );
    }

// ThemeVedanta Slider
    if ( get_post_meta( $daydream_slider_page_id, 'daydream_slider_type', true ) == 'flex' && ! is_product() && (get_post_meta( $daydream_slider_page_id, 'daydream_wooslider', true ) || get_post_meta( $daydream_slider_page_id, 'daydream_wooslider', true ) != 0) ) {
	    daydream_tvslider( get_post_meta( $daydream_slider_page_id, 'daydream_wooslider', true ) );
	    daydream_tvsliderjs( get_post_meta( $daydream_slider_page_id, 'daydream_wooslider', true ) );
    }
    ?>
</div>