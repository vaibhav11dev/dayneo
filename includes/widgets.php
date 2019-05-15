<?php
get_template_part( 'includes/widgets/125x125' );
get_template_part( 'includes/widgets/contact_info' );
get_template_part( 'includes/widgets/facebook-like-widget' );
get_template_part( 'includes/widgets/flickr-widget' );
get_template_part( 'includes/widgets/recent-posts-widget' );
get_template_part( 'includes/widgets/recent-works-widget' );
get_template_part( 'includes/widgets/social_links' );
if ( function_exists( 'WC' ) ) {
    get_template_part( 'includes/widgets/product-carousel-widget' );
}
$dd_options		 = get_option( 'dd_options' );
$dd_footer_widget_col	 = (isset( $dd_options[ 'dd_footer_widget_col' ] )) ? $dd_options[ 'dd_footer_widget_col' ] : 'disable';

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
		'name'		 => __( 'Sidebar 1', 'bigbo' ),
		'id'		 => 'sidebar-1',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase">',
		'after_title'	 => '</h6>',
	) );

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
		'name'		 => __( 'Sidebar 2', 'bigbo' ),
		'id'		 => 'sidebar-2',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'	 => '</div></div>',
		'before_title'	 => '<h6 class="text-title text-uppercase">',
		'after_title'	 => '</h6>',
	) );

function bigbo_headerbar() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Header Bar', 'bigbo' ),
			'id'		 => 'headerbar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_footer1() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 1', 'bigbo' ),
			'id'		 => 'footer-1',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_footer2() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 2', 'bigbo' ),
			'id'		 => 'footer-2',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_footer3() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 3', 'bigbo' ),
			'id'		 => 'footer-3',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_footer4() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Footer 4', 'bigbo' ),
			'id'		 => 'footer-4',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_beforefooter() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'Before Footer', 'bigbo' ),
			'id'		 => 'before-footer',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

function bigbo_afterfooter() {
	if ( function_exists( 'register_sidebar' ) )
		register_sidebar( array(
			'name'		 => __( 'After Footer', 'bigbo' ),
			'id'		 => 'after-footer',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'	 => '</div></div>',
			'before_title'	 => '<h6 class="text-title text-uppercase">',
			'after_title'	 => '</h6>',
		) );
}

// Footer widgets
bigbo_headerbar();
bigbo_beforefooter();
bigbo_afterfooter();
bigbo_footer1();
bigbo_footer2();
bigbo_footer3();
bigbo_footer4();