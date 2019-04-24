<?php

/**
 * 
 * Get Option.
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are
 * as serialized strings.
 * 
 * @param type $name
 * @param type $default
 * @return type
 */

load_theme_textdomain('dayneo', get_template_directory() . '/languages');

function dayneo_get_option( $name, $default = false ) {
	$options = get_option( 'dd_options' );

	if ( isset( $options[ $name ] ) ) {
		$mediaKeys = array(
			'dd_header_logo',
                        'dd_header2_logo',
			'dd_header_logo_retina',
		);
// Media SHIM
		if ( in_array( $name, $mediaKeys ) ) {
			if ( is_array( $options[ $name ] ) ) {
				return isset( $options[ $name ][ 'url' ] ) ? $options[ $name ][ 'url' ] : false;
			} else {
				return $options[ $name ];
			}
		}

		return $options[ $name ];
	}

	return $default;
}

function dayneo_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r	 = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g	 = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b	 = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r	 = hexdec( substr( $hex, 0, 2 ) );
		$g	 = hexdec( substr( $hex, 2, 2 ) );
		$b	 = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}

function dayneo_process_tag( $m ) {
	if ( $m[ 2 ] == 'dropcap' || $m[ 2 ] == 'highlight' || $m[ 2 ] == 'tooltip' ) {
		return $m[ 0 ];
	}

// allow [[foo]] syntax for escaping a tag
	if ( $m[ 1 ] == '[' && $m[ 6 ] == ']' ) {
		return substr( $m[ 0 ], 1, - 1 );
	}

	return $m[ 1 ] . $m[ 6 ];
}

/**
 * 
 * Truncate content
 * 
 * @param type $str
 * @param type $length
 * @param type $trailing
 * @return type
 */
function dayneo_truncate( $str, $length = 10, $trailing = '..' ) {
	$length -= mb_strlen( $trailing );
	if ( mb_strlen( $str ) > $length ) {
		return mb_substr( $str, 0, $length ) . $trailing;
	} else {
		$res = $str;
	}

	return $res;
}

function dayneo_get_first_image() {
	global $post, $posts;
	$first_img	 = '';
	$output		 = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	if ( isset( $matches[ 1 ][ 0 ] ) ) {
		$first_img = $matches [ 1 ][ 0 ];

		return $first_img;
	}
}

/**
 * 
 * Tiny URL
 * 
 * @param type $url
 * @return type
 */
function dayneo_tinyurl( $url ) {
	$response = esc_url( wp_remote_retrieve_body( wp_remote_get( 'http://tinyurl.com/api-create.php?url=' . $url ) ) );

	return $response;
}

/**
 * 
 * Similar Posts
 * 
 * @global string $post
 */
function dayneo_similar_posts() {
	global $authordata, $dd_options;

	$post			 = '';
	$orig_post		 = $post;
	global $post;
	$dd_similar_posts	 = dayneo_get_option( 'dd_similar_posts', 'disable' );

	if ( $dd_similar_posts == "category" ) {
		$matchby = get_the_category( $post->ID );
		$matchin = 'category';
	} else {
		$matchby = wp_get_post_tags( $post->ID );
		$matchin = 'tag';
	}

	if ( $matchby ) {
		$matchby_ids = array();
		foreach ( $matchby as $individual_matchby ) {
			$matchby_ids[] = $individual_matchby->term_id;
		}

		$args = array(
			$matchin . '__in'	 => $matchby_ids,
			'post__not_in'		 => array( $post->ID ),
			'showposts'		 => 4, // Number of related posts that will be shown.
			'ignore_sticky_posts'	 => 1
		);

		$my_query = new wp_query( $args );
		if ( $my_query->have_posts() ) {
			echo '<div class="similar-posts"><h5 class="text-title text-uppercase bottom-line">' . esc_html__( 'Similar posts', 'dayneo' ) . '</h5>';
			echo '<div class="row multi-columns-row post-columns">';
			while ( $my_query->have_posts() ) {
				$my_query->the_post();
				?>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<!--  BLOG CONTENT  -->
					<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo dayneo_post_format(); ?>">
						<?php
						dayneo_post_thumbnail();
						?>

						<div class="post-content">

							<div class="entry-meta entry-header">
								<?php dayneo_post_heading() ?>

								<ul class="post-meta">
									<li class="author vcard">
										<?php
										esc_html_e( 'By ', 'dayneo' );

										printf( '<a class="url fn" href="' . esc_url(get_author_posts_url( $authordata->ID, $authordata->user_nicename )) . '" title="' . sprintf( 'View all posts by %s', 'dayneo', $authordata->display_name ) . '">' . get_the_author() . '</a>' )
										?>
									</li>
								</ul>
							</div>

							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>

							<div class="entry-meta entry-footer">
								<?php dayneo_post_readmore(); ?>
							</div>

						</div>
						<?php
						if ( $dd_options[ 'dd_blog_style' ] == 'thumbnail_on_side' ) {
							?>
					</div>
					</div>
					<?php
				}
				?>
				</article>
				</div>
				<!-- END BLOG CONTENT -->
				<?php
			}
			echo '</div></div>';
		}
	}
	$post = $orig_post;
	wp_reset_query();
}

function dayneo_hexDarker( $hex, $factor = 30 ) {
	$new_hex = '';

// if hex code null than assign transparent for hide PHP warning /
	$hex = empty( $hex ) ? 'ransparent' : $hex;

	$base[ 'R' ]	 = hexdec( $hex{0} . $hex{1} );
	$base[ 'G' ]	 = hexdec( $hex{2} . $hex{3} );
	$base[ 'B' ]	 = hexdec( $hex{4} . $hex{5} );

	foreach ( $base as $k => $v ) {
		$amount		 = $v / 100;
		$amount		 = round( $amount * $factor );
		$new_decimal	 = $v - $amount;

		$new_hex_component = dechex( $new_decimal );
		if ( strlen( $new_hex_component ) < 2 ) {
			$new_hex_component = "0" . $new_hex_component;
		}
		$new_hex .= $new_hex_component;
	}

	return $new_hex;
}

function dayneo_bootstrap_layout_class() {
	$bootstrap_layout = '';

	$dd_bootstrap_layout = dayneo_get_option( 'dd_bootstrap_layout', 'bootstrap_left' );

	if ( $dd_bootstrap_layout == "bootstrap_right" ) {
		$bootstrap_layout = 'layout-right';
	} elseif ( $dd_bootstrap_layout == "bootstrap_center" ) {
		$bootstrap_layout = 'layout-center';
	} else {
		$bootstrap_layout = 'layout-left';
	}

	return $bootstrap_layout;
}

if ( ! function_exists( 'dayneo_addURLParameter' ) ) {

	/**
	 * 
	 * dayneo_addURLParameter
	 * 
	 * @param type $url
	 * @param type $paramName
	 * @param type $paramValue
	 * @return type
	 */
	function dayneo_addURLParameter( $url, $paramName, $paramValue ) {
		$url_data = parse_url( $url );
		if ( ! isset( $url_data[ "query" ] ) ) {
			$url_data[ "query" ] = "";
		}

		$params			 = array();
		parse_str( $url_data[ 'query' ], $params );
		$params[ $paramName ]	 = $paramValue;

		if ( $paramName == 'product_count' ) {
			$params[ 'paged' ] = '1';
		}
		$url_data[ 'query' ] = http_build_query( $params );

		return dayneo_build_url( $url_data );
	}

}

