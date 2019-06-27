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
if ( !defined( 'ABSPATH' ) ) {
	die;
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );

/**
 * For remove Sale flashes in single-product pages.
 *
 * @see woocommerce_show_product_sale_flash()
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * WooCommerce(header) - Update number of items and total in cart after Ajax
 * 
 * @global type $woocommerce
 * @param type $fragments
 * @return type $fragments
 */
function bigbo_woocommerce_header_add_to_cart_fragment1( $fragments ) {
	global $woocommerce;
	$ved_header_type = bigbo_get_option( 'ved_header_type', 'h1' );
	ob_start();
	?>
	<div class="menu-item header-ajax-cart">
		<a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" id="open-cart">
			<?php if ( $ved_header_type == 'h3' ) { ?>
				<div class="icon-wrap">
					<span class="icon-box">
						<i class="flaticon-paper-bag"></i>
						<span class="mini-item-counter hidden-lg-up"><?php echo (int) $woocommerce->cart->cart_contents_count; ?></span>
					</span>
					<div class="cart-content-right hidden-md-down"><span class="hidden-sm-down icon-wrap-tit"><?php echo esc_html_e( 'Shop Items', 'bigbo' ) ?></span><span class="nav-total"><?php echo (int) $woocommerce->cart->cart_contents_count; ?></span></div>                    
				</div>
			<?php } else { ?>
				<div class="icon-wrap-circle">
					<div class="icon-wrap">
						<span class="icon-box">
							<i class="flaticon-paper-bag"></i>
							<span class="mini-item-counter">
								<?php echo (int) $woocommerce->cart->cart_contents_count; ?>
							</span>
						</span>
					</div> 
					<div class="cart-content-right hidden-md-down"><span class="hidden-sm-down icon-wrap-tit"><?php echo esc_html_e( 'Shopping Cart', 'bigbo' ) ?></span><span class="nav-total"><?php echo wc_price( $woocommerce->cart->total ); ?></span></div>                    
				</div>
			<?php } ?>
		</a>

	</div>
	<?php
	$fragments[ '.header-ajax-cart' ] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'bigbo_woocommerce_header_add_to_cart_fragment1', 9 );

function bigbo_woocommerce_header_add_to_cart_fragment2( $fragments ) {
	global $woocommerce;
	ob_start();
	if ( !$woocommerce->cart->cart_contents_count ) {
		?>
		<div class="sub-cart-menu ajax-cart-content">
			<span class="empty-cart"></span>
			<p class="empty-cart-text"><?php esc_html_e( 'Your cart is currently empty.', 'bigbo' ); ?></p>
		</div>
		<?php
	} else {
		?>
		<div class="sub-cart-menu ajax-cart-content">
			<div class="minicart-scroll">
				<?php
				foreach ( $woocommerce->cart->cart_contents as $cart_item ):
					$cart_item_key	 = $cart_item[ 'key' ];
					$_product		 = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
					?>
					<!-- ITEM -->
					<div class="list-product">
						<div class="list-product-img">
							<a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>"> 
								<?php
								$thumbnail		 = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								echo wp_kses_post( $thumbnail );
								?>
							</a>
						</div>
						<div class="list-product-detail"> 
							<a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>">
								<?php echo esc_html( $cart_item[ 'data' ]->get_name() ); ?>
							</a>
							<p class="quantity-line"><span class="quantity">Qty:</span><b><?php echo (int) $cart_item[ 'quantity' ]; ?></b></p>
							<p class="price-line"><span class="price"><?php echo get_woocommerce_currency_symbol() . $cart_item[ 'data' ]->get_price(); ?></span></p>
						</div>
						<div class="del-minicart">
							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'bigbo' ), esc_attr( $cart_item[ 'product_id' ] ), esc_attr( $cart_item_key )
							), $cart_item_key );
							?>
						</div>
					</div>
					<!-- END ITEM -->
				<?php endforeach; ?>
			</div>
			<div class="hr"></div>
			<div class="subtotal-count"><?php esc_html_e( 'Subtotal:', 'bigbo' ); ?> 
				<b class="content-subhead">
					<?php echo wc_price( $woocommerce->cart->subtotal ); ?>
				</b>
			</div>
			<div class="shipping-count"><?php esc_html_e( 'Shipping:', 'bigbo' ); ?> 
				<b class="content-subhead">
					<?php echo wc_price( $woocommerce->cart->shipping_total ); ?>
				</b>
			</div>
			<div class="total-count"><?php esc_html_e( 'Total:', 'bigbo' ); ?> 
				<b class="content-subhead">
					<?php echo wc_price( $woocommerce->cart->total ); ?>
				</b>
			</div>
			<div class="clearfix"></div>
			<div class="cart-button"> 
				<a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" class="btn btn-base"><?php esc_html_e( 'View Cart', 'bigbo' ); ?></a>
				<a href="<?php echo get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); ?>" class="btn btn-base"><?php esc_html_e( 'Checkout', 'bigbo' ); ?></a> 
			</div>
		</div>
		<?php
	}
	$fragments[ '.ajax-cart-content' ] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'bigbo_woocommerce_header_add_to_cart_fragment2', 10 );

