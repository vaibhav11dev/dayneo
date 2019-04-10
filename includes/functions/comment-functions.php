<?php
/**
 * Comments - functions that deal with comments
 *
 * @package Dayneo
 * @subpackage Core
 */

/**
 * dayneo_discussion_title()
 *
 * @filter dayneo_many_comments, dayneo_no_comments, dayneo_one_comment, dayneo_comments_number
 */
function dayneo_discussion_title( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	$discussion_title	 = '';
	$comment_count		 = dayneo_count( 'comment', false );
	$ping_count		 = dayneo_count( 'pings', false );

	switch ( $type ) {
		case 'comment' :
			$count	 = $comment_count;
			// Available filter: dayneo_many_comments
			$many	 = apply_filters( 'dayneo_many_comments', __( '% Comments', 'dayneo' ) );
			// Available filter: dayneo_no_comments
			$none	 = apply_filters( 'dayneo_no_comments', __( 'No Comments Yet', 'dayneo' ) );
			// Available filter: dayneo_one_comment
			$one	 = apply_filters( 'dayneo_one_comment', __( '1 Comment', 'dayneo' ) );
			break;
		case 'pings' :
			$count	 = $ping_count;
			// Available filter: dayneo_many_pings
			$many	 = apply_filters( 'dayneo_many_pings', __( '% Pings/Trackbacks', 'dayneo' ) );
			// Available filter: dayneo_no_pings
			$none	 = apply_filters( 'dayneo_no_pings', __( 'No Pings/Trackbacks Yet', 'dayneo' ) );
			// Available filter: dayneo_one_comment
			$one	 = apply_filters( 'dayneo_one_ping', __( '1 Ping/Trackback', 'dayneo' ) );
			break;
	}

	if ( $count > 1 ) {
		$number = str_replace( '%', number_format_i18n( $count ), $many );
	} elseif ( $count == 1 ) {
		$number = $one;
	} else {
		// it must be one
		$number = $none;
	}

	// Available filter: dayneo_discussion_title_tag
	$tag	 = apply_filters( 'dayneo_discussion_title_tag', (string) 'h5' );
	$class	 = 'text-title text-uppercase bottom-line';

	if ( $number ) {
		$discussion_title = '<' . $tag . ' class="' . esc_attr($type . '-title ' . $class) . '">' . $number . '</' . $tag . '>';
	}

	// Available filter: dayneo_discussion_title
	$dayneo_discussion_title = apply_filters( 'dayneo_discussion_title', (string) $discussion_title );

	return ( $echo ) ? print( $dayneo_discussion_title ) : $dayneo_discussion_title;
}

/**
 * dayneo_count()
 *
 * @since 0.3
 * @needsdoc
 */
function dayneo_count( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	global $wp_query;

	$comment_count	 = $wp_query->comment_count;
	$ping_count	 = count( $wp_query->comments_by_type[ 'pings' ] );

	switch ( $type ):
		case 'comment':
			return ( $echo ) ? print( $comment_count ) : (int)$comment_count;
			break;
		case 'pings':
			return ( $echo ) ? print( $ping_count ) : (int)$ping_count;
			break;
	endswitch;
}

/**
 * dayneo_comment_author() short description
 *
 * @since 0.3
 * @todo needs filter
 */
function dayneo_comment_author( $meta_format = '%avatar%' ) {
	// Available filter: dayneo_comment_author_meta_format
	$meta_format = apply_filters( 'dayneo_comment_author_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo $meta_format;
	} else {
		$open	 = '<!--BEGIN .comment-author-->';
		$open	 .= '<div class="comment-avatar">';
		$close	 = '<!--END .comment-author-->';
		$close	 .= '</div>';

		// separate the %keywords%
		$meta_array = preg_split( '/(%.+?%)/', $meta_format, -1, PREG_SPLIT_DELIM_CAPTURE );

		// parse through the keywords
		foreach ( $meta_array as $key => $str ) {
			switch ( $str ) {
				case '%avatar%':
					$meta_array[ $key ] = dayneo_comment_avatar();
					break;

				case '%name%':
					$meta_array[ $key ] = dayneo_comment_name();
					break;
			}
		}

		$output = join( '', $meta_array );
		if ( $output ) {
			echo $open . $output . $close;
		}
	}
}

