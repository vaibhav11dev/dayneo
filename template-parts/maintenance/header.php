<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr(get_bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
<?php wp_head(); ?>
</head>

<?php
	if ( $ved_comingsoon_bg = bigbo_get_option( 'ved_comingsoon_bg', '' ) ) {
        $comingsoonimage = $ved_comingsoon_bg['url'];
    } 
?>

<body <?php body_class(); ?> <?php if ( bigbo_get_option( 'ved_maintenance_mode' ) == 'comingsoon' ) { ?> style="background: #222 url(<?php echo esc_url($comingsoonimage); ?>) no-repeat fixed center center;background-size:cover" <?php } ?> >
<?php 
$ved_header_logo = bigbo_get_option( 'ved_header_logo', '' );

$ved_back_to_top = bigbo_get_option( 'ved_back_to_top', 'right' );
if ( $ved_back_to_top == 1 ) {
	?>
	<div class="back-to-top">
		<a href="#top" class="scroll-top"><i class="ti-arrow-up"></i></a>
	</div>
	<?php
}
?>
	
<!-- Main Body Wrapper Element -->
<div id="page" class="hfeed site page-wrapper">
		
	<div class="wrapper" id="main">
		<header id="header" class="topbar-light">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo); ?>">
			</a>
		</header>