// Remove product in the cart using ajax
function bigbo_ajax_product_remove() {
	// Get mini cart
	ob_start();

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		if ( $cart_item[ 'product_id' ] == $_POST[ 'product_id' ] && $cart_item_key == $_POST[ 'cart_item_key' ] ) {
			WC()->cart->remove_cart_item( $cart_item_key );
		}
	}

	WC()->cart->calculate_totals();
	WC()->cart->maybe_set_cart_cookies();

	woocommerce_mini_cart();

	$mini_cart = ob_get_clean();

	// Fragments and mini cart are returned
	$data = array(
		'fragments'	 => apply_filters( 'woocommerce_add_to_cart_fragments', array(
			'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
		)
		),
		'cart_hash'	 => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
	);

	wp_send_json( $data );

	die();
}

add_action( 'wp_ajax_product_remove', 'bigbo_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'bigbo_ajax_product_remove' );

/**
 *
 * Code used to change the price order in WooCommerce
 *
 * */
function bigbo_woocommerce_price_html( $price, $product ) {
	return preg_replace( '@(<del>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price );
}

add_filter( 'woocommerce_get_price_html', 'bigbo_woocommerce_price_html', 100, 2 );

/**
 * WooCommerce(shop-page) - No of Related Products
 * 
 * @return $args
 */
function bigbo_related_products_args( $args ) {
	$args[ 'posts_per_page' ] = 5; // number of related products
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'bigbo_related_products_args', 20 );

/**
 * WooCommerce(shop-page) - Remove shop page title
 * 
 * @return boolean
 */
function bigbo_shop_title() {
	return false;
}

add_filter( 'woocommerce_show_page_title', 'bigbo_shop_title', 10 );

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
//function bigbo_woocommerce_template_loop_product_title() {
//	global $product;
//
//	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
//
//	echo '<h5 class="woocommerce-loop-product__title"><a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">' . esc_html( get_the_title() ) . '</a></h5>';
//}
//
//remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
//add_action( 'woocommerce_shop_loop_item_title', 'bigbo_woocommerce_template_loop_product_title', 10 );

/**
 * WooCommerce(shop-page) - Add Custom product shorting filter in shop page
 * 
 * 
 */
function bigbo_woocommerce_ordering() {
	$ved_woocommerce_bigbo_ordering = bigbo_get_option( 'ved_woocommerce_bigbo_ordering', '0' );

	// remove default shorting option
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	if ( !$ved_woocommerce_bigbo_ordering ) {
		add_action( 'woocommerce_before_shop_loop', 'bigbo_woocommerce_catalog_ordering', 30 );
		add_action( 'woocommerce_get_catalog_ordering_args', 'bigbo_woocommerce_get_catalog_ordering_args', 20 );
		add_filter( 'loop_shop_per_page', 'bigbo_loop_shop_per_page' );
	}
}

add_action( 'init', 'bigbo_woocommerce_ordering' );

function bigbo_woocommerce_catalog_ordering() {
	global $wp_query;
	$total = $wp_query->found_posts;

	$ved_woo_items	 = bigbo_get_option( 'ved_woo_items', '12' );
	$param_url		 = sanitize_text_field( $_SERVER[ 'QUERY_STRING' ] );

	if ( isset( $param_url ) ) {

		parse_str( $param_url, $params );

		$query_string = '?' . $param_url;
	} else {
		$query_string = '';
	}

	// replace it with theme option
	if ( $ved_woo_items ) {
		$per_page = $ved_woo_items;
	} else {
		$per_page = 12;
	}

	$pob = !empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
	$po	 = !empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';
	$pc	 = !empty( $params[ 'product_count' ] ) ? $params[ 'product_count' ] : $per_page;

	$html	 = '';
	$html	 .= '<div class="catalog-ordering row">';
	$html	 .= '<div class="orderby-order-container form-group col-md-5">';
	$html	 .= '<div class="shop-view GridList">';
	$html	 .= '<a href="#" class="grid-view ved-shop-view current pull-left" data-view="grid"></a>';
	$html	 .= '<a href="#" class="list-view ved-shop-view pull-left" data-view="list"></a>';
	$html	 .= '</div>';
	$html	 .= '<p>There are ' . $total . ' products</p>';
	$html	 .= '<div class="clearfix"></div>';
	$html	 .= '</div>';

	$html	 .= '<div class="form-group col-md-7">';
	$html	 .= '<ul class="form-control orderby order-dropdown pull-right">';
	$html	 .= '<li class="dropdown">';
	$html	 .= '<span data-toggle="dropdown" class="current-li"><span class="current-li-content"><a>' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Default Order', 'bigbo' ) . '</strong></a><i class="fa fa-angle-down"></i></span></span>';
	$html	 .= '<ul class="dropdown-menu">';
	$html	 .= '<li class="' . (($pob == 'default') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'default' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Default Order', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'name') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'name' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Name', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'price') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'price' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Price', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'date') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'date' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Date', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'popularity') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'popularity' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Popularity', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '<li class="' . (($pob == 'rating') ? 'current' : '') . '"><a href="' . esc_url( bigbo_addURLParameter( $query_string, 'product_orderby', 'rating' ) ) . '">' . esc_html__( 'Sort by', 'bigbo' ) . ' <strong>' . esc_html__( 'Rating', 'bigbo' ) . '</strong></a></li>';
	$html	 .= '</ul>';
	$html	 .= '</li>';
	$html	 .= '</ul>';
	$html	 .= '<span class=" hidden-sm-down sort-by pull-right">Sort by:</span>';
	$html	 .= '<div class="col-sm-3 col-xs-4 hidden-lg-up text-left filter-button"><button id="pro_filter_toggler" class="btn btn-base">Filter</button></div> ';
	$html	 .= '<div class="clearfix"></div>';
	$html	 .= '</div>';
	$html	 .= '<div class="products-found col-sm-12 hidden-lg-up">Showing 1-' . $pc . ' of ' . $total . ' item(s)</div>';
	$html	 .= '</div>';

	echo wp_kses_post( $html );
}

function bigbo_woocommerce_get_catalog_ordering_args( $args ) {
	global $woocommerce;

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {

		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	}

	$pob = !empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
	$po	 = !empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';

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

		add_filter( 'posts_clauses', 'bigbo_order_by_rating_post_clauses' );
	}

	return $args;
}

