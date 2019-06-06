<?php
global $ved_options;

$ved_nofollow_social_links	 = bigbo_get_option( 'ved_nofollow_social_links', '0' );
$nofollow			 = '';
if ( $ved_nofollow_social_links ) {
	$nofollow = 'rel="nofollow"';
}

foreach ( $ved_options as $name => $value ) {
	$social_name = strpos( $name, 'ved_social_link_' );
	if ( $social_name!== false ) {
		$social_networks[ $name ] = str_replace( 'ved_social_link_', '', $name );
	}
}

$ved_social_boxed = '';
if ( isset( $ved_options[ 'ved_social_boxed' ] ) && $ved_options[ 'ved_social_boxed' ] == 'yes' ) {
	$ved_social_boxed = 'boxed-icons';
}

?>       
<ul class="clearfix header-social social-icons <?php echo esc_attr($ved_social_boxed); ?>">
	<?php
	foreach ( $social_networks as $name => $value ):
		if ( $ved_options[ $name ] ):
			?>
			<li>
				<a class="ved-social-network-icon ved-<?php echo esc_attr($value); ?>" href="<?php echo esc_url($ved_options[ $name ]); ?>" data-toggle="tooltip" data-placement="<?php echo esc_attr(strtolower( $ved_options[ 'ved_social_tooltip_position' ] )); ?>" data-original-title="<?php echo esc_attr(ucwords( $value )); ?>" <?php echo esc_attr($nofollow); ?> target="<?php echo esc_attr($ved_options[ 'ved_social_target' ]); ?>"><i class="fa fa-<?php echo esc_attr($value); ?>"></i>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
</ul>
		<?php
