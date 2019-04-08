<?php
add_action( 'widgets_init', 'facebook_like_load_widgets' );

function facebook_like_load_widgets() {
	register_widget( 'Dayneo_Facebook_Like_Widget' );
}

class Dayneo_Facebook_Like_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
		'facebook-like-widget', __( 'dayneo: Facebook Like Box', 'dayneo' ), // Name
			      array( 'classname' => 'facebook-like', 'description' => __( 'Adds support for Facebook Like Box.', 'dayneo' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$page_url	 = $instance[ 'page_url' ];
		$width		 = $instance[ 'width' ];
		$color_scheme	 = $instance[ 'color_scheme' ];
		$show_faces	 = isset( $instance[ 'show_faces' ] ) ? 'true' : 'false';
		$show_stream	 = isset( $instance[ 'show_stream' ] ) ? 'true' : 'false';
		$show_header	 = isset( $instance[ 'show_header' ] ) ? 'true' : 'false';
		$height		 = '65';

		if ( $show_faces == 'true' ) {
			$height = '240';
		}

		if ( $show_stream == 'true' ) {
			$height = '515';
		}

		if ( $show_stream == 'true' && $show_faces == 'true' && $show_header == 'true' ) {
			$height = '540';
		}

		if ( $show_stream == 'true' && $show_faces == 'true' && $show_header == 'false' ) {
			$height = '540';
		}

		if ( $show_header == 'true' ) {
			$height = $height + 30;
		}

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $page_url ):
			?>
			<iframe src="http<?php echo (is_ssl()) ? 's' : ''; ?>://www.facebook.com/plugins/likebox.php?href=<?php echo esc_url(urlencode( $page_url )); ?>&amp;width=<?php echo esc_attr($width); ?>&amp;colorscheme=<?php echo esc_attr($color_scheme); ?>&amp;show_faces=<?php echo esc_attr($show_faces); ?>&amp;stream=<?php echo esc_attr($show_stream); ?>&amp;header=<?php echo esc_attr($show_header); ?>&amp;height=<?php echo esc_attr($height); ?>&amp;force_wall=true<?php if ( $show_faces == 'true' ): ?>&amp;connections=8<?php endif; ?>" style="border:none; overflow:hidden; width:<?php echo esc_attr($width); ?>px; height: <?php echo esc_attr($height); ?>px;"></iframe>
			<?php
		endif;

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ]		 = strip_tags( sanitize_text_field($new_instance[ 'title' ]) );
		$instance[ 'page_url' ]		 = sanitize_text_field($new_instance[ 'page_url' ]);
		$instance[ 'width' ]		 = sanitize_text_field($new_instance[ 'width' ]);
		$instance[ 'color_scheme' ]	 = sanitize_text_field($new_instance[ 'color_scheme' ]);
		$instance[ 'show_faces' ]	 = sanitize_text_field($new_instance[ 'show_faces' ]);
		$instance[ 'show_stream' ]	 = sanitize_text_field($new_instance[ 'show_stream' ]);
		$instance[ 'show_header' ]	 = sanitize_text_field($new_instance[ 'show_header' ]);

		return $instance;
	}

	public function form( $instance ) {
		$defaults	 = array( 'title' => 'Find us on Facebook', 'page_url' => '', 'width' => '268', 'color_scheme' => 'light', 'show_faces' => 'on', 'show_stream' => false, 'show_header' => false );
		$instance	 = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e( 'Title', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance[ 'title' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'page_url' )); ?>"><?php echo esc_html_e( 'Facebook Page URL', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'page_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'page_url' )); ?>" value="<?php echo esc_attr($instance[ 'page_url' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'width' )); ?>"><?php echo esc_html_e( 'Width', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'width' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'width' )); ?>" value="<?php echo esc_attr($instance[ 'width' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'color_scheme' )); ?>"><?php echo esc_html_e( 'Color Scheme', 'dayneo' ); ?></label> 
		    <select id="<?php echo esc_attr($this->get_field_id( 'color_scheme' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'color_scheme' )); ?>" class="widefat">
			<option <?php if ( 'light' == $instance[ 'color_scheme' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'light', 'dayneo' ); ?></option>
			<option <?php if ( 'dark' == $instance[ 'color_scheme' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'dark', 'dayneo' ); ?></option>
		    </select>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_faces' ], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_faces' )); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>"><?php echo esc_html_e( 'Show faces', 'dayneo' ); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_stream' ], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_stream' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_stream' )); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_stream' )); ?>"><?php echo esc_html_e( 'Show stream', 'dayneo' ); ?></label>
		</p>

		<p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_header' ], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_header' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_header' )); ?>" /> 
		    <label for="<?php echo esc_attr($this->get_field_id( 'show_header' )); ?>"><?php echo esc_html_e( 'Show facebook header', 'dayneo' ); ?></label>
		</p>
		<?php
	}

}