function bigbo_order_by_rating_post_clauses( $args ) {
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

	$order	 = !empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'desc';
	$order	 = strtoupper( $order );

	$args[ 'orderby' ] = "sum_of_comments_approved DESC, average_rating {$order}, $wpdb->posts.post_date DESC";

	$args[ 'groupby' ] = "$wpdb->posts.ID";

	return $args;
}

function bigbo_loop_shop_per_page() {

	$ved_woo_items = bigbo_get_option( 'ved_woo_items', '12' );

	if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {
		parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
	}

	if ( $ved_woo_items ) {
		$per_page = $ved_woo_items;
	} else {
		$per_page = 12;
	}

	$pc = !empty( $params[ 'product_count' ] ) ? $params[ 'product_count' ] : $per_page;

	return $pc;
}

/* bootstrap_input_classes hooks */

function bigbo_add_bootstrap_input_classes( $args, $key, $value = null ) {

	// Start field type switch case
	switch ( $args[ 'type' ] ) {
		case "select" : /* Targets all select input type elements, except the country and state select input types */
			$args[ 'class' ][]			 = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
			$args[ 'input_class' ]		 = array( 'form-control' ); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args[ 'label_class' ]		 = array( 'control-label' );
			$args[ 'custom_attributes' ] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', ); // Add custom data attributes to the form input itself
			break;
		case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
			$args[ 'class' ][]			 = 'form-group single-country';
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
		case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
			$args[ 'class' ][]			 = 'form-group'; // Add class to the field's html element wrapper
			$args[ 'input_class' ]		 = array( 'form-control' ); // add class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args[ 'label_class' ]		 = array( 'control-label' );
			$args[ 'custom_attributes' ] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', );
			break;
		case "password" :
		case "text" :
		case "email" :
		case "tel" :
		case "number" :
			$args[ 'class' ][]			 = 'form-group';
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
			$args[ 'class' ][]			 = 'form-group';
			$args[ 'input_class' ]		 = array( 'form-control' );
			$args[ 'label_class' ]		 = array( 'control-label' );
			break;
	}
	return $args;
}

add_filter( 'woocommerce_form_field_args', 'bigbo_add_bootstrap_input_classes', 10, 3 );

