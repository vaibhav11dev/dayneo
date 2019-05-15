<?php
/**
 * Template part for displaying posts
 *
 *
 * @package dayneo
 */
// The Query
global $dd_options;
$dd_portfolio_no_item_per_page	 = dayneo_get_option( 'dd_portfolio_no_item_per_page', '10' );

if ( category_description() ):
	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	    <div class="post-content">
		<?php echo category_description(); ?>
	    </div>
	</div>
<?php endif; ?>

<div class="works-grid-wrapper">

    <?php
    $portfolio_style = '';
    if ( $dd_options[ 'dd_portfolio_style' ] == 'grid' ) {
	    $portfolio_style = 'works-grid-gutter';
    }
    if ( $dd_options[ 'dd_portfolio_layout' ] == '3' || $dd_options[ 'dd_portfolio_layout' ] == '4' ) {
	    $portfolio_style .= ' works-grid-' . $dd_options[ 'dd_portfolio_layout' ];
    }
    ?>

    <!-- WORKS GRID -->
    <div id="works-grid" class="works-grid <?php echo esc_attr($portfolio_style); ?>">
	<?php
	if ( have_posts() ) :

		while ( have_posts() ): the_post();

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
					<a href="<?php echo esc_url($permalink); ?>" <?php echo esc_attr( $link_target ); ?> class="work-link"></a>
				    </div>
				</article>
				<!-- END PORTFOLIO ITEM -->
				<?php
			}

		endwhile;
	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
    </div>
    <!-- END WORKS GRID -->
</div>

<?php

dayneo_portfolio_pagination();

/* Restore original Post Data */
wp_reset_postdata();
