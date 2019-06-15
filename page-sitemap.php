<?php
/**
 * Template Name: HTML Sitemap Page
 *
 * Create Dynamic HTML Sitemap in WordPress
 */
 
get_header(); 
?>
 
<div id="primary" class="content-area mb-30 mt-30">
    <main id="main" class="site-main">
         
        <div class="container"> 
            <div class="sitemap">

                <div class="col-sm-4 mt-30">
                    <div class="sec-head-style">
                        <h3 class="text-title text-uppercase page-heading">Pages</h3>
                    </div>
                    <ul class="sitemap-pages">
                        <?php wp_list_pages(array('exclude' => '', 'title_li' => '')); // Exclude pages by ID ?>
                    </ul>
                </div>
    
                <div class="col-sm-4 mt-30">
                    <div class="sec-head-style">
                        <h3 class="text-title text-uppercase page-heading">Posts</h3>
                    </div>
                    <ul class="">
                        <?php
                            $categories = get_categories('exclude='); // Exclude categories by ID
                            foreach ($categories as $cat) {
                            ?>
                                <li class="category">
                                    <h4><span>Category: </span><?php echo esc_html($cat->cat_name); ?></h4>
                                    <ul class="cat-posts mb-30">
                                    <?php
                                        query_posts('posts_per_page=-1&cat='.$cat->cat_ID); //-1 shows all posts per category. 1 to show most recent post.
                                        while(have_posts()): 
                                            the_post();
                                            $category = get_the_category();
                                            if ($category[0]->cat_ID == $cat->cat_ID) { ?>
                                                <li>
                                                    <?php the_time('M d, Y')?> &raquo; <a href="<?php the_permalink() ?>"  title="<?php the_title(); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)
                                                </li>
                                            <?php 
                                            }
                                        endwhile;
                                    ?>
                                    </ul> 
                                </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php  wp_reset_postdata(); ?>
                
                <div class="col-sm-4 mt-30">
                    <div class="sec-head-style">
                        <h3 class="text-title text-uppercase page-heading">Archives</h3>
                    </div>
                    <ul class="sitemap-archives">
                        <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
                    </ul>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>        
 
    </main>
</div>
 
<?php
get_footer();

?>