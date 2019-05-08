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
         * @return {undefined}
         */
        function setBacktoTop() {
            if ($(window).scrollTop() > 100) {
                $(".back-to-top").addClass("open");
            } else {
                $(".back-to-top").removeClass("open");
            }
        }
        /**
         * @return {undefined}
         */
        function setColorMenu() {
            if ($(window).scrollTop() > 10) {
                n.addClass("header-small");
                $(".header-fixed").removeClass("header-transparent");
            } else {
                n.removeClass("header-small");
                $(".header-fixed").addClass("header-transparent");
            }
        }
        /**
         * @return {undefined}
         */
        var i;
        var n = $(".header");
        $(".module-hero");
        /** @type {boolean} */
        i = !!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        setColorMenu();
        setBacktoTop();
        $(window).scroll(function () {
            setColorMenu();
            setBacktoTop();
        });
        $(".nav-icon-toggle").on("click", function () {
            $(this).toggleClass("open");
        });
        $(document).on("click", ".main-nav.in", function (jEvent) {
            if ($(jEvent.target).is("a") && !$(jEvent.target).parent().hasClass("has-submenu")) {
                $(this).collapse("hide");
                $(".nav-icon-toggle").toggleClass("open");
            }
        });

        var thread_rows = $(".module-hero, .module, .module-sm, .module-xs, .background-side, .footer");
        thread_rows.each(function () {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
            }
        });
