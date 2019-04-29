<div class="woocommerce xs-modal xs-modal-quick-view xs-quick-view-modal-<?php echo esc_attr($rand_quick); ?> modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="icon icon-cross"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images">
                            <?php 
                            if(is_shop() ||  is_product_category() ):
                                if(has_post_thumbnail()):
                                    echo the_post_thumbnail( 'full' );;
                                endif;
                            ?>
                        <?php else: ?>
                            <?php if(!empty( $img_full)): ?>
                                <img src="<?php echo esc_url( $img_full); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary-content entry-summary">
                            <?php do_action( 'woocommerce_single_product_summary' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- end quickView --><!-- end today gadget section -->