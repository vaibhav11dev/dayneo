<?php
$items = '';
$account      = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
$account_link = $account;
if ( is_user_logged_in() ) {
    $user_id = get_current_user_id();
    
    $author       = get_user_by( 'id', $user_id );

    $logged_type = esc_html__( 'My Account', 'dayneo' );

    $items .= sprintf(
    '<div class="extra-menu-item menu-item-account logined">
				<a href="%s">%s</a>
				<ul>
					<li>%s</li>
					
					<li class="logout">
						<a href="%s">%s</a>
					</li>
				</ul>
			</div>', esc_url( $account_link ), $logged_type, esc_html__( 'Hello,', 'dayneo' ) . ' ' . $author->display_name . '!', esc_url( wp_logout_url( $account ) ), esc_html__( 'Logout', 'dayneo' )
    );
} else {

    $register      = '';
    $register_text = esc_html__( 'Register', 'dayneo' );

    if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
        $register = sprintf(
        '<a href="%s" class="item-register" id="menu-extra-register">%s</a>', esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ), $register_text
        );
    }

    $items .= sprintf(
    '<div class="extra-menu-item menu-item-account">
        <a href="%s">%s</a>
        <ul>
				<li><a href="%s" id="menu-extra-login">%s</a></li>
				<li>%s</li>
                                </ul>
                </div>', esc_url( $account_link ), esc_html__( 'My Account', 'dayneo' ), esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ), esc_html__( 'Log in', 'dayneo' ), $register
    );
}
echo $items;