// Hook in
//add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
	$fields[ 'billing' ][ 'billing_first_name' ][ 'input_class' ]	 = array( 'form-row-first' );
	$fields[ 'billing' ][ 'billing_last_name' ][ 'input_class' ]	 = array( 'form-row-last' );
	return $fields;
}

/* begin order hooks */
remove_action( 'woocommerce_view_order', 'woocommerce_order_details_table', 10 );
add_action( 'woocommerce_view_order', 'bigbo_woocommerce_view_order', 10 );

remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
add_action( 'woocommerce_thankyou', 'bigbo_woocommerce_view_order', 10 );

function bigbo_woocommerce_view_order( $order_id ) {
	global $woocommerce;

	$order			 = wc_get_order( $order_id );
	$downloads		 = $order->get_downloadable_items();
	$show_downloads	 = $order->has_downloadable_item() && $order->is_download_permitted();
	if ( $show_downloads ) {
		wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
	}
	$allowed_html	 = array(
		'span' => array(
			'class' => array(),
		),
	);
	?>
	<div class="bigbo-order-details woocommerce-content-box">
		<div class="sec-head-style"><h3 class="text-title"><?php esc_html_e( 'Order Details', 'bigbo' ); ?></h3></div>
		<div class="table-responsive">
			<table class="table cart-table order_details">
				<thead>
					<tr>
						<th class="col-title"></th>
						<th class="col-title"><?php esc_html_e( 'Product', 'bigbo' ); ?></th>
						<th class="col-quantity"><?php esc_html_e( 'Quantity', 'bigbo' ); ?></th>
						<th class="col-subtotal"><?php esc_html_e( 'Total', 'bigbo' ); ?></th>
					</tr>
				</thead>
				<tfoot>
					<?php
					if ( $totals			 = $order->get_order_item_totals() )
						foreach ( $totals as $total ) :
							?>
							<tr>
								<td class="filler-td">&nbsp;</td>
								<td class="filler-td">&nbsp;</td>
								<th scope="row"><?php echo esc_html( $total[ 'label' ] ); ?></th>
								<td class="product-total"><?php echo wp_kses( $total[ 'value' ], $allowed_html ); ?></td>
							</tr>
							<?php
						endforeach;
					?>
				</tfoot>
				<tbody>
					<?php
					if ( sizeof( $order->get_items() ) > 0 ) {

						foreach ( $order->get_items() as $item ) {
							$_product		 = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
							$product		 = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
								<td class="col-thumbnail">
									<?php
									$cart_item		 = '';
									$cart_item_key	 = '';
									$thumbnail		 = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( !$_product->is_visible() )
										echo wp_kses_post( $thumbnail );
									else
										printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink() ), $thumbnail );
									?>
								</td>
								<td class="col-title">

									<?php
									if ( $_product && !$_product->is_visible() )
										echo apply_filters( 'woocommerce_order_item_name', $item[ 'name' ], $item );
									else
										echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $item[ 'product_id' ] ) ), $item[ 'name' ] ), $item );

									wc_display_item_meta( $item );
									?>
								</td>
								<td class="col-quantity">
									<?php echo apply_filters( 'woocommerce_order_item_quantity_html', $item[ 'qty' ], $item ); ?>
								</td>
								<td class="col-subtotal">
									<?php echo wp_kses( $order->get_formatted_line_subtotal( $item ), $allowed_html ); ?>
								</td>
							</tr>
							<?php
							$show_purchase_note	 = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
							$purchase_note		 = $product ? $product->get_purchase_note() : '';
							if ( $show_purchase_note && $purchase_note ) {
								?>
								<tr class="product-purchase-note">
									<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
								</tr>
								<?php
							}
						}
					}

					do_action( 'woocommerce_order_items_table', $order );
					?>
				</tbody>
			</table>
		</div>

		<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
	</div>



	<?php
}

/* end order hooks */

/**
 * Search products
 *
 * @since 1.0
 */
function instance_search_result() {
	if ( apply_filters( 'bigbo_check_ajax_referer', true ) ) {
		check_ajax_referer( '_bigbo_nonce', 'nonce' );
	}
	$response = array();

	if ( isset( $_POST[ 'search_type' ] ) && $_POST[ 'search_type' ] == 'all' ) {
		$response = instance_search_every_things_result();
	} else {
		$response = instance_search_products_result();
	}

	if ( empty( $response ) ) {
		$response[] = sprintf( '<li>%s</li>', esc_html__( 'Nothing found', 'bigbo' ) );
	}

	$output = sprintf( '<ul>%s</ul>', implode( ' ', $response ) );

	wp_send_json_success( $output );
	die();
}

