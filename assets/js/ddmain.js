'use strict';
!function ($) {
    /**
     * Js - Site Loader
     */
    $(window).load(function () {
        $(".page-loader").fadeOut("slow");
    });

    $(document).ready(function () {
        /**
         * Back to top
         */
        function setBacktoTop() {
            if ($(window).scrollTop() > 100) {
                $(".back-to-top").addClass("open");
            } else {
                $(".back-to-top").removeClass("open");
            }
        }
        /**
         * vedanta slider
         */
        var i;
        var n = $(".header");
        $(".module-hero");
        /** @type {boolean} */
        i = !!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        setBacktoTop();
        $(window).scroll(function () {
            setBacktoTop();
        });
        var thread_rows = $(".module-hero, .module, .module-sm, .module-xs, .background-side, .footer");
        thread_rows.each(function () {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
            }
        });
        $(".parallax").jarallax({
            speed: .7
        });

        /**
         * Product Zoom
         */
        if($(document).width()>=1051){
            $(".product-slider .slider-for .slider-item-for").zoom();  
        }             

        /**
         * Related Products
         */
        $('.related.products .products,.upsells.products .products').owlCarousel({
            pagination:false,
            navigation:true,
            rewind:true,
            items:4,
            navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            autoplay:2000,
            itemsDesktop : [1200,4],
            itemsDesktopSmall : [1199,3],
            itemsTablet : [991,3],
            itemsMobile : [767,2]
        });

        /**
         * widget_product_carousel
         */
        $('.widget_product_carousel .product_list_widget').owlCarousel({
            pagination:false,
            navigation:false,
            rewind:true,
            items:1,
            autoPlay:5000,
            itemsDesktop : [1200,1],
            itemsDesktopSmall : [1199,1],
            itemsTablet : [991,1],
            itemsMobile : [767,1]
        });        

        /**
         * Mega menu More Dropdown
         */
        $(document).ready(function(){
            if ($(document).width() >= 1530){
                var number_blocks =9;
                var count_block = $('.ved-header-menu .ved-main-megamenu .inner-nav > .menu-item');
                var moremenu = count_block.slice(number_blocks, count_block.length);
                moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
                $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            }
            if (($(document).width() >= 1340) && ($(document).width() <= 1529)){
                var number_blocks =8;
                var count_block = $('.ved-header-menu .ved-main-megamenu .inner-nav > .menu-item');
                var moremenu = count_block.slice(number_blocks, count_block.length);
                moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
                $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            }
            if ($(document).width() >= 1340){
                if((bigboData.headertype == 'h1')){
                    var number_blocks =8;
                    var count_block = $('.ved-header-menu .ved-main-megamenu .inner-nav > .menu-item');
                      var moremenu = count_block.slice(number_blocks, count_block.length);
                      moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
                      $('.view_menu').prepend('<a href="#"><span>More</span></a>');
                }              
            }
            if (($(document).width() >= 1200) && ($(document).width() <= 1339)){
                var number_blocks =6;
                var count_block = $('.ved-header-menu .ved-main-megamenu .inner-nav > .menu-item');
                var moremenu = count_block.slice(number_blocks, count_block.length);
                moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
                $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            };
            if (($(document).width() >= 1051) && ($(document).width() <= 1199)){
                var number_blocks =6;
                var count_block = $('.ved-header-menu .ved-main-megamenu .inner-nav > .menu-item');
                var moremenu = count_block.slice(number_blocks, count_block.length);
                moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
                $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            };
        });

        /**
         * Vegamenu More Dropdown
         */
        if(jQuery(window).width() >= 1530){
            var max_elem = 8; 
            var max_elem2 = 9;  
        }else if(jQuery(window).width() >= 1340){
            var max_elem = 8; 
            var max_elem2 = 7;  
        }else if(jQuery(window).width() >= 1200){
            var max_elem = 8;
            var max_elem2 = 7;   
        }else if(jQuery(window).width() >= 1051){
            var max_elem = 6; 
            var max_elem2 = 6;  
        }else{
              
        }
        var menu = $('.dddemo1 .vertical-megamenu .inner-nav > .menu-item');        
        if (menu.length > max_elem) {
            $('.dddemo1 .vertical-megamenu .inner-nav').append('<li class="menu-item"><a class="more-menu">More Categories<i class="ti-plus"></i></a></li>');
        }
        $('.dddemo1 .vertical-megamenu .inner-nav > .menu-item .more-menu').click(function() {
            if ($(this).hasClass('active')) {
                menu.each(function(j) {
                    if (j >= max_elem) {
                        $(this).slideUp(500);
                    }
                });
                $(this).removeClass('active');
              
                $('.dddemo1 .vertical-megamenu .inner-nav > .menu-item .more-menu').html('More Categories<i class="ti-plus"></i>');
            } else {
                menu.each(function(j) {
                    if (j >= max_elem) {
                        $(this).slideDown(500);
                    }
                });
                $(this).addClass('active');
                $('.dddemo1 .vertical-megamenu .inner-nav > .menu-item .more-menu').html('Less Categories<i class="ti-minus"></i>');
            }
        });        
        menu.each(function(j) {
            if (j >= max_elem) {
                $(this).css('display', 'none');
            }
        });

        //demo2
        var menu2 = $('.dddemo2 .vertical-megamenu .inner-nav > .menu-item,.dddemo3 .vertical-megamenu .inner-nav > .menu-item');
        if (menu2.length > max_elem2) {
            $('.dddemo2 .vertical-megamenu .inner-nav,.dddemo3 .vertical-megamenu .inner-nav').append('<li class="menu-item"><a class="more-menu">More Categories<i class="ti-plus"></i></a></li>');
        }
        $('.dddemo2 .vertical-megamenu .inner-nav > .menu-item .more-menu,.dddemo3 .vertical-megamenu .inner-nav > .menu-item .more-menu').click(function() {
            if ($(this).hasClass('active')) {
                menu2.each(function(j) {
                    if (j >= max_elem2) {
                        $(this).slideUp(500);
                    }
                });
                $(this).removeClass('active');
              
                $('.dddemo2 .vertical-megamenu .inner-nav > .menu-item .more-menu,.dddemo3 .vertical-megamenu .inner-nav > .menu-item .more-menu').html('More Categories<i class="ti-plus"></i>');
            } else {
                menu2.each(function(j) {
                    if (j >= max_elem2) {
                        $(this).slideDown(500);
                    }
                });
                $(this).addClass('active');
                $('.dddemo2 .vertical-megamenu .inner-nav > .menu-item .more-menu,.dddemo3 .vertical-megamenu .inner-nav > .menu-item .more-menu').html('Less Categories<i class="ti-minus"></i>');
            }
        });
        menu2.each(function(j) {
            if (j >= max_elem2) {
                $(this).css('display', 'none');
            }
        });

        /**
         * Wishlist Table Responsive
         */
        jQuery(".cart.wishlist_table").wrap("<div class='table-responsive custom-width'>");

        /**
         * bigbo portfolio
         */
        var f = $("#filters");
        var $container = $("#works-grid");
        var layout = "masonry";
        layout = $container.hasClass("works-grid-masonry") ? "masonry" : "fitRows";
        $("a", f).on("click", function () {
            var selector = $(this).attr("data-filter");
            return $(".current", f).removeClass("current"), $(this).addClass("current"), $container.isotope({
                filter: selector
            }), false;
        }).scroll();
        $(window).on("resize", function () {
            $container.imagesLoaded(function () {
                $container.isotope({
                    layoutMode: layout,
                    itemSelector: ".work-item"
                });
            });
        }).resize();
        $(window).on("resize", function () {
            setTimeout(function () {
                $(".post-masonry").masonry();
            }, 1E3);
        }).resize();

        /**
         * Lightbox
         */
        // $(".lightbox").magnificPopup({
        //     type: "image"
        // });

        /**
         * video background
         */
        $("body").fitVids();
        var wow = new WOW({
            mobile: false
        });
        wow.init();
        
        /**
         * Tooltip
         */
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: "hover"
            });
        });

        /**
         * One Page smoothscroll
         */
        $(".smoothscroll").on("click", function (event) {
            var target = this.hash;
            var $tar = $(target);
            $("html, body").stop().animate({
                scrollTop: $tar.offset().top - n.height()
            }, 600, "swing");
            event.preventDefault();
        });
        $('a[href="#top"]').on("click", function () {
            return $("html, body").animate({
                scrollTop: 0
            }, "slow"), false;
        });

        /**
         * Custom product shorting filter in shop page
         */
        $('.catalog-ordering .orderby .current-li a').html($('.catalog-ordering .orderby ul li.current a').html());
        $('.catalog-ordering .sort-count .current-li a').html($('.catalog-ordering .sort-count ul li.current a').html());

    });

