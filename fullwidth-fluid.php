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
			if ( $ved_share_this == 'all' || $ved_share_this == 'page' ) {
				bigbo_sharethis();
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
