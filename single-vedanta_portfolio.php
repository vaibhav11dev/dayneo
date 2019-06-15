<?php
// Single Portfolio
get_header();

global $ved_options;
?>

<!-- SINGLE PORTFOLIO -->
<section class="module p-tb-content">
    <div class="container">

        <?php
        if ( have_posts() ): the_post();
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="row">
                    <div class="col-md-8">

                        <?php
                        if ( has_post_thumbnail() && ( get_post_meta( $post->ID, 'bigbo_po_featured_image', true ) == 'yes' || (get_post_meta( $post->ID, 'bigbo_po_featured_image', true ) == 'default' && $ved_options[ 'ved_portfolio_featured_image' ]) ) ):
                            $attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                            ?>
                            <a href="<?php echo esc_url( $attachment_image[ 0 ] ); ?>" class="lightbox">
                                <img src="<?php echo esc_url( $attachment_image[ 0 ] ); ?>" alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>" />
                            </a>
                            <?php
                        endif;
                        ?>   

                        <div class="portfolio-content"><?php the_content(); ?></div>

                    </div>
                    <div class="col-md-4">
                        <ul class="portfolio-info">
                            <?php
                            if ( get_the_term_list( $post->ID, 'portfolio_category', '', ',&nbsp', '' ) ):
                                ?>
                                <li class="project-info-cat">
                                    <h5><?php echo esc_html_e( 'Categories', 'bigbo' ) ?>:</h5>
                                    <?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ',&nbsp', '' ); ?>
                                </li>
                                <?php
                            endif;

                            if ( get_the_term_list( $post->ID, 'portfolio_skills', '', ', ', '' ) ):
                                ?>          
                                <li class="project-info-skill">
                                    <h5><?php echo esc_html_e( 'Skills', 'bigbo' ) ?>:</h5>
                                    <?php echo get_the_term_list( $post->ID, 'portfolio_skills', '', ',&nbsp', '' ); ?>
                                </li>
                                <?php
                            endif;

                            if ( get_the_term_list( $post->ID, 'portfolio_tags', '', ',&nbsp', '' ) ):
                                ?>
                                <li class="project-info-tag">
                                    <h5><?php echo esc_html_e( 'Tags', 'bigbo' ) ?>:</h5>
                                    <?php echo get_the_term_list( $post->ID, 'portfolio_tags', '', ',&nbsp', '' ); ?>
                                </li>
                                <?php
                            endif;

                            if ( get_post_meta( $post->ID, 'bigbo_project_url', true ) && get_post_meta( $post->ID, 'bigbo_project_url_text', true ) ):
                                ?>
                                <li class="project-info-tag">
                                    <h5><?php echo esc_html_e( 'Project URL', 'bigbo' ) ?>:</h5>
                                    <a href="<?php echo esc_url( get_post_meta( $post->ID, 'bigbo_project_url', true ) ); ?>"><?php echo get_post_meta( $post->ID, 'bigbo_project_url_text', true ); ?></a>
                                </li>
                                <?php
                            endif;

                            if ( get_post_meta( $post->ID, 'bigbo_copy_url', true ) && get_post_meta( $post->ID, 'bigbo_copy_url_text', true ) ):
                                ?>
                                <li class="project-info-tag">
                                    <h5><?php echo esc_html_e( 'Copyright', 'bigbo' ) ?>:</h5>
                                    <a href="<?php echo esc_url( get_post_meta( $post->ID, 'bigbo_copy_url', true ) ); ?>"><?php echo get_post_meta( $post->ID, 'bigbo_copy_url_text', true ); ?></a>
                                </li>
                                <?php
                            endif;

                            $ved_portfolio_author = bigbo_get_option( 'ved_portfolio_author', '0' );
                            if ( get_post_meta( $post->ID, 'bigbo_po_author', true ) == 'yes' ||
                            ( $ved_portfolio_author && get_post_meta( $post->ID, 'bigbo_po_author', true ) == 'default' ) ):
                                ?>
                                <li class="project-info-author">
                                    <h5><?php echo esc_html_e( 'By', 'bigbo' ) ?>:</h5>
                                    <?php the_author_posts_link(); ?>
                                </li>	
                                <?php
                            endif;
                            $ved_portfolio_sharing = bigbo_get_option( 'ved_portfolio_sharing', '1' );
                            if ( get_post_meta( $post->ID, 'bigbo_po_sharing', true ) == 'yes' ||
                            ( $ved_portfolio_sharing && get_post_meta( $post->ID, 'bigbo_po_sharing', true ) == 'default' ) ):
                                ?>
                                <li>
                                    <h5><?php esc_html_e('Share:', 'bigbo') ?></h5>
                                    <?php
										$ved_tooltip_position = bigbo_get_option( 'ved_sharing_box_tooltip_position', 'none' );
										$image = get_the_post_thumbnail_url( get_the_ID(), 'full' );

										if ( function_exists( 'vedanta_share_link_socials' ) ) {
											vedanta_share_link_socials( $ved_tooltip_position, get_the_title(), get_the_permalink(), $image );
										}
									?>
                                </li>
                                <?php
                            endif;
                            ?>
                        </ul>
                    </div>
                </div><!-- .row -->

            </div>
            <?php
        endif;
        ?>


    </div>
