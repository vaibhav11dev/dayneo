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
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );

/**
 * WooCommerce(header) - Update number of items and total in cart after Ajax
 * 
 * @global type $woocommerce
 * @param type $fragments
 * @return type $fragments
 */
function dayneo_woocommerce_header_add_to_cart_fragment1( $fragments ) {
    global $woocommerce;
    $dd_header_type = dayneo_get_option( 'dd_header_type', 'h6' );
    ob_start();
    ?>
    <div class="menu-item header-ajax-cart">
        <a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" id="open-cart">
            <?php if ( $dd_header_type == 'h8' ) { ?>
                <div class="icon-wrap">
                    <span class="icon-box">
                        <i class="flaticon-paper-bag"></i>
                    </span>
                    <div class="cart-content-right hidden-md-down"><span class="hidden-sm-down icon-wrap-tit"><?php echo esc_html_e( 'Shop Item(s)', 'dayneo' ) ?></span><span class="nav-total"><?php echo $woocommerce->cart->cart_contents_count; ?></span></div>                    
                </div>
            <?php } else { ?>
                <div class="icon-wrap-circle">
                    <div class="icon-wrap">
                        <span class="icon-box">
                            <i class="flaticon-paper-bag"></i>
                            <span class="mini-item-counter">
                                <?php echo $woocommerce->cart->cart_contents_count; ?>
                            </span>
                        </span>
                    </div> 
                    <div class="cart-content-right hidden-md-down"><span class="hidden-sm-down icon-wrap-tit"><?php echo esc_html_e( 'Shopping Cart', 'dayneo' ) ?></span><span class="nav-total"><?php echo wc_price( $woocommerce->cart->total ); ?></span></div>                    
                </div>
            <?php } ?>
        </a>

    </div>
    <?php
    $fragments[ '.header-ajax-cart' ] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'dayneo_woocommerce_header_add_to_cart_fragment1', 9 );

function dayneo_woocommerce_header_add_to_cart_fragment2( $fragments ) {
    global $woocommerce;
    ob_start();
    if ( ! $woocommerce->cart->cart_contents_count ) {
        ?>
        <div class="sub-cart-menu ajax-cart-content">
            <span class="empty-cart"></span>
            <p class="empty-cart-text"><?php _e( 'Your cart is currently empty.', 'dayneo' ); ?></p>
        </div>
        <?php
    } else {
        ?>
        <div class="sub-cart-menu ajax-cart-content">
            <div class="minicart-scroll">
                <?php
                foreach ( $woocommerce->cart->cart_contents as $cart_item ):
                    $cart_item_key = $cart_item[ 'key' ];
                    $_product      = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
                    ?>
                    <!-- ITEM -->
                    <div class="list-product">
                        <div class="list-product-img">
                            <a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>"> 
                                <?php
                                $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                echo $thumbnail;
                                ?>
                            </a>
                        </div>
                        <div class="list-product-detail"> 
                            <a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>">
                                <?php echo $cart_item[ 'data' ]->get_name(); ?>
                            </a>
                            <p class="quantity-line"><span class="quantity">Qty:</span><b><?php echo $cart_item[ 'quantity' ]; ?></b></p>
                            <p class="price-line"><span class="price"><?php echo get_woocommerce_currency_symbol() . $cart_item[ 'data' ]->get_price(); ?></span></p>
                        </div>
                        <div class="del-minicart">
                            <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'dayneo' ), esc_attr( $cart_item[ 'product_id' ] ), esc_attr( $cart_item_key )
                            ), $cart_item_key );
                            ?>
                        </div>
                    </div>
                    <!-- END ITEM -->
                <?php endforeach; ?>
            </div>
            <div class="hr"></div>
            <div class="subtotal-count"><?php _e( 'Subtotal:', 'dayneo' ); ?> 
                <b class="content-subhead">
                    <?php echo wc_price( $woocommerce->cart->subtotal ); ?>
                </b>
            </div>
            <div class="shipping-count"><?php _e( 'Shipping:', 'dayneo' ); ?> 
                <b class="content-subhead">
                    <?php echo wc_price( $woocommerce->cart->shiping_total ); ?>
                </b>
            </div>
            <div class="total-count"><?php _e( 'Total:', 'dayneo' ); ?> 
                <b class="content-subhead">
                    <?php echo wc_price( $woocommerce->cart->total ); ?>
                </b>
            </div>
            <div class="clearfix"></div>
            <div class="cart-button"> 
                <a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" class="btn btn-base"><?php _e( 'View Cart', 'dayneo' ); ?></a>
                <a href="<?php echo get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); ?>" class="btn btn-base"><?php _e( 'Checkout', 'dayneo' ); ?></a> 
            </div>
        </div>
        <?php
    }
    $fragments[ '.ajax-cart-content' ] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'dayneo_woocommerce_header_add_to_cart_fragment2', 10 );