function dayneo_build_url( $url_data ) {
	$url = "";
	if ( isset( $url_data[ 'host' ] ) ) {
		$url .= $url_data[ 'scheme' ] . '://';
		if ( isset( $url_data[ 'user' ] ) ) {
			$url .= $url_data[ 'user' ];
			if ( isset( $url_data[ 'pass' ] ) ) {
				$url .= ':' . $url_data[ 'pass' ];
			}
			$url .= '@';
		}
		$url .= $url_data[ 'host' ];
		if ( isset( $url_data[ 'port' ] ) ) {
			$url .= ':' . $url_data[ 'port' ];
		}
	}
	if ( isset( $url_data[ 'path' ] ) ) {
		$url .= $url_data[ 'path' ];
	}
	if ( isset( $url_data[ 'query' ] ) ) {
		$url .= '?' . $url_data[ 'query' ];
	}
	if ( isset( $url_data[ 'fragment' ] ) ) {
		$url .= '#' . $url_data[ 'fragment' ];
	}

	return $url;
}

/**
 * 
 * Woo Products Shortcode Recode
 * 
 * @global type $woocommerce_loop
 * @param type $atts
 * @param type $content
 * @return type
 */
//function dayneo_woo_product( $atts, $content = null ) {
//	global $woocommerce_loop;
//
//	if ( empty( $atts ) ) {
//		return;
//	}
//
//	$args = array(
//		'post_type'	 => 'product',
//		'posts_per_page' => 1,
//		'no_found_rows'	 => 1,
//		'post_status'	 => 'publish',
//		'meta_query'	 => array(
//			array(
//				'key'		 => '_visibility',
//				'value'		 => array( 'catalog', 'visible' ),
//				'compare'	 => 'IN'
//			)
//		),
//		'columns'	 => 1
//	);
//
//	if ( isset( $atts[ 'sku' ] ) ) {
//		$args[ 'meta_query' ][] = array(
//			'key'		 => '_sku',
//			'value'		 => $atts[ 'sku' ],
//			'compare'	 => '='
//		);
//	}
//
//	if ( isset( $atts[ 'id' ] ) ) {
//		$args[ 'p' ] = $atts[ 'id' ];
//	}
//
//	ob_start();
//
//	if ( isset( $columns ) ) {
//		$woocommerce_loop[ 'columns' ] = $columns;
//	}
//
//	$products = new WP_Query( $args );
//
//	if ( $products->have_posts() ) :
//
//		woocommerce_product_loop_start();
//
//		while ( $products->have_posts() ) : $products->the_post();
//
//			woocommerce_get_template_part( 'content', 'product' );
//
//		endwhile; // end of the loop. 
//
//		woocommerce_product_loop_end();
//
//	endif;
//
//	wp_reset_postdata();
//
//	return '<div class="woocommerce">' . ob_get_clean() . '</div>';
//}

/**
 * 
 * Function to use get buddypress page id
 * 
 * @return string
 */
function dayneo_bp_get_id() {
	$post_id	 = '';
	$bp_page_id	 = get_option( 'bp-pages' );

	if ( is_buddypress() ) {
		if ( bp_is_current_component( 'members' ) ) {
			$post_id = $bp_page_id[ 'members' ];
		} elseif ( bp_is_current_component( 'activity' ) ) {
			$post_id = $bp_page_id[ 'activity' ];
		} elseif ( bp_is_current_component( 'groups' ) ) {
			$post_id = $bp_page_id[ 'groups' ];
		} elseif ( bp_is_current_component( 'register' ) ) {
			$post_id = $bp_page_id[ 'register' ];
		} elseif ( bp_is_current_component( 'activate' ) ) {
			$post_id = $bp_page_id[ 'activate' ];
		} else {
			$post_id = '';
		}
	}

	return $post_id;
}

/*
 * function to print out css class and check titlebar and breadcrumb on or off according to layout
 * used in page.php
 *
 */

function dayneo_print_fonts( $name, $css_class, $additional_css = '', $additional_color_css_class = '', $imp = '' ) {
	global $dd_options;
	$options	 = $dd_options;
	$css		 = '';
	$font_size	 = '';
	$font_family	 = '';
	$font_style	 = '';
	$font_weight	 = '';
	$color		 = '';
	if ( $options[ $name ][ 'font-size' ] != '' ) {
		$font_size	 = $options[ $name ][ 'font-size' ];
		$css		 .= "$css_class{font-size:" . $font_size . " " . $imp . ";}";
	}
	if ( $options[ $name ][ 'font-family' ] != '' ) {
		$font_family	 = $options[ $name ][ 'font-family' ];
		$css		 .= "$css_class{font-family:" . $font_family . ";}";
	}
	if ( isset( $options[ $name ][ 'font-style' ] ) && $options[ $name ][ 'font-style' ] != '' ) {
		$font_style	 = $options[ $name ][ 'font-style' ];
		$css		 .= "$css_class{font-style:" . $font_style . ";}";
	}
	if ( isset( $options[ $name ][ 'font-weight' ] ) && $options[ $name ][ 'font-weight' ] != '' ) {
		$font_weight	 = $options[ $name ][ 'font-weight' ];
		$css		 .= "$css_class{font-weight:" . $font_weight . ";}";
	}
	if ( isset( $options[ $name ][ 'text-align' ] ) && $options[ $name ][ 'text-align' ] != '' ) {
		$font_align	 = $options[ $name ][ 'text-align' ];
		$css		 .= "$css_class{text-align:" . $font_align . ";}";
	}
	if ( isset( $options[ $name ][ 'color' ] ) && $options[ $name ][ 'color' ] != '' ) {
		$color	 = $options[ $name ][ 'color' ];
		$css	 .= "$css_class{color:" . $color . ";}";
	}
	if ( $additional_css != '' ) {
		$css .= "$css_class{" . $additional_css . ";}";
	}
	if ( $additional_color_css_class != '' ) {
		$color	 = $options[ $name ][ 'color' ];
		$css	 .= "$additional_color_css_class{color:" . $color . ";}";
	}

	return $css;
}

/**
 * 
 * Blog Number Pagination
 * 
 * @global type $wp_query
 */
function dayneo_paginate_links() {
	ob_start();

	global $wp_query;
	$current = max( 1, absint( get_query_var( 'paged' ) ) );

	$pagination = paginate_links( array(
		'base'		 => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
		'format'	 => '?paged=%#%',
		'current'	 => $current,
		'total'		 => $wp_query->max_num_pages,
		'type'		 => 'array',
		'prev_text'	 => '<i class="fa fa-angle-left"></i>',
		'next_text'	 => '<i class="fa fa-angle-right"></i>',
	) );

	if ( ! empty( $pagination ) ) {
		?>
		<ul class="pagination">
			<?php foreach ( $pagination as $key => $page_link ) { ?>
				<li class="paginated_link <?php
				if ( strpos( $page_link, 'current' ) !== false ) {
					echo 'active';
				}
				?>">
					    <?php echo wp_kses_post($page_link); ?>
				</li>
			<?php } ?>
		</ul>
		<?php
	}
	$links = ob_get_clean();
	echo $links;
}

