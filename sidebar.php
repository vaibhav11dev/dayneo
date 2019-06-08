<?php
/**
 * The sidebar-1 containing the main widget area
 *
 *
 * @package bigbo
 */
$bigbo_sidebar_css = '';
if ( class_exists( 'Woocommerce' ) ) {
    if ( is_cart() || is_checkout() || is_account_page() || (get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) )) ) {
        $bigbo_sidebar_css = 'display:none';
    }
}
?>

<div id="secondary" class="aside sidebar <?php bigbo_sidebar_class(); ?>"
     <?php
     if ( class_exists( 'Woocommerce' ) ):
         echo 'style="' . esc_attr( $bigbo_sidebar_css ) . '"';
     endif;
     ?>>

    <?php
    /* Widgetized Area */
    if ( is_single() || is_page() || is_404() || is_search() || is_buddypress() ) {
        if ( is_bbpress() ) {
            if ( bigbo_get_option( 'ved_bbpress_global_sidebar', '0' ) == 1 ) {
                $ved_bbbress_sidebar = bigbo_get_option( 'ved_bbbress_sidebar', 'None' );
                restora_dynamic_sidebar( $ved_bbbress_sidebar );
            } else {
                restora_dynamic_sidebar();
            }
        } else {
            restora_dynamic_sidebar();
        }
    } elseif ( is_archive() || is_author() ) {
        if ( is_bbpress() ) {
            if ( bigbo_get_option( 'ved_bbpress_global_sidebar', '0' ) == 1 ) {
                $ved_bbbress_sidebar = bigbo_get_option( 'ved_bbbress_sidebar', 'None' );
                restora_dynamic_sidebar( $ved_bbbress_sidebar );
            } else {
                restora_dynamic_sidebar();
            }
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
                restora_dynamic_sidebar( );
        } else {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ( $term ) {
                $taxonomy = $term->taxonomy;
                if ( $taxonomy == 'portfolio_category' || $taxonomy == 'portfolio_skills' || $taxonomy == 'portfolio_tags' ) {
                    $ved_portfolio_sidebar = bigbo_get_option( 'ved_portfolio_sidebar', 'None' );
                    if ( $ved_portfolio_sidebar != '0' && is_active_sidebar( $ved_portfolio_sidebar ) ) {
                        restora_dynamic_sidebar( $ved_portfolio_sidebar );
                    }
                } else {
                    $ved_shop_archive_sidebar = bigbo_get_option( 'ved_shop_archive_sidebar', 'None' );
                    if ( $ved_shop_archive_sidebar != '0' && is_active_sidebar( $ved_shop_archive_sidebar ) ) {
                        restora_dynamic_sidebar( $ved_shop_archive_sidebar );
                    }
                }
            } else {
                $blog_archive_sidebar = bigbo_get_option( 'ved_blog_archive_sidebar', 'None' );
                if ( $blog_archive_sidebar != '0' && is_active_sidebar( $blog_archive_sidebar ) ) {
                    restora_dynamic_sidebar( $blog_archive_sidebar );
                }
            }
        }
    } elseif ( is_home() ) {
        $name = get_post_meta( get_option( 'page_for_posts' ), 'vedanta_selected_sidebar_replacement', true );
        if ( $name ) {
            restora_dynamic_sidebar( $name[ 0 ] );
        } else {
            if ( is_active_sidebar( 'sidebar-1' ) ):
                dynamic_sidebar( 'sidebar-1' );
            endif;
        }
    }
    elseif ( is_front_page() ) {
        if ( is_active_sidebar( 'sidebar-1' ) ):
            dynamic_sidebar( 'sidebar-1' );
        endif;
    }
    ?>
</div>
