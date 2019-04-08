<?php
/**
 * ThemeVedanta Framework
 *
 * WARNING: This file is part of the ThemeVedanta Core Framework.
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 * @package  ThemeVedanta/Template
 * @author   ThemeVedanta
 * @link     http://ThemeVedanta.com
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * WooCommerce(header) - Update number of items and total in cart after Ajax
 * 
 * @global type $woocommerce
 * @param type $fragments
 * @return type $fragments
 */
function dayneo_woocommerce_header_add_to_cart_fragment1( $fragments ) {
	global $woocommerce;

	ob_start();

		?>
		<div class="menu-item header-ajax-cart">
			<div class="extras-cart">
				<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_cart_page_id' ) )); ?>" id="open-cart">
					<i class="icon-basket icons"></i>
					<span class="cart-badge"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
				</a>
			</div>
		</div>
		<?php

	$fragments['.header-ajax-cart'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'dayneo_woocommerce_header_add_to_cart_fragment1', 9 );

function dayneo_woocommerce_header_add_to_cart_fragment2( $fragments ) {
	global $woocommerce;

	ob_start();

	if ( ! $woocommerce->cart->cart_contents_count ) {
		?>
		<div class="off-canvas-cart ajax-cart-content">
			<div class="off-canvas-cart-wrapper">

				<div class="off-canvas-cart-header">
					<a id="cart-toggle" href="#">
						<i class="icon-arrow-right-circle icons"></i>
					</a>
				</div>

				<div class="off-canvas-cart-content">
					<div class="off-canvas-cart-content-wrap">

						<?php esc_html_e( 'Your cart is currently empty.', 'dayneo' ); ?>

					</div>
				</div>

			</div>
		</div>
		<?php
	} else {
		?>
		<div class="off-canvas-cart ajax-cart-content">

			<div class="off-canvas-cart-wrapper">

				<div class="off-canvas-cart-header">
					<a id="cart-toggle" href="#">
						<i class="icon-arrow-right-circle icons"></i>
					</a>
				</div>

				<div class="off-canvas-cart-content">
					<div class="off-canvas-cart-content-wrap">

						<?php
						foreach ( $woocommerce->cart->cart_contents as $cart_item ): //var_dump($cart_item);
							$cart_item_key	 = $cart_item[ 'key' ];
							$_product	 = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
							?>
							<!-- ITEM -->
							<div class="off-canvas-cart-item">
								<div class="off-canvas-cart-item-trash">
									<?php
                                                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s"><i class="icon-trash icons" aria-hidden="true"></i></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'restora' ), esc_attr( $cart_item['product_id'] ), esc_attr( $cart_item_key )
                                                                        ), $cart_item_key );
                                                                        ?>
								</div>
								<div class="off-canvas-cart-item-thumbnail">
									<a href="<?php echo esc_url(get_permalink( $cart_item[ 'product_id' ] )); ?>"> <?php
										$thumbnail	 = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										echo $thumbnail;
										?></a>
								</div>
								<div class="off-canvas-cart-item-title">
									<h5 class="m-b-5"><a href="#"><?php echo esc_html($cart_item[ 'data' ]->get_name()); ?></a></h5>
									<?php echo (int)$cart_item[ 'quantity' ]; ?> x <?php echo esc_html(get_woocommerce_currency_symbol().$cart_item[ 'data' ]->get_price()); ?>
								</div>
							</div>
							<!-- END ITEM -->
						<?php endforeach; ?>

					</div>
				</div>

				<div class="off-canvas-cart-footer">
					<div class="off-canvas-cart-info">
						<div class="row">
							<div class="col-xs-6">
								<h4 class="m-0"><?php esc_html_e( 'Total:', 'dayneo' ); ?></h4>
							</div>
							<div class="col-xs-6">
								<h4 class="m-0 text-right"><?php echo wc_price( $woocommerce->cart->cart_contents_total ); ?></h4>
							</div>
						</div>
					</div>

					<div class="off-canvas-cart-control">
						<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_checkout_page_id' ) )); ?>" class="btn btn-lg btn-block btn-outline btn-fade btn-round btn-dark"><?php esc_html_e( 'Checkout', 'dayneo' ); ?></a>
						<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_cart_page_id' ) )); ?>" class="btn btn-lg btn-block btn-round btn-base"><?php esc_html_e( 'Edit Cart', 'dayneo' ); ?></a>
					</div>
				</div>

			</div>
		</div>
		<?php
	}
	
	$fragments['.ajax-cart-content'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'dayneo_woocommerce_header_add_to_cart_fragment2', 10 );

