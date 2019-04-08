<?php

class daydream_ThemeFrameworkMetaboxes {

    public function __construct() {
        global $smof_data;
	
        $this->data = $smof_data;

        add_action('add_meta_boxes', array($this, 'daydream_add_meta_boxes'));
        add_action('save_post', array($this, 'daydream_save_meta_boxes'));
        //add_action('admin_print_scripts-post.php', array($this, 'daydream_print_metabox_scripts'));
        //add_action('admin_print_scripts-post-new.php', array($this, 'daydream_print_metabox_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'daydream_admin_script_loader'));
    }

    // Load backend scripts
    function daydream_admin_script_loader() {
        global $pagenow;
	
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_register_script('daydream_upload', get_template_directory_uri() . '/admin/assets/js/upload.js');
            wp_enqueue_script('daydream_upload');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
    }

    public function daydream_add_meta_boxes() {
        $post_types = get_post_types(array('public' => true));

        $disallowed = array('page', 'post', 'attachment', 'daydream_portfolio', 'ThemeVedanta_elastic', 'product', 'wpsc-product', 'slide');

        $this->daydream_add_meta_box('daydream_post_options', 'Post Options', 'post');
        $this->daydream_add_meta_box('daydream_page_options', 'Page Options', 'page');
        $this->daydream_add_meta_box('daydream_portfolio_options', 'Portfolio Options', 'daydream_portfolio');
        $this->daydream_add_meta_box('daydream_woocommerce_options', 'Product Options', 'product');
        $this->daydream_add_meta_box('slide_options', 'Slide Options', 'slide');
    }

    public function daydream_add_meta_box($id, $label, $post_type) {
        add_meta_box(
                'daydream_' . $id, $label, array($this, $id), $post_type
        );
    }

    public function daydream_save_meta_boxes($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        foreach ($_POST as $key => $value) {
            if (strstr($key, 'daydream_')) {
                update_post_meta($post_id, $key, $value);
            }
        }
    }

    public function daydream_post_options() {
        get_template_part('includes/metaboxes/style');
        $this->daydream_render_option_tabs(array('layout', 'pagetitlebar', 'slider', 'sidebars'));
    }

    public function daydream_page_options() {
        get_template_part('includes/metaboxes/style');
        $this->daydream_render_option_tabs(array('layout', 'heroheader', 'pagetitlebar', 'slider', 'sidebars', 'pageportfolio'));
    }

    public function daydream_portfolio_options() {
        get_template_part('includes/metaboxes/style');
        $this->daydream_render_option_tabs(array('portfoliopost'));
    }
    
    public function daydream_woocommerce_options() {
        get_template_part('includes/metaboxes/style');
        include_once 'woocommerce_options.php';
    }

    public function slide_options() {
        get_template_part('includes/metaboxes/style');
        include_once 'slide_options.php';
    }

