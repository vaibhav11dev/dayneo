<?php
/**
 * Template part for displaying header topbar
 *
 *
 * @package bigbo
 */
global $post, $wp_query, $ved_options;

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( is_buddypress() ) {
    $post_id = bigbo_bp_get_id();
} elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
    $post_id = wc_get_page_id('shop');
} else {
    $post_id = isset( $post->ID ) ? $post->ID : '';
}

$ved_header_type		 = bigbo_get_option( 'ved_header_type' );
$ved_header_width		 = bigbo_get_option( 'ved_header_width' );
$header_width_class = "container";
if ($ved_header_width == 'full_width' && $ved_header_type == 'h3') {
	$header_width_class = "container-fluid";
}

$ved_topbar_layout		 = bigbo_get_option( 'ved_topbar_layout' );
?>
<!-- TOP BAR -->
<div class="hidden-md-down top-bar top-bar-color">
	<div class="<?php echo esc_attr( $header_width_class ); ?>">
	<div class="row">

		<div class="col-md-6 hidden-sm hidden-xs">
			<?php
			if ( isset($ved_topbar_layout[ 'Left' ]['email']) ) {
				bigbo_topbar_email();
			} 
			if ( isset($ved_topbar_layout[ 'Left' ]['phone_number']) ) {
				bigbo_topbar_phone();
			} 
			if ( isset($ved_topbar_layout[ 'Left' ]['topbar_menu']) ) {
				bigbo_topbar_menu();
			} 
			if ( isset($ved_topbar_layout[ 'Left' ]['social_profiles']) ) {
				bigbo_topbar_social();
			} 
			if ( isset($ved_topbar_layout[ 'Left' ]['currency']) ) {
				bigbo_topbar_currency();
			} 
			if ( isset($ved_topbar_layout[ 'Left' ]['language']) ) {
				bigbo_topbar_language();
			}
			?>
		</div>
	    <div class="col-md-6 hidden-sm hidden-xs">
			<?php
			if ( isset($ved_topbar_layout[ 'Right' ]['email']) ) {
				bigbo_topbar_email();
			} 
			if ( isset($ved_topbar_layout[ 'Right' ]['phone_number']) ) {
				bigbo_topbar_phone();
			}
			if ( isset($ved_topbar_layout[ 'Right' ]['topbar_menu']) ) {
				bigbo_topbar_menu();
			} 
			if ( isset($ved_topbar_layout[ 'Right' ]['social_profiles']) ) {
				bigbo_topbar_social();
			} 
			if ( isset($ved_topbar_layout[ 'Right' ]['currency']) ) {
				bigbo_topbar_currency();
			} 
			if ( isset($ved_topbar_layout[ 'Right' ]['language']) ) {
				bigbo_topbar_language();
			}
			?>
		</div>
	   
	</div>
    </div>
</div>
<!-- END TOP BAR -->
