<?php

/**
 * Start Auto Install Process
 */
function auto_install_layout() {
	theme_auto_install();

	$theme_name = str_replace( ' ', '', strtolower( wp_get_theme() ) );

	/*
	 *  Import Data using xml
	 */
	$layout = sanitize_text_field($_POST[ 'layout' ]);
	if ( $layout != '' ) {
		if ( get_option( 'listing_xml' ) != 1 ) {
			$xml_import = new Vedanta_Theme_Import();

			// Themeoptions Import
			$theme_options_txt	 = get_template_directory() . '/lib/auto-install/' . $layout . '/theme-options.json';
			$theme_options_txt	 = get_local_file_contents( $theme_options_txt );
			$datafile		 = json_decode( ($theme_options_txt ), true );
			update_option( 'dd_options', $datafile );

			global $wp_registered_sidebars;

			// Sample Data Import
			$import_all_contents = get_template_directory() . '/lib/auto-install/' . $layout . '/import-sample-contents.xml';
			if ( file_exists( $import_all_contents ) ) {
				$flag = 'content';
				$xml_import->import( $import_all_contents, $flag );
			}

			// Widgets Import
			$import_all_widgets = get_template_directory() . '/lib/auto-install/' . $layout . '/import-widgets.wie';
			if ( file_exists( $import_all_widgets ) ) {
				$flag = 'widget';
				$xml_import->import( $import_all_widgets, $flag );
			}

			// Themevedanta Sliders Import
			$ved_url = get_template_directory() . '/lib/auto-install/' . $layout . '/ved_slider.zip';
			if ( file_exists( $ved_url ) ) {
				@dayneo_import_vedsliders( $ved_url );
			}

			update_option( 'listing_xml', 1 );

			// Set Reading Options
			$homepage = get_page_by_title( 'Front Page' );
			if ( isset( $homepage ) && $homepage->ID ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $homepage->ID ); // Front Page
			}

			$postspage = get_page_by_title( 'Blog' );
			if ( isset( $postspage ) && $postspage->ID ) {
				update_option( 'page_for_posts', $postspage->ID ); // Front Page
			}

			/* Set the nav menu location option as per menu type */
			$theme_name = get_option( 'stylesheet' );
		}

		theme_install_process();
	}
}

