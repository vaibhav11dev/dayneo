<?php
// Single Portfolio
get_header();

global $dd_options;
?>

<!-- SINGLE PORTFOLIO -->
<section class="module p-tb-content">
	<div class="container">

		<?php
		if ( have_posts() ): the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="row">
					<div class="col-sm-12">

						<?php
						if ( has_post_thumbnail() && ( get_post_meta( $post->ID, 'daydream_po_featured_image', true ) == 'yes' || (get_post_meta( $post->ID, 'daydream_po_featured_image', true ) == 'default' && $dd_options[ 'dd_portfolio_featured_image' ]) ) ):
							$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							?>
							<a href="<?php echo esc_url($attachment_image[ 0 ]); ?>" class="lightbox">
								<img src="<?php echo esc_url($attachment_image[ 0 ]); ?>" alt="<?php echo esc_attr(get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true )); ?>" />
							</a>
							<?php
						endif;
						?>   

					</div>
				</div><!-- .row -->

				<div class="row m-t-50">

					<div class="col-sm-4">
						<ul class="portfolio-info">
							<?php
							if ( get_the_term_list( $post->ID, 'portfolio_category', '', ',&nbsp', '' ) ):
								?>
								<li class="project-info-cat">
									<h5><?php echo esc_html_e( 'Categories', 'daydream' ) ?>:</h5>
									<?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ',&nbsp', '' ); ?>
								</li>
								<?php
							endif;

							if ( get_the_term_list( $post->ID, 'portfolio_skills', '', ', ', '' ) ):
								?>          
								<li class="project-info-skill">
									<h5><?php echo esc_html_e( 'Skills', 'daydream' ) ?>:</h5>
									<?php echo get_the_term_list( $post->ID, 'portfolio_skills', '', ',&nbsp', '' ); ?>
								</li>
								<?php
							endif;

							if ( get_the_term_list( $post->ID, 'portfolio_tags', '', ',&nbsp', '' ) ):
								?>
								<li class="project-info-tag">
									<h5><?php echo esc_html_e( 'Tags', 'daydream' ) ?>:</h5>
									<?php echo get_the_term_list( $post->ID, 'portfolio_tags', '', ',&nbsp', '' ); ?>
								</li>
								<?php
							endif;

							if ( get_post_meta( $post->ID, 'daydream_project_url', true ) && get_post_meta( $post->ID, 'daydream_project_url_text', true ) ):
								?>
								<li class="project-info-tag">
									<h5><?php echo esc_html_e( 'Project URL', 'daydream' ) ?>:</h5>
									<a href="<?php echo esc_url(get_post_meta( $post->ID, 'daydream_project_url', true )); ?>"><?php echo get_post_meta( $post->ID, 'daydream_project_url_text', true ); ?></a>
								</li>
								<?php
							endif;

							if ( get_post_meta( $post->ID, 'daydream_copy_url', true ) && get_post_meta( $post->ID, 'daydream_copy_url_text', true ) ):
								?>
								<li class="project-info-tag">
									<h5><?php echo esc_html_e( 'Copyright', 'daydream' ) ?>:</h5>
									<a href="<?php echo esc_url(get_post_meta( $post->ID, 'daydream_copy_url', true )); ?>"><?php echo get_post_meta( $post->ID, 'daydream_copy_url_text', true ); ?></a>
								</li>
								<?php
							endif;

							$dd_portfolio_author = daydream_get_option( 'dd_portfolio_author', '0' );
							if ( get_post_meta( $post->ID, 'daydream_po_author', true ) == 'yes' ||
							( $dd_portfolio_author && get_post_meta( $post->ID, 'daydream_po_author', true ) == 'default' ) ):
								?>
								<li class="project-info-author">
									<h5><?php echo esc_html_e( 'By', 'daydream' ) ?>:</h5>
									<?php the_author_posts_link(); ?>
								</li>	
								<?php
							endif;
							$dd_portfolio_sharing = daydream_get_option( 'dd_portfolio_sharing', '1' );
							if ( get_post_meta( $post->ID, 'daydream_po_sharing', true ) == 'yes' ||
							( $dd_portfolio_sharing && get_post_meta( $post->ID, 'daydream_po_sharing', true ) == 'default' ) ):
								?>
								<li>
									<h5>Share:</h5>
									<?php daydream_portfolio_share(); ?>
								</li>
								<?php
							endif;
							?>
						</ul>
					</div>

					<!-- CONTENT -->
					<div class="col-sm-8">
						<?php the_content(); ?>
					</div>
					<!-- END CONTENT -->

				</div><!-- .row -->

			</div>
			<?php
		endif;
		?>


	</div>
</section>
<!-- END SINGLE PORTFOLIO -->

<?php
$paged		 = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
query_posts( $query_string . '&paged=' . $paged );
$nav_categories	 = '';
if ( isset( $_GET[ 'portfolioID' ] ) ) {
	$portfolioID = array( $_GET[ 'portfolioID' ] );
} else {
	$portfolioID = '';
}
if ( isset( $_GET[ 'categoryID' ] ) ) {
	$categoryID = $_GET[ 'categoryID' ];
} else {
	$categoryID = '';
}
$page_categories = get_post_meta( $portfolioID, 'daydream_portfolio_category', true );
if ( $page_categories && is_array( $page_categories ) && $page_categories[ 0 ] !== '0' ) {
	$nav_categories = implode( ',', $page_categories );
}
if ( $categoryID ) {
	$nav_categories = $categoryID;
}

