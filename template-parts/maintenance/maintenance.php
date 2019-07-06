<?php
/**
 * Default page template to display all pages
 *
 * @package CiyaShop
 * @author Potenza Global Solutions
 */
get_template_part('template-parts/maintenance/header');
?>

<?php
global $ved_options;
$maintenance_mode = $ved_options['ved_maintenance_mode'];
if( empty( $maintenance_mode ) ){
	$maintenance_mode = 'maintenance';
}

if( $maintenance_mode == 'comingsoon' ){
	$comingsoon_title = $ved_options['ved_comingsoon_title'];
	$comingsoon_subtitle = $ved_options['ved_comingsoon_subtitle'];
	
	$mntc_cs_title = ( ! empty( $comingsoon_title ) ) ? $comingsoon_title : esc_html__( 'Coming Soon', 'bigbo' );
	$mntc_cs_sutitle = ( ! empty( $comingsoon_subtitle ) ) ? $comingsoon_subtitle : esc_html__( 'We are currently working on a website and won\'t take long. Don\'t forget to check out our Social updates.', 'bigbo' );
}else{
	$maintenance_title = $ved_options['ved_maintenance_title'];
	$maintenance_subtitle = $ved_options['ved_maintenance_subtitle'];
	
	$mntc_cs_title = ( ! empty( $maintenance_title ) ) ? $maintenance_title : esc_html__( 'Site is Under Maintenance', 'bigbo' );
	$mntc_cs_sutitle = ( ! empty( $maintenance_subtitle ) ) ? $maintenance_subtitle : esc_html__( 'This Site is Currently Under Maintenance. We will back shortly', 'bigbo' );
}
?>
<div class="mntc-cs-main white-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="mntc-cs-item mntc-cs-content text-center">
					<i class="fa <?php echo esc_attr(( $maintenance_mode == 'comingsoon' ) ? 'fa-clock-o' : 'fa-cog');?> fa-spin fa-3x fa-fw margin-bottom"></i>
					<h1 class="text-blue"><?php echo esc_html($mntc_cs_title);?></h1>
					<p><?php echo esc_html($mntc_cs_sutitle);?></p>
				</div>
				<?php
				if( $maintenance_mode == 'comingsoon' ){
					$comingsoon_date = $ved_options['ved_comingsoon_date'];
					$comingsoon_date = date_create_from_format('m/d/Y', $comingsoon_date);
					$comingsoon_date = $comingsoon_date->format( 'Y/m/d' );
					
					$counter_data = array(
						'days'           => esc_html__("Days", 'bigbo' ),
						'hours'          => esc_html__("Hours", 'bigbo' ),
						'minutes'        => esc_html__("Minutes", 'bigbo' ),
						'seconds'        => esc_html__("Seconds", 'bigbo' ),
					);
					
					$counter_data = json_encode($counter_data);
					?>
					<div class="mntc-cs-item mntc-cs-content coming-soon-countdown">
						<ul class="commingsoon_countdown" data-countdown_date="<?php echo esc_attr($comingsoon_date);?>" data-counter_data="<?php echo esc_attr($counter_data);?>"></ul>
					</div>
					<?php
				}

				if ($ved_options['ved_comming_soon_social_icons']) {
				bigbo_topbar_social();
				}

				?>
			</div>
		</div>
	</div>
</div>
<?php
// Newsletter
get_template_part( 'template-parts/maintenance/newsletter' );

get_template_part( 'template-parts/maintenance/footer' );