<?php
add_action( 'woocommerce_before_single_product', 'bigbo_woocommerce_init_loop' );
function bigbo_woocommerce_init_loop(){
	global $ved_options;
}

/********************************************************************
 *
 * Products Loop Customization
 *
 ********************************************************************/
function bigbo_products_loop_classes( $classes = array() ){
	global $ved_options;
	
	if( !empty($classes) && !is_array($classes) ){
		$classes = explode(' ', $classes);
	}
	
	$classes[] = 'products-loop';
	$classes[] = 'row';

	if( is_product() ){
		$classes[] = 'owl-carousel';
	}else{
		$column = bigbo_get_option( 'ved_woocommerce_layout', '4' );
		$classes[] = 'products-loop-column-'.$column;

		$gridlist_view = isset($_COOKIE['gridlist_view']) ? sanitize_text_field( wp_unslash( $_COOKIE['gridlist_view'] ) ) : 'grid';
		
		if( is_shop() ){
			$classes[] = $gridlist_view;
			if( isset( $ved_options['product_pagination'] ) && $ved_options['product_pagination'] == 'infinite_scroll' ){
				$classes[] = 'product-infinite_scroll';
			}
		}
	}
	
	if(is_cart()) {
		$classes[] = 'owl-carousel';
	}

	$classes = apply_filters( 'bigbo_products_loop_classes', $classes );
	$classes = bigbo_class_builder( $classes );

	return $classes;
}

/********************************************************************
 *
 * Add link to product title
 *
 ********************************************************************/
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_filter( 'woocommerce_shop_loop_item_title', 'bigbo_woocommerce_shop_loop_item_title', 9 );
function bigbo_woocommerce_shop_loop_item_title(){
	global $product;
	?>
	<h3 class="product-name">
		<a href="<?php echo esc_url(get_the_permalink(get_the_ID()));?>">
			<?php echo esc_html(get_the_title(get_the_ID()));?>
		</a>
	</h3><!-- .product-name-->
	<?php
}


/********************************************************************
 *
 * Remove product link default callback
 *
 ********************************************************************/
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/********************************************************************
 *
 * Extra wrappers to product loop.
 *
 ********************************************************************/
add_action( 'woocommerce_before_shop_loop_item', 'bigbo_wc_before_shop_loop_item_add_innerdiv_start', 5 );                // .product-inner opening
add_action( 'woocommerce_after_shop_loop_item', 'bigbo_wc_before_shop_loop_item_add_innerdiv_end', 20);                   // .product-inner closing

add_action( 'woocommerce_before_shop_loop_item', 'bigbo_wc_before_shop_loop_item_product_thumbnail_start', 6 );           // .product-thumbnail opening
add_action( 'woocommerce_before_shop_loop_item_title', 'bigbo_wc_before_shop_loop_item_product_thumbnail_end', 19 );      // .product-thumbnail closing

add_action( 'woocommerce_before_shop_loop_item', 'bigbo_wc_before_shop_loop_item_product_thumbnail_inner_start', 7 );     // .product-thumbnail-inner opening
add_action( 'woocommerce_before_shop_loop_item_title', 'bigbo_wc_before_shop_loop_item_product_thumbnail_inner_end', 16 );// .product-thumbnail-inner closing

add_action( 'woocommerce_shop_loop_item_title', 'bigbo_wc_before_shop_loop_item_title_product_info_open', 5 );            // .product-info opening
add_action( 'woocommerce_after_shop_loop_item', 'bigbo_woocommerce_after_shop_loop_item_product_info_close', 20);         // .product-info closing

function bigbo_wc_before_shop_loop_item_add_innerdiv_start(){
	?>
	<div class="product-inner">
	<?php
}
function bigbo_wc_before_shop_loop_item_add_innerdiv_end(){
	?>
	</div><!-- .product-inner -->
	<?php
}

function bigbo_wc_before_shop_loop_item_product_thumbnail_start(){
	?>
	<div class="product-thumbnail">
	<?php
}

