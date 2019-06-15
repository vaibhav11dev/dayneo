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

			wp_link_pages( array( 'before' => '<div id="page-links"><p>' . sprintf( '<strong>%s</strong>', esc_html__( 'Pages:', 'bigbo' ) ), 'after' => '</p></div>' ) );
			?>	
		</div>
    	<div class="clearfix"></div>

	    <div class="tags entry-meta entry-footer">				

				<?php
				$ved_share_this = bigbo_get_option( 'ved_share_this', 'single' );
				$ved_tooltip_position = bigbo_get_option( 'ved_sharing_box_tooltip_position', 'none' );
				$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );

				if ( ($ved_share_this == 'all' || $ved_share_this == 'single') && function_exists( 'vedanta_share_link_socials' ) ) {
					?>
					<div class="share-wrap">
						<?php
						vedanta_share_link_socials( $ved_tooltip_position, get_the_title(), get_the_permalink(), $image );
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
