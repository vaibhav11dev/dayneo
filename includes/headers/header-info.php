<?php
global $dd_options;
if ( $dd_options[ 'dd_header_number' ] || $dd_options[ 'dd_header_email' ] ):
	?>
	<ul class="top-bar-list list-icons">
	    <?php if ( $dd_options[ 'dd_header_number' ] ): ?>
		    <li>
			<i class="icon-phone icons"></i>
                        <a class="phone-number" href="tel:<?php echo str_replace(' ', '', esc_attr($dd_options[ 'dd_header_number' ])); ?>">&nbsp;<?php echo esc_html($dd_options[ 'dd_header_number' ]); ?></a>
		    </li>
		    <?php
	    endif;
	    if ( $dd_options[ 'dd_header_email' ] ):
		    ?> 
		    <li>
			<i class="icon-envelope-open icons"></i>
			<a class="email-address" href="mailto:<?php echo esc_url(antispambot( $dd_options[ 'dd_header_email' ] )); ?>">&nbsp;<?php echo esc_html($dd_options[ 'dd_header_email' ]); ?></a>
		    </li>
	    <?php endif; ?>
	</ul>
	<?php


 endif;
