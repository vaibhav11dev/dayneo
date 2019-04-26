<?php
/*
 * 
 * Template: Navigation.php 
 *
 */

$dd_pagination_type = dayneo_get_option( 'dd_pagination_type', 'pagination' );

if ( is_singular() and ! is_page() ) {
	?>
	<div class="navigation-links single-page-navigation clearfix">
	    <div class="col-sm-6 col-md-6 nav-next"><?php previous_post_link( '%link', '<i class="fa fa-angle-left p-r-10"></i> %title' ); ?></div>
	    <div class="col-sm-6 col-md-6 nav-previous"><?php next_post_link( '%link', '%title <i class="fa fa-angle-right p-l-10"></i>' ); ?></div>
	</div>
	<div class="clearfix"></div> 
<?php } else { ?>
	<div class="navigation-links page-navigation clearfix">
	    <?php
	    if ( $dd_pagination_type == "number_pagination" ) {
		    ?>
		    <nav class="number-pagination">
			<?php dayneo_paginate_links(); ?>
		    </nav>
	    <?php } else { ?>
		    <div class="col-xs-6 col-md-6 nav-next"><?php previous_posts_link( __( '<i class="fa fa-angle-left p-r-10"></i> Newer Entries', 'dayneo' ) ); ?></div>
		    <div class="col-xs-6 col-md-6 nav-previous"><?php next_posts_link( __( 'Older Entries <i class="fa fa-angle-right p-l-10"></i>', 'dayneo' ) ); ?></div>
	    <?php } ?>
	</div>
	<div class="clearfix"></div> 
	<?php
}
