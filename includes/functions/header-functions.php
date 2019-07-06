<?php
/**
 * Basic functions for header layout.
 *
 * @package Bigbo
 */
/**
 * Get header cart
 *
 * @return string
 */
if ( !function_exists( 'bigbo_header_cart' ) ) :

	function bigbo_header_cart() {
		?>
		<!-- SHOP CART -->
		<?php
		$ved_header_type = bigbo_get_option( 'ved_header_type', 'h1' );
		if ( class_exists( 'Woocommerce' ) ) {
			global $woocommerce;
			?>
			<div id="_desktop_cart">
				<div class="cart-hover">
					<div class="menu-item header-ajax-cart">
						<a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" id="open-cart">
							<?php if ( $ved_header_type == 'h3' ) { ?>
								<div class="icon-wrap">
									<span class="icon-box">
										<i class="flaticon-paper-bag"></i>
										<span class="mini-item-counter hidden-lg-up"><?php echo (int) $woocommerce->cart->cart_contents_count; ?></span>
									</span>
								</div>
							<?php } else { ?>
								<div class="icon-wrap-circle">
									<div class="icon-wrap">
										<span class="icon-box">
											<i class="flaticon-paper-bag"></i>
											<span class="mini-item-counter">
												<?php echo (int) $woocommerce->cart->cart_contents_count; ?>
											</span>
										</span>
									</div> 
								</div>
							<?php } ?>
						</a>
					</div>
					<?php
					//Empty Cart
					if ( !$woocommerce->cart->cart_contents_count ) {
						?>
						<div class="sub-cart-menu ajax-cart-content">
							<span class="empty-cart"></span>
							<p class="empty-cart-text"><?php esc_html_e( 'Your cart is currently empty.', 'bigbo' ); ?></p>
						</div>
						<?php
					} else {
						?>
						<div class="sub-cart-menu ajax-cart-content">
							<div class="product-list-sec">
								<div class="minicart-scroll">
									<?php
									foreach ( $woocommerce->cart->cart_contents as $cart_item ):
										$cart_item_key	 = $cart_item[ 'key' ];
										$_product		 = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
										?>
										<!-- ITEM -->

										<div class="list-product">
											<div class="list-product-img">
												<a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>">
													<?php
													$thumbnail		 = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
													echo wp_kses_post( $thumbnail );
													?>
												</a>
											</div>
											<div class="list-product-detail">
												<a href="<?php echo get_permalink( $cart_item[ 'product_id' ] ); ?>">
													<?php echo esc_html( $cart_item[ 'data' ]->get_name() ); ?>
												</a>
												<p class="quantity-line"><span class="quantity">Qty:</span><b><?php echo (int) $cart_item[ 'quantity' ]; ?></b></p>
												<p class="price-line"><span class="price"><?php echo get_woocommerce_currency_symbol() . $cart_item[ 'data' ]->get_price(); ?></span></p>
											</div>
											<div class="del-minicart">
												<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'bigbo' ), esc_attr( $cart_item[ 'product_id' ] ), esc_attr( $cart_item_key )
												), $cart_item_key );
												?>
											</div>
										</div>
										<!-- END ITEM -->
									<?php endforeach; ?>
								</div>
								<div class="hr"></div>
								<div class="subtotal-count"><?php esc_html_e( 'Subtotal:', 'bigbo' ); ?> 
									<b class="content-subhead">
										<?php echo wc_price( $woocommerce->cart->subtotal ); ?>
									</b>
								</div>
								<div class="shipping-count"><?php esc_html_e( 'Shipping:', 'bigbo' ); ?> 
									<b class="content-subhead">
										<?php echo wc_price( $woocommerce->cart->shipping_total ); ?>
									</b>
								</div>
								<div class="total-count"><?php esc_html_e( 'Total:', 'bigbo' ); ?> 
									<b class="content-subhead">
										<?php echo wc_price( $woocommerce->cart->total ); ?>
									</b>
								</div>
								<div class="clearfix"></div>
								<div class="cart-button">
									<a href="<?php echo get_permalink( get_option( 'woocommerce_cart_page_id' ) ); ?>" class="btn btn-base"><?php esc_html_e( 'View Cart', 'bigbo' ); ?></a>
									<a href="<?php echo get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); ?>" class="btn btn-base"><?php esc_html_e( 'Checkout', 'bigbo' ); ?></a> 
								</div>
							</div>
						</div>
						<?php
					}
					?>

				</div>
			</div>

			<?php
		}
		?>
		<!-- END SHOP CART -->
		<?php
	}

