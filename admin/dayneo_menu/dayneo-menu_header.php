<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $submenu;

if (isset($submenu['dayneo-menu'])) {
    $menu_items = $submenu['dayneo-menu'];
}

if (is_array($menu_items)) {
    settings_errors();
    ?>
    <div class="wrap about-wrap mega_menu_wrap">

        <h1><?php esc_html_e('Welcome to Dayneo Theme', 'dayneo'); ?></h1>
        <div class="theme_content">
            <div class="about-text"><?php esc_html_e('Thank you for activation! Dayneo Theme makes it even easier to format your content and customize your site.', 'dayneo'); ?></div>

    <?php $dayneo_theme = wp_get_theme(); ?>

            <div class="wp-badge" style="padding-top:0;background: url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/dark-logo.png') no-repeat scroll 100% center / 100% auto rgba(0, 0, 0, 0) ;box-shadow: none;color: #32373c;"><?php printf(esc_html__('Version %s', 'dayneo'), $dayneo_theme->get('Version')); ?></div>
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
        <?php
    }