/**
 * 
 * Portfolio Related Projects
 * 
 * @param type $post_id
 * @param type $number_posts
 * @return \WP_Query
 */
function dayneo_portfolio_rel_pro( $post_id, $number_posts = 8 ) {
	$query = new WP_Query();

	$args = '';

	if ( $number_posts == 0 ) {
		return $query;
	}

	$item_array = array();

	$item_cats = get_the_terms( $post_id, 'portfolio_category' );
	if ( $item_cats ):
		foreach ( $item_cats as $item_cat ) {
			$item_array[] = $item_cat->term_id;
		}
	endif;

	$args = wp_parse_args( $args, array(
		'posts_per_page'	 => $number_posts,
		'post__not_in'		 => array( $post_id ),
		'ignore_sticky_posts'	 => 0,
		'meta_key'		 => '_thumbnail_id',
		'post_type'		 => 'dayneo_portfolio',
		'tax_query'		 => array(
			array(
				'taxonomy'	 => 'portfolio_category',
				'field'		 => 'id',
				'terms'		 => $item_array
			)
		)
	) );

	$query = new WP_Query( $args );

	return $query;
}

/**
 * 
 * Portfolio Pagination
 * 
 * @global type $smof_data
 * @global type $dd_options
 * @global type $paged
 * @global type $wp_query
 * @param type $pages
 * @param type $range
 * @param type $current_query
 */
function dayneo_portfolio_pagination( $pages = '', $range = 2, $current_query = '' ) {
	global $dd_options;
	$showitems = ( $range * 2 ) + 1;

	if ( $current_query == '' ) {
		global $paged;
		if ( empty( $paged ) ) {
			$paged = 1;
		}
	} else {
		$paged = $current_query->query_vars[ 'paged' ];
	}

	if ( $pages == '' ) {
		if ( $current_query == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		} else {
			$pages = $current_query->max_num_pages;
		}
	}

	if ( 1 != $pages ) {
		?>
		<div class="row">
			<div class="col-sm-12">
				<ul class="pagination text-center">
					<?php
					if ( $paged > 1 ) {
						?>
						<li><a aria-label="Previous" class="pagination-prev" href="<?php echo esc_url(get_pagenum_link( $paged - 1 )); ?>"><span class="page-prev"></span><i class="fa fa-angle-left"></i></a></li>
						<?php
					}

					for ( $i = 1; $i <= $pages; $i ++ ) {
						if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

							if ( $paged == $i ) {
								?>
								<li class="active"><a href="<?php echo esc_url(get_pagenum_link( $i )); ?>"><?php echo (int)$i; ?></a></li>
								<?php
							} else {
								?>
								<li><a href="<?php echo esc_url(get_pagenum_link( $i )); ?>"><?php echo (int)$i; ?></a></li>
								<?php
							}
						}
					}

					if ( $paged < $pages ) {
						?>
						<li><a aria-label="Next" class="pagination-next" href="<?php echo esc_url(get_pagenum_link( $paged + 1 )); ?>"><i class="fa fa-angle-right"></i></a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
}

/**
 * 
 * Dayneo_portfolio_share
 * 
 * @global string $post
 */
function dayneo_portfolio_share() {
	global $post;
	$image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	if ( empty( $image_url ) ) {
		$image_url = get_template_directory_uri() . '/assets/images/no-thumbnail.jpg';
	}
	?>
	<ul class="social-icons social-icons-simple">
		<li><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Twitter', 'dayneo' ); ?>" target="_blank" href="http://twitter.com/intent/tweet?status=<?php echo esc_attr($post->post_title); ?>+&raquo;+<?php echo esc_url( dayneo_tinyurl( get_permalink() ) ); ?>"><i class="fa fa-twitter"></i></a></li>
		<li><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Facebook', 'dayneo' ); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo esc_attr($post->post_title); ?>"><i class="fa fa-facebook"></i></a></li>
		<li><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Google Plus', 'dayneo' ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
		<li> <a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share on Pinterest', 'dayneo' ); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_attr($image_url); ?>&description=<?php echo esc_attr($post->post_title); ?>"><i class="fa fa-pinterest"></i></a></li>			
		<li><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'Share by Email', 'dayneo' ); ?>" target="_blank" href="http://www.addtoany.com/email?linkurl=<?php the_permalink(); ?>&linkname=<?php echo esc_attr($post->post_title); ?>"><i class="fa fa-envelope-o"></i></a></li>
		<li><a rel="nofollow" class="tipsytext" title="<?php esc_html_e( 'More options', 'dayneo' ); ?>" target="_blank" href="http://www.addtoany.com/share_save#url=<?php the_permalink(); ?>&linkname=<?php echo esc_attr($post->post_title); ?>"><i class="icon-action-redo icons"></i></a></li>
	</ul>
	<?php
}

// -> START All Slider Functions Here

/**
 * 
 * 1. LayerSlider Configurations
 * 
 * @global type $wpdb
 * @global type $post
 */
function dayneo_layerslider() {

	global $wpdb, $post;

	$dayneo_slider_page_id = '';
	if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
		$dayneo_slider_page_id = $post->ID;
	}
	if ( ! is_home() && is_front_page() ) {
		$dayneo_slider_page_id = $post->ID;
	}
	if ( is_home() && ! is_front_page() ) {
		$dayneo_slider_page_id = get_option( 'page_for_posts' );
	}


// Get slider
	$ls_table_name	 = $wpdb->prefix . "layerslider";
	$ls_id		 = get_post_meta( $dayneo_slider_page_id, 'dayneo_slider', true );
	$ls_slider	 = $wpdb->get_row( "SELECT * FROM $ls_table_name WHERE id = " . (int) $ls_id . " ORDER BY date_c DESC LIMIT 1", ARRAY_A );
	$ls_slider	 = json_decode( $ls_slider[ 'data' ], true );
	?>

	<style type="text/css" scoped>
		#layerslider-container {
			max-width: <?php echo esc_attr($ls_slider[ 'properties' ][ 'width' ]); ?>;
		}
	</style>
	<div id="layerslider-container">
		<div id="layerslider-wrapper">
			<?php
//			if ( $ls_slider[ 'properties' ][ 'skin' ] == 'dayneo' ):
//			endif;

			echo do_shortcode( '[layerslider id="' . esc_attr(get_post_meta( $dayneo_slider_page_id, 'dayneo_slider', true )) . '"]' );
//			if ( $ls_slider[ 'properties' ][ 'skin' ] == 'dayneo' ):
//			endif;
			?>
		</div>
	</div>

	<?php
}

/**
 * 
 * 2. TVSlider
 * TVSlider HTML and Design Configuration.
 * 
 * @global type $slider_settings
 * @param type $term
 */
