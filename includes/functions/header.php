<?php
/**
 * Custom functions for header-6.
 *
 * @package Dayneo
 */
/**
 * Get Menu extra cart
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_extra_cart' ) ) :

    function dayneo_extra_cart() {
        $extras = dayneo_menu_extras();

        if ( empty( $extras ) || ! $extras[ 'cart' ] ) {
            return;
        }
        ?>
        <!-- SHOP CART -->
        <?php
        $dd_woo_cart = dayneo_get_option( 'dd_woo_cart', 1 );
        if ( class_exists( 'Woocommerce' ) && $dd_woo_cart ) {
            global $woocommerce;
            ?>
            <li class="cart-hover">
                <div class="menu-item header-ajax-cart">
                    <a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" id="open-cart">
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
                    </a>
                </div>
                <?php
                //Empty Cart
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
                        <div class="product-list-sec">
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
                                            <p><span class="quantity"><?php echo $cart_item[ 'quantity' ]; ?> x </span><span class="price"><?php echo get_woocommerce_currency_symbol() . $cart_item[ 'data' ]->get_price(); ?></span></p>
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
                                    <?php echo wc_price( $woocommerce->cart->shipping_total ); ?>
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
                    </div>
                    <?php
                }
                ?>

            </li>

            <?php
        }
        ?>
        <!-- END SHOP CART -->
        <?php
    }

endif;

/**
 * Get Menu extra search
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_extra_search' ) ) :

    function dayneo_extra_search( $show_cat = true ) {
        $extras = dayneo_menu_extras();
        $items  = '';

        if ( empty( $extras ) || ! $extras[ 'search' ] ) {
            return $items;
        }

        $cats_text   = dayneo_get_option( 'custom_categories_text' );
        $search_text = dayneo_get_option( 'custom_search_text' );
        $button_text = dayneo_get_option( 'custom_search_button' );
        $search_type = dayneo_get_option( 'search_content_type' );

        if ( $search_type == 'all' ) {
            $show_cat = false;
        }


        $cat = '';
        if ( taxonomy_exists( 'product_cat' ) && $show_cat ) {

            $depth = 0;
            if ( intval( dayneo_get_option( 'custom_categories_depth' ) ) > 0 ) {
                $depth = intval( dayneo_get_option( 'custom_categories_depth' ) );
            }

            $args = array(
                'name'            => 'product_cat',
                'taxonomy'        => 'product_cat',
                'orderby'         => 'NAME',
                'hierarchical'    => 1,
                'hide_empty'      => 1,
                'echo'            => 0,
                'value_field'     => 'slug',
                'class'           => 'product-cat-dd',
                'show_option_all' => esc_html( $cats_text ),
                'depth'           => $depth
            );

            $cat_include = dayneo_get_option( 'custom_categories_include' );
            if ( ! empty( $cat_include ) ) {
                $cat_include       = explode( ',', $cat_include );
                $args[ 'include' ] = $cat_include;
            }

            $cat_exclude = dayneo_get_option( 'custom_categories_exclude' );
            if ( ! empty( $cat_exclude ) ) {
                $cat_exclude       = explode( ',', $cat_exclude );
                $args[ 'exclude' ] = $cat_exclude;
            }

            $cat = wp_dropdown_categories( $args );
        }
        $item_class     = empty( $cat ) ? 'no-cats' : '';
        $post_type_html = '';
        if ( $search_type == 'product' ) {
            $post_type_html = '<input type="hidden" name="post_type" value="product">';
        }
        $words_html = array();

        if ( intval( dayneo_get_option( 'header_hot_words_enable' ) ) ) {
            $hot_words = dayneo_get_option( 'header_hot_words' );
            if ( $hot_words ) {
                $words_html[] = '<ul class="hot-words">';
                foreach ( $hot_words as $word ) {
                    if ( isset( $word[ 'text' ] ) && ! empty( $word[ 'text' ] ) ) {
                        $words_html[] = sprintf( '<li><a href="%s">%s</a></li>', esc_url( $word[ 'link' ] ), $word[ 'text' ] );
                    }
                }
                $words_html[] = '</ul>';
            }
        }

        $lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
        if ( $lang ) {
            $post_type_html .= '<input type="hidden" name="lang" value="' . $lang . '"/>';
        }
        if(isset($button_text) && $button_text){ 
            $search_icon = wp_kses( $button_text, wp_kses_allowed_html( 'post' ) );
        } else {
            $search_icon = "<i class='flaticon-search'></i>";
        }
        $items .= sprintf(
        '<div class="top-search-wrap"><div class="product-extra-search">
                <form class="products-search" method="get" action="%s">
                    <div class="psearch-content">
			<div class="search-wrapper">
                            <input type="text" name="s"  class="search-field" autocomplete="off" placeholder="%s">
                            %s
                            
                        </div>
                        <div class="product-cat"><div class="product-cat-label %s">%s</div> %s</div>			    <button type="submit" class="search-submit">%s</button>
                    </div>
                </form>
                %s
		</div>
                <div class="ajax-search-results woocommerce"></div>
                <div class="search-limit"><p class="limit">Number of characters at least are 3</p></div></div>', esc_url( home_url( '/' ) ), esc_html( $search_text ), $post_type_html, esc_attr( $item_class ), esc_html( $cats_text ), $cat, $search_icon, implode( ' ', $words_html )
        );

        echo $items;
    }

endif;

/**
 * Get header menu
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_header_menu' ) ) :

    function dayneo_header_menu() {
        if ( ! has_nav_menu( 'primary-menu' ) ) {
            return;
        }
        ?>
        <div class="primary-nav nav">
            <?php
            wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-main-megamenu ved-navbar-nav main-nav collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new VedCoreFrontendWalker() ) );
            ?>
        </div>
        <?php
    }

endif;

/**
 * Get header bar
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_header_bar' ) ) :

    function dayneo_header_bar() {
        $extras = dayneo_menu_extras();

        if ( empty( $extras ) || ! $extras[ 'headerbar' ] ) {
            return;
        }
        ?>
        <div class="header-bar topbar">
            <?php
            $sidebar = 'headerbar';
            if ( is_active_sidebar( $sidebar ) ) {
                dynamic_sidebar( $sidebar );
            }
            ?>
        </div>
        <?php
    }

endif;

/**
 * Get header exrta department
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_extra_department' ) ) :

    function dayneo_extra_department( $dep_close = false, $id = '' ) {
        $extras = dayneo_menu_extras();

        if ( empty( $extras ) || ! $extras[ 'department' ] ) {
            return;
        }

        if ( ! has_nav_menu( 'department-menu' ) ) {
            return;
        }

        $dep_text = '<i class="icon-menu"><span class="s-space"></span></i>';
        $dep_tit = dayneo_get_option( 'dd_vmenu_title' );
        if ( ! empty( $dep_tit ) ) {
            $dep_text .= '<span class="text">' . $dep_tit . '</span>';
        } else {
            $dep_text .= '<span class="text">' . 'Categories' . '</span>';
        }

        $dep_open = '';

        if ( in_array( dayneo_get_option( 'dd_header_type' ), array(
            '1',
            '2',
            '7',
            '3',
        ) ) && ! $dep_close && dayneo_is_homepage() ) {
            //$dep_open = dayneo_get_option( 'department_open_homepage' );
        }
        $cat_style = '';
        if ( in_array( dayneo_get_option( 'dd_header_type' ), array( '2', '3' ) ) ) {
            //$space = dayneo_get_option( 'department_space_homepage' );
            $space = '40px';
            if ( dayneo_is_homepage() && $space ) {
                $cat_style = sprintf( 'style=padding-top:%s', esc_attr( $space ) );
            }
        }
        ?>
        <div class="products-cats-menu <?php echo esc_attr( $dep_open ); ?>">
            <h2 class="cats-menu-title"><?php echo wp_kses( $dep_text, wp_kses_allowed_html( 'post' ) ); ?></h2>

            <div class="toggle-product-cats nav" <?php echo esc_attr( $cat_style ); ?>>
                <?php wp_nav_menu( array( 'theme_location' => 'department-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-navbar-nav main-nav vertical-megamenu collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new VedCoreFrontendWalker() ) ); ?>
            </div>
        </div>
        <?php
    }

endif;

/**
 * Get menu extra
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'dayneo_menu_extras' ) ) :

    function dayneo_menu_extras() {
        $menu_extras = dayneo_get_option( 'menu_extras' );

        return $menu_extras;
    }





endif;