// Remove product in the cart using ajax
function dayneo_ajax_product_remove() {
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
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
            'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
        )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'dayneo_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'dayneo_ajax_product_remove' );

/**
 *
 * Code used to change the price order in WooCommerce
 *
 * */
function dayneo_woocommerce_price_html( $price, $product ) {
    return preg_replace( '@(<del>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price );
}

add_filter( 'woocommerce_get_price_html', 'dayneo_woocommerce_price_html', 100, 2 );

/**
 * WooCommerce(shop-page) - No of Related Products
 * 
 * @return $args
 */
function dayneo_related_products_args( $args ) {
    $args[ 'posts_per_page' ] = 5; // number of related products
    return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'dayneo_related_products_args', 20 );

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

    echo '<h5 class="woocommerce-loop-product__title"><a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">' . esc_html( get_the_title() ) . '</a></h5>';
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'dayneo_woocommerce_template_loop_product_title', 10 );

/**
 * WooCommerce(shop-page) - Add wishlist in shop page
 * 
 * 
 */
//if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_add_wishlist_on_loop' ) ) {
//
//    function dayneo_yith_wcwl_add_wishlist_on_loop() {
//        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
//    }
//
//    add_action( 'woocommerce_after_shop_loop_item', 'dayneo_yith_wcwl_add_wishlist_on_loop', 12 );
//}

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
    global $wp_query;
    $total = $wp_query->found_posts;

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

    $pob = ! empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
    $po  = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';
    $pc  = ! empty( $params[ 'product_count' ] ) ? $params[ 'product_count' ] : $per_page;

    $html = '';
    $html .= '<div class="catalog-ordering row">';
    $html .= '<div class="orderby-order-container form-group col-md-5">';
    $html .= '<div class="shop-view GridList">';
    $html .= '<a href="#" class="grid-view dd-shop-view current pull-left" data-view="grid"></a>';
    $html .= '<a href="#" class="list-view dd-shop-view pull-left" data-view="list"></a>';
    $html .= '</div>';
    $html .= '<p>There are ' . $total . ' products</p>';
    $html .= '<div class="clearfix"></div>';
    $html .= '</div>';

    $html .= '<div class="form-group col-md-7">';
    $html .= '<ul class="form-control orderby order-dropdown pull-right">';
    $html .= '<li class="dropdown">';
    $html .= '<span data-toggle="dropdown" class="current-li"><span class="current-li-content"><a>' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Default Order', 'dayneo' ) . '</strong></a><i class="fa fa-angle-down"></i></span></span>';
    $html .= '<ul class="dropdown-menu">';
    $html .= '<li class="' . (($pob == 'default') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'default' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Default Order', 'dayneo' ) . '</strong></a></li>';
    $html .= '<li class="' . (($pob == 'name') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'name' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Name', 'dayneo' ) . '</strong></a></li>';
    $html .= '<li class="' . (($pob == 'price') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'price' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Price', 'dayneo' ) . '</strong></a></li>';
    $html .= '<li class="' . (($pob == 'date') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'date' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Date', 'dayneo' ) . '</strong></a></li>';
    $html .= '<li class="' . (($pob == 'popularity') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'popularity' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Popularity', 'dayneo' ) . '</strong></a></li>';
    $html .= '<li class="' . (($pob == 'rating') ? 'current' : '') . '"><a href="' . esc_url( dayneo_addURLParameter( $query_string, 'product_orderby', 'rating' ) ) . '">' . __( 'Sort by', 'dayneo' ) . ' <strong>' . __( 'Rating', 'dayneo' ) . '</strong></a></li>';
    $html .= '</ul>';
    $html .= '</li>';
    $html .= '</ul>';
    $html .= '<span class=" hidden-sm-down sort-by pull-right">Sort by:</span>';
    $html .= '<div class="col-sm-3 col-xs-4 hidden-lg-up text-left filter-button"><button id="pro_filter_toggler" class="btn btn-base">Filter</button></div> ';
    $html .= '<div class="clearfix"></div>';
    $html .= '</div>';
    $html .= '<div class="products-found col-sm-12 hidden-lg-up">Showing 1-' . $pc . ' of ' . $total . ' item(s)</div>';
    $html .= '</div>';

    echo $html;
}

function dayneo_woocommerce_get_catalog_ordering_args( $args ) {
    global $woocommerce;

    if ( isset( $_SERVER[ 'QUERY_STRING' ] ) ) {

        parse_str( $_SERVER[ 'QUERY_STRING' ], $params );
    }

    $pob = ! empty( $params[ 'product_orderby' ] ) ? $params[ 'product_orderby' ] : 'default';
    $po  = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'asc';

    switch ( $pob ) {
        case 'date':
            $orderby  = 'date';
            $order    = 'asc';
            $meta_key = '';
            break;
        case 'price':
            $orderby  = 'meta_value_num';
            $order    = 'asc';
            $meta_key = '_price';
            break;
        case 'popularity':
            $orderby  = 'meta_value_num';
            $order    = 'asc';
            $meta_key = 'total_sales';
            break;
        case 'rating':
            $orderby  = 'meta_value_num';
            $order    = 'asc';
            $meta_key = 'average_rating';
            break;
        case 'name':
            $orderby  = 'title';
            $order    = 'asc';
            $meta_key = '';
            break;
        case 'default':
            return $args;
            break;
    }

    switch ( $po ) {
        case 'desc':
            $order = 'desc';
            break;
        case 'asc':
            $order = 'asc';
            break;
        default:
            $order = 'asc';
            break;
    }

    $args[ 'orderby' ]  = $orderby;
    $args[ 'order' ]    = $order;
    $args[ 'meta_key' ] = $meta_key;

    if ( $pob == 'rating' ) {
        $args[ 'orderby' ]  = 'menu_order title';
        $args[ 'order' ]    = $po == 'desc' ? 'desc' : 'asc';
        $args[ 'order' ]    = strtoupper( $args[ 'order' ] );
        $args[ 'meta_key' ] = '';

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

    $order = ! empty( $params[ 'product_order' ] ) ? $params[ 'product_order' ] : 'desc';
    $order = strtoupper( $order );

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
            $args[ 'class' ][]           = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
            $args[ 'input_class' ]       = array( 'form-control' ); // Add a class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args[ 'label_class' ]       = array( 'control-label' );
            $args[ 'custom_attributes' ] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', ); // Add custom data attributes to the form input itself
            break;
        case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
            $args[ 'class' ][]           = 'form-group single-country';
            $args[ 'label_class' ]       = array( 'control-label' );
            break;
        case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
            $args[ 'class' ][]           = 'form-group'; // Add class to the field's html element wrapper
            $args[ 'input_class' ]       = array( 'form-control' ); // add class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args[ 'label_class' ]       = array( 'control-label' );
            $args[ 'custom_attributes' ] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', );
            break;
        case "password" :
        case "text" :
        case "email" :
        case "tel" :
        case "number" :
            $args[ 'class' ][]           = 'form-group';
            //$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
            $args[ 'input_class' ]       = array( 'form-control' );
            $args[ 'label_class' ]       = array( 'control-label' );
            break;
        case 'textarea' :
            $args[ 'input_class' ]       = array( 'form-control' );
            $args[ 'label_class' ]       = array( 'control-label' );
            break;
        case 'checkbox' :
            break;
        case 'radio' :
            break;
        default :
            $args[ 'class' ][]           = 'form-group';
            $args[ 'input_class' ]       = array( 'form-control' );
            $args[ 'label_class' ]       = array( 'control-label' );
            break;
    }
    return $args;
}

add_filter( 'woocommerce_form_field_args', 'dayneo_add_bootstrap_input_classes', 10, 3 );

// Hook in
//add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    $fields[ 'billing' ][ 'billing_first_name' ][ 'input_class' ] = array( 'form-row-first' );
    $fields[ 'billing' ][ 'billing_last_name' ][ 'input_class' ]  = array( 'form-row-last' );
    return $fields;
}

/* begin order hooks */
remove_action( 'woocommerce_view_order', 'woocommerce_order_details_table', 10 );
add_action( 'woocommerce_view_order', 'dayneo_woocommerce_view_order', 10 );

remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
add_action( 'woocommerce_thankyou', 'dayneo_woocommerce_view_order', 10 );

function dayneo_woocommerce_view_order( $order_id ) {
    global $woocommerce;

    $order              = wc_get_order( $order_id );
    $order_item_product = new WC_Order_Item_Product();
    ?>
    <div class="dayneo-order-details woocommerce-content-box">
        <div class="sec-head-style"><h3 class="text-title"><?php esc_html_e( 'Order Details', 'dayneo' ); ?></h3></div>
        <div class="table-responsive">
            <table class="table cart-table order_details">
                <thead>
                    <tr>
                        <th class="col-title"></th>
                        <th class="col-title"><?php esc_html_e( 'Product', 'dayneo' ); ?></th>
                        <th class="col-quantity"><?php esc_html_e( 'Quantity', 'dayneo' ); ?></th>
                        <th class="col-subtotal"><?php esc_html_e( 'Total', 'dayneo' ); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <?php
                    if ( $totals             = $order->get_order_item_totals() )
                        foreach ( $totals as $total ) :
                            ?>
                            <tr>
                                <td class="filler-td">&nbsp;</td>
                                <td class="filler-td">&nbsp;</td>
                                <th scope="row"><?php echo esc_html( $total[ 'label' ] ); ?></th>
                                <td class="product-total"><?php echo $total[ 'value' ]; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    ?>
                </tfoot>
                <tbody>
                    <?php
                    if ( sizeof( $order->get_items() ) > 0 ) {

                        foreach ( $order->get_items() as $item ) {
                            $_product      = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
                            $product       = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );
                            ?>
                            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
                                <td class="col-thumbnail">
                                    <?php
                                    $cart_item     = '';
                                    $cart_item_key = '';
                                    $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $_product->is_visible() )
                                        echo $thumbnail;
                                    else
                                        printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink() ), $thumbnail );
                                    ?>
                                </td>
                                <td class="col-title">

                                    <?php
                                    if ( $_product && ! $_product->is_visible() )
                                        echo apply_filters( 'woocommerce_order_item_name', $item[ 'name' ], $item );
                                    else
                                        echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $item[ 'product_id' ] ) ), $item[ 'name' ] ), $item );

                                    wc_display_item_meta( $item );

                                    if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

                                        $download_files = $order_item_product->get_item_downloads();
                                        $i              = 0;
                                        $links          = array();

                                        foreach ( $download_files as $download_id => $file ) {
                                            $i ++;

                                            $links[] = '<small><a href="' . esc_url( $file[ 'download_url' ] ) . '">' . sprintf( __( 'Download file%s', 'dayneo' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file[ 'name' ] ) . '</a></small>';
                                        }

                                        echo '<br/>' . implode( '<br/>', $links );
                                    }
                                    ?>
                                </td>
                                <td class="col-quantity">
                                    <?php echo apply_filters( 'woocommerce_order_item_quantity_html', $item[ 'qty' ], $item ); ?>
                                </td>
                                <td class="col-subtotal">
                                    <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                                </td>
                            </tr>
                            <?php
                            $show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
                            $purchase_note      = $product ? $product->get_purchase_note() : '';
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
    if ( apply_filters( 'dayneo_check_ajax_referer', true ) ) {
        check_ajax_referer( '_dayneo_nonce', 'nonce' );
    }
    $response = array();

    if ( isset( $_POST[ 'search_type' ] ) && $_POST[ 'search_type' ] == 'all' ) {
        $response = instance_search_every_things_result();
    } else {
        $response = instance_search_products_result();
    }

    if ( empty( $response ) ) {
        $response[] = sprintf( '<li>%s</li>', esc_html__( 'Nothing found', 'dayneo' ) );
    }

    $output = sprintf( '<ul>%s</ul>', implode( ' ', $response ) );

    wp_send_json_success( $output );
    die();
}

