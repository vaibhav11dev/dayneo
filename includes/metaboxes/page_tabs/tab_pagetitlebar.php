<div class="ved_metabox">
    <?php
   $this->dayneo_select( 'enable_page_title', __( 'Enable Page Title Bar', 'dayneo' ), array(
	'default'		 => __( 'Default', 'dayneo' ),
	'on'	 => __( 'On', 'dayneo' ),
	'off'		 => __( 'Off', 'dayneo' ),
    ), ''
    );
    
    $this->dayneo_select( 'display_page_title', __( 'Page Title Bar', 'dayneo' ), array(
	'default'		 => __( 'Default', 'dayneo' ),
	'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'dayneo' ),
	'titlebar'		 => __( 'Only Title', 'dayneo' ),
	'breadcrumb'		 => __( 'Only Breadcrumb', 'dayneo' ),
    ), ''
    );

    $this->dayneo_text( 'page_title_bar_bg_color', __( 'Page Title Bar Background Color (Hex Code)', 'dayneo' ), '' );

    $this->dayneo_upload( 'page_title_bar_bg', __( 'Page Title Bar Background', 'dayneo' ) );

    $this->dayneo_select( 'page_title_bar_height', __( 'Page Title Bar Height', 'dayneo' ), array(
	'default'	 => __( 'Default', 'dayneo' ),
	'medium'	 => __( 'Medium', 'dayneo' ),
	'small'		 => __( 'Small', 'dayneo' ),
	'large'		 => __( 'Large', 'dayneo' ),
	'custom'	 => __( 'Custom', 'dayneo' ),
    ), ''
    );

    $this->dayneo_text( 'page_title_bar_height_custom', 'Custom Height', "All Height in vh and don't add suffix vh. ex: 70"
    );

    $this->dayneo_select( 'page_title_bar_parallax_bg', __( 'Parallax Background Image', 'dayneo' ), array(
	'default'	 => __( 'Default', 'dayneo' ),
	'yes'		 => __( 'Show', 'dayneo' ),
	'no'		 => __( 'Hide', 'dayneo' ),
    ), ''
    );
    ?>
</div>