function dayneo_tvslider( $term ) {
	$args			 = array(
		'post_type'		 => 'slide',
		'posts_per_page'	 => - 1,
		'suppress_filters'	 => 0
	);
	$args[ 'tax_query' ][]	 = array(
		'taxonomy'	 => 'slide-page',
		'field'		 => 'slug',
		'terms'		 => $term
	);
	$query			 = new WP_Query( $args );
	?>

	<?php
	if ( $query->have_posts() ) {
		?>
		<!-- SLIDER -->
		<div id="home" class="flexslider fullheight color-white">
			<ul class="slides">
				<?php
				while ( $query->have_posts() ): $query->the_post();
					$metadata = get_metadata( 'post', get_the_ID() );

					$background_type = '';
					$parallax_class	 = '';
					// Image Background Type
					if ( isset( $metadata[ 'dayneo_type' ][ 0 ] ) && $metadata[ 'dayneo_type' ][ 0 ] == 'image' && has_post_thumbnail() ) {
						$image_id	 = get_post_thumbnail_id();
						$image_url	 = wp_get_attachment_image_src( $image_id, 'full', true );

						if ( $metadata[ 'dayneo_parallax_effect' ][ 0 ] == 'enable' ) {
							$background_type = 'data-background="' . esc_url($image_url[ 0 ]) . '"';
							$parallax_class	 = 'module-hero parallax';
						} else {
							$background_type = 'style="background-image: url(' . esc_url($image_url[ 0 ]) . ')"';
						}
					}

					// Youtube Background Type
					if ( isset( $metadata[ 'dayneo_type' ][ 0 ] ) && $metadata[ 'dayneo_type' ][ 0 ] == 'youtube' && isset( $metadata[ 'dayneo_youtube_id' ][ 0 ] ) ) {
						$background_type = 'data-jarallax-video="' . esc_url($metadata[ 'dayneo_youtube_id' ][ 0 ]) . '"';
						$parallax_class	 = 'parallax';
					}

					// Vimeo Background Type
					if ( isset( $metadata[ 'dayneo_type' ][ 0 ] ) && $metadata[ 'dayneo_type' ][ 0 ] == 'vimeo' && isset( $metadata[ 'dayneo_vimeo_id' ][ 0 ] ) ) {
						$background_type = 'data-jarallax-video="' . esc_url($metadata[ 'dayneo_vimeo_id' ][ 0 ]) . '"';
						$parallax_class	 = 'parallax';
					}

					// Self Hosted Video Background Type
					$self_hosted_video = '';
					if ( isset( $metadata[ 'dayneo_mp4' ][ 0 ] ) && $metadata[ 'dayneo_mp4' ][ 0 ] ) {
						$self_hosted_video .= 'mp4:' . wp_get_attachment_url( $metadata[ 'dayneo_mp4' ][ 0 ] ) . '';
					} elseif ( isset( $metadata[ 'dayneo_webm' ][ 0 ] ) && $metadata[ 'dayneo_webm' ][ 0 ] ) {
						$self_hosted_video .= ',webm:' . wp_get_attachment_url( $metadata[ 'dayneo_webm' ][ 0 ] ) . '';
					} elseif ( isset( $metadata[ 'dayneo_ogv' ][ 0 ] ) && $metadata[ 'dayneo_ogv' ][ 0 ] ) {
						$self_hosted_video .= ',ogv:' . wp_get_attachment_url( $metadata[ 'dayneo_ogv' ][ 0 ] ) . '';
					}

					if ( isset( $metadata[ 'dayneo_type' ][ 0 ] ) && $metadata[ 'dayneo_type' ][ 0 ] == 'self-hosted-video' && $self_hosted_video ) {
						$background_type = 'data-jarallax-video="' . esc_url($self_hosted_video) . '"';
						$parallax_class	 = 'parallax';
					}

					//Alignment Style
					if ( isset( $metadata[ 'dayneo_content_alignment' ] ) && $metadata[ 'dayneo_content_alignment' ] ) {
						$align = $metadata[ 'dayneo_content_alignment' ];
					}
					?>

					<!-- SLIDE -->
					<li class="bg-black-alfa-40 <?php echo esc_attr($parallax_class); ?>" <?php echo $background_type; ?>>
						<!-- HERO TEXT -->
						<div class="hero-caption">
							<div class="hero-text">

								<div class="container">

									<div class="row">
										<div class="col-sm-12 text-<?php echo esc_attr($align[ 0 ]); ?>">

											<?php
											if ( isset( $metadata[ 'dayneo_heading' ][ 0 ] ) && $metadata[ 'dayneo_heading' ][ 0 ] ) {
												?>
												<h1 class="text-title text-uppercase m-b-50 m-t-70"><?php echo esc_attr($metadata[ 'dayneo_heading' ][ 0 ]); ?></h1>
												<?php
											}
											if ( isset( $metadata[ 'dayneo_caption' ][ 0 ] ) && $metadata[ 'dayneo_caption' ][ 0 ] ) {
												?>
												<p><?php echo esc_attr($metadata[ 'dayneo_caption' ][ 0 ]); ?></p>
												<?php
											}
											if ( (isset( $metadata[ 'dayneo_button1_link' ][ 0 ] ) && $metadata[ 'dayneo_button1_link' ][ 0 ]) || (isset( $metadata[ 'dayneo_button2_link' ][ 0 ] ) && $metadata[ 'dayneo_button2_link' ][ 0 ]) ) {
												?>
												<div class="m-t-50">
													<?php
													if ( isset( $metadata[ 'dayneo_button1_text' ][ 0 ] ) && $metadata[ 'dayneo_button1_text' ][ 0 ] ) {
														?>
														<a href="<?php echo esc_url($metadata[ 'dayneo_button1_link' ][ 0 ]); ?>" class="btn btn-circle btn-white btn-lg"><?php echo esc_attr($metadata[ 'dayneo_button1_text' ][ 0 ]); ?></a>
														<?php
													}
													if ( isset( $metadata[ 'dayneo_button2_text' ][ 0 ] ) && $metadata[ 'dayneo_button2_text' ][ 0 ] ) {
														?>
														<a href="<?php echo esc_url($metadata[ 'dayneo_button2_link' ][ 0 ]); ?>" class="btn btn-circle btn-white btn-lg"><?php echo esc_attr($metadata[ 'dayneo_button2_text' ][ 0 ]); ?></a>
														<?php
													}
													?>
												</div>
												<?php
											}
											?>
										</div>
									</div>

								</div>

							</div>
						</div>
						<!-- END HERO TEXT -->
					</li>
					<!-- END SLIDE -->

				<?php endwhile; ?>
			</ul>
		</div>
		<!-- END SLIDER -->
		<?php
	}

	wp_reset_query();
}

/**
 * 
 * 2.1 SubFunction of TVSlider
 * TVSlider JS Configurations
 * 
 * @global type $slider_settings
 * @param type $term 
 */
function dayneo_tvsliderjs( $term ) {
	global $slider_settings;
	$term_details	 = get_term_by( 'slug', $term, 'slide-page' );
	$slider_settings = get_option( 'taxonomy_' . $term_details->term_id );

	$slider_local_variables = array(
		'slide_show_speed'		 => $slider_settings[ 'slideshow_speed' ],
		'slide_animation'		 => $slider_settings[ 'animation' ],
		'slide_animation_speed'		 => $slider_settings[ 'animation_speed' ],
		'slide_auto_play'		 => ($slider_settings[ 'autoplay' ] == 1 ? true : false),
		'slide_nav_arrows'		 => ($slider_settings[ 'nav_arrows' ] == 1 ? true : false),
		'slide_pagination_circles'	 => ($slider_settings[ 'pagination_circles' ] == 1 ? true : false),
	);

	wp_localize_script( 'ddmain', 'js_local_vars', $slider_local_variables );
}

