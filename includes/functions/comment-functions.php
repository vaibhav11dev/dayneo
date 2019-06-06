<?php
/**
 * Comments - functions that deal with comments
 *
 * @package Bigbo
 * @subpackage Core
 */

/**
 * bigbo_discussion_title()
 *
 * @filter bigbo_many_comments, bigbo_no_comments, bigbo_one_comment, bigbo_comments_number
 */
function bigbo_discussion_title( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	$discussion_title	 = '';
	$comment_count		 = bigbo_count( 'comment', false );
	$ping_count		 = bigbo_count( 'pings', false );

	switch ( $type ) {
		case 'comment' :
			$count	 = $comment_count;
			// Available filter: bigbo_many_comments
			$many	 = apply_filters( 'bigbo_many_comments', esc_html__( '% Comments', 'bigbo' ) );
			// Available filter: bigbo_no_comments
			$none	 = apply_filters( 'bigbo_no_comments', esc_html__( 'No Comments Yet', 'bigbo' ) );
			// Available filter: bigbo_one_comment
			$one	 = apply_filters( 'bigbo_one_comment', esc_html__( '1 Comment', 'bigbo' ) );
			break;
		case 'pings' :
			$count	 = $ping_count;
			// Available filter: bigbo_many_pings
			$many	 = apply_filters( 'bigbo_many_pings', esc_html__( '% Pings/Trackbacks', 'bigbo' ) );
			// Available filter: bigbo_no_pings
			$none	 = apply_filters( 'bigbo_no_pings', esc_html__( 'No Pings/Trackbacks Yet', 'bigbo' ) );
			// Available filter: bigbo_one_comment
			$one	 = apply_filters( 'bigbo_one_ping', esc_html__( '1 Ping/Trackback', 'bigbo' ) );
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

	// Available filter: bigbo_discussion_title_tag
	$tag	 = apply_filters( 'bigbo_discussion_title_tag', (string) 'h5' );
	$class	 = 'text-title text-uppercase';

	if ( $number ) {
		$discussion_title = '<' . $tag . ' class="' . esc_attr($type . '-title ' . $class) . '">' . $number . '</' . $tag . '>';
	}

	// Available filter: bigbo_discussion_title
	$bigbo_discussion_title = apply_filters( 'bigbo_discussion_title', (string) $discussion_title );

        $allowed_html = array(
                'h5' => array(
                        'class' => array(),
                ),
        );
        
	return ( $echo ) ? print( wp_kses( $bigbo_discussion_title, $allowed_html ) ) : wp_kses( $bigbo_discussion_title, $allowed_html );
}

/**
 * bigbo_count()
 *
 * @since 0.3
 * @needsdoc
 */
function bigbo_count( $type = NULL, $echo = true ) {
	if ( ! $type ) {
		return;
	}

	global $wp_query;

	$comment_count	 = $wp_query->comment_count;
	$ping_count	 = count( $wp_query->comments_by_type[ 'pings' ] );

        $allowed_html = array(
                'a'   => array(
                        'href' => array(),
                )
        );
        
	switch ( $type ):
		case 'comment':
			return ( $echo ) ? print( wp_kses( $comment_count, $allowed_html ) ) : (int)$comment_count;
			break;
		case 'pings':
			return ( $echo ) ? print( wp_kses( $ping_count, $allowed_html ) ) : (int)$ping_count;
			break;
	endswitch;
}

/**
 * bigbo_comment_author() short description
 *
 * @since 0.3
 * @todo needs filter
 */
function bigbo_comment_author( $meta_format = '%avatar%' ) {
	// Available filter: bigbo_comment_author_meta_format
	$meta_format = apply_filters( 'bigbo_comment_author_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo wp_kses_post($meta_format);
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
					$meta_array[ $key ] = bigbo_comment_avatar();
					break;

				case '%name%':
					$meta_array[ $key ] = bigbo_comment_name();
					break;
			}
		}

		$output = join( '', $meta_array );
		if ( $output ) {
			echo wp_kses_post($open . $output . $close);
		}
	}
}

/**
 * bigbo_comment_meta() short description
 *
 */
function bigbo_comment_meta( $meta_format = '%date% %reply%' ) {
	// Available filter: bigbo_comment_meta_format
	$meta_format = apply_filters( 'bigbo_comment_meta_format', $meta_format );

	if ( ! $meta_format ) {
		return;
	}

	// No keywords to replace
	if ( strpos( $meta_format, '%' ) === false ) {
		echo wp_kses_post($meta_format);
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
					$meta_array[ $key ] = bigbo_comment_date();
					break;

				case '%time%':
					$meta_array[ $key ] = bigbo_comment_time();
					break;

				case '%link%':
					$meta_array[ $key ] = bigbo_comment_link();
					break;

				case '%reply%':
					$meta_array[ $key ] = bigbo_comment_reply( true );
					break;

				case '%edit%':
					$meta_array[ $key ] = bigbo_comment_edit();
					break;
			}
		}
		$output = join( '', $meta_array );
		if ( $output )
			echo wp_kses_post($open . $output . $close);
	}
}

/**
 * bigbo_comment_text() short description
 *
 */
function bigbo_comment_text() {
	echo '<div class="comment-content">';
	echo '<h5>' . bigbo_comment_name() . '</h5>';
	echo '<p>' . comment_text() . '</p>';
	echo '</div>';
}

/**
 * bigbo_comment_moderation() short description
 *
 */