function instance_search_products_result() {
	$response	 = array();
	$args_sku	 = array(
		'post_type'			 => 'product',
		'posts_per_page'	 => 30,
		'meta_query'		 => array(
			array(
				'key'		 => '_sku',
				'value'		 => trim( $_POST[ 'term' ] ),
				'compare'	 => 'like',
			),
		),
		'suppress_filters'	 => 0,
	);

	$args_variation_sku = array(
		'post_type'			 => 'product_variation',
		'posts_per_page'	 => 30,
		'meta_query'		 => array(
			array(
				'key'		 => '_sku',
				'value'		 => trim( $_POST[ 'term' ] ),
				'compare'	 => 'like',
			),
		),
		'suppress_filters'	 => 0,
	);

	$args = array(
		'post_type'			 => 'product',
		'posts_per_page'	 => 30,
		's'					 => trim( $_POST[ 'term' ] ),
		'suppress_filters'	 => 0,
	);

	if ( function_exists( 'wc_get_product_visibility_term_ids' ) ) {
		$product_visibility_term_ids = wc_get_product_visibility_term_ids();
		$args[ 'tax_query' ][]		 = array(
			'taxonomy'	 => 'product_visibility',
			'field'		 => 'term_taxonomy_id',
			'terms'		 => $product_visibility_term_ids[ 'exclude-from-search' ],
			'operator'	 => 'NOT IN',
		);
	}
	if ( isset( $_POST[ 'cat' ] ) && $_POST[ 'cat' ] != '0' ) {
		$args[ 'tax_query' ][] = array(
			'taxonomy'	 => 'product_cat',
			'field'		 => 'slug',
			'terms'		 => $_POST[ 'cat' ],
		);

		$args_sku[ 'tax_query' ] = array(
			array(
				'taxonomy'	 => 'product_cat',
				'field'		 => 'slug',
				'terms'		 => $_POST[ 'cat' ],
			),
		);
	}

	$products_sku			 = get_posts( $args_sku );
	$products_s				 = get_posts( $args );
	$products_variation_sku	 = get_posts( $args_variation_sku );

	$products	 = array_merge( $products_sku, $products_s, $products_variation_sku );
	$product_ids = array();
	foreach ( $products as $product ) {
		$id = $product->ID;
		if ( !in_array( $id, $product_ids ) ) {
			$product_ids[] = $id;

			$productw	 = wc_get_product( $id );
			$response[]	 = sprintf(
			'<li class="product-search-list">' .
			'<a href="%s">' .
			'<div class="image">' .
			'%s' .
			'</div>' .
			'<div class="content-item">' .
			'<h5 class="product-name">' .
			'%s' .
			'</h5>' .
			'<div class="price-item">%s</div>' .
			'</div>' .
			'</a>' .
			'</li>', esc_url( $productw->get_permalink() ), $productw->get_image( 'shop_thumbnail' ), $productw->get_title(), $productw->get_price_html()
			);
		}
	}

	return $response;
}

function instance_search_every_things_result() {
	$response	 = array();
	$args		 = array(
		'post_type'			 => 'any',
		'posts_per_page'	 => 30,
		's'					 => trim( $_POST[ 'term' ] ),
		'suppress_filters'	 => 0,
	);

	$posts		 = get_posts( $args );
	$post_ids	 = array();
	foreach ( $posts as $post ) {
		$id = $post->ID;
		if ( !in_array( $id, $post_ids ) ) {
			$post_ids[]	 = $id;
			$response[]	 = sprintf(
			'<li>' .
			'<a class="image-item" href="%s">' .
			'%s' .
			'</a>' .
			'<div class="content-item">' .
			'<a class="title-item" href="%s">' .
			'%s' .
			'</a>' .
			'</li>', esc_url( get_the_permalink( $id ) ), get_the_post_thumbnail( $id ), esc_url( get_the_permalink( $id ) ), $post->post_title
			);
		}
	}

	return $response;
}

add_action( 'wp_ajax_bigbo_search_products', 'instance_search_result' );
add_action( 'wp_ajax_nopriv_bigbo_search_products', 'instance_search_result' );

/**
 * Ajaxify update count wishlist
 *
 * @since 1.0
 *
 * @param array $fragments
 *
 * @return array
 */
function update_wishlist_count() {
	if ( !function_exists( 'YITH_WCWL' ) ) {
		return;
	}

	wp_send_json( YITH_WCWL()->count_products() );
}

add_action( 'wp_ajax_update_wishlist_count', 'update_wishlist_count' );
add_action( 'wp_ajax_nopriv_update_wishlist_count', 'update_wishlist_count' );