//        $("#modal-search, .form-close-btn").on("click", function () {
//            return $(".header-search-form").toggleClass("opened"), false;
//        });
        $(".parallax").jarallax({
            speed: .7
        });
        $(".product-slider .slider-for .slider-item-for").zoom();
        $(".images-carousel").each(function () {
            $(this).owlCarousel($.extend({
                stopOnHover: true,
                navigation: false,
                pagination: true,
                autoPlay: 3e3,
                items: 5,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            }, $(this).data("carousel-options")));
        });
        $(".box-carousel").each(function () {
            $(this).owlCarousel($.extend({
                stopOnHover: true,
                navigation: false,
                pagination: true,
                autoPlay: 3e3,
                items: 3,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            }, $(this).data("carousel-options")));
        });
        $(".clients-carousel").each(function () {
            $(this).owlCarousel($.extend({
                navigation: false,
                pagination: false,
                autoPlay: 3e3,
                items: 6,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            }, $(this).data("carousel-options")));
        });
        $(".image-slider").each(function () {
            $(this).owlCarousel($.extend({
                stopOnHover: true,
                navigation: true,
                pagination: true,
                autoPlay: 3E3,
                singleItem: true,
                items: 1,
                navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            }, $(this).data("carousel-options")));
        });
        $(".slider-testimonial").owlCarousel({
            paginationSpeed: 400,
            slideSpeed: 300,
            navigation: true,
            pagination: true,
            singleItem: true,
            transitionStyle: "backSlide",
            navigationText: ['<i class="icon-arrow-left icons"></i>', '<i class="icon-arrow-right icons"></i>']
        });
        //Related Products
        $('.related.products .products').owlCarousel({
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

        //widget_product_carousel
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

        //Mega menu More Dropdown
        $(document).ready(function(){
            if ($(document).width() >= 1340){
                if (dayneoData.headerbar_on == '1') {
                    var number_blocks =5;
                }else{
                    var number_blocks =7;
                }
              var count_block = $('.ved-main-megamenu .inner-nav > .menu-item');
              var moremenu = count_block.slice(number_blocks, count_block.length);
              moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
              $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            }
            if (($(document).width() >= 1051) && ($(document).width() <= 1339)){
              var number_blocks = 6;
              var count_block = $('.ved-main-megamenu .inner-nav > .menu-item');
              var moremenu = count_block.slice(number_blocks, count_block.length);
              moremenu.wrapAll('<li class="view_menu menu-item has-submenu menu-item-has-children ved-dropdown-menu"><ul class="sub-menu">');
              $('.view_menu').prepend('<a href="#"><span>More</span></a>');
            };
        });

        //Vegamenu More Dropdown
        if(jQuery(window).width() >= 1340){
            var max_elem = 8;   
        }else if(jQuery(window).width() >= 1200){
            var max_elem = 8;   
        }else if(jQuery(window).width() >= 1051){
            var max_elem = 6;   
        }else{
              
        }
        var menu = $('.vertical-megamenu .inner-nav > .menu-item');
        if (menu.length > max_elem) {
            $('.vertical-megamenu .inner-nav').append('<li class="menu-item"><a class="more-menu">More Categories<i class="ti-plus"></i></a></li>');
        }
        $('.vertical-megamenu .inner-nav > .menu-item .more-menu').click(function() {
            if ($(this).hasClass('active')) {
                menu.each(function(j) {
                    if (j >= max_elem) {
                        $(this).slideUp(500);
                    }
                });
                $(this).removeClass('active');
              
                $('.vertical-megamenu .inner-nav > .menu-item .more-menu').html('More Categories<i class="ti-plus"></i>');
            } else {
                menu.each(function(j) {
                    if (j >= max_elem) {
                        $(this).slideDown(500);
                    }
                });
                $(this).addClass('active');
                $('.vertical-megamenu .inner-nav > .menu-item .more-menu').html('Less Categories<i class="ti-minus"></i>');
            }
        });
        menu.each(function(j) {
            if (j >= max_elem) {
                $(this).css('display', 'none');
            }
        });

        //Wishlist Table Responsive
        jQuery(".cart.wishlist_table").wrap("<div class='table-responsive custom-width'>");

        //dayneo portfolio
        var f = $("#filters");
        var $container = $("#works-grid");
        /** @type {string} */
        var layout = "masonry";
        /** @type {string} */
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

        //ved-progress-bar
        $(".progress-bar").each(function () {
            $(this).appear(function () {
                var spy1 = $(this).attr("aria-valuenow");
                $(this).animate({
                    width: spy1 + "%"
                });
                $(this).parent(".progress").prev(".ved-progress-title").find("span span").countTo({
                    from: 0,
                    to: spy1,
                    speed: 900,
                    refreshInterval: 30
                });
            });
        });

        $(".counter-timer").each(function () {
            $(this).appear(function () {
                var jid = $(this).attr("data-to");
                $(this).countTo({
                    from: 0,
                    to: jid,
                    speed: 1500,
                    refreshInterval: 10,
                    formatter: function (t, data) {
                        return t = t.toFixed(data.decimals), t = t.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                });
            });
        });
        $(".chart").each(function () {
            $(this).appear(function () {
                $(this).easyPieChart($.extend({
                    barColor: "#222222",
                    trackColor: "#eeeeee",
                    scaleColor: false,
                    lineCap: "square",
                    lineWidth: 3,
                    size: 180
                }, $(this).data("chart-options")));
            });
        });
        $(".lightbox").magnificPopup({
            type: "image"
        });

//	$(".gallery").each(function () {
//	    $(this).magnificPopup({
//		delegate: "a",
//		type: "image",
//		gallery: {
//		    enabled: true,
//		    navigateByImgClick: true,
//		    preload: [0, 1]
//		},
//		image: {
//		    titleSrc: "title",
//		    tError: "The image could not be loaded."
//		},
//		zoom: {
//		    enabled: true,
//		    duration: 300
//		}
//	    });
//	});
//	
//	$(window).on("resize", function () {
//	    $(".gallery").imagesLoaded(function () {
//		$(".gallery").isotope({
//		    layoutMode: "fitRows",
//		    itemSelector: ".gallery-item"
//		});
//	    });
//	}).resize();
//	$(".video-pop-up").magnificPopup({
//	    type: "iframe"
//	});

        $("body").fitVids();
        var wow = new WOW({
            mobile: false
        });
        wow.init();
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: "hover"
            });
        });
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
         * https://github.com/woocommerce/FlexSlider
         * 
         */
        var js_local_vars = '';
        $(".flexslider").flexslider({
            slideshow: js_local_vars.slide_auto_play,
            slideshowSpeed: js_local_vars.slide_show_speed,
            animation: js_local_vars.slide_animation,
            animationSpeed: js_local_vars.slide_animation_speed,
            directionNav: js_local_vars.slide_nav_arrows,
            controlNav: js_local_vars.slide_pagination_circles,
            video: true,
            prevText: '<i class="icon-arrow-left icons"></i>',
            nextText: '<i class="icon-arrow-right icons"></i>',
            before: function (slider) {
                $(".hero-caption").fadeOut().animate({
                    top: "-80px"
                }, {
                    queue: false,
                    easing: "swing",
                    duration: 700
                });
                slider.slides.eq(slider.currentSlide).delay(500);
                slider.slides.eq(slider.animatingTo).delay(500);
            },
            after: function (inRangeAlready) {
                $(".hero-caption").fadeIn().animate({
                    top: "0"
                }, {
                    queue: false,
                    easing: "swing",
                    duration: 700
                });
            },
            useCSS: true
        });

        // JS - Custom product shorting filter in shop page
        $('.catalog-ordering .orderby .current-li a').html($('.catalog-ordering .orderby ul li.current a').html());
        $('.catalog-ordering .sort-count .current-li a').html($('.catalog-ordering .sort-count ul li.current a').html());

    });

    

    // position mega menu correctly
    $.fn.ved_position_megamenu = function (variables) {

        var reference_elem = '';
        if ($('.header_v4').length) {
            reference_elem = $(this).parent().parent('nav').parent();
        } else if ($('.main-nav').length) {
            reference_elem = $('header .container');
        } else {
            reference_elem = $(this).parent().parent('nav');
        }

        if ($(this).parent().parent('nav').length) {

            var main_nav_container = reference_elem,
                    main_nav_container_position = main_nav_container.offset(),
                    main_nav_container_width = main_nav_container.width(),
                    main_nav_container_left_edge = main_nav_container_position.left,
                    main_nav_container_right_edge = main_nav_container_left_edge + main_nav_container_width;

            $('.ved-navbar-nav .ved-megamenu-menu').mouseenter(function () {
                var li_item = $(this),
                        li_item_position = li_item.position(),
                        megamenu_wrapper = li_item.find('.ved-megamenu-wrapper'),
                        megamenu_wrapper_width = megamenu_wrapper.outerWidth(),
                        megamenu_wrapper_position = 0;

                //check if there is a megamenu
                if (megamenu_wrapper.length) {
                    megamenu_wrapper.removeAttr('style');

                    if ($('.sticky-header').hasClass('sticky')) {
                        /* add mega-menu effect to stickyheader */
                        var main_stickynav_container_width = $('.sticky-menu')[0].getBoundingClientRect().width;

                        if (megamenu_wrapper_width < main_stickynav_container_width) {

                            if (megamenu_wrapper_width < (main_stickynav_container_width - li_item_position.left)) {
                                megamenu_wrapper_position = '';
                                megamenu_wrapper.css('left', megamenu_wrapper_position);
                            } else if (megamenu_wrapper_width > (main_stickynav_container_width - li_item_position.left)) {
                                megamenu_wrapper.css('right', '0');
                            }

                        } else {
                            if ($('#sticky-logo').length) {
                                var stickylogoWidth = $('#sticky-logo')[0].getBoundingClientRect().width;
                                var stickylogoactualwidth = '-' + (stickylogoWidth + 15) + 'px';
                                $('#header.sticky-header .ved-megamenu-wrapper').css('left', stickylogoactualwidth);
                            } else {
                                $('#header.sticky-header .ved-megamenu-wrapper').css('left', '-15px');
                            }
                        }

                    } else if ($('.headerbar').length) {
                        if (megamenu_wrapper_width < main_nav_container_width) {
                            var main_halfnav_container_width = $('.headerbar')[0].getBoundingClientRect().width;

                            if (megamenu_wrapper_width < (main_halfnav_container_width - li_item_position.left)) {
                                megamenu_wrapper_position = '';
                                megamenu_wrapper.css('left', megamenu_wrapper_position);
                            } else if (megamenu_wrapper_width > (main_halfnav_container_width - li_item_position.left)) {
                                megamenu_wrapper.css('right', '0');
                            }

                        } else {
                            var headerlogoWidth = $('.logobar')[0].getBoundingClientRect().width;
                            var headerlogoactualWidth = '-' + (headerlogoWidth + 30) + 'px';
                            $('.ved-megamenu-wrapper').css('left', headerlogoactualWidth);
                        }
                    } else {
                        if (megamenu_wrapper_width < main_nav_container_width) {

                            if (megamenu_wrapper_width < (main_nav_container_width - li_item_position.left)) {
                                megamenu_wrapper_position = '';
                                megamenu_wrapper.css('left', megamenu_wrapper_position);
                            } else if (megamenu_wrapper_width > (main_nav_container_width - li_item_position.left)) {
                                megamenu_wrapper.css('right', '0');
                            }

                        } else {
                            if ($('.header_v0').length) {
                                megamenu_wrapper.css('left', '-15px');
                            } else {
                                megamenu_wrapper.css('left', '0');
                            }
                        }
                    }
                }
            });
        }
    };

