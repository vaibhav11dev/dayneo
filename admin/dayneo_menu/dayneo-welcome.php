<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_template_part('admin/dayneo_menu/dayneo', 'menu_header');
$dayneo_theme = wp_get_theme();
?>
<div class="container">
    <div class="box"><div class="row">
        <div class="point-releases col-sm-6">
            <h3><?php esc_html_e('Dayneo Theme', 'dayneo'); ?></h3> 
            <p><strong><?php esc_html_e('Dayneo Multipurpose Responsive WordPress Theme', 'dayneo'); ?></strong> <?php esc_html_e("with light weight and less plugins. Ready to use for any purpose such as business, corporate, agency, portfolio, app, news, blog, magazine, cleaning services, construction, designs, freelancer, wedding, restaurant and many more.", "dayneo"); ?></p>
            <div class="theme_info">
                <div class="theme_info_column">
                    <div class="theme_info_left">
                        <div class="theme_link">
                            <h3><?php esc_html_e('Install Demos', 'dayneo'); ?></h3>
                            <p class="about"><?php printf(esc_html__('%s provides multiple demos. Click on "Install Demos" to install demo.', 'dayneo'), ucfirst($dayneo_theme->get('Name'))); ?></p>
                            <p>
                                <a href="<?php echo esc_url(admin_url('admin.php?page=dayneo_demos')); ?>" class="button button-primary"><?php esc_html_e('Install Demos', 'dayneo'); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme_info_right col-sm-6"><img src="<?php echo esc_url(get_template_directory_uri() . '/screenshot.png'); ?>" alt="<?php esc_attr_e('Theme Screenshot', 'dayneo') ?>" />
        </div>
    </div></div>

    <div class="row">
        <div class="col-sm-4">
            <div class="box feature-box text-center">
                <div class="feature-body">
                    <div class="feature-icon"><img src="<?php echo esc_url(get_template_directory_uri() . '/admin/assets/images/support.jpg'); ?>"></div>
                    <h3>Support</h3>
                    <p>Email us with any questions or inquiries. We would be happy to answer your questions and set up a meeting with you.</p>
                </div>
                <div class="feature-footer theme_info"><a href="mailto:support@innovatorythemes.com" class="button button-primary">Mail Us</a></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box feature-box text-center">
                <div class="feature-body">
                    <div class="feature-icon"><img src="<?php echo esc_url(get_template_directory_uri() . '/admin/assets/images/support.jpg'); ?>"></div>
                    <h3>Documention</h3>
                    <p>We understand that using WordPress or a new theme can be daunting. That's why we've created a collection of docs to help you.</p>
                </div>
                <div class="feature-footer theme_info"><a href="#" class="button button-primary">Explore Now</a></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box feature-box text-center">
                <div class="feature-body">
                    <div class="feature-icon"><img src="<?php echo esc_url(get_template_directory_uri() . '/admin/assets/images/support.jpg'); ?>"></div>
                    <h3>Contact Us</h3>
                    <p>Innovatory themes is on social media! Follow us on Facebook, Twitter and Instagram to keep up to date with the latest happenings.</p>
                </div>
                <div class="feature-footer theme_info">
                    <ul>
                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- CLOSE .wrap about-wrap .mega_menu_wrap -->