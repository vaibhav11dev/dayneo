<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/* include file for auto install */
get_template_part('admin/bigbo_menu/bigbo', 'menu_header');
$bigbo_theme = wp_get_theme();
?>
<div class="container">
    <div class="box">
        <p class="install_demo_title"><?php esc_html_e('Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch. ', 'bigbo'); ?></p>
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

        	   <!--Bigbo Demo-1-->
                <div class="demodiv">
        	    <div class="bgframe demo <?php if ($layout == 'auto_install_layout1') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout1') { echo 'selected'; } ?>" demo-attr="auto_install_layout1" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo1.jpg');"></span>
        			<div class="img_hover"><span>Homepage 1</span><a href="<?php echo esc_url('http://bigbo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'bigbo'); ?></a></div>
        		</div>
                </div>
        	
        	   <!--Bigbo Demo-2-->
                <div class="demodiv">
        	    <div class="bgframe demo <?php if ($layout == 'auto_install_layout2') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout2') { echo 'selected'; } ?>" demo-attr="auto_install_layout2" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo2.jpg');"></span>
        			<div class="img_hover"><span>Homepage 2</span><a href="<?php echo esc_url('http://architecture.bigbo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'bigbo'); ?></a></div>
        		</div>
                </div>
        	
        	   <!--Bigbo Demo-3-->
                <div class="demodiv">
        	    <div class="bgframe demo <?php if ($layout == 'auto_install_layout3') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_layout3') { echo 'selected'; } ?>" demo-attr="auto_install_layout3" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/demo3.jpg');"></span>
        			<div class="img_hover"><span>Homepage 3</span><a href="<?php echo esc_url('http://construction.bigbo.themevedanta.com'); ?>" target="_blank"><?php esc_html_e('Live Demo', 'bigbo'); ?></a></div>
        		</div>
                </div>
        	
        	   <!--Bigbo comingsoon-->
                <div class="demodiv">
        		<div class="bgframe comingsoon <?php if ($layout == 'auto_install_comingsoon') { echo 'selected'; } ?>"><span class="scroll_image <?php if ($layout == 'auto_install_comingsoon') { echo 'selected'; } ?>" demo-attr="auto_install_comingsoon" style="background-image:url('<?php echo esc_url(get_template_directory_uri()); ?>/admin/assets/images/demo/comingsoon.jpg');"></span>
                    <div class="img_hover"><span>Homepage 4</span><a href="javascript:void(0)" target="_blank"><?php esc_html_e('Live Demo', 'bigbo'); ?></a></div>
        		</div>
                </div>

            </div>

            <div class="one-col demo_install_button">    
                <?php
                $auto_install = get_option('listing_xml');
                if ($auto_install == 0) {
                    ?>
                    <div class="start_install">
                        <a id="auto-install" class="install_demo" data-href=""><?php esc_html_e('Install Sample Data', 'bigbo'); ?></a>
                    </div><?php
                }
                if ($auto_install == 1) {
                    ?>
                    <div class="start_install end_install">
                        <a id="remove-auto-install" class="uninstall_demo" data-href="" ><?php esc_html_e('Uninstall Sample Data', 'bigbo'); ?></a>
                    </div><?php
                }
                ?>
            </div>

            <div class="auto_install_details">
                
                <?php
                if ($auto_install == 1) {
                    ?>
                    <p class="theme_export_note"> <?php esc_html_e("NOTE: Bofore click on Uninstall-Sample-Data button, you'll never restore your current store configuration and settings ", 'bigbo'); ?></p>
                        <?php
                    }
                ?>
            </div>

            <div class="auto-install-loader">
                <p>
                    <?php
                    $auto_install = get_option('listing_xml');
                    if ($auto_install == 0) {
                        esc_html_e('This could take a moment. Please do not close this window until it completes.', 'bigbo');
                    }
                    if ($auto_install == 1) {
                        esc_html_e('This could take a moment. Please do not close this window until it completes.', 'bigbo');
                    }
                    ?>
                </p>
            </div>

        </div>
    </div>
</div>        