/**
 * Cart Header
 */
$(document).ready(function () {       
    $(".cart-hover #open-cart").live('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".sub-cart-menu").first().stop(true, true).slideToggle();
    });
    $(".cats-menu-title").live('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".toggle-product-cats").first().stop(true, true).slideToggle();
    });

});
$(document).on("click", function () {
    $(".sub-cart-menu").slideUp();
});

/**
 * Resticate alphabet value in input type only allow number value
 */ 
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
    $(".ved-number-input").inputFilter(function (value) {
        return /^\d*$/.test(value);
    });


    $.HandleElement = $.HandleElement || {};
    $.HandleElement.$body = $(document.body);
    $.HandleElement.$window = $(window),
            /**
             * Change product quantity
             */
            $.HandleElement.productQuantity = function () {
                $.HandleElement.$body.on('click', '.quantity .increase, .quantity .decrease', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                            $qty = $this.siblings('.qty'),
                            current = parseInt($qty.val(), 10),
                            min = parseInt($qty.attr('min'), 10),
                            max = parseInt($qty.attr('max'), 10);

                    min = min ? min : 1;
                    max = max ? max : current + 1;

                    if ($this.hasClass('decrease') && current > min) {
                        $qty.val(current - 1);
                        $qty.trigger('change');
                    }
                    if ($this.hasClass('increase') && current < max) {
                        $qty.val(current + 1);
                        $qty.trigger('change');
                    }
                });
            };

    /**
     * Product instance search
     */
    $.HandleElement.instanceSearch = function () {

        if (bigboData.ajax_search != '1') {
            return;
        }

        var xhr = null,
                searchCache = {},
                $form = $('.header-main').find('.products-search');
        $('.search-limit').hide();

        $form.on('keyup', '.search-field', function (e) {
            var valid = false;

            if (typeof e.which == 'undefined') {
                valid = true;
            } else if (typeof e.which == 'number' && e.which > 0) {
                valid = !e.ctrlKey && !e.metaKey && !e.altKey;
            }

            if (!valid) {
                return;
            }

            if (xhr) {
                xhr.abort();
            }

            var $currentForm = $(this).closest('.products-search'),
                    $search = $currentForm.find('input.search-field');

            if ($search.val().length < 2) {
                $currentForm.removeClass('searching searched actived found-products found-no-product invalid-length');
            }

            search($currentForm);
        }).on('change', '#product_cat', function () {
            if (xhr) {
                xhr.abort();
            }

            var $currentForm = $(this).closest('.products-search');

            search($currentForm);
        }).on('focusout', '.search-field', function () {
            var $currentForm = $(this).closest('.products-search'),
                    $search = $currentForm.find('input.search-field');
            if ($search.val().length < 2) {
                $currentForm.removeClass('searching searched actived found-products found-no-product invalid-length');
            }
        });
        $(document).on('click', function (e) {
            if (!$form.hasClass('actived')) {
                return;
            }
            var target = e.target;

            if ($(target).closest('.products-search').length < 1) {
                $form.removeClass('searching searched actived found-products found-no-product invalid-length');
            }
        });
        /**
         * Private function for search
         */
        function search($currentForm) {
            var $search = $currentForm.find('input.search-field'),
                    keyword = $search.val(),
                    cat = 0,
                    $results = $('.ajax-search-results');

            if ($currentForm.find('#product_cat').length > 0) {
                cat = $currentForm.find('#product_cat').val();
            }


            if (keyword.length < 3) {
                $currentForm.removeClass('searching found-products found-no-product').addClass('invalid-length');
                $results.fadeOut();
                $('.search-limit').fadeIn();
                jQuery(document).click(function () {
                    jQuery('.search-limit,.ajax-search-results').fadeOut();
                });
                return;
            }
            jQuery(document).click(function () {
                jQuery('.search-limit,.ajax-search-results').fadeOut();
            });
            $(".product-extra-search").click(function(e){
              e.stopPropagation();
            });
            $currentForm.removeClass('found-products found-no-product').addClass('searching');
            $results.fadeIn();
            $('.search-limit').fadeOut();

            var keycat = keyword + cat;

            if (keycat in searchCache) {
                var result = searchCache[keycat];

                $currentForm.removeClass('searching');

                $currentForm.addClass('found-products');

                $results.html(result.products);

                $(document.body).trigger('bigbo_ajax_search_request_success', [$results]);

                $currentForm.removeClass('invalid-length');

                $currentForm.addClass('searched actived');
            } else {
                xhr = $.ajax({
                    url: bigboData.ajax_url,
                    dataType: 'json',
                    method: 'post',
                    data: {
                        action: 'bigbo_search_products',
                        nonce: bigboData.nonce,
                        term: keyword,
                        cat: cat,
                        search_type: bigboData.search_content_type
                    },
                    success: function (response) {
                        var $products = response.data;

                        $currentForm.removeClass('searching');


                        $currentForm.addClass('found-products');

                        $results.html($products);

                        $currentForm.removeClass('invalid-length');

                        $(document.body).trigger('bigbo_ajax_search_request_success', [$results]);

                        // Cache
                        searchCache[keycat] = {
                            found: true,
                            products: $products
                        };


                        $currentForm.addClass('searched actived');
                    }
                });
            }
        }
    };

    /**
     * Add wishlist
     */
    $.HandleElement.addWishlist = function () {
        $('ul.products li.product .yith-wcwl-add-button').on('click', 'a', function () {
            $(this).addClass('loading');
        });

        $.HandleElement.$body.on('added_to_wishlist', function () {
            $('ul.products li.product .yith-wcwl-add-button a').removeClass('loading');
        });

        // update wishlist count
        $.HandleElement.$body.on('added_to_wishlist removed_from_wishlist cart_page_refreshed', function () {
            $.ajax({
                url: bigboData.ajax_url,
                dataType: 'json',
                method: 'post',
                data: {
                    action: 'update_wishlist_count'
                },
                success: function (data) {
                    $('.top-bar').find('.menu-item-wishlist .mini-item-counter').html(data);
                }
            });
        });

    };

    /**
     * Shop view toggle (Shop Layout)
     */
    $.HandleElement.shopView = function () {

        $.HandleElement.$body.on('click', '.ved-shop-view', function (e) {
            e.preventDefault();
            var $el = $(this),
            view = $el.data('view');

            if ($el.hasClass('current')) {
                return;
            }

            $.HandleElement.$body.find('.ved-shop-view').removeClass('current');
            $el.addClass('current');
            $.HandleElement.$body.removeClass('shop-view-grid shop-view-list').addClass('shop-view-' + view);

            document.cookie = 'shop_view=shop-view-' + view;
        });
    };
    
    /**
     * Toggle product quick view
     */
    $.HandleElement.productQuickView = function () {
        var $modal = $('#ved-quick-view-modal'),
            $product = $modal.find('.product-modal-content');

        $.HandleElement.$body.on('click', '.open-quick-view', function (e) {
            e.preventDefault();

            var $a = $(this),
                id = $a.data('id');

            $product.html('');
            $modal.addClass('loading').removeClass('loaded');
            $modal.modal({ show: true }); 

            $.ajax({
                url: bigboData.ajax_url,
                dataType: 'json',
                method: 'post',
                data: {
                    action: 'bigbo_product_quick_view',
                    nonce: bigboData.nonce,
                    product_id: id
                },
                success: function (response) {
                    $product.append(response.data);
                    $modal.removeClass('loading').addClass('loaded'); 
                    if (!jQuery('body').hasClass("rtl")) {
                        $('#ved-quick-view-modal .slider-for').slick({
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          arrows: true,
                          fade: true,
                          asNavFor: '.slider-nav'
                        });
                        $('#ved-quick-view-modal .slider-nav').slick({
                          slidesToShow: 4,
                          slidesToScroll: 1,
                          asNavFor: '.slider-for',
                          arrows: true,
                          focusOnSelect: true
                        });
                    } else {         
                        jQuery("#ved-quick-view-modal .slider-nav,#ved-quick-view-modal .slider-for").attr("dir","rtl");
                        $('#ved-quick-view-modal .slider-for').slick({
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          arrows: true,
                          fade: true,
                          rtl: true,
                          asNavFor: '.slider-nav'
                        });
                        $('#ved-quick-view-modal .slider-nav').slick({
                          slidesToShow: 4,
                          slidesToScroll: 1,
                          asNavFor: '.slider-for',
                          arrows: true,
                          rtl: true,
                          focusOnSelect: true
                        });
                    }
                    $('#ved-quick-view-modal .slider-for,#ved-quick-view-modal .slider-nav').resize();
                }
            });
        });

    };

    /**
     * Show the message on add to cart
     */
    $.HandleElement.addtocartMsg = function () {

        $.HandleElement.$body.on('added_to_cart', function (e, fragments, cart_hash, $button) {
            $button = typeof $button === 'undefined' ? false : $button;

            if ( $button ) {
                $("body").append( "<div class='cart-alert'><p>Product successfully added to your cart.</p></div>" ).fadeIn();
                $(".cart-alert").addClass("loaded");
                setTimeout(function(){  jQuery(".cart-alert").fadeOut(); }, 3000);
            }

        });
    };

    /**
     * Newsletter popup
     */
    $.HandleElement.newLetterPopup = function () {
        var $modal = $('#ddPopupnewsletter'),
            days = 15;
    
        if ($modal.length < 1) {
            return;
        }

        $.HandleElement.$window.on('load', function () {
            setTimeout(function(){
                $modal.modal({
                    show: true
                });
            }, 5000);
        });

        $modal.on('click', '.newsletter_show_again', function (e) {
            e.preventDefault();
            $(this).toggleClass("checked");
            var check = $(this).hasClass("checked");
            if(check){                
                closeNewsLetter(days);
            } else {
                closeNewsLetter(0);
            }
        });

        $modal.find('.mc4wp-form').submit(function () {
            closeNewsLetter(days);
        });

        function closeNewsLetter(days) {
            var date = new Date(),
                value = date.getTime();

            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));

            document.cookie = 'ved_newletter=' + value + ';expires=' + date.toGMTString() + ';path=/';
        }
    };

    $.HandleElement.init = function () {
        $.HandleElement.productQuantity();
        $.HandleElement.instanceSearch();
        $.HandleElement.addWishlist();
        $.HandleElement.shopView();
        $.HandleElement.productQuickView();
        $.HandleElement.addtocartMsg();
        $.HandleElement.newLetterPopup();
    };
    $(document).ready($.HandleElement.init);

}(jQuery);

