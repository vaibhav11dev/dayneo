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
		'name'		 => __( 'Sidebar 1', 'daydream' ),
		'id'		 => 'sidebar-1',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
		'after_title'	 => '</h6>',
	) );

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
		'name'		 => __( 'Sidebar 2', 'daydream' ),
		'id'		 => 'sidebar-2',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
		'after_title'	 => '</h6>',
	) );

function daydream_footer1() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 1', 'daydream' ),
			'id'		 => 'footer-1',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
			'after_title'	 => '</h6>',
		) );
}

function daydream_footer2() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 2', 'daydream' ),
			'id'		 => 'footer-2',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
			'after_title'	 => '</h6>',
		) );
}

function daydream_footer3() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 3', 'daydream' ),
			'id'		 => 'footer-3',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
			'after_title'	 => '</h6>',
		) );
}

function daydream_footer4() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 4', 'daydream' ),
			'id'		 => 'footer-4',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase bottom-line">',
			'after_title'	 => '</h6>',
		) );
}

// Footer widgets

if ( ($dd_footer_widget_col == "one" ) ) {
	daydream_footer1();
}
if ( ($dd_footer_widget_col == "two" ) ) {
	daydream_footer1();
	daydream_footer2();
}
if ( ($dd_footer_widget_col == "three" ) ) {
	daydream_footer1();
	daydream_footer2();
	daydream_footer3();
}
if ( ($dd_footer_widget_col == "four" ) ) {
	daydream_footer1();
	daydream_footer2();
	daydream_footer3();
	daydream_footer4();
}


