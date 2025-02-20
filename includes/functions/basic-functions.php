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
function bigbo_get_option( $name, $default = false ) {
	$options = get_option( 'ved_options' );

	if ( isset( $options[ $name ] ) ) {
		$mediaKeys = array(
			'ved_header_logo',
                        'ved_header2_logo',
			'ved_header_logo_retina',
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

function bigbo_hex2rgb( $hex ) {
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

function bigbo_process_tag( $m ) {
	if ( $m[ 2 ] == 'dropcap' || $m[ 2 ] == 'highlight' || $m[ 2 ] == 'tooltip' ) {
		return $m[ 0 ];
	}

// allow [[foo]] syntax for escaping a tag
	if ( $m[ 1 ] == '[' && $m[ 6 ] == ']' ) {
		return substr( $m[ 0 ], 1, - 1 );
	}

	return $m[ 1 ] . $m[ 6 ];
}

function bigbo_truncate( $str, $length = 10, $trailing = '..' ) {
	$length -= mb_strlen( $trailing );
	if ( mb_strlen( $str ) > $length ) {
		return mb_substr( $str, 0, $length ) . $trailing;
	} else {
		$res = $str;
	}

	return $res;
}

function bigbo_get_first_image() {
	global $post, $posts;
	$first_img	 = '';
	$output		 = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	if ( isset( $matches[ 1 ][ 0 ] ) ) {
		$first_img = $matches [ 1 ][ 0 ];

		return $first_img;
	}
}

function bigbo_tinyurl( $url ) {
	$response = esc_url( wp_remote_retrieve_body( wp_remote_get( 'http://tinyurl.com/api-create.php?url=' . $url ) ) );

	return $response;
}

function bigbo_similar_posts() {
	$post			 = '';
	$orig_post		 = $post;
	global $post;
	$ved_similar_posts	 = bigbo_get_option( 'ved_similar_posts', 'disable' );
	$ved_similar_posts_carousel	 = bigbo_get_option( 'ved_similar_posts_carousel', 0 );
	$ved_similar_posts_number	 = bigbo_get_option( 'ved_similar_posts_number', '3' );

        $css_similar_posts = 'col-sm-4';
        if( $ved_similar_posts_carousel == 1 ) {
            $css_similar_posts = 'col-sm-12';
        }

	if ( $ved_similar_posts == "category" ) {
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
			'showposts'		 => $ved_similar_posts_number, // Number of related posts that will be shown.
			'ignore_sticky_posts'	 => 1
		);

		$my_query = new wp_query( $args );
		if ( $my_query->have_posts() ) {
			echo '<div class="similar-posts"><div class="sec-head-style"><h3 class="text-title text-uppercase page-heading">' . esc_html__( 'Similar posts', 'bigbo' ) . '</h3></div>';
			echo '<div class="row"><div class="multi-columns-row post-columns">';
			while ( $my_query->have_posts() ) {
				$my_query->the_post();
				?>
                                <div class="<?php echo esc_attr($css_similar_posts); ?>">
					<!--  BLOG CONTENT  -->
					<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo bigbo_post_format(); ?>">
                        <?php
                        $ved_featured_images = bigbo_get_option( 'ved_featured_images', '1' );
                        if ( has_post_thumbnail() && $ved_featured_images == "1" ) {	
                        ?>
                        <div class="post_thumbnail">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
							<?php bigbo_post_thumbnail('medium'); ?>
                                </a>
						</div>
                        <?php } ?>
						<div class="post-content">

							<div class="entry-meta entry-header">
								<?php the_title( '<h2 class="post-title">' . bigbo_post_format_icon() . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
							</div>

							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div>

							<div class="entry-meta entry-footer">
								<?php bigbo_post_readmore(); ?>
							</div>

						</div>						
					</article>
				</div>
				<!-- END BLOG CONTENT -->
				<?php
			}
			echo '</div></div></div>'; 
                        
                        
                        if( $ved_similar_posts_carousel == 1 ) {
                        ?>
			<script>
				jQuery(document).ready(function($){
					var rtl1=false;if($("body").hasClass("rtl")){rtl1=true;}
					$('.similar-posts .post-columns').owlCarousel({
						pagination:false,
						navigation:true,
						rewind:true,
						items:3,
						navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
						autoplay:2000,
						itemsDesktop : [1199,2],
				      	itemsDesktopSmall : [992,2],
				      	itemsMobile : [599,1]
					});
				});
			</script>
		<?php 
                        }
                }
        }
	$post = $orig_post;
	wp_reset_postdata();
}

function bigbo_hexDarker( $hex, $factor = 30 ) {
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

function bigbo_bootstrap_layout_class() {
	$bootstrap_layout = '';

	$ved_bootstrap_layout = bigbo_get_option( 'ved_bootstrap_layout', 'bootstrap_left' );

	if ( $ved_bootstrap_layout == "bootstrap_right" ) {
		$bootstrap_layout = 'layout-right';
	} elseif ( $ved_bootstrap_layout == "bootstrap_center" ) {
		$bootstrap_layout = 'layout-center';
	} else {
		$bootstrap_layout = 'layout-left';
	}

	return $bootstrap_layout;
}

if ( ! function_exists( 'bigbo_addURLParameter' ) ) {

	/**
	 * 
	 * bigbo_addURLParameter
	 * 
	 * @param type $url
	 * @param type $paramName
	 * @param type $paramValue
	 * @return type
	 */
	function bigbo_addURLParameter( $url, $paramName, $paramValue ) {
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

		return bigbo_build_url( $url_data );
	}

}

function bigbo_build_url( $url_data ) {
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
 * Function to use get buddypress page id
 * 
 * @return string
 */
function bigbo_bp_get_id() {
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

function bigbo_print_fonts( $name, $css_class, $additional_css = '', $additional_color_css_class = '', $imp = '' ) {
	global $ved_options;
	$options	 = $ved_options;
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
function bigbo_paginate_links() {
	ob_start();

	global $wp_query;
	$current = max( 1, absint( get_query_var( 'paged' ) ) );
        $total_post = $wp_query->found_posts;
        $post = $wp_query->post_count;
        $allowed_html = array(
            'a'   => array(
                'href' => array(),
            ),
            'i'   => array(
                'class' => array(),
            ),
        );
        
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
                <div class="results"><?php printf(esc_html__('Showing 1-%s of %s post(s)', 'bigbo'), $post, $total_post); ?></div>       
		<ul class="pagination">
			<?php foreach ( $pagination as $key => $page_link ) { ?>
				<li class="paginated_link <?php
				if ( strpos( $page_link, 'current' ) !== false ) {
					echo 'active';
				}
				?>">
                                    <?php echo wp_kses( $page_link, $allowed_html ); ?>
				</li>
			<?php } ?>
		</ul>
		<?php
	}
	$links = ob_get_clean();
	return $links;
}

/**
 * 
 * Portfolio Related Projects
 * 
 * @param type $post_id
 * @param type $number_posts
 * @return \WP_Query
 */
function vedanta_portfolio_rel_pro( $post_id, $number_posts = 8 ) {
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
		'post_type'		 => 'vedanta_portfolio',
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
 * @global type $ved_options
 * @global type $paged
 * @global type $wp_query
 * @param type $pages
 * @param type $range
 * @param type $current_query
 */
function vedanta_portfolio_pagination( $pages = '', $range = 2, $current_query = '' ) {
	global $ved_options;
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
 * Display hero header content like parallax,
 * youtube, vimeo, self-hosted video
 * 
 * @param type $param
 */
function bigbo_heroheadertype( $param ) {
	$background_type = '';
	$parallax_class	 = '';

	// Image Background Type
	if ( isset( $param[ 'bigbo_hero_type' ] ) && $param[ 'bigbo_hero_type' ] == 'hero_parallax' && isset( $param[ 'bigbo_hero_image_parallax' ] ) && $param[ 'bigbo_hero_image_parallax' ] ) {
		$background_type = 'data-background="' . esc_url(wp_get_attachment_url( $param[ 'bigbo_hero_image_parallax' ] )) . '"';
		$parallax_class	 = 'module-hero parallax';
	}

	// Youtube Background Type
	if ( isset( $param[ 'bigbo_hero_type' ] ) && $param[ 'bigbo_hero_type' ] == 'hero_youtube' && isset( $param[ 'bigbo_hero_youtube_id' ] ) && $param[ 'bigbo_hero_youtube_id' ] ) {
		$background_type = 'data-jarallax-video="' . esc_attr($param[ 'bigbo_hero_youtube_id' ]) . '"';
		$parallax_class	 = 'parallax';
	}

	// Vimeo Background Type
	if ( isset( $param[ 'bigbo_hero_type' ] ) && $param[ 'bigbo_hero_type' ] == 'hero_vimeo' && isset( $param[ 'bigbo_hero_vimeo_id' ] ) && $param[ 'bigbo_hero_vimeo_id' ] ) {
		$background_type = 'data-jarallax-video="' . esc_attr($param[ 'bigbo_hero_vimeo_id' ]) . '"';
		$parallax_class	 = 'parallax';
	}

	// Self Hosted Video Background Type
	$self_hosted_video = '';
	if ( isset( $param[ 'bigbo_hero_mp4' ] ) && $param[ 'bigbo_hero_mp4' ] ) {
		$self_hosted_video .= 'mp4:' . esc_attr(wp_get_attachment_url( $param[ 'bigbo_hero_mp4' ] )) . '';
	} 
        if ( isset( $param[ 'bigbo_hero_webm' ] ) && $param[ 'bigbo_hero_webm' ] ) {
		$self_hosted_video .= ',webm:' . esc_attr(wp_get_attachment_url( $param[ 'bigbo_hero_webm' ] )) . '';
	} 
        if ( isset( $param[ 'bigbo_hero_ogv' ] ) && $param[ 'bigbo_hero_ogv' ] ) {
		$self_hosted_video .= ',ogv:' . esc_attr(wp_get_attachment_url( $param[ 'bigbo_hero_ogv' ] )) . '';
	}

	if ( isset( $param[ 'bigbo_hero_type' ] ) && $param[ 'bigbo_hero_type' ] == 'hero_self_hosted_video' && $self_hosted_video ) {
		$background_type = 'data-jarallax-video="' . $self_hosted_video . '"';
		$parallax_class	 = 'parallax';
	}

	// Alighnment Style
        $align = '';
	if ( isset( $param[ 'bigbo_hero_content_alignment' ] ) && $param[ 'bigbo_hero_content_alignment' ] ) {
		$align = $param[ 'bigbo_hero_content_alignment' ];
	}

	// Hero Header Height Class
	if ( isset( $param[ 'bigbo_hero_height' ] ) && $param[ 'bigbo_hero_height' ] ) {
		$hero_height = $param[ 'bigbo_hero_height' ];
	}

	if ( $background_type ) :
		?>
		<!-- HERO -->
		<section id="hero" class="bg-black-alfa-30 color-white hero-height-<?php echo esc_attr($hero_height); ?> <?php echo esc_attr($parallax_class); ?>" <?php echo $background_type; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<!-- HERO TEXT -->
			<div class="hero-caption">
				<div class="hero-text">

					<div class="container">

						<div class="row">
							<div class="col-sm-12 text-<?php echo esc_attr($align); ?>">
								<?php if ( isset( $param[ 'bigbo_hero_heading' ] ) && $param[ 'bigbo_hero_heading' ] ) { ?>
									<h1 class="text-title text-uppercase hero_header_heading"><?php echo esc_html($param[ 'bigbo_hero_heading' ]); ?></h1>
									<?php
								}
								if ( isset( $param[ 'bigbo_hero_caption' ] ) && $param[ 'bigbo_hero_caption' ] ) {
									?>
									<p class="hero_header_caption"><?php echo esc_html($param[ 'bigbo_hero_caption' ]); ?></p>
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

/*------------ START WooComm page wrapper -------------------*/
function bigbo_shop_wrapper_start() {
	ob_start();
	?>
	<!-- SHOP DETAILS -->
	<section class="module p-tb-content">
		<div class="container">
			<div class="row">

				<!-- PRIMARY -->
				<div id="primary" class="<?php bigbo_layout_class( $type = 1 ); ?> post-content">
					<?php
					$wrapper_strat	 = ob_get_clean();
					return $wrapper_strat;
				}

function bigbo_shop_wrapper_end() {
					ob_start();
					?>
				</div>
				<!-- END PRIMARY -->

				<!-- SECONDARY-1 -->
				<?php
				if ( bigbo_lets_get_sidebar() == true || is_archive() ) {
					get_sidebar();
				}
				?>
				<!-- END SECONDARY-1 -->
                                
                                <!-- SECONDARY-2 -->	    
                                <?php
                                if ( bigbo_lets_get_sidebar_2() == true ):
                                        get_sidebar( '2' );
                                endif;
                                ?>
                                <!-- END SECONDARY-2 -->

			</div><!-- .row -->
		</div>
	</section>
	<!-- END SHOP DETAILS -->
	<?php
	$wrapper_end = ob_get_clean();
	return $wrapper_end;
}
/*------------ END WooComm page wrapper -------------------*/

/*------------ START Bigbo Page Title Bar -------------------*/
function bigbo_page_title_bar() {
	?>
	<!-- PAGE TITLE -->
	<section class="<?php echo bigbo_titlebar_bg_class(); ?>">
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
							$title = esc_html__( 'Blog', 'bigbo' );
						}

						if ( is_search() ) {
							$title = esc_html__( 'Search Result For:', 'bigbo' ) . get_search_query();
						}

						if ( is_404() ) {
							$title = esc_html__( '404 - Page not Found', 'bigbo' );
						}

						if ( is_archive() && ! is_bbpress() ) {
							if ( is_day() ) {
								$title = esc_html__( 'Daily Archives: ', 'bigbo' ) . '<span>' . get_the_date() . '</span>';
							} else if ( is_month() ) {
								$title = esc_html__( 'Monthly Archives: ', 'bigbo' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bigbo' ) ) . '</span>';
							} elseif ( is_year() ) {
								$title = esc_html__( 'Yearly Archives: ', 'bigbo' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bigbo' ) ) . '</span>';
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

					<div class="<?php echo bigbo_titlebar_center_class(); ?>">

						<div class="<?php echo bigbo_titlebar_left_class(); ?>">
							<?php
							if ( bigbo_titlebar_title_check() == true ) {
								?>
								<h3 class="entry-title text-title text-uppercase m-b-10">
									<?php echo esc_html($title); ?>
								</h3>

								<?php
							}
							?>
						</div>

						<div class="<?php echo bigbo_titlebar_right_class(); ?>">    
							<?php
							if ( bigbo_titlebar_breadcrumb_check() == true ) {
								if ( is_bbpress() ) {
									bbp_breadcrumb();
								} elseif ( is_product() ) {
									woocommerce_breadcrumb();
								} else {
									bigbo_breadcrumb();
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

function bigbo_titlebar_bg_class() {
	global $wp_query, $post;
	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$titlebar_bg = 'titlebar-bg';

	$ved_pagetitlebar_height		 = bigbo_get_option( 'ved_pagetitlebar_height', 'medium' );
	$bigbo_page_title_bar_height	 = get_post_meta( $post_id, 'bigbo_page_title_bar_height', true );
	if (empty($bigbo_page_title_bar_height)) {
		$bigbo_page_title_bar_height = 'default';
	}
	if ( $bigbo_page_title_bar_height == 'small' || ( $bigbo_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'small' ) ) {
		$titlebar_bg .= ' module-xs';
	} elseif ( $bigbo_page_title_bar_height == 'medium' || ( $bigbo_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'medium' ) ) {
		$titlebar_bg .= ' module-sm';
	} elseif ( $bigbo_page_title_bar_height == 'large' || ( $bigbo_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'large' ) ) {
		$titlebar_bg .= ' module-md';
	} elseif ( $bigbo_page_title_bar_height == 'custom' || ( $bigbo_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'custom' ) ) {
		$titlebar_bg .= ' titlebar-custom';
	}

	$ved_pagetitlebar_background_parallax	 = bigbo_get_option( 'ved_pagetitlebar_background_parallax', 0 );
	$bigbo_page_title_bar_parallax_bg	 = get_post_meta( $post_id, 'bigbo_page_title_bar_parallax_bg', true );
        if (empty($bigbo_page_title_bar_parallax_bg)) {
            $bigbo_page_title_bar_parallax_bg = 'default';
        }
        if ( $bigbo_page_title_bar_parallax_bg == 'yes' || ( $bigbo_page_title_bar_parallax_bg == 'default' && $ved_pagetitlebar_background_parallax == 1 ) ) {
            $titlebar_bg .= ' bg-parallax';
        } elseif ( (is_search() || is_404() || is_archive() || ( class_exists( 'Woocommerce' ) && is_product() )) && $ved_pagetitlebar_background_parallax == 1 ) {
            $titlebar_bg .= ' bg-parallax';
        }

	$ved_pagetitlebar_background	 = bigbo_get_option( 'ved_pagetitlebar_background', '' );
	$bigbo_page_title_bar_bg	 = get_post_meta( get_the_ID(), 'bigbo_page_title_bar_bg', true );
	if ( (isset($ved_pagetitlebar_background[ 'url' ] ) && $ved_pagetitlebar_background[ 'url' ]) || $bigbo_page_title_bar_bg ) {
		$titlebar_bg .= ' bg-black-alfa-30';
	}

	return esc_attr($titlebar_bg);
}

function bigbo_titlebar_left_class() {
	$titlebar_layout = '';

	$ved_pagetitlebar_layout_opt = bigbo_get_option( 'ved_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $ved_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'float-left';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'float-right';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'ved-dump';
	} else {
		$titlebar_layout = 'ved-dump';
	}

	return esc_attr($titlebar_layout);
}

function bigbo_titlebar_right_class() {
	$titlebar_layout = '';

	$ved_pagetitlebar_layout_opt = bigbo_get_option( 'ved_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $ved_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'float-right';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'float-left';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'ved-dump';
	} else {
		$titlebar_layout = 'ved-dump';
	}

	return esc_attr($titlebar_layout);
}

function bigbo_titlebar_center_class() {
	$titlebar_layout = '';

	$ved_pagetitlebar_layout_opt = bigbo_get_option( 'ved_pagetitlebar_layout_opt', 'titlebar_left' );

	if ( $ved_pagetitlebar_layout_opt == "titlebar_left" ) {
		$titlebar_layout = 'ved-dump';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_right" ) {
		$titlebar_layout = 'ved-dump';
	} elseif ( $ved_pagetitlebar_layout_opt == "titlebar_center" ) {
		$titlebar_layout = 'text-center';
	} else {
		$titlebar_layout = 'ved-dump';
	}

	return esc_attr($titlebar_layout);
}

function bigbo_titlebar_title_check() {

	global $wp_query, $post;
	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$get_titlebar = false;

	$ved_display_pagetitlebar	 = bigbo_get_option( 'ved_display_pagetitlebar', 'titlebar_breadcrumb' );
	$bigbo_display_page_title	 = get_post_meta( $post_id, 'bigbo_display_page_title', true );
        if (empty($bigbo_display_page_title)) {
            $bigbo_display_page_title = 'default';
        }
	if ( is_search() || is_404() || is_archive() || is_bbpress() || is_product() ) {
		if ( $ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "titlebar" ) {
			$get_titlebar = true;
		}
	} elseif ( is_single() || is_page() || is_buddypress() || is_home() ) {
		if ( $bigbo_display_page_title == 'default' && ($ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "titlebar") ) {
			$get_titlebar = true;
		}
		if ( $bigbo_display_page_title != 'default' && ($bigbo_display_page_title == 'titlebar' || $bigbo_display_page_title == 'titlebar_breadcrumb') ) {
			$get_titlebar = true;
		}
	} else {
		if ( $ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "titlebar" ) {
			$get_titlebar = true;
		}
	}
	return $get_titlebar;
}

function bigbo_titlebar_breadcrumb_check() {
	global $wp_query, $post;

        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( function_exists( 'is_buddypress' ) ) {
                if ( is_buddypress() ) {
                    $post_id = bigbo_bp_get_id();
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
	$ved_display_pagetitlebar	 = bigbo_get_option( 'ved_display_pagetitlebar', 'titlebar_breadcrumb' );
	$bigbo_display_page_title	 = get_post_meta( $post_id, 'bigbo_display_page_title', true );
        if (empty($bigbo_display_page_title)) {
            $bigbo_display_page_title = 'default';
        }
	if ( is_search() || is_404() || is_archive() || is_bbpress() || is_product() ) {
		if ( $ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "breadcrumb" ) {
			$get_titlebar = true;
		}
	} elseif ( is_single() || is_page() || is_buddypress() || is_home() ) {
		if ( $bigbo_display_page_title == 'default' && ($ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "breadcrumb") ) {
			$get_titlebar = true;
		}
		if ( $bigbo_display_page_title != 'default' && ($bigbo_display_page_title == 'breadcrumb' || $bigbo_display_page_title == 'titlebar_breadcrumb') ) {
			$get_titlebar = true;
		}
	} else {
		if ( $ved_display_pagetitlebar == "titlebar_breadcrumb" || $ved_display_pagetitlebar == "breadcrumb" ) {
			$get_titlebar = true;
		}
	}

	return $get_titlebar;
}

function bigbo_breadcrumb() {
	?>

	<ol class="breadcrumb text-xs">

		<li><a class="home" href="<?php echo esc_url(home_url('/')); ?>" ><?php esc_html_e( 'Home', 'bigbo' ); ?></a></li>

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
			echo '<li>' . esc_html__( 'Blog', 'bigbo' ) . '</li>';
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
                        $post_type	 = get_post_type( $post->ID );
			$cat_1_line	 = '';

                        if ( $post_type == 'vedanta_portfolio') {
                            $categories	 = get_the_terms( $post->ID, 'portfolio_category' );
                        } else {
                            $categories	 = get_the_category( $post->ID );
                        }

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
			echo '<li>' . esc_html( "404 - Page not Found", 'bigbo' ) . '</li>';
		}
		if ( is_search() ) {
			echo '<li>' . esc_html( "Search", 'bigbo' ) . '</li>';
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
/*------------ END Bigbo Page Title Bar -------------------*/

/*------------ START Bigbo General Layout Functions -------------------*/
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
function bigbo_layout_class( $type = 1 ) {
	global $post, $wp_query;

        $post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$ved_layout			 = bigbo_get_option( 'ved_layout', '2cl' );
	$ved_post_layout			 = bigbo_get_option( 'ved_post_layout', '2' );
	$ved_opt1_width_content		 = bigbo_get_option( 'ved_opt1_width_content', '8' );
	$ved_opt2_width_content		 = bigbo_get_option( 'ved_opt2_width_content', '6' );
        $ved_opt1_width_sidebar1	 = bigbo_get_option( 'ved_opt1_width_sidebar1', '4' );
	$ved_opt2_width_sidebar1	 = bigbo_get_option( 'ved_opt2_width_sidebar1', '3' );
	$bigbo_sidebar_position	 = get_post_meta( $post_id, 'bigbo_sidebar_position', true );

	$layout_css = '';

	switch ( $ved_layout ):
		case "1c":
			$layout_css	 = 'col-md-12 full-width';
			break;
		case "2cl":
			$layout_css	 = 'col-md-' . $ved_opt1_width_content . ' float-left';
			break;
		case "2cr":
			$layout_css	 = 'col-md-' . $ved_opt1_width_content . ' float-right';
			break;
		case "3cm":
			$layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-left col-md-push-' . $ved_opt1_width_sidebar1 . '';
			break;
		case "3cr":
			$layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-right';
			break;
		case "3cl":
			$layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-left';
			break;
	endswitch;

	if ( ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() || ( class_exists( 'Woocommerce' ) && is_shop() ) ) && ($bigbo_sidebar_position && $bigbo_sidebar_position != 'default') ):

		if ( ($type == 1 && $bigbo_sidebar_position == '1c') || ($type == 2 && $bigbo_sidebar_position == '1c') ) {
			$layout_css = 'col-md-12 full-width';
		}

		switch ( $bigbo_sidebar_position ):
			case "1c":
				$layout_css	 = 'col-md-12 full-width';
				break;
			case "2cl":
				$layout_css	 = 'col-md-' . $ved_opt1_width_content . ' float-left';
				break;
			case "2cr":
				$layout_css	 = 'col-md-' . $ved_opt1_width_content . ' float-right';
				break;
			case "3cm":
                                $layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-left col-md-push-' . $ved_opt1_width_sidebar1 . '';
				break;
			case "3cr":
				$layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-right';
				break;
			case "3cl":
				$layout_css	 = 'col-md-' . $ved_opt2_width_content . ' float-left';
				break;
		endswitch;

	endif;

        if ( class_exists( 'Woocommerce' ) ):
                if ( is_cart() || is_checkout() || is_account_page() || (get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) )) ) {
                        $layout_css = 'col-md-12 full-width';
                } elseif (is_archive() && $ved_layout == '1c' && !is_category()) {
                        $layout_css	 = 'col-md-9 float-right col-single';
                }
        endif;

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
function bigbo_lets_get_sidebar() {

	global $wp_query, $post;
	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$get_sidebar = false;

	$ved_layout			 = bigbo_get_option( 'ved_layout', '2cl' );
	$bigbo_sidebar_position	 = get_post_meta( $post_id, 'bigbo_sidebar_position', true );

	if ( $ved_layout != "1c" ) {
		$get_sidebar = true;
	}

	if ( (is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() || ( class_exists( 'Woocommerce' ) && is_shop() )) && ($bigbo_sidebar_position && $bigbo_sidebar_position != 'default') ):

		if ( $bigbo_sidebar_position != '1c' ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}

	endif;

//	if ( class_exists( 'Woocommerce' ) ):
//		$shop_sidebar = bigbo_get_option( 'ved_shop_sidebar', 'None' );
//		if ( is_shop() && $shop_sidebar != '0' ) {
//			$get_sidebar = true;
//		}
//	endif;

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
function bigbo_lets_get_sidebar_2() {

	global $wp_query, $post;
	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$get_sidebar = false;

	$ved_layout			 = bigbo_get_option( 'ved_layout', '2cl' );
	$bigbo_sidebar_position	 = get_post_meta( $post_id, 'bigbo_sidebar_position', true );

	if ( $ved_layout == "3cm" || $ved_layout == "3cl" || $ved_layout == "3cr" ) {
		$get_sidebar = true;
	}

	if ( (is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress()) && ($bigbo_sidebar_position && $bigbo_sidebar_position != 'default') ):

		if ( $bigbo_sidebar_position == '1c' || $bigbo_sidebar_position == '2cl' || $bigbo_sidebar_position == '2cr' ) {
			$get_sidebar = false;
		}

		if ( $bigbo_sidebar_position == "3cm" || $bigbo_sidebar_position == "3cl" || $bigbo_sidebar_position == "3cr" ) {
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
function bigbo_sidebar_class() {
	global $wp_query, $post;

	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$sidebar_css = '';

	$ved_layout		 = bigbo_get_option( 'ved_layout', '2cl' );
	$ved_opt1_width_sidebar1	 = bigbo_get_option( 'ved_opt1_width_sidebar1', '4' );
	$ved_opt2_width_sidebar1	 = bigbo_get_option( 'ved_opt2_width_sidebar1', '3' );
        $ved_opt1_width_content		 = bigbo_get_option( 'ved_opt1_width_content', '8' );
	$ved_opt2_width_content		 = bigbo_get_option( 'ved_opt2_width_content', '6' );

	switch ( $ved_layout ):
		case "1c":
			//do nothing
			break;
		case "2cl":
			$sidebar_css	 = 'col-md-' . $ved_opt1_width_sidebar1 . '';
			break;
		case "2cr":
			$sidebar_css	 = 'col-md-' . $ved_opt1_width_sidebar1 . '';
			break;
		case "3cm":
			$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' col-md-pull-' . $ved_opt2_width_content . '';
			break;
		case "3cl":
			$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' float-right';
			break;
		case "3cr":
			$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' float-left';
			break;
	endswitch;

	$bigbo_sidebar_position = get_post_meta( $post_id, 'bigbo_sidebar_position', true );
	if ( (is_page() || is_single()) && ($bigbo_sidebar_position && $bigbo_sidebar_position != 'default') ):
		switch ( $bigbo_sidebar_position ):
			case "1c":
				//do nothing
				break;
			case "2cl":
				$sidebar_css	 = 'col-sm-6 col-md-' . $ved_opt1_width_sidebar1 . '';
				break;
			case "2cr":
				$sidebar_css	 = 'col-sm-6 col-md-' . $ved_opt1_width_sidebar1 . '';
				break;
			case "3cm":
				$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' col-md-pull-' . $ved_opt2_width_content . '';
				break;
			case "3cl":
				$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' float-right';
				break;
			case "3cr":
				$sidebar_css	 = 'col-xs-12 col-md-' . $ved_opt2_width_sidebar1 . ' float-left';
				break;
		endswitch;
	endif;

	if ( class_exists( 'Woocommerce' ) ):
		if (is_archive() && $ved_layout == '1c' && !is_category()) {
                        $sidebar_css	 = 'col-md-3';
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
function bigbo_sidebar2_class() {
	global $wp_query, $post;

	$post_id = '';
        if ( $wp_query->is_posts_page ) {
            $post_id = get_option( 'page_for_posts' );
        } elseif ( is_buddypress() ) {
            $post_id = bigbo_bp_get_id();
        } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }

	$sidebar_css = '';

	$ved_layout		 = bigbo_get_option( 'ved_layout', '2cl' );
	$ved_opt2_width_sidebar2	 = bigbo_get_option( 'ved_opt2_width_sidebar2', '3' );

	switch ( $ved_layout ):
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
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-left';
			break;
		case "3cl":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-right';
			break;
		case "3cr":
			$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-left';
			break;
	endswitch;

	$bigbo_sidebar_position = get_post_meta( $post_id, 'bigbo_sidebar_position', true );
	if ( (is_page() || is_single()) && ($bigbo_sidebar_position && $bigbo_sidebar_position != 'default') ):
		switch ( $bigbo_sidebar_position ):
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
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-left';
				break;
			case "3cl":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-right';
				break;
			case "3cr":
				$sidebar_css	 = 'col-xs-12 col-sm-6 col-md-' . $ved_opt2_width_sidebar2 . ' float-left';
				break;
		endswitch;
	endif;

	echo esc_attr($sidebar_css);
}
/*------------ END Bigbo General Layout Functions -------------------*/

/**
 * Check plugin active or not
 * 
 * @param type $plugin
 * @return boolean
 */
function bigbo_check_plugin_active( $plugin = '' ) {

	if( empty($plugin) ) return false;

	return ( in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || ( function_exists('is_plugin_active_for_network') && is_plugin_active_for_network($plugin) ) );
}
