<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package daydream
 */
$dd_pagetitlebar_layout		 = daydream_get_option( 'dd_pagetitlebar_layout', 1 );
$daydream_enable_page_title	 = get_post_meta( get_the_ID(), 'daydream_enable_page_title', true );
$dd_edit_post			 = daydream_get_option( 'dd_edit_post', '0' );
?>

<div id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?>">
	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="thumbnail-post">';
		the_post_thumbnail( 'post-thumbnail' );
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
			if ( $dd_edit_post == "1" && get_edit_post_link() ) :
				?>
				<div class="col-sm-6">
					<?php
					edit_post_link(
					sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'daydream' ), array(
						'span' => array(
							'class' => array(),
						),
					)
					), get_the_title()
					), '<span class="edit-link">', '</span>'
					);
					?>
				</div>
				<?php
			endif;
			?>

			<?php
			$dd_share_this = daydream_get_option( 'dd_share_this', 'single' );
			if ( $dd_share_this == 'all' || $dd_share_this == 'page' ) {
				?>
				<div class="col-sm-6">
					<?php
					daydream_sharethis();
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
