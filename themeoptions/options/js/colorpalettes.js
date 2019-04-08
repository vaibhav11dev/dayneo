
var ColorPalettes = {
    baseName: 'dd_options',
    colorpalettesFieldName: 'dd_color_palettes',
    colorpalettesValue: {
        'color_palette_1': [
            {fieldType: 'color', fieldName: 'dd_primary_color', fieldValue: '#27CBC0'},
            {fieldType: 'color', fieldName: 'dd_secondry_color', fieldValue: '#1fa098'},
            {fieldType: 'color', fieldName: 'dd_portfolio_hover_color', fieldValue: '#1fa098'},
	],
        'color_palette_2': [
            {fieldType: 'color', fieldName: 'dd_primary_color', fieldValue: '#3498db'},
            {fieldType: 'color', fieldName: 'dd_secondry_color', fieldValue: '#217dbb'},
            {fieldType: 'color', fieldName: 'dd_portfolio_hover_color', fieldValue: '#217dbb'},
	],
        'color_palette_3': [
            {fieldType: 'color', fieldName: 'dd_primary_color', fieldValue: '#444'},
            {fieldType: 'color', fieldName: 'dd_secondry_color', fieldValue: '#2b2b2b'},
            {fieldType: 'color', fieldName: 'dd_portfolio_hover_color', fieldValue: '#2b2b2b'},
	],
	'color_palette_4': [
            {fieldType: 'color', fieldName: 'dd_primary_color', fieldValue: '#ff6c5c'},
            {fieldType: 'color', fieldName: 'dd_secondry_color', fieldValue: '#ff3e29'},
            {fieldType: 'color', fieldName: 'dd_portfolio_hover_color', fieldValue: '#ff3e29'},
	],
	'color_palette_5': [
            {fieldType: 'color', fieldName: 'dd_primary_color', fieldValue: '#f1c40f'},
            {fieldType: 'color', fieldName: 'dd_secondry_color', fieldValue: '#c29d0b'},
            {fieldType: 'color', fieldName: 'dd_portfolio_hover_color', fieldValue: '#c29d0b'},
	],
    }
    ,
    bind: function () {

        var t = this;
        var watchName = '#' + t.baseName + '-' + t.colorpalettesFieldName + ' input';

        jQuery(document).on('change', watchName, function (event) {
            var currentValue = jQuery(watchName + ":checked").val();

            if (t.colorpalettesValue.hasOwnProperty(currentValue)) {
                //console.log('do changes');
                var cgs = t.colorpalettesValue[currentValue];
                jQuery.each(cgs, function (i, v) {
                    jQuery('#' + v.fieldName + '-color').val(v.fieldValue).trigger('change');
                })
            }
        });
    }

};

ColorPalettes.bind();