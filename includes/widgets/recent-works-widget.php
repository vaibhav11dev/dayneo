<?php
add_action('widgets_init', 'bigbo_recent_works_widgets');

function bigbo_recent_works_widgets() {
    register_widget('Bigbo_Recent_Works_Widget');
}

class Bigbo_Recent_Works_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'recent_works-widget', __('Bigbo: Portfolio', 'bigbo'), // Name
                array('classname' => 'recent_works', 'description' => __('Recent works from the portfolio.', 'bigbo'),) // Args
        );
    }

    public function widget($args, $instance) {
        extract($args);
       $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $number = $instance['number'];

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }
        ?>
        <div class="recent-works-items clearfix">
            <?php
            $args = array(
                'post_type' => 'bigbo_portfolio',
                'posts_per_page' => $number,
                'has_password' => false
            );
            $portfolio = new WP_Query($args);
            if ($portfolio->have_posts()):

                while ($portfolio->have_posts()): $portfolio->the_post();
                    if (has_post_thumbnail()):

                        $link_target = "";
                        $url_check = get_post_meta(get_the_ID(), 'bigbo_link_icon_url', true);
                        if (!empty($url_check)) {
                            $new_permalink = $url_check;
                            if (get_post_meta(get_the_ID(), 'bigbo_link_icon_target', true) == "yes") {
                                $link_target = ' target=_blank';
                            }
                        } else {
                            $new_permalink = get_permalink();
                        }
                        ?>
                        <a class="dd-recent-work" href="<?php echo esc_url($new_permalink); ?>"<?php echo esc_attr($link_target); ?> title="<?php the_title(); ?>">
                            <?php the_post_thumbnail('recent-works-thumbnail'); ?>
                        </a>
                        <?php
                    endif;
                endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>

        <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags(sanitize_text_field($new_instance['title']));
        $instance['number'] = sanitize_text_field($new_instance['number']);

        return $instance;
    }

    public function form($instance) {
        $defaults = array('title' => 'Portfolio', 'number' => 8);
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_e( 'Title', 'bigbo' ); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo esc_html_e( 'Number of items to show', 'bigbo' ); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>
        <?php
    }

}
