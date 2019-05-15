<?php
/*
 *
 * Template Name: Blog
 *
 */

get_header();

global $dd_options;
?>

<!-- BLOG-CLASSIC -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <!-- SECONDARY-2 -->	    
	    <?php
	    if ( bigbo_lets_get_sidebar_2() == true ):
		    get_sidebar( '2' );
	    endif;
	    ?>
	    <!-- END SECONDARY-2 -->

	    <?php
	    $thumbnail = '';
	    if ( $dd_options[ 'dd_blog_style' ] == 'thumbnail_on_side' ) {
		    $thumbnail = ' post-thumbnail ';
	    }
	    ?>
	    <!-- PRIMARY -->
	    <div id="primary" class="<?php bigbo_layout_class( $type = 1 );
	    echo esc_attr($thumbnail);
	    ?> post-content">
		<?php
		get_template_part( 'template-parts/content', 'blog' );

		/* Restore original Post Data */
		wp_reset_postdata();
		?>
	    </div>
	    <!-- END PRIMARY -->

	    <!-- SECONDARY-1 -->
	    <?php
	    if ( bigbo_lets_get_sidebar() == true ) {
		    get_sidebar();
	    }
	    ?>
	    <!-- END SECONDARY-1 -->

	</div><!-- .row -->
    </div>
</section>
<!-- END BLOG-CLASSIC -->

<?php
get_footer();