if ( ! function_exists( 'remove_auto_update' ) ) {

	/**
	 * Start Remove Auto Install Process
	 */
	function remove_auto_update() {
		global $wpdb;
		$args			 = array(
			'post_type'	 => array(
				'post',
				'page',
				'products',
				'oredrs',
				'attachment',
				'dayneo_portfolio',
				'slide',
			),
			'post_status'	 => array( 'publish', 'draft', 'pending', 'future' ),
			'posts_per_page' => -1
		);
		$get_after_page_post	 = new WP_Query( $args );

		if ( $get_after_page_post->have_posts() ) {
			$after_post_page_arr = array();
			while ( $get_after_page_post->have_posts() ) :
				$get_after_page_post->the_post();
				$after_post_page_arr[] = get_the_ID();
			endwhile;
			wp_reset_postdata();
		}
		$attachment			 = array(
			'post_type'	 => 'attachment',
			'post_mime_type' => array( 'image', 'video', 'audio' ),
			'post_status'	 => 'inherit',
			'posts_per_page' => - 1,
		);
		$after_attchment_install	 = new WP_Query( $attachment );
		$after_attchment_install_arr	 = array();
		if ( $after_attchment_install->have_posts() ) :
			while ( $after_attchment_install->have_posts() ) :
				$after_attchment_install->the_post();
				$after_attchment_install_arr[] = get_the_id();
			endwhile;
			wp_reset_postdata();
		endif;
		$get_attachment	 = get_option( 'attchments_before_auto_install' );
		$var_diff	 = array_diff( $after_attchment_install_arr, $get_attachment );
		update_option( 'theme_attachment_id', $var_diff );

		$locations = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		$after_menu_arr = array();
		if ( $locations ) {
			foreach ( $locations as $menu_id ) {
				$after_menu_arr[] = $menu_id->term_id;
			}
		}
		$get_menu	 = get_option( 'menu_before_auto_install' );
		$menu_diff	 = array_diff( $after_menu_arr, $get_menu );
		update_option( 'menu_after_auto_install', $menu_diff );

		$theme_posts_before_auto_install = get_option( 'posts_before_auto_install' );
		$post_diff			 = array_diff( $after_post_page_arr, $theme_posts_before_auto_install );
		update_option( 'theme_sample_data_id', $post_diff );


		$diff		 = get_option( 'theme_sample_data_id' );
		$cat		 = get_option( 'categories_before_auto_install' );
		$tags		 = get_option( 'tags_before_auto_install' );
		$attachment	 = get_option( 'theme_attachment_id' );
		$menu_list	 = get_option( 'menu_after_auto_install' );

		// Remove Sidebar
		$before_auto_install_sidebar	 = get_option( 'before_auto_install_sidebars_widgets' );
		$after_auto_install_sidebar	 = get_option( 'sidebars_widgets' );
		update_option( 'after_auto_install_sidebars_widgets', $after_auto_install_sidebar );
		$after_auto_install_sidebar	 = get_option( 'after_auto_install_sidebars_widgets' );
		update_option( 'sidebars_widgets', $before_auto_install_sidebar );

		$remove_data	 = false;
		$remove_widget	 = false;
		$remove_options	 = false;

		foreach ( $diff as $value ) {
			$post_category = get_the_category( $value );
			if ( $post_category ) {
				$post_cate[] = $post_category;
			}
			$post_tag = wp_get_post_tags( $value );
			if ( $post_tag ) {
				$post_tags[] = $post_tag;
			}
		}

		//Remove installed post,page and its category,tag and attachment
		if ( $diff ) {
			//Remove category of post.
			foreach ( $post_cate as $post_cat ) {
				foreach ( $post_cat as $value ) {
					wp_delete_term( $value->term_id, 'category' );
				}
				update_option( 'categories_before_auto_install', '' );
			}

			//Remove tag of post.
			foreach ( $post_tags as $post_tag ) {
				foreach ( $post_tag as $value ) {
					wp_delete_term( $value->term_id, 'post_tag' );
				}
				update_option( 'tags_before_auto_install', '' );
			}

			//Remove attachment of post.
			if ( $attachment ) {
				foreach ( $attachment as $attachment_id ) {
					wp_delete_attachment( $attachment_id, true );
				}
				update_option( 'theme_attachment_id', '' );
			}

			//Remove post, pages, client and testimonial.
			foreach ( $diff as $value ) {
				wp_delete_post( $value, true );
			}
			update_option( 'theme_sample_data_id', '' );

			//Remove imported menu list.
			if ( $menu_diff ) {
				foreach ( $menu_diff as $value ) {
					if ( is_nav_menu( $value ) ) {
						$deletion = wp_delete_nav_menu( $value );
					} else {
						$nav_menu_selected_id = 0;
						unset( $_REQUEST[ 'menu' ] );
					}
				}
				update_option( 'menu_after_auto_install', '' );
			}

			$remove_data = true;
		}

		// Import Theme Options
		$theme_options_txt	 = get_template_directory() . '/lib/auto-install/default-options.json';
		$theme_options_txt	 = get_local_file_contents( $theme_options_txt );
		$datafile		 = json_decode( ($theme_options_txt ), true );
		update_option( 'dd_options', $datafile );

		update_option( 'listing_xml', 0 );
		update_option( 'layout', '' );
	}

}

