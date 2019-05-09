<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $dd_options;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$dd_woocommerce_layout = $dd_options[ 'dd_woocommerce_layout' ];
$woo_product_layout    = (12 / $dd_woocommerce_layout);

$shop_col_class = '';
if ( is_product() && $woocommerce_loop[ 'name' ] == 'related' ) {
    $shop_col_class = 'col-sm-6 col-md-3 col-lg-3';
} elseif ( $woocommerce_loop[ 'is_shortcode' ] == 'yes' ) {
    $woo_product_layout = (12 / $woocommerce_loop[ 'columns' ]);
    $shop_col_class     = 'col-sm-4 col-md-4 col-lg-' . $woo_product_layout . '';
} else {
    $shop_col_class = 'col-sm-4 col-md-4 col-lg-' . $woo_product_layout . '';
}
?>
<!-- SHOP ITEM -->
<div class="<?php echo esc_attr( $shop_col_class ); ?>">
    <div class="shop-item">
        <div <?php post_class(); ?>>
            <?php
            /**
             * woocommerce_before_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            //do_action( 'woocommerce_before_shop_loop_item' );
            ?>
            <div class="shop-item-photo">
                <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

                echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
                do_action( 'woocommerce_before_shop_loop_item_title' );
                echo '</a>';
                
                
                ?>

                <div class="shop-item-tools product-grid-meta-options">
                    <?php 
                        do_action( 'woocommerce_after_shop_loop_item' );
                    ?>
                </div>

            </div>
            <div class="shop-item-title">
                <?php
                if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                    $average	 = $product->get_average_rating();
                    echo '<span class="woo-star-rating woo-star-rating-' . intval( $average ) . '"></span>';
                }

                /**
                 * woocommerce_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );

                /**
                 * woocommerce_after_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
                do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
                
                <div class="short_description">
                    <p><?php echo $product->short_description; ?></p>
                </div>

                <div class="shop-item-tools product-list-meta-options">
                    <?php do_action( 'woocommerce_after_shop_loop_item' ) ?>
                </div>

            </div>
            <?php
            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
            ?>
        </div>
    </div>
</div>
<!-- END SHOP ITEM -->
