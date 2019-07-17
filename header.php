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
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
		$ved_favicon		 = bigbo_get_option( 'ved_favicon' );
		$ved_iphone_icon		 = bigbo_get_option( 'ved_iphone_icon' );
		$ved_iphone_icon_retina	 = bigbo_get_option( 'ved_iphone_icon_retina' );
		$ved_ipad_icon		 = bigbo_get_option( 'ved_ipad_icon' );
		$ved_ipad_icon_retina	 = bigbo_get_option( 'ved_ipad_icon_retina' );

                if ( isset($ved_favicon[ 'url' ]) && $ved_favicon[ 'url' ] ):
                    ?>
                    <!-- Favicon -->
                    <!-- Firefox, Chrome, Safari, IE 11+ and Opera. -->
                    <link rel="shortcut icon" href="<?php echo esc_url($ved_favicon[ 'url' ]); ?>" type="image/x-icon" />
                    <?php
                endif;
                if ( isset($ved_iphone_icon[ 'url' ]) && $ved_iphone_icon[ 'url' ] ):
                    ?>
                    <!-- For iPhone -->
                    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($ved_iphone_icon[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($ved_iphone_icon_retina[ 'url' ]) && $ved_iphone_icon_retina[ 'url' ] ):
                    ?>
                    <!-- For iPhone 4 Retina display -->
                    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url($ved_iphone_icon_retina[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($ved_ipad_icon[ 'url' ]) && $ved_ipad_icon[ 'url' ] ):
                    ?>
                    <!-- For iPad -->
                    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($ved_ipad_icon[ 'url' ]); ?>">
                    <?php
                endif;
                if ( isset($ved_ipad_icon_retina[ 'url' ]) && $ved_ipad_icon_retina[ 'url' ] ):
                    ?>
                    <!-- For iPad Retina display -->
                    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url($ved_ipad_icon_retina[ 'url' ]); ?>">
                    <?php
                endif;
                ?>		
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<?php $ved_demo_style = bigbo_get_option( 'ved_demo_style', 'dddemo1' ); ?>
	<body <?php body_class($ved_demo_style); ?>>
                <?php
                $ved_back_to_top = bigbo_get_option( 'ved_back_to_top', 'right' );
                if ( $ved_back_to_top == 1 ) {
                    ?>
                    <div class="back-to-top">
                        <a href="#top" class="scroll-top"><i class="ti-arrow-up"></i></a>
                    </div>
                    <?php
                }
                ?>
		<?php
		global $post, $wp_query, $ved_options;

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

		$ved_siteloader	 = bigbo_get_option( 'ved_siteloader', 1 );
		$ved_loaderfile	 = bigbo_get_option( 'ved_loaderfile' );
		if ( $ved_siteloader == 1 && isset($ved_loaderfile) && $ved_loaderfile ) {
			?>
			<!-- PRELOADER -->
			<div class="page-loader"><img src="<?php echo esc_url($ved_loaderfile[ 'url' ]); ?>" alt="siteloader" ></div>
			<!-- END PRELOADER -->
			<?php
		}

		$ved_header_type		 = bigbo_get_option( 'ved_header_type', 'h1' );
		switch ( $ved_header_type ) {
			case 'h1':
				$header_type = 'header-1';
				break;

			case 'h2':
				$header_type = 'header-2';
				break;

			case 'h3':
				$header_type = 'header-3';
				break;
			
			case 'h4':
				$header_type = 'header-4';
				break;
			
			case 'h5':
				$header_type = 'header-5';
				break;
		}

		$ved_header_transparent = bigbo_get_option( 'ved_header_transparent' );
		$ved_header_type_check = bigbo_get_option( 'ved_header_type' );
		$ved_header_transparent_class = "";
		if ($ved_header_transparent && $ved_header_type_check == "h3") {
		    $ved_header_transparent_class = "header-transparent";
		}
		?>

		<div id="header" class="header-wrap <?php echo esc_attr( $header_type ); ?> <?php echo esc_attr($ved_header_transparent_class); ?>">
			<?php get_template_part( 'template-parts/header/'.$header_type ); ?>
		</div>

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
			}
			?>

			<?php
			$ved_pagetitlebar_layout		 = bigbo_get_option( 'ved_pagetitlebar_layout', 1 );
			$bigbo_enable_page_title	 = get_post_meta( $post_id, 'bigbo_enable_page_title', true );
                        if (empty($bigbo_enable_page_title)) {
                            $bigbo_enable_page_title = 'default';
                        }
                        if ( ( ! is_home() || ! is_front_page() ) && ( $bigbo_enable_page_title == 'on' || ( $bigbo_enable_page_title == 'default' && $ved_pagetitlebar_layout == 1 ) ) ) {
                            bigbo_page_title_bar();
                        }
	    