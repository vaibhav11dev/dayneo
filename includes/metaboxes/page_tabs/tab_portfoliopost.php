<div class='ved_metabox'>
    <?php
    $this->bigbo_select( 'po_featured_image', __( 'Show Featured Image', 'bigbo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->bigbo_select( 'po_author', __( 'Show Author', 'bigbo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->bigbo_select( 'po_sharing', __( 'Show Sharing Box', 'bigbo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->bigbo_select( 'po_related_posts', __( 'Show Related Posts', 'bigbo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->bigbo_text( 'project_url', __( 'Project URL', 'bigbo' ), ''
    );

    $this->bigbo_text( 'project_url_text', __( 'Project URL Text', 'bigbo' ), ''
    );

    $this->bigbo_text( 'link_icon_url', 'Portfolio Link URL', 'Leave blank as post URL'
    );

    $this->bigbo_select( 'link_icon_target', 'Open Link URL In New Window', array( 'no' => 'No', 'yes' => 'Yes' ), ''
    );
    ?>    
</div>