if ( ! function_exists( 'theme_auto_install' ) ) {

	/**
	 * Import Sample Data
	 */
	function theme_auto_install() {
		global $wpdb;
		$layout				 = sanitize_text_field($_POST[ 'layout' ]);
		update_option( 'layout', $layout );
		$before_auto_install_sidebar	 = get_option( 'sidebars_widgets' );
		update_option( 'before_auto_install_sidebars_widgets', $before_auto_install_sidebar );
		update_option( 'show_on_front', 'page' );

		// Get post,page,attachment before auto install
		$args			 = array(
			'post_type'	 => array(
				'post',
				'page',
				'products',
				'attachment'
			),
			'post_status'	 => array( 'publish', 'draft', 'pending', 'future' ),
			'posts_per_page' => -1
		);
		$get_before_page_post	 = new WP_Query( $args );
		if ( $get_before_page_post->have_posts() ) {
			$post_page_arr = array();
			while ( $get_before_page_post->have_posts() ) : $get_before_page_post->the_post();
				$post_page_arr[] = get_the_ID();
			endwhile;
			wp_reset_postdata();
		}

		update_option( 'posts_before_auto_install', $post_page_arr );

		//Get all attachment id before auto install
		$attachment	 = array(
			'post_type'	 => 'attachment',
			'post_mime_type' => array( 'image', 'video', 'audio' ),
			'post_status'	 => 'inherit',
			'posts_per_page' => - 1,
		);
		$attachments	 = new WP_Query( $attachment );
		$attachment_ids	 = array();
		if ( $attachments->have_posts() ) :
			while ( $attachments->have_posts() ) :
				$attachments->the_post();
				$attachment_ids[] = get_the_id();
			endwhile;
			wp_reset_postdata();
		endif;
		update_option( 'attchments_before_auto_install', $attachment_ids );

		$theme_posts_before_auto_install = get_option( 'posts_before_auto_install' );
		$post_diff			 = $theme_posts_before_auto_install;
		if ( $post_diff ) {
			$post_cate	 = array();
			$post_tags	 = array();
			foreach ( $post_diff as $value ) {
				$post_category = get_the_category( $value );
				if ( $post_category ) {
					$post_cate[] = $post_category;
				}
				$post_tag = wp_get_post_tags( $value );
				if ( $post_tag ) {
					$post_tags[] = $post_tag;
				}
			}
			update_option( 'categories_before_auto_install', $post_cate );
			update_option( 'tags_before_auto_install', $post_tags );
		}

		$menu_arr	 = array();
		$nav_menus	 = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		if ( $nav_menus ) {
			foreach ( $nav_menus as $menu ) {
				$menu_arr[] = $menu->term_id;
			}
		}
		update_option( 'menu_before_auto_install', $menu_arr );
	}

}

/**
 * Import Theme4Press Sliders
 */
