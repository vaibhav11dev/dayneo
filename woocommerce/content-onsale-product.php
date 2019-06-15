<?php
/**
 * Product Card View
 *
 * @package Electro/WooCommerce
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<div class="onsale-product">
	<div class="shop-item-photo">
		<?php do_action( 'bigbo_onsale_product_photo', $product ); ?>
	</div>
	<div class="shop-item-title">
		<?php do_action( 'bigbo_onsale_product_title', $product ); ?>
	</div>
</div>