endif;

/**
 * Get header search
 *
 * @return string
 */
if ( !function_exists( 'bigbo_header_search' ) ) :

	function bigbo_header_search( $show_cat = true ) {
		$items				 = '';

		$cats_text	 = bigbo_get_option( 'ved_custom_categories_text' );
		$search_text = bigbo_get_option( 'ved_custom_search_text' );
		$button_text = bigbo_get_option( 'ved_custom_search_button' );
		$search_type = bigbo_get_option( 'ved_search_content_type' );

		if ( $search_type == 'all' ) {
			$show_cat = false;
		}

		$cat = '';
		if ( taxonomy_exists( 'product_cat' ) && $show_cat ) {

			$depth = 0;
			if ( intval( bigbo_get_option( 'ved_custom_categories_depth' ) ) > 0 ) {
				$depth = intval( bigbo_get_option( 'ved_custom_categories_depth' ) );
			}

			$args = array(
				'name'				 => 'product_cat',
				'taxonomy'			 => 'product_cat',
				'orderby'			 => 'NAME',
				'hierarchical'		 => 1,
				'hide_empty'		 => 1,
				'echo'				 => 0,
				'value_field'		 => 'slug',
				'class'				 => 'product-cat-dd',
				'show_option_all'	 => esc_html( $cats_text ),
				'depth'				 => $depth
			);

			$cat_include = bigbo_get_option( 'ved_custom_categories_include' );
			if ( !empty( $cat_include ) ) {
				$cat_include		 = explode( ',', $cat_include );
				$args[ 'include' ]	 = $cat_include;
			}

			$cat_exclude = bigbo_get_option( 'ved_custom_categories_exclude' );
			if ( !empty( $cat_exclude ) ) {
				$cat_exclude		 = explode( ',', $cat_exclude );
				$args[ 'exclude' ]	 = $cat_exclude;
			}

			$cat = wp_dropdown_categories( $args );
		}
		$item_class		 = empty( $cat ) ? 'no-cats' : '';
		$post_type_html	 = '';
		if ( $search_type == 'product' ) {
			$post_type_html = '<input type="hidden" name="post_type" value="product">';
		}
		$words_html = array();

		if ( intval( bigbo_get_option( 'header_hot_words_enable' ) ) ) {
			$hot_words = bigbo_get_option( 'header_hot_words' );
			if ( $hot_words ) {
				$words_html[] = '<ul class="hot-words">';
				foreach ( $hot_words as $word ) {
					if ( isset( $word[ 'text' ] ) && !empty( $word[ 'text' ] ) ) {
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
		if ( isset( $button_text ) && $button_text ) {
			$search_icon = wp_kses( $button_text, wp_kses_allowed_html( 'post' ) );
		} else {
			$search_icon = "<i class='flaticon-search'></i>";
		}

		$search_content_type = bigbo_get_option( 'ved_search_content_type' );
		if ( $search_content_type == 'all' ) {
			$search_results = '<div class="ajax-search-results search-content-all woocommerce"></div>';
		} else {
			$search_results = '<div class="ajax-search-results woocommerce"></div>';
		}

		$show_categories = bigbo_get_option( 'ved_show_categories' );
		$product_categories = '';
		if ($show_categories) {
			$product_categories = sprintf('<div class="product-cat hidden-sm-down"><div class="product-cat-label %s">%s</div> %s</div>', esc_attr( $item_class ), esc_html( $cats_text ), $cat);
		}

		$items .= sprintf(
		'<div id="_desktop_search"><div class="top-search-wrap"><div class="product-extra-search">
                <form class="products-search" method="get" action="%s">
                    <div class="psearch-content">
			            <div class="search-wrapper">
                            <input type="text" name="s"  class="search-field" autocomplete="off" placeholder="%s">
                            %s                            
                        </div>
						%s
                        <button type="submit" class="search-submit">%s</button>
                    </div>
                </form>
                %s
		</div>
                %s
                <div class="search-limit"><p class="limit">Number of characters at least are 3</p></div></div></div>', 
		esc_url( home_url( '/' ) ), esc_html( $search_text ), $post_type_html, $product_categories, $search_icon, implode( ' ', $words_html ), $search_results
		);

		echo $items; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

endif;

/**
 * Get header search icon
 *
 */
if ( !function_exists( 'bigbo_header_search_icon' ) ) :

	function bigbo_header_search_icon() {
		?>
		<div id="_desktop_search" class="extra-menu-item">    			    
			<i class="fa fa-search"></i>
			<?php 
			$ved_header_type = bigbo_get_option( 'ved_header_type', 'h1' );
			if ( $ved_header_type == 'h2' ) {
				echo esc_html_e( 'Search', 'bigbo' ); 
			}
			?>
		</div>
	<?php 
	}

endif;

/**
 * Get header menu
 *
 * @return string
 */
if ( !function_exists( 'bigbo_header_menu' ) ) :

	function bigbo_header_menu() {
		if ( !has_nav_menu( 'primary-menu' ) ) {
			return;
		}
		?>
		<div class="primary-nav nav">
			<?php
			wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-main-megamenu ved-navbar-nav main-nav clearfix', 'container_id' => '_desktop_menu', 'walker' => new VedCoreFrontendWalker() ) );
			?>
		</div>
		<?php
	}

endif;

/**
 * Get header bar
 *
 * @return string
 */
if ( !function_exists( 'bigbo_header_bar' ) ) :

	function bigbo_header_bar() {
		$ved_headerbar_status = bigbo_get_option( 'ved_headerbar_status' );

		if ( empty( $ved_headerbar_status ) ) {
			return;
		}
		?>
		<div class="header-bar">
			<?php
			if ( is_active_sidebar( 'headerbar' ) ) {
				dynamic_sidebar( 'headerbar' );
			}
			?>
		</div>
		<?php
	}

endif;

/**
 * Get header categories menu
 *
 * @return string
 */
if ( !function_exists( 'bigbo_categories_menu' ) ) :

	function bigbo_categories_menu( $dep_close = false, $id = '' ) {
		$ved_cat_menu_status = bigbo_get_option( 'ved_cat_menu_status' );

		if ( empty( $ved_cat_menu_status ) ) {
			return;
		}

		if ( !has_nav_menu( 'department-menu' ) ) {
			return;
		}

		$dep_text	 = '<i class="icon-menu ti-menu"></i>';
		$dep_tit	 = bigbo_get_option( 'ved_cat_menu_title' );
		if ( !empty( $dep_tit ) ) {
			$dep_text .= '<span class="text">' . $dep_tit . '</span>';
		} else {
			$dep_text .= '<span class="text">' . 'Categories' . '</span>';
		}

		$dep_open = '';

		$cat_style = '';
		if ( in_array( bigbo_get_option( 'ved_header_type' ), array( '2', '3' ) ) ) {
			//$space = bigbo_get_option( 'department_space_homepage' );
			$space = '40px';
			if ( bigbo_is_homepage() && $space ) {
				$cat_style = sprintf( 'style=padding-top:%s', esc_attr( $space ) );
			}
		}
		?>
		<div class="products-cats-menu <?php echo esc_attr( $dep_open ); ?>">
			<h2 class="cats-menu-title"><?php echo wp_kses( $dep_text, wp_kses_allowed_html( 'post' ) ); ?></h2>

			<div class="toggle-product-cats nav" <?php echo esc_attr( $cat_style ); ?>>
				<?php wp_nav_menu( array( 'theme_location' => 'department-menu', 'menu_class' => 'inner-nav', 'container' => 'nav', 'container_class' => 'ved-navbar-nav main-nav vertical-megamenu clearfix', 'container_id' => '_desktop_vmenu', 'walker' => new VedCoreFrontendWalker() ) ); ?>
			</div>
		</div>
		<?php
	}

endif;

/**
 * Get header topbar
 *
 */
if ( !function_exists( 'bigbo_header_topbar' ) ) :

	function bigbo_header_topbar() {
		$ved_topbar_enable = bigbo_get_option( 'ved_topbar_enable' );

		if ( $ved_topbar_enable ) {
			get_template_part( 'template-parts/header/header-topbar' );
		}
	}

endif;

/**
 * Get header mobilebar
 *
 */
if ( !function_exists( 'bigbo_header_mobilebar' ) ) :

	function bigbo_header_mobilebar() {
		get_template_part( 'template-parts/header/header-mobile' );
	}

endif;

/**
 * Get header sticky
 *
 */
if ( !function_exists( 'bigbo_header_sticky' ) ) :

	function bigbo_header_sticky() {
		get_template_part( 'template-parts/header/header-sticky' );
	}

endif;

/**
 * Get topbar wishlist
 *
 */
if ( !function_exists( 'bigbo_topbar_wishlist' ) ) :

	function bigbo_topbar_wishlist() {
		if ( !function_exists( 'YITH_WCWL' ) ) {
			return '';
		}

		$count = YITH_WCWL()->count_products();
		?>
		<div id="_desktop_wishtlistTop" class="extra-menu-item menu-item-wishlist menu-item-yith">    			    
			<a class="yith-contents" id="icon-wishlist-contents" href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ) ?>">
				<i class="fa fa-heart-o"></i>
				<span class="hidden-lg-up"><?php echo esc_html_e( 'Wishlist', 'bigbo' ); ?></span>
				<span class="mini-item-counter"><?php echo intval( $count ); ?></span>
			</a>
		</div>
		<?php
	}

endif;

/**
 * Get topbar compare
 *
 */
if ( !function_exists( 'bigbo_topbar_compare' ) ) :

	function bigbo_topbar_compare() {
		if ( ! function_exists( 'YITH_WCWL' ) ) {
			return '';
		}

		$count = YITH_WCWL()->count_products();
		?>
		<div id="_desktop_compareTop" class="extra-menu-item menu-item-wishlist menu-item-yith">    			    
			<a class="yith-contents yith-woocompare-open" id="icon-compare-contents" href="javascript:void(0)">    	
				<i class="fa fa-compress"></i>
				<span class="hidden-lg-up"><?php echo esc_html_e( 'Compare', 'bigbo' ); ?></span>
				<span class="mini-item-counter">0</span>
			</a>
		</div>
	<?php 
	}

endif;

/**
 * Get topbar social
 *
 */
if ( !function_exists( 'bigbo_topbar_social' ) ) :

	function bigbo_topbar_social() {
		global $ved_options;

		$ved_nofollow_social_links	 = bigbo_get_option( 'ved_nofollow_social_links', '0' );
		$nofollow					 = '';
		if ( $ved_nofollow_social_links ) {
			$nofollow = 'rel="nofollow"';
		}

		foreach ( $ved_options as $name => $value ) {
			$social_name = strpos( $name, 'ved_social_link_' );
			if ( $social_name !== false ) {
				$social_networks[ $name ] = str_replace( 'ved_social_link_', '', $name );
			}
		}

		$ved_social_boxed = '';
		if ( isset( $ved_options[ 'ved_social_boxed' ] ) && $ved_options[ 'ved_social_boxed' ] == 'yes' ) {
			$ved_social_boxed = 'boxed-icons';
		}
		?>       
		<ul class="clearfix header-social social-icons <?php echo esc_attr( $ved_social_boxed ); ?>">
			<?php
			foreach ( $social_networks as $name => $value ):
				if ( $ved_options[ $name ] ):
					?>
					<li>
						<a class="ved-social-network-icon ved-<?php echo esc_attr( $value ); ?>" href="<?php echo esc_url( $ved_options[ $name ] ); ?>" data-toggle="tooltip" data-placement="<?php echo esc_attr( strtolower( $ved_options[ 'ved_social_tooltip_position' ] ) ); ?>" data-original-title="<?php echo esc_attr( ucwords( $value ) ); ?>" <?php echo esc_attr( $nofollow ); ?> target="<?php echo esc_attr( $ved_options[ 'ved_social_target' ] ); ?>"><i class="fa fa-<?php echo esc_attr( $value ); ?>"></i>
						</a>
					</li>
					<?php
				endif;
			endforeach;
			?>
		</ul>
		<?php
	}

endif;

/**
 * Get topbar phone
 *
 */
if ( !function_exists( 'bigbo_topbar_phone' ) ) :

	function bigbo_topbar_phone() {
		$ved_header_number = bigbo_get_option( 'ved_header_number' );
		if ( $ved_header_number ):
			?>
			<div>	
				<a class="phone-number" href="tel:<?php echo str_replace( ' ', '', esc_attr( $ved_header_number ) ); ?>"><i class="fa fa-phone"></i><?php echo esc_html( $ved_header_number ); ?></a>
			</div>
			<?php
		endif;
	}

endif;

/**
 * Get Get topbar email
 *
 */
if ( !function_exists( 'bigbo_topbar_email' ) ) :

	function bigbo_topbar_email() {
		$ved_header_email = bigbo_get_option( 'ved_header_email' );
		if ( $ved_header_email ):
			?> 
			<div>
				<a class="email-address" href="mailto:<?php echo esc_url( antispambot( $ved_header_email ) ); ?>"><i class="fa fa-envelope"></i><?php echo esc_html( $ved_header_email ); ?></a>
			</div>
			<?php
		endif;
	}

endif;

/**
 * Get topbar my-account
 *
 */
if ( !function_exists( 'bigbo_topbar_my_account' ) ) :

	function bigbo_topbar_my_account() {
		$items			 = '';
		$account		 = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		$account_link	 = $account;
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();

			$author = get_user_by( 'id', $user_id );

			$logged_type = esc_html__( 'My Account', 'bigbo' );

			$items .= sprintf(
			'<div id="_desktop_user_info">
        <div class="extra-menu-item menu-item-account dropdown hidden-md-down logined">
    		<a href="javascript:void(0)" class="expand-more" data-toggle="dropdown">%s</a>
    		<ul class="dropdown-menu">
    			<li><a href="%s">%s</a></li>					
    			<li class="logout"><a href="%s">%s</a></li>
    		</ul>
    	</div>
        <div class="user-info-wrap hidden-lg-up logined">
            <i class="fa fa-user-circle user-icon" aria-hidden="true"></i>
            <div class="user-info-btn">
                <a class="account" href="%s" title="View my customer account" rel="nofollow">%s</a>
                <p class="cust-mail">%s</p>
                <a class="logout" href="%s"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>', $logged_type, esc_url( $account_link ), esc_html__( 'Hello,', 'bigbo' ) . ' ' . $author->display_name . '!', esc_url( wp_logout_url( $account ) ), esc_html__( 'Logout', 'bigbo' ), esc_url( $account_link ), esc_html( $author->display_name ), esc_html( $author->user_email ), esc_url( wp_logout_url( $account ) )
			);
		} else {

			$register		 = '';
			$register_text	 = esc_html__( 'Register', 'bigbo' );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
				$register = sprintf(
				'<a href="%s" class="item-register" id="menu-extra-register">%s</a>', esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ), $register_text
				);
			}

			$items .= sprintf(
			'<div id="_desktop_user_info">
        <div class="extra-menu-item menu-item-account hidden-md-down dropdown">
            <a href="%s" class="expand-more" data-toggle="dropdown">%s</a>
            <ul class="dropdown-menu">
    			<li><a href="%s" id="menu-extra-login">%s</a></li>
    			<li>%s</li>
            </ul>
        </div>
        <div class="user-info-wrap hidden-lg-up">
            <i class="fa fa-user-circle user-icon" aria-hidden="true"></i>
            <div class="user-info-btn">
              <a href="%s" title="Log in to your customer account" rel="nofollow">Login</a>
              <a class="register" href="%s">Register</a>
          </div>
        </div>
    </div>', esc_url( $account_link ), esc_html__( 'My Account', 'bigbo' ), esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ), esc_html__( 'Log in', 'bigbo' ), $register, esc_url( $account_link ), esc_url( $account_link )
			);
		}
		echo $items; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

endif;

/**
 * Get topbar menu
 *
 */
if ( !function_exists( 'bigbo_topbar_menu' ) ) :

	function bigbo_topbar_menu() {
		if ( has_nav_menu( 'top-menu' ) ) {
			wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => 'top-bar-list list-dividers' ) );
		} else {
			echo 'Please first assign menu on top menu location';
		}
	}