// -> END All Slider Functions Here

/**
 * 
 * Display hero header content like parallax,
 * youtube, vimeo, self-hosted video
 * 
 * @param type $param
 */
function dayneo_heroheadertype( $param ) {
	$background_type = '';
	$parallax_class	 = '';

	// Image Background Type
	if ( isset( $param[ 'dayneo_hero_type' ] ) && $param[ 'dayneo_hero_type' ] == 'hero_parallax' && isset( $param[ 'dayneo_hero_image_parallax' ] ) && $param[ 'dayneo_hero_image_parallax' ] ) {
		$background_type = 'data-background="' . esc_url(wp_get_attachment_url( $param[ 'dayneo_hero_image_parallax' ] )) . '"';
		$parallax_class	 = 'module-hero parallax';
	}

	// Youtube Background Type
	if ( isset( $param[ 'dayneo_hero_type' ] ) && $param[ 'dayneo_hero_type' ] == 'hero_youtube' && isset( $param[ 'dayneo_hero_youtube_id' ] ) && $param[ 'dayneo_hero_youtube_id' ] ) {
		$background_type = 'data-jarallax-video="' . esc_attr($param[ 'dayneo_hero_youtube_id' ]) . '"';
		$parallax_class	 = 'parallax';
	}

	// Vimeo Background Type
	if ( isset( $param[ 'dayneo_hero_type' ] ) && $param[ 'dayneo_hero_type' ] == 'hero_vimeo' && isset( $param[ 'dayneo_hero_vimeo_id' ] ) && $param[ 'dayneo_hero_vimeo_id' ] ) {
		$background_type = 'data-jarallax-video="' . esc_attr($param[ 'dayneo_hero_vimeo_id' ]) . '"';
		$parallax_class	 = 'parallax';
	}

	// Self Hosted Video Background Type
	$self_hosted_video = '';
	if ( isset( $param[ 'dayneo_hero_mp4' ] ) && $param[ 'dayneo_hero_mp4' ] ) {
		$self_hosted_video .= 'mp4:' . wp_get_attachment_url( $param[ 'dayneo_hero_mp4' ] ) . '';
	} elseif ( isset( $param[ 'dayneo_hero_webm' ] ) && $param[ 'dayneo_hero_webm' ] ) {
		$self_hosted_video .= ',webm:' . wp_get_attachment_url( $param[ 'dayneo_hero_webm' ] ) . '';
	} elseif ( isset( $param[ 'dayneo_hero_ogv' ] ) && $param[ 'dayneo_hero_ogv' ] ) {
		$self_hosted_video .= ',ogv:' . wp_get_attachment_url( $param[ 'dayneo_hero_ogv' ] ) . '';
	}

	if ( isset( $param[ 'dayneo_hero_type' ] ) && $param[ 'dayneo_hero_type' ] == 'hero_self_hosted_video' && $self_hosted_video ) {
		$background_type = 'data-jarallax-video="' . esc_attr($self_hosted_video) . '"';
		$parallax_class	 = 'parallax';
	}

	// Alighnment Style
	if ( isset( $param[ 'dayneo_hero_content_alignment' ] ) && $param[ 'dayneo_hero_content_alignment' ] ) {
		$align = $param[ 'dayneo_hero_content_alignment' ];
	}

	// Hero Header Height Class
	if ( isset( $param[ 'dayneo_hero_height' ] ) && $param[ 'dayneo_hero_height' ] ) {
		$hero_height = $param[ 'dayneo_hero_height' ];
	}

	if ( $background_type ) :
		?>
		<!-- HERO -->
		<section id="hero" class="bg-black-alfa-30 color-white hero-height-<?php echo esc_attr($hero_height); ?> <?php echo esc_attr($parallax_class); ?>" <?php echo $background_type; ?>>
			<!-- HERO TEXT -->
			<div class="hero-caption">
				<div class="hero-text">

					<div class="container">

						<div class="row">
							<div class="col-sm-12 text-<?php echo esc_attr($align); ?>">
								<?php if ( isset( $param[ 'dayneo_hero_heading' ] ) && $param[ 'dayneo_hero_heading' ] ) { ?>
									<h1 class="text-title text-uppercase hero_header_heading"><?php echo esc_html($param[ 'dayneo_hero_heading' ]); ?></h1>
									<?php
								}
								if ( isset( $param[ 'dayneo_hero_caption' ] ) && $param[ 'dayneo_hero_caption' ] ) {
									?>
									<p class="hero_header_caption"><?php echo esc_html($param[ 'dayneo_hero_caption' ]); ?></p>
									<?php
								}
								?>
							</div>
						</div>

					</div>

				</div>
			</div>
			<!-- END HERO TEXT -->
		</section>
		<!-- END HERO -->
		<?php
	endif;
}

// -> START WooComm page wrapper
function dayneo_shop_wrapper_strat() {
	ob_start();
	?>
	<!-- SHOP DETAILS -->
	<section class="module p-tb-content">
		<div class="container">
			<div class="row">

				<!-- PRIMARY -->
				<div id="primary" class="<?php dayneo_layout_class( $type = 1 ); ?> post-content">
					<?php
					$wrapper_strat	 = ob_get_clean();
					echo $wrapper_strat;
				}

function dayneo_shop_wrapper_end() {
					ob_start();
					?>
				</div>
				<!-- END PRIMARY -->

				<!-- SECONDARY-1 -->
				<?php
				if ( dayneo_lets_get_sidebar() == true ) {
					get_sidebar();
				}
				?>
				<!-- END SECONDARY-1 -->

			</div><!-- .row -->
		</div>
	</section>
	<!-- END SHOP DETAILS -->
	<?php
	$wrapper_end = ob_get_clean();
	echo $wrapper_end;
}