/**
 * dayneo_comment_meta() short description
 *
 */
function dayneo_comment_meta( $meta_format = '%date% %reply%' ) {
	// Available filter: dayneo_comment_meta_format
	$meta_format = apply_filters( 'dayneo_comment_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo $meta_format;
	} else {
		$open	 = '<!--BEGIN .comment-meta-->';
		$open	 .= '<div class="comment-tools">';
		$close	 = '<!--END .comment-meta-->';
		$close	 .= '</div>';

		// separate the %keywords%
		$meta_array = preg_split( '/(%.+?%)/', $meta_format, -1, PREG_SPLIT_DELIM_CAPTURE );

		// parse through the keywords
		foreach ( $meta_array as $key => $str ) {
			switch ( $str ) {
				case '%date%':
					$meta_array[ $key ] = dayneo_comment_date();
					break;

				case '%time%':
					$meta_array[ $key ] = dayneo_comment_time();
					break;

				case '%link%':
					$meta_array[ $key ] = dayneo_comment_link();
					break;

				case '%reply%':
					$meta_array[ $key ] = dayneo_comment_reply( true );
					break;

				case '%edit%':
					$meta_array[ $key ] = dayneo_comment_edit();
					break;
			}
		}
		$output = join( '', $meta_array );
		if ( $output )
			echo $open . $output . $close;
	}
}

/**
 * dayneo_comment_text() short description
 *
 */
function dayneo_comment_text() {
	echo '<div class="comment-content">';
	echo '<h5>' . dayneo_comment_name() . '</h5>';
	echo '<p>' . comment_text() . '</p>';
	echo '</div>';
}

/**
 * dayneo_comment_moderation() short description
 *
 */
function dayneo_comment_moderation() {
	global $comment;
	if ( $comment->comment_approved == '0' )
		echo '<p class="comment-unapproved moderation alert">' . esc_html_e( 'Your comment is awaiting moderation', 'dayneo' ) . '</p>';
}

/**
 * dayneo_comment_navigation() paged comments
 *
 */
function dayneo_comment_navigation() {
	$num = get_comments_number() + 1;

// Available filter: dayneo_comment_navigation_tag
	$tag	 = apply_filters( 'dayneo_comment_navigation_tag', (string) 'div' );
	$open	 = "<!--BEGIN .navigation-links-->";
	$open	 .= "<" . $tag . " class=\"navigation-links comment-navigation\">";
	$close	 = "<!--END .navigation-links-->";
	$close	 .= "</" . $tag . ">";

	if ( $num > get_option( 'comments_per_page' ) ) {
		$paged_links = paginate_comments_links( array(
			'type'		 => 'array',
			'echo'		 => false,
			'prev_text'	 => '&laquo; Previous Page',
			'next_text'	 => 'Next Page &raquo;' ) );

		if ( $paged_links )
			$comment_navigation = $open . join( ' ', $paged_links ) . $close;
	}
	else {
		$comment_navigation = NULL;
	}

	// Available filter: dayneo_comment_navigation
	echo apply_filters( 'dayneo_comment_navigation', (string) $comment_navigation );
}

/**
 * dayneo_comments_callback() recreate the comment list
 *
 */
function dayneo_comments_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]		 = $comment;
	$GLOBALS[ 'comment_depth' ]	 = $depth;
	$tag				 = apply_filters( 'dayneo_comments_list_tag', (string) 'div' );
	?>

	<!--BEING .comment-->
        <<?php echo esc_html($tag); ?> class="<?php esc_attr(semantic_comments()); ?>" id="comment-<?php echo comment_ID(); ?>">
	<?php
	dayneo_hook_comments();
}

/**
 * dayneo_comments_endcallback() close the comment list
 *
 */
function dayneo_comments_endcallback() {
	// Available filter: dayneo_comments_list_tag
	$tag = apply_filters( 'dayneo_comments_list_tag', (string) 'div' );
	echo "<!--END .comment-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: dayneo_hook_inside_comments_loop
	do_action( 'dayneo_hook_inside_comments_loop' );
}

/**
 * dayneo_pings_callback() recreate the comment list
 *
 */
