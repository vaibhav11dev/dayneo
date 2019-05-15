<?php
add_action( 'widgets_init', 'dayneo_recent_post_widget_widgets' );

function dayneo_recent_post_widget_widgets() {
    register_widget( 'Dayneo_Recent_Post_List_Widget' );
}

class Dayneo_Recent_Post_List_Widget extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     */
    public function __construct() {
        parent::__construct(
        'recent_post-widget', __( 'Dayneo: Blog List', 'dayneo' ), // Name
                                  array( 'classname' => 'recent_post_widget', 'description' => __( 'Display Latest Blog lists.', 'dayneo' ), ) // Args
        );
    }

    /**
     * Outputs the content for the current Blog Posts widget instance.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Blog Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args[ 'widget_id' ] ) ) {
            $args[ 'widget_id' ] = $this->id;
        }

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $id    = rand();

        $show_date = isset( $instance[ 'show_date' ] ) ? $instance[ 'show_date' ] : false;
        $number    = ( ! empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 5;
        if ( ! $number )
            $number    = 5;

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'post_type'           => 'post',
            'ignore_sticky_posts' => true
        ) ) );

        if ( $r->have_posts() ) :
            ?>

            <?php echo $args[ 'before_widget' ]; ?>
            <?php
            if ( $title ) {
                echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
            }
            ?>
            <div class="Blog_wrap_list clearfix">
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <div class="blog_list">

                        <?php if ( has_post_thumbnail() ) { ?>
                            <div class="item-thumb padding_0"><?php the_post_thumbnail( 'thumbnail' ); ?>
                            </div>
                            <?php
                        }
                        if ( has_post_thumbnail() ) {
                            $class = 'item-detail padding_right_0';
                        } else {
                            $class = 'item-detail padding_0';
                        }
                        ?>

                        <div class="<?php echo esc_attr( $class ); ?>">
                            <h3 class="post_tit"><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                            <div class="blogmeta">
                                <?php if ( $show_date ) { ?>
                                    <div class="b_date"><?php echo get_the_date(); ?></div>	
                                <?php } ?>                                			
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php echo $args[ 'after_widget' ]; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;
    }

    /**
     * Handles updating the settings for the current Blog Posts widget instance.
     * 	 *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance                = $old_instance;
        $instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'number' ]    = (int) $new_instance[ 'number' ];
        $instance[ 'show_date' ] = isset( $new_instance[ 'show_date' ] ) ? (bool) $new_instance[ 'show_date' ] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Blog Posts widget.
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
        $number    = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 5;
        $show_date = isset( $instance[ 'show_date' ] ) ? (bool) $instance[ 'show_date' ] : false;
        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'dayneo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'dayneo' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display Blog Date?', 'dayneo' ); ?></label></p>

        <?php
    }

}
