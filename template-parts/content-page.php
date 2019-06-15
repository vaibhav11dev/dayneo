<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bigbo
 */
$ved_pagetitlebar_layout		 = bigbo_get_option( 'ved_pagetitlebar_layout', 1 );
$ved_edit_post			 = bigbo_get_option( 'ved_edit_post', '0' );
?>

<div id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?>">
	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="thumbnail-post">';
		the_post_thumbnail();
		echo '</div>';
	}
	?>

	<!--BEGIN .entry-content .article-->
	<div class="entry-content article">

		<?php
		the_content();
		wp_link_pages();
		?>

	</div><!--END .entry-content .article-->

	<div class="tags entry-meta entry-footer">
		<div class="row">
			<?php
			if ( $ved_edit_post == "1" && get_edit_post_link() ) :
				?>
				<div class="col-sm-6">
					<?php
					edit_post_link(sprintf('%s <span class="screen-reader-text">%s</span>', esc_html__( 'Edit', 'bigbo' ), get_the_title()), '<span class="edit-link">', '</span>');
					?>
				</div>
				<?php
			endif;
			?>

			<?php
			$ved_share_this = bigbo_get_option( 'ved_share_this', 'single' );
			$ved_tooltip_position = bigbo_get_option( 'ved_sharing_box_tooltip_position', 'none' );
			$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );

			if ( ($ved_share_this == 'all' || $ved_share_this == 'page') && function_exists( 'vedanta_share_link_socials' ) ) {
				?>
				<div class="col-sm-6">
					<?php
					vedanta_share_link_socials( $ved_tooltip_position, get_the_title(), get_the_permalink(), $image );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