endif;

/**
 * Get topbar language
 *
 */
if ( !function_exists( 'bigbo_topbar_language' ) ) :

	function bigbo_topbar_language(){
		/*Checl WPML sitepress multilingual plugin activate */
		if( bigbo_check_plugin_active('sitepress-multilingual-cms/sitepress.php') && function_exists('icl_get_languages') ){
			$ls_settings = get_option('icl_sitepress_settings');
			$languages = icl_get_languages();
			if(!empty($languages)){
				?>
				<div class="language" id="drop">
					<?php
					/* Display Current language */
					foreach($languages as $k => $al ){
						if ( $al[ 'active' ] == 1 ) {
							?>
							<a href="#">
								<?php
								if($al['country_flag_url'] && ( isset($ls_settings['icl_lso_flags']) && $ls_settings['icl_lso_flags']==1 ) ){
									?>
									<img src="<?php echo esc_url($al['country_flag_url']);?>" height="12" alt="<?php echo esc_attr($al['language_code']);?>" width="18" />&nbsp;
									<?php
								}
								echo icl_disp_language($al['native_name'], $al['translated_name']). '&nbsp;<i class="fa fa-angle-down">&nbsp;</i>';
								?>
							</a>
							<?php
							unset( $languages[ $k ] );
							break;
						}
					}
					?>
					<ul class="drop-content">
						<?php
						foreach($languages as $l){
							if(!$l['active']){
								?>
								<li>
									<a href="<?php echo esc_url($l['url']);?>">
										<?php
										if($l['country_flag_url'] && isset($ls_settings['icl_lso_flags']) && $ls_settings['icl_lso_flags']==1){
											?>
											<img src="<?php echo esc_url($l['country_flag_url']);?>" height="12" alt="<?php echo esc_attr($l['language_code']);?>" width="18" />
											<?php
										}
										if(isset($ls_settings['icl_lso_flags']) && $ls_settings['icl_lso_flags']==1){
											echo icl_disp_language($l['native_name'], $l['translated_name']);
										}else{
											echo icl_disp_language($l['native_name']);
										}
										?>
									</a>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
				<?php
			}
		}
	}

endif;

/**
 * Get topbar currency
 *
 */
if ( !function_exists( 'bigbo_topbar_currency' ) ) :

	function bigbo_topbar_currency() {
		global $WOOCS, $post;

		if( !$WOOCS ) return;
		?>
		<form method="post" action="#" class="woocommerce-currency-switcher-form" data-ver="<?php echo esc_attr(WOOCS_VERSION);?>">
			<input type="hidden" name="woocommerce-currency-switcher" value="<?php echo esc_attr($WOOCS->current_currency);?>" />
			<select name="woocommerce-currency-switcher" class="bigbo-woocommerce-currency-switcher bigbo-select2" onchange="woocs_redirect(this.value);void(0);">
				<?php
				foreach ($WOOCS->get_currencies() as $key => $currency) {
					$option_txt = apply_filters('woocs_currname_in_option', $currency['name']);
					$option_txt.=' (' . $currency['symbol'] .')';
					?>
					<option value="<?php echo esc_attr($key); ?>" <?php selected($WOOCS->current_currency, $key);?>>
						<?php echo esc_html($option_txt);?>
					</option>
				<?php
				}
				?>
			</select>
		</form>
		<?php
	}

endif;
