<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_template_part('admin/dayneo_menu/dayneo', 'menu_header');
$dayneo_theme = wp_get_theme();
?>

<div class="point-releases">
    <h3><?php esc_html_e('Dayneo Theme', 'dayneo'); ?></h3> 
    <p><strong><?php esc_html_e('Dayneo Multipurpose Responsive WordPress Theme', 'dayneo'); ?></strong> <?php esc_html_e("with light weight and less plugins. Ready to use for any purpose such as business, corporate, agency, portfolio, app, news, blog, magazine, cleaning services, construction, designs, freelancer, wedding, restaurant and many more. Dayneo has different demos ready with one click demo install supported so you can choose any of demo according to your niche. Dayneo templates are built with super fast light weight Elementor page builder with drag and drop function so your website will not load heavily. We have added lots of options in theme options panel with Redux framework so you don’t need any coding knowledge.", "dayneo"); ?></p>
</div>

<div class="theme_info">
    <div class="theme_info_column">
        <div class="theme_info_left">
            <div class="theme_link">
                <h3><?php esc_html_e('Theme Options', 'dayneo'); ?></h3>
                <p class="about"><?php printf(esc_html__('%s provides own theme option panel. Click on "Theme Options" to start your customization.', 'dayneo'), ucfirst($dayneo_theme->get('Name'))); ?></p>
                <p>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=dayneo_options')); ?>" class="button button-primary"><?php esc_html_e('Theme Options', 'dayneo'); ?></a>
                </p>
            </div>
            <div class="theme_link">
                <h3><?php esc_html_e('Theme Documentation', 'dayneo'); ?></h3>
                <p class="about"><?php printf(esc_html__('Need any help to setup and configure %s? Please have a look at our documentations instructions,', 'dayneo'), $dayneo_theme->get('Name')); ?><br><?php esc_html_e("It includes with Theme-Package > Documentation", 'dayneo'); ?></p>
            </div>
        </div>

        <div class="theme_info_right">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/screenshot.png'); ?>" alt="<?php esc_attr_e('Theme Screenshot', 'dayneo') ?>" />
        </div>

	<div class="clear"></div>
    </div>
</div>

</div>
<!-- CLOSE .wrap about-wrap .mega_menu_wrap -->