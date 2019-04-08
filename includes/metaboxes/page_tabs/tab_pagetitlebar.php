<div class="ved_metabox">
    <?php
   $this->daydream_select( 'enable_page_title', __( 'Enable Page Title Bar', 'daydream' ), array(
	'default'		 => __( 'Default', 'daydream' ),
	'on'	 => __( 'On', 'daydream' ),
	'off'		 => __( 'Off', 'daydream' ),
    ), ''
    );
    
    $this->daydream_select( 'display_page_title', __( 'Page Title Bar', 'daydream' ), array(
	'default'		 => __( 'Default', 'daydream' ),
	'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'daydream' ),
	'titlebar'		 => __( 'Only Title', 'daydream' ),
	'breadcrumb'		 => __( 'Only Breadcrumb', 'daydream' ),
    ), ''
    );

    $this->daydream_text( 'page_title_bar_bg_color', __( 'Page Title Bar Background Color (Hex Code)', 'daydream' ), '' );

    $this->daydream_upload( 'page_title_bar_bg', __( 'Page Title Bar Background', 'daydream' ) );

    $this->daydream_select( 'page_title_bar_height', __( 'Page Title Bar Height', 'daydream' ), array(
	'default'	 => __( 'Default', 'daydream' ),
	'medium'	 => __( 'Medium', 'daydream' ),
	'small'		 => __( 'Small', 'daydream' ),
	'large'		 => __( 'Large', 'daydream' ),
	'custom'	 => __( 'Custom', 'daydream' ),
    ), ''
    );

    $this->daydream_text( 'page_title_bar_height_custom', 'Custom Height', "All Height in vh and don't add suffix vh. ex: 70"
    );

    $this->daydream_select( 'page_title_bar_parallax_bg', __( 'Parallax Background Image', 'daydream' ), array(
	'default'	 => __( 'Default', 'daydream' ),
	'yes'		 => __( 'Show', 'daydream' ),
	'no'		 => __( 'Hide', 'daydream' ),
    ), ''
    );
    ?>
</div>
