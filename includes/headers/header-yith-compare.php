<?php
        if ( ! class_exists( 'YITH_Woocompare' ) ) {
            return '';
        }


        global $yith_woocompare;

        $count = $yith_woocompare->obj->products_list;

?>
<div class="extra-menu-item menu-item-compare menu-item-yith">
    <a class="yith-contents yith-woocompare-open" href="#">
        <div class="icon-wrap">
            <span class="icon-box">			
                <?php echo esc_html_e( 'Compare', 'dayneo' ); ?>
                <span class="mini-item-counter" id="mini-compare-counter">
                    <?php echo sizeof( $count ); ?>
                </span>
            </span>
        </div>
    </a>
</div>