// -> END WooComm page wrapper
// -> START Dayneo Page Title Bar
function dayneo_page_title_bar() {
	?>
	<!-- PAGE TITLE -->
	<section class="<?php echo dayneo_titlebar_bg_class(); ?>">
		<div class="container">
			<div class="row">
				<div class="page-title-wrapper col-sm-12">
					<?php
					global $post, $wp_query;

					$title		 = '';
					$description	 = '';

					if ( ! $title ) {
						$title = get_the_title();

						if ( is_home() ) {
							$title = __( 'Blog', 'dayneo' );
						}

						if ( is_search() ) {
							$title = __( 'Search Result For:', 'dayneo' ) . get_search_query();
						}

						if ( is_404() ) {
							$title = __( '404 - Page not Found', 'dayneo' );
						}

						if ( is_archive() && ! is_bbpress() ) {
							if ( is_day() ) {
								$title = __( 'Daily Archives: ', 'dayneo' ) . '<span>' . get_the_date() . '</span>';
							} else if ( is_month() ) {
								$title = __( 'Monthly Archives: ', 'dayneo' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'dayneo' ) ) . '</span>';
							} elseif ( is_year() ) {
								$title = __( 'Yearly Archives: ', 'dayneo' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'dayneo' ) ) . '</span>';
							} elseif ( is_author() ) {
								$curauth = ( isset( $_GET[ 'author_name' ] ) ) ? get_user_by( 'slug', $_GET[ 'author_name' ] ) : get_user_by( 'id', get_the_author_meta( 'ID' ) );
								$title	 = $curauth->nickname;
							} else {
								$title		 = single_cat_title( '', false );
								$description	 = get_the_archive_description();
							}
						}

						if ( class_exists( 'Woocommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
							if ( ! is_product() ) {
								$title = woocommerce_page_title( false );
							}
						}
					}
					?>

					<div class="<?php echo dayneo_titlebar_center_class(); ?>">

						<div class="<?php echo dayneo_titlebar_left_class(); ?>">
							<?php
							if ( dayneo_titlebar_title_check() == true ) {
								?>
								<h3 class="entry-title text-title text-uppercase m-b-10">
									<?php echo esc_html($title); ?>
								</h3>

								<?php
								if ( $description ) {
									?>
									<div class="taxonomy-description"><?php echo $description; ?></div>
									<?php
								}
							}
							?>
						</div>

						<div class="<?php echo dayneo_titlebar_right_class(); ?>">    
							<?php
							if ( dayneo_titlebar_breadcrumb_check() == true ) {
								if ( is_bbpress() ) {
									bbp_breadcrumb();
								} elseif ( is_product() ) {
									woocommerce_breadcrumb();
								} else {
									dayneo_breadcrumb();
								}
							}
							?>
						</div>

						<div class="clearfix"></div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- END PAGE TITLE -->
	<?php
}

function dayneo_titlebar_bg_class() {
	global $wp_query, $post;
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

	$titlebar_bg = 'titlebar-bg';

	$dd_pagetitlebar_height		 = dayneo_get_option( 'dd_pagetitlebar_height', 'medium' );
	$dayneo_page_title_bar_height	 = get_post_meta( $post_id, 'dayneo_page_title_bar_height', true );
	if ( $dayneo_page_title_bar_height == 'small' || ( $dayneo_page_title_bar_height == 'default' && $dd_pagetitlebar_height == 'small' ) ) {
		$titlebar_bg .= ' module-xs';
	} elseif ( $dayneo_page_title_bar_height == 'medium' || ( $dayneo_page_title_bar_height == 'default' && $dd_pagetitlebar_height == 'medium' ) ) {
		$titlebar_bg .= ' module-sm';
	} elseif ( $dayneo_page_title_bar_height == 'large' || ( $dayneo_page_title_bar_height == 'default' && $dd_pagetitlebar_height == 'large' ) ) {
		$titlebar_bg .= ' module-md';
	} elseif ( $dayneo_page_title_bar_height == 'custom' || ( $dayneo_page_title_bar_height == 'default' && $dd_pagetitlebar_height == 'custom' ) ) {
		$titlebar_bg .= ' titlebar-custom';
	}

	$dd_pagetitlebar_background_parallax	 = dayneo_get_option( 'dd_pagetitlebar_background_parallax', 0 );
	$dayneo_page_title_bar_parallax_bg	 = get_post_meta( $post_id, 'dayneo_page_title_bar_parallax_bg', true );
	if ( $dayneo_page_title_bar_parallax_bg == 'yes' || ( $dayneo_page_title_bar_parallax_bg == 'default' && $dd_pagetitlebar_background_parallax == 1 ) ) {
		$titlebar_bg .= ' bg-parallax';
	}

	$dd_pagetitlebar_background	 = dayneo_get_option( 'dd_pagetitlebar_background', '' );
	$dayneo_page_title_bar_bg	 = get_post_meta( get_the_ID(), 'dayneo_page_title_bar_bg', true );
	if ( $dd_pagetitlebar_background[ 'url' ] || $dayneo_page_title_bar_bg ) {
		$titlebar_bg .= ' bg-black-alfa-30';
	}

	return esc_attr($titlebar_bg);
}

function dayneo_titlebar_left_class() {
	$titlebar_layout = '';

	$dd_pagetitlebar_layout_opt = dayneo_get_option( 'dd_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $dd_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'float-left';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'float-right';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'dd-dump';
	} else {
		$titlebar_layout = 'dd-dump';
	}

	return esc_attr($titlebar_layout);
}

function dayneo_titlebar_right_class() {
	$titlebar_layout = '';

	$dd_pagetitlebar_layout_opt = dayneo_get_option( 'dd_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $dd_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'float-right';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'float-left';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'dd-dump';
	} else {
		$titlebar_layout = 'dd-dump';
	}

	return esc_attr($titlebar_layout);
}

function dayneo_titlebar_center_class() {
	$titlebar_layout = '';

	$dd_pagetitlebar_layout_opt = dayneo_get_option( 'dd_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $dd_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'dd-dump';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'dd-dump';
	} elseif ( $dd_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'text-center';
	} else {
		$titlebar_layout = 'dd-dump';
	}

	return esc_attr($titlebar_layout);
}

function dayneo_titlebar_title_check() {

	global $wp_query, $post;
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

	$get_titlebar = false;

	$dd_display_pagetitlebar	 = dayneo_get_option( 'dd_display_pagetitlebar', 'titlebar_breadcrumb' );
	$dayneo_display_page_title	 = get_post_meta( $post_id, 'dayneo_display_page_title', true );
	if ( is_search() || is_404() || is_archive() || is_bbpress() || is_product() ) {
		if ( $dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "titlebar" ) {
			$get_titlebar = true;
		}
	} elseif ( is_single() || is_page() || is_buddypress() || is_home() ) {
		if ( $dayneo_display_page_title == "default" && ($dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "titlebar") ) {
			$get_titlebar = true;
		}
		if ( $dayneo_display_page_title != "default" && ($dayneo_display_page_title == 'titlebar' || $dayneo_display_page_title == 'titlebar_breadcrumb') ) {
			$get_titlebar = true;
		}
	} else {
		if ( $dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "titlebar" ) {
			$get_titlebar = true;
		}
	}
	return $get_titlebar;
}

