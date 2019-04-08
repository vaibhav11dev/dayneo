<?php

/**
 * ved MegaMenu Functions
 *
 * WARNING: This file is part of the Mega Menu Framework.
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 * @package  ved/MegaMenu
 * @author   ThemeVedanta
 * @link     http://ThemeVedanta.com
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    die;
}

// Don't duplicate me!
if (!class_exists('vedMegaMenuFramework')) {

    /**
     * Main vedMegaMenuFramework Class
     *
     * @since       4.0.0
     */
    class vedMegaMenuFramework {

        public static $_version = '4.0.0';
        public static $_name;
        public static $_url;
        public static $_urls;
        public static $_dir;
        public static $_dirs;
        public static $_classes;

        function __construct() {

            $this->init();

            add_action('ved_init', array($this, 'include_functions'));

            do_action('ved_init');
        }

// end __construct()

        static function init() {

            // Windows-proof constants: replace backward by forward slashes. Thanks to: @peterbouwmeester
            self::$_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
            $wp_content_dir = trailingslashit(str_replace('\\', '/', WP_CONTENT_DIR));
            $relative_url = str_replace($wp_content_dir, '', self::$_dir);
            $wp_content_url = ( is_ssl() ? str_replace('http://', 'https://', WP_CONTENT_URL) : WP_CONTENT_URL );
            self::$_url = trailingslashit($wp_content_url) . $relative_url;

            self::$_urls = array(
                'parent' => get_template_directory_uri() . '/',
                'child' => get_stylesheet_directory() . '/',
                'library' => self::$_url . 'library',
            );

            self::$_dirs = array(
                'parent' => get_template_directory() . '/',
                'child' => get_stylesheet_directory() . '/',
                'library' => self::$_dir . 'library',
            );
        }

// end init()

        public function include_functions() {


            // Load functions

            require_once( 'mega-menus.php' );

            self::$_classes['menus'] = new vedMegaMenu();
        }

// end include_functions()
    }

    $vedcore = new vedMegaMenuFramework();
}
