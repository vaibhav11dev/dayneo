<div class='ved_metabox'>
    <?php
    $this->daydream_select( 'po_featured_image', __( 'Show Featured Image', 'daydream' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->daydream_select( 'po_author', __( 'Show Author', 'daydream' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->daydream_select( 'po_sharing', __( 'Show Sharing Box', 'daydream' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->daydream_select( 'po_related_posts', __( 'Show Related Posts', 'daydream' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->daydream_text( 'project_url', __( 'Project URL', 'daydream' ), ''
    );

    $this->daydream_text( 'project_url_text', __( 'Project URL Text', 'daydream' ), ''
    );

    $this->daydream_text( 'link_icon_url', 'Portfolio Link URL', 'Leave blank as post URL'
    );

    $this->daydream_select( 'link_icon_target', 'Open Link URL In New Window', array( 'no' => 'No', 'yes' => 'Yes' ), ''
    );
    ?>    
</div>