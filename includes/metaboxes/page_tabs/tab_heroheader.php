<div class="ved_metabox">
    <?php
    $this->daydream_select( 'header_type', __( 'Choose Header Type', 'daydream' ), array(
	'default'	 => __( 'Default', 'daydream' ),
	'h1'		 => __( 'Header1', 'daydream' ),
	'h2'		 => __( 'Header2', 'daydream' ),
	'h3'		 => __( 'Header3', 'daydream' ),
	'h4'		 => __( 'Header4', 'daydream' ),
	'h5'		 => __( 'Header5', 'daydream' ),
    ), ''
    );

    $this->daydream_select( 'hero_header_type', __( 'Choose Hero Header Type', 'daydream' ), array(
	'none'			 => __( 'None', 'daydream' ),
	'hero_parallax'		 => __( 'Parallax Hero Header', 'daydream' ),
	'hero_self_hosted_video' => __( 'Self Hosted Video Hero Header', 'daydream' ),
	'hero_youtube'		 => __( 'Youtube Hero Header', 'daydream' ),
	'hero_vimeo'		 => __( 'Vimeo Hero Header', 'daydream' ),
	'hero_slider'		 => __( 'Slider', 'daydream' ),
    ), ''
    );

    $this->daydream_select( 'hero_height', __( 'Hero Header Height', 'daydream' ), array(
	'medium' => __( 'Medium', 'daydream' ),
	'small'	 => __( 'Small', 'daydream' ),
	'large'	 => __( 'Large', 'daydream' ),
	'custom' => __( 'Custom', 'daydream' ),
    ), ''
    );

    $this->daydream_text( 'hero_height_custom', 'Custom Height', "All Height in vh and don't add suffix vh. ex: 70"
    );
    ?>

    <span class="slider_note"><?php esc_html_e( 'Set your slider configuration in slider tab', 'daydream' ); ?></span>

    <div class="parallax_settings" style="display: none;">
	<?php
	$this->daydream_upload( 'hero_image_parallax', __( 'Parallax Background', 'daydream' ), 'Uploade image for parallax header' );
	?>
    </div>
    <div class="youtube_settings" style="display: none;">
	<?php
	$this->daydream_text( 'hero_youtube_id', 'Youtube Video URL', 'For example the Video ID is https://www.youtube.com/embed/aqz-KE-bpKQ'
	);
	?>
    </div>
    <div class="vimeo_settings" style="display: none;">
	<?php
	$this->daydream_text( 'hero_vimeo_id', 'Vimeo Video URL', 'For example the Video ID is http://vimeo.com/133316671'
	);
	?>
    </div>
    <div class="self_video_settings" style="display: none;">
	<?php
	$this->daydream_upload( 'hero_webm', 'Video WebM Upload', 'Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.' );

	$this->daydream_upload( 'hero_mp4', 'Video MP4 Upload', 'Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.' );
	$this->daydream_upload( 'hero_ogv', 'Video OGV Upload', 'Add your OGV video file. This is optional.' );
	?>
    </div>
    <div class="herocontent_settings" style="display: none;">
	<?php
	$this->daydream_select( 'hero_content_alignment', 'Content Alignment', array( 'center' => 'Center', 'left' => 'Left', 'right' => 'Right' ), 'Select how the heading, caption will be aligned.'
	);

	$this->daydream_text( 'hero_heading', 'Heading', 'Enter the heading for your Hero Header. It not apply in slider type.'
	);

	$this->daydream_text( 'hero_caption', 'Caption', 'Enter the caption for your Hero Header. It not apply in slider type.'
	);
	?>
    </div>
</div>
