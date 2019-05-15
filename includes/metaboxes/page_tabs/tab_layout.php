<div class='ved_metabox'>
	<?php
	$this->bigbo_image_radio_button(
	'sidebar_position', __( 'Sidebar Position', 'bigbo' ), array(
		'default'	 => BIGBO_IMAGEPATH . 'none.jpg',
		'1c'		 => BIGBO_IMAGEPATH . '1c.png',
		'2cl'		 => BIGBO_IMAGEPATH . '2cl.png',
		'2cr'		 => BIGBO_IMAGEPATH . '2cr.png',
		'3cm'		 => BIGBO_IMAGEPATH . '3cm.png',
		'3cr'		 => BIGBO_IMAGEPATH . '3cr.png',
		'3cl'		 => BIGBO_IMAGEPATH . '3cl.png'
	), '', 'default'
	);

	$this->bigbo_text( 'content_top_bottom_padding', __( 'Content Top & Bottom Padding', 'bigbo' ), __( 'Enter the page content top & bottom padding. In pixels ex: 20px. Leave empty for default value.', 'bigbo' )
	);

	$this->bigbo_text( 'hundredp_padding', __( 'Fullwidth - Fluid Template Left/Right Padding', 'bigbo' ), __( 'In pixels ex: 20px. Leave empty for default value.', 'bigbo' )
	);
	?>
</div>