function bigbo_comment_moderation() {
	global $comment;
	if ( $comment->comment_approved == '0' )
		echo '<p class="comment-unapproved moderation alert">' . esc_html__( 'Your comment is awaiting moderation', 'bigbo' ) . '</p>';
}

/**
 * bigbo_comment_navigation() paged comments
 *
 */
function bigbo_comment_navigation() {
	$num = get_comments_number() + 1;

// Available filter: bigbo_comment_navigation_tag
	$tag	 = apply_filters( 'bigbo_comment_navigation_tag', (string) 'div' );
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

	// Available filter: bigbo_comment_navigation
	echo apply_filters( 'bigbo_comment_navigation', (string) $comment_navigation );
}

/**
 * bigbo_comments_callback() recreate the comment list
 *
 */
function bigbo_comments_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]		 = $comment;
	$GLOBALS[ 'comment_depth' ]	 = $depth;
	$tag				 = apply_filters( 'bigbo_comments_list_tag', (string) 'div' );
	?>

	<!--BEING .comment-->
        <<?php echo esc_html($tag); ?> class="<?php esc_attr(semantic_comments()); ?>" id="comment-<?php echo comment_ID(); ?>">
	<?php
	bigbo_hook_comments();
}

/**
 * bigbo_comments_endcallback() close the comment list
 *
 */
function bigbo_comments_endcallback() {
	// Available filter: bigbo_comments_list_tag
	$tag = apply_filters( 'bigbo_comments_list_tag', (string) 'div' );
	echo "<!--END .comment-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: bigbo_hook_inside_comments_loop
	do_action( 'bigbo_hook_inside_comments_loop' );
}

/**
 * bigbo_pings_callback() recreate the comment list
 *
 */
function bigbo_pings_callback( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ]	 = $comment;
	// Available filter: bigbo_pings_callback_tag
	$tag			 = apply_filters( 'bigbo_pings_callback_tag', (string) 'div' );
	// Available filter: bigbo_pings_callback_time
	$time			 = apply_filters( 'bigbo_pings_callback_time', (string) ' on ' );
	// Available filter: bigbo_pings_callback_time
	$when			 = apply_filters( 'bigbo_pings_callback_when', (string) ' at ' );

	if ( $comment->comment_approved == '0' )
		echo '<p class="ping-unapproved moderation alert">' . esc_html__( 'Your trackback is awaiting moderation.', 'bigbo' ) . '</p>';
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
 * bigbo_pings_endcallback() close the comment list
 *
 */
function bigbo_pings_endcallback() {
	// Available filter: bigbo_pings_callback_tag
	$tag = apply_filters( 'bigbo_pings_callback_tag', (string) 'div' );
	echo "<!--END .pings-list-->";
	echo "</" . esc_html($tag) . ">";
	// Available action: bigbo_hook_inside_pings_list
	do_action( 'bigbo_hook_inside_pings_list' );
}

/**
 * bigbo_hook_comments() short description.
 *
 * Long description.
 *
 */
function bigbo_hook_comments( $callback = array( 'bigbo_comment_author', 'bigbo_comment_meta', 'bigbo_comment_moderation', 'bigbo_comment_text' ) ) {
	do_action( 'bigbo_hook_comments_open' ); // Available action: bigbo_comment_open
	do_action( 'bigbo_hook_comments' );

	$callback = apply_filters( 'bigbo_comments_callback', $callback ); // Available filter: bigbo_comments_callback
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
	do_action( 'bigbo_hook_comments_close' ); // Available action: bigbo_comment_close
}

function bigbo_custom_comment_form() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ) ? " aria-required='true'" : '';
	$html_req  = ( $req ) ? " required='required'" : '';
	$html5     = ( 'html5' === current_theme_supports( 'html5', 'comment-form' ) ) ? 'html5' : 'xhtml';

	$fields = array();

	$fields['author'] = '<div class="comment-form-author form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>Name:</label><div class="col-sm-9"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name*', 'bigbo' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Name', 'bigbo' ) . '"/></div></div>';
	$fields['email']  = '<div class="comment-form-email form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>E-mail:</label><div class="col-sm-9"><input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email*', 'bigbo' ) . '" ' . $aria_req . $html_req . ' aria-label="' . esc_attr__( 'Email', 'bigbo' ) . '"/></div></div>';
	$fields['url']    = '<div class="comment-form-url form-group row"><label class="col-sm-3 form-control-label required">Website:</label><div class="col-sm-9"><input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'bigbo' ) . '" aria-label="' . esc_attr__( 'URL', 'bigbo' ) . '" /></div></div>';

	$comments_args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'	 => '<div class="comment-form-comment form-group row"><label class="col-sm-3 form-control-label required"><span class="required">*</span>Comment:</label><div class="col-sm-9"><textarea id="comment" name="comment" placeholder="'.esc_attr__( 'Comment', 'bigbo' ).'" class="form-control" rows="6" aria-required="true"></textarea></div></div>',
		'title_reply'          => esc_html__( 'Leave A Reply', 'bigbo' ),
		'title_reply_to'       => esc_html__( 'Leave A Reply', 'bigbo' ),
		/* translators: Opening and closing link tags. */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'bigbo' ), '<a href="' . esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '">', '</a>' ) . '</p>',
		/* translators: %1$s: The username. %2$s and %3$s: Opening and closing link tags. */
		'comment_notes_before' => '',
		'id_submit'            => 'comment-submit',
		'class_submit'         => 'btn btn-lg btn-base',
		'label_submit'         => esc_html__( 'Submit', 'bigbo' ),
	);

	return comment_form( $comments_args );
}