    public function daydream_text($id, $label, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="daydream_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<input type="text" id="daydream_' . esc_attr($id) . '" name="daydream_' . esc_attr($id) . '" value="' . get_post_meta($post->ID, 'daydream_' . $id, true) . '" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function daydream_select($id, $label, $options, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="daydream_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select id="daydream_' . esc_attr($id) . '" name="daydream_' . esc_attr($id) . '">';
        foreach ($options as $key => $option) {
            if (get_post_meta($post->ID, 'daydream_' . $id, true) == $key) {
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

    public function daydream_multiple($id, $label, $options, $desc = '') {
        global $post;

        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="ved_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select multiple="multiple" id="ved_' . esc_attr($id) . '" name="daydream_' . esc_attr($id) . '[]">';
        foreach ($options as $key => $option) {
            if (is_array(get_post_meta($post->ID, 'daydream_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'daydream_' . $id, true))) {
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

    public function daydream_textarea($id, $label, $desc = '', $default = '') {
        global $post;

        $db_value = get_post_meta($post->ID, 'daydream_' . $id, true);

        $value = $db_value;

        $html = '';
        $html = '';
        $html .= '<div class="ved_metabox_field">';
        $html .= '<label for="daydream_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<textarea cols="120" rows="10" id="daydream_' . esc_attr($id) . '" name="daydream_' . esc_attr($id) . '">' . esc_textarea($value) . '</textarea>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function daydream_image_radio_button($id, $label, $options, $desc = '', $default = '') {
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
        $html .= '<label for="daydream_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        foreach ($options as $key => $option) {
            $html .= '<input type="radio" style="display:none;" id="' . $key . '" name="daydream_' . esc_attr($id) . '" value="' . $key . '" ';
            if (get_post_meta($post->ID, 'daydream_' . $id, true) == $key) {
                $checked = 'checked="checked"';
                $class = 'daydream_img_border_radio daydream_img_selected';
            } elseif (get_post_meta($post->ID, 'daydream_' . $id, true) == '' && $key == $default) {
                $checked = 'checked="checked"';
                $class = 'daydream_img_border_radio daydream_img_selected';
            } else {
                $checked = '';
                $class = 'daydream_img_border_radio';
            }

            $html .= $checked . ">";
            $html .= "<img src='".esc_url($option)."' alt='' id='image_$key' class='".esc_attr($class)."' onclick='document.getElementById(\"$key\").checked=true;jQuery(\"$javascript_ids\").removeClass(\"daydream_img_selected\");jQuery(this).addClass(\"daydream_img_selected\");' />";
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function daydream_upload($id, $label, $desc = '') {
        global $post;

        $daydream_upload_img_id = get_post_meta($post->ID, 'daydream_' . $id, true);
        $daydream_upload_src = wp_get_attachment_url($daydream_upload_img_id);

        $html = '';
        $html .= '<div class="ved_metabox_field .redux-main">';
        $html .= '<label for="daydream_' . esc_attr($id) . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $hide1 = '';
        $hide2 = '';
        if ($daydream_upload_src) {
            $hide1 = 'hidden';
        }
        if (!$daydream_upload_src) {
            $hide2 = 'hidden';
        }

        $html .= '<input type="text" id="daydream-media-remove-extra-' . esc_attr($id) . '" class="upload_field ' . esc_attr($hide1) . '" value="" /></br>';

        $html .= '<div id="daydream-media-display-' . esc_attr($id) . '">';
        if ($daydream_upload_src) :
            $html .= '<input type="text" class="upload_field" value="' . esc_attr($daydream_upload_src) . '" /></br>';
            if ( $id != 'webm' && $id != 'mp4' && $id != 'ogv' ) 
                $html .= '<img src="' . esc_url($daydream_upload_src) . '" class="redux-option-image" style="width:60px; height:60px;" />';
        endif;
        $html .= '</div>';

        $html .= '<input class="daydream_upload_button button ' . esc_attr($hide1) . '" id="daydream-media-upload-' . esc_attr($id) . '" data-media-id="' . esc_attr($id) . '" type="button" value="Upload" />';
        $html .= '<input class="daydream_remove_button button ' . esc_attr($hide2) . '" id="daydream-media-remove-' . esc_attr($id) . '" data-media-id="' . esc_attr($id) . '" type="button" value="Remove" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<input type="hidden" id="daydream_' . esc_attr($id) . '" name="daydream_' . esc_attr($id) . '" value="' . get_post_meta($post->ID, 'daydream_' . $id, true) . '" />';

        echo $html;
    }

    public function daydream_render_option_tabs($requested_tabs, $post_type = 'default') {
        $tabs_names = array(
            'layout' => __('Layout', 'daydream'),
            'heroheader' => __('Hero Header', 'daydream'),
            'pagetitlebar' => __('Page Title Bar', 'daydream'),
            'pageportfolio' => __('Portfolio', 'daydream'),
            'slider' => __('Slider', 'daydream'),
            'portfoliopost' => __('Portfolio', 'daydream'),
            'sidebars' => __('Sidebar', 'daydream'),
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
                printf('<li%s><a href="%s">%s</a></li>', esc_attr($class_active), esc_url($tab_name), esc_html($tabs_names[$post_type]));
            } else {
                printf('<li%s><a href="%s"><i class="%s"></i>%s</a></li>', esc_attr($class_active), esc_url($tab_name), esc_attr($tabs_icons[$tab_name]), esc_html($tabs_names[$tab_name]));
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

$metaboxes = new daydream_ThemeFrameworkMetaboxes;
