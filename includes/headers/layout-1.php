<?php
$css_header_menu = 'col-md-9 col-sm-9';
$show_department = true;
$extras          = martfury_menu_extras();
if ( empty( $extras ) || ! $extras['department'] ) {
    $show_department = false;
    $css_header_menu = 'col-md-12 col-sm-12';
}
?>

<div class="header-main-wapper">
    <div class="header-main">
        <div class="container">
            <div class="row header-row">
                <div class="header-logo col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="d-logo">
                        <!-- YOUR LOGO HERE -->
                        <div class="inner-header site-identity">
                            <?php
                            $dd_header_logo               = dayneo_get_option( 'dd_header_logo', '' );
                            $dd_header2_logo              = dayneo_get_option( 'dd_header2_logo', '' );
                            $dd_header_logo_retina        = dayneo_get_option( 'dd_header_logo_retina', '' );
                            $dd_header_logo_retina_width  = dayneo_get_option( 'dd_header_logo_retina_width', '' );
                            $dd_header_logo_retina_height = dayneo_get_option( 'dd_header_logo_retina_height', '' );
                            if ( $dd_header_logo != '' || $dd_header2_logo != '' || $dd_header_logo_retina != '' ) {
                                ?>
                                <a class="inner-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <?php
                                    if ( $dd_header2_logo != '' && ( ($dayneo_header_type == 'h2') || ($dayneo_header_type == 'default' && $dd_header_type == 'h2') ) ):
                                        ?>
                                        <img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $dd_header2_logo ?>" width="200">
                                        <?php
                                    elseif ( $dd_header_logo != '' ):
                                        ?>
                                        <img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $dd_header_logo ?>" width="200">
                                        <?php
                                    endif;
                                    if ( $dd_header_logo_retina != "" && $dd_header_logo_retina_width != "" && $dd_header_logo_retina_height != "" ):
                                        $pixels = "";
                                        if ( is_numeric( $dd_header_logo_retina_width ) && is_numeric( $dd_header_logo_retina_height ) ):
                                            $pixels = "px";
                                        endif;
                                        ?>
                                        <img class="retina-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $dd_header_logo_retina ?>" style="width:<?php echo $dd_header_logo_retina_width . $pixels ?>;max-height:<?php echo $dd_header_logo_retina_height . $pixels ?>;" />
                                        <?php
                                    endif;
                                    ?>
                                </a>
                                <?php
                            } else {
                                $dd_blog_title   = dayneo_get_option( 'dd_blog_title', '0' );
                                $dd_blog_tagline = dayneo_get_option( 'dd_blog_tagline', '0' );
                                if ( $dd_blog_title == 1 ) {
                                    ?>
                                    <div id="blog-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ) ?></a></div> 
                                    <?php
                                }
                                if ( $dd_blog_tagline == 1 ) {
                                    ?>
                                    <div id="tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
                                    <?php
                                }
                            }
                            ?>         
                        </div>
                    </div>

                </div>
                <div class="header-extras col-lg-9 col-md-6 col-sm-6 col-xs-6">
                    <?php martfury_extra_search(); ?>
                    <ul class="extras-menu">
                        <?php
                        martfury_extra_hotline();
                        martfury_extra_compare();
                        martfury_extra_wislist();
                        martfury_extra_cart();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-menu hidden-md hidden-xs hidden-sm">
    <div class="container">
        <div class="row header-row">
            <?php if ( $show_department ) : ?>
                <div class="col-md-3 col-sm-3 i-product-cats mr-extra-department">
                    <?php martfury_extra_department(); ?>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr( $css_header_menu ); ?> mr-header-menu">
                <div class="col-header-menu">
                    <?php martfury_header_menu(); ?>
                    <?php martfury_header_bar(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mobile-menu hidden-lg">
    <div class="container">
        <div class="mobile-menu-row">
            <a class="mf-toggle-menu" id="mf-toggle-menu" href="#">
                <i class="icon-menu"></i>
            </a>
            <?php martfury_extra_search( false ); ?>
        </div>
    </div>
</div>