// Portfolio Navigation 
$dd_portfolio_pagination = daydream_get_option( 'dd_portfolio_pagination', '1' );
if ( $dd_portfolio_pagination == 1 ):
	?>
	<!-- START PAGINATION -->
	<section class="module-xs divider-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<ul class="pager">
						<?php
						if ( $portfolioID || $categoryID ) {
							$previous_post_link = daydream_previous_post_link_plus( array( 'format' => '%link', 'link' => __( 'Previous', 'daydream' ), 'in_same_tax' => 'portfolio_category', 'in_cats' => $nav_categories, 'return' => 'href' ) );
						} else {
							$previous_post_link = daydream_previous_post_link_plus( array( 'format' => '%link', 'link' => __( 'Previous', 'daydream' ), 'return' => 'href' ) );
						}

						if ( $previous_post_link ):
							if ( $portfolioID || $categoryID ) {
								if ( $portfolioID ) {
									$previous_post_link = daydream_addURLParameter( $previous_post_link, 'portfolioID', $portfolioID );
								} else {
									$previous_post_link = daydream_addURLParameter( $previous_post_link, 'categoryID', $categoryID );
								}
							}
							?>
							<li class="previous">
								<a href="<?php echo esc_url($previous_post_link); ?>" class="prev" rel="prev"><i class="fa fa-angle-left"></i></a>
							</li>
							<?php
						endif;

						if ( $portfolioID || $categoryID ) {
							$next_post_link = daydream_next_post_link_plus( array( 'format' => '%link', 'link' => __( 'Next', 'daydream' ), 'in_same_tax' => 'portfolio_category', 'in_cats' => $nav_categories, 'return' => 'href' ) );
						} else {
							$next_post_link = daydream_next_post_link_plus( array( 'format' => '%link', 'link' => __( 'Next', 'daydream' ), 'return' => 'href' ) );
						}

						if ( $next_post_link ):
							if ( $portfolioID || $categoryID ) {
								if ( $portfolioID ) {
									$next_post_link = daydream_addURLParameter( $next_post_link, 'portfolioID', $portfolioID );
								} else {
									$next_post_link = daydream_addURLParameter( $next_post_link, 'categoryID', $categoryID );
								}
							}
							?>
							<li class="next">
								<a href="<?php echo esc_url($next_post_link); ?>" class="next" rel="next"><i class="fa fa-angle-right"></i></a>
							</li>
							<?php
						endif;
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- END PAGINATION -->

	<?php
endif;

// Portfolio Related Posts
$dd_portfolio_related_posts_number	 = '4';
$dd_portfolio_related_posts		 = daydream_get_option( 'dd_portfolio_related_posts', '1' );

if ( get_post_meta( $post->ID, 'daydream_po_related_posts', true ) == 'yes' ||
 ( $dd_portfolio_related_posts && get_post_meta( $post->ID, 'daydream_po_related_posts', true ) == 'default' ) ):

	$projects = daydream_portfolio_rel_pro( $post->ID, $dd_portfolio_related_posts_number );

	if ( $projects->have_posts() ):
		?>
		<!-- RECENT PROJECTS -->
		<section class="module p-0">
			<div class="works-grid-wrapper">

				<!-- WORKS GRID -->
				<div id="works-grid" class="works-grid works-grid-4">
					<?php
					while ( $projects->have_posts() ): $projects->the_post();

						if ( has_post_thumbnail() ):
							$icon_url_check = get_post_meta( get_the_ID(), 'daydream_link_icon_url', true );
							if ( ! empty( $icon_url_check ) ) {
								$icon_permalink = $icon_url_check;
							} else {
								$icon_permalink = get_permalink( $post->ID );
							}

							$link_target = '';
							if ( get_post_meta( get_the_ID(), 'daydream_link_icon_target', true ) == "yes" ) {
								$link_target = ' target="_blank"';
							}

							$item_classes	 = '';
							$item_cats	 = get_the_terms( $post->ID, 'portfolio_category' );
							if ( $item_cats ):
								foreach ( $item_cats as $item_cat ) {
									$item_classes .= urldecode( $item_cat->slug ) . ' ';
								}
							endif;
							?>
							<!-- PORTFOLIO ITEM -->
							<article class="work-item <?php echo esc_attr($item_classes); ?>">
								<div class="work-wrapper">
									<?php the_post_thumbnail( 'full' ); ?>
									<div class="work-overlay">
										<div class="work-caption">
											<h6 class="work-title"><?php the_title(); ?></h6>
											<span class="work-category"><?php echo esc_attr($item_classes); ?></span>
										</div>
									</div>
                                                                    <a href="<?php echo esc_url($icon_permalink); ?>" <?php echo esc_attr($link_target); ?> class="work-link"></a>
								</div>
							</article>
							<!-- END PORTFOLIO ITEM -->
							<?php
						endif;
					endwhile;
					?>
				</div>
				<!-- END WORKS GRID -->

			</div>
		</section>
		<!-- END RECENT PROJECTS -->
		<?php
	endif;

endif;

get_footer();

