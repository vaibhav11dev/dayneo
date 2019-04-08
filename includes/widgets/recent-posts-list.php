<?php
add_action('widgets_init', 'recent_post_list_load_widgets');

function recent_post_list_load_widgets() {
    register_widget('Daydream_Recent_Post_List_Widget');
}

class Daydream_Recent_Post_List_Widget extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 */
	public function __construct() {
		parent::__construct(
		'recent_works-widget', __('daydream: Blog List', 'daydream'), // Name
                array('classname' => 'recent_post_list', 'description' => __('Display Latest Blog lists.', 'daydream'),) // Args
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
		if ( !isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$id = rand();

		$show_comment = isset( $instance['show_comment'] ) ? $instance['show_comment'] : false;
		$show_author = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$number = (!empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( !$number )
			$number = 5;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			    'posts_per_page' => $number,
			    'no_found_rows' => true,
			    'post_status' => 'publish',
			    'post_type' => 'post',
			    'ignore_sticky_posts' => true
			) ) );

		if ( $r->have_posts() ) :
			?>

			<?php echo $args['before_widget']; ?>
			<?php
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>
			<div class="Blog_wrap_list clearfix">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				    <div class="blog_list">			

					<div class="col-md-12 padding_0">
					    <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
					    <div class="blogmeta">
						<?php if ( $show_author ) {
							?><div class="b_author"><i class="fa fa-user"> </i> <?php echo get_the_author(); ?>
							</div><?php } ?> <?php
						if ( $show_comment && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
							?> <div class="b_comment"><i class="fa fa-comment"> </i><?php
							echo '<span class="comments-link">';
							comments_popup_link( sprintf( esc_html__( ' Leave a comment<span class="screen-reader-text"> on %s</span>', 'daydream' ), get_the_title() ) );
							echo '</span> </div>';
						}
						?><?php if ( $show_date ) { ?>
							    <div class="b_date"><i class="fa fa-calendar"> </i> <?php echo get_the_date(); ?></div>	<?php
				}
				?>                                			
						</div>
					    </div>
					</div>
			    <?php endwhile; ?>
			    </div>
			    <?php echo $args['after_widget']; ?>
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
		    $instance = $old_instance;
		    $instance['title'] = sanitize_text_field( $new_instance['title'] );
		    $instance['number'] = (int) $new_instance['number'];
		    $instance['show_comment'] = isset( $new_instance['show_comment'] ) ? (bool) $new_instance['show_comment'] : false;
		    $instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
		    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		    return $instance;
	    }

	    /**
	     * Outputs the settings form for the Blog Posts widget.
	     *
	     * @param array $instance Current settings.
	     */
	    public function form( $instance ) {
		    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		    $show_comment = isset( $instance['show_comment'] ) ? (bool) $instance['show_comment'] : true;
		    $show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : true;
		    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

		    $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		    ?>
		    <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'daydream' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		    <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'daydream' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		    <p><input class="checkbox" type="checkbox"<?php checked( $show_comment ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_comment' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_comment' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'show_comment' )); ?>"><?php esc_html_e( 'Display Blog Comment?', 'daydream' ); ?></label></p>

		    <p><input class="checkbox" type="checkbox"<?php checked( $show_author ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_author' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_author' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'show_author' )); ?>"><?php esc_html_e( 'Display Blog Author?', 'daydream' ); ?></label></p>

		    <p><input class="checkbox" type="checkbox"<?php checked( '$show_date' ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display Blog Date?', 'daydream' ); ?></label></p>

		    <?php
	    }

    }
    