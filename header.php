<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div class="wrapper">
 *
 *
 * @package daydream
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		$dd_favicon		 = daydream_get_option( 'dd_favicon' );
		$dd_iphone_icon		 = daydream_get_option( 'dd_iphone_icon' );
		$dd_iphone_icon_retina	 = daydream_get_option( 'dd_iphone_icon_retina' );
		$dd_ipad_icon		 = daydream_get_option( 'dd_ipad_icon' );
		$dd_ipad_icon_retina	 = daydream_get_option( 'dd_ipad_icon_retina' );

		if ( $dd_favicon[ 'url' ] ):
			?>
			<!-- Favicon -->
			<!-- Firefox, Chrome, Safari, IE 11+ and Opera. -->
			<link rel="shortcut icon" href="<?php echo esc_url($dd_favicon[ 'url' ]); ?>" type="image/x-icon" />
			<?php
		endif;

		if ( $dd_iphone_icon[ 'url' ] ):
			?>
			<!-- For iPhone -->
			<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($dd_iphone_icon[ 'url' ]); ?>">
			<?php
		endif;

		if ( $dd_iphone_icon_retina[ 'url' ] ):
			?>
			<!-- For iPhone 4 Retina display -->
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url($dd_iphone_icon_retina[ 'url' ]); ?>">
			<?php
		endif;

		if ( $dd_ipad_icon[ 'url' ] ):
			?>
			<!-- For iPad -->
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($dd_ipad_icon[ 'url' ]); ?>">
			<?php
		endif;

		if ( $dd_ipad_icon_retina[ 'url' ] ):
			?>
			<!-- For iPad Retina display -->
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url($dd_ipad_icon_retina[ 'url' ]); ?>">
			<?php
		endif;
		?>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
                <?php
                $dd_back_to_top = daydream_get_option( 'dd_back_to_top', 'right' );
                if ( $dd_back_to_top == 1 ) {
                    ?>
                    <div class="back-to-top">
                        <a href="#top" class="scroll-top"><i class="fa fa-long-arrow-up"></i></a>
                    </div>
                    <?php
                }
                ?>
		<?php
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

		$dd_siteloader	 = daydream_get_option( 'dd_siteloader', 1 );
		$dd_loaderfile	 = daydream_get_option( 'dd_loaderfile' );
		if ( $dd_siteloader == 1 ) {
			?>
			<!-- PRELOADER -->
			<div class="page-loader">
				<div class="loader"><img src="<?php echo esc_url($dd_loaderfile[ 'url' ]); ?>" alt="siteloader" >
				</div>
			</div>
			<!-- END PRELOADER -->
			<?php
		}

		$dd_header_type		 = daydream_get_option( 'dd_header_type', 'h1' );
		$daydream_header_type	 = get_post_meta( $post_id, 'daydream_header_type', true );
		if ( !$daydream_header_type ) {
			$daydream_header_type = 'default';
		}

		if ( is_page() ) {
			if ( (($daydream_header_type == 'h4') || ($daydream_header_type == 'default' && $dd_header_type == 'h4')) || (($daydream_header_type == 'h5') || ($daydream_header_type == 'default' && $dd_header_type == 'h5')) ) {
				get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/header-main' );
			}
		} else {
			if ( $dd_header_type == 'h4' || $dd_header_type == 'h5' ) {
				get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/header-main' );
			}
		}

		if ( is_page() ) {
			if ( (($daydream_header_type == 'h1') || ($daydream_header_type == 'default' && $dd_header_type == 'h1')) || (($daydream_header_type == 'h2') || ($daydream_header_type == 'default' && $dd_header_type == 'h2')) ) {
				get_template_part( 'includes/headers/header-main' );
			}
		} else {
			if ( $dd_header_type == 'h1' || $dd_header_type == 'h2' ) {
				get_template_part( 'includes/headers/header-main' );
			}
		}
		?>
		<!-- WRAPPER -->
		<div class="wrapper">

			<?php
			$daydream_hero_header_type = get_post_meta( $post_id, 'daydream_hero_header_type', true );

			$param						 = array();
			$param[ 'daydream_hero_type' ]			 = $daydream_hero_header_type;
			$param[ 'daydream_hero_height' ]		 = get_post_meta( $post_id, 'daydream_hero_height', true );
			$param[ 'daydream_hero_content_alignment' ]	 = get_post_meta( $post_id, 'daydream_hero_content_alignment', true );
			$param[ 'daydream_hero_heading' ]		 = get_post_meta( $post_id, 'daydream_hero_heading', true );
			$param[ 'daydream_hero_caption' ]		 = get_post_meta( $post_id, 'daydream_hero_caption', true );
			$param[ 'daydream_hero_image_parallax' ]	 = get_post_meta( $post_id, 'daydream_hero_image_parallax', true );
			$param[ 'daydream_hero_webm' ]			 = get_post_meta( $post_id, 'daydream_hero_webm', true );
			$param[ 'daydream_hero_mp4' ]			 = get_post_meta( $post_id, 'daydream_hero_mp4', true );
			$param[ 'daydream_hero_ogv' ]			 = get_post_meta( $post_id, 'daydream_hero_ogv', true );
			$param[ 'daydream_hero_youtube_id' ]		 = get_post_meta( $post_id, 'daydream_hero_youtube_id', true );
			$param[ 'daydream_hero_vimeo_id' ]		 = get_post_meta( $post_id, 'daydream_hero_vimeo_id', true );

			if ( $daydream_hero_header_type == 'hero_parallax' || $daydream_hero_header_type == 'hero_self_hosted_video' || $daydream_hero_header_type == 'hero_youtube' || $daydream_hero_header_type == 'hero_vimeo' ) {
				daydream_heroheadertype( $param );
			} elseif ( $daydream_hero_header_type == 'hero_slider' ) {
				get_template_part( 'includes/heroheader/hero_allslider' );
			}

			if ( is_page() ) {
				if ( ($daydream_header_type == 'h3') || ($daydream_header_type == 'default' && $dd_header_type == 'h3') ) {
					get_template_part( 'includes/headers/header-main' );
				}
			} else {
				if ( $dd_header_type == 'h3' ) {
					get_template_part( 'includes/headers/header-main' );
				}
			}
			?>

			<?php
			$dd_pagetitlebar_layout		 = daydream_get_option( 'dd_pagetitlebar_layout', 1 );
			$daydream_enable_page_title	 = get_post_meta( $post_id, 'daydream_enable_page_title', true );
			if ( is_home() || is_front_page() ) {
				//Do Nothing
			} elseif ( $daydream_enable_page_title == 'on' || ( $daydream_enable_page_title == 'default' && $dd_pagetitlebar_layout == 1 ) ) {
				daydream_page_title_bar();
			}
			?>
	    