<?php

/**
 * Pluggable - daydream pluggable functions.
 *
 * These functions can be replaced via styles/plugins. If styles/plugins do
 * not redefine these functions, then these will be used instead.
 *
 * @package WPdaydream
 * @subpackage Core
 */
/**
 * daydream_comment_name() - short description
 *
 */
if ( ! function_exists( 'daydream_comment_name' ) ):

	function daydream_comment_name() {
		$commenter = get_comment_author_link();
		return $commenter;
	}

endif;

/**
 * daydream_comment_avatar() - short description
 *
 */
if ( ! function_exists( 'daydream_comment_avatar' ) ):

	function daydream_comment_avatar() {
		global $default;
		$gravatar_email	 = get_comment_author_email();
		$author		 = get_comment_author();
		$output		 = get_avatar( $gravatar_email, 96, $default, $author );

		if ( get_option( 'show_avatars' ) ) {
			return apply_filters( 'daydream_comment_avatar', (string) $output );
		}
	}

endif;

/**
 * daydream_comment_date() - short description
 *
 */
if ( ! function_exists( 'daydream_comment_date' ) ):

	function daydream_comment_date() {
		$date	 = '<a href="' . esc_url(htmlspecialchars( get_comment_link() )) . '" data-toggle="tooltip" title="' . get_comment_date() . '">';
		$date	 .= '<i class="icon-clock icons"></i>';
		$date	 .= '</a>';
		return apply_filters( 'daydream_comment_date', (string) $date ); // Available filter: daydream_comment_date
	}

endif;

/**
 * daydream_comment_time() - short description
 *
 */
if ( ! function_exists( 'daydream_comment_time' ) ):

	function daydream_comment_time() {
		$time	 = '<span class="comment-date">';
		$time	 .= get_comment_time();
		$time	 .= '</span>';
		return apply_filters( 'daydream_comment_time', (string) $time ); // Available filter: daydream_comment_time
	}

endif;

/**
 * daydream_comment_link() - short description
 *
 * @since 0.3.1
 */
if ( ! function_exists( 'daydream_comment_link' ) ):

	function daydream_comment_link() {
		$link	 = '<span class="comment-permalink">';
		$link	 .= '<a rel="bookmark" title="' . __( 'Permalink to this comment', 'daydream' ) . '" href="' . esc_url(htmlspecialchars( get_comment_link() )) . '">';
		$link	 .= apply_filters( 'daydream_comment_link_text', (string) '<i class="ved-icon-link"></i>' );
		$link	 .= '</a></span>';
		return apply_filters( 'daydream_comment_link', (string) $link ); // Available filter: daydream_comment_link
	}

endif;

/**
 * daydream_comment_edit() - short description
 *
 * @since 0.3.1
 */
if ( ! function_exists( 'daydream_comment_edit' ) ):

	function daydream_comment_edit() {
		ob_start();
		edit_comment_link( __( 'EDIT', 'daydream' ), '<span class="edit-comment">', '</span>' );
		return ob_get_clean();
	}

endif;

/**
 * daydream_comment_reply() - short description
 *
 * @since - 0.3.1
 */
if ( ! function_exists( 'daydream_comment_reply' ) ):

	function daydream_comment_reply( $return = false ) {
		global $comment_depth;
		$max_depth	 = get_option( 'thread_comments_depth' );
		// Available filter: daydream_reply_text
		$reply_text	 = apply_filters( 'daydream_reply_text', (string) __( '<i class="icon-action-undo icons"></i>', 'daydream' ) );
		// Available filter: daydream_login_text
		$login_text	 = apply_filters( 'daydream_login_text', (string) __( 'Log in to reply.', 'daydream' ) );
		if ( ( get_option( 'thread_comments' ) ) && get_comment_type() == 'comment' ) {

			if ( $return ) {
				return get_comment_reply_link( array(
				    'reply_text'	 => $reply_text,
				    'login_text'	 => $login_text,
				    'depth'		 => $comment_depth,
				    'max_depth'	 => $max_depth,
				    'before'	 => '',
				    'after'		 => ''
				) );
			} else {
				comment_reply_link( array(
				    'reply_text'	 => $reply_text,
				    'login_text'	 => $login_text,
				    'depth'		 => $comment_depth,
				    'max_depth'	 => $max_depth,
				    'before'	 => '<div class="comment-reply">',
				    'after'		 => '</div>'
				) );
			}
		}
	}







endif;