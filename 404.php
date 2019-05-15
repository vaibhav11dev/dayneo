<?php
/**
 * The template for displaying 404 pages (not found)
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
	    <div id="primary" class="page-404">

		<div class="col-sm-12">
		    <div class="text-super-xl text-700 color-brand text-center"><?php esc_html_e( '404', 'bigbo' ); ?></div>
		</div>

		<div class="col-sm-8 col-sm-offset-2 text-center">
		    <h1 class="page-title"><?php esc_html_e( 'Whoops looks like we lost one!', 'bigbo' ); ?></h1>
		    <p class="lead"><?php esc_html_e( 'The page you are looking for was moved, removed, renamed or might never existed.', 'bigbo' ); ?></p>
            <?php get_search_form(); ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-lg btn-base"><?php esc_html_e( 'Back Home ', 'bigbo' ); ?> <i class="fa fa-angle-right"></i></a>
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

