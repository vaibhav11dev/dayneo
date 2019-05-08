<?php
add_action( 'widgets_init', 'dayneo_product_carousel_widgets' );

function dayneo_product_carousel_widgets() {
    register_widget( 'Dayneo_Product_Carousel_Widget' );
}

/**
 * List products. One widget to rule them all.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class Dayneo_Product_Carousel_Widget extends WC_Widget {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->widget_cssclass    = 'woocommerce widget_product_carousel';
        $this->widget_description = esc_html__( "A slider of your store's products.", 'dayneo' );
        $this->widget_id          = 'dd_woo_product_carousel';
        $this->widget_name        = esc_html__( 'Dayneo - Product Carousel', 'dayneo' );
        $this->settings           = array(
            'title'       => array(
                'type'  => 'text',
                'std'   => esc_html__( 'Products', 'dayneo' ),
                'label' => esc_html__( 'Title', 'dayneo' ),
            ),
            'number'      => array(
                'type'  => 'number',
                'step'  => 1,
                'min'   => 1,
                'max'   => '',
                'std'   => 3,
                'label' => esc_html__( 'Number of products to show', 'dayneo' ),
            ),
            'number_show' => array(
                'type'  => 'number',
                'step'  => 1,
                'min'   => 1,
                'max'   => '',
                'std'   => 6,
                'label' => esc_html__( 'Total number of products to show', 'dayneo' ),
            ),
            'show'        => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => esc_html__( 'Show', 'dayneo' ),
                'options' => array(
                    ''         => esc_html__( 'All products', 'dayneo' ),
                    'featured' => esc_html__( 'Featured products', 'dayneo' ),
                    'onsale'   => esc_html__( 'On-sale products', 'dayneo' ),
                ),
            ),
            'orderby'     => array(
                'type'    => 'select',
                'std'     => 'date',
                'label'   => esc_html__( 'Order by', 'dayneo' ),
                'options' => array(
                    'date'  => esc_html__( 'Date', 'dayneo' ),
                    'price' => esc_html__( 'Price', 'dayneo' ),
                    'rand'  => esc_html__( 'Random', 'dayneo' ),
                    'sales' => esc_html__( 'Sales', 'dayneo' ),
                ),
            ),
            'order'       => array(
                'type'    => 'select',
                'std'     => 'desc',
                'label'   => _x( 'Order', 'Sorting order', 'dayneo' ),
                'options' => array(
                    'asc'  => esc_html__( 'ASC', 'dayneo' ),
                    'desc' => esc_html__( 'DESC', 'dayneo' ),
                ),
            ),
            'taxonomy'    => array(
                'type'    => 'select',
                'std'     => 'desc',
                'label'   => esc_html__( 'Taxonomy', 'dayneo' ),
                'options' => array(
                    ''         => esc_html__( 'Default', 'dayneo' ),
                    'category' => esc_html__( 'Same Current Category', 'dayneo' ),
                    'brand'    => esc_html__( 'Same Current Brand', 'dayneo' ),
                ),
            ),
            'hide_free'   => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => esc_html__( 'Hide free products', 'dayneo' ),
            ),
            'show_hidden' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => esc_html__( 'Show hidden products', 'dayneo' ),
            ),
        );

        parent::__construct();
    }

    /**
     * Query the products and return them.
     *
     * @param  array $args
     * @param  array $instance
     *
     * @return WP_Query
     */
    public function get_products( $args, $instance ) {
        $number_show                 = ! empty( $instance[ 'number_show' ] ) ? absint( $instance[ 'number_show' ] ) : $this->settings[ 'number_show' ][ 'std' ];
        $show                        = ! empty( $instance[ 'show' ] ) ? sanitize_title( $instance[ 'show' ] ) : $this->settings[ 'show' ][ 'std' ];
        $orderby                     = ! empty( $instance[ 'orderby' ] ) ? sanitize_title( $instance[ 'orderby' ] ) : $this->settings[ 'orderby' ][ 'std' ];
        $order                       = ! empty( $instance[ 'order' ] ) ? sanitize_title( $instance[ 'order' ] ) : $this->settings[ 'order' ][ 'std' ];
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

        $query_args = array(
            'posts_per_page' => $number_show,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'no_found_rows'  => 1,
            'order'          => $order,
            'meta_query'     => array(),
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        );

        if ( empty( $instance[ 'show_hidden' ] ) ) {
            $query_args[ 'tax_query' ][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => is_search() ? $product_visibility_term_ids[ 'exclude-from-search' ] : $product_visibility_term_ids[ 'exclude-from-catalog' ],
                'operator' => 'NOT IN',
            );
            $query_args[ 'post_parent' ] = 0;
        }

        if ( ! empty( $instance[ 'hide_free' ] ) ) {
            $query_args[ 'meta_query' ][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
            $query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids[ 'outofstock' ],
                    'operator' => 'NOT IN',
                ),
            );
        }
        if ( ! empty( $instance[ 'taxonomy' ] ) ) {
            $term_ids = array();
            $taxonomy = 'product_cat';
            if ( $instance[ 'taxonomy' ] == 'brand' ) {
                $taxonomy = 'product_brand';
            }

            if ( is_singular( 'product' ) ) {
                $term_ids                   = wp_get_post_terms( get_the_ID(), $taxonomy, array( "fields" => "ids" ) );
                $query_args[ 'post__not_in' ] = array( get_the_ID() );
            }

            if ( $term_ids && is_array( $term_ids ) ) {
                $query_args[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $term_ids,
                    ),
                );
            }
        }

        switch ( $show ) {
            case 'featured' :
                $query_args[ 'tax_query' ][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids[ 'featured' ],
                );
                break;
            case 'onsale' :
                $product_ids_on_sale       = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]     = 0;
                $query_args[ 'post__in' ]    = $product_ids_on_sale;
                break;
        }

        switch ( $orderby ) {
            case 'price' :
                $query_args[ 'meta_key' ] = '_price';
                $query_args[ 'orderby' ]  = 'meta_value_num';
                break;
            case 'rand' :
                $query_args[ 'orderby' ]  = 'rand';
                break;
            case 'sales' :
                $query_args[ 'meta_key' ] = 'total_sales';
                $query_args[ 'orderby' ]  = 'meta_value_num';
                break;
            default :
                $query_args[ 'orderby' ]  = 'date';
        }

        return new WP_Query( apply_filters( 'woocommerce_products_widget_query_args', $query_args ) );
    }

    /**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
        }
        $number_show                 = ! empty( $instance[ 'number_show' ] ) ? absint( $instance[ 'number_show' ] ) : $this->settings[ 'number_show' ][ 'std' ];
        $number = ! empty( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : $this->settings[ 'number' ][ 'std' ];
        $no_loop = (int)($number_show/$number);
        ob_start();

        if ( ( $products = $this->get_products( $args, $instance ) ) && $products->have_posts() ) {
            $this->widget_start( $args, $instance );

            echo apply_filters( 'woocommerce_before_widget_product_list', '<div class="product_list_widget">' );

          
            for ( $i = 0; $i < $no_loop; $i ++  ) {
                echo '<ul class="product_list">';
                
                for ( $j = 0; $j < $number; $j ++  ) {
                    $products->the_post();
                    wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) );
                }
                
                echo '</ul>';
            }


            echo apply_filters( 'woocommerce_after_widget_product_list', '</div>' );

            $this->widget_end( $args );
        }

        wp_reset_postdata();

        echo $this->cache_widget( $args, ob_get_clean() );
    }

}