/**
 * Ajax delete product in the cart
 */
jQuery(document).on('click', '.list-product a.remove', function (e)
{
    e.preventDefault();

    var product_id = jQuery(this).attr("data-product_id"),
            cart_item_key = jQuery(this).attr("data-cart_item_key"),
            product_container = jQuery(this).parents('.mini_cart_item');

    // Add loader
    product_container.block({
        message: null,
        overlayCSS: {
            cursor: 'none'
        }
    });

    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: "product_remove",
            product_id: product_id,
            cart_item_key: cart_item_key
        },
        success: function (response) {
            if (!response || response.error)
                return;

            var fragments = response.fragments;

            // Replace fragments
            if (fragments) {
                jQuery.each(fragments, function (key, value) {
                    jQuery(key).replaceWith(value);
                });
            }
            
            // Update cart
            jQuery( document.body ).trigger( 'wc_update_cart' );
        }
    });
});

/**
 * dropdown smooth
 */
jQuery('.dropdown').on('show.bs.dropdown', function (e) {
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
});

jQuery('.dropdown').on('hide.bs.dropdown', function (e) {
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
});

/**
 * Universal script for moving elements in DOM
 */
!function ($) {
    var windowWidth = $(window).innerWidth();
    var windowMinWidth = 1051;
    var windowResponsiveMobile = windowWidth < windowMinWidth;

    function swapChildren(obj1, obj2)
    {
        var temp = obj2.children().detach();
        obj2.empty().append(obj1.children().detach());
        obj1.append(temp);
    }

    function toggleMobileStyles()
    {
        if (windowResponsiveMobile) {
            $("[id^='_desktop_']").each(function (idx, el) {
                var target = $('#' + el.id.replace('_desktop_', '_mobile_'));
                if (target.length) {
                    swapChildren($(el), target);
                }
            });
        } else {
            $("[id^='_mobile_']").each(function (idx, el) {
                var target = $('#' + el.id.replace('_mobile_', '_desktop_'));
                if (target.length) {
                    swapChildren($(el), target);
                }
            });
        }
    }

    $(window).on('resize', function () {
        var _cw = windowWidth;
        var _mw = windowMinWidth;
        var _w = $(window).innerWidth();
        var _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
        windowWidth = _w;
        windowResponsiveMobile = windowWidth < windowMinWidth;
        if (_toggle) {
            toggleMobileStyles();
        }
    });

    $(document).ready(function () {
        if (windowResponsiveMobile) {
            toggleMobileStyles();
        }
    });
    
    		/*************************
		:: Product Load More
		*************************/
		
		jQuery('.product-more-button a').on('click', function(e) {
		    e.preventDefault();
			var more_btn     = this;
			var next_link    = $(this).data( 'next_link' );
			var max_pages    = $(this).data( 'max_pages' );
			var current_page = $(this).data( 'current_page' );
			var next_page    = $(this).data( 'next_page' );
			
			// Disable button click if loaded all pages and added disabled class
			if( $(more_btn).hasClass( 'disabled' ) ){
				return;
			}

			// Call ajax to fetch data
			$.ajax({
				url: next_link,
				beforeSend: function( xhr ) {
					$(more_btn).html('Loading....');
					$(more_btn).addClass('content-loading');
				}
			})
			.done(function( data ) {
				
				$(more_btn).removeClass('content-loading');
				// Load data in temp
				var temp = $(data);
			
				// Get button from ajax data
				var next_btn = temp.find('.product-more-button').html();
				var products = temp.find('ul.products-loop');

				// Get button data from button in returned data
				var next_btn_link         = $( next_btn ).data('next_link');
				var next_btn_max_pages    = $( next_btn ).data('max_pages');
				var next_btn_next_page    = $( next_btn ).data('next_page');
				var next_btn_current_page = $( next_btn ).data('current_page');
				
				// Check if current page count is less than max page count
				if( next_btn_current_page < next_btn_max_pages ){

					// Set 'Load more...' back after ajax completed
					$( more_btn ).html('Load more...');

					// Set returned button data to button
					$( more_btn ).data( 'next_link', next_btn_link);
					$( more_btn ).data( 'max_pages', next_btn_max_pages);
					$( more_btn ).data( 'next_page', next_btn_next_page);
					$( more_btn ).data( 'current_page', next_btn_current_page);
				}else{
					$( more_btn ).html('No more product to load').addClass( 'disabled' );
				}
				
				// Append the new data to product
				$( 'li.product' ).last().after( products.html() );
				
				// Set the grid column 
				product_grid_set();
				bigbo_lazyload();
				
			})
		});
        
                /****************************
		:: Product Infinit Scroll 
		****************************/
		
		var counter = 1;
		jQuery( window ).scroll(function() {
			if( $('.product-infinite_scroll').length > 0 ){
				var load_more_button = $('.product-more-button a');
				
				var scrollHeight = Math.round( load_more_button.offset().top );
				var scrollOuterHeight = load_more_button.height();
				var scrollPosition = $(window).height() + $(window).scrollTop();
				var total = load_more_button.data('current_page');
				
				if ( scrollPosition > scrollHeight + scrollOuterHeight ) {
					setTimeout(function () {				
						if( total == counter ){
							if(!load_more_button.hasClass('content-loading')){
								counter++;
								load_more_button.trigger( 'click' );
							}
						}
					}, 200);
				}
			}
		});
                
                /* ---------------------------------------------
		 :: Cookies info
		 --------------------------------------------- */
		bigbo_cookiesinfo();
		function bigbo_cookiesinfo(){
			if( Cookies.get('bigbo_cookies') == 'accepted' ){
				$('.bigbo-cookies-info').hide();
				return;
			}

			$( '.bigbo-cookies-info' ).on('click', '.cookies-info-accept-btn', function(e) {
				e.preventDefault();
				bigbo_acceptCookies();
			});
			var bigbo_acceptCookies = function() {
				$('.bigbo-cookies-info').hide();
				Cookies.set('bigbo_cookies', 'accepted', { expires: 60, path: '/' } );
			};
		}
                
                /****************************
		:: Commingsoon countdown
		******************************/
		if( $(".commingsoon_countdown").length != 0 ) {
			var ved_countdown      = $('.commingsoon_countdown'),
				ved_countdown_date = $(ved_countdown).data('countdown_date'),
				ved_counter_data   = $(ved_countdown).data('counter_data');

			$('.commingsoon_countdown').countdown( ved_countdown_date )
				.on('update.countdown', function(event) {
					var format = '';

					var display_weeks = false;

					if( display_weeks ){
						if(event.offset.weeks > 0) {
							format = format + '<li><span class="days">%-w</span><p class="days_ref">'+ved_counter_data.weeks+'</p></li>';
						}
						if(event.offset.totalDays > 0) {
							format = format + '<li><span class="days">%-d</span><p class="days_ref">'+ved_counter_data.days+'</p></li>';
						}
					}else{
						if(event.offset.totalDays > 0) {
							format = format + '<li><span class="days">%-D</span><p class="days_ref">'+ved_counter_data.days+'</p></li>';
						}
					}

					format = format + '<li><span class="hours">%H</span><p class="hours_ref">'+ved_counter_data.hours+'</p></li>';
					format = format + '<li><span class="minutes">%M</span><p class="minutes_ref">'+ved_counter_data.minutes+'</p></li>';
					format = format + '<li><span class="seconds">%S</span><p class="seconds_ref">'+ved_counter_data.seconds+'</p></li>';

					ved_countdown.html(event.strftime(format));
				});
		}

}(jQuery);


