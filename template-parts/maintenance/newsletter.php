<?php
global $ved_options;

if( 
	( isset($ved_options['ved_comming_soon_newsletter']) && $ved_options['ved_comming_soon_newsletter'] == 1 )
	&& ( bigbo_check_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php') )
	&& ( isset($ved_options['ved_comming_page_newsletter_shortcode']) && !empty($ved_options['ved_comming_page_newsletter_shortcode']) )
){
	$mailchimp_id = $ved_options['ved_comming_page_newsletter_shortcode'];
	?>
	<div class="action-box maintenance-newsletter">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-sm-8"> 
					<h5><?php esc_html_e('We will notify you when site is ready :', 'bigbo' ); ?></h5>
					<h3><?php esc_html_e('Provide your email address!', 'bigbo' ); ?></h3>
					<form id="mc4wp-form-1" class="notify-form mc4wp-form mc4wp-form-<?php echo esc_attr($mailchimp_id);?>" method="post" data-id="<?php echo esc_attr($mailchimp_id);?>" data-name="NewsLetter">
						<div class="mc4wp-form-fields">
							<input class="newsletter_email" name="EMAIL" placeholder="<?php esc_attr_e('Your email address', 'bigbo' );?>" required="" type="email">
							<input class="newsletter_submit" value="<?php esc_html_e('Notify Me', 'bigbo' );?>" type="submit">
							<div class="bigbo-hidden">
								<input name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" type="text">
							</div>
							<input name="_mc4wp_timestamp" value="<?php echo esc_attr(time());?>" type="hidden">
							<input name="_mc4wp_form_id" value="<?php echo esc_attr($mailchimp_id);?>" type="hidden">
							<input name="_mc4wp_form_element_id" value="mc4wp-form-1" type="hidden">
						</div>
						<div class="mc4wp-response"><?php echo mc4wp_form_get_response_html($mailchimp_id);?></div>
					</form>
				</div>			
			</div>
		</div>
	</div>
	<?php
}