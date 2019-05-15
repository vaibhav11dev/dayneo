<div class='ved_metabox'>
    <?php
    $this->bigbo_select( 'type', 'Background Type', array( 'image' => 'Image', 'self-hosted-video' => 'Self-Hosted Video', 'youtube' => 'Youtube', 'vimeo' => 'Vimeo' ), 'Select an image or video slide. If using an image, please select the image in the "Featured Image" box on the right hand side.'
    );

    $this->bigbo_select( 'parallax_effect', 'Parallax Scrolling Effect', array( 'disable' => 'Disable', 'enable' => 'Enable' ), 'Choose Enable options if you want to parallax scrolling effect.'
    );
    ?>

    <div class="video_settings" style="display: none;">
        <h2>Video Options:</h2>
	<?php
	$this->bigbo_text( 'youtube_id', 'Youtube Video URL', 'For example the Video ID is https://www.youtube.com/embed/aqz-KE-bpKQ'
	);

	$this->bigbo_text( 'vimeo_id', 'Vimeo Video URL', 'For example the Video ID is http://vimeo.com/133316671'
	);

	$this->bigbo_upload( 'webm', 'Video WebM Upload', 'Video must be in a 16:9 aspect ratio. Add your WebM video file. WebM and MP4 format must be included to render your video with cross browser compatibility. OGV is optional.' );

	$this->bigbo_upload( 'mp4', 'Video MP4 Upload', 'Video must be in a 16:9 aspect ratio. Add your MP4 video file. MP4 and WebM format must be included to render your video with cross browser compatibility. OGV is optional.' );

	$this->bigbo_upload( 'ogv', 'Video OGV Upload', 'Add your OGV video file. This is optional.' );
	?>
    </div>
    <h2>Slider Content Settings:</h2>
    <?php
    $this->bigbo_select( 'content_alignment', 'Content Alignment', array( 'center' => 'Center', 'left' => 'Left', 'right' => 'Right' ), 'Select how the heading, caption and buttons will be aligned.'
    );

    $this->bigbo_text( 'heading', 'Heading', 'Enter the bigbo_text heading for your slide.'
    );

    $this->bigbo_text( 'caption', 'Caption', 'Enter the bigbo_text caption for your slide.'
    );
    ?>
    <h2>Slide Link Settings:</h2>
    <?php
    $this->bigbo_text( 'button1_text', 'Button1 Text', 'Please enter your Text that will be used to button text.'
    );
    $this->bigbo_text( 'button1_link', 'Button1 Link', 'Please enter your URL that will be used to link the button.'
    );
    $this->bigbo_text( 'button2_text', 'Button2 Text', 'Please enter your Text that will be used to button text.'
    );
    $this->bigbo_text( 'button2_link', 'Button2 Link', 'Please enter your URL that will be used to link the button.'
    );
    ?>
</div>