function instance_search_products_result() {
    $response = array();
    $args_sku = array(
        'post_type'        => 'product',
        'posts_per_page'   => 30,
        'meta_query'       => array(
            array(
                'key'     => '_sku',
                'value'   => trim( $_POST[ 'term' ] ),
                'compare' => 'like',
            ),
        ),
        'suppress_filters' => 0,
    );

    $args_variation_sku = array(
        'post_type'        => 'product_variation',
        'posts_per_page'   => 30,
        'meta_query'       => array(
            array(
                'key'     => '_sku',
                'value'   => trim( $_POST[ 'term' ] ),
                'compare' => 'like',
            ),
        ),
        'suppress_filters' => 0,
    );

    $args = array(
        'post_type'        => 'product',
        'posts_per_page'   => 30,
        's'                => trim( $_POST[ 'term' ] ),
        'suppress_filters' => 0,
    );

    if ( function_exists( 'wc_get_product_visibility_term_ids' ) ) {
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();
        $args[ 'tax_query' ][]       = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'term_taxonomy_id',
            'terms'    => $product_visibility_term_ids[ 'exclude-from-search' ],
            'operator' => 'NOT IN',
        );
    }
    if ( isset( $_POST[ 'cat' ] ) && $_POST[ 'cat' ] != '0' ) {
        $args[ 'tax_query' ][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $_POST[ 'cat' ],
        );

        $args_sku[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $_POST[ 'cat' ],
            ),
        );
    }

    $products_sku           = get_posts( $args_sku );
    $products_s             = get_posts( $args );
    $products_variation_sku = get_posts( $args_variation_sku );

    $products    = array_merge( $products_sku, $products_s, $products_variation_sku );
    $product_ids = array();
    foreach ( $products as $product ) {
        $id = $product->ID;
        if ( ! in_array( $id, $product_ids ) ) {
            $product_ids[] = $id;

            $productw   = wc_get_product( $id );
            $response[] = sprintf(
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
    $response = array();
    $args     = array(
        'post_type'        => 'any',
        'posts_per_page'   => 30,
        's'                => trim( $_POST[ 'term' ] ),
        'suppress_filters' => 0,
    );

    $posts    = get_posts( $args );
    $post_ids = array();
    foreach ( $posts as $post ) {
        $id = $post->ID;
        if ( ! in_array( $id, $post_ids ) ) {
            $post_ids[] = $id;
            $response[] = sprintf(
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

add_action( 'wp_ajax_dayneo_search_products', 'instance_search_result' );
add_action( 'wp_ajax_nopriv_dayneo_search_products', 'instance_search_result' );

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
    if ( ! function_exists( 'YITH_WCWL' ) ) {
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
function dayneo_woocommerce_taxonomy_archive() {
    if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
        $cat = get_queried_object();
        if ( $cat && ! empty( $cat->name ) ) {
            echo'<h1 class="h1">' . esc_html( $cat->name ) . '</h1>';
        }
        if ( $cat && ! empty( $cat->term_id ) ) {
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image        = wp_get_attachment_url( $thumbnail_id );
            echo '<img class="cat-img" src=' . esc_url( $image ) . ' alt="" />';
        }
        if ( $cat && ! empty( $cat->description ) ) {
            echo '<div class="term-description">' . wc_format_content( $cat->description ) . '</div>'; // WPCS: XSS ok.
        }
    }
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'woocommerce_archive_description', 'dayneo_woocommerce_taxonomy_archive', 10 );

/**
 * 
 * Single Product Next/Prev
 * 
 */
function dd_product_navigation() {
    global $post;
    $current_url = get_permalink( $post->ID );

    // Get the previous and next product links
    $next_link     = get_permalink( get_adjacent_post( false, '', true ) );
    $previous_link = get_permalink( get_adjacent_post( false, '', false ) );

    $next_btn = '';
    $next_img = '';
    if ( $next_link != $current_url ) {
        $next_id = get_adjacent_post( false, '', true )->ID;

        $next_btn = "<a class='button button_next' href='" . esc_url( $next_link ) . "'><i class='fa fa-angle-right' aria-hidden='true'></i></a>";

        if ( $next_id ) {
            $next_img_link = wp_get_attachment_image_src( get_post_thumbnail_id( $next_id ), 'single-post-thumbnail' );
            $next_img      = "<a href='" . esc_url( $next_link ) . "'><img class='img-responsive' src='" . esc_url( $next_img_link[ 0 ] ) . "'></a>";
        }
    }

    $previous_btn = '';
    $previous_img = '';
    if ( $previous_link != $current_url ) {
        $previous_id = get_adjacent_post( false, '', false )->ID;

        $previous_btn = "<a class='button button_prev' href='" . esc_url( $previous_link ) . "'><i class='fa fa-angle-left' aria-hidden='true'></i></a>";

        if ( $previous_id ) {
            $previous_img_link = wp_get_attachment_image_src( get_post_thumbnail_id( $previous_id ), 'single-post-thumbnail' );
            $previous_img      = "<a href='" . esc_url( $previous_link ) . "'><img class='img-responsive' src='" . esc_url( $previous_img_link[ 0 ] ) . "'></a>";
        }
    }

    // Create HTML Output
    $output = '<div class="innovatoryNextPrev pull-right">';
    if ( $previous_btn || $previous_img ) {
        $output .= '<div class="itPrev_product nextPrevProduct pull-left"> ' . $previous_btn . '<div class="innovatoryContent">' . $previous_img . '</div></div>';
    }
    if ( $next_btn || $next_img ) {
        $output .= '<div class="itNext_product nextPrevProduct pull-left">' . $next_btn . '<div class="innovatoryContent">' . $next_img . '</div></div>';
    }
    $output .= '</div>';

    // Display the final output
    echo wp_kses_post( $output );
}

add_action( 'woocommerce_single_product_summary', 'dd_product_navigation', 4 );

/**
 * 
 * Dayneo product share
 * 
 * @global string $post
 */
function dayneo_product_share() {
    global $post;
    $image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    if ( empty( $image_url ) ) {
        $image_url = get_template_directory_uri() . '/assets/images/no-thumbnail.jpg';
    }
    ?>
    <div class="innovatorySocial-sharing">
        <span class="labeTitle pull-left">Share</span>
        <ul class="social-icons social-icons-simple pull-left">
            <li class="innovatoryfacebook"><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Facebook', 'dayneo' ); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo esc_attr( $post->post_title ); ?>"><i class="fa fa-facebook"></i></a></li>
            <li class="innovatorytwitter"><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Twitter', 'dayneo' ); ?>" target="_blank" href="http://twitter.com/intent/tweet?status=<?php echo esc_attr( $post->post_title ); ?>+&raquo;+<?php echo esc_url( dayneo_tinyurl( get_permalink() ) ); ?>"><i class="fa fa-twitter"></i></a></li>        
            <li class="innovatorygoogleplus"><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Google Plus', 'dayneo' ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
            <li class="innovatorypinterest"> <a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Pinterest', 'dayneo' ); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_attr( $image_url ); ?>&description=<?php echo esc_attr( $post->post_title ); ?>"><i class="fa fa-pinterest"></i></a></li>                  
            <li class="innovatorymore"><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'More options', 'dayneo' ); ?>" target="_blank" href="http://www.addtoany.com/share_save#url=<?php the_permalink(); ?>&linkname=<?php echo esc_attr( $post->post_title ); ?>"><i class="ti-plus"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php
}

add_action( 'wp_ajax_martfury_product_quick_view', 'product_quick_view' );
add_action( 'wp_ajax_nopriv_martfury_product_quick_view', 'product_quick_view' );

/**
 * product_quick_view
 */
function product_quick_view() {
//		if ( apply_filters( 'martfury_check_ajax_referer', true ) ) {
//			check_ajax_referer( '_martfury_nonce', 'nonce' );
//		}
    ob_start();
    if ( isset( $_POST[ 'product_id' ] ) && ! empty( $_POST[ 'product_id' ] ) ) {
        $product_id      = $_POST[ 'product_id' ];
        $original_post   = $GLOBALS[ 'post' ];
        $GLOBALS[ 'post' ] = get_post( $product_id ); // WPCS: override ok.
        setup_postdata( $GLOBALS[ 'post' ] );
        wc_get_template_part( 'content', 'product-quick-view' );
        $GLOBALS[ 'post' ] = $original_post; // WPCS: override ok.
    }
    $output = ob_get_clean();
    wp_send_json_success( $output );
    die();
}

// QuicKview
add_action( 'martfury_single_product_summary', 'get_product_quick_view_header', 5 );

/**
 * Add single product header
 */
function get_product_quick_view_header() {
    global $product;
    ?>

    <div class="mf-entry-product-header">
        <div class="entry-left">
    <?php
    echo sprintf( '<h2 class="product_title"><a href="%s">%s</a></h2>', esc_url( $product->get_permalink() ), $product->get_title() );
    ?>

            <ul class="entry-meta">
            <?php
            $this->single_product_brand();

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
            add_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
            add_action( 'yith_wcqv_product_image', 'woocommerce_show_product_images', 20 );

            // Summary
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_rating', 10 );
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_price', 15 );
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_excerpt', 20 );
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
            add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
            add_action( 'yith_wcqv_product_summary', 'dayneo_product_share', 35 );

            // Add product thumbnail
            add_action( 'woocommerce_after_shop_loop_item', 'product_content_thumbnail' );

            /**
             * WooCommerce Loop Product Content Thumbs
             *
             * @since  1.0
             *
             * @return string
             */
            function product_content_thumbnail() {
                global $product;

                echo '<div class="action-btn quick-view-warp">';

                echo '<a href="' . $product->get_permalink() . '" data-id="' . esc_attr( $product->get_id() ) . '"  class="button yith-wcqv-button mf-product-quick-view"></a>';

                echo '</div>';

                if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                }

                product_compare();
            }

            /**
             * WooCommerce product compare
             *
             * @since  1.0
             *
             * @return string
             */
            function product_compare() {
                global $product;

                if ( ! class_exists( 'YITH_Woocompare' ) ) {
                    return;
                }

                $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'martfury' ) );
                $product_id  = $product->get_id();
                $url_args    = array(
                    'action' => 'yith-woocompare-add-product',
                    'id'     => $product_id,
                );
                $lang        = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
                if ( $lang ) {
                    $url_args[ 'lang' ] = $lang;
                }

                $css_class   = 'compare button';
                $cookie_name = 'yith_woocompare_list';
                if ( function_exists( 'is_multisite' ) && is_multisite() ) {
                    $cookie_name .= '_' . get_current_blog_id();
                }
                $the_list = isset( $_COOKIE[ $cookie_name ] ) ? json_decode( $_COOKIE[ $cookie_name ] ) : array();
                if ( in_array( $product_id, $the_list ) ) {
                    $css_class          .= ' added';
                    $url_args[ 'action' ] = 'yith-woocompare-view-table';
                    $button_text        = apply_filters( 'yith_woocompare_compare_added_label', esc_html__( 'Added', 'martfury' ) );
                }

                $url = esc_url_raw( add_query_arg( $url_args, site_url() ) );
                //echo '<div class="action-btn compare-warp">';
                printf( '<a href="%s" class="%s" title="%s" data-product_id="%d">%s</a>', esc_url( $url ), esc_attr( $css_class ), esc_html( $button_text ), $product_id, $button_text );
                //echo '</div>';
            }
            