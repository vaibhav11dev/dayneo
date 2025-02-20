<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bigbo
 */
if ( ! function_exists( 'bigbo_posted_on' ) ) :

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function bigbo_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( DATE_W3C ) ), esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x( 'Posted on %s', 'post date', 'bigbo' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }

endif;

if ( ! function_exists( 'bigbo_posted_by' ) ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function bigbo_posted_by() {
        $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( 'by %s', 'post author', 'bigbo' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }

endif;

if ( ! function_exists( 'bigbo_entry_footer' ) ) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function bigbo_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'bigbo' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'bigbo' ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'bigbo' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'bigbo' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( sprintf( '%s <span class="screen-reader-text"> on %s</span>', esc_html__( 'Leave a Comment', 'bigbo' ), get_the_title() ) );
            echo '</span>';
        }

        edit_post_link( sprintf( '%s <span class="screen-reader-text">%s</span>', esc_html__( 'Edit', 'bigbo' ), get_the_title() ), '<span class="edit-link">', '</span>');
    }

endif;

if ( ! function_exists( 'bigbo_post_thumbnail' ) ) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function bigbo_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) {
            $ved_blog_featured_image = bigbo_get_option( 'ved_blog_featured_image', '1' );
            if ( $ved_blog_featured_image == "1" ) {
                ?>
                <div class="post-preview">
                    <div class="post-thumbnail">
                        <?php
                        the_post_thumbnail( 'full', array(
                            'alt' => the_title_attribute( array(
                                'echo' => false,
                            ) ),
                        ) );
                        ?>
                    </div><!-- .post-thumbnail -->
                </div>
                <?php
            }
        } else {
            $ved_featured_images = bigbo_get_option( 'ved_featured_images', '1' );
            $ved_blog_style = bigbo_get_option( 'ved_blog_style' );
            if ( $ved_featured_images == "1" ) {
                ?>
                <div class="post_thumbnail">
                    <div class="post-preview">
                        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                            <?php
                            the_post_thumbnail( 'full', array(
                                'alt' => the_title_attribute( array(
                                    'echo' => false,
                                ) ),
                            ) );
                            ?>
                        </a>
                    </div>                   
                </div>

                <?php
            }
        } // End is_singular().
    }

endif;


/* bigbo excerpt max length */

function bigbo_excerpt_max_charlength( $limit ) {
    $excerpt = substr( get_the_content(), 0, $limit ) . " [...]";
    echo wp_kses_post( $excerpt );
}

/* bigbo read more button */

function bigbo_post_readmore() {
    ?>
    <a href="<?php the_permalink() ?>" class="read-more"><?php esc_html_e( 'Read more ', 'bigbo' ) ?><i class="fa fa-angle-right"></i></a>
    <?php
}

/* bigbo post heading */

function bigbo_post_heading() {
    if ( is_singular() ) :
        the_title( '<h1 class="post-title">', '</h1>' );
    else :
        the_title( '<h2 class="post-title">' . bigbo_post_format_icon() . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
}

function bigbo_post_format_icon() {
    if ( bigbo_post_format() ) {
        return '<i class="format-icon icon-' . bigbo_post_format() . '"></i>';
    }
}

/* bigbo post metadata */

function bigbo_post_metadata() {
    global $authordata, $ved_options;

    if ( $ved_options[ 'ved_meta_author' ] == 1 ) {
        ?>
        <li class="author vcard">
            <?php
            esc_html_e( 'Posted by ', 'bigbo' );

            $ved_author_avatar = bigbo_get_option( 'ved_author_avatar', '0' );
            if ( $ved_author_avatar == "1" ) {
                echo get_avatar( get_the_author_meta( 'email' ), '30' );
            }

            printf( '<a class="url fn" href="' . esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ) . '" title="' . sprintf( 'View all posts by %s', 'bigbo', $authordata->display_name ) . '"><i class="fa fa-user"></i>' . get_the_author() . '</a>' )
            ?>
        </li>
        <?php
    }

    if ( $ved_options[ 'ved_meta_date' ] == 1 ) {
        ?>
        <li class="published updated">
            <a href="<?php the_permalink() ?>"><i class="fa fa-calendar"></i><?php the_time( get_option( 'date_format' ) ); ?></a>
        </li>
        <?php
    }

    if ( bigbo_get_terms( 'cats' ) && $ved_options[ 'ved_meta_cats' ] == 1 ) {
        ?>

        <li class="meta-tags">
            <i class="fa fa-folder"></i>
        <?php echo bigbo_get_terms( 'cats', ' ' ); ?>
        </li>

        <?php
    }

    if ( bigbo_get_terms( 'tags' ) && $ved_options[ 'ved_meta_tags' ] == 1 ) {
        ?>
        <li class="meta-tags">
            <i class="fa fa-tags"></i>
        <?php echo bigbo_get_terms( 'tags' ); ?>
        </li>
        <?php
    }

    if ( comments_open() && $ved_options[ 'ved_meta_comments' ] == 1 ) {
        ?>
        <li class="comment-count">
        <?php comments_popup_link( esc_html__( 'Leave a Comment', 'bigbo' ), esc_html__( '1 Comment', 'bigbo' ), esc_html__( '% Comments', 'bigbo' ) ); ?>
        </li>
        <?php
    }
}

/**
 * bigbo_get_terms() Returns other terms except the current one (redundant)
 *
 * @since 0.2.3
 * @usedby bigbo_entry_footer()
 */
function bigbo_get_terms( $term = NULL, $glue = ', ' ) {
    if ( ! $term ) {
        return;
    }

    $separator = "\n";

    switch ( $term ):
        case 'cats':
            $current = single_cat_title( '', false );
            $terms   = get_the_category_list( $separator );
            break;
        case 'tags':
            $current = single_tag_title( '', '', false );
            $terms   = get_the_tag_list( '', "$separator", '' );
            break;
    endswitch;

    if ( empty( $terms ) ) {
        return;
    }

    $thing = explode( $separator, $terms );

    if ( empty( $thing ) ) {
        return false;
    }

    return trim( join( $glue, $thing ) );
}

/**
 * 
 * Function to print out css class according to layout
 * used in content.php, index.php.
 * 
 * @param type $xyz
 */
function bigbo_post_layout( $xyz ) {

    $ved_post_layout = bigbo_get_option( 'ved_post_layout', '2' );

    if ( $ved_post_layout == "2" ) {
        echo ' col-md-6 odd' . ( (int) $xyz % 2 );
    } else {
        echo ' col-md-4 odd' . ( (int) $xyz % 3 );
    }
}

/**
 * 
 * Print out css class according to post format
 * used in content.php, index.php.
 * 
 */
function bigbo_post_format() {
    $post_format = '';

    if ( is_sticky() ) {
        $post_format .= 'sticky';
    }

    if ( has_post_format( array(
        'aside',
        'audio',
        'chat',
        'gallery',
        'image',
        'link',
        'quote',
        'status',
        'video'
    ), '' ) ) {
        $post_format .= get_post_format();
    }

    return esc_attr( $post_format );
}
