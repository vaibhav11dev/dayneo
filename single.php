<?php
/**
 * The template for displaying all single posts
 *
 *
 * @package bigbo
 */
get_header();

$ved_similar_posts	 = bigbo_get_option( 'ved_similar_posts', 'disable' );
$ved_post_links		 = bigbo_get_option( 'ved_post_links', 'after' );
?>

<!-- SINGLE BLOG -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <!-- PRIMARY -->
	    <div id="primary" class="<?php bigbo_layout_class( $type = 1 ); ?> single-post">
		<?php
		while ( have_posts() ) :
			the_post();
		
			if ( ($ved_post_links == "") || ($ved_post_links == "before") || ($ved_post_links == "both") ) {
				get_template_part( 'navigation', 'index' );
			}

			get_template_part( 'template-parts/content' );

			if ( ($ved_post_links == "") || ($ved_post_links == "after") || ($ved_post_links == "both") ) {
				get_template_part( 'navigation', 'index' );
			}
			
			if ( comments_open() || get_comments_number() ) :
				comments_template( '', true );
			endif;

			if ( $ved_similar_posts != "disable" ) {
				bigbo_similar_posts();
			}
			
		endwhile; // End of the loop.
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
<!-- END SINGLE BLOG -->

<?php
get_footer();

