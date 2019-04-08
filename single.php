<?php
/**
 * The template for displaying all single posts
 *
 *
 * @package dayneo
 */
get_header();

$dd_similar_posts	 = dayneo_get_option( 'dd_similar_posts', 'disable' );
$dd_post_links		 = dayneo_get_option( 'dd_post_links', 'after' );
?>

<!-- SINGLE BLOG -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <!-- SECONDARY-2 -->	    
	    <?php
	    if ( dayneo_lets_get_sidebar_2() == true ):
		    get_sidebar( '2' );
	    endif;
	    ?>
	    <!-- END SECONDARY-2 -->

	    <!-- PRIMARY -->
	    <div id="primary" class="<?php dayneo_layout_class( $type = 1 ); ?> single-post">
		<?php
		while ( have_posts() ) :
			the_post();
		
			if ( ($dd_post_links == "") || ($dd_post_links == "before") || ($dd_post_links == "both") ) {
				get_template_part( 'navigation', 'index' );
			}

			get_template_part( 'template-parts/content' );

			if ( ($dd_post_links == "") || ($dd_post_links == "after") || ($dd_post_links == "both") ) {
				get_template_part( 'navigation', 'index' );
			}
			
			if ( comments_open() || get_comments_number() ) :
				comments_template( '', true );
			endif;

			if ( ($dd_similar_posts == "") || ($dd_similar_posts == "disable") ) {
				//Do Nothing
			} else {
				dayneo_similar_posts();
			}
			
		endwhile; // End of the loop.
		?>
	    </div>
	    <!-- END PRIMARY -->

	    <!-- SECONDARY-1 -->
	    <?php
	    if ( dayneo_lets_get_sidebar() == true ) {
		    get_sidebar();
	    }
	    ?>
	    <!-- END SECONDARY-1 -->

	</div><!-- .row -->
    </div>
</section>
<!-- END SINGLE BLOG -->

<?php
get_footer();

