<?php
/**
 * Template part for displaying mobile header
 *
 *
 * @package bigbo
 */

$ved_show_header_wishlist = bigbo_get_option( 'ved_show_header_wishlist' );
$ved_show_header_compare = bigbo_get_option( 'ved_show_header_compare' );
?>
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
    <div id="_mobile_user_info"><?php bigbo_topbar_my_account(); ?></div>
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
                <?php if ( $ved_show_header_wishlist ) { ?>
                <div id="_mobile_wishtlistTop" class="col-xs-6 meta-menu-wrap"></div> 
                <?php } if ( $ved_show_header_compare ) { ?>
                <div id="_mobile_compareTop" class="col-xs-6 meta-menu-wrap"></div> 
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>