<?php

/**
 * Pluggable - bigbo pluggable functions.
 *
 * These functions can be replaced via styles/plugins. If styles/plugins do
 * not redefine these functions, then these will be used instead.
 *
 * @package WPbigbo
 * @subpackage Core
 */
/**
 * bigbo_comment_name() - short description
 *
 */
if ( ! function_exists( 'bigbo_comment_name' ) ):

	function bigbo_comment_name() {
		$commenter = get_comment_author_link();
		return $commenter;
	}

endif;

/**
 * bigbo_comment_avatar() - short description
 *
 */
if ( ! function_exists( 'bigbo_comment_avatar' ) ):

	function bigbo_comment_avatar() {
		global $default;
		$gravatar_email	 = get_comment_author_email();
		$author		 = get_comment_author();
		$output		 = get_avatar( $gravatar_email, 96, $default, $author );

		if ( get_option( 'show_avatars' ) ) {
			return apply_filters( 'bigbo_comment_avatar', (string) $output );
		}
	}

endif;

/**
 * bigbo_comment_date() - short description
 *
 */
if ( ! function_exists( 'bigbo_comment_date' ) ):

	function bigbo_comment_date() {
		$date	 = '<a href="' . esc_url(htmlspecialchars( get_comment_link() )) . '" data-toggle="tooltip" title="' . get_comment_date() . '">';
		$date	 .= '<i class="icon-clock icons"></i>';
		$date	 .= '</a>';
		return apply_filters( 'bigbo_comment_date', (string) $date ); // Available filter: bigbo_comment_date
	}

endif;

/**
 * bigbo_comment_time() - short description
 *
 */
if ( ! function_exists( 'bigbo_comment_time' ) ):

	function bigbo_comment_time() {
		$time	 = '<span class="comment-date">';
		$time	 .= get_comment_time();
		$time	 .= '</span>';
		return apply_filters( 'bigbo_comment_time', (string) $time ); // Available filter: bigbo_comment_time
	}

endif;

/**
 * bigbo_comment_link() - short description
 *
 * @since 0.3.1
 */
if ( ! function_exists( 'bigbo_comment_link' ) ):

	function bigbo_comment_link() {
		$link	 = '<span class="comment-permalink">';
		$link	 .= '<a rel="bookmark" title="' . esc_html__( 'Permalink to this comment', 'bigbo' ) . '" href="' . esc_url(htmlspecialchars( get_comment_link() )) . '">';
		$link	 .= apply_filters( 'bigbo_comment_link_text', (string) '<i class="ved-icon-link"></i>' );
		$link	 .= '</a></span>';
		return apply_filters( 'bigbo_comment_link', (string) $link ); // Available filter: bigbo_comment_link
	}

endif;

/**
 * bigbo_comment_edit() - short description
 *
 * @since 0.3.1
 */
if ( ! function_exists( 'bigbo_comment_edit' ) ):

	function bigbo_comment_edit() {
		ob_start();
		edit_comment_link( esc_html__( 'EDIT', 'bigbo' ), '<span class="edit-comment">', '</span>' );
		return ob_get_clean();
	}

endif;

/**
 * bigbo_comment_reply() - short description
 *
 * @since - 0.3.1
 */
if ( ! function_exists( 'bigbo_comment_reply' ) ):

	function bigbo_comment_reply( $return = false ) {
		global $comment_depth;
		$max_depth	 = get_option( 'thread_comments_depth' );
		// Available filter: bigbo_reply_text
		$reply_text	 = apply_filters( 'bigbo_reply_text', (string) __( '<i class="icon-action-undo icons"></i>', 'bigbo' ) );
		// Available filter: bigbo_login_text
		$login_text	 = apply_filters( 'bigbo_login_text', (string) esc_html__( 'Log in to reply.', 'bigbo' ) );
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