function bigbo_wc_before_shop_loop_item_product_thumbnail_end(){
	?>
	</div><!-- .product-thumbnail -->
	<?php
}

function bigbo_wc_before_shop_loop_item_product_thumbnail_inner_start(){
	?>
	<div class="product-thumbnail-inner">
		<a href="<?php echo esc_url( get_permalink() )?>" rel="bookmark">
			<div class="product-thumbnail-main">
		<?php
}

function bigbo_wc_before_shop_loop_item_product_thumbnail_inner_end(){
		?>
			</div>
			<?php
			global $ved_options;
			$attachment_image = bigbo_get_swap_image();
			if( isset($ved_options['product_image_swap']) && $ved_options['product_image_swap'] == 1 && !empty($attachment_image)){
				echo '<div class="product-thumbnail-swap">';
					echo $attachment_image; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				echo '</div>';
			}
			?>
		</a>
	</div><!-- .product-thumbnail-inner -->
	<?php
}

function bigbo_wc_before_shop_loop_item_title_product_info_open(){
	?>
	<div class="product-info">
	<?php
}

function bigbo_woocommerce_after_shop_loop_item_product_info_close(){
	?>
	</div><!-- .product-info -->
	<?php
}

/********************************************************************
 *
 * Apply filter on woocommerce before loop item title
 *
 ********************************************************************/
add_action( 'woocommerce_shortcode_before_products_loop', 'bigbo_shop_loop_item_hover_style_init' );
add_action( 'woocommerce_before_shop_loop', 'bigbo_shop_loop_item_hover_style_init' );
add_action( 'woocommerce_after_single_product_summary', 'bigbo_shop_loop_item_hover_style_init', 0 );
add_action( 'dokan_store_profile_frame_after', 'bigbo_shop_loop_item_hover_style_init'  );

function bigbo_shop_loop_item_hover_style_init( $template_name ){

	global $ved_options;

	$product_hover_style = bigbo_product_hover_style();

	if( in_array( $product_hover_style, array('default','icon-top-left','image-center', 'image-left', 'image-bottom', 'image-bottom-bar', 'image-bottom-2') ) ){
		add_action( 'woocommerce_before_shop_loop_item_title', 'bigbo_product_actions', 18 );
		add_action( 'woocommerce_after_shop_loop_item', 'bigbo_product_actions', 5 );
	}elseif( in_array( $product_hover_style, array('info-bottom','info-bottom-bar') ) ){
		add_action( 'woocommerce_after_shop_loop_item', 'bigbo_product_actions', 5 );
	}

	// Show Hide Sale
//	add_filter( 'woocommerce_sale_flash', 'bigbo_sale_flash_label', 10, 3 );

	// Show Hide Featured
//	add_filter( 'bigbo_featured', 'bigbo_featured_label', 10, 3 );

	add_filter( 'post_class', 'bigbo_product_classes' );
}

function bigbo_product_actions(){
	/**
	 * bigbo_before_product_actions hook.
	 *
	 * @hooked bigbo_product_actions_wrapper_open - 10
	 */
	do_action( 'bigbo_before_product_actions' );

	/**
	 * bigbo_product_actions hook.
	 *
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 * @hooked bigbo_product_actions_add_wishlist_link - 20
	 * @hooked add_compare_link - 30
	 */
	do_action( 'bigbo_product_actions' );

	/**
	 * bigbo_after_product_actions hook.
	 *
	 * @hooked bigbo_product_actions_wrapper_close - 10
	 */
	do_action( 'bigbo_after_product_actions' );
}

add_action( 'bigbo_before_product_actions', 'bigbo_product_actions_wrapper_open' );
function bigbo_product_actions_wrapper_open(){
	global $ved_options;
	?>
	<div class="product-actions">
	<?php
	$ved_options['product_hover_style'];
	if( isset( $ved_options['product_hover_style'] ) && ( $ved_options['product_hover_style'] == 'default' || $ved_options['product_hover_style'] == 'image-bottom-2' || $ved_options['product_hover_style'] == 'icon-top-left'  ) ) {
		?>
		<div class="product-actions-inner">
		<?php
	}
}