function dayneo_pings_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]	 = $comment;
	// Available filter: dayneo_pings_callback_tag
	$tag			 = apply_filters( 'dayneo_pings_callback_tag', (string) 'div' );
	// Available filter: dayneo_pings_callback_time
	$time			 = apply_filters( 'dayneo_pings_callback_time', (string) ' on ' );
	// Available filter: dayneo_pings_callback_time
	$when			 = apply_filters( 'dayneo_pings_callback_when', (string) ' at ' );

	if ( $comment->comment_approved == '0' )
		echo '<p class="ping-unapproved moderation alert">' . esc_html_e( 'Your trackback is awaiting moderation.', 'dayneo' ) . '</p>';
	?>

	<!--BEING .pings-->
	<<?php echo esc_html($tag); ?> class="<?php echo esc_attr(semantic_comments()); ?>" id="ping-<?php echo esc_attr($comment->comment_ID); ?>">
	<?php
	comment_author_link();
	echo esc_html($time);
	?><a class="trackback-time" href="<?php comment_link(); ?>"><?php
		comment_date();
		echo esc_html($when);
		comment_time();
		?></a>
	<?php
}

/**
 * dayneo_pings_endcallback() close the comment list
 *
 */
function dayneo_pings_endcallback() {
	// Available filter: dayneo_pings_callback_tag
	$tag = apply_filters( 'dayneo_pings_callback_tag', (string) 'div' );
	echo "<!--END .pings-list-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: dayneo_hook_inside_pings_list
	do_action( 'dayneo_hook_inside_pings_list' );
}

/**
 * dayneo_hook_comments() short description.
 *
 * Long description.
 *
 */
function dayneo_hook_comments( $callback = array( 'dayneo_comment_author', 'dayneo_comment_meta', 'dayneo_comment_moderation', 'dayneo_comment_text' ) ) {
	do_action( 'dayneo_hook_comments_open' ); // Available action: dayneo_comment_open
	do_action( 'dayneo_hook_comments' );

	$callback = apply_filters( 'dayneo_comments_callback', $callback ); // Available filter: dayneo_comments_callback
	// If $callback is an array, loop through all callbacks and call those functions if they exist
	if ( is_array( $callback ) ) {
		foreach ( $callback as $function ) {
			if ( function_exists( $function ) ) {
				call_user_func( $function );
			}
		}
	}

	// If $callback is a string, just call that function if it exist
	elseif ( is_string( $callback ) ) {
		if ( function_exists( $callback ) ) {
			call_user_func( $callback );
		}
	}
	do_action( 'dayneo_hook_comments_close' ); // Available action: dayneo_comment_close
}

function dayneo_custom_comment_form() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ) ? " aria-required='true'" : '';
	$html_req  = ( $req ) ? " required='required'" : '';
	$html5     = ( 'html5' === current_theme_supports( 'html5', 'comment-form' ) ) ? 'html5' : 'xhtml';

	$fields = array();

	$fields['author'] = '<div class="comment-form-author form-group"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name*', 'dayneo' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Name', 'dayneo' ) . '"/></div>';
	$fields['email']  = '<div class="comment-form-email form-group"><input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email*', 'dayneo' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Email', 'dayneo' ) . '"/></div>';
	$fields['url']    = '<div class="comment-form-url form-group"><input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'dayneo' ) . '" aria-label="' . esc_attr__( 'URL', 'dayneo' ) . '" /></div>';

	$comments_args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'	 => '<div class="comment-form-comment form-group"><textarea id="comment" name="comment" placeholder="'.esc_attr__( 'Comment', 'dayneo' ).'" class="form-control" rows="6" aria-required="true"></textarea></div>',
		'title_reply'          => esc_html__( 'Leave A Comment', 'dayneo' ),
		'title_reply_to'       => esc_html__( 'Leave A Comment', 'dayneo' ),
		/* translators: Opening and closing link tags. */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'dayneo' ), '<a href="' . esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '">', '</a>' ) . '</p>',
		/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
		'comment_notes_before' => '',
		'id_submit'            => 'comment-submit',
		'class_submit'         => 'btn btn-round btn-lg btn-base',
		'label_submit'         => esc_html__( 'Post Comment', 'dayneo' ),
	);

	return comment_form( $comments_args );
}