<div class="ved_metabox">
    <?php
   $this->bigbo_select( 'enable_page_title', __( 'Enable Page Title Bar', 'bigbo' ), array(
	'default'		 => __( 'Default', 'bigbo' ),
	'on'	 => __( 'On', 'bigbo' ),
	'off'		 => __( 'Off', 'bigbo' ),
    ), ''
    );
    
    $this->bigbo_select( 'display_page_title', __( 'Page Title Bar', 'bigbo' ), array(
	'default'		 => __( 'Default', 'bigbo' ),
	'titlebar_breadcrumb'	 => __( 'Title + Breadcrumb', 'bigbo' ),
	'titlebar'		 => __( 'Only Title', 'bigbo' ),
	'breadcrumb'		 => __( 'Only Breadcrumb', 'bigbo' ),
    ), ''
    );

    $this->bigbo_text( 'page_title_bar_bg_color', __( 'Page Title Bar Background Color (Hex Code)', 'bigbo' ), '' );

    $this->bigbo_upload( 'page_title_bar_bg', __( 'Page Title Bar Background', 'bigbo' ) );

    $this->bigbo_select( 'page_title_bar_height', __( 'Page Title Bar Height', 'bigbo' ), array(
	'default'	 => __( 'Default', 'bigbo' ),
	'medium'	 => __( 'Medium', 'bigbo' ),
	'small'		 => __( 'Small', 'bigbo' ),
	'large'		 => __( 'Large', 'bigbo' ),
	'custom'	 => __( 'Custom', 'bigbo' ),
    ), ''
    );

    $this->bigbo_text( 'page_title_bar_height_custom', 'Custom Height', "All Height in vh and don't add suffix vh. ex: 70"
    );

    $this->bigbo_select( 'page_title_bar_parallax_bg', __( 'Parallax Background Image', 'bigbo' ), array(
	'default'	 => __( 'Default', 'bigbo' ),
	'yes'		 => __( 'Show', 'bigbo' ),
	'no'		 => __( 'Hide', 'bigbo' ),
    ), ''
    );
    ?>
</div>