add_action( 'bigbo_after_product_actions', 'bigbo_product_actions_wrapper_close' );
function bigbo_product_actions_wrapper_close(){
	global $ved_options;

	if( isset( $ved_options['product_hover_style'] ) && ( $ved_options['product_hover_style'] == 'default' || $ved_options['product_hover_style'] == 'image-bottom-2' || $ved_options['product_hover_style'] == 'icon-top-left' ) ) {
		?>
		</div>
		<?php
	}
	?>
	</div>
	<?php
}

/********************************************************************
 *
 * Add product style class
 *
 ********************************************************************/
function bigbo_product_classes( $classes ) {
	global $post, $ved_options;

	// Set Product Hover Style Class
	$product_hover_style = bigbo_product_hover_style();
	$classes[] = 'product-hover-style-'.$product_hover_style;

	// Set Product Hover Button Shape Class
	if( in_array( $product_hover_style, array('image-center', 'image-left', 'image-bottom', 'info-bottom', 'image-bottom-2') ) ){
		$product_hover_button_shape = bigbo_product_hover_button_shape();
		$classes[] = 'product-hover-button-shape-'.$product_hover_button_shape;
	}

	// Set Product Hover Button Style Class
	if( in_array( $product_hover_style, array('image-center', 'image-left', 'image-bottom') ) ){
		$product_hover_button_style = bigbo_product_hover_button_style();
		$classes[] = 'product-hover-button-style-'.$product_hover_button_style;
	}

	// Set Product Hover style class for default style
	if( $product_hover_style == 'default' || $product_hover_style == 'icon-top-left'){
		$product_hover_default_button_style = bigbo_product_hover_default_button_style();
		$classes[] = 'product-hover-button-style-'.$product_hover_default_button_style;
	}

	// Set Product Hover Bar Style Class
	if( in_array( $product_hover_style, array('image-bottom-bar', 'info-bottom-bar') ) ){
		$product_hover_bar_style = bigbo_product_hover_bar_style();
		$classes[] = 'product-hover-bar-style-'.$product_hover_bar_style;
	}

	// Set Product Hover Bar Style Class
	if( in_array( $product_hover_style, array('image-bottom-bar', 'info-bottom', 'info-bottom-bar') ) ){
		$product_hover_add_to_cart_position = bigbo_product_hover_add_to_cart_position();
		$classes[] = 'product-hover-act-position-'.$product_hover_add_to_cart_position;
	}

	// Product Title length
	if( isset($ved_options['product_title_length']) && !empty($ved_options['product_title_length']) ){
		$classes[] = 'product_title_type-'.$ved_options['product_title_length'];
	}

	$icon_type = isset($ved_options['product_hover_icon_type']) && !empty($ved_options['product_hover_icon_type']) ? $ved_options['product_hover_icon_type'] : 'fill-icon';

	$classes[] = 'product_icon_type-'.$icon_type;

	$classes = apply_filters( 'bigbo_product_classes', $classes, $post );

	return $classes;
}

/********************************************************************
 *
 * Remove woocommerce rating for chnage position
 * Add woocommerce rating to new position
 *
 ********************************************************************/
add_action( 'woocommerce_shop_loop_item_title', 'bigbo_wc_shop_loop_item_rating', 10 );
function bigbo_wc_shop_loop_item_rating(){
	global $product;
	$rating_count = $product->get_rating_count();

	if( $rating_count <= 0 ) return;
	?>
	<div class="star-rating-wrapper">
		<?php

		/**
		 * bigbo_loop_item_rating hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 10
		 */
		do_action( 'bigbo_loop_item_rating' );
		?>
	</div><!-- .star-rating-wrapper -->
	<?php
}
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'bigbo_loop_item_rating', 'woocommerce_template_loop_rating' );

/********************************************************************
 *
 * Out of Stock
 *
 ********************************************************************/