// Remove product in the cart using ajax
function restora_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'restora_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'restora_ajax_product_remove' );

/**
 *
 * Code used to change the price order in WooCommerce
 *
 * */
function restora_woocommerce_price_html( $price, $product ) {
    return preg_replace( '@(<del>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price );
}

add_filter( 'woocommerce_get_price_html', 'restora_woocommerce_price_html', 100, 2 );

/**
 * WooCommerce(shop-page) - Remove shop page title
 * 
 * @return boolean
 */
function dayneo_shop_title() {
	return false;
}

add_filter( 'woocommerce_show_page_title', 'dayneo_shop_title', 10 );

/**
 * WooCommerce(shop-page) - Remove shop page breadcrumb
 * 
 * @return boolean
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * WooCommerce(shop-page) - Remove shop page product heading
 * And create new html for shop page product heading
 * 
 * @return boolean
 */
function dayneo_woocommerce_template_loop_product_title() {
	global $product;

	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

	echo '<h5 class="woocommerce-loop-product__title"><a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">' . esc_html(get_the_title()) . '</a></h5>';
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'dayneo_woocommerce_template_loop_product_title', 10 );

/**
 * WooCommerce(shop-page) - Add view item button in shop page
 * 
 * @global type $product
 */
function dayneo_woocommerce_template_loop_view_item() {
	global $product;

	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

	echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><i class="icon-eye icons"></i></a>';
}

add_action( 'woocommerce_after_shop_loop_item', 'dayneo_woocommerce_template_loop_view_item', 11 );

/**
 * WooCommerce(shop-page) - Add wishlist in shop page
 * 
 * 
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_add_wishlist_on_loop' ) ) {

	function dayneo_yith_wcwl_add_wishlist_on_loop() {
		?>
		<div class="button wishlist">
			<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
		</div> 
		<?php
	}

	add_action( 'woocommerce_after_shop_loop_item', 'dayneo_yith_wcwl_add_wishlist_on_loop', 12 );
}

/**
 * WooCommerce(header) - Yith wishlist ajax update count
 * 
 * 
 */
//if ( function_exists( 'YITH_WCWL' ) ) {
//
//	function dayneo_update_wishlist_count() {
//		wp_send_json( YITH_WCWL()->count_products() );
//	}
//
//}
//add_action( 'wp_ajax_dayneo_update_wishlist_count', 'dayneo_update_wishlist_count' );
//add_action( 'wp_ajax_nopriv_dayneo_update_wishlist_count', 'dayneo_update_wishlist_count' );

/**
 * WooCommerce(shop-page) - Add Custom product shorting filter in shop page
 * 
 * 
 */
function dayneo_woocommerce_ordering() {
	$dd_woocommerce_dayneo_ordering = dayneo_get_option( 'dd_woocommerce_dayneo_ordering', '0' );

	// remove default shorting option
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	if ( ! $dd_woocommerce_dayneo_ordering ) {
		add_action( 'woocommerce_before_shop_loop', 'dayneo_woocommerce_catalog_ordering', 30 );
		add_action( 'woocommerce_get_catalog_ordering_args', 'dayneo_woocommerce_get_catalog_ordering_args', 20 );
		add_filter( 'loop_shop_per_page', 'dayneo_loop_shop_per_page' );
	}
}

add_action( 'init', 'dayneo_woocommerce_ordering' );

function dayneo_woocommerce_catalog_ordering() {

	$dd_woo_items = dayneo_get_option( 'dd_woo_items', '12' );

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {

		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );

		$query_string = '?' . $_SERVER[ 'QUERY_STRING' ];
	} else {
		$query_string = '';
	}

	// replace it with theme option
	if ( $dd_woo_items ) {
		$per_page = $dd_woo_items;
	} else {
		$per_page = 12;
	}

	$pob	 = ! empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
	$po	 = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';
	$pc	 = ! empty( $params[ 'product_count' ] ) ? $params[ 'product_count' ] : $per_page;

	$html	 = '';
	$html	 .= '<div class="catalog-ordering row">';

	$html .= '<div class="orderby-order-container form-group col-sm-4">';

	$html	 .= '<ul class="form-control orderby order-dropdown">';
	$html	 .= '<li>';
	$html	 .= '<span class="current-li"><span class="current-li-content"><a>' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Default Order', 'dayneo' ) . '</strong></a><i class="fa fa-angle-down"></i></span></span>';
	$html	 .= '<ul>';
	$html	 .= '<li class="' . (($pob == 'default') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'default' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Default Order', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'name') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'name' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Name', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'price') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'price' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Price', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'date') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'date' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Date', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'popularity') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'popularity' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Popularity', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'rating') ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_orderby', 'rating' )) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Rating', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '</ul>';
	$html	 .= '</li>';
	$html	 .= '</ul>';


	$html .= '<ul class="order">';
	if ( $po == 'desc' ):
		$html .= '<li class="desc"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_order', 'asc' )) . '"><i class="icon icon-arrow-up"></i></a></li>';
	endif;
	if ( $po == 'asc' ):
		$html .= '<li class="asc"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_order', 'desc' )) . '"><i class="icon icon-arrow-down"></i></a></li>';
	endif;
	$html .= '</ul>';

	$html .= '</div>';

	$html	 .= '<div class="form-group col-sm-3 col-sm-offset-5">';
	$html	 .= '<ul class="form-control sort-count order-dropdown">';
	$html	 .= '<li>';
	$html	 .= '<span class="current-li"><a>' . __( 'Show', 'dayneo' ) . ' <strong>' . $per_page . ' ' . __( ' Products', 'dayneo' ) . '</strong></a><i class="fa fa-angle-down"></i></span>';
	$html	 .= '<ul>';
	$html	 .= '<li class="' . (($pc == $per_page) ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_count', $per_page )) . '">' . __( 'Show', 'dayneo' ) . ' <strong>' . $per_page . ' ' . __( 'Products', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pc == $per_page * 2) ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_count', $per_page * 2 )) . '">' . __( 'Show', 'dayneo' ) . ' <strong>' . ($per_page * 2) . ' ' . __( 'Products', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pc == $per_page * 3) ? 'current' : '') . '"><a href="' . esc_url(dayneo_addURLParameter( $query_string, 'product_count', $per_page * 3 )) . '">' . __( 'Show', 'dayneo' ) . ' <strong>' . ($per_page * 3) . ' ' . __( 'Products', 'dayneo' ) . '</strong></a></li>';
	$html	 .= '</ul>';
	$html	 .= '</li>';
	$html	 .= '</ul>';
	$html	 .= '</div>';
	$html	 .= '</div>';
	$html	 .= '<hr class="m-t-20 m-b-20">';

	echo $html;
}

