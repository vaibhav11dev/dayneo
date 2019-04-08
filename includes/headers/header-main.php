<?php
/**
 * Template part for displaying headerbar
 *
 *
 * @package daydream
 */
global $post, $wp_query, $dd_options;

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( is_buddypress() ) {
    $post_id = restora_bp_get_id();
} elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
    $post_id = wc_get_page_id('shop');
} else {
    $post_id = isset( $post->ID ) ? $post->ID : '';
}

$dd_header_type       = daydream_get_option( 'dd_header_type', 'h1' );
$daydream_header_type = get_post_meta( $post_id, 'daydream_header_type', true );
if ( is_page() ) {
    if ( ($daydream_header_type == 'h2') || ($daydream_header_type == 'default' && $dd_header_type == 'h2') ) {
        $header_class = 'header-fixed header-transparent';
    } else {
        $header_class = 'js-stick';
    }
} else {
    if ( $dd_header_type == 'h2' ) {
        $header_class = 'header-fixed header-transparent';
    } else {
        $header_class = 'js-stick';
    }
}
?>
<!-- HEADER STICKY TOP -->
<header class="header <?php echo esc_attr( $header_class ); ?>">
    <div class="container">

        <!-- YOUR LOGO HERE -->
        <div class="inner-header site-identity">
            <?php
            $dd_header_logo               = daydream_get_option( 'dd_header_logo', '' );
            $dd_header2_logo              = daydream_get_option( 'dd_header2_logo', '' );
            $dd_header_logo_retina        = daydream_get_option( 'dd_header_logo_retina', '' );
            $dd_header_logo_retina_width  = daydream_get_option( 'dd_header_logo_retina_width', '' );
            $dd_header_logo_retina_height = daydream_get_option( 'dd_header_logo_retina_height', '' );
            if ( $dd_header_logo != '' || $dd_header2_logo != '' || $dd_header_logo_retina != '' ) {
                ?>
                <a class="inner-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                    if ( $dd_header2_logo != '' && ( ($daydream_header_type == 'h2') || ($daydream_header_type == 'default' && $dd_header_type == 'h2') ) ):
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
                $dd_blog_title   = daydream_get_option( 'dd_blog_title', '0' );
                $dd_blog_tagline = daydream_get_option( 'dd_blog_tagline', '0' );
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

        <?php if ( $dd_options[ 'dd_mobile_menu' ] == 1 ): ?>
            <!-- OPEN MOBILE MENU -->
            <div class="main-nav-toggle">
                <div class="nav-icon-toggle" data-toggle="collapse" data-target="#custom-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>
        <?php endif ?>

        <?php if ( ($dd_options[ 'dd_woo_cart' ] == 1) || ($dd_options[ 'dd_searchbox' ] == 1) ): ?>
            <!-- WIDGETS MENU -->
            <div class="inner-header pull-right">
                <div class="menu-extras clearfix">


                    <!-- SHOP CART -->
                    <?php
                    $dd_woo_cart = daydream_get_option( 'dd_woo_cart', 1 );
                    if ( class_exists( 'Woocommerce' ) && $dd_woo_cart ) {
                        global $woocommerce;
                        ?>
                        <div class="menu-item header-ajax-cart">
                            <div class="extras-cart">
                                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>" id="open-cart">
                                    <i class="icon-basket icons"></i>
                                    <span class="cart-badge"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- END SHOP CART -->

                    <!-- SEARCH -->
                    <?php
                    $dd_searchbox = daydream_get_option( 'dd_searchbox', '1' );
                    if ( $dd_searchbox == "1" ) {
                        ?>
                        <div class="menu-item hidden-xxs">
                            <div class="extras-search">
                                <a id="modal-search" href="#"><i class="icon-magnifier icons"></i></a>
                                    <?php get_search_form(); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- END SEARCH -->

                </div>
            </div>
        <?php endif ?>

        <!-- MAIN MENU -->
        <?php
        if ( $dd_options[ 'dd_primary_menu' ] == 1 && has_nav_menu( 'primary-menu' ) ):
            $dd_megamenu = daydream_get_option( 'dd_megamenu', '0' );
            if ( $dd_megamenu == '1' ) {
                wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'inner-nav pull-right', 'container' => 'nav', 'container_class' => 'ved-main-megamenu ved-navbar-nav main-nav collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new VedCoreFrontendWalker() ) );
            } else {
                wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'inner-nav pull-right', 'container' => 'nav', 'container_class' => 'ved-main-simplemenu main-nav collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new Daydream_Walker_Nav_Menu() ) );
            }
        endif;
        ?>

    </div>
</header>
<!-- HEADER STICKY TOP -->