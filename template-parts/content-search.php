<?php
/**
 * Template part for displaying results in search pages
 *
 *
 * @package dayneo
 */
?>

<div class="col-sm-4 col-md-4 col-lg-4">

    <article id="post-<?php esc_attr( the_ID() ); ?>" class="<?php esc_attr( semantic_entries() ); ?>">
        <?php dayneo_post_thumbnail(); ?>

        <div class="post-content">

            <div class="entry-meta entry-header">
                <?php dayneo_post_heading(); ?>
            </div>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>

            <div class="entry-meta entry-footer">
                <?php dayneo_post_readmore(); ?>
            </div>

        </div>
    </article>

</div>			

