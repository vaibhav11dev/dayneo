<?php
global $ved_options;
if(isset($ved_options['ved_cookies_info']) && $ved_options['ved_cookies_info']){
	if(isset($_COOKIE['bigbo_cookies']) && $_COOKIE['bigbo_cookies']=='accepted'){
		return;
	}
	
	$page_id = false;
	if( isset($ved_options['ved_cookies_policy_page']) ){
		$page_id=$ved_options['ved_cookies_policy_page'];
	}
	?>
	<div class="bigbo-cookies-info">
		<div class="bigbo-cookies-inner">
			<div class="cookies-info-text">
				<?php echo do_shortcode( $ved_options['ved_cookies_text'] ); ?>
			</div>
			<div class="cookies-buttons">
				<a href="#" class="cookies-info-accept-btn"><?php esc_html_e( 'Accept', 'bigbo' ); ?></a>
				<?php if ( $page_id ): ?>
					<a href="<?php echo esc_url(get_permalink($page_id));?>" class="cookies-more-btn"><?php esc_html_e( 'More info' , 'bigbo' ); ?></a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php
}