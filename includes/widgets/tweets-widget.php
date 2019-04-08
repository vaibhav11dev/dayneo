<?php
add_action( 'widgets_init', 'tweets_load_widgets' );

function tweets_load_widgets() {
	register_widget( 'Daydream_Tweets_Widget' );
}

class Daydream_Tweets_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
		'tweets-widget', __( 'daydream: Twitter', 'daydream' ), // Name
		       array( 'classname' => 'tweets', 'description' => '', ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
		$consumer_key		 = $instance[ 'consumer_key' ];
		$consumer_secret	 = $instance[ 'consumer_secret' ];
		$access_token		 = $instance[ 'access_token' ];
		$access_token_secret	 = $instance[ 'access_token_secret' ];
		$twitter_id		 = $instance[ 'twitter_id' ];
		$count			 = (int) $instance[ 'count' ];
		$widget_id		 = $args[ 'widget_id' ];

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) {

			$tweets_body = get_site_transient( $consumer_key );

			if ( false === $tweets_body ) {
				$token = get_option( 'cfTwitterToken_' . $widget_id );
				// Get a new token anyways.
				delete_option( 'cfTwitterToken_' . $widget_id );

				// Getting new auth bearer only if we don't have one.
				if ( ! $token ) {

					// Preparing credentials.
					$credentials	 = $consumer_key . ':' . $consumer_secret;
					$to_send	 = base64_encode( $credentials );

					// Http post arguments.
					$args = array(
					    'method'	 => 'POST',
					    'httpversion'	 => '1.1',
					    'blocking'	 => true,
					    'headers'	 => array(
						'Authorization'	 => 'Basic ' . $to_send,
						'Content-Type'	 => 'application/x-www-form-urlencoded;charset=UTF-8',
					    ),
					    'body'		 => array(
						'grant_type' => 'client_credentials',
					    ),
					);

					add_filter( 'https_ssl_verify', '__return_false' );
					$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

					$keys = json_decode( wp_remote_retrieve_body( $response ) );

					if ( $keys && isset( $keys->access_token ) ) {

						// Saving token to wp_options table.
						update_option( 'cfTwitterToken_' . $widget_id, $keys->access_token );
						$token = $keys->access_token;
					}
				}

				// We have bearer token wether we obtained it from API or from options.
				$args = array(
				    'httpversion'	 => '1.1',
				    'blocking'	 => true,
				    'headers'	 => array(
					'Authorization' => "Bearer $token",
				    ),
				);

				add_filter( 'https_ssl_verify', '__return_false' );
				$api_url	 = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $twitter_id . '&count=' . $count;
				$response	 = wp_remote_get( $api_url, $args );
				$tweets_body	 = wp_remote_retrieve_body( $response );

				set_site_transient( $consumer_key, $tweets_body, 960 );
			}

			$tweets = false;
			if ( ! empty( $tweets_body ) ) {
				$tweets = json_decode( $tweets_body, true );
				if ( ! is_array( $tweets ) ) {
					$tweets = false;
				}
			}

			if ( $tweets && is_array( $tweets ) ) {
				?>
				<div class="twitter-box">
				    <div class="twitter-holder">
					<div class="tweets-container twitter-feed" id="tweets_//<?php echo esc_attr( $widget_id ); ?>">
					    <ul>
						<?php foreach ( $tweets as $tweet ) : ?>
							<li>
							    <p class="tweet">
								<?php $latest_tweet = $this->tweet_get_html( $tweet ); ?>
								<?php if ( ! $latest_tweet ) : ?>
									<?php continue; ?>
								<?php endif; ?>
								<?php echo $latest_tweet; // WPCS: XSS ok.  ?>
							    </p>
							    <?php $twitter_time	 = strtotime( $tweet[ 'created_at' ] ); ?>
							    <?php $time_ago	 = $this->ago( $twitter_time ); ?>
							    <a href="//<?php echo esc_url_raw( 'http://twitter.com/' . $tweet[ 'user' ][ 'screen_name' ] . '/statuses/' . $tweet[ 'id_str' ] ); ?>" class="tweet_date"><?php echo esc_attr( $time_ago ); ?></a>
							</li>
						<?php endforeach; ?>
					    </ul>
					</div>
				    </div>
				    <span class="arrow"></span>
				</div>
				<?php
			}
		}

		echo $after_widget;
	}

	public function tweet_get_html( $tweet, $links = true, $users = true, $hashtags = true, $media = true ) {

		if ( array_key_exists( 'retweeted_status', $tweet ) ) {
			$tweet = $tweet[ 'retweeted_status' ];
		}

		if ( ! isset( $tweet[ 'text' ] ) ) {
			return false;
		}

		$return = $tweet[ 'text' ];

		$entities	 = array();
		$temp		 = array();

		if ( $links && is_array( $tweet[ 'entities' ][ 'urls' ] ) ) {

			foreach ( $tweet[ 'entities' ][ 'urls' ] as $e ) {
				$temp[ 'start' ]	 = $e[ 'indices' ][ 0 ];
				$temp[ 'end' ]		 = $e[ 'indices' ][ 1 ];
				$temp[ 'replacement' ]	 = '<a href="' . esc_url($e[ 'expanded_url' ]) . '" target="_blank" rel="noopener noreferrer">' . $e[ 'display_url' ] . '</a>';
				$entities[]		 = $temp;
			}
		}

		if ( $users && is_array( $tweet[ 'entities' ][ 'user_mentions' ] ) ) {

			foreach ( $tweet[ 'entities' ][ 'user_mentions' ] as $e ) {
				$temp[ 'start' ]	 = $e[ 'indices' ][ 0 ];
				$temp[ 'end' ]		 = $e[ 'indices' ][ 1 ];
				$temp[ 'replacement' ]	 = '<a href="https://twitter.com/' . esc_url($e[ 'screen_name' ]) . '" target="_blank" rel="noopener noreferrer">@' . $e[ 'screen_name' ] . '</a>';
				$entities[]		 = $temp;
			}
		}

		if ( $hashtags && is_array( $tweet[ 'entities' ][ 'hashtags' ] ) ) {

			foreach ( $tweet[ 'entities' ][ 'hashtags' ] as $e ) {
				$temp[ 'start' ]	 = $e[ 'indices' ][ 0 ];
				$temp[ 'end' ]		 = $e[ 'indices' ][ 1 ];
				$temp[ 'replacement' ]	 = '<a href="https://twitter.com/hashtag/' . esc_url($e[ 'text' ]) . '?src=hash" target="_blank" rel="noopener noreferrer">#' . $e[ 'text' ] . '</a>';
				$entities[]		 = $temp;
			}
		}

		if ( $media && array_key_exists( 'media', $tweet[ 'entities' ] ) ) {

			foreach ( $tweet[ 'entities' ][ 'media' ] as $e ) {
				$temp[ 'start' ]	 = $e[ 'indices' ][ 0 ];
				$temp[ 'end' ]		 = $e[ 'indices' ][ 1 ];
				$temp[ 'replacement' ]	 = '<a href="' . esc_url($e[ 'url' ]) . '" target="_blank" rel="noopener noreferrer">' . $e[ 'display_url' ] . '</a>';
				$entities[]		 = $temp;
			}
		}

		usort( $entities, array( $this, 'sort_tweets' ) );

		foreach ( $entities as $item ) {
			$return = $this->mb_substr_replace( $return, $item[ 'replacement' ], $item[ 'start' ], $item[ 'end' ] - $item[ 'start' ] );
		}

		return $return;
	}

	public function mb_substr_replace( $string, $replacement, $start, $length = null ) {
		if ( is_array( $string ) ) {
			$num		 = count( $string );
			// $replacement.
			$replacement	 = is_array( $replacement ) ? array_slice( $replacement, 0, $num ) : array_pad( array( $replacement ), $num, $replacement );

			// $start.
			if ( is_array( $start ) ) {
				$start = array_slice( $start, 0, $num );
				foreach ( $start as $key => $value ) {
					$start[ $key ] = is_int( $value ) ? $value : 0;
				}
			} else {
				$start = array_pad( array( $start ), $num, $start );
			}

			// $length.
			if ( ! isset( $length ) ) {
				$length = array_fill( 0, $num, 0 );
			} elseif ( is_array( $length ) ) {
				$length = array_slice( $length, 0, $num );
				foreach ( $length as $key => $value ) {
					$length[ $key ] = isset( $value ) ? ( is_int( $value ) ? $value : $num ) : 0;
				}
			} else {
				$length = array_pad( array( $length ), $num, $length );
			}

			// Recursive call.
			return array_map( __FUNCTION__, $string, $replacement, $start, $length );
		}

		preg_match_all( '/./us', (string) $string, $smatches );
		preg_match_all( '/./us', (string) $replacement, $rmatches );
		if ( null === $length ) {
			$length = mb_strlen( $string );
		}
		array_splice( $smatches[ 0 ], $start, $length, $rmatches[ 0 ] );

		return join( $smatches[ 0 ] );
	}

	public function sort_tweets( $a, $b ) {
		return ( $b[ 'start' ] - $a[ 'start' ] );
	}

	public function ago( $time ) {
		/* translators: time difference. */
		return sprintf( _x( '%s ago', '%s = human-readable time difference', 'daydream' ), human_time_diff( $time, current_time( 'timestamp' ) ) );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ]			 = strip_tags( sanitize_text_field($new_instance[ 'title' ]) );
		$instance[ 'consumer_key' ]		 = sanitize_text_field($new_instance[ 'consumer_key' ]);
		$instance[ 'consumer_secret' ]		 = sanitize_text_field($new_instance[ 'consumer_secret' ]);
		$instance[ 'access_token' ]		 = sanitize_text_field($new_instance[ 'access_token' ]);
		$instance[ 'access_token_secret' ]	 = sanitize_text_field($new_instance[ 'access_token_secret' ]);
		$instance[ 'twitter_id' ]		 = sanitize_text_field($new_instance[ 'twitter_id' ]);
		$instance[ 'count' ]			 = sanitize_text_field($new_instance[ 'count' ]);

		return $instance;
	}

	public function form( $instance ) {
		$defaults	 = array( 'title' => 'Twitter', 'twitter_id' => '', 'count' => 3, 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '' );
		$instance	 = wp_parse_args( (array) $instance, $defaults );
		?>

		<p><a href="http://dev.twitter.com/apps">Find or Create your Twitter App</a></p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e( 'Title', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance[ 'title' ]); ?>" />
		</p>
		
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>"><?php echo esc_html_e( 'Consumer Key', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'consumer_key' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'consumer_key' )); ?>" value="<?php echo esc_attr($instance[ 'consumer_key' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>"><?php echo esc_html_e( 'Consumer Secret', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'consumer_secret' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'consumer_secret' )); ?>" value="<?php echo esc_attr($instance[ 'consumer_secret' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"><?php echo esc_html_e( 'Access Token', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>" value="<?php echo esc_attr($instance[ 'access_token' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>"><?php echo esc_html_e( 'Access Token Secret', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'access_token_secret' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token_secret' )); ?>" value="<?php echo esc_attr($instance[ 'access_token_secret' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'twitter_id' )); ?>"><?php echo esc_html_e( 'Twitter Username', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'twitter_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_id' )); ?>" value="<?php echo esc_attr($instance[ 'twitter_id' ]); ?>" />
		</p>

		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php echo esc_html_e( 'Number of Tweets', 'daydream' ); ?></label>
		    <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance[ 'count' ]); ?>" />
		</p>

		<?php
	}

}