function dayneo_woocommerce_get_catalog_ordering_args( $args ) {
	global $woocommerce;

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {

		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	}

	$pob	 = ! empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
	$po	 = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';

	switch ( $pob ) {
		case 'date':
			$orderby	 = 'date';
			$order		 = 'asc';
			$meta_key	 = '';
			break;
		case 'price':
			$orderby	 = 'meta_value_num';
			$order		 = 'asc';
			$meta_key	 = '_price';
			break;
		case 'popularity':
			$orderby	 = 'meta_value_num';
			$order		 = 'asc';
			$meta_key	 = 'total_sales';
			break;
		case 'rating':
			$orderby	 = 'meta_value_num';
			$order		 = 'asc';
			$meta_key	 = 'average_rating';
			break;
		case 'name':
			$orderby	 = 'title';
			$order		 = 'asc';
			$meta_key	 = '';
			break;
		case 'default':
			return $args;
			break;
	}

	switch ( $po ) {
		case 'desc':
			$order	 = 'desc';
			break;
		case 'asc':
			$order	 = 'asc';
			break;
		default:
			$order	 = 'asc';
			break;
	}

	$args[ 'orderby' ]	 = $orderby;
	$args[ 'order' ]	 = $order;
	$args[ 'meta_key' ]	 = $meta_key;

	if ( $pob == 'rating' ) {
		$args[ 'orderby' ]	 = 'menu_order title';
		$args[ 'order' ]	 = $po == 'desc' ? 'desc' : 'asc';
		$args[ 'order' ]	 = strtoupper( $args[ 'order' ] );
		$args[ 'meta_key' ]	 = '';

		add_filter( 'posts_clauses', 'dayneo_order_by_rating_post_clauses' );
	}

	return $args;
}

function dayneo_order_by_rating_post_clauses( $args ) {
	global $wpdb;

	$args[ 'fields' ] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

	$args[ 'where' ] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

	$args[ 'join' ] .= "
		LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
		LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
	";

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {
		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	}

	$order	 = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'desc';
	$order	 = strtoupper( $order );

	$args[ 'orderby' ] = "sum_of_comments_approved DESC, average_rating {$order}, $wpdb->posts.post_date DESC";

	$args[ 'groupby' ] = "$wpdb->posts.ID";

	return $args;
}

