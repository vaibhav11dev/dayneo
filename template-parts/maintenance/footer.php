<?php
/**
 * The template for displaying the footer
 *
 */
?>
	</div><!-- #content .wrapper -->
	
        <div class="copyright">	
            <div class="container"><!-- .container fluid -->
                <div class="row footer-payment">
                    <div class="col-md-12 footer-pay-p">
                        <?php
                        $ved_footer_content = bigbo_get_option( 'ved_footer_content', '' );
                        echo wp_kses_post( $ved_footer_content );
                        ?>
                    </div>
                </div><!-- .row -->
            </div>
        </div>
	
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>