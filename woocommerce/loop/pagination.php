<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */
global $ved_options, $wp_query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

$product_pagination = isset( $ved_options['ved_product_pagination'] ) ?  $ved_options['ved_product_pagination'] : '';

if( !empty($product_pagination) && ( $product_pagination == 'load_more' || $product_pagination == 'infinite_scroll' )){

	$load_more_button_style = ( $product_pagination == 'infinite_scroll' ) ? 'pointer-events: none; cursor: default;' : '';
	
	$max_pages 	  = $wp_query->max_num_pages;
	$current_page = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
	$next_link    = next_posts($max_pages, false);
	$next_page    = !empty($next_link) ? $current_page + 1 : '';
	
	?>
	<div class="product-more-button">
		<?php 
			if(!empty($next_page)){
			?>
			<a href="#" style="<?php echo esc_attr( $load_more_button_style );?>" 
				data-max_pages="<?php echo esc_attr($max_pages);?>" 
				data-current_page="<?php echo esc_attr($current_page);?>" 
				data-next_page="<?php echo esc_attr($next_page);?>" 
				data-next_link="<?php echo esc_attr($next_link);?>">
				<?php esc_html_e('Load more...','bigbo' );?></a>
			<?php
		}
		?>
	</div>
	<?php
}else{
	?>
	<nav class="woocommerce-pagination">
		<?php
			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
				'base'         => $base,
				'format'       => $format,
				'add_args'     => false,
				'current'      => max( 1, $current ),
				'total'        => $total,
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3,
			) ) );
		?>
	</nav>
	<?php
}
?>