function dayneo_loop_shop_per_page() {

	$dd_woo_items = dayneo_get_option( 'dd_woo_items', '12' );

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {
		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	}

	if ( $dd_woo_items ) {
		$per_page = $dd_woo_items;
	} else {
		$per_page = 12;
	}

	$pc = ! empty( $params[ 'product_count' ] ) ? $params[ 'product_count' ] : $per_page;

	return $pc;
}

/* bootstrap_input_classes hooks */
function dayneo_add_bootstrap_input_classes( $args, $key, $value = null ) {
	
	// Start field type switch case
	switch ( $args[ 'type' ] ) {
		case "select" : /* Targets all select input type elements, except the country and state select input types */
			$args[ 'class' ][]		 = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
			$args[ 'input_class' ]		 = array( 'form-control' ); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args[ 'label_class' ]		 = array( 'control-label' );
			$args[ 'custom_attributes' ]	 = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', ); // Add custom data attributes to the form input itself
			break;
		case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
			$args[ 'class' ][]		 = 'form-group single-country';
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
		case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
			$args[ 'class' ][]		 = 'form-group'; // Add class to the field's html element wrapper
			$args[ 'input_class' ]		 = array( 'form-control' ); // add class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args[ 'label_class' ]		 = array( 'control-label' );
			$args[ 'custom_attributes' ]	 = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', );
			break;
		case "password" :
		case "text" :
		case "email" :
		case "tel" :
		case "number" :
			$args[ 'class' ][]		 = 'form-group';
			//$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
			$args[ 'input_class' ]		 = array( 'form-control' );
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
		case 'textarea' :
			$args[ 'input_class' ]		 = array( 'form-control' );
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
		case 'checkbox' :
			break;
		case 'radio' :
			break;
		default :
			$args[ 'class' ][]		 = 'form-group';
			$args[ 'input_class' ]		 = array( 'form-control' );
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
	}
	return $args;
}

add_filter( 'woocommerce_form_field_args', 'dayneo_add_bootstrap_input_classes', 10, 3 );

