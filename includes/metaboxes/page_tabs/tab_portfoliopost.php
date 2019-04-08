<div class='ved_metabox'>
    <?php
    $this->dayneo_select( 'po_featured_image', __( 'Show Featured Image', 'dayneo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->dayneo_select( 'po_author', __( 'Show Author', 'dayneo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->dayneo_select( 'po_sharing', __( 'Show Sharing Box', 'dayneo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->dayneo_select( 'po_related_posts', __( 'Show Related Posts', 'dayneo' ), array( 'default' => 'Default', 'yes' => 'Show', 'no' => 'Hide' ), ''
    );

    $this->dayneo_text( 'project_url', __( 'Project URL', 'dayneo' ), ''
    );

    $this->dayneo_text( 'project_url_text', __( 'Project URL Text', 'dayneo' ), ''
    );

    $this->dayneo_text( 'link_icon_url', 'Portfolio Link URL', 'Leave blank as post URL'
    );

    $this->dayneo_select( 'link_icon_target', 'Open Link URL In New Window', array( 'no' => 'No', 'yes' => 'Yes' ), ''
    );
    ?>    
</div>