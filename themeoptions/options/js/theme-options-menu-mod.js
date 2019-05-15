jQuery(document).ready(function () {

    var bigbomenu;

    // Hide the menu from Appearance.
    jQuery('#menu-appearance a[href="themes.php?page=bigbo_options"]').css('display', 'none');

    // Activate the bigbo admin menu theme option entry when theme options are active
    if (jQuery('a[href="admin.php?page=bigbo_options"]').hasClass('current')) {
        bigbomenu = jQuery('#toplevel_page_bigbo');

        bigbomenu.addClass('wp-has-current-submenu wp-menu-open');
        bigbomenu.children('a').addClass('wp-has-current-submenu wp-menu-open');
        bigbomenu.children('.wp-submenu').find('a[href="admin.php?page=bigbo_options"]').parent().addClass('current');
        bigbomenu.children('.wp-submenu').find('a[href="admin.php?page=bigbo_options"]').addClass('current');

        // Do not show the appearance menu as active
        jQuery('#menu-appearance a[href="themes.php"]').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance a[href="themes.php"]').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance').children('.wp-submenu').find('li').removeClass('current');
    }
});