if( ! function_exists('bigbo_product_availability') ) {
	function bigbo_product_availability() {
		global $ved_options;

		if( is_shop() && ! $ved_options['product-out-of-stock-icon'] ) return;

		global $product;

		if( is_shop() || !$product->is_in_stock()){
			echo wc_get_stock_html( $product );
		}

	}
}
add_action( 'woocommerce_before_shop_loop_item_title','bigbo_product_availability', 10 );
add_action( 'bigbo_before_product_actions', 'bigbo_product_availability', 5 );

/********************************************************************
 *
 * Catalog Mode
 *
 ********************************************************************/
add_action( 'wp_head', 'bigbo_woocommerce_catalog_mode' );
function bigbo_woocommerce_catalog_mode(){

	if ( class_exists( 'WooCommerce' ) ) {
		global $ved_options;

		if(isset($ved_options['woocommerce_catalog_mode']) && $ved_options['woocommerce_catalog_mode']==1){
			remove_action( 'bigbo_product_actions', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
		}
	}
}

/* * ******************************************************************
 *
 * Hide Price
 *
 * ****************************************************************** */
add_filter('woocommerce_get_price_html', 'bigbo_hide_price', 99, 2);

if (!function_exists('ciya_sh0op_hide_price')) {

    function bigbo_hide_price($price, $product) {
        global $ved_options;
        if (isset($ved_options['woocommerce_catalog_mode']) && $ved_options['woocommerce_catalog_mode'] == 1) {
            if (isset($ved_options['woocommerce_price_hide']) && $ved_options['woocommerce_price_hide'] == 1) {
                $price = '';
            }
        }
        return $price;
    }

}

// Set products per page.
add_filter('loop_shop_per_page','ciya_chop_woocommerce_loop_shop_per_page');
function ciya_chop_woocommerce_loop_shop_per_page($posts_per_page){
	global $ved_options;
	if( isset($ved_options['ved_woo_items']) && $ved_options['ved_woo_items']!='' ){
		$posts_per_page = $ved_options['ved_woo_items'];
	}
	return $posts_per_page;
}

/********************************************************************
 *
 * Others
 *
 ********************************************************************/
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);


/**
 * Change the placeholder image
 */
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
function custom_woocommerce_placeholder_img_src( $src ) {

	// replace with path to your image
	$src = get_parent_theme_file_uri('/images/product-placeholder.jpg');

	return $src;
}

/********************************************************************
 *
 * Remove woocommerce price for change position
 * Add woocommerce price to new position
 *
 ********************************************************************/

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 8 );