/**
 * Init Accordian
 */
var responsiveflag = false;

jQuery(document).ready(function () {
    responsiveResize();
    //jQuery(window).resize(responsiveResize);
});
function responsiveResize()
{
    if (jQuery(window).width() <= 991 && responsiveflag == false)
    {
        accordion('enable');
        responsiveflag = true;
    } else if (jQuery(window).width() >= 992)
    {
        accordion('disable');
        responsiveflag = false;
    }
}
function accordion(status)
{
    if (status == 'enable')
    {
        var accordion_selector = '.footer-center .widget_nav_menu .text-title,.footer-center .contact_info .text-title,.sidebar .widget-content .text-title';

        jQuery(accordion_selector).on('click', function (e) {
            jQuery(this).toggleClass('active').next().stop().slideToggle('medium');
            e.preventDefault();
        });
        jQuery(accordion_selector).next().slideUp('fast');
    } else
    {
        jQuery('.footer-center .widget_nav_menu .text-title,.footer-center .contact_info .text-title,.sidebar .widget-content .text-title').removeClass('active').off().next().removeAttr('style').slideDown('fast');
    }
}

/**
 * Mobile header
 */
jQuery(document).ready(function(){
    jQuery("#menu-icon").on("click", function() {
        jQuery("html").addClass('sidebar-open'), jQuery('#header').addClass('toggle')
    })
    jQuery(".close-sidebar").click(function() {
        jQuery("html").removeClass('sidebar-open');
        jQuery('#header').removeClass('toggle');
    });
    setTimeout(function(){  
        jQuery(".sidebar-overlay").click(function() {
            jQuery("html").removeClass('sidebar-open');
            jQuery('#header').removeClass('toggle');
        });   
    }, 300);
    jQuery("#header .inner-nav .has-submenu > a").append("<span class='icon-drop-mobile'></span>");
    jQuery(document).on('click', '#mobile_top_menu_wrapper .inner-nav .has-submenu > a', function () {
        jQuery(this).next().first().stop(true, true).slideToggle();
    });
    vegamenuposition();
});
function vegamenuposition(){
    if(jQuery(document).width()<=1050){
        jQuery("#mobile_top_menu_wrapper .menu-vertical .menu-tit").click(function(){
            jQuery("#mobile_top_menu_wrapper #_mobile_menu").slideUp();
            jQuery(this).next().slideDown();
        });
        jQuery("#mobile_top_menu_wrapper .menu-horizontal .menu-tit").click(function(){
            jQuery(this).next().slideDown();
            jQuery("#mobile_top_menu_wrapper #_mobile_vmenu").slideUp();
        });
    }
}

