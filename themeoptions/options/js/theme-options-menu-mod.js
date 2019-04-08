jQuery(document).ready(function () {

    var dayneomenu;

    // Hide the menu from Appearance.
    jQuery('#menu-appearance a[href="themes.php?page=dayneo_options"]').css('display', 'none');

    // Activate the dayneo admin menu theme option entry when theme options are active
    if (jQuery('a[href="admin.php?page=dayneo_options"]').hasClass('current')) {
        dayneomenu = jQuery('#toplevel_page_dayneo');

        dayneomenu.addClass('wp-has-current-submenu wp-menu-open');
        dayneomenu.children('a').addClass('wp-has-current-submenu wp-menu-open');
        dayneomenu.children('.wp-submenu').find('a[href="admin.php?page=dayneo_options"]').parent().addClass('current');
        dayneomenu.children('.wp-submenu').find('a[href="admin.php?page=dayneo_options"]').addClass('current');

        // Do not show the appearance menu as active
        jQuery('#menu-appearance a[href="themes.php"]').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance a[href="themes.php"]').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance').children('.wp-submenu').find('li').removeClass('current');
    }
});
