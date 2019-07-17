<?php
$ved_show_sticky_header_cart = bigbo_get_option( 'ved_show_sticky_header_cart' );
$ved_show_sticky_header_compare = bigbo_get_option( 'ved_show_sticky_header_compare' );
$ved_show_sticky_header_wishlist = bigbo_get_option( 'ved_show_sticky_header_wishlist' );
?>

<div id="header-sticky-wrapper" class="sticky-wrapper">
    <div class="header-sticky header-sticky-desktop-on header-sticky-mobile-on">
        <div class="container">
            <div class="row">
                <div class="header-row">
                    <div class="header-logo col-lg-3 col-md-3 col-sm-3">
                        <div class="d-logo">
                            <!-- YOUR LOGO HERE -->
                            <div class="inner-header site-identity">
                                <?php
                                $ved_header_logo               = bigbo_get_option( 'ved_header_logo', '' );
                                $ved_header_logo_retina        = bigbo_get_option( 'ved_header_logo_retina', '' );
                                $ved_header_logo_retina_width  = bigbo_get_option( 'ved_header_logo_retina_width', '' );
                                $ved_header_logo_retina_height = bigbo_get_option( 'ved_header_logo_retina_height', '' );
                                if ( $ved_header_logo != '' || $ved_header_logo_retina != '' ) {
                                    ?>
                                    <a class="inner-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <?php
                                       if ( $ved_header_logo != '' ):
                                            ?>
                                            <img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo); ?>">
                                            <?php
                                        endif;
                                        if ( $ved_header_logo_retina != "" && $ved_header_logo_retina_width != "" && $ved_header_logo_retina_height != "" ):
                                            $pixels = "";
                                            if ( is_numeric( $ved_header_logo_retina_width ) && is_numeric( $ved_header_logo_retina_height ) ):
                                                $pixels = "px";
                                            endif;
                                            ?>
                                            <img class="retina-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo_retina); ?>" style="width:<?php echo esc_attr($ved_header_logo_retina_width . $pixels); ?>;max-height:<?php echo esc_attr($ved_header_logo_retina_height . $pixels); ?>;" />
                                            <?php
                                        endif;
                                        ?>
                                    </a>
                                    <?php
                                } else {
                                    $ved_blog_title   = bigbo_get_option( 'ved_blog_title', '0' );
                                    $ved_blog_tagline = bigbo_get_option( 'ved_blog_tagline', '0' );
                                    if ( $ved_blog_title == 1 ) {
                                        ?>
                                        <div id="blog-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ) ?></a></div> 
                                        <?php
                                    }
                                    if ( $ved_blog_tagline == 1 ) {
                                        ?>
                                        <div id="tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
                                        <?php
                                    }
                                }
                                ?>         
                            </div>
                        </div>
                    </div>
					<div class="col-lg-9 col-md-9 col-sm-9 fix-header-right">							
						<div class="sticky-menu col-sm-10">
								<?php 
									bigbo_header_menu(); 
								?>
						</div>
                        <div class="extras-menu col-sm-2">
                                <?php
                                if ( $ved_show_sticky_header_wishlist ) {
                                    bigbo_topbar_wishlist();
                                }
                                if ( $ved_show_sticky_header_compare ) {
                                    bigbo_topbar_compare();
                                }
                                if ( $ved_show_sticky_header_cart ) {
                                    bigbo_header_cart();
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--mobile-header-->
<div class="mobile-menu mobile-fix-menu hidden-lg">
    <div class="container">
        <div class="mobile-logo-bar">
            <div id="menu-icon" class="menu-icon"><i class="ti-menu"></i></div>
            <div id="_mobile_fix_logo">
                <div class="inner-header site-identity">
                    <?php
                    $ved_header_logo               = bigbo_get_option( 'ved_header_logo', '' );
                    $ved_header_logo_retina        = bigbo_get_option( 'ved_header_logo_retina', '' );
                    $ved_header_logo_retina_width  = bigbo_get_option( 'ved_header_logo_retina_width', '' );
                    $ved_header_logo_retina_height = bigbo_get_option( 'ved_header_logo_retina_height', '' );
                    if ( $ved_header_logo != '' || $ved_header_logo_retina != '' ) {
                        ?>
                        <a class="inner-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php
                           if ( $ved_header_logo != '' ):
                                ?>
                                <img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo); ?>">
                                <?php
                            endif;
                            if ( $ved_header_logo_retina != "" && $ved_header_logo_retina_width != "" && $ved_header_logo_retina_height != "" ):
                                $pixels = "";
                                if ( is_numeric( $ved_header_logo_retina_width ) && is_numeric( $ved_header_logo_retina_height ) ):
                                    $pixels = "px";
                                endif;
                                ?>
                                <img class="retina-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo_retina); ?>" style="width:<?php echo esc_attr($ved_header_logo_retina_width . $pixels); ?>;max-height:<?php echo esc_attr($ved_header_logo_retina_height . $pixels); ?>;" />
                                <?php
                            endif;
                            ?>
                        </a>
                        <?php
                    } else {
                        $ved_blog_title   = bigbo_get_option( 'ved_blog_title', '0' );
                        $ved_blog_tagline = bigbo_get_option( 'ved_blog_tagline', '0' );
                        if ( $ved_blog_title == 1 ) {
                            ?>
                            <div id="blog-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ) ?></a></div> 
                            <?php
                        }
                        if ( $ved_blog_tagline == 1 ) {
                            ?>
                            <div id="tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
                            <?php
                        }
                    }
                    ?>         
                </div>
            </div>
            <div id="_mobile_fix_cart">
                <?php
                if ( $ved_show_sticky_header_cart ) {
                    bigbo_header_cart();
                }
                ?>
            </div>
        </div>
    </div>
</div>