/**
 * Slide Toggle
 */
jQuery(".slidetoggle-init").click(function(){
  jQuery(this).parent().find(".slidetoggle-menu").slideToggle();
});
jQuery(".language#drop > a").click(function(e){
    e.stopPropagation();
    jQuery(this).next().slideToggle();
});

/**
 * Mobile Filter Toggle
 */
jQuery("body").on("click", "#pro_filter_toggler", function() {
    jQuery("body").toggleClass("filter-open");
})

/**
 * Compare Color Box Open
 */
jQuery(document).bind('cbox_open', function(){
  jQuery("body").addClass("colorbox-open");
});
jQuery(document).bind('cbox_closed', function(){
  jQuery("body").removeClass("colorbox-open");
});

/**
 * Product Slider
 */
jQuery(document).ready(function(){

    if (!jQuery('body').hasClass("rtl")) {
        jQuery('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: true,
          asNavFor: '.slider-nav'
        });
        jQuery('.slider-nav').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          arrows: true,
          focusOnSelect: true
        });
    } else {         
        jQuery(".slider-for,.slider-nav").attr("dir","rtl");
        jQuery('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: true,
          rtl: true,
          asNavFor: '.slider-nav'
        });
        jQuery('.slider-nav').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          arrows: true,
          rtl: true,
          focusOnSelect: true
        });
    }
});

