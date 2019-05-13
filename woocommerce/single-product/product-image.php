<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.5.1
 */
defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $post, $woocommerce, $product;

$attachment_count = count( $product->get_gallery_image_ids() );
$slider_class     = '';
if ( $attachment_count > 0 ) {
    $slider_class = 'slider-space';
}
?>

<!-- PRODUCT SLIDER -->
<div class="col-sm-6">
    <div class="product-slider <?php echo esc_attr( $slider_class ); ?>">
        <?php
        if ( $product->is_on_sale() ) :
            echo '<span class="onsale single-product">'.esc_html__( 'Sale!', 'dayneo' ).'</span>';
        endif;
        ?>
        <?php
        if ( has_post_thumbnail() ) {

            $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
            $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
            $image1       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title' => $image_title
            ) );
            $image2       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title' => $image_title
            ) );


            /**
             * From product-thumbnails.php
             */
            $attachment_ids = $product->get_gallery_image_ids();

            $loop1 = 0;
            $loop2 = 0;
            ?>
            <div class="slider slider-for">
                <?php

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slider-item-for">%s</div>', $image1 ), $post->ID );

                foreach ( $attachment_ids as $attachment_id ) {

                    $classes[] = 'image-' . $attachment_id;

                    $image_link = wp_get_attachment_url( $attachment_id );

                    if ( ! $image_link ) {
                        continue;
                    }

                    // modified image size to shop_single from thumbnail
                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( $attachment_id ) );

                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slider-item-for">%s</div>', $image ), $attachment_id, $post->ID, $image_class );

                    $loop1 ++;
                }
                ?>
            </div>
            <div class="slider slider-nav">
                <?php

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slider-item-nav">%s</div>', $image2 ), $post->ID );

                foreach ( $attachment_ids as $attachment_id ) {

                    $classes[] = 'image-' . $attachment_id;

                    $image_link = wp_get_attachment_url( $attachment_id );

                    if ( ! $image_link ) {
                        continue;
                    }

                    // modified image size to shop_single from thumbnail
                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( $attachment_id ) );

                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slider-item-nav">%s</div>', $image ), $attachment_id, $post->ID, $image_class );

                    $loop2 ++;
                }
                ?>
            </div>
            <?php
        } else {

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="single-item"><img src="%s" alt="Placeholder" /></div>', esc_url( wc_placeholder_img_src() ) ), $post->ID );
        }
        ?>
    </div>
</div>
<!-- END PRODUCT SLIDER -->
