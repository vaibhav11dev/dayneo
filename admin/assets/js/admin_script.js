jQuery(document).ready(function () {
	jQuery("#new_label_date_field").datepicker({
		minDate: 0, dateFormat: 'yy-mm-dd'
	}
	);
	/* script for auto install */
	jQuery('#auto-install').on('click', function () {
		jQuery('.auto-install-loader').show();
		var demo = jQuery('#auto-install').attr('data-href');
		var auto_update = 'auto_install_layout1';
		auto_update = demo;
		jQuery.ajax({
			type: 'POST',
			url: js_strings.ajaxurl,
			data: {
				layout: auto_update,
				action: 'auto_install_layout'
			}
			,
			success: function (data, textStatus, XMLHttpRequest) {
				jQuery('.auto-install-loader').hide();
				location.reload();
			}
			,
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				jQuery('.auto-install-loader').hide();
				location.reload();
			}
		}
		);
	}
	);
	jQuery('#remove-auto-install').on('click', function () {
		if (confirm("Do you want to remove sample data?") == true) {
			jQuery('.auto-install-loader').show();
			jQuery.ajax({
				type: 'POST',
				url: js_strings.ajaxurl,
				data: {
					action: 'remove_auto_update'
				}
				,
				success: function (data, textStatus, XMLHttpRequest) {
					jQuery('.auto-install-loader').hide();
					location.reload();
				}
				,
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					jQuery('.auto-install-loader').hide();
					location.reload();
				}
			}
			);
			return true;
		} else {
			return false;
		}
	}
	);

	/* jquery auto-install section */
	jQuery('.demo_layout_wrap.select_demo div.bgframe.demo').live('click', function () {
		var tlayout = jQuery(this);
		jQuery('.demo_layout_wrap div.bgframe.demo').each(function () {
			jQuery(this).find('.scroll_image.demo').removeClass('selected');
			jQuery(this).removeClass('selected');
		}
		);
		tlayout.find('.scroll_image').addClass('selected');
		tlayout.addClass('selected');
		var install_path = tlayout.find('.scroll_image').attr('demo-attr');
		jQuery('.demo_install_button').find('a.install_demo').removeClass('disabled');
		jQuery('.demo_install_button').find('.select_demo_msg').remove();
		jQuery('.demo_install_button').find('a.install_demo').attr('data-href', install_path);
	}
	);
	if (jQuery('.demo_layout_wrap a.bgframe.demo').hasClass('selected')) {
		jQuery('.demo_install_button').find('a.install_demo').removeClass('disabled');
	} else {
		jQuery('.demo_install_button').find('a.install_demo').addClass('disabled');
		jQuery('.demo_install_button').find('.start_install').append('<span class="select_demo_msg"> ' + js_strings.select_demo_notice + '</span>');
	}
	jQuery(window).load(function () {
		jQuery('.end_install').find('.select_demo_msg').remove();
	}
	);

	/* Js - For Hero Header Type Page Metadata Options */
	var theme_prefix = 'dayneo_';
	var type = jQuery('#' + theme_prefix + 'hero_header_type').val();
	var container = jQuery('#' + theme_prefix + 'hero_header_type').parents('#' + theme_prefix + 'dayneo_page_options');

	jQuery(container).find('.slider_note, .parallax_settings, .youtube_settings, .vimeo_settings, .self_video_settings, .herocontent_settings').hide();

	if (type == 'hero_parallax') {
		jQuery(container).find('.parallax_settings, .herocontent_settings').show();
		jQuery(container).find('.slider_note, .youtube_settings, .vimeo_settings, .self_video_settings').hide();
	} else if (type == 'hero_youtube') {
		jQuery(container).find('.youtube_settings, .herocontent_settings').show();
		jQuery(container).find('.slider_note, .parallax_settings, .vimeo_settings, .self_video_settings').hide();
	} else if (type == 'hero_vimeo') {
		jQuery(container).find('.vimeo_settings, .herocontent_settings').show();
		jQuery(container).find('.slider_note, .youtube_settings, .parallax_settings, .self_video_settings').hide();
	} else if (type == 'hero_self_hosted_video') {
		jQuery(container).find('.self_video_settings, .herocontent_settings').show();
		jQuery(container).find('.slider_note, .youtube_settings, .vimeo_settings, .parallax_settings').hide();
	} else if (type == 'hero_slider') {
		jQuery(container).find('.slider_note').show();
		jQuery(container).find('.parallax_settings, .youtube_settings, .vimeo_settings, .self_video_settings, .herocontent_settings').hide();
	}

	jQuery('#' + theme_prefix + 'hero_header_type').change(function () {
		var type = jQuery(this).val();
		var container = jQuery(this).parents('#' + theme_prefix + 'dayneo_page_options');
		jQuery(container).find('.slide1r_note, .parallax_settings, .youtube_settings, .vimeo_settings, .self_video_settings, .herocontent_settings').hide();

		if (type == 'hero_parallax') {
			jQuery(container).find('.parallax_settings, .herocontent_settings').show();
			jQuery(container).find('.slider_note, .youtube_settings, .vimeo_settings, .self_video_settings').hide();
		} else if (type == 'hero_youtube') {
			jQuery(container).find('.youtube_settings, .herocontent_settings').show();
			jQuery(container).find('.slider_note, .parallax_settings, .vimeo_settings, .self_video_settings').hide();
		} else if (type == 'hero_vimeo') {
			jQuery(container).find('.vimeo_settings, .herocontent_settings').show();
			jQuery(container).find('.slider_note, .youtube_settings, .parallax_settings, .self_video_settings').hide();
		} else if (type == 'hero_self_hosted_video') {
			jQuery(container).find('.self_video_settings, .herocontent_settings').show();
			jQuery(container).find('.slider_note, .youtube_settings, .vimeo_settings, .parallax_settings').hide();
		} else if (type == 'hero_slider') {
			jQuery(container).find('.slider_note').show();
			jQuery(container).find('.parallax_settings, .youtube_settings, .vimeo_settings, .self_video_settings, .herocontent_settings').hide();
		}

	});

	/* Js - For Hero Header Height Page Metadata Options */
	var type = jQuery('#' + theme_prefix + 'hero_height').val();
	var container = jQuery('#' + theme_prefix + 'hero_height').parents('#' + theme_prefix + 'dayneo_page_options');

	jQuery(container).find('#' + theme_prefix + 'hero_height_custom').parents('.ved_metabox_field').hide();

	if (type == 'custom') {
		jQuery(container).find('#' + theme_prefix + 'hero_height_custom').parents('.ved_metabox_field').show();
	}

	jQuery('#' + theme_prefix + 'hero_height').change(function () {
		var type = jQuery(this).val();
		var container = jQuery(this).parents('#' + theme_prefix + 'dayneo_page_options');
		jQuery(container).find('#' + theme_prefix + 'hero_height_custom').parents('.ved_metabox_field').hide();

		if (type == 'custom') {
			jQuery(container).find('#' + theme_prefix + 'hero_height_custom').parents('.ved_metabox_field').show();
		}
	});

	/* Js - For Page Title Bar Height Page Metadata Options */
	var type = jQuery('#' + theme_prefix + 'page_title_bar_height').val();
	var container = jQuery('#' + theme_prefix + 'page_title_bar_height').parents('#' + theme_prefix + 'dayneo_page_options');

	jQuery(container).find('#' + theme_prefix + 'page_title_bar_height_custom').parents('.ved_metabox_field').hide();

	if (type == 'custom') {
		jQuery(container).find('#' + theme_prefix + 'page_title_bar_height_custom').parents('.ved_metabox_field').show();
	}

	jQuery('#' + theme_prefix + 'page_title_bar_height').change(function () {
		var type = jQuery(this).val();
		var container = jQuery(this).parents('#' + theme_prefix + 'dayneo_page_options');
		jQuery(container).find('#' + theme_prefix + 'page_title_bar_height_custom').parents('.ved_metabox_field').hide();

		if (type == 'custom') {
			jQuery(container).find('#' + theme_prefix + 'page_title_bar_height_custom').parents('.ved_metabox_field').show();
		}
	});

	//mobile sidebar
	if (jQuery(window).width() < 768) {
		setTimeout(function(){ 
	   		jQuery(".expand_options").trigger( "click" );
	   	}, 300);
	}
	
});