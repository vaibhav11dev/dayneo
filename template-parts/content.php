<?php
/**
 * Template part for displaying posts
 *
 *
 * @package bigbo
 */
global $dd_options;
?>

<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo bigbo_post_format(); ?>">

	<?php bigbo_post_thumbnail() ?>

	<div class="post-content">
		<div class="entry-meta entry-header">
			<?php
			bigbo_post_heading();

			if ( $dd_options[ 'dd_header_meta' ] == 1 ) {
				?>
				<ul class="post-meta">
					<?php bigbo_post_metadata(); ?> 
				</ul>
				<?php
			}
			?>
		</div>

		<div class="entry-content">
			<?php
			the_content( __( 'Read More &raquo;', 'bigbo' ) );

			wp_link_pages( array( 'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'bigbo' ), 'after' => '</p></div>' ) );
			?>	
		</div>
    	<div class="clearfix"></div>

	    <div class="tags entry-meta entry-footer">				

				<?php
				$dd_share_this = bigbo_get_option( 'dd_share_this', 'single' );
				if ( ($dd_share_this == "") || ($dd_share_this == "single") || ($dd_share_this == "all") ) {
					?>
					<div class="share-wrap">
						<?php
						bigbo_sharethis();
						?>
					</div>
					<?php
				} else {
					?> 
					<div class="share-wrap">
						<div class="m-b-40"></div> 
					</div>
				<?php } ?>

		</div>

	</div>

</article>
