<?php
get_template_part( 'includes/widgets/tweets-widget' );
get_template_part( 'includes/widgets/flickr-widget' );
get_template_part( 'includes/widgets/facebook-like-widget' );
get_template_part( 'includes/widgets/125x125' );
get_template_part( 'includes/widgets/social_links' );
get_template_part( 'includes/widgets/contact_info' );
get_template_part( 'includes/widgets/recent-works-widget' );

$dd_options		 = get_option( 'dd_options' );
$dd_footer_widget_col	 = (isset( $dd_options[ 'dd_footer_widget_col' ] )) ? $dd_options[ 'dd_footer_widget_col' ] : 'disable';

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
		'name'		 => __( 'Sidebar 1', 'dayneo' ),
		'id'		 => 'sidebar-1',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase">',
		'after_title'	 => '</h6>',
	) );

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
		'name'		 => __( 'Sidebar 2', 'dayneo' ),
		'id'		 => 'sidebar-2',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase">',
		'after_title'	 => '</h6>',
	) );

function dayneo_headerbar() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Header Bar', 'dayneo' ),
			'id'		 => 'headerbar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_footer1() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 1', 'dayneo' ),
			'id'		 => 'footer-1',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_footer2() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 2', 'dayneo' ),
			'id'		 => 'footer-2',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_footer3() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 3', 'dayneo' ),
			'id'		 => 'footer-3',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_footer4() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 4', 'dayneo' ),
			'id'		 => 'footer-4',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_beforefooter() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Before Footer', 'dayneo' ),
			'id'		 => 'before-footer',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function dayneo_afterfooter() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'After Footer', 'dayneo' ),
			'id'		 => 'after-footer',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

// Footer widgets
dayneo_headerbar();
dayneo_beforefooter();
dayneo_afterfooter();
dayneo_footer1();
dayneo_footer2();
dayneo_footer3();
dayneo_footer4();