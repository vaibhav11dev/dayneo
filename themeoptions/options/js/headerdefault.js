
var HeaderDefault = {
    baseName: 'ved_options',
    headerFieldName: 'ved_header_type',
    headerValue: {
        'h1': [
            {fieldType: 'switch', fieldName: 'ved_show_header_compare', fieldValue: '1'},
            {fieldType: 'switch', fieldName: 'ved_show_header_wishlist', fieldValue: '0'},
            {fieldType: 'font-family', fieldName: 'ved_menu_font', fieldValue: 'Poppins', fieldColor: '#fff', isGoogle: true},
            {fieldType: 'color', fieldName: 'ved_secondry_color', fieldValue: '#0c3e3e'},
            {fieldType: 'button_set', fieldName: 'ved_cat_menu_status', fieldValue: 'enable'}
        ],
        'h2': [
            {fieldType: 'switch', fieldName: 'ved_show_header_compare', fieldValue: '0'},
            {fieldType: 'switch', fieldName: 'ved_show_header_wishlist', fieldValue: '0'},
            {fieldType: 'font-family', fieldName: 'ved_menu_font', fieldValue: 'Playball', fieldColor: '#000', isGoogle: true},
            {fieldType: 'color', fieldName: 'ved_secondry_color', fieldValue: '#ffffff'},
            {fieldType: 'button_set', fieldName: 'ved_cat_menu_status', fieldValue: 'disable'}
        ]
    }
    ,
    bind: function () {

        var t = this;
        var watchName = '#' + t.baseName + '-' + t.headerFieldName + ' input';

        jQuery(document).on('change', watchName, function (event) {
            var currentValue = jQuery(watchName + ":checked").val();

            if (t.headerValue.hasOwnProperty(currentValue)) {
                var cgs = t.headerValue[currentValue];
                jQuery.each(cgs, function (i, v) {
                    switch (v.fieldType) {
                        case 'select':
                            jQuery('#' + v.fieldName + '-select').val(v.fieldValue).trigger('change');
                            break;
                        case 'font-family':
                            jQuery('#' + v.fieldName + ' .redux-typography-google').val(v.isGoogle);

                            jQuery('#' + v.fieldName + ' .redux-typography-font-family').val(v.fieldValue);
                            jQuery('#' + v.fieldName + ' .redux-typography-family:first').data('value', v.fieldValue).val(v.fieldValue);

                            if (jQuery('#' + v.fieldName + ' .redux-typography-family').length > 1) {
                                jQuery('#' + v.fieldName + ' .redux-typography-family:last').select2('val', v.fieldValue);
                            }

                            jQuery('#' + v.fieldName + ' .redux-typography ').trigger('change');
                            jQuery('#' + v.fieldName + '-color').val(v.fieldColor).trigger('change');
                            break;
                        case 'color':
                            jQuery('#' + v.fieldName + '-color').val(v.fieldValue).trigger('change');
                            break;
                        case 'button_set':
                            jQuery('#' + t.baseName  + '-' + v.fieldName + ' .buttonset-item' ).removeAttr('checked').trigger('change');
                            jQuery('#' + v.fieldName + '-buttonset' + v.fieldValue).attr('checked','checked').trigger('change');
                            break;
                        case 'switch':
                            if (v.fieldValue == '1') {
                                jQuery('#' + v.fieldName).val(1).trigger('change');
                                jQuery('#' + v.fieldName).parents('fieldset').find('.cb-enable').addClass('selected').trigger('click');
                                jQuery('#' + v.fieldName).parents('fieldset').find('.cb-disable').removeClass('selected');
                            } else {
                                jQuery('#' + v.fieldName).val(0).trigger('change')
                                jQuery('#' + v.fieldName).parents('fieldset').find('.cb-enable').removeClass('selected');
                                jQuery('#' + v.fieldName).parents('fieldset').find('.cb-disable').addClass('selected').trigger('click');
                            }
                            break;
                        default:
                            //
                            break;
                    }
                })
            }
            ;

        });
    }

};

HeaderDefault.bind();