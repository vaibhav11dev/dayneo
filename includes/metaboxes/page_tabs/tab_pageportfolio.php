<!--rename this file page_options.php to tab_page_portfolio.php-->
<!--this is actual page portfolio file-->
<div class="ved_metabox">
    <p><b><?php esc_html_e('Note: Portfolio options override all Layout options and work for only portfolio template','dayneo'); ?></b></p>
    <?php
    $types = get_terms('portfolio_category', 'hide_empty=0');
    $types_array[0] = 'All categories';
    if ($types) {
        foreach ($types as $type) {
            $types_array[$type->term_id] = $type->name;
        }
        $this->dayneo_multiple('portfolio_category', __('Portfolio Type', 'dayneo'), $types_array, __('Choose what portfolio category you want to display on this page.', 'dayneo')
        );
    }

    $this->dayneo_select('portfolio_filters', __('Show Portfolio Filters', 'dayneo'), array(
        'yes' => __('Show', 'dayneo'),
        'no' => __('Hide', 'dayneo')
            ), ''
    );
    ?>
</div>