<?php
add_action( 'widgets_init', 'dayneo_contact_info_load_widgets' );

function dayneo_contact_info_load_widgets() {
	register_widget( 'Dayneo_Contact_Info_Widget' );
}

class Dayneo_Contact_Info_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
		'contact_info-widget', __( 'dayneo: Get In Touch', 'dayneo' ), // Name
			     array( 'classname' => 'contact_info', 'description' => '', ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<address class="map-background">
		    <?php
		    if ( isset( $instance[ 'address' ] ) && $instance[ 'address' ] ) {
			    ?>
			    <p class="address"><?php echo esc_html($instance[ 'address' ]); ?></p>
			    <?php
		    }

		    if ( isset( $instance[ 'phone' ] ) && $instance[ 'phone' ] ) {
			    ?>
			    <p class="phone"><?php esc_html_e( 'Phone:', 'dayneo' ); ?>&nbsp;<?php echo esc_html($instance[ 'phone' ]); ?></p>
			    <?php
		    }

		    if ( isset( $instance[ 'mobile' ] ) && $instance[ 'mobile' ] ) {
			    ?>
			    <p class="mobile"><?php esc_html_e( 'Mobile:', 'dayneo' ); ?>&nbsp;<?php echo esc_html($instance[ 'mobile' ]); ?></p>
			    <?php
		    }

		    if ( isset( $instance[ 'fax' ] ) && $instance[ 'fax' ] ) {
			    ?>
			    <p class="fax"><?php esc_html_e( 'Fax:', 'dayneo' ); ?>&nbsp;<?php echo esc_html($instance[ 'fax' ]); ?></p>
			    <?php
		    }

		    if ( isset( $instance[ 'email' ] ) && $instance[ 'email' ] ) {
			    ?>
			    <p class="email"><?php esc_html_e( 'Email:', 'dayneo' ); ?>&nbsp;<a href="mailto:<?php echo esc_url(antispambot( $instance[ 'email' ] ) ); ?>"><?php
				    if ( $instance[ 'emailtxt' ] ) {
					    echo esc_html($instance[ 'emailtxt' ]);
				    } else {
					    echo esc_html($instance[ 'email' ]);
				    }
				    ?></a></p>
			    <?php
		    }

		    if ( isset( $instance[ 'web' ] ) && $instance[ 'web' ] ) {
			    ?>
			    <p class="web"><?php esc_html_e( 'Web:', 'dayneo' ); ?>&nbsp;<a href="<?php echo esc_url($instance[ 'web' ]); ?>"><?php
				    if ( $instance[ 'webtxt' ] ) {
					    echo esc_html($instance[ 'webtxt' ]);
				    } else {
					    echo esc_html($instance[ 'web' ]);
				    }
				    ?></a></p>
			    <?php
		    }
		    ?>
		</address>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ]	 = sanitize_text_field($new_instance[ 'title' ]);
		$instance[ 'address' ]	 = sanitize_text_field($new_instance[ 'address' ]);
		$instance[ 'phone' ]	 = sanitize_text_field($new_instance[ 'phone' ]);
		$instance[ 'mobile' ]	 = sanitize_text_field($new_instance[ 'mobile' ]);
		$instance[ 'fax' ]	 = sanitize_text_field($new_instance[ 'fax' ]);
		$instance[ 'email' ]	 = sanitize_email($new_instance[ 'email' ]);
		$instance[ 'emailtxt' ]	 = sanitize_text_field($new_instance[ 'emailtxt' ]);
		$instance[ 'web' ]	 = sanitize_text_field($new_instance[ 'web' ]);
		$instance[ 'webtxt' ]	 = sanitize_text_field($new_instance[ 'webtxt' ]);

		return $instance;
	}

	public function form( $instance ) {
		$defaults	 = array( 'title' => esc_html__( 'Contact Us', 'dayneo' ), 'address' => '', 'phone' => '', 'mobile' => '', 'fax' => '', 'email' => '', 'emailtxt' => '', 'web' => '', 'webtxt' => '' );
		$instance	 = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e( 'Title', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance[ 'title' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php echo esc_html_e( 'Address', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php echo esc_attr($instance[ 'address' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>"><?php echo esc_html_e( 'Phone', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php echo esc_attr($instance[ 'phone' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>"><?php echo esc_html_e( 'Mobile', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'mobile' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mobile' )); ?>" value="<?php echo esc_attr($instance[ 'mobile' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'fax' )); ?>"><?php echo esc_html_e( 'Fax', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'fax' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fax' )); ?>" value="<?php echo esc_attr($instance[ 'fax' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php echo esc_html_e( 'Email', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" value="<?php echo esc_attr($instance[ 'email' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'emailtxt' )); ?>"><?php echo esc_html_e( 'Email Link Text', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'emailtxt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'emailtxt' )); ?>" value="<?php echo esc_attr($instance[ 'emailtxt' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'web' )); ?>"><?php echo esc_html_e( 'Website URL (with HTTP)', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'web' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'web' )); ?>" value="<?php echo esc_attr($instance[ 'web' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'webtxt' )); ?>"><?php echo esc_html_e( 'Website URL Text', 'dayneo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'webtxt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'webtxt' )); ?>" value="<?php echo esc_attr($instance[ 'webtxt' ]); ?>" />
		</p>
		<?php
	}

}