function bigbo_product_hover_style(){
	global $ved_options;
	
	if( isset( $ved_options['product_hover_style'] ) && !empty($ved_options['product_hover_style']) ){
		$option_data = $ved_options['product_hover_style'];
	}else{
		$option_data = 'image-center';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_style', $option_data, $ved_options );
	
	return $option_data;
}

function bigbo_product_hover_button_shape(){
	global $ved_options;

	if( isset( $ved_options['product_hover_button_shape'] ) && !empty($ved_options['product_hover_button_shape']) ){
		$option_data = $ved_options['product_hover_button_shape'];
	}else{
		$option_data = 'square';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_button_shape', $option_data, $ved_options );
	
	return $option_data;
}

function bigbo_product_hover_button_style(){
	global $ved_options;
	
	if( isset( $ved_options['product_hover_button_style'] ) && !empty($ved_options['product_hover_button_style']) ){
		$option_data = $ved_options['product_hover_button_style'];
	}else{
		$option_data = 'flat';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_button_style', $option_data, $ved_options );
	
	return $option_data;
}

function bigbo_product_hover_default_button_style(){
	global $ved_options;
	
	if( isset( $ved_options['product_hover_default_button_style'] ) && !empty($ved_options['product_hover_default_button_style']) ){
		$option_data = $ved_options['product_hover_default_button_style'];
	}else{
		$option_data = 'dark';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_default_button_style', $option_data, $ved_options );
	
	return $option_data;
	
}

function bigbo_product_hover_bar_style(){
	global $ved_options;
	
	if( isset( $ved_options['product_hover_bar_style'] ) && !empty($ved_options['product_hover_bar_style']) ){
		$option_data = $ved_options['product_hover_bar_style'];
	}else{
		$option_data = 'flat';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_bar_style', $option_data, $ved_options );
	
	return $option_data;
}
function bigbo_product_hover_add_to_cart_position(){
	global $ved_options;
	
	if( isset( $ved_options['product_hover_add_to_cart_position'] ) && !empty($ved_options['product_hover_add_to_cart_position']) ){
		$option_data = $ved_options['product_hover_add_to_cart_position'];
	}else{
		$option_data = 'center';
	}
	
	$option_data = apply_filters( 'bigbo_product_hover_add_to_cart_position', $option_data, $ved_options );
	
	return $option_data;
}

function bigbo_class_builder( $class = '' ){
	$classes = array();

	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}
	$classes = array_map( 'esc_attr', $classes );

	return implode( ' ', array_filter( array_unique( $classes ) ) );
}

function bigbo_get_swap_image($size = 'woocommerce_thumbnail' ) {
	global $product, $ved_options;

	$image_src = '';
	$attachment_ids = $product->get_gallery_image_ids();

	if( isset($ved_options['product_image_swap']) && $ved_options['product_image_swap'] == 1 ){
		$attachment_ids = $product->get_gallery_image_ids();
		if(count($attachment_ids) >= 1) {
			$attachment_id = $attachment_ids[0];
                        $product_thumbnai = wp_get_attachment_image($attachment_id, $size);
                        return $product_thumbnai;
		}
                return false;
	}

}

//function bigbo_sale_flash_label( $sale_html, $post, $product ){
//
//	global $ved_options;
//
//	// Reset label
//	$sale_html = '';
//
//	$product_sale           = isset($ved_options['product-sale']) && $ved_options['product-sale'] != '' ? $ved_options['product-sale'] : true;
//	$product_sale_textperc  = isset($ved_options['product_sale_textperc']) && $ved_options['product_sale_textperc'] != '' ? $ved_options['product_sale_textperc'] : 'text';
//	$product_sale_label     = isset($ved_options['product-sale-label']) && $ved_options['product-sale-label'] != '' ? $ved_options['product-sale-label'] : esc_html__( 'Sale', 'bigbo' );
//
//	if( $product_sale_textperc == 'percent' ){
//
//		$percentage = 0;
//
//		if( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ){
//
//			$regular_price = $product->get_regular_price();
//			$sale_price = $product->get_sale_price();
//
//			if ($regular_price)
//				$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
//				$percentage = '-'.$percentage;
//
//		} elseif( $product->is_type( 'variable' ) ){
//
//			$available_variations = $product->get_available_variations();
//
//			if($available_variations){
//
//				$percents = array();
//				foreach($available_variations as $variations){
//
//					$regular_price = $variations['display_regular_price'];
//					$sale_price = $variations['display_price'];
//
//					if ($regular_price){
//						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
//						$percents[] = $percentage;
//					}
//				}
//
//				$max_discount = max($percents);
//				$percentage = 'Up to -'.$max_discount;
//			}
//		}
//
//		$sale_label = $percentage.'%';
//	}else{
//		$sale_label = $product_sale_label;
//	}
//
//	if( $product_sale ){
//		$sale_html = '<span class="onsale">' . esc_html( $sale_label ) . '</span>';
//	}
//
//	return $sale_html;
//}

//function bigbo_featured_label( $featured_html, $post, $product ){
//
//	global $ved_options;
//
//	// Reset label
//	$featured_html = '';
//
//	$product_hot      = isset($ved_options['product-hot']) && $ved_options['product-hot'] != '' ? $ved_options['product-hot'] : true;
//	$product_hot_label = isset($ved_options['product-hot-label']) && $ved_options['product-hot-label'] != '' ? $ved_options['product-hot-label'] : esc_html__( 'Hot', 'bigbo' );
//
//	if( $product_hot ){
//		$featured_html = '<span class="featured">' . esc_html( $product_hot_label ) . '</span>';
//	}
//
//	return $featured_html;
//}

/********************************************************************
 * 
 * Add "Add to Cart" to "bigbo_product_actions"
 * 
 ********************************************************************/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'bigbo_product_actions', 'woocommerce_template_loop_add_to_cart', 10 );

add_filter( 'woocommerce_loop_add_to_cart_link', 'bigbo_woocommerce_loop_add_to_cart_link', 10, 2 );
function bigbo_woocommerce_loop_add_to_cart_link( $link, $product ){
	if ( $product->is_in_stock() ){
		return '<div class="product-action product-action-add-to-cart">'.$link.'</div>';
	}
	return '';
}

/********************************************************************
 * 
 * Product Loop
 * 
 ********************************************************************/
// Move "Compare button" to "bigbo_product_actions"
function bigbo_wc_compare() {
	if( class_exists('YITH_Woocompare') ){
		global $yith_woocompare;
		remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link'), 20 );
		add_action( 'bigbo_product_actions', 'bigbo_product_action_compare_wrapper_start', 29 );
		add_action( 'bigbo_product_actions', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );
		add_action( 'bigbo_product_actions', 'bigbo_product_action_compare_wrapper_end', 31 );
	}
}
add_action( 'init', 'bigbo_wc_compare', 19 );

function bigbo_product_action_compare_wrapper_start(){
	?>
	<div class="product-action product-action-compare">
	<?php
}
function bigbo_product_action_compare_wrapper_end(){
	?>
	</div>
	<?php
}

add_action( 'yith_woocompare_popup_head', 'bigbo_compare_init' );
function bigbo_compare_init(){
	
	// add 'woocommerce-compare' class
	add_filter( 'body_class', 'bigbo_compare_body_class' );
}

function bigbo_compare_body_class( $classes ) {
	
	$classes[] = 'woocommerce-compare';
    
	return $classes;
}

add_filter( 'wp_title', 'bigbo_compare_wp_title', 10, 3 );
function bigbo_compare_wp_title( $title, $sep, $seplocation ){
	if ( ( isset( $_REQUEST['action'] ) || $_REQUEST['action'] == 'yith-woocompare-view-table' ) ){
		$title = esc_html__( 'Product Comparison', 'bigbo' );
	}
	return $title;
}

// Load theme's style
function prefix_add_footer_styles() {
	
	global $wp_styles;
	
	if ( ( $wp_styles instanceof WP_Styles ) ) {
		wp_styles()->do_items( 'bigbo-style' );
		wp_styles()->do_items( 'bigbo-responsive' );
		wp_styles()->do_items( 'bigbo-color-customize' );
	}
};
add_action( 'yith_woocompare_after_main_table', 'prefix_add_footer_styles' );

/********************************************************************
 * 
 * Product Loop
 * 
 ********************************************************************/
add_action( 'woocommerce_before_shop_loop_item_title', 'bigbo_product_actions_add_quick_view_link', 17 );
function bigbo_product_actions_add_quick_view_link(){
	global $post, $ved_options;
	
	?>
	<div class="product-action product-action-quick-view">
		<a href="<?php echo esc_url( get_the_permalink($post->ID) ); ?>" class="open-quick-view" data-id="<?php echo esc_attr( $post->ID ); ?>" data-toggle='tooltip' data-original-title="<?php esc_attr_e( 'Quick view', 'bigbo' );?>" data-placement='right'>
			<?php esc_html_e('Quick View', 'bigbo' ); ?>
		</a>
	</div>
	<?php
}

function bigbo_woocommerce_template_single_title(){
	the_title( sprintf( '<h2 class="product_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
}

/********************************************************************
 * 
 * Product Loop
 * 
 ********************************************************************/
// Add wishlist icon

add_action( 'wp_head', 'bigbo_wc_wishlist' );
function bigbo_wc_wishlist(){
	if(
		( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	) {
		add_action( 'bigbo_product_actions', 'bigbo_product_actions_add_wishlist_link', 20 );
	}
}

function bigbo_product_actions_add_wishlist_link(){
	?>
	<div class="product-action product-action-wishlist">
		<?php echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );?>
	</div>
	<?php
}