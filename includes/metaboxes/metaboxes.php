<?php

class dayneo_ThemeFrameworkMetaboxes {

    public function __construct() {
        global $smof_data;
	
        $this->data = $smof_data;

        add_action('add_meta_boxes', array($this, 'dayneo_add_meta_boxes'));
        add_action('save_post', array($this, 'dayneo_save_meta_boxes'));
        //add_action('admin_print_scripts-post.php', array($this, 'dayneo_print_metabox_scripts'));
        //add_action('admin_print_scripts-post-new.php', array($this, 'dayneo_print_metabox_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'dayneo_admin_script_loader'));
    }

    // Load backend scripts
    function dayneo_admin_script_loader() {
        global $pagenow;
	
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_register_script('dayneo_upload', get_template_directory_uri() . '/admin/assets/js/upload.js');
            wp_enqueue_script('dayneo_upload');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
    }

    public function dayneo_add_meta_boxes() {
        $post_types = get_post_types(array('public' => true));

        $disallowed = array('page', 'post', 'attachment', 'dayneo_portfolio', 'ThemeVedanta_elastic', 'product', 'wpsc-product', 'slide');

        $this->dayneo_add_meta_box('dayneo_post_options', 'Post Options', 'post');
        $this->dayneo_add_meta_box('dayneo_page_options', 'Page Options', 'page');
        $this->dayneo_add_meta_box('dayneo_portfolio_options', 'Portfolio Options', 'dayneo_portfolio');
        $this->dayneo_add_meta_box('dayneo_woocommerce_options', 'Product Options', 'product');
        $this->dayneo_add_meta_box('dayneo_slide_options', 'Slide Options', 'slide');
    }

    public function dayneo_add_meta_box($id, $label, $post_type) {
        add_meta_box(
                'dayneo_' . $id, $label, array($this, $id), $post_type
        );
    }

    public function dayneo_save_meta_boxes($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        foreach ($_POST as $key => $value) {
            if (strstr($key, 'dayneo_')) {
                update_post_meta($post_id, $key, $value);
            }
        }
    }

    public function dayneo_post_options() {
        get_template_part('includes/metaboxes/style');
        $this->dayneo_render_option_tabs(array('layout', 'pagetitlebar', 'slider', 'sidebars'));
    }

    public function dayneo_page_options() {
        get_template_part('includes/metaboxes/style');
        $this->dayneo_render_option_tabs(array('layout', 'heroheader', 'pagetitlebar', 'slider', 'sidebars', 'pageportfolio'));
    }

    public function dayneo_portfolio_options() {
        get_template_part('includes/metaboxes/style');
        $this->dayneo_render_option_tabs(array('portfoliopost'));
    }
    
    public function dayneo_woocommerce_options() {
        get_template_part('includes/metaboxes/style');
        include_once 'woocommerce_options.php';
    }

    public function dayneo_slide_options() {
        get_template_part('includes/metaboxes/style');
        include_once 'slide_options.php';
    }

