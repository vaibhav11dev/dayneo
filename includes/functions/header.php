<?php
/**
 * Custom functions for header.
 *
 * @package Martfury
 */
/**
 * Get Menu extra cart
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_extra_cart' ) ) :

    function martfury_extra_cart() {
	$extras = martfury_menu_extras();

	if ( empty( $extras ) || ! $extras[ 'cart' ] ) {
	    return '';
	}

	if ( ! function_exists( 'woocommerce_mini_cart' ) ) {
	    return '';
	}
	global $woocommerce;
	ob_start();
	woocommerce_mini_cart();
	$mini_cart = ob_get_clean();

	$mini_content = sprintf( '	<div class="widget_shopping_cart_content">%s</div>', $mini_cart );

	printf(
	'<li class="extra-menu-item menu-item-cart mini-cart woocommerce">
			<a class="cart-contents" id="icon-cart-contents" href="%s">
			    <div class="icon-wrap">
				<span class="icon">			
				<i class="flaticon-paper-bag"></i>
				<span class="mini-item-counter">
					%s
				</span>
				</span>
			</div>
			</a>
			<div class="mini-cart-content">
			<span class="tl-arrow-menu"></span>
			%s
			</div>
		</li>', esc_url( wc_get_cart_url() ), intval( $woocommerce->cart->cart_contents_count ), $mini_content
	);
    }

endif;

/**
 * Get Menu extra wishlist
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_extra_wislist' ) ) :

    function martfury_extra_wislist() {
	$extras = martfury_menu_extras();

	if ( empty( $extras ) || ! $extras[ 'wishlist' ] ) {
	    return '';
	}

	if ( ! function_exists( 'YITH_WCWL' ) ) {
	    return '';
	}

	$count = YITH_WCWL()->count_products();

	printf(
	'<li class="extra-menu-item menu-item-wishlist menu-item-yith">    			    
			<a class="yith-contents" id="icon-wishlist-contents" href="%s">
			    <div class="icon-wrap">
				<span class="icon">
				    <i class="flaticon-heart" rel="tooltip"></i>				
				    <span class="mini-item-counter">
					    %s
				    </span>
				</span>
			    </div>
			</a>
			</li>', esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ), intval( $count )
	);
    }

endif;

/**
 * Get Menu extra wishlist
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_extra_compare' ) ) :

    function martfury_extra_compare() {
	$extras = martfury_menu_extras();


	if ( empty( $extras ) || ! $extras[ 'compare' ] ) {
	    return '';
	}

	if ( ! class_exists( 'YITH_Woocompare' ) ) {
	    return '';
	}


	global $yith_woocompare;

	$count = $yith_woocompare->obj->products_list;


	printf(
	'<li class="extra-menu-item menu-item-compare menu-item-yith">
			<a class="yith-contents yith-woocompare-open" href="#">
			    <div class="icon-wrap">
				<span class="icon">			
				    <i class="fa fa-bar-chart"></i>
				    <span class="mini-item-counter" id="mini-compare-counter">
					    %s
				    </span>
				</span>
			    </div>
			</a>
			</li>', sizeof( $count )
	);
    }

endif;

/**
 * Get Menu extra hotline
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_extra_hotline' ) ) :

    function martfury_extra_hotline() {
	$extras = martfury_menu_extras();


	if ( empty( $extras ) || ! $extras[ 'hotline' ] ) {
	    return '';
	}

	$hotline_text	 = 'Hotline';
	$hotline_number	 = '123456';


	printf(
	'<li class="extra-menu-item menu-item-hotline">
			    <div class="icon-wrap">
				<span class="icon">
				<i class="fa fa-phone" aria-hidden="true"></i>
				</span>
				<span class="hotline-content">
					<label>%s</label>
					<span>%s</span>
				</span>
			</div>
		    </li>', esc_html( $hotline_text ), esc_html( $hotline_number )
	);
    }

endif;

/**
 * Get Menu extra search
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_extra_search' ) ) :

    function martfury_extra_search( $show_cat = true ) {
	$extras	 = martfury_menu_extras();
	$items	 = '';

	if ( empty( $extras ) || ! $extras[ 'search' ] ) {
	    return $items;
	}

	$cats_text	 = dayneo_get_option( 'custom_categories_text' );
	$search_text	 = dayneo_get_option( 'custom_search_text' );
	$button_text	 = dayneo_get_option( 'custom_search_button' );
	$search_type	 = dayneo_get_option( 'search_content_type' );

	if ( $search_type == 'all' ) {
	    $show_cat = false;
	}


	$cat = '';
	if ( taxonomy_exists( 'product_cat' ) && $show_cat ) {

	    $depth = 0;
	    if ( intval( dayneo_get_option( 'custom_categories_depth' ) ) > 0 ) {
		$depth = intval( dayneo_get_option( 'custom_categories_depth' ) );
	    }

	    $args = array(
		'name'			 => 'product_cat',
		'taxonomy'		 => 'product_cat',
		'orderby'		 => 'NAME',
		'hierarchical'		 => 1,
		'hide_empty'		 => 1,
		'echo'			 => 0,
		'value_field'		 => 'slug',
		'class'			 => 'product-cat-dd',
		'show_option_all'	 => esc_html( $cats_text ),
		'depth'			 => $depth
	    );

	    $cat_include = dayneo_get_option( 'custom_categories_include' );
	    if ( ! empty( $cat_include ) ) {
		$cat_include	 = explode( ',', $cat_include );
		$args[ 'include' ] = $cat_include;
	    }

	    $cat_exclude = dayneo_get_option( 'custom_categories_exclude' );
	    if ( ! empty( $cat_exclude ) ) {
		$cat_exclude	 = explode( ',', $cat_exclude );
		$args[ 'exclude' ] = $cat_exclude;
	    }

	    $cat = wp_dropdown_categories( $args );
	}
	$item_class	 = empty( $cat ) ? 'no-cats' : '';
	$post_type_html	 = '';
	if ( $search_type == 'product' ) {
	    $post_type_html = '<input type="hidden" name="post_type" value="product">';
	}
	$words_html = array();

	if ( intval( dayneo_get_option( 'header_hot_words_enable' ) ) ) {
	    $hot_words = dayneo_get_option( 'header_hot_words' );
	    if ( $hot_words ) {
		$words_html[] = '<ul class="hot-words">';
		foreach ( $hot_words as $word ) {
		    if ( isset( $word[ 'text' ] ) && ! empty( $word[ 'text' ] ) ) {
			$words_html[] = sprintf( '<li><a href="%s">%s</a></li>', esc_url( $word[ 'link' ] ), $word[ 'text' ] );
		    }
		}
		$words_html[] = '</ul>';
	    }
	}

	$lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
	if ( $lang ) {
	    $post_type_html .= '<input type="hidden" name="lang" value="' . $lang . '"/>';
	}

	$items .= sprintf(
	'<div class="product-extra-search">
                <form class="products-search" method="get" action="%s">
                    <div class="psearch-content">
			<div class="search-wrapper">
                            <input type="text" name="s"  class="search-field" autocomplete="off" placeholder="%s">
                            %s
                            <div class="search-results woocommerce"></div>
                        </div>
                        <div class="product-cat"><div class="product-cat-label %s">%s</div> %s</div>			    <button type="submit" class="search-submit flaticon-search">%s</button>
                    </div>
                </form>
                %s
		</div>', esc_url( home_url( '/' ) ), esc_html( $search_text ), $post_type_html, esc_attr( $item_class ), esc_html( $cats_text ), $cat, wp_kses( $button_text, wp_kses_allowed_html( 'post' ) ), implode( ' ', $words_html )
	);

	echo $items;
    }

endif;

/**
 * Get header menu
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_header_menu' ) ) :

    function martfury_header_menu() {
	if ( ! has_nav_menu( 'primary-menu' ) ) {
	    return;
	}
	?>
	<div class="primary-nav nav">
	<?php
	wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-main-megamenu ved-navbar-nav main-nav collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new VedCoreFrontendWalker() ) );
	?>
	</div>
	<?php
    }

endif;

/**
 * Get header bar
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_header_bar' ) ) :

    function martfury_header_bar() {
	?>
	<div class="header-bar topbar">
	<?php
	$sidebar = 'dayneo-custom-sidebar-headerbar';
	if ( is_active_sidebar( $sidebar ) ) {
	    dynamic_sidebar( $sidebar );
	}
	?>
	</div>
	    <?php
	}

    endif;

    /**
     * Get header exrta department
     *
     * @since  1.0.0
     *
     *
     * @return string
     */
    if ( ! function_exists( 'martfury_extra_department' ) ) :

	function martfury_extra_department( $dep_close = false, $id = '' ) {
	    $extras = martfury_menu_extras();

	    if ( empty( $extras ) || ! $extras[ 'department' ] ) {
		return;
	    }

	    if ( ! has_nav_menu( 'top-menu' ) ) {
		return;
	    }

	    $dep_text	 = '<i class="icon-menu"><span class="s-space"></span></i>';
	    $c_link		 = '';
	    if ( ! empty( $c_link ) ) {
		$dep_text .= '<a href="' . esc_url( $c_link ) . '" class="text">' . 'custom department text' . '</a>';
	    } else {
		$dep_text .= '<span class="text">' . 'Categories' . '</span>';
	    }

	    $dep_open = '';

	    if ( in_array( dayneo_get_option( 'dd_header_type' ), array(
		'1',
		'2',
		'7',
		'3',
	    ) ) && ! $dep_close && martfury_is_homepage() ) {
		//$dep_open = dayneo_get_option( 'department_open_homepage' );
	    }
	    $cat_style = '';
	    if ( in_array( dayneo_get_option( 'dd_header_type' ), array( '2', '3' ) ) ) {
		//$space = dayneo_get_option( 'department_space_homepage' );
		$space = '40px';
		if ( martfury_is_homepage() && $space ) {
		    $cat_style = sprintf( 'style=padding-top:%s', esc_attr( $space ) );
		}
	    }
	    ?>
	<div class="products-cats-menu <?php echo esc_attr( $dep_open ); ?>">
	    <h2 class="cats-menu-title"><?php echo wp_kses( $dep_text, wp_kses_allowed_html( 'post' ) ); ?></h2>

	    <div class="toggle-product-cats nav" <?php echo esc_attr( $cat_style ); ?>>
	<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-main-megamenu ved-navbar-nav main-nav collapse clearfix', 'container_id' => 'custom-collapse', 'walker' => new VedCoreFrontendWalker() ) ); ?>
	    </div>
	</div>
	<?php
    }

endif;

/**
 * Get menu extra
 *
 * @since  1.0.0
 *
 *
 * @return string
 */
if ( ! function_exists( 'martfury_menu_extras' ) ) :

    function martfury_menu_extras() {
	$menu_extras = dayneo_get_option( 'menu_extras' );

	return $menu_extras;
    }


endif;

