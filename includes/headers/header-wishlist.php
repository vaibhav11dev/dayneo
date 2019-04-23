<?php
if ( ! function_exists( 'YITH_WCWL' ) ) {
    return '';
}

$count = YITH_WCWL()->count_products();
?>
<div class="extra-menu-item menu-item-wishlist menu-item-yith">    			    
    <a class="yith-contents" id="icon-wishlist-contents" href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ) ?>">
        <div class="icon-wrap">
            <span class="icon-box">
                <?php echo esc_html_e( 'Wishlist', 'dayneo' ); ?>
                <span class="mini-item-counter">
                    <?php echo intval( $count ); ?>
                </span>
            </span>
        </div>
    </a>
</div>
