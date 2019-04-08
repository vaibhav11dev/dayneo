<div class='ved_metabox'>
	<?php
	$this->dayneo_image_radio_button(
	'sidebar_position', __( 'Sidebar Position', 'dayneo' ), array(
		'default'	 => DAYNEO_IMAGEPATH . 'none.jpg',
		'1c'		 => DAYNEO_IMAGEPATH . '1c.png',
		'2cl'		 => DAYNEO_IMAGEPATH . '2cl.png',
		'2cr'		 => DAYNEO_IMAGEPATH . '2cr.png',
		'3cm'		 => DAYNEO_IMAGEPATH . '3cm.png',
		'3cr'		 => DAYNEO_IMAGEPATH . '3cr.png',
		'3cl'		 => DAYNEO_IMAGEPATH . '3cl.png'
	), '', 'default'
	);

	$this->dayneo_text( 'content_top_bottom_padding', __( 'Content Top & Bottom Padding', 'dayneo' ), __( 'Enter the page content top & bottom padding. In pixels ex: 20px. Leave empty for default value.', 'dayneo' )
	);

	$this->dayneo_text( 'hundredp_padding', __( 'Fullwidth - Fluid Template Left/Right Padding', 'dayneo' ), __( 'In pixels ex: 20px. Leave empty for default value.', 'dayneo' )
	);
	?>
</div>