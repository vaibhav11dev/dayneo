<?php
$items = '';
$account      = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
$account_link = $account;
if ( is_user_logged_in() ) {
    $user_id = get_current_user_id();
    
    $author       = get_user_by( 'id', $user_id );

    $logged_type = esc_html__( 'My Account', 'dayneo' );

    $items .= sprintf(
    '<div id="_desktop_user_info">
        <div class="extra-menu-item menu-item-account dropdown hidden-md-down logined">
    		<a href="javascript:void(0)" class="expand-more" data-toggle="dropdown">%s</a>
    		<ul class="dropdown-menu">
    			<li><a href="%s">%s</a></li>					
    			<li class="logout"><a href="%s">%s</a></li>
    		</ul>
    	</div>
        <div class="user-info-wrap hidden-lg-up logined">
            <i class="fa fa-user-circle user-icon" aria-hidden="true"></i>
            <div class="user-info-btn">
                <a class="account" href="#" title="View my customer account" rel="nofollow">test test</a>
                <p class="cust-mail">admin@mail.com</p>
                <a class="logout" href="#"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>', $logged_type, esc_url( $account_link ) , esc_html__( 'Hello,', 'dayneo' ) . ' ' . $author->display_name . '!', esc_url( wp_logout_url( $account ) ), esc_html__( 'Logout', 'dayneo' )
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
    '<div id="_desktop_user_info">
        <div class="extra-menu-item menu-item-account hidden-md-down dropdown">
            <a href="%s" class="expand-more" data-toggle="dropdown">%s</a>
            <ul class="dropdown-menu">
    			<li><a href="%s" id="menu-extra-login">%s</a></li>
    			<li>%s</li>
            </ul>
        </div>
        <div class="user-info-wrap hidden-lg-up">
            <i class="fa fa-user-circle user-icon" aria-hidden="true"></i>
            <div class="user-info-btn">
              <a href="#" title="Log in to your customer account" rel="nofollow">Login</a>
              <a class="register" href="#">Register</a>
          </div>
        </div>
    </div>', esc_url( $account_link ), esc_html__( 'My Account', 'dayneo' ), esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ), esc_html__( 'Log in', 'dayneo' ), $register
    );
}
echo $items;
