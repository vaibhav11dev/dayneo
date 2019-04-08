<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .wrapper div and all content after.
 *
 *
 * @package daydream
 */
$dd_footer_widget_col = daydream_get_option( 'dd_footer_widget_col', 'disable' );
if ( ($dd_footer_widget_col != "") || ($dd_footer_widget_col != "disable") ) {
	$daydream_footer_css = '';
	if ( $dd_footer_widget_col == "one" ) {
		$daydream_footer_css = 'col-sm-12';
	}
	if ( $dd_footer_widget_col == "two" ) {
		$daydream_footer_css = 'col-sm-6';
	}
	if ( $dd_footer_widget_col == "three" ) {
		$daydream_footer_css = 'col-sm-4';
	}
	if ( $dd_footer_widget_col == "four" ) {
		$daydream_footer_css = 'col-sm-3';
	}
}

$dd_footer_parallax	 = daydream_get_option( 'dd_footer_parallax', '' );
$foo_class		 = '';
if ( $dd_footer_parallax == 1 ) {
	$foo_class = 'bg-black-alfa-80';
}
?>
<!-- FOOTER -->
<footer id="footer" class="footer <?php echo esc_attr($foo_class); ?>">
    <div class="footer-bg-black">
        <?php if ( ($dd_footer_widget_col != "disable" ) ) { ?>
            <div class="container">
                <div class="row padd-50">
                    <div class="<?php echo esc_attr($daydream_footer_css); ?>">
                        <?php
                        if ( ! dynamic_sidebar( 'footer-1' ) ) :
                            //Do Nothing
                        endif;
                        ?>
                    </div>
                    <?php if ( $dd_footer_widget_col != "one" ) { ?>
                        <div class="<?php echo esc_attr($daydream_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-2' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } if ( $dd_footer_widget_col != "one" && $dd_footer_widget_col != "two" ) { ?>
                        <div class="<?php echo esc_attr($daydream_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-3' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } if ( $dd_footer_widget_col != "one" && $dd_footer_widget_col != "two" && $dd_footer_widget_col != "three" ) { ?>
                        <div class="<?php echo esc_attr($daydream_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-4' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } ?>
                </div><!-- .row -->
            </div><!-- .container -->
        <?php } ?>
        <div class="copyright">	
            <div class="container-fluid"><!-- .container fluid -->
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        $dd_footer_content = daydream_get_option( 'dd_footer_content', '' );
                        echo wp_kses_post( $dd_footer_content );
                        ?>
                    </div>
                </div><!-- .row -->
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

</div>
<!-- END WRAPPER -->

<!-- SHOP CART -->
<?php
$dd_woocommerce_cart_link_main_nav = daydream_get_option( 'dd_woocommerce_cart_link_main_nav', '1' );
if ( class_exists( 'Woocommerce' ) && $dd_woocommerce_cart_link_main_nav ) {
	global $woocommerce;

	//Empty Cart
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

						<?php esc_html_e( 'Your cart is currently empty.', 'daydream' ); ?>

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
						foreach ( $woocommerce->cart->cart_contents as $cart_item ):
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
								<h4 class="m-0"><?php esc_html_e( 'Total:', 'daydream' ); ?></h4>
							</div>
							<div class="col-xs-6">
								<h4 class="m-0 text-right"><?php echo wc_price( $woocommerce->cart->cart_contents_total ); ?></h4>
							</div>
						</div>
					</div>

					<div class="off-canvas-cart-control">
						<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_checkout_page_id' ) )); ?>" class="btn btn-lg btn-block btn-outline btn-fade btn-round btn-dark"><?php esc_html_e( 'Checkout', 'daydream' ); ?></a>
						<a href="<?php echo esc_url(get_permalink( get_option( 'woocommerce_cart_page_id' ) )); ?>" class="btn btn-lg btn-block btn-round btn-base"><?php esc_html_e( 'Edit Cart', 'daydream' ); ?></a>
					</div>
				</div>

			</div>
		</div>
		<?php
	}
}
?>
<!-- END SHOP CART -->

<?php
wp_footer();
?>

</body>
</html>
