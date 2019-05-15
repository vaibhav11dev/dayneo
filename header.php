<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div class="wrapper">
 *
 *
 * @package bigbo
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		$dd_favicon		 = bigbo_get_option( 'dd_favicon' );
		$dd_iphone_icon		 = bigbo_get_option( 'dd_iphone_icon' );
		$dd_iphone_icon_retina	 = bigbo_get_option( 'dd_iphone_icon_retina' );
		$dd_ipad_icon		 = bigbo_get_option( 'dd_ipad_icon' );
		$dd_ipad_icon_retina	 = bigbo_get_option( 'dd_ipad_icon_retina' );

                if ( isset($dd_favicon[ 'url' ]) && $dd_favicon[ 'url' ] ):
                    ?>
                    <!-- Favicon -->
                    <!-- Firefox, Chrome, Safari, IE 11+ and Opera. -->
                    <link rel="shortcut icon" href="<?php echo esc_url($dd_favicon[ 'url' ]); ?>" type="image/x-icon" />
                    <?php
                endif;
                if ( isset($dd_iphone_icon[ 'url' ]) && $dd_iphone_icon[ 'url' ] ):
                    ?>
                    <!-- For iPhone -->
                    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($dd_iphone_icon[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($dd_iphone_icon_retina[ 'url' ]) && $dd_iphone_icon_retina[ 'url' ] ):
                    ?>
                    <!-- For iPhone 4 Retina display -->
                    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url($dd_iphone_icon_retina[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($dd_ipad_icon[ 'url' ]) && $dd_ipad_icon[ 'url' ] ):
                    ?>
                    <!-- For iPad -->
                    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($dd_ipad_icon[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($dd_ipad_icon_retina[ 'url' ]) && $dd_ipad_icon_retina[ 'url' ] ):
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

        <?php //$shop_view = isset( $_COOKIE['shop_view'] ) ? $_COOKIE['shop_view'] : ''; ?>
	<body <?php body_class(); ?>>
                <?php
                $dd_back_to_top = bigbo_get_option( 'dd_back_to_top', 'right' );
                if ( $dd_back_to_top == 1 ) {
                    ?>
                    <div class="back-to-top">
                        <a href="#top" class="scroll-top"><i class="ti-arrow-up"></i></a>
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
                    $post_id = bigbo_bp_get_id();
                } elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
                    $post_id = wc_get_page_id( 'shop' );
                } else {
                    $post_id = isset( $post->ID ) ? $post->ID : '';
                }

		$dd_siteloader	 = bigbo_get_option( 'dd_siteloader', 1 );
		$dd_loaderfile	 = bigbo_get_option( 'dd_loaderfile' );
		if ( $dd_siteloader == 1 && isset($dd_loaderfile) && $dd_loaderfile ) {
			?>
			<!-- PRELOADER -->
			<div class="page-loader"><img src="<?php echo esc_url($dd_loaderfile[ 'url' ]); ?>" alt="siteloader" ></div>
			<!-- END PRELOADER -->
			<?php
		}

		$dd_header_type		 = bigbo_get_option( 'dd_header_type', 'h1' );
		$bigbo_header_type	 = get_post_meta( $post_id, 'bigbo_header_type', true );
		if ( !$bigbo_header_type ) {
			$bigbo_header_type = 'default';
		}
                
                switch ( $dd_header_type ) {
                    case 'h1':
                        $header_class = 'header-1';
                        break;

                    case 'h2':
                        $header_class = 'header-2';
                        break;
                    
                    case 'h3':
                        $header_class = 'header-3';
                        break;
                }
                
                if ( is_page() ) {
			if ( (($bigbo_header_type == 'h1') || ($bigbo_header_type == 'default' && $dd_header_type == 'h1')) || (($bigbo_header_type == 'h2') || ($bigbo_header_type == 'default' && $dd_header_type == 'h2')) ) { ?>
				<div id="header" class="header-wrap <?php echo esc_attr( $header_class ); ?>">
				<?php	get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/layout-1' );?>
				</div>
			<?php	}
		} else {
			if ( $dd_header_type == 'h1' || $dd_header_type == 'h2' ) { ?>
                        <div id="header" class="header-wrap <?php echo esc_attr( $header_class ); ?>">
				<?php get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/layout-1' );?>
				</div>
			<?php }
		}
                
                if ( is_page() ) {
			if ( ($bigbo_header_type == 'h3') || ($bigbo_header_type == 'default' && $dd_header_type == 'h3') ) { ?>
				<div id="header" class="header-wrap <?php echo esc_attr( $header_class ); ?>">
				<?php	get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/layout-2' );?>
				</div>
			<?php	}
		} else {
			if ( $dd_header_type == 'h3' ) { ?>
                        <div id="header" class="header-wrap <?php echo esc_attr( $header_class ); ?>">
				<?php get_template_part( 'includes/headers/header-topbar' );
				get_template_part( 'includes/headers/layout-2' );?>
				</div>
			<?php }
		}

		?>
		<!-- WRAPPER -->
		<div class="wrapper">

			<?php
			$bigbo_hero_header_type = get_post_meta( $post_id, 'bigbo_hero_header_type', true );

			$param						 = array();
			$param[ 'bigbo_hero_type' ]			 = $bigbo_hero_header_type;
			$param[ 'bigbo_hero_height' ]		 = get_post_meta( $post_id, 'bigbo_hero_height', true );
			$param[ 'bigbo_hero_content_alignment' ]	 = get_post_meta( $post_id, 'bigbo_hero_content_alignment', true );
			$param[ 'bigbo_hero_heading' ]		 = get_post_meta( $post_id, 'bigbo_hero_heading', true );
			$param[ 'bigbo_hero_caption' ]		 = get_post_meta( $post_id, 'bigbo_hero_caption', true );
			$param[ 'bigbo_hero_image_parallax' ]	 = get_post_meta( $post_id, 'bigbo_hero_image_parallax', true );
			$param[ 'bigbo_hero_webm' ]			 = get_post_meta( $post_id, 'bigbo_hero_webm', true );
			$param[ 'bigbo_hero_mp4' ]			 = get_post_meta( $post_id, 'bigbo_hero_mp4', true );
			$param[ 'bigbo_hero_ogv' ]			 = get_post_meta( $post_id, 'bigbo_hero_ogv', true );
			$param[ 'bigbo_hero_youtube_id' ]		 = get_post_meta( $post_id, 'bigbo_hero_youtube_id', true );
			$param[ 'bigbo_hero_vimeo_id' ]		 = get_post_meta( $post_id, 'bigbo_hero_vimeo_id', true );

			if ( $bigbo_hero_header_type == 'hero_parallax' || $bigbo_hero_header_type == 'hero_self_hosted_video' || $bigbo_hero_header_type == 'hero_youtube' || $bigbo_hero_header_type == 'hero_vimeo' ) {
				bigbo_heroheadertype( $param );
			} elseif ( $bigbo_hero_header_type == 'hero_slider' ) {
				get_template_part( 'includes/heroheader/hero_allslider' );
			}
			?>

			<?php
			$dd_pagetitlebar_layout		 = bigbo_get_option( 'dd_pagetitlebar_layout', 1 );
			$bigbo_enable_page_title	 = get_post_meta( $post_id, 'bigbo_enable_page_title', true );
                        if (empty($bigbo_enable_page_title)) {
                            $bigbo_enable_page_title = 'default';
                        }
                        if ( is_home() || is_front_page() ) {
                            //Do Nothing
                        } elseif ( $bigbo_enable_page_title == 'on' || ( $bigbo_enable_page_title == 'default' && $dd_pagetitlebar_layout == 1 ) ) {
                            bigbo_page_title_bar();
                        }
	    