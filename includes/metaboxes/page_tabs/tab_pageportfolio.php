<!--rename this file page_options.php to tab_page_portfolio.php-->
<!--this is actual page portfolio file-->
<div class="ved_metabox">
    <p><b><?php esc_html_e('Note: Portfolio options override all Layout options and work for only portfolio template','daydream'); ?></b></p>
    <?php
    $types = get_terms('portfolio_category', 'hide_empty=0');
    $types_array[0] = 'All categories';
    if ($types) {
        foreach ($types as $type) {
            $types_array[$type->term_id] = $type->name;
        }
        $this->daydream_multiple('portfolio_category', __('Portfolio Type', 'daydream'), $types_array, __('Choose what portfolio category you want to display on this page.', 'daydream')
        );
    }

    $this->daydream_select('portfolio_filters', __('Show Portfolio Filters', 'daydream'), array(
        'yes' => __('Show', 'daydream'),
        'no' => __('Hide', 'daydream')
            ), ''
    );
    ?>
</div>