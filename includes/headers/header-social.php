<?php
global $dd_options;

$dd_nofollow_social_links	 = dayneo_get_option( 'dd_nofollow_social_links', '0' );
$nofollow			 = '';
if ( $dd_nofollow_social_links ) {
	$nofollow = 'rel="nofollow"';
}

foreach ( $dd_options as $name => $value ) {
	$social_name = strpos( $name, 'dd_social_link_' );
	if ( $social_name!== false ) {
		$social_networks[ $name ] = str_replace( 'dd_social_link_', '', $name );
	}
}

$dd_social_boxed = '';
if ( isset( $dd_options[ 'dd_social_boxed' ] ) && $dd_options[ 'dd_social_boxed' ] == 'yes' ) {
	$dd_social_boxed = 'boxed-icons';
}

?>       
<ul class="clearfix header-social social-icons <?php echo esc_attr($dd_social_boxed); ?>">
	<?php
	foreach ( $social_networks as $name => $value ):
		if ( $dd_options[ $name ] ):
			?>
			<li>
				<a class="ved-social-network-icon ved-<?php echo esc_attr($value); ?>" href="<?php echo esc_url($dd_options[ $name ]); ?>" data-toggle="tooltip" data-placement="<?php echo esc_attr(strtolower( $dd_options[ 'dd_social_tooltip_position' ] )); ?>" data-original-title="<?php echo esc_attr(ucwords( $value )); ?>" title="" <?php echo esc_attr($nofollow); ?> target="<?php echo esc_attr($dd_options[ 'dd_social_target' ]); ?>"><i class="fa fa-<?php echo esc_attr($value); ?>"></i>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
</ul>
		<?php
