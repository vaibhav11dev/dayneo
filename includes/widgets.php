<?php
add_action( 'widgets_init', 'bigbo_widgets_init' );
function bigbo_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 1', 'bigbo' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 2', 'bigbo' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header Bar', 'bigbo' ),
        'id'            => 'headerbar',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'bigbo' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'bigbo' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'bigbo' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'bigbo' ),
        'id'            => 'footer-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Before Footer', 'bigbo' ),
        'id'            => 'before-footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'After Footer', 'bigbo' ),
        'id'            => 'after-footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );
}