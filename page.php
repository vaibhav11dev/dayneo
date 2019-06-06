<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 *
 * @package bigbo
 */
get_header();
?>

<!-- PAGE -->
<section class="module p-tb-content">
	<div class="container">
		<div class="row">

			<!-- PRIMARY -->
			<div id="primary" class="<?php bigbo_layout_class( $type = 1 ); ?> page-content">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						//hide from static homepage, allowed in all normal pages. 
						if ( ! is_front_page() ) {
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template( '', true );
							endif;
						}
					endwhile; // End of the loop.
				endif;
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
<!-- END PAGE -->

<?php
get_footer();
