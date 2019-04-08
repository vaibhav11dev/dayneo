<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}
?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text'	 => '&larr;',
					'next_text'	 => '&rarr;',
					'type'		 => 'list',
				) ) );
				echo '</nav>';
			endif;
			?>

<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'dayneo' ); ?></p>

<?php endif; ?>
	</div>

<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper clearfix">
			<div id="review_form">
				<?php
				$commenter = wp_get_current_commenter();

				$comment_form = array(
					'title_reply'		 => have_comments() ? __( '<h5 class="text-title text-uppercase bottom-line">Add a review</h5>', 'dayneo' ) : sprintf( __( '<h5 class="text-title text-uppercase bottom-line">Be the first to review &ldquo;%s&rdquo;</h5>', 'dayneo' ), get_the_title() ),
					'title_reply_to'	 => __( 'Leave a Reply to %s', 'dayneo' ),
					'title_reply_before'	 => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'	 => '</span>',
					'comment_notes_after'	 => '',
					'fields'		 => array(
						'author' => '<div class="col-sm-6"><div class="form-group comment-form-author">' . '<label for="author" class="sr-only">' . esc_html__( 'Name', 'dayneo' ) . ' <span class="required">*</span></label> ' .
						'<input class="form-control" placeholder="' . esc_attr_e( 'Name', 'dayneo' ) . ' " id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30" aria-required="true" required /></div></div>',
						'email'	 => '<div class="col-sm-6"><div class="form-group comment-form-email"><label for="email" class="sr-only">' . esc_html__( 'Email', 'dayneo' ) . ' <span class="required">*</span></label> ' .
						'<input placeholder="' . esc_attr_e( 'Email', 'dayneo' ) . '" class="form-control" id="email" name="email" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30" aria-required="true" required /></div></div><div class="clearfix"></div>',
					),
					'label_submit'		 => __( 'Submit Review', 'dayneo' ),
					'logged_in_as'		 => '',
					'comment_field'		 => '',
				);

				if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
					$comment_form[ 'must_log_in' ] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'dayneo' ), esc_url( $account_page_url ) ) . '</p>';
				}

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="col-sm-12"><div class="form-group comment-form-rating"><select class="form-control" name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'dayneo' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'dayneo' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'dayneo' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'dayneo' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'dayneo' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'dayneo' ) . '</option>
						</select></div></div>';
					}

				$comment_form[ 'comment_field' ] .= '<div class="col-sm-12"><div class="comment-form-comment form-group"><textarea class="form-control" placeholder="' . esc_attr_e( 'Your review*', 'dayneo' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></div></div><div class="clearfix"></div>';


				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'dayneo' ); ?></p>

<?php endif; ?>

	<div class="clear"></div>
</div>
