<?php
add_action( 'widgets_init', 'bigbo_ad_125_125_widgets' );

function bigbo_ad_125_125_widgets() {
	register_widget( 'Bigbo_Ad_125_125_Widget' );
}

class Bigbo_Ad_125_125_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
		'ad_125_125-widget', __( 'Bigbo: 125x125 Ads', 'bigbo' ), // Name
			   array( 'classname' => 'ad_125_125', 'description' => __( 'Add 125x125 ads.', 'bigbo' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		?>
		<div class="img-row clearfix">
		    <?php
		    $ads = array( 1, 2, 3, 4 );
		    foreach ( $ads as $ad_count ):
			    if ( $instance[ 'ad_125_img_' . $ad_count ] && $instance[ 'ad_125_link_' . $ad_count ] ):
				    ?>
				    <div class="img-holder">
				<span class="hold"><a href="<?php echo esc_url($instance[ 'ad_125_link_' . $ad_count ]); ?>"><img src="<?php echo esc_url($instance[ 'ad_125_img_' . $ad_count ]); ?>" alt="" width="125" height="125" /></a></span>
				    </div>
				    <?php
			    endif;
		    endforeach;
		    ?>
		</div>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'ad_125_img_1' ]	 = sanitize_text_field($new_instance[ 'ad_125_img_1' ]);
		$instance[ 'ad_125_link_1' ]	 = sanitize_text_field($new_instance[ 'ad_125_link_1' ]);
		$instance[ 'ad_125_img_2' ]	 = sanitize_text_field($new_instance[ 'ad_125_img_2' ]);
		$instance[ 'ad_125_link_2' ]	 = sanitize_text_field($new_instance[ 'ad_125_link_2' ]);
		$instance[ 'ad_125_img_3' ]	 = sanitize_text_field($new_instance[ 'ad_125_img_3' ]);
		$instance[ 'ad_125_link_3' ]	 = sanitize_text_field($new_instance[ 'ad_125_link_3' ]);
		$instance[ 'ad_125_img_4' ]	 = sanitize_text_field($new_instance[ 'ad_125_img_4' ]);
		$instance[ 'ad_125_link_4' ]	 = sanitize_text_field($new_instance[ 'ad_125_link_4' ]);

		return $instance;
	}

	public function form( $instance ) {
		$defaults	 = array('ad_125_img_1' => '', 'ad_125_link_1' => '', 'ad_125_img_2' => '', 'ad_125_link_2' => '', 'ad_125_img_3' => '', 'ad_125_link_3' => '', 'ad_125_img_4' => '', 'ad_125_link_4' => '');
		$instance	 = wp_parse_args( (array) $instance, $defaults );
		?>
		<p><strong>Ad 1</strong></p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_img_1' )); ?>"><?php echo esc_html_e( 'Image URL Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_img_1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_img_1' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_img_1' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_link_1' )); ?>"><?php echo esc_html_e( 'Ad Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_link_1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_link_1' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_link_1' ]); ?>" />
		</p>
		<p><strong>Ad 2</strong></p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_img_2' )); ?>"><?php echo esc_html_e( 'Image URL Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_img_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_img_2' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_img_2' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_link_2' )); ?>"><?php echo esc_html_e( 'Ad Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_link_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_link_2' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_link_2' ]); ?>" />
		</p>
		<p><strong>Ad 3</strong></p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_img_3' )); ?>"><?php echo esc_html_e( 'Image URL Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_img_3' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_img_3' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_img_3' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_link_3' )); ?>"><?php echo esc_html_e( 'Ad Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_link_3' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_link_3' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_link_3' ]); ?>" />
		</p>
		<p><strong>Ad 4</strong></p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_img_4' )); ?>"><?php echo esc_html_e( 'Image URL Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_img_4' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_img_4' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_img_4' ]); ?>" />
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'ad_125_link_4' )); ?>"><?php echo esc_html_e( 'Ad Link', 'bigbo' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad_125_link_4' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad_125_link_4' )); ?>" value="<?php echo esc_attr($instance[ 'ad_125_link_4' ]); ?>" />
		</p>
		<?php
	}

}
