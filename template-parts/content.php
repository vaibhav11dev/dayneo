<?php
/**
 * Template part for displaying posts
 *
 *
 * @package daydream
 */
global $dd_options;
?>

<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo daydream_post_format(); ?>">

	<?php daydream_post_thumbnail() ?>

	<div class="post-content">
		<div class="entry-meta entry-header">
			<?php
			daydream_post_heading();

			if ( $dd_options[ 'dd_header_meta' ] == 1 ) {
				?>
				<ul class="post-meta">
					<?php daydream_post_metadata(); ?> 
				</ul>
				<?php
			}
			?>
		</div>

		<div class="entry-content">
			<?php
			the_content( __( 'Read More &raquo;', 'daydream' ) );

			wp_link_pages( array( 'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'daydream' ), 'after' => '</p></div>' ) );
			?>	
		</div>
	</div>

	<div class="tags entry-meta entry-footer">
		<div class="row">

			<?php
			if ( daydream_get_terms( 'cats' ) ) {
				?>
				<div class="col-sm-6">
					<div class="entry-categories"> <?php echo daydream_get_terms( 'cats', ' ' ); ?></div>
				</div>
				<?php
			}
			?>							



			<?php
			$dd_share_this = daydream_get_option( 'dd_share_this', 'single' );
			if ( ($dd_share_this == "") || ($dd_share_this == "single") || ($dd_share_this == "all") ) {
				?>
				<div class="col-sm-6">
					<?php
					daydream_sharethis();
					?>
				</div>
				<?php
			} else {
				?> 
				<div class="col-sm-6">
					<div class="m-b-40"></div> 
				</div>
			<?php } ?>

		</div>
	</div>

</article>
