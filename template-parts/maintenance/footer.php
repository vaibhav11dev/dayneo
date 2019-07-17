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

<?php if ( bigbo_get_option( 'ved_maintenance_mode' ) == 'comingsoon' ) { ?>
<script>
    jQuery("#DateCountdown").TimeCircles({
        "animation": "smooth",
        "bg_width": 0.2,
        "fg_width": 0.03,
        "circle_bg_color": "#666",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#222",
                "show": true
            },
            "Hours": {
                "text": "Hours",
                "color": "#222",
                "show": true
            },
            "Minutes": {
                "text": "Minutes",
                "color": "#222",
                "show": true
            },
            "Seconds": {
                "text": "Seconds",
                "color": "#222",
                "show": true
            }
        }
    });
</script>
<?php } ?>

</body>
</html>