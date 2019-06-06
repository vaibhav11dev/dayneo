<?php
global $ved_options;
if ( $ved_options[ 'ved_header_number' ] || $ved_options[ 'ved_header_email' ] ):
    ?>
    <ul class="top-bar-list list-icons">
	<?php if ( $ved_options[ 'ved_header_number' ] ): ?>
	    <li>	
		<a class="phone-number" href="tel:<?php echo str_replace( ' ', '', esc_attr( $ved_options[ 'ved_header_number' ] ) ); ?>"><i class="fa fa-phone"></i><?php echo esc_html( $ved_options[ 'ved_header_number' ] ); ?>

		</a>
	    </li>
	    <?php
	endif;
	if ( $ved_options[ 'ved_header_email' ] ):
	    ?> 
	    <li>

		<a class="email-address" href="mailto:<?php echo esc_url( antispambot( $ved_options[ 'ved_header_email' ] ) ); ?>"><i class="fa fa-envelope"></i><?php echo esc_html( $ved_options[ 'ved_header_email' ] ); ?>

		</a>
	    </li>
	<?php endif; ?>
    </ul>
    <?php




 endif;