/**
 * contact form 7 on submit hide message
 */
document.addEventListener( 'wpcf7submit', function( event ) {   
    setTimeout(function(){  jQuery(".wpcf7-response-output").fadeOut();jQuery(".wpcf7-response-output").removeClass("loaded"); }, 3000);
}, false );

/**
 * mailchimp on submit hide message
 */
jQuery(document).ready(function(){
    setTimeout(function(){  jQuery(".mc4wp-response").fadeOut(); }, 5000);
});    

/**
 * Fix for form without action
 */
var topbar_currency_switcher_form = document.querySelector(".topbar_item.topbar_item_type-currency .woocommerce-currency-switcher-form");
if(topbar_currency_switcher_form != null){
	topbar_currency_switcher_form.setAttribute("action", "");
}

function product_grid_set(){
	if( jQuery( 'ul.products-loop' ).hasClass('grid') ){
		var index = 0;
		var column = jQuery( 'ul.products-loop' ).data('column');
		
		jQuery( 'ul.products-loop' ).find('li').each( function() {
			index++;
			if(jQuery(this).hasClass('first')){
				jQuery(this).removeClass('first');
			}else if(jQuery(this).hasClass('last')){
				jQuery(this).removeClass('last');
			}
			
			if( column == index ){
				jQuery(this).addClass('last');
				index = 0;
			}else if( index == 1 ){
				jQuery(this).addClass('first');
			}
		});
	}
}

function bigbo_lazyload() {
	if(jQuery('.bigbo-lazy-load').length) {
		jQuery('.bigbo-lazy-load').lazy({
			afterLoad: function(element) {
				// called after an element was successfully handled
				element.removeClass('bigbo-lazy-load');
				element.addClass('bigbo-loaded');				
			}
		});
	}
}