<?php
/**
 * Template part for displaying posts
 *
 *
 * @package bigbo
 */
global $ved_options;
?>

<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo bigbo_post_format(); ?>">

	<?php bigbo_post_thumbnail() ?>

	<div class="post-content">
		<div class="entry-meta entry-header">
			<?php
			bigbo_post_heading();

			if ( $ved_options[ 'ved_header_meta' ] == 1 ) {
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
			the_content( esc_html__( 'Read More &raquo;', 'bigbo' ) );

			wp_link_pages( array( 'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'bigbo' ), 'after' => '</p></div>' ) );
			?>	
		</div>
    	<div class="clearfix"></div>

	    <div class="tags entry-meta entry-footer">				

				<?php
				$ved_share_this = bigbo_get_option( 'ved_share_this', 'single' );
				if ( ($ved_share_this == "") || ($ved_share_this == "single") || ($ved_share_this == "all") ) {
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
