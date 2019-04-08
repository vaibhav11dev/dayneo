<?php
add_action( 'widgets_init', 'social_links_load_widgets' );

function social_links_load_widgets() {
	register_widget( 'Daydream_Social_Links_Widget' );
}

class Daydream_Social_Links_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
		'social_links-widget', __( 'daydream: Social Links', 'daydream' ), // Name
			     array( 'classname' => 'social_links', 'description' => '', ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
                $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$style = '';
		$box_style = '';

		if ( ! isset( $instance[ 'linktarget' ] ) ) {
			$instance[ 'linktarget' ] = '';
		}

		$dd_nofollow_social_links	 = daydream_get_option( 'dd_nofollow_social_links', '0' );
		$nofollow			 = '';
		if ( $dd_nofollow_social_links ) {
			$nofollow = 'rel="nofollow"';
		}

		if ( ! isset( $instance[ 'tooltip_pos' ] ) ) {
			$instance[ 'tooltip_pos' ] = 'top';
		}

		if ( isset( $instance[ 'icon_color' ] ) && $instance[ 'icon_color' ] ) {
			$style .= sprintf( 'color:%s;', esc_attr($instance[ 'icon_color' ]) );
		}

		if ( isset( $instance[ 'boxed_icon' ] ) && $instance[ 'boxed_icon' ] == 'Yes' && isset( $instance[ 'boxed_color' ] ) && $instance[ 'boxed_color' ] ) {
			$box_style .= sprintf( 'background-color:%s;border-color:%s;', esc_attr($instance[ 'boxed_color' ]), esc_attr($instance[ 'boxed_color' ]) );
		}

		if ( isset( $instance[ 'boxed_icon' ] ) && isset( $instance[ 'boxed_icon_radius' ] ) && $instance[ 'boxed_icon' ] == 'Yes' &&
		( $instance[ 'boxed_icon_radius' ] || $instance[ 'boxed_icon_radius' ] === '0' )
		) {
			if ( $instance[ 'boxed_icon_radius' ] == 'round' ) {
				$instance[ 'boxed_icon_radius' ] = '50%';
			}

			$box_style .= sprintf( 'border-radius:%s;', esc_attr($instance[ 'boxed_icon_radius' ]) );
		}
		
		foreach ( $instance as $name => $value ) {
			if ( strpos( $name, '_link' ) ) {
				$social_networks[ $name ] = str_replace( '_link', '', $name );
			}
		}

		$boxed_icons = '';
		if ( isset( $instance[ 'boxed_icon' ] ) && $instance[ 'boxed_icon' ] == 'Yes' && isset( $instance[ 'boxed_color' ] ) && $instance[ 'boxed_color' ] ) {
			$boxed_icons = 'boxed-icons';
		}
		?>       
		<ul class="clearfix social-icons <?php echo esc_attr($boxed_icons); ?>">
			<?php
			foreach ( $social_networks as $name => $value ):
				if ( $instance[ $name ] ):
					?>
					<li>
                                            <a class="ved-social-network-icon ved-<?php echo esc_attr($value); ?>" href="<?php echo esc_attr($instance[ $name ]); ?>" data-toggle="tooltip" data-placement="<?php echo esc_attr(strtolower( $instance[ 'tooltip_pos' ] )); ?>" data-original-title="<?php echo esc_attr(ucwords( $value )); ?>" title="" <?php echo esc_attr($nofollow); ?> target="<?php echo esc_attr($instance[ 'linktarget' ]); ?>" style="<?php echo $box_style; ?>"><i class="fa fa-<?php echo esc_attr($value); ?>" style="<?php echo $style; ?>"></i>
						</a>
					</li>
					<?php
				endif;
			endforeach;
			?>
		</ul>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ]		 = sanitize_text_field($new_instance[ 'title' ]);
		$instance[ 'linktarget' ]	 = sanitize_text_field($new_instance[ 'linktarget' ]);
		$instance[ 'icon_color' ]	 = sanitize_text_field($new_instance[ 'icon_color' ]);
		$instance[ 'boxed_icon' ]	 = sanitize_text_field($new_instance[ 'boxed_icon' ]);
		$instance[ 'boxed_color' ]	 = sanitize_text_field($new_instance[ 'boxed_color' ]);
		$instance[ 'boxed_icon_radius' ] = sanitize_text_field($new_instance[ 'boxed_icon_radius' ]);
		$instance[ 'tooltip_pos' ]	 = sanitize_text_field($new_instance[ 'tooltip_pos' ]);
		$instance[ 'facebook_link' ]	 = sanitize_text_field($new_instance[ 'facebook_link' ]);
		$instance[ 'twitter_link' ]	 = sanitize_text_field($new_instance[ 'twitter_link' ]);
		$instance[ 'google-plus_link' ]	 = sanitize_text_field($new_instance[ 'google-plus_link' ]);
		$instance[ 'dribbble_link' ]	 = sanitize_text_field($new_instance[ 'dribbble_link' ]);
		$instance[ 'linkedin_link' ]	 = sanitize_text_field($new_instance[ 'linkedin_link' ]);
		$instance[ 'tumblr_link' ]	 = sanitize_text_field($new_instance[ 'tumblr_link' ]);
		$instance[ 'reddit_link' ]	 = sanitize_text_field($new_instance[ 'reddit_link' ]);
		$instance[ 'yahoo_link' ]	 = sanitize_text_field($new_instance[ 'yahoo_link' ]);
		$instance[ 'deviantart_link' ]	 = sanitize_text_field($new_instance[ 'deviantart_link' ]);
		$instance[ 'vimeo_link' ]	 = sanitize_text_field($new_instance[ 'vimeo_link' ]);
		$instance[ 'youtube_link' ]	 = sanitize_text_field($new_instance[ 'youtube_link' ]);
		$instance[ 'pinterest_link' ]	 = sanitize_text_field($new_instance[ 'pinterest_link' ]);
		$instance[ 'digg_link' ]	 = sanitize_text_field($new_instance[ 'digg_link' ]);
		$instance[ 'flickr_link' ]	 = sanitize_text_field($new_instance[ 'flickr_link' ]);
		$instance[ 'skype_link' ]	 = sanitize_text_field($new_instance[ 'skype_link' ]);
		$instance[ 'instagram_link' ]	 = sanitize_text_field($new_instance[ 'instagram_link' ]);
		$instance[ 'vk_link' ]		 = sanitize_text_field($new_instance[ 'vk_link' ]);
		$instance[ 'paypal_link' ]	 = sanitize_text_field($new_instance[ 'paypal_link' ]);
		$instance[ 'dropbox_link' ]	 = sanitize_text_field($new_instance[ 'dropbox_link' ]);
		$instance[ 'soundcloud_link' ]	 = sanitize_text_field($new_instance[ 'soundcloud_link' ]);
		$instance[ 'foursquare_link' ]	 = sanitize_text_field($new_instance[ 'foursquare_link' ]);
		$instance[ 'vine_link' ]	 = sanitize_text_field($new_instance[ 'vine_link' ]);
		$instance[ 'wordpress_link' ]	 = sanitize_text_field($new_instance[ 'wordpress_link' ]);
		$instance[ 'behance_link' ]	 = sanitize_text_field($new_instance[ 'behance_link' ]);
		$instance[ 'stumbleupon_link' ]	 = sanitize_text_field($new_instance[ 'stumbleupon_link' ]);
		$instance[ 'github_link' ]	 = sanitize_text_field($new_instance[ 'github_link' ]);
		$instance[ 'lastfm_link' ]	 = sanitize_text_field($new_instance[ 'lastfm_link' ]);
		$instance[ 'rss_link' ]	 = sanitize_text_field($new_instance[ 'rss_link' ]);
		
		return $instance;
	}

	public function form( $instance ) {
		$defaults	 = array( 'title' => 'We are social', 'linktarget' => '', 'icon_color' => '', 'boxed_icon' => 'No', 'boxed_color' => '', 'boxed_icon_radius' => '3px', 'tooltip_pos' => 'top', 'facebook_link' => '', 'twitter_link' => '', 'google-plus_link' => '', 'dribbble_link' => '', 'linkedin_link' => '', 'tumblr_link' => '', 'reddit_link' => '', 'yahoo_link' => '', 'deviantart_link' => '', 'vimeo_link' => '', 'youtube_link' => '', 'pinterest_link' => '', 'digg_link' => '', 'flickr_link' => '', 'skype_link' => '', 'instagram_link' => '', 'vk_link' => '', 'paypal_link' => '', 'dropbox_link' => '', 'soundcloud_link' => '', 'foursquare_link' => '', 'vine_link' => '', 'wordpress_link' => '', 'behance_link' => '', 'stumbleupon_link' => '', 'github_link' => '', 'lastfm_link' => '', 'rss_link' => '' );
		$instance	 = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e( 'Title', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance[ 'title' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linktarget' )); ?>"><?php echo esc_html_e( 'Link Target', 'daydream' ); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'linktarget' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linktarget' )); ?>" class="widefat" style="width:100%;">
				<option <?php if ( '_blank' == $instance[ 'linktarget' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( '_blank', 'daydream' ); ?></option>
				<option <?php if ( '_self' == $instance[ 'linktarget' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( '_self', 'daydream' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>"><?php echo esc_html_e( 'Icons Color Hex Code', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_color' )); ?>" value="<?php echo esc_attr($instance[ 'icon_color' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'boxed_icon' )); ?>"><?php echo esc_html_e( 'Icons Boxed', 'daydream' ); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'boxed_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'boxed_icon' )); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'No' == $instance[ 'boxed_icon' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'No', 'daydream' ); ?></option>
				<option <?php if ( 'Yes' == $instance[ 'boxed_icon' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'Yes', 'daydream' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'boxed_color' )); ?>"><?php echo esc_html_e( 'Boxed Icons Background Color Hex Code', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'boxed_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'boxed_color' )); ?>" value="<?php echo esc_attr($instance[ 'boxed_color' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'boxed_icon_radius' )); ?>"><?php echo esc_html_e( 'Boxed Icons Radius', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'boxed_icon_radius' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'boxed_icon_radius' )); ?>" value="<?php echo esc_attr($instance[ 'boxed_icon_radius' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tooltip_pos' )); ?>"><?php echo esc_html_e( 'Tooltip Position', 'daydream' ); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'tooltip_pos' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tooltip_pos' )); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Top' == $instance[ 'tooltip_pos' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'Top', 'daydream' ); ?></option>
				<option <?php if ( 'Right' == $instance[ 'tooltip_pos' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'Right', 'daydream' ); ?></option>
				<option <?php if ( 'Bottom' == $instance[ 'tooltip_pos' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'Bottom', 'daydream' ); ?></option>
				<option <?php if ( 'Left' == $instance[ 'tooltip_pos' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'Left', 'daydream' ); ?></option>
				<option <?php if ( 'None' == $instance[ 'tooltip_pos' ] ) echo 'selected="selected"'; ?>><?php echo esc_html_e( 'None', 'daydream' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook_link' )); ?>"><?php echo esc_html_e( 'Facebook Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'facebook_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_link' )); ?>" value="<?php echo esc_attr($instance[ 'facebook_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter_link' )); ?>"><?php echo esc_html_e( 'Twitter Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_link' )); ?>" value="<?php echo esc_attr($instance[ 'twitter_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'google-plus_link' )); ?>"><?php echo esc_html_e( 'Google Plus Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'google-plus_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google-plus_link' )); ?>" value="<?php echo esc_attr($instance[ 'google-plus_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'dribbble_link' )); ?>"><?php echo esc_html_e( 'Dribbble Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'dribbble_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble_link' )); ?>" value="<?php echo esc_attr($instance[ 'dribbble_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin_link' )); ?>"><?php echo esc_html_e( 'LinkedIn Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'linkedin_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin_link' )); ?>" value="<?php echo esc_attr($instance[ 'linkedin_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tumblr_link' )); ?>"><?php echo esc_html_e( 'Tumblr Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'tumblr_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr_link' )); ?>" value="<?php echo esc_attr($instance[ 'tumblr_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'reddit_link' )); ?>"><?php echo esc_html_e( 'Reddit Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'reddit_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'reddit_link' )); ?>" value="<?php echo esc_attr($instance[ 'reddit_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'yahoo_link' )); ?>"><?php echo esc_html_e( 'Yahoo Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'yahoo_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'yahoo_link' )); ?>" value="<?php echo esc_attr($instance[ 'yahoo_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'deviantart_link' )); ?>"><?php echo esc_html_e( 'Deviantart Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'deviantart_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'deviantart_link' )); ?>" value="<?php echo esc_attr($instance[ 'deviantart_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo_link' )); ?>"><?php echo esc_html_e( 'Vimeo Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'vimeo_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vimeo_link' )); ?>" value="<?php echo esc_attr($instance[ 'vimeo_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube_link' )); ?>"><?php echo esc_html_e( 'Youtube Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'youtube_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube_link' )); ?>" value="<?php echo esc_attr($instance[ 'youtube_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest_link' )); ?>"><?php echo esc_html_e( 'Pinterest Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'pinterest_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_link' )); ?>" value="<?php echo esc_attr($instance[ 'pinterest_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'digg_link' )); ?>"><?php echo esc_html_e( 'Digg Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'digg_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'digg_link' )); ?>" value="<?php echo esc_attr($instance[ 'digg_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr_link' )); ?>"><?php echo esc_html_e( 'Flickr Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'flickr_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr_link' )); ?>" value="<?php echo esc_attr($instance[ 'flickr_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'skype_link' )); ?>"><?php echo esc_html_e( 'Skype Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'skype_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype_link' )); ?>" value="<?php echo esc_attr($instance[ 'skype_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram_link' )); ?>"><?php echo esc_html_e( 'Instagram Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'instagram_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram_link' )); ?>" value="<?php echo esc_attr($instance[ 'instagram_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vk_link' )); ?>"><?php echo esc_html_e( 'VK Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'vk_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vk_link' )); ?>" value="<?php echo esc_attr($instance[ 'vk_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'paypal_link' )); ?>"><?php echo esc_html_e( 'PayPal Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'paypal_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'paypal_link' )); ?>" value="<?php echo esc_attr($instance[ 'paypal_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'dropbox_link' )); ?>"><?php echo esc_html_e( 'Dropbox Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'dropbox_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dropbox_link' )); ?>" value="<?php echo esc_attr($instance[ 'dropbox_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud_link' )); ?>"><?php echo esc_html_e( 'Soundcloud Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'soundcloud_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud_link' )); ?>" value="<?php echo esc_attr($instance[ 'soundcloud_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'foursquare_link' )); ?>"><?php echo esc_html_e( 'Foursquare Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'foursquare_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'foursquare_link' )); ?>" value="<?php echo esc_attr($instance[ 'foursquare_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vine_link' )); ?>"><?php echo esc_html_e( 'Vine Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'vine_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vine_link' )); ?>" value="<?php echo esc_attr($instance[ 'vine_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'wordpress_link' )); ?>"><?php echo esc_html_e( 'WordPress Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'wordpress_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'wordpress_link' )); ?>" value="<?php echo esc_attr($instance[ 'wordpress_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'behance_link' )); ?>"><?php echo esc_html_e( 'Behance Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'behance_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance_link' )); ?>" value="<?php echo esc_attr($instance[ 'behance_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'stumbleupon_link' )); ?>"><?php echo esc_html_e( 'Stumbleupo Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'stumbleupon_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'stumbleupon_link' )); ?>" value="<?php echo esc_attr($instance[ 'stumbleupon_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'github_link' )); ?>"><?php echo esc_html_e( 'Github Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'github_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'github_link' )); ?>" value="<?php echo esc_attr($instance[ 'github_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'lastfm_link' )); ?>"><?php echo esc_html_e( 'Lastfm Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'lastfm_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'lastfm_link' )); ?>" value="<?php echo esc_attr($instance[ 'lastfm_link' ]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'rss_link' )); ?>"><?php echo esc_html_e( 'RSS Link', 'daydream' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'rss_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss_link' )); ?>" value="<?php echo esc_attr($instance[ 'rss_link' ]); ?>" />
		</p>
		<?php
	}

}