function dayneo_import_vedsliders( $zip_file ) {
	$upload_dir	 = wp_upload_dir();
	$base_dir	 = trailingslashit( $upload_dir[ 'basedir' ] );
	$ved_dir	 = $base_dir . 'ved_slider_exports/';

	@unlink( $ved_dir . 'sliders.xml' );
	@unlink( $ved_dir . 'settings.json' );

	$zip = new ZipArchive();
	$zip->open( $zip_file );
	$zip->extractTo( $ved_dir );
	$zip->close();

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', true );
	}

	if ( class_exists( 'WP_Importer' ) ) {
		$importer			 = new Vedanta_Theme_Import();
		$xml				 = $ved_dir . 'sliders.xml';
		$importer->fetch_attachments	 = true;
		$flag = 'content';
		ob_start();
		$importer->import( $xml, $flag );
		ob_end_clean();

		$loop = new WP_Query( array( 'post_type' => 'slide', 'posts_per_page' => -1, 'meta_key' => '_thumbnail_id' ) );

		while ( $loop->have_posts() ) {
			$loop->the_post();
			$thumbnail_ids[ get_post_meta( get_the_ID(), '_thumbnail_id', true ) ] = get_the_ID();
		}

		foreach ( new DirectoryIterator( $ved_dir ) as $file ) {
			if ( $file->isDot() || $file->getFilename() == '.DS_Store' ) {
				continue;
			}

			$image_path = pathinfo( $ved_dir . $file->getFilename() );
			if ( $image_path[ 'extension' ] != 'xml' && $image_path[ 'extension' ] != 'json' ) {
				$filename	 = $image_path[ 'filename' ];
				$new_image_path	 = $upload_dir[ 'path' ] . '/' . $image_path[ 'basename' ];
				$new_image_url	 = $upload_dir[ 'url' ] . '/' . $image_path[ 'basename' ];
				@copy( $ved_dir . $file->getFilename(), $new_image_path );

				// Check the type of tile. We'll use this as the 'post_mime_type'.
				$filetype = wp_check_filetype( basename( $new_image_path ), null );

				// Prepare an array of post data for the attachment.
				$attachment = array(
					'guid'		 => $new_image_url,
					'post_mime_type' => $filetype[ 'type' ],
					'post_title'	 => preg_replace( '/\.[^.]+$/', '', basename( $new_image_path ) ),
					'post_content'	 => '',
					'post_status'	 => 'inherit'
				);

				// Insert the attachment.
				$attach_id = wp_insert_attachment( $attachment, $new_image_path, $thumbnail_ids[ $filename ] );

				// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

				// Generate the metadata for the attachment, and update the database record.
				$attach_data = wp_generate_attachment_metadata( $attach_id, $new_image_path );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				set_post_thumbnail( $thumbnail_ids[ $filename ], $attach_id );
			}
		}

		$url	 = wp_nonce_url( 'edit.php?post_type=slide&page=ved_export_import' );
		if ( false === ($creds	 = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
			return; // stop processing here
		}

		if ( WP_Filesystem( $creds ) ) {
			global $wp_filesystem;

			$settings = $wp_filesystem->get_contents( $ved_dir . 'settings.json' );

			$decode = json_decode( $settings, TRUE );

			foreach ( $decode as $slug => $settings ) {
				$get_term = get_term_by( 'slug', $slug, 'slide-page' );

				if ( $get_term ) {
					update_option( 'taxonomy_' . $get_term->term_id, $settings );
				}
			}
		}
	}
}

/**
 * Get Theme Data Before Auto Install
 */
if ( ! function_exists( 'get_id_by_slug' ) ) {

	function get_id_by_slug( $page_slug ) {
		$page = get_page_by_path( $page_slug );
		if ( $page ) {
			return $page->ID;
		} else {
			return null;
		}
	}

}

/**
 * Get Theme Data Content
 */
function get_local_file_contents( $file_path ) {
	ob_start();
	include $file_path;
	$contents = ob_get_clean();

	return $contents;
}

/**
 * Serialize Data
 */
function is_serial_data( $serialdata ) {
	return (@unserialize( $serialdata ) !== false || $serialdata == 'b:0;');
}

/**
 * Set Primarty Menu And Top Menu
 * 
 * Check always menu slug and menu locations name 
 * before create new demo for new theme
 */
function theme_install_process() {
	/* Set the nav menu location option as per menu type */
	$theme_name = get_option( 'stylesheet' );

	/* get the nav menu list */
	$nav_menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

	foreach ( $nav_menus as $menus ) {
		if ( $menus->slug == 'mainmenu' ) {
			$primary_term_id = $menus->term_id;
		}
		if ( $menus->slug == 'topmenu' ) {
			$top_term_id = $menus->term_id;
		}
	}

	$nav_menu_locations = get_option( 'theme_mods_' . strtolower( $theme_name ) );
	/* Check if primary menu is available or not */
	if ( ! has_nav_menu( 'primary-menu' ) ) {
		$nav_menu_locations[ 'nav_menu_locations' ][ 'primary-menu' ] = $primary_term_id ? $primary_term_id : '';
	}
	if ( ! has_nav_menu( 'top-menu' ) ) {
		$nav_menu_locations[ 'nav_menu_locations' ][ 'top-menu' ] = $top_term_id ? $top_term_id : '';
	}

	/* set menu in database */
	if ( ! empty( $nav_menu_locations ) ) {
		update_option( 'theme_mods_' . strtolower( $theme_name ), $nav_menu_locations );
	}
}