/**
 * 
 * Show WooCommerce Taxonomy
 * 
 */
function bigbo_woocommerce_taxonomy_archive() {
	if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
		$cat = get_queried_object();
		if ( $cat && !empty( $cat->name ) ) {
			echo'<h1 class="h1">' . esc_html( $cat->name ) . '</h1>';
		}
		if ( $cat && !empty( $cat->term_id ) ) {
			$thumbnail_id	 = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image			 = wp_get_attachment_url( $thumbnail_id );
			echo '<img class="cat-img" src=' . esc_url( $image ) . ' alt=' . esc_attr( $cat->name ) . '/>';
		}
		if ( $cat && !empty( $cat->description ) ) {
			echo '<div class="term-description">' . wc_format_content( $cat->description ) . '</div>'; // WPCS: XSS ok.
		}
	}
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_archive_description', 'bigbo_woocommerce_taxonomy_archive', 10 );

/**
 * 
 * Single Product Next/Prev
 * 
 */
function ved_product_navigation() {
	global $post;
	$current_url = get_permalink( $post->ID );

	// Get the previous and next product links
	$next_link		 = get_permalink( get_adjacent_post( false, '', true ) );
	$previous_link	 = get_permalink( get_adjacent_post( false, '', false ) );

	$next_btn	 = '';
	$next_img	 = '';
	if ( $next_link != $current_url ) {
		$next_id = get_adjacent_post( false, '', true )->ID;

		$next_btn = "<a class='button button_next' href='" . esc_url( $next_link ) . "'><i class='fa fa-angle-right' aria-hidden='true'></i></a>";

		if ( $next_id ) {
			$next_img_link	 = wp_get_attachment_image_src( get_post_thumbnail_id( $next_id ), 'single-post-thumbnail' );
			$next_img		 = "<a href='" . esc_url( $next_link ) . "'><img alt class='img-responsive' src='" . esc_url( $next_img_link[ 0 ] ) . "'></a>";
		}
	}

	$previous_btn	 = '';
	$previous_img	 = '';
	if ( $previous_link != $current_url ) {
		$previous_id = get_adjacent_post( false, '', false )->ID;

		$previous_btn = "<a class='button button_prev' href='" . esc_url( $previous_link ) . "'><i class='fa fa-angle-left' aria-hidden='true'></i></a>";

		if ( $previous_id ) {
			$previous_img_link	 = wp_get_attachment_image_src( get_post_thumbnail_id( $previous_id ), 'single-post-thumbnail' );
			$previous_img		 = "<a href='" . esc_url( $previous_link ) . "'><img alt class='img-responsive' src='" . esc_url( $previous_img_link[ 0 ] ) . "'></a>";
		}
	}

	// Create HTML Output
	$output = '<div class="ddNextPrev pull-right">';
	if ( $previous_btn || $previous_img ) {
		$output .= '<div class="itPrev_product nextPrevProduct pull-left"> ' . $previous_btn . '<div class="ddContent">' . $previous_img . '</div></div>';
	}
	if ( $next_btn || $next_img ) {
		$output .= '<div class="itNext_product nextPrevProduct pull-left">' . $next_btn . '<div class="ddContent">' . $next_img . '</div></div>';
	}
	$output .= '</div>';

	// Display the final output
	echo wp_kses_post( $output );
}

add_action( 'woocommerce_single_product_summary', 'ved_product_navigation', 4 );

/**
 * 
 * Bigbo product share
 * 
 * @global string $post
 */
function bigbo_product_share() {
	$ved_tooltip_position = bigbo_get_option( 'ved_sharing_box_tooltip_position', 'none' );
	$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	if ( function_exists( 'vedanta_share_link_socials' ) ) {
		vedanta_share_link_socials( $ved_tooltip_position, get_the_title(), get_the_permalink(), $image );
	}
}

add_action( 'wp_ajax_bigbo_product_quick_view', 'product_quick_view' );
add_action( 'wp_ajax_nopriv_bigbo_product_quick_view', 'product_quick_view' );

/**
 * product_quick_view
 */
function product_quick_view() {
//		if ( apply_filters( 'bigbo_check_ajax_referer', true ) ) {
//			check_ajax_referer( '_bigbo_nonce', 'nonce' );
//		}
	ob_start();
	if ( isset( $_POST[ 'product_id' ] ) && !empty( $_POST[ 'product_id' ] ) ) {
		$product_id			 = $_POST[ 'product_id' ];
		$original_post		 = $GLOBALS[ 'post' ];
		$GLOBALS[ 'post' ]	 = get_post( $product_id ); // WPCS: override ok.
		setup_postdata( $GLOBALS[ 'post' ] );
		wc_get_template_part( 'content', 'product-quick-view' );
		$GLOBALS[ 'post' ]	 = $original_post; // WPCS: override ok.
	}
	$output = ob_get_clean();
	wp_send_json_success( $output );
	die();
}