// Activates the mega menu

    if ($.fn.ved_position_megamenu) {
        $('.ved-navbar-nav').ved_position_megamenu();
        $('.ved-navbar-nav .ved-megamenu-menu').mouseenter(function () {
            $(this).parent().ved_position_megamenu();
        });
    }

// For Onclick open cart on header area
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

// Resticate alphabet value in input type only allow number value
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

        if (dayneoData.ajax_search != '1') {
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
            $currentForm.removeClass('found-products found-no-product').addClass('searching');
            $results.fadeIn();
            $('.search-limit').fadeOut();

            var keycat = keyword + cat;

            if (keycat in searchCache) {
                var result = searchCache[keycat];

                $currentForm.removeClass('searching');

                $currentForm.addClass('found-products');

                $results.html(result.products);

                $(document.body).trigger('dayneo_ajax_search_request_success', [$results]);

                $currentForm.removeClass('invalid-length');

                $currentForm.addClass('searched actived');
            } else {
                xhr = $.ajax({
                    url: dayneoData.ajax_url,
                    dataType: 'json',
                    method: 'post',
                    data: {
                        action: 'dayneo_search_products',
                        nonce: dayneoData.nonce,
                        term: keyword,
                        cat: cat,
                        search_type: dayneoData.search_content_type
                    },
                    success: function (response) {
                        var $products = response.data;

                        $currentForm.removeClass('searching');


                        $currentForm.addClass('found-products');

                        $results.html($products);

                        $currentForm.removeClass('invalid-length');

                        $(document.body).trigger('dayneo_ajax_search_request_success', [$results]);

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
                url: dayneoData.ajax_url,
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
     * Shop view toggle
     */
    $.HandleElement.shopView = function () {

        $.HandleElement.$body.on('click', '.dd-shop-view', function (e) {
            e.preventDefault();
            var $el = $(this),
            view = $el.data('view');

            if ($el.hasClass('current')) {
                return;
            }

            $.HandleElement.$body.find('.dd-shop-view').removeClass('current');
            $el.addClass('current');
            $.HandleElement.$body.removeClass('shop-view-grid shop-view-list').addClass('shop-view-' + view);

            document.cookie = 'shop_view=shop-view-' + view;
        });
    };
    
        /**
     * Toggle product quick view
     */
    $.HandleElement.productQuickView = function () {
        var $modal = $('#mf-quick-view-modal'),
            $product = $modal.find('.product-modal-content');

        $.HandleElement.$body.on('click', '.mf-product-quick-view', function (e) {
            e.preventDefault();

            var $a = $(this),
                id = $a.data('id');

            $product.hide().html('');
            $modal.addClass('loading').removeClass('loaded');
            $.HandleElement.openModal($modal);

            $.ajax({
                url: dayneoData.ajax_url,
                dataType: 'json',
                method: 'post',
                data: {
                    action: 'martfury_product_quick_view',
                    nonce: dayneoData.nonce,
                    product_id: id
                },
                success: function (response) {
                    $product.show().append(response.data);
                    $modal.removeClass('loading').addClass('loaded');
                    var $gallery = $product.find('.woocommerce-product-gallery'),
                        $variation = $('.variations_form'),
                        $buttons = $product.find('form.cart .actions-button'),
                        $buy_now = $buttons.find('.buy_now_button');
                    $gallery.removeAttr('style');
                    $gallery.find('img.lazy').lazyload().trigger('appear');
                    $gallery.imagesLoaded(function () {
                        $gallery.find('.woocommerce-product-gallery__wrapper').not('.slick-initialized').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: false,
                            prevArrow: '<span class="icon-chevron-left slick-prev-arrow"></span>',
                            nextArrow: '<span class="icon-chevron-right slick-next-arrow"></span>'
                        });
                    });

                    if ($buy_now.length > 0) {
                        $buttons.prepend($buy_now);
                    }

                    $gallery.find('.woocommerce-product-gallery__image').on('click', function (e) {
                        e.preventDefault();
                    });

                    if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                        $variation.each(function () {
                            $(this).wc_variation_form();
                        });
                    }

                    if (typeof $.fn.tawcvs_variation_swatches_form !== 'undefined') {
                        $variation.tawcvs_variation_swatches_form();
                    }

                    $.HandleElement.productVatiation();
                    if (typeof tawcvs !== 'undefined') {
                        if (tawcvs.tooltip === 'yes') {
                            $variation.find('.swatch').tooltip({
                                classes: {'ui-tooltip': '$.HandleElement-tooltip'},
                                tooltipClass: '$.HandleElement-tooltip qv-tool-tip',
                                position: {my: 'center bottom', at: 'center top-13'},
                                create: function () {
                                    $('.ui-helper-hidden-accessible').remove();
                                }
                            });
                        }
                    }

                    $product.find('.compare').tooltip({
                        content: function () {
                            return $(this).html();
                        },
                        classes: {'ui-tooltip': '$.HandleElement-tooltip'},
                        tooltipClass: '$.HandleElement-tooltip qv-tooltip',
                        position: {my: 'center bottom', at: 'center top-13'},
                        create: function () {
                            $('.ui-helper-hidden-accessible').remove();
                        }
                    });

                    $product.find('[data-rel=tooltip]').tooltip({
                        classes: {'ui-tooltip': '$.HandleElement-tooltip'},
                        tooltipClass: '$.HandleElement-tooltip qv-tooltip',
                        position: {my: 'center bottom', at: 'center top-13'},
                        create: function () {
                            $('.ui-helper-hidden-accessible').remove();
                        }
                    });

                    $.HandleElement.buyNow();
                }
            });
        });

        $modal.on('click', '.close-modal, .mf-modal-overlay', function (e) {
            e.preventDefault();
            $.HandleElement.closeModal($modal);
        })

    };
    
        /**
     * Open modal
     *
     * @param $modal
     */
    $.HandleElement.openModal = function ($modal) {
        $modal.fadeIn();
        $modal.addClass('open');
    };

    /**
     * Close modal
     */
    $.HandleElement.closeModal = function ($modal) {
        $modal.fadeOut(function () {
            $(this).removeClass('open');
        });
    };
    
    /**
     * Shop view toggle
     */
    $.HandleElement.addtocartMsg = function () {

        $.HandleElement.$body.on('added_to_cart', function (e, fragments, cart_hash, $button) {
            $button = typeof $button === 'undefined' ? false : $button;

            if ( $button ) {
                    $button.after( "<p>Product successfully added to your cart.</p>" );
            }
        });
    };

    $.HandleElement.init = function () {
        $.HandleElement.productQuantity();
        $.HandleElement.instanceSearch();
        $.HandleElement.addWishlist();
        $.HandleElement.shopView();
        $.HandleElement.addtocartMsg();
        $.HandleElement.productQuickView();
    };
    $(document).ready($.HandleElement.init);

}(jQuery);

// Ajax delete product in the cart
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

//dropdown smooth
jQuery('.dropdown').on('show.bs.dropdown', function (e) {
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
});

jQuery('.dropdown').on('hide.bs.dropdown', function (e) {
    jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
});


/*=============Universal script for moving elements in DOM============*/
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
}(jQuery);

