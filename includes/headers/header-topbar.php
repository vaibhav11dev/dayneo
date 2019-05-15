<?php
/**
 * Template part for displaying header topbar
 *
 *
 * @package dayneo
 */
global $post, $wp_query, $dd_options;

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( is_buddypress() ) {
    $post_id = dayneo_bp_get_id();
} elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
    $post_id = wc_get_page_id('shop');
} else {
    $post_id = isset( $post->ID ) ? $post->ID : '';
}

$topbar_class		 = '';
$dd_header_type		 = dayneo_get_option( 'dd_header_type', 'h1' );
$dayneo_header_type	 = get_post_meta( $post_id, 'dayneo_header_type', true );
if ( $dd_options[ 'dd_header_left_content' ] != 'empty' ) {
	$topbar_right_col = 'col-md-6';
} else {
	$topbar_right_col = 'col-md-12';
}
?>
<!-- TOP BAR -->
<div class="hidden-md-down top-bar top-bar-color">
    <div class="container">
	<div class="row">

	    <?php if ( $dd_options[ 'dd_header_left_content' ] != 'empty' ): ?>  
		    <div class="col-md-6 hidden-sm hidden-xs">
			<?php
			if ( $dd_options[ 'dd_header_left_content' ] == 'contact_info' ) {
				get_template_part( 'includes/headers/header-info' );
			} elseif ( $dd_options[ 'dd_header_left_content' ] == 'social_links' ) {
				get_template_part( 'includes/headers/header-social' );
			} elseif ( $dd_options[ 'dd_header_left_content' ] == 'navigation' ) {
				get_template_part( 'includes/headers/header-topmenu' );
			} elseif ( $dd_options[ 'dd_header_left_content' ] == 'content_text' ) {
				get_template_part( 'includes/headers/header-content' );
			}
			?>
		    </div>
        <?php endif; ?>
	    <div class="<?php echo esc_attr($topbar_right_col); ?> col-sm-12 text-right top-bar-right">
			<?php
                get_template_part( 'includes/headers/header-wishlist' );
                get_template_part( 'includes/headers/header-currency' );
                get_template_part( 'includes/headers/header-my-account' );
			?>
	    </div>
	   
	</div>
    </div>
</div>
<!-- END TOP BAR -->