// QuicKview
add_action( 'bigbo_single_product_summary', 'get_product_quick_view_header', 5 );

/**
 * Add single product header
 */
function get_product_quick_view_header() {
	global $product;
	?>

	<div class="ved-entry-product-header">
		<div class="entry-left">
			<?php
			echo sprintf( '<h2 class="product_title"><a href="%s">%s</a></h2>', esc_url( $product->get_permalink() ), $product->get_title() );
			?>

			<ul class="entry-meta">
				<?php
				if ( function_exists( 'woocommerce_template_single_rating' ) && $product->get_rating_count() ) {
					echo '<li>';
					woocommerce_template_single_rating();
					echo '</li>';
				}
				?>

			</ul>
		</div>
	</div>
	<?php
}

// Image
add_action( 'yith_wcqv_product_image', 'woocommerce_show_product_images', 20 );

// Summary
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_price', 15 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
add_action( 'yith_wcqv_product_summary', 'bigbo_product_share', 35 );

// Add product thumbnail
//add_action( 'woocommerce_after_shop_loop_item', 'product_content_thumbnail' );

/**
 * WooCommerce Loop Product Content Thumbs
 *
 * @since  1.0
 *
 * @return string
 */
//function product_content_thumbnail() {
//	global $product;
//
//	echo '<div class="action-btn quick-view-warp">';
//
//	echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="button yith-wcqv-button ved-product-quick-view"></a>';
//
//	echo '</div>';
//
//	if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
//		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
//	}
//
//	product_compare();
//}

/**
 * WooCommerce product compare
 *
 * @since  1.0
 *
 * @return string
 */
function product_compare() {
	global $product;

	if ( !class_exists( 'YITH_Woocompare' ) ) {
		return;
	}

	$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'bigbo' ) );
	$product_id	 = $product->get_id();
	$url_args	 = array(
		'action' => 'yith-woocompare-add-product',
		'id'	 => $product_id,
	);
	$lang		 = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
	if ( $lang ) {
		$url_args[ 'lang' ] = $lang;
	}

	$css_class	 = 'compare button';
	$cookie_name = 'yith_woocompare_list';
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		$cookie_name .= '_' . get_current_blog_id();
	}
	$the_list = isset( $_COOKIE[ $cookie_name ] ) ? json_decode( $_COOKIE[ $cookie_name ] ) : array();
	if ( in_array( $product_id, $the_list ) ) {
		$css_class				 .= ' added';
		$url_args[ 'action' ]	 = 'yith-woocompare-view-table';
		$button_text			 = apply_filters( 'yith_woocompare_compare_added_label', esc_html__( 'Added', 'bigbo' ) );
	}

	$url = esc_url_raw( add_query_arg( $url_args, site_url() ) );
	echo '<div class="action-btn compare-warp">';
	printf( '<a href="%s" class="%s" title="%s" data-product_id="%d">%s</a>', esc_url( $url ), esc_attr( $css_class ), esc_html( $button_text ), $product_id, $button_text );
	echo '</div>';
}

// Display the additional product images
//function bigbo_second_product_thumbnail() {
//	global $product, $woocommerce, $id;
//	$attachment_ids	 = $product->get_gallery_image_ids();
//	$id				 = get_post_thumbnail_id( $product->get_id() );
//	if ( count( $attachment_ids ) > 0 ) {
//		$secondary_image_id	 = $attachment_ids[ '0' ];
//		echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr				 = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
//	} else {
//		echo wp_get_attachment_image( $id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
//	}
//}
//
//add_action( 'woocommerce_before_shop_loop_item_title', 'bigbo_second_product_thumbnail' );

/**
 * Product On Sale
 */
add_action( 'bigbo_onsale_product_photo', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'bigbo_onsale_product_photo', 'bigbo_template_loop_product_thumbnail', 20 );
add_action( 'bigbo_onsale_product_photo', 'woocommerce_template_loop_product_link_close', 30 );
add_action( 'bigbo_onsale_product_photo', 'bigbo_deal_countdown_timer', 40 );
add_action( 'bigbo_onsale_product_title', 'bigbo_woocommerce_template_loop_product_title', 50 );
add_action( 'bigbo_onsale_product_title', 'woocommerce_template_loop_price', 60 );
add_action( 'bigbo_onsale_product_title', 'bigbo_deal_progress_bar', 70 );

