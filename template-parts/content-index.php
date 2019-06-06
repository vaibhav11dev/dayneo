<?php
/**
 * Template part for displaying posts
 *
 *
 * @package bigbo
 */
global $ved_options;

if ( have_posts() ) :
	if ( $ved_options[ 'ved_blog_style' ] == 'grid' ) {
		?>
		<div class="row multi-columns-row post-columns">
		    <?php
	    }
	    while ( have_posts() ) : the_post();

		    $ved_post_layout	 = $ved_options[ 'ved_post_layout' ];
		    $post_layout_class	 = (int)12 / $ved_post_layout;

		    if ( $ved_options[ 'ved_blog_style' ] == 'grid' ) {
			    ?>
			    <div class="col-sm-<?php echo esc_attr($post_layout_class); ?> col-md-<?php echo esc_attr($post_layout_class); ?> col-lg-<?php echo esc_attr($post_layout_class); ?>">
				<?php
			}
			?>
			<!--  BLOG CONTENT  -->
			<article id="post-<?php the_ID(); ?>" class="<?php esc_attr(semantic_entries()); ?> post format-<?php echo bigbo_post_format(); ?>">

			    <?php
			    if ( $ved_options[ 'ved_blog_style' ] == 'thumbnail_on_side' ) {
				    ?>
				    <div class="row">
					<div class="col-sm-5 img-col">
					    <?php
				    }
				    bigbo_post_thumbnail();
				    if ( $ved_options[ 'ved_blog_style' ] == 'thumbnail_on_side' ) {
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
					    <?php the_excerpt(); ?>
					</div>

					<div class="entry-meta entry-footer">
					    <?php bigbo_post_readmore(); ?>
					</div>

				    </div>
				    <?php
				    if ( $ved_options[ 'ved_blog_style' ] == 'thumbnail_on_side' ) {
					    ?>
					</div>
				    </div>
				    <?php
			    }
			    ?>
			</article>
			<!-- END BLOG CONTENT -->
			<?php
			if ( $ved_options[ 'ved_blog_style' ] == 'grid' ) {
				?>
			    </div>			
			    <?php
		    }
	    endwhile;
	    if ( $ved_options[ 'ved_blog_style' ] == 'grid' ) {
		    ?>
		</div>
		<?php
	}

	get_template_part( 'navigation', 'index' );

	/* Restore original Post Data */
	wp_reset_postdata();
else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>