/*=============Init Accordian============*/
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

/*=============Mobile header============*/
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
    jQuery(document).on('click', '#header .inner-nav .icon-drop-mobile', function () {
        jQuery(this).parent().next().first().stop(true, true).slideToggle();
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

/*=============Slide Toggle============*/
jQuery(".slidetoggle-init").click(function(){
  jQuery(this).parent().find(".slidetoggle-menu").slideToggle();
});

/*=============Mobile Filter Toggle============*/
jQuery("body").on("click", "#pro_filter_toggler", function() {
    jQuery("body").toggleClass("filter-open");
})

/*=============Compare Color Box Open============*/
jQuery(document).bind('cbox_open', function(){
  jQuery("body").addClass("colorbox-open");
});
jQuery(document).bind('cbox_closed', function(){
  jQuery("body").removeClass("colorbox-open");
});

/*=============Product Slider============*/
function sld(){
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
};
jQuery( window ).load(function() {
    sld();
});

/*Product Action Button Wrap Div*/
jQuery(".shop-item .shop-item-photo .shop-item-tools .yith-wcqv-button").wrap("<div class='action-btn quick-view-warp'>");
jQuery(".shop-item .shop-item-photo .shop-item-tools .compare").wrap("<div class='action-btn compare-warp'>");

//contact form 7 on submit hide message
document.addEventListener( 'wpcf7submit', function( event ) {
    setTimeout(function(){  jQuery(".wpcf7-response-output").fadeOut(); }, 3000);
}, false );

//mailchimp on submit hide message
jQuery(document).ready(function(){
    setTimeout(function(){  jQuery(".mc4wp-response").fadeOut(); }, 5000);
});    

//Popup Init
setTimeout(function(){
    jQuery("#innovatoryPopupnewsletter").modal({
        show: true
    });
}, 5000); 