jQuery(document).ready(function () {

    var daydreammenu;

    // Hide the menu from Appearance.
    jQuery('#menu-appearance a[href="themes.php?page=daydream_options"]').css('display', 'none');

    // Activate the daydream admin menu theme option entry when theme options are active
    if (jQuery('a[href="admin.php?page=daydream_options"]').hasClass('current')) {
        daydreammenu = jQuery('#toplevel_page_daydream');

        daydreammenu.addClass('wp-has-current-submenu wp-menu-open');
        daydreammenu.children('a').addClass('wp-has-current-submenu wp-menu-open');
        daydreammenu.children('.wp-submenu').find('a[href="admin.php?page=daydream_options"]').parent().addClass('current');
        daydreammenu.children('.wp-submenu').find('a[href="admin.php?page=daydream_options"]').addClass('current');

        // Do not show the appearance menu as active
        jQuery('#menu-appearance a[href="themes.php"]').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').removeClass('wp-has-current-submenu wp-menu-open');
        jQuery('#menu-appearance').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance a[href="themes.php"]').addClass('wp-not-current-submenu');
        jQuery('#menu-appearance').children('.wp-submenu').find('li').removeClass('current');
    }
});
