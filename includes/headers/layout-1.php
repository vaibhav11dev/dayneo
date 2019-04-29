<?php
$extras = dayneo_menu_extras();

$css_header_search      = 'col-md-6 col-sm-6';
$css_header_cart        = 'col-md-3 col-sm-3';
$css_header_menu        = 'col-md-9 col-sm-9';
$css_header_primarymenu = 'col-md-8 col-sm-8';
$css_header_headerbar   = 'col-md-4 col-sm-4';

$show_search     = true;
$show_cart       = true;
$show_department = true;
$show_headerbar  = true;

if ( empty( $extras ) || ! $extras[ 'search' ] ) {
    $show_search = false;
}
if ( empty( $extras ) || ! $extras[ 'cart' ] ) {
    $show_cart = false;
}
if ( empty( $extras ) || ! $extras[ 'department' ] ) {
    $show_department = false;
    $css_header_menu = 'col-md-12 col-sm-12';
}
if ( empty( $extras ) || ! $extras[ 'headerbar' ] ) {
    $show_headerbar         = false;
    $css_header_primarymenu = 'col-md-12 col-sm-12';
}
?>

<!--desktop-header-->
<div class="header-main-wapper hidden-md-down">
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="header-row">
                    <div class="header-logo col-md-3 col-sm-6">
                        <div id="_desktop_logo" class="d-logo">
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
                    <?php if ( $show_search ) : ?>
                        <div class="header-extras col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <?php dayneo_extra_search(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $show_cart ) : ?>
                        <div class="col-lg-3 col-md-3">
                            <div class="extras-menu">
                                <?php
                                dayneo_extra_cart();
                                ?>
                            </div>		    
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-menu hidden-md-down">
    <div class="container">
        <div class="row">
            <div class="header-row">
                <?php if ( $show_department ) : ?>
                    <div class="col-md-3 col-sm-3 i-product-cats dd-extra-department">
                        <?php dayneo_extra_department(); ?>
                    </div>
                <?php endif; ?>
                <div class="<?php echo esc_attr( $css_header_menu ); ?> dd-header-menu">
                    <div class="col-header-menu">
                        <div class="<?php echo esc_attr( $css_header_primarymenu ); ?>">
                            <?php dayneo_header_menu(); ?>
                        </div>
                        <?php if ( $show_headerbar ) : ?>
                            <div class="<?php echo esc_attr( $css_header_headerbar ); ?>">
                                <?php dayneo_header_bar(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--mobile-header-->
<div class="mobile-menu hidden-lg">
    <div class="container">
        <div class="mobile-logo-bar">
            <div id="menu-icon"><i class="ti-menu"></i></div>
            <div id="_mobile_logo"></div>
            <div id="_mobile_cart"></div>
        </div>
    </div>
    <div class="mobile-search-bar">
        <div class="container">
            <div id="_mobile_search" class="mobile-search"></div>
        </div>
    </div>
</div>

<!--mobile-sidebar-->
<div class="sidebar-overlay"></div>
<div id="mobile_top_menu_wrapper" class="hidden-lg-up">
    <a class="close-sidebar pull-right"><i class="ti-close"></i></a>
    <div id="_mobile_user_info"></div>
    <div class="js-top-menu-bottom">
        <div class="menu-horizontal">
            <h4 class="menu-tit"><i class="ti-menu"></i> Menu</h4>
            <div id="_mobile_menu"></div>
        </div>
        <div class="menu-vertical">
            <h4 class="menu-tit"><i class="ti-menu"></i> Category</h4>
            <div id="_mobile_vmenu"></div>
        </div>
        <div class="slidetoggle mobile-sidebar-meta mb-30">
            <h4 class="menu-tit slidetoggle-init"><i class="ti-settings"></i> Settings</h4>
            <div class="slidetoggle-menu">
                <div id="_mobile_wishtlistTop" class="col-xs-6 meta-menu-wrap"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>