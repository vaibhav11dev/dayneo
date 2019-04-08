<div class='ved_metabox'>
	<?php
	$this->daydream_image_radio_button(
	'sidebar_position', __( 'Sidebar Position', 'daydream' ), array(
		'default'	 => DAYDREAM_IMAGEPATH . 'none.jpg',
		'1c'		 => DAYDREAM_IMAGEPATH . '1c.png',
		'2cl'		 => DAYDREAM_IMAGEPATH . '2cl.png',
		'2cr'		 => DAYDREAM_IMAGEPATH . '2cr.png',
		'3cm'		 => DAYDREAM_IMAGEPATH . '3cm.png',
		'3cr'		 => DAYDREAM_IMAGEPATH . '3cr.png',
		'3cl'		 => DAYDREAM_IMAGEPATH . '3cl.png'
	), '', 'default'
	);

	$this->daydream_text( 'content_top_bottom_padding', __( 'Content Top & Bottom Padding', 'daydream' ), __( 'Enter the page content top & bottom padding. In pixels ex: 20px. Leave empty for default value.', 'daydream' )
	);

	$this->daydream_text( 'hundredp_padding', __( 'Fullwidth - Fluid Template Left/Right Padding', 'daydream' ), __( 'In pixels ex: 20px. Leave empty for default value.', 'daydream' )
	);
	?>
</div>