</section>
<!-- END SINGLE PORTFOLIO -->

<?php
$nav_categories = '';
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
$page_categories = get_post_meta( $portfolioID, 'vedanta_portfolio_category', true );
if ( $page_categories && is_array( $page_categories ) && $page_categories[ 0 ] !== '0' ) {
    $nav_categories = implode( ',', $page_categories );
}
if ( $categoryID ) {
    $nav_categories = $categoryID;
}

// Portfolio Navigation 
$ved_portfolio_pagination = bigbo_get_option( 'ved_portfolio_pagination', '1' );
if ( $ved_portfolio_pagination == 1 ):
    ?>
    <!-- START PAGINATION -->
    <section class="module-xs divider-top portfolio-pagination">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="pager">
                        <li class="previous">
                            <?php previous_post_link( '%link', '<i class="fa fa-angle-left p-r-10"></i> %title' ); ?>
                        </li>
                        <li class="next">
                            <?php next_post_link( '%link', '%title <i class="fa fa-angle-right p-l-10"></i>' ); ?>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- END PAGINATION -->

    <?php
endif;

// Portfolio Related Posts
$ved_portfolio_related_posts_number = '4';
$ved_portfolio_related_posts        = bigbo_get_option( 'ved_portfolio_related_posts', '1' );

if ( get_post_meta( $post->ID, 'bigbo_po_related_posts', true ) == 'yes' ||
 ( $ved_portfolio_related_posts && get_post_meta( $post->ID, 'bigbo_po_related_posts', true ) == 'default' ) ):

    $projects = vedanta_portfolio_rel_pro( $post->ID, $ved_portfolio_related_posts_number );

    if ( $projects->have_posts() ):
        ?>
        <!-- RECENT PROJECTS -->
        <section class="module divider-top portfolio-related">
            <div class="container">
                <div class="works-grid-wrapper">

                    <!-- WORKS GRID -->
                    <div class="sec-head-style"><h3 class="text-title text-uppercase page-heading">Similar Portfolio</h3></div>
                    <div id="works-grid" class="works-grid works-grid-4 works-grid-gutter">
                        <?php
                        while ( $projects->have_posts() ): $projects->the_post();

                            if ( has_post_thumbnail() ):
                                $icon_url_check = get_post_meta( $post->ID, 'bigbo_link_icon_url', true );
                                if ( ! empty( $icon_url_check ) ) {
                                    $icon_permalink = $icon_url_check;
                                } else {
                                    $icon_permalink = get_permalink( $post->ID );
                                }

                                $link_target = '';
                                if ( get_post_meta( $post->ID, 'bigbo_link_icon_target', true ) == "yes" ) {
                                    $link_target = ' target=_blank';
                                }

                                $item_classes = '';
                                $item_cats    = get_the_terms( $post->ID, 'portfolio_category' );
                                if ( $item_cats ):
                                    foreach ( $item_cats as $item_cat ) {
                                        $item_classes .= urldecode( $item_cat->slug ) . ' ';
                                    }
                                endif;
                                ?>
                                <!-- PORTFOLIO ITEM -->
                                <article class="work-item <?php echo esc_attr( $item_classes ); ?>">
                                    <div class="work-wrapper">
                                        <?php the_post_thumbnail( 'full' ); ?>
                                        <div class="work-overlay">
                                            <div class="work-caption">
                                                <h6 class="work-title"><?php the_title(); ?></h6>
                                                <span class="work-category"><?php echo esc_attr( $item_classes ); ?></span>
                                            </div>
                                        </div>
                                        <a href="<?php echo esc_url( $icon_permalink ); ?>" <?php echo esc_attr( $link_target ); ?> class="work-link"></a>
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
            </div>
        </section>
        <!-- END RECENT PROJECTS -->
        <?php
    endif;

endif;

get_footer();

