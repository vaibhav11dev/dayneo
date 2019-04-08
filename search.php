<?php
/**
 * The template for displaying search results pages
 *
 *
 * @package dayneo
 */
get_header();
?>

<!-- SEARCH -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <!-- PRIMARY -->
	    <div id="primary" class="page-search">

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	    </div>
	    <!-- END PRIMARY -->

	</div><!-- .row -->
    </div>
</section>
<!-- END SEARCH -->
<?php
get_footer();