// Hook in
//add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
	$fields[ 'billing' ][ 'billing_first_name' ][ 'input_class' ]	 = array( 'form-row-first' );
	$fields[ 'billing' ][ 'billing_last_name' ][ 'input_class' ]	 = array( 'form-row-last' );
	return $fields;
}

    /* begin order hooks */
    remove_action('woocommerce_view_order', 'woocommerce_order_details_table', 10);
    add_action('woocommerce_view_order', 'dayneo_woocommerce_view_order', 10);

    remove_action('woocommerce_thankyou', 'woocommerce_order_details_table', 10);
    add_action('woocommerce_thankyou', 'dayneo_woocommerce_view_order', 10);

    function dayneo_woocommerce_view_order($order_id) {
        global $woocommerce;

        $order = wc_get_order( $order_id );
        $order_item_product = new WC_Order_Item_Product();
        ?>
        <div class="dayneo-order-details woocommerce-content-box table-responsive">
            <h2><?php esc_html_e('Order Details', 'dayneo'); ?></h2>
            <table class="table cart-table order_details">
                <thead>
                    <tr>
			<th class="col-title"></th>
                        <th class="col-title"><?php esc_html_e('Product', 'dayneo'); ?></th>
                        <th class="col-quantity"><?php esc_html_e('Quantity', 'dayneo'); ?></th>
                        <th class="col-subtotal"><?php esc_html_e('Total', 'dayneo'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <?php
                    if ($totals = $order->get_order_item_totals())
                        foreach ($totals as $total) :
                            ?>
                            <tr>
				<td class="filler-td">&nbsp;</td>
                                <td class="filler-td">&nbsp;</td>
                                <th scope="row"><?php echo esc_html($total['label']); ?></th>
                                <td class="product-total"><?php echo esc_html(total['value']); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    ?>
                </tfoot>
                <tbody>
                    <?php
                    if (sizeof($order->get_items()) > 0) {

                        foreach ($order->get_items() as $item) {
                            $_product = apply_filters('woocommerce_order_item_product', $order->get_product_from_item($item), $item);
                            $product =  apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
                            ?>
                            <tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
                               <td class="col-thumbnail">
                                        <?php
                                        $cart_item = '';
                                        $cart_item_key = '';
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                        if (!$_product->is_visible())
                                            echo $thumbnail;
                                        else
                                            printf('<a href="%s">%s</a>', esc_url($_product->get_permalink()), $thumbnail);
                                        ?>
                                    </td>
				    <td class="col-title">
                                    
                                        <?php
                                        if ($_product && !$_product->is_visible())
                                            echo apply_filters('woocommerce_order_item_name', $item['name'], $item);
                                        else
                                            echo apply_filters('woocommerce_order_item_name', sprintf('<a href="%s">%s</a>', esc_url(get_permalink($item['product_id'])), $item['name']), $item);

                                        wc_display_item_meta($item);

                                        if ($_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted()) {

                                            $download_files = $order_item_product->get_item_downloads();
                                            $i = 0;
                                            $links = array();

                                            foreach ($download_files as $download_id => $file) {
                                                $i++;

                                                $links[] = '<small><a href="' . esc_url($file['download_url']) . '">' . sprintf(__('Download file%s', 'dayneo'), ( count($download_files) > 1 ? ' ' . $i . ': ' : ': ')) . esc_html($file['name']) . '</a></small>';
                                            }

                                            echo '<br/>' . implode('<br/>', $links);
                                        }
                                        ?>
                                </td>
                                <td class="col-quantity">
                                    <?php echo apply_filters('woocommerce_order_item_quantity_html', $item['qty'], $item); ?>
                                </td>
                                <td class="col-subtotal">
                                    <?php echo esc_html($order->get_formatted_line_subtotal($item)); ?>
                                </td>
                            </tr>
                            <?php
                            $show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
                            $purchase_note = $product ? $product->get_purchase_note() : '';
                            if ( $show_purchase_note && $purchase_note ) {
                                ?>
                                <tr class="product-purchase-note">
                                    <td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }

                    do_action('woocommerce_order_items_table', $order);
                    ?>
                </tbody>
            </table>

            <?php  do_action('woocommerce_order_details_after_order_table', $order); ?>
        </div>

        <div class="dayneo-customer-details woocommerce-content-box full-width">
            <header>
                <h2><?php esc_html_e('Customer details', 'dayneo'); ?></h2>
            </header>
            <dl class="customer_details">
                <?php
                if ($order->get_customer_note())
                    echo '<dt>' . esc_html_e('Note:', 'dayneo') . '</dt> <dd>' . esc_html($order->get_customer_note()) . '</dd>';
                if ($order->get_billing_email())
                    echo '<dt>' . esc_html_e('Email:', 'dayneo') . '</dt> <dd>' . esc_html($order->get_billing_email()) . '</dd>';
                if ($order->get_billing_phone())
                    echo '<dt>' . esc_html_e('Telephone:', 'dayneo') . '</dt> <dd>' . esc_html($order->get_billing_phone()) . '</dd>';

                // Additional customer details hook
                do_action('woocommerce_order_details_after_customer_details', $order);
                ?>
            </dl>

            <?php if (get_option('woocommerce_ship_to_billing_address_only') === 'no' && get_option('woocommerce_calc_shipping') !== 'no') : ?>

                <div class="col2-set addresses">

                    <div class="col-1">

                    <?php endif; ?>

                    <header class="title">
                        <h3><?php esc_html_e('Billing Address', 'dayneo'); ?></h3>
                    </header>
                    <address><p>
                            <?php
                            if (!$order->get_formatted_billing_address())
                                esc_html_e('N/A', 'dayneo');
                            else
                                echo esc_html($order->get_formatted_billing_address());
                            ?>
                        </p></address>

                    <?php if (get_option('woocommerce_ship_to_billing_address_only') === 'no' && get_option('woocommerce_calc_shipping') !== 'no') : ?>

                    </div><!-- /.col-1 -->

                    <div class="col-2">

                        <header class="title">
                            <h3><?php esc_html_e('Shipping Address', 'dayneo'); ?></h3>
                        </header>
                        <address><p>
                                <?php
                                if (!$order->get_formatted_shipping_address())
                                    esc_html_e('N/A', 'dayneo');
                                else
                                    echo esc_html($order->get_formatted_shipping_address());
                                ?>
                            </p></address>

                    </div><!-- /.col-2 -->

                </div><!-- /.col2-set -->

            <?php endif; ?>

            <div class="clear"></div>

        </div>

        <?php
    }

    /* end order hooks */