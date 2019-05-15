/* Upload Media on page/post options */
jQuery(document).ready(function ($) {

    var frame;
    jQuery('.bigbo_upload_button').on('click', function (event) {

        event.preventDefault();
        var item_id = jQuery(this).attr('data-media-id');

        frame = wp.media({
            title: '',
            button: {
                text: 'Select'
            },
            multiple: false,
            //item_id: jQuery(this).attr('data-media-id')
        });

        frame.on('select', function () {

            //item_id = frame.options.item_id;

            var attachment = frame.state().get('selection').first().toJSON();

            jQuery('#bigbo-media-display-' + item_id).append('<input type="text" class="upload_field" value="' + attachment.url + '" /></br><img src="' + attachment.url + '" alt="' + attachment.name + '" class="redux-option-image" style="width:60px; height:60px;"/>');
            jQuery('#bigbo_' + item_id).val(attachment.id);
            jQuery('#bigbo-media-upload-' + item_id).addClass('hidden');
            jQuery('#bigbo-media-remove-' + item_id).removeClass('hidden');
            jQuery('#bigbo-media-remove-extra-' + item_id).addClass('hidden');
        });

        frame.open();
    });

    jQuery('.bigbo_remove_button').on('click', function (event) {

        event.preventDefault();
        var item_id = jQuery(this).attr('data-media-id');
        jQuery('#bigbo-media-display-' + item_id).html('');
        jQuery('#bigbo_' + item_id).val('');
        jQuery('#bigbo-media-upload-' + item_id).removeClass('hidden');
        jQuery('#bigbo-media-remove-' + item_id).addClass('hidden');
        jQuery('#bigbo-media-remove-extra-' + item_id).removeClass('hidden');
    });

});

// Change tab on click in page/post option
jQuery(document).ready(function ($) {

    jQuery('.ved_metabox_tabs li a').click(function (e) {
        e.preventDefault();

        var id = jQuery(this).attr('href');

        jQuery(this).parents('ul').find('li').removeClass('active');
        jQuery(this).parent().addClass('active');

        jQuery(this).parents('.inside').find('.ved_metabox_tab').removeClass('active').hide();
        jQuery(this).parents('.inside').find('#ved_tab_' + id).addClass('active').fadeIn();

    });

});