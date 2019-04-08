<?php
if ( has_nav_menu( 'top-menu' ) ) {
	wp_nav_menu( array( 'theme_location' => 'top-menu', 'menu_class' => 'top-bar-list list-dividers' ) );
} else {
	echo 'Please first assign menu on top menu location';
}