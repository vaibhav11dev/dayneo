<?php
/**
 * The template for displaying 404 pages (not found)
 *
 *
 * @package dayneo
 */

get_header();
?>

<!-- PAGE -->
<section class="module p-tb-content">
    <div class="container">
	<div class="row">

	    <!-- PRIMARY -->
	    <div id="primary" class="page-404">

		<div class="col-sm-12">
		    <div class="text-super-xl text-700 color-brand text-center"><?php esc_html_e( 'Oops!', 'dayneo' ); ?></div>
		</div>

		<div class="col-sm-8 col-sm-offset-2 text-center">
		    <h1 class="page-title"><?php esc_html_e( 'Sorry for the inconvenience.', 'dayneo' ); ?></h1>
		    <p class="lead"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'dayneo' ); ?></p>
            <?php get_search_form(); ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-lg btn-base"><?php esc_html_e( 'Back Home ', 'dayneo' ); ?> <i class="fa fa-angle-right"></i></a>
		</div>
		<div class="clearfix"></div>

	    </div>
	    <!-- END PRIMARY -->

	</div><!-- .row -->
    </div>
</section>
<!-- END PAGE -->

<?php
get_footer();