    public function dayneo_text($id, $label, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="dayneo_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<input type="text" id="dayneo_' . esc_attr($id) . '" name="dayneo_' . esc_attr($id) . '" value="' . get_post_meta($post->ID, 'dayneo_' . $id, true) . '" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function dayneo_select($id, $label, $options, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="dayneo_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select id="dayneo_' . esc_attr($id) . '" name="dayneo_' . esc_attr($id) . '">';
        foreach ($options as $key => $option) {
            if (get_post_meta($post->ID, 'dayneo_' . $id, true) == $key) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }

            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function dayneo_multiple($id, $label, $options, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="ved_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select multiple="multiple" id="ved_' . esc_attr($id) . '" name="dayneo_' . esc_attr($id) . '[]">';
        foreach ($options as $key => $option) {
            if (is_array(get_post_meta($post->ID, 'dayneo_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'dayneo_' . $id, true))) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }

            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function dayneo_textarea($id, $label, $desc = '', $default = '') {
        global $post;

        $db_value = get_post_meta($post->ID, 'dayneo_' . $id, true);

        $value = $db_value;

        $html = '';
        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="dayneo_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<textarea cols="120" rows="10" id="dayneo_' . esc_attr($id) . '" name="dayneo_' . esc_attr($id) . '">' . esc_textarea($value) . '</textarea>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function dayneo_image_radio_button($id, $label, $options, $desc = '', $default = '') {
        global $post;
        $class = '';
        $checked = '';
        $javascript_ids = '';
        foreach ($options as $k => $v) {
            $javascript_ids .= "#image_{$k},";
        }
        $javascript_ids = rtrim($javascript_ids, ",");

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="dayneo_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        foreach ($options as $key => $option) {
            $html .= '<input type="radio" style="display:none;" id="' . $key . '" name="dayneo_' . esc_attr($id) . '" value="' . $key . '" ';
            if (get_post_meta($post->ID, 'dayneo_' . $id, true) == $key) {
                $checked = 'checked="checked"';
                $class = 'dayneo_img_border_radio dayneo_img_selected';
            } elseif (get_post_meta($post->ID, 'dayneo_' . $id, true) == '' && $key == $default) {
                $checked = 'checked="checked"';
                $class = 'dayneo_img_border_radio dayneo_img_selected';
            } else {
                $checked = '';
                $class = 'dayneo_img_border_radio';
            }

            $html .= $checked . ">";
            $html .= "<img src='".esc_url($option)."' alt='' id='image_$key' class='".esc_attr($class)."' onclick='document.getElementById(\"$key\").checked=true;jQuery(\"$javascript_ids\").removeClass(\"dayneo_img_selected\");jQuery(this).addClass(\"dayneo_img_selected\");' />";
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function dayneo_upload($id, $label, $desc = '') {
        global $post;

        $dayneo_upload_img_id = get_post_meta($post->ID, 'dayneo_' . $id, true);
        $dayneo_upload_src = wp_get_attachment_url($dayneo_upload_img_id);

        $html = '';
        $html .= '<div class="ved_metabox_field .redux-main">';
        $html .= '<label for="dayneo_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $hide1 = '';
        $hide2 = '';
        if ($dayneo_upload_src) {
            $hide1 = 'hidden';
        }
        if (!$dayneo_upload_src) {
            $hide2 = 'hidden';
        }

        $html .= '<input type="text" id="dayneo-media-remove-extra-' . esc_attr($id) . '" class="upload_field ' . esc_attr($hide1) . '" value="" /></br>';

        $html .= '<div id="dayneo-media-display-' . esc_attr($id) . '">';
        if ($dayneo_upload_src) :
            $html .= '<input type="text" class="upload_field" value="' . esc_attr($dayneo_upload_src) . '" /></br>';
            if ( $id != 'webm' && $id != 'mp4' && $id != 'ogv' ) 
                $html .= '<img src="' . esc_url($dayneo_upload_src) . '" class="redux-option-image" style="width:60px; height:60px;" />';
        endif;
        $html .= '</div>';

        $html .= '<input class="dayneo_upload_button button ' . esc_attr($hide1) . '" id="dayneo-media-upload-' . esc_attr($id) . '" data-media-id="' . esc_attr($id) . '" type="button" value="Upload" />';
        $html .= '<input class="dayneo_remove_button button ' . esc_attr($hide2) . '" id="dayneo-media-remove-' . esc_attr($id) . '" data-media-id="' . esc_attr($id) . '" type="button" value="Remove" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<input type="hidden" id="dayneo_' . esc_attr($id) . '" name="dayneo_' . esc_attr($id) . '" value="' . get_post_meta($post->ID, 'dayneo_' . $id, true) . '" />';

        echo $html;
    }

    public function dayneo_render_option_tabs($requested_tabs, $post_type = 'default') {
        $tabs_names = array(
            'layout' => __('Layout', 'dayneo'),
            'heroheader' => __('Hero Header', 'dayneo'),
            'pagetitlebar' => __('Page Title Bar', 'dayneo'),
            'pageportfolio' => __('Portfolio', 'dayneo'),
            'slider' => __('Slider', 'dayneo'),
            'portfoliopost' => __('Portfolio', 'dayneo'),
            'sidebars' => __('Sidebar', 'dayneo'),
        );

        $tabs_icons = array(
            'layout' => 'fa fa-dashboard',
            'heroheader' => 'fa fa-window-maximize',
            'pagetitlebar' => 'fa fa-pencil-square-o',
            'pageportfolio' => 'fa fa-th',
            'slider' => 'fa fa-image',
            'portfoliopost' => 'fa fa-list',
            'sidebars' => 'fa fa-columns',
        );

        echo '<ul class="ved_metabox_tabs">';

        foreach ($requested_tabs as $key => $tab_name) {
            $class_active = '';
            if ($key === 0) {
                $class_active = ' class="active"';
            }

            if ($tab_name == 'page' &&
                    $post_type == 'product'
            ) {
                printf('<li%s><a href="%s">%s</a></li>', $class_active, esc_attr($tab_name), esc_html($tabs_names[$post_type]));
            } else {
                printf('<li%s><a href="%s"><i class="%s"></i>%s</a></li>', $class_active, esc_attr($tab_name), esc_attr($tabs_icons[$tab_name]), esc_html($tabs_names[$tab_name]));
            }
        }

        echo '</ul>';

        echo '<div class="ved_metabox_main">';

        foreach ($requested_tabs as $key => $tab_name) {
            $class_active = '';
            if ($key === 0) {
                $class_active = 'active';
            }
            printf('<div class="ved_metabox_tab %s" id="ved_tab_%s">', esc_attr($class_active), esc_attr($tab_name));
            require_once( sprintf('page_tabs/tab_%s.php', $tab_name) );
            echo '</div>';
        }

        echo '</div>';
        echo '<div class="clear"></div>';
    }

}

$metaboxes = new dayneo_ThemeFrameworkMetaboxes;
