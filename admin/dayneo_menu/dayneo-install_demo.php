<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/* include file for auto install */
get_template_part('admin/dayneo_menu/dayneo', 'menu_header');
$dayneo_theme = wp_get_theme();
?>
<div>
    <p class="about"><?php esc_html_e("Dayneo has different demos ready with one click demo install supported so you can choose any of demo according to your niche. Dayneo templates are built with super fast light weight Elementor page builder with drag and drop function so your website will not load heavily", "dayneo"); ?></p>
</div>
<h2 class="install_demo_title"><?php esc_html_e('Is your store looks same as our live theme demo?', 'dayneo'); ?></h2>
<?php
$auto_install = get_option('listing_xml');
$layout = get_option('layout');
if ($auto_install == 0) {
    $class = 'select_demo';
} else {
    $class = '';
}
?>
<div class="demo_layout_wrap <?php echo esc_attr($class); ?>">
    <div class="row">

	<!--Dayneo Demo-1-->
        <div class="demodiv">
	    <div class="bgframe <?php if ($layout == 'auto_install_layout1') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout1') { echo 'selected'; } ?>" demo-attr="auto_install_layout1" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo1.jpg');"></span>
			<div class="img_hover"><span><a href="<?php echo esc_url('http://dayneo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'dayneo'); ?></a></span></div>
		</div>
        </div>
	
	<!--Dayneo Demo-2-->
        <div class="demodiv">
	    <div class="bgframe <?php if ($layout == 'auto_install_layout2') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout2') { echo 'selected'; } ?>" demo-attr="auto_install_layout2" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo2.jpg');"></span>
			<div class="img_hover"><span><a href="<?php echo esc_url('http://architecture.dayneo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'dayneo'); ?></a></span></div>
		</div>
        </div>
	
	<!--Dayneo Demo-3-->
        <div class="demodiv">
	    <div class="bgframe <?php if ($layout == 'auto_install_layout3') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout3') { echo 'selected'; } ?>" demo-attr="auto_install_layout3" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo3.jpg');"></span>
			<div class="img_hover"><span><a href="<?php echo esc_url('http://construction.dayneo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'dayneo'); ?></a></span></div>
		</div>
        </div>
	
	<!--Dayneo Demo-4-->
        <div class="demodiv">
	    <div class="bgframe <?php if ($layout == 'auto_install_layout4') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout4') { echo 'selected'; } ?>" demo-attr="auto_install_layout4" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo4.jpg');"></span>
			<div class="img_hover"><span><a href="<?php echo esc_url('http://fitness.dayneo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'dayneo'); ?></a></span></div>
		</div>
        </div>
	
	<!--Dayneo Demo-5-->
        <div class="demodiv">
	    <div class="bgframe <?php if ($layout == 'auto_install_layout5') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout5') { echo 'selected'; } ?>" demo-attr="auto_install_layout5" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo5.jpg');"></span>
			<div class="img_hover"><span><a href="<?php echo esc_url('http://onepage.dayneo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'dayneo'); ?></a></span></div>
		</div>
        </div>
	
	<!--Dayneo comingsoon-->
        <div class="demodiv">
		<div class="bgframe <?php if ($layout == 'auto_install_comingsoon') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_comingsoon') { echo 'selected'; } ?>" demo-attr="auto_install_comingsoon" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/comingsoon.jpg');"></span>
		</div>
        </div>

    </div>
    <div class="one-col demo_install_button">    
        <?php
        $auto_install = get_option('listing_xml');
        if ($auto_install == 0) {
            ?>
            <div class="start_install">
                <a id="auto-install" class="install_demo" data-href=""><?php esc_html_e('Install Sample Data', 'dayneo'); ?></a>
            </div><?php
        }
        if ($auto_install == 1) {
            ?>
            <div class="start_install end_install">
                <a id="remove-auto-install" class="uninstall_demo" data-href="" ><?php esc_html_e('Uninstall Sample Data', 'dayneo'); ?></a>
            </div><?php
        }
        ?>
    </div>
    <div class="auto_install_details">
        <?php if ($auto_install == 0) { ?>
            <p class="theme_import_note"><?php esc_html_e("So that you don't start on a blank site, the sample data will help you get started with the theme. The content includes some default settings, widgets in their locations, pages, posts and a few dummy posts.", 'dayneo'); ?></p>
            <?php
        }
        if ($auto_install == 1) {
            ?>
            <p class="theme_export_note"> <?php esc_html_e("NOTE: Bofore click on Uninstall-Sample-Data button, you'll never restore your current store configuration and settings ", 'dayneo'); ?></p>
                <?php
            }
            ?>
    </div>
    <div class="auto-install-loader">
        <p>
            <?php
            $auto_install = get_option('listing_xml');
            if ($auto_install == 0) {
                esc_html_e('This could take a moment. Please do not close this window until it completes.', 'dayneo');
            }
            if ($auto_install == 1) {
                esc_html_e('This could take a moment. Please do not close this window until it completes.', 'dayneo');
            }
            ?>
        </p>
    </div>
    <div class="clear"></div>
</div>