function dayneo_titlebar_breadcrumb_check() {
	global $wp_query, $post;

        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( function_exists( 'is_buddypress' ) ) {
                if ( is_buddypress() ) {
                    $post_id = restora_bp_get_id();
                } else {
                    $post_id = isset( $post->ID ) ? $post->ID : '';
                }
        } elseif ( function_exists( 'is_shop' ) ) {
                if ( is_shop() ) {
                    $post_id = wc_get_page_id('shop');
                } else {
                    $post_id = isset( $post->ID ) ? $post->ID : '';
                }
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$get_titlebar			 = false;
	$dd_display_pagetitlebar	 = dayneo_get_option( 'dd_display_pagetitlebar', 'titlebar_breadcrumb' );
	$dayneo_display_page_title	 = get_post_meta( $post_id, 'dayneo_display_page_title', true );

	if ( is_search() || is_404() || is_archive() || is_bbpress() || is_product() ) {
		if ( $dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "titlebar" ) {
			$get_titlebar = true;
		}
	} elseif ( is_single() || is_page() || is_buddypress() || is_home() ) {
		if ( $dayneo_display_page_title == "default" && ($dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "breadcrumb") ) {
			$get_titlebar = true;
		}
		if ( $dayneo_display_page_title != "default" && ($dayneo_display_page_title == 'breadcrumb' || $dayneo_display_page_title == 'titlebar_breadcrumb') ) {
			$get_titlebar = true;
		}
	} else {
		if ( $dd_display_pagetitlebar == "titlebar_breadcrumb" || $dd_display_pagetitlebar == "breadcrumb" ) {
			$get_titlebar = true;
		}
	}

	return $get_titlebar;
}

function dayneo_breadcrumb() {
	?>

	<ol class="breadcrumb text-xs">

		<li><a class="home" href="<?php echo esc_url(home_url('/')); ?>" ><?php esc_html_e( 'Home', 'dayneo' ); ?></a></li>

		<?php
		global $post;

		$params[ 'link_none' ]	 = '';
		$separator		 = '';

		if ( is_category() ) {
			$thisCat = get_category( get_query_var( 'cat' ), false );
			if ( $thisCat->parent != 0 ) {
				$cats	 = get_category_parents( $thisCat->parent, TRUE );
				$cats	 = explode( '</a>/', $cats );
				foreach ( $cats as $key => $cat ) {
					if ( $cat )
						echo '<li>' . esc_url($cat) . '</a></li>';
				}
			}
			echo '<li>' . esc_html($thisCat->name) . '</li>';
		}

		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			echo '<li>' . esc_html($term->name) . '</li>';
		}

		if ( is_home() ) {
			echo '<li>' . esc_html__( 'Blog', 'dayneo' ) . '</li>';
		}
		if ( is_page() && ! is_front_page() ) {
			$parents	 = array();
			$parent_id	 = $post->post_parent;
			while ( $parent_id ) :
				$page = get_page( $parent_id );
				if ( $params[ "link_none" ] ) {
					$parents[] = get_the_title( $page->ID );
				} else {
					$parents[] = '<li><a href="' . esc_url(get_permalink( $page->ID )) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
				}
				$parent_id = $page->post_parent;
			endwhile;
			$parents = array_reverse( $parents );
			echo join( ' ', $parents );
			echo '<li>' . esc_html(get_the_title()) . '</li>';
		}
		if ( is_single() && ! is_attachment() ) {
			$cat_1_line	 = '';
			$categories_1	 = get_the_category( $post->ID );
			if ( $categories_1 ):
				foreach ( $categories_1 as $cat_1 ):
					$cat_1_ids[] = $cat_1->term_id;
				endforeach;
				$cat_1_line = implode( ',', $cat_1_ids );
			endif;
			$categories = get_categories( array(
				'include'	 => $cat_1_line,
				'orderby'	 => 'id'
			) );
			if ( $categories ) :
				foreach ( $categories as $cat ) :
					$cats[] = '<li><a href="' . esc_url(get_category_link( $cat->term_id )) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
				endforeach;
				echo join( ' ', $cats );
			endif;
			echo '<li>' . esc_html(get_the_title()) . '</li>';
		}
		if ( is_tag() ) {
			echo '<li>' . "Tag: " . single_tag_title( '', false ) . '</li>';
		}
		if ( is_404() ) {
			echo '<li>' . esc_html( "404 - Page not Found", 'dayneo' ) . '</li>';
		}
		if ( is_search() ) {
			echo '<li>' . esc_html( "Search", 'dayneo' ) . '</li>';
		}
		if ( is_day() ) {
			echo '<li><a href="' . esc_url(get_year_link( get_the_time( 'Y' ) )) . '">' . get_the_time( 'Y' ) . "</a></li>";
			echo '<li><a href="' . esc_url(get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) )) . '">' . esc_html(get_the_time( 'F' )) . "</a></li>";
			echo '<li>' . esc_html(get_the_time( 'd' )) . '</li>';
		}
		if ( is_month() ) {
			echo '<li><a href="' . esc_url(get_year_link( get_the_time( 'Y' ) )) . '">' . esc_html(get_the_time( 'Y' )) . "</a></li>";
			echo '<li>' . esc_html(get_the_time( 'F' )) . '</li>';
		}
		if ( is_year() ) {
			echo '<li>' . esc_html(get_the_time( 'Y' )) . '</li>';
		}
		if ( is_attachment() ) {
			if ( ! empty( $post->post_parent ) ) {
				echo "<li><a href='" . esc_url(get_permalink( $post->post_parent )) . "'>" . esc_html(get_the_title( $post->post_parent )) . "</a></li>";
			}
			echo "<li>" . esc_html(get_the_title()) . "</li>";
		}
		?>
	</ol>
	<?php
}

// -> END Dayneo Page Title Bar
// -> START Dayneo General Layout Functions

/**
 * 
 * Function to print out css class according to layout or post meta
 * used in content.php, index.php, buddypress.php, bbpress.php
 * 
 * @global string $post
 * @global type $wp_query
 * @param type $type
 * $type = 1 is for content-blog.php and index.php
 * $type = 2 is for buddypress.php and bbpress.php
 * 
 */
function dayneo_layout_class( $type = 1 ) {
	global $post, $wp_query;

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

	$dd_layout			 = dayneo_get_option( 'dd_layout', '2cl' );
	$dd_post_layout			 = dayneo_get_option( 'dd_post_layout', 'two' );
	$dd_opt1_width_content		 = dayneo_get_option( 'dd_opt1_width_content', '8' );
	$dd_opt2_width_content		 = dayneo_get_option( 'dd_opt2_width_content', '6' );
	$dayneo_sidebar_position	 = get_post_meta( $post_id, 'dayneo_sidebar_position', true );

	$layout_css = '';

	switch ( $dd_layout ):
		case "1c":
			$layout_css	 = 'col-md-12 full-width';
			break;
		case "2cl":
			$layout_css	 = 'col-md-' . $dd_opt1_width_content . ' float-left';
			break;
		case "2cr":
			$layout_css	 = 'col-md-' . $dd_opt1_width_content . ' float-right';
			break;
		case "3cm":
			$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-left';
			break;
		case "3cr":
			$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-right';
			break;
		case "3cl":
			$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-left';
			break;
	endswitch;

	if ( (is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress()) && ($dayneo_sidebar_position && $dayneo_sidebar_position != 'default') ):

		if ( ($type == 1 && $dayneo_sidebar_position == '1c') || ($type == 2 && $dayneo_sidebar_position == '1c') ) {
			$layout_css = 'col-md-12 full-width';
		}

		switch ( $dayneo_sidebar_position ):
			case "1c":
				$layout_css	 = 'col-md-12 full-width';
				break;
			case "2cl":
				$layout_css	 = 'col-md-' . $dd_opt1_width_content . ' float-left';
				break;
			case "2cr":
				$layout_css	 = 'col-md-' . $dd_opt1_width_content . ' float-right';
				break;
			case "3cm":
				$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-left';
				break;
			case "3cr":
				$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-right';
				break;
			case "3cl":
				$layout_css	 = 'col-md-' . $dd_opt2_width_content . ' float-left';
				break;
		endswitch;

	endif;

	if ( $type == 1 ) {
		if ( class_exists( 'Woocommerce' ) ):
			$shop_sidebar = dayneo_get_option( 'dd_shop_sidebar', 'None' );
			if ( is_cart() || is_checkout() || is_account_page() || (get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) )) ) {
				$layout_css = 'col-md-12 full-width';
			} elseif ( is_shop() ) {
				if ($shop_sidebar != '0') {
					$layout_css	= 'col-md-9 col-sm-12 float-left';
				} else {
					$layout_css	= 'col-md-12 full-width';
				}
			}
		endif;
	}

	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) {
		$layout_css .= ' col-single';
	}

	echo esc_attr($layout_css);
}

