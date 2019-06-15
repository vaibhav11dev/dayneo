<?php
/*
 * 
 * Template Name: Fullwidth - Fluid
 *
 */

get_header();
?>

<!-- PAGE -->
<section class="module p-tb-content">
    <div class="container-fluid">
	<div class="row">

	    <!-- PRIMARY -->
	    <div id="primary" class="page-100-width col-sm-12">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			$ved_share_this = bigbo_get_option( 'ved_share_this', 'single' );
			$ved_tooltip_position = bigbo_get_option( 'ved_sharing_box_tooltip_position', 'none' );
			$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );

			if ( ($ved_share_this == 'all' || $ved_share_this == 'page') && function_exists( 'vedanta_share_link_socials' ) ) {
				vedanta_share_link_socials( $ved_tooltip_position, get_the_title(), get_the_permalink(), $image );
			}

			//hide from static homepage, allowed in all normal pages. 
			if ( ! is_front_page() ) {
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template('', true);
				endif;
			}


		endwhile; // End of the loop.
		?>
	    </div>
	    <!-- END PRIMARY -->

	</div><!-- .row -->
    </div>
</section>
<!-- END PAGE -->

<?php
get_footer();
