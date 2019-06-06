<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 *
 * @package bigbo
 */

get_header();
global $ved_options;
?>

<!-- BLOG-CLASSIC -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <?php
	    $thumbnail = '';
	    if ( $ved_options[ 'ved_blog_style' ] == 'thumbnail_on_side' ) {
		    $thumbnail = ' post-thumbnail';
	    }
	    ?>
	    <!-- PRIMARY -->
            <div id="primary" class="<?php bigbo_layout_class( $type = 1 );
	    echo esc_attr($thumbnail);
	    ?> post-content">
		<?php get_template_part( 'template-parts/content', 'index' ); ?>
	    </div>
	    <!-- END PRIMARY -->

	    <!-- SECONDARY-1 -->
	    <?php
	    if ( bigbo_lets_get_sidebar() == true ) {
		    get_sidebar();
	    }
	    ?>
	    <!-- END SECONDARY-1 -->

	    <!-- SECONDARY-2 -->	    
	    <?php
	    if ( bigbo_lets_get_sidebar_2() == true ):
		    get_sidebar( '2' );
	    endif;
	    ?>
	    <!-- END SECONDARY-2 -->

	</div><!-- .row -->
    </div>
</section>
<!-- END BLOG-CLASSIC -->

<?php
get_footer();