/**
 * 
 * function to determine whether to get_sidebar, depending on theme options layout and post meta layout.
 * used in 404.php, archive.php, attachment.php, author.php, bbpress.php, blog-page.php,... 
 * buddypress.php, index.php, page.php, search.php single.php
 * 
 * @global type $wp_query
 * @global string $post
 * @return boolean
 */
function dayneo_lets_get_sidebar() {

	global $wp_query, $post;
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

	$get_sidebar = false;

	$dd_layout			 = dayneo_get_option( 'dd_layout', '2cl' );
	$dayneo_sidebar_position	 = get_post_meta( $post_id, 'dayneo_sidebar_position', true );

	if ( $dd_layout != "1c" ) {
		$get_sidebar = true;
	}

	if ( (is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress()) && ($dayneo_sidebar_position && $dayneo_sidebar_position != 'default') ):

		if ( $dayneo_sidebar_position != '1c' ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}

	endif;

	if ( class_exists( 'Woocommerce' ) ):
		$shop_sidebar = dayneo_get_option( 'dd_shop_sidebar', 'None' );
		if ( is_shop() && $shop_sidebar != '0' ) {
			$get_sidebar = true;
		}
	endif;

	return $get_sidebar;
}

/**
 * 
 * function to determine whether to get_sidebar('2'), depending on theme options layout and post meta layout.
 * used in 404.php, archive.php, attachment.php, author.php, bbpress.php, blog-page.php,... 
 * buddypress.php, index.php, page.php, search.php single.php
 * 
 * @global type $wp_query
 * @global string $post
 * @return boolean
 */
function dayneo_lets_get_sidebar_2() {

	global $wp_query, $post;
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

	$get_sidebar = false;

	$dd_layout			 = dayneo_get_option( 'dd_layout', '2cl' );
	$dayneo_sidebar_position	 = get_post_meta( $post_id, 'dayneo_sidebar_position', true );

	if ( $dd_layout == "3cm" || $dd_layout == "3cl" || $dd_layout == "3cr" ) {
		$get_sidebar = true;
	}

	if ( (is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress()) && ($dayneo_sidebar_position && $dayneo_sidebar_position != 'default') ):

		if ( $dayneo_sidebar_position == '1c' || $dayneo_sidebar_position == '2cl' || $dayneo_sidebar_position == '2cr' ) {
			$get_sidebar = false;
		}

		if ( $dayneo_sidebar_position == "3cm" || $dayneo_sidebar_position == "3cl" || $dayneo_sidebar_position == "3cr" ) {
			$get_sidebar = true;
		}

	endif;

	return $get_sidebar;
}

/**
 * 
 * Print out css class according to layout
 * used in sidebar.php
 * 
 * @global type $wp_query
 * @global string $post
 */
function dayneo_sidebar_class() {
	global $wp_query, $post;

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

	$sidebar_css = '';

	$dd_layout		 = dayneo_get_option( 'dd_layout', '2cl' );
	$dd_opt1_width_sidebar1	 = dayneo_get_option( 'dd_opt1_width_sidebar1', '4' );
	$dd_opt2_width_sidebar1	 = dayneo_get_option( 'dd_opt2_width_sidebar1', '3' );

	switch ( $dd_layout ):
		case "1c":
			//do nothing
			break;
		case "2cl":
			$sidebar_css	 = 'col-sm-6 col-md-' . $dd_opt1_width_sidebar1 . '';
			break;
		case "2cr":
			$sidebar_css	 = 'col-sm-6 col-md-' . $dd_opt1_width_sidebar1 . '';
			break;
		case "3cm":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-right';
			break;
		case "3cl":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-right';
			break;
		case "3cr":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-left';
			break;
	endswitch;

	$dayneo_sidebar_position = get_post_meta( $post_id, 'dayneo_sidebar_position', true );
	if ( (is_page() || is_single()) && ($dayneo_sidebar_position && $dayneo_sidebar_position != 'default') ):
		switch ( $dayneo_sidebar_position ):
			case "1c":
				//do nothing
				break;
			case "2cl":
				$sidebar_css	 = 'col-sm-6 col-md-' . $dd_opt1_width_sidebar1 . '';
				break;
			case "2cr":
				$sidebar_css	 = 'col-sm-6 col-md-' . $dd_opt1_width_sidebar1 . '';
				break;
			case "3cm":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-right';
				break;
			case "3cl":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-right';
				break;
			case "3cr":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar1 . ' float-left';
				break;
		endswitch;
	endif;

	if ( class_exists( 'Woocommerce' ) ):
		$shop_sidebar = dayneo_get_option( 'dd_shop_sidebar', 'None' );
		if ( is_shop() && $shop_sidebar != '0' ) {
			$sidebar_css	 = 'col-sm-12 col-md-3';
		}
	endif;

	echo esc_attr($sidebar_css);
}

/**
 * 
 * Print out css class according to layout
 * used in sidebar-2.php
 * 
 * @global type $wp_query
 * @global string $post
 */
function dayneo_sidebar2_class() {
	global $wp_query, $post;

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

	$sidebar_css = '';

	$dd_layout		 = dayneo_get_option( 'dd_layout', '2cl' );
	$dd_opt2_width_sidebar2	 = dayneo_get_option( 'dd_opt2_width_sidebar2', '3' );

	switch ( $dd_layout ):
		case "1c":
			//do nothing
			break;
		case "2cl":
			//do nothing
			break;
		case "2cr":
			//do nothing
			break;
		case "3cm":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-left';
			break;
		case "3cl":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-right';
			break;
		case "3cr":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-left';
			break;
	endswitch;

	$dayneo_sidebar_position = get_post_meta( $post_id, 'dayneo_sidebar_position', true );
	if ( (is_page() || is_single()) && ($dayneo_sidebar_position && $dayneo_sidebar_position != 'default') ):
		switch ( $dayneo_sidebar_position ):
			case "1c":
				//do nothing
				break;
			case "2cl":
				//do nothing
				break;
			case "2cr":
				//do nothing
				break;
			case "3cm":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-left';
				break;
			case "3cl":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-right';
				break;
			case "3cr":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $dd_opt2_width_sidebar2 . ' float-left';
				break;
		endswitch;
	endif;

	echo esc_attr($sidebar_css);
}

// -> END Dayneo General Layout Functions
