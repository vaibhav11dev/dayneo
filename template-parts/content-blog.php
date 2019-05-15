<?php
/**
 * Template part for displaying posts
 *
 *
 * @package bigbo
 */
// The Query
global $dd_options;
$temp			 = $wp_query;
$wp_query		 = new WP_Query();
$default_posts_per_page	 = get_option( 'posts_per_page', 6 );
$wp_query->query( "posts_per_page=$default_posts_per_page&paged=$paged" );

if ( $wp_query->have_posts() ) :
	if ( $dd_options[ 'dd_blog_style' ] == 'grid' ) {
		?>
				<div class="row multi-columns-row post-columns">
		    <?php
	    }
	    while ( $wp_query->have_posts() ) :
		    $wp_query->the_post();

		    $dd_post_layout	 = $dd_options[ 'dd_post_layout' ];
		    $post_layout_class	 = (int)12 / $dd_post_layout;

		    if ( $dd_options[ 'dd_blog_style' ] == 'grid' ) {
			    ?>
					<div class="col-sm-<?php echo esc_attr($post_layout_class); ?> col-md-<?php echo esc_attr($post_layout_class); ?> col-lg-<?php echo esc_attr($post_layout_class); ?>">
				<?php
			}
			?>
					<!--  BLOG CONTENT  -->
					<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo bigbo_post_format(); ?>">


			    <?php
			    if ( $dd_options[ 'dd_blog_style' ] == 'thumbnail_on_side' ) {
				    ?>
							    <div class="row">
								<div class="col-sm-5 img-col">
					    <?php
				    }

				    bigbo_post_thumbnail();

				    if ( $dd_options[ 'dd_blog_style' ] == 'thumbnail_on_side' ) {
					    ?>
								</div>
								<div class="col-sm-7 text-col">
					    <?php
				    }
				    ?>

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
					    <?php the_excerpt(); ?>
							</div>

							<div class="entry-meta entry-footer">
					    <?php bigbo_post_readmore(); ?>
							</div>

						    </div>
				    <?php
				    if ( $dd_options[ 'dd_blog_style' ] == 'thumbnail_on_side' ) {
					    ?>
								</div>
							    </div>
				    <?php
			    }
			    ?>
					</article>
					<!-- END BLOG CONTENT -->
			<?php
			if ( $dd_options[ 'dd_blog_style' ] == 'grid' ) {
				?>
						    </div>			
			    <?php
		    }
	    endwhile;
	    if ( $dd_options[ 'dd_blog_style' ] == 'grid' ) {
		    ?>
				</div>
		<?php
	}

	get_template_part( 'navigation', 'index' );

	$wp_query	 = null;
	$wp_query	 = $temp;
else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>