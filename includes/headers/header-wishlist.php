<?php
if ( ! function_exists( 'YITH_WCWL' ) ) {
    return '';
}

$count = YITH_WCWL()->count_products();
?>
<div id="_desktop_wishtlistTop" class="extra-menu-item menu-item-wishlist menu-item-yith">    			    
    <a class="yith-contents" id="icon-wishlist-contents" href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ) ?>">
        <span><?php echo esc_html_e( 'Wishlist', 'dayneo' ); ?></span>
        <span class="mini-item-counter"><?php echo intval( $count ); ?></span>
    </a>
</div>
