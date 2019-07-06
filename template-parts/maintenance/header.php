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

<body <?php body_class(); ?>>
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
	
	<header id="header" class="topbar-light">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo); ?>">
		</a>
	</header>
	<div class="wrapper" id="main">