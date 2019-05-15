<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $submenu;

if (isset($submenu['bigbo-menu'])) {
    $menu_items = $submenu['bigbo-menu'];
}

if (is_array($menu_items)) {
    settings_errors();
    ?>
    <div class="wrap about-wrap mega_menu_wrap">
      <div class="def-bg">
      <div class="container head-contain">        
        <div class="theme_content">
          <h1><?php esc_html_e('Welcome to Bigbo Theme', 'bigbo'); ?></h1>
          <?php $bigbo_theme = wp_get_theme(); ?>
            <p><?php printf(esc_html__('Version %s', 'bigbo'), $bigbo_theme->get('Version')); ?></p>
            <div class="wp-badge" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/dark-logo.png');box-shadow: none;"></div>
        </div>
        <div class="nav-tab-wrapper">
            <?php
            foreach ($menu_items as $menu_item) {
                ?>
                <a href="?page=<?php echo esc_attr($menu_item[2]) ?>" class="nav-tab <?php
                   if (isset($_GET['page']) and $_GET['page'] == $menu_item[2]) {
                       echo 'nav-tab-active';
                   }
                   ?>"><?php echo esc_attr($menu_item[0]) ?></a>
                   <?php
               }
               ?>
		    <span class="clear"></span>
        </div>
      </div></div>
        <?php
    }