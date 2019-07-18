<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .wrapper div and all content after.
 *
 *
 * @package bigbo
 */
$ved_footer_widget_col = bigbo_get_option( 'ved_footer_widget_col', 'disable' );
if ( ($ved_footer_widget_col != "") || ($ved_footer_widget_col != "disable") ) {
    $bigbo_footer_css = '';
    if ( $ved_footer_widget_col == "one" ) {
        $bigbo_footer_css = 'col-md-12';
    }
    if ( $ved_footer_widget_col == "two" ) {
        $bigbo_footer_css = 'col-md-6';
    }
    if ( $ved_footer_widget_col == "three" ) {
        $bigbo_footer_css = 'col-md-4';
    }
    if ( $ved_footer_widget_col == "four" ) {
        $bigbo_footer_css = 'col-md-3';
    }
}

$ved_footer_parallax = bigbo_get_option( 'ved_footer_parallax', '' );
$foo_class          = '';
if ( $ved_footer_parallax == 1 ) {
    $foo_class = 'bg-black-alfa-80';
}
?>
<!-- FOOTER -->
<footer id="footer" class="footer <?php echo esc_attr( $foo_class ); ?>">
    <div class="footer-bg-black">
        <?php if ( ($ved_footer_widget_col != "disable" ) ) { ?>
            <div class="container">
                <div class="before-footer">
                    <?php
                    if ( is_active_sidebar( 'before-footer' ) ) :
                        dynamic_sidebar( 'before-footer' );
                    endif;
                    ?>
                </div>
                <div class="footer-center row">
                    <div class="<?php echo esc_attr( $bigbo_footer_css ); ?>">
                        <?php
                        if ( is_active_sidebar( 'footer-1' ) ) :
                            dynamic_sidebar( 'footer-1' );
                        endif;
                        ?>
                    </div>
                    <?php if ( $ved_footer_widget_col != "one" ) { ?>
                        <div class="<?php echo esc_attr( $bigbo_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-2' ) ) :
                                dynamic_sidebar( 'footer-2' );
                            endif;
                            ?>
                        </div>
                    <?php } if ( $ved_footer_widget_col != "one" && $ved_footer_widget_col != "two" ) { ?>
                        <div class="<?php echo esc_attr( $bigbo_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-3' ) ) :
                                dynamic_sidebar( 'footer-3' );
                            endif;
                            ?>
                        </div>
                    <?php } if ( $ved_footer_widget_col != "one" && $ved_footer_widget_col != "two" && $ved_footer_widget_col != "three" ) { ?>
                        <div class="<?php echo esc_attr( $bigbo_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-4' ) ) :
                                dynamic_sidebar( 'footer-4' );
                            endif;
                            ?>
                        </div>
                    <?php } ?>
                </div><!-- .row -->
                <div class="after-footer">
                    <?php
                    if ( is_active_sidebar( 'after-footer' ) ) :
                        dynamic_sidebar( 'after-footer' );
                    endif;
                    ?>
                </div>
            </div><!-- .container -->
        <?php } ?>
        <div class="copyright">	
            <div class="container"><!-- .container fluid -->
                <div class="row footer-payment">
                    <div class="col-xs-12 col-md-5 footer-pay-p">
                        <?php
                        $ved_footer_content = bigbo_get_option( 'ved_footer_content', '' );
                        echo wp_kses_post( $ved_footer_content );
                        ?>
                    </div>
                    <div class="col-xs-12 col-md-7 text-center">

                        <div id="paiement_logos" class="payment_logos_images">
                            <p class="payment-p"><?php echo esc_html_e( 'Payment acceptable on', 'bigbo' ); ?></p>
                            <?php
                            for ( $i = 1; $i <= 6; $i ++  ) {
                                $ved_footer_payment_icon = bigbo_get_option( 'ved_footer_payment_icon' . $i );
                                $ved_footer_payment_link = bigbo_get_option( 'ved_footer_payment_link' . $i );
                                if ( $ved_footer_payment_link ) :
                                    echo '<a href="' . esc_url( $ved_footer_payment_link ) . '"><img src="' . esc_url( $ved_footer_payment_icon['url'] ) . '" alt="payment_icon" width="40" height="25"></a>';
                                endif;
                            }
                            ?>
                        </div>

                    </div>
                </div><!-- .row -->
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

</div>
<!-- END WRAPPER -->

<?php wp_footer(); ?>

</body>
</html>