if ( !function_exists( 'bigbo_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail for the loop.
	 */
	function bigbo_template_loop_product_thumbnail() {
		$thumbnail = woocommerce_get_product_thumbnail();
		echo apply_filters( 'bigbo_template_loop_product_thumbnail', $thumbnail );
	}

}

if ( !function_exists( 'bigbo_deal_progress_bar' ) ) {

	/**
	 *
	 */
	function bigbo_deal_progress_bar() {
		$total_stock_quantity = get_post_meta( get_the_ID(), '_total_stock_quantity', true );
		if ( !empty( $total_stock_quantity ) ) {
			$stock_quantity	 = round( $total_stock_quantity );
			$stock_available = ( $stock			 = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$stock_sold		 = ( $stock_quantity > $stock_available ? $stock_quantity - $stock_available : 0 );
			$percentage		 = ( $stock_sold > 0 ? round( $stock_sold / $stock_quantity * 100 ) : 0 );
		} else {
			$stock_available = ( $stock			 = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$stock_sold		 = ( $total_sales	 = get_post_meta( get_the_ID(), 'total_sales', true ) ) ? round( $total_sales ) : 0;
			$stock_quantity	 = $stock_sold + $stock_available;
			$percentage		 = ( ( $stock_available > 0 && $stock_quantity > 0 ) ? round( $stock_sold / $stock_quantity * 100 ) : 0 );
		}

		if ( $stock_available > 0 ) :
			?>
			<div class="deal-progress">
				<div class="deal-stock">
					<span class="stock-sold"><?php echo esc_html__( 'Already Sold:', 'bigbo' ); ?> <strong><?php echo esc_html( $stock_sold ); ?></strong></span>
					<span class="stock-available"><?php echo esc_html__( 'Available:', 'bigbo' ); ?> <strong><?php echo esc_html( $stock_available ); ?></strong></span>
				</div>
				<div class="progress">
					<span class="progress-bar" style="<?php echo esc_attr( 'width:' . $percentage . '%' ); ?>"><?php echo esc_html( $percentage ) . '%'; ?></span>
				</div>
			</div>
			<?php
		endif;
	}

}

if ( !function_exists( 'bigbo_deal_countdown_timer' ) ) {

	/**
	 *
	 */
	function bigbo_deal_countdown_timer( $product ) {
		$product_id				 = $product->get_id();
		$product_type			 = $product->get_type();
		$sale_price_dates_from	 = $sale_price_dates_to	 = '';
		if ( $product_type == 'variable' ) {
			$var_sale_price_dates_from	 = array();
			$var_sale_price_dates_to	 = array();
			$available_variations		 = $product->get_available_variations();
			foreach ( $available_variations as $key => $available_variation ) {
				$variation_id	 = $available_variation[ 'variation_id' ]; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
				if ( $date_from		 = get_post_meta( $variation_id, '_sale_price_dates_from', true ) ) {
					$var_sale_price_dates_from[] = date_i18n( 'Y-m-d H:i:s', $date_from, true );
				}
				if ( $date_to = get_post_meta( $variation_id, '_sale_price_dates_to', true ) ) {
					$var_sale_price_dates_to[] = date_i18n( 'Y-m-d H:i:s', $date_to, true );
				}
			}

			if ( !empty( $var_sale_price_dates_from ) )
				$sale_price_dates_from	 = min( $var_sale_price_dates_from );
			if ( !empty( $var_sale_price_dates_to ) )
				$sale_price_dates_to	 = max( $var_sale_price_dates_to );
		} else {
			if ( $date_from = get_post_meta( $product_id, '_sale_price_dates_from', true ) ) {
				$sale_price_dates_from = date_i18n( 'Y-m-d H:i:s', $date_from, true );
			}
			if ( $date_to = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) {
				$sale_price_dates_to = date_i18n( 'Y-m-d H:i:s', $date_to, true );
			}
		}

		$deal_end_date	 = $sale_price_dates_to;
		$deal_end_time	 = strtotime( $deal_end_date );
		$current_date	 = current_time( 'Y-m-d H:i:s', true );
		$current_time	 = strtotime( $current_date );
		$time_diff		 = ( $deal_end_time - $current_time );

		if ( $time_diff > 0 ) :
			?>
			<div class="deal-countdown-timer">
				<span class="deal-time-diff" style="display:none;"><?php echo apply_filters( 'bigbo_deal_countdown_timer_diff_time', $time_diff ); ?></span>
				<div class="deal-countdown countdown"></div>
			</div>
			<?php
		endif;
	}

}
