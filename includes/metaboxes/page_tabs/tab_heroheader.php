<div class="ved_metabox">
    <?php
    $this->dayneo_select( 'header_type', __( 'Choose Header Type', 'dayneo' ), array(
	'default'	 => __( 'Default', 'dayneo' ),
	'h1'		 => __( 'Header1', 'dayneo' ),
	'h2'		 => __( 'Header2', 'dayneo' ),
	'h3'		 => __( 'Header3', 'dayneo' ),
    ), ''
    );

    $this->dayneo_select( 'hero_header_type', __( 'Choose Hero Header Type', 'dayneo' ), array(
	'none'			 => __( 'None', 'dayneo' ),
	'hero_parallax'		 => __( 'Parallax Hero Header', 'dayneo' ),
	'hero_self_hosted_video' => __( 'Self Hosted Video Hero Header', 'dayneo' ),
	'hero_youtube'		 => __( 'Youtube Hero Header', 'dayneo' ),
	'hero_vimeo'		 => __( 'Vimeo Hero Header', 'dayneo' ),
	'hero_slider'		 => __( 'Slider', 'dayneo' ),
    ), ''
    );

    $this->dayneo_select( 'hero_height', __( 'Hero Header Height', 'dayneo' ), array(
	'medium' => __( 'Medium', 'dayneo' ),
	'small'	 => __( 'Small', 'dayneo' ),
	'large'	 => __( 'Large', 'dayneo' ),
	'custom' => __( 'Custom', 'dayneo' ),
    ), ''
    );

    $this->dayneo_text( 'hero_height_custom', 'Custom Height', "All Height in vh and don't add suffix vh. ex: 70"
    );
    ?>

    <span class="slider_note"><?php esc_html_e( 'Set your slider configuration in slider tab', 'dayneo' ); ?></span>

    <div class="parallax_settings" style="display: none;">
	<?php
	$this->dayneo_upload( 'hero_image_parallax', __( 'Parallax Background', 'dayneo' ), 'Uploade image for parallax header' );
	?>
    </div>
    <div class="youtube_settings" style="display: none;">
	<?php
	$this->dayneo_text( 'hero_youtube_id', 'Youtube Video URL', 'For example the Video ID is https://www.youtube.com/embed/aqz-KE-bpKQ'
	);
	?>
    </div>
    <div class="vimeo_settings" style="display: none;">
	<?php
	$this->dayneo_text( 'hero_vimeo_id', 'Vimeo Video URL', 'For example the Video ID is http://vimeo.com/133316671'
	);
	?>
    </div>
    <div class="self_video_settings" style="display: none;">
	<?php
	$this->dayneo_upload( 'hero_webm', 'Video WebM Upload', 'Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.' );

	$this->dayneo_upload( 'hero_mp4', 'Video MP4 Upload', 'Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.' );
	$this->dayneo_upload( 'hero_ogv', 'Video OGV Upload', 'Add your OGV video file. This is optional.' );
	?>
    </div>
    <div class="herocontent_settings" style="display: none;">
	<?php
	$this->dayneo_select( 'hero_content_alignment', 'Content Alignment', array( 'center' => 'Center', 'left' => 'Left', 'right' => 'Right' ), 'Select how the heading, caption will be aligned.'
	);

	$this->dayneo_text( 'hero_heading', 'Heading', 'Enter the heading for your Hero Header. It not apply in slider type.'
	);

	$this->dayneo_text( 'hero_caption', 'Caption', 'Enter the caption for your Hero Header. It not apply in slider type.'
	);
	?>
    </div>
</div>
