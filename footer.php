<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .wrapper div and all content after.
 *
 *
 * @package dayneo
 */
$dd_footer_widget_col = dayneo_get_option( 'dd_footer_widget_col', 'disable' );
if ( ($dd_footer_widget_col != "") || ($dd_footer_widget_col != "disable") ) {
	$dayneo_footer_css = '';
	if ( $dd_footer_widget_col == "one" ) {
		$dayneo_footer_css = 'col-sm-12';
	}
	if ( $dd_footer_widget_col == "two" ) {
		$dayneo_footer_css = 'col-sm-6';
	}
	if ( $dd_footer_widget_col == "three" ) {
		$dayneo_footer_css = 'col-sm-4';
	}
	if ( $dd_footer_widget_col == "four" ) {
		$dayneo_footer_css = 'col-sm-3';
	}
}

$dd_footer_parallax	 = dayneo_get_option( 'dd_footer_parallax', '' );
$foo_class		 = '';
if ( $dd_footer_parallax == 1 ) {
	$foo_class = 'bg-black-alfa-80';
}
?>
<!-- FOOTER -->
<footer id="footer" class="footer <?php echo esc_attr($foo_class); ?>">
    <div class="footer-bg-black">
        <?php if ( ($dd_footer_widget_col != "disable" ) ) { ?>
            <div class="container">
                <div class="row padd-50">
                    <div class="<?php echo esc_attr($dayneo_footer_css); ?>">
                        <?php
                        if ( ! dynamic_sidebar( 'footer-1' ) ) :
                            //Do Nothing
                        endif;
                        ?>
                    </div>
                    <?php if ( $dd_footer_widget_col != "one" ) { ?>
                        <div class="<?php echo esc_attr($dayneo_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-2' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } if ( $dd_footer_widget_col != "one" && $dd_footer_widget_col != "two" ) { ?>
                        <div class="<?php echo esc_attr($dayneo_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-3' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } if ( $dd_footer_widget_col != "one" && $dd_footer_widget_col != "two" && $dd_footer_widget_col != "three" ) { ?>
                        <div class="<?php echo esc_attr($dayneo_footer_css); ?>">
                            <?php
                            if ( ! dynamic_sidebar( 'footer-4' ) ) :
                                //Do Nothing
                            endif;
                            ?>
                        </div>
                    <?php } ?>
                </div><!-- .row -->
            </div><!-- .container -->
        <?php } ?>
        <div class="copyright">	
            <div class="container-fluid"><!-- .container fluid -->
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        $dd_footer_content = dayneo_get_option( 'dd_footer_content', '' );
                        echo wp_kses_post( $dd_footer_content );
                        ?>
                    </div>
                </div><!-- .row -->
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

</div>
<!-- END WRAPPER -->

<?php
wp_footer();
?>

</body>
</html>
