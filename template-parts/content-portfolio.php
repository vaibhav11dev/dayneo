<?php
/**
 * Template part for displaying posts
 *
 *
 * @package dayneo
 */
// The Query
global $paged, $dd_options;
$dd_portfolio_no_item_per_page	 = dayneo_get_option( 'dd_portfolio_no_item_per_page', '10' );
$args				 = array(
    'post_type'	 => 'dayneo_portfolio',
    'paged'		 => $paged,
    'posts_per_page' => $dd_portfolio_no_item_per_page,
);
$pcats				 = get_post_meta( get_the_ID(), 'dayneo_portfolio_category', true );
if ( $pcats && $pcats[ 0 ] == 0 ) {
	unset( $pcats[ 0 ] );
}
if ( $pcats ) {
	$args[ 'tax_query' ][] = array(
	    'taxonomy'	 => 'portfolio_category',
	    'field'		 => 'term_id',
	    'terms'		 => $pcats
	);
}
$portfolio = new WP_Query( $args );


if ( ! post_password_required( $portfolio->ID ) ):

	$all_terms = get_terms( 'portfolio_category' );
	if ( is_array( $all_terms ) && ! empty( $all_terms ) && get_post_meta( $post->ID, 'dayneo_portfolio_filters', true ) != 'no' ):
		?>
		<!-- PORTFOLIO FILTERS -->
		<div class="row">
		    <div class="col-sm-12">
			<ul id="filters" class="portfolio-tabs filters">
			    <li><a href="#" class="current" data-filter="*"><?php echo esc_html_e( 'All', 'dayneo' ); ?></a></li>
			    <?php foreach ( $all_terms as $term ): ?>
                            <li><a data-filter=".<?php echo esc_attr($term->slug); ?>" href="#"><?php echo esc_html($term->name); ?></a></li>
			    <?php endforeach; ?>
			</ul>
		    </div>
		</div>
		<!-- END PORTFOLIO FILTERS -->
	<?php endif; ?>

	<div class="works-grid-wrapper">

	    <?php
	    $portfolio_style = '';
	    if ( $dd_options[ 'dd_portfolio_style' ] == 'grid' ) {
		    $portfolio_style = 'works-grid-gutter';
	    }
	    if ( $dd_options[ 'dd_portfolio_layout' ] == '3' || $dd_options[ 'dd_portfolio_layout' ] == '4' ) {
		    $portfolio_style .= ' works-grid-'.$dd_options[ 'dd_portfolio_layout' ];
	    }
	    ?>

	    <!-- WORKS GRID -->
	    <div id="works-grid" class="works-grid <?php echo esc_attr($portfolio_style); ?>">
		<?php
		if ( $portfolio->have_posts() ) :
			while ( $portfolio->have_posts() ): $portfolio->the_post();

				if ( has_post_thumbnail() ) {
                                        $icon_url_check = get_post_meta( $post->ID, 'dayneo_link_icon_url', true );
                                        if ( ! empty( $icon_url_check ) ) {
                                            $permalink = $icon_url_check;
                                        } else {
                                            $permalink = get_permalink( $post->ID );
                                        }
                                        
                                        $link_target = '';
                                        if ( get_post_meta( $post->ID, 'dayneo_link_icon_target', true ) == "yes" ) {
                                            $link_target = ' target=_blank';
                                        }

					$item_classes	 = '';
					$item_cats	 = get_the_terms( $portfolio->ID, 'portfolio_category' );
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
						<a href="<?php echo esc_url($permalink); ?>" <?php echo esc_attr($link_target); ?> class="work-link"></a>
					    </div>
					</article>
					<!-- END PORTFOLIO ITEM -->
					<?php
				}

			endwhile;

			/* Restore original Post Data */
			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	    </div>
	    <!-- END WORKS GRID -->

	</div>
		
	<?php

	dayneo_portfolio_pagination( $portfolio->max_num_pages, $range = 2 );

endif;