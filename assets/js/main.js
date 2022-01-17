;(function ($) {

    "use strict";

    /* ===================
     Page reload
     ===================== */
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    // Fire on document ready.
    $( document ).ready( function() {
        // menu
        techrona_open_mobile_menu();
        techrona_dropdown_menu();
        techrona_open_secondary_menu();
        //header sticky
        techrona_header_sticky();
        // hidden sidebar
        techrona_header_hidden_sidebar();
        // animate
        techrona_animation();
        // WooCommerce
        techrona_shop_view_layout();
        techrona_open_cart_popup();
        techrona_wc_single_product_gallery();
        techrona_quantity_plus_minus();
        techrona_quantity_plus_minus_action();
        techrona_product_single_variations_att();
        techrona_table_cart_content();
        techrona_table_move_column('.woocommerce-cart-form__contents', '.woocommerce-cart-form__cart-item' ,0, 5, '', '.product-subtotal', '');
        // background image moving
        techrona_background_moving();
        // full
        techrona_elementor_section_full_width_with_space();
        // widget
        techrona_widget_nav_menu();
        // modal
        techrona_open_html_modal();
  
        techrona_svg_color();

        techrona_panel_mobile_menu();

        techrona_panel_cart_toggle();

        techrona_panel_anchor_toggle();

        techrona_document_click();

        techrona_ajax_search();
 
    });

    $(window).on('load', function () {
        $(".kng-loader").fadeOut("slow");
        window_width = $(window).width();
        //techrona_shop_view_layout_onload();
        techrona_footer_fixed();
        techrona_scroll_to_top();
        techrona_video_size();
        

    });
    $(window).on('resize', function () {
        window_width = $(window).width();
        techrona_video_size();
        // full
        techrona_elementor_section_full_width_with_space();
        techrona_side_menu_widescreen_resize();
    });

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        techrona_header_sticky();
        techrona_scroll_to_top();
    });
 
    // Ajax Complete
    $(document).ajaxComplete(function(event, xhr, settings){  
        "use strict";
        //$.sep_grid_refresh(); // this need to add last function
        techrona_video_size();
        techrona_elementor_section_full_width_with_space();
    });

    jQuery( document ).on( 'updated_wc_div', function() {
        techrona_quantity_plus_minus();
        techrona_table_cart_content();
        techrona_table_move_column('.woocommerce-cart-form__contents', '.woocommerce-cart-form__cart-item' ,0, 5, '', '.product-subtotal', '');
    } );
    
    $.sep_grid_refresh = function (){  

        $('.kng-grid-masonry').each(function () {  
            if($(this).find('.kng-post-video iframe').length > 0){
                $('.kng-post-video iframe').each(function () {
                    var v_width = $(this).width();
                    v_width = v_width / (16 / 9);
                    $(this).attr('height', v_width + 35);
                });
            }
            var iso = new Isotope(this, {
                itemSelector: '.kng-grid-item',
                layoutMode: $(this).data('layout'),   
                fitRows: {
                    gutter: 0
                },
                percentPosition: true,
                masonry: {
                    columnWidth: '.kng-grid-sizer',
                },
                containerStyle: null,
                stagger: 30,
                sortBy : 'name'
            });
             
            var filtersElem = $(this).parent('.kng-grid').find('.kng-grid-filter-wrap');
            filtersElem.on('click', function (event) {
                var filterValue = event.target.getAttribute('data-filter');
                iso.arrange({filter: filterValue});
            });

            var filterItem = $(this).parent('.kng-grid').find('.kng-filter-item');
            filterItem.on('click', function (e) {
                filterItem.removeClass('active');
                $(this).addClass('active');
            });

            var filtersSelect = $(this).parent().find('.kng-select-filter-wrap');
            filtersSelect.change(function() {
                var filters = $(this).val();
                iso.arrange({filter: filters});
            });

            var orderSelect = $(this).parent().find('.kng-select-order-wrap');
            orderSelect.change(function() {
                var e_order = $(this).val();
                if(e_order == 'asc') {
                    iso.arrange({sortAscending: false});
                }
                if(e_order == 'des') {
                    iso.arrange({sortAscending: true});
                }
            });
            //$(window).smartresize(iso);
        });

    }
    // load more
    $(document).on('click', '.kng-load-more', function(){
        var loadmore    = $(this).data('loadmore');
        var perpage     = loadmore.perpage;
        var _this       = $(this).parents(".kng-grid");
        var layout_type = _this.data('layout');
        var loading_text = $(this).data('loading-text');
        var loadmore_text = $(this).data('loadmore-text');  
        loadmore.paged  = parseInt(_this.data('start-page')) +1;
        _this.find('.kng-grid-overlay').addClass('loader');
        $(this).addClass('loading');
        $(this).find('.kng-btn-icon').addClass('loading');
        $(this).find('.kng-btn-text').text(loading_text);
        $.ajax({
            url: main_data.ajax_url,
            type: 'POST',
            beforeSend: function () {

            },
            data: {
                action: 'techrona_load_more_post_grid',
                settings: loadmore
            }
        })
        .done(function (res) {   
            if(res.data.posts.length > 0){
                _this.find('.kng-grid-inner').append(res.data.html);
                _this.find('.kng-grid-overlay').removeClass('loader');  
                if(layout_type == 'masonry'){
                    $.sep_grid_refresh();
                }
                if($(document).find('.kng-post-share .sharethis').length > 0){
                    window.__sharethis__.initialize();
                }
            }  
            if(res.data.posts.length >= perpage){
                _this.data('start-page', res.data.paged);
                _this.find('.kng-load-more').removeClass('loading');
                _this.find('.kng-btn-icon').removeClass('loading');
                _this.find('.kng-btn-text').text(loadmore_text);
            }else{
                _this.find('.kng-load-more').removeClass('loading');
                _this.find('.kng-btn-icon').removeClass('loading');
                _this.find('.kng-load-more').addClass('no-more');
                _this.find('.kng-btn-text').text('No More');
                _this.find('.kng-load-more').addClass('d-none d-none1');
            }
        })
        .fail(function (res) {
            _this.find('.kng-load-more').addClass('d-none d-none1');
            return false;
        })
        .always(function () {
            return false;
        });
    });
 
   
    // pagination
    $(document).on('click', '.kng-grid-pagination .ajax a.page-numbers', function(){
        var _this = $(this).parents(".kng-grid");
        var loadmore = _this.find(".kng-grid-pagination").data('loadmore');
        var query_vars = _this.find(".kng-grid-pagination").data('query');

        var layout_type = _this.data('layout');
        var paged = $(this).attr('href');
        paged = paged.replace('#', '');
        loadmore.paged = parseInt(paged);
        query_vars.paged = parseInt(paged); 

        var _class = loadmore.pagin_align_cls;

        _this.find('.kng-grid-overlay').addClass('loader');
        $('html,body').animate({scrollTop: _this.offset().top - 100}, 750);
        // reload pagination
        $.ajax({
            url: main_data.ajax_url,
            type: 'POST',
            beforeSend: function () {

            },
            data: {
                action: 'techrona_get_pagination_html',
                query_vars: query_vars,
                cls: _class 
            }
        }).done(function (res) {
            if(res.status == true){
                _this.find(".kng-grid-pagination").html(res.data.html);
                _this.find('.kng-grid-overlay').removeClass('loader');
            }
            else if(res.status == false){
            }
        }).fail(function (res) {
            return false;
        }).always(function () {
            return false;
        });
        // load post
        $.ajax({
            url: main_data.ajax_url,
            type: 'POST',
            beforeSend: function () {

            },
            data: {
                action: 'techrona_load_more_post_grid',
                settings: loadmore
            }
        }).done(function (res) { //console.log(res); return false;
            if(res.status == true){
                _this.find('.kng-grid-inner .kng-grid-item').remove();
                _this.find('.kng-grid-inner').append(res.data.html);
                _this.data('start-page', res.data.paged);
                if(layout_type == 'masonry'){  
                    $.sep_grid_refresh();
                }
                if($(document).find('.kng-post-share .sharethis').length > 0){
                    window.__sharethis__.initialize();
                }
            }
            else if(res.status == false){
            }
        }).fail(function (res) {
            return false;
        }).always(function () {
            return false;
        });
        return false;
    });


    if ($(".woo_cat_search").length > 0){
        $(".woo_cat_search").select2({
            theme: 'woo-search-cat',
            width: '100%'
        });
    }

    /**
     * Check right to left
    */
    function techrona_is_rtl(){
        "use strict";
        var rtl = $('html[dir="rtl"]'),
            is_rtl = rtl.length ? true : false;
        return is_rtl;
    }
    /**
     * HTML Modal
    */
    function techrona_open_html_modal(){
        $('.kng-modal').on('click', function(e){ 
            e.preventDefault();
            var target = $(this).attr('data-target');
            $(target).toggleClass('open');
            setTimeout(function(){
                $(target).find('.search-field').focus();
                $(target).find('.kng-search-field').focus();
            }, 100); 
        });
        $('.kng-modal-close').on('click', function(e){
            e.preventDefault();
            $(this).parent().removeClass('open');
        });
        $('a[href="#"]').on('click', function (e){
            e.preventDefault();
        });
    }

    function techrona_svg_color(){
        "use strict";
        jQuery('img.kng-svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');
        
            jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');
        
                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
        
                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');
                
                // Check if the viewport is set, else we gonna set it if we can.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    //$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                    $svg.attr('viewBox', '0 0 24 24')
                }
        
                // Replace image with new SVG
                $img.replaceWith($svg);
        
            }, 'xml');
        
        });
    }

    function techrona_panel_mobile_menu(){
        'use strict';
        $(document).on('click','.mobile-menu-toggle .bars',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
        });
        $(document).on('click','.btn-nav-mobile',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
        });
    }
    function techrona_panel_cart_toggle(){
        'use strict';
        $(document).on('click','.kng-cart-toggle',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
        });
    }
    function techrona_panel_anchor_toggle(){
        'use strict';
        $(document).on('click','.kng-anchor.side-panel',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');

            if($(window).outerWidth() < 1200 ){
                $(this).removeClass('open');
                //$('.kng-anchor.side-panel').removeClass('cliked');
                //$('.mobile-menu-toggle .bars').addClass('cliked');
                $('.kng-side-mobile').addClass('open');
            }
        });
    }

    function techrona_document_click(){
        $(document).on('click',function (e) {
            var target = $(e.target);
            var check = '.mobile-menu-toggle .bars';
            var check1 = '.kng-cart-toggle';
             
            if (!(target.is(check)) && target.closest('.kng-side-panel').length <= 0 && $('body').hasClass('side-panel-open')) { 
                $('.mobile-menu-toggle .bars').removeClass('cliked');
                $('.kng-cart-toggle').removeClass('cliked');
                $('.kng-side-panel').removeClass('open');
                $('body').removeClass('side-panel-open');
            }
        });
        $(document).on('click','.kng-close',function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.kng-side-panel').toggleClass('open');
            $('.mobile-menu-toggle .bars').removeClass('cliked');
            $('.kng-cart-toggle').removeClass('cliked');
            $('body').toggleClass('side-panel-open');
        });
        
        if($(document).find('.kng-side-menu').length > 0){
            $('.kng-side-menu .kng-primary-menu > li.menu-item-has-children:first-child').addClass('active');
            $('.kng-side-menu .kng-primary-menu > li.menu-item-has-children')
            .mouseover(function() {
                if(!$(this).hasClass('active')){
                    $(this).addClass('active');
                    $('.kng-side-menu .kng-primary-menu > li.active').removeClass('active');
                } 
            })
            .mouseout(function() {
                $(this).addClass('active');
            });
        }
    }

    function techrona_ajax_search(){
        $(document).on('keypress','.kng-ajax-search form .kng-search-field',function(e){
            $(this).closest('.search-button-group').addClass('filling');
        });
        $(document).on('click','.kng-ajax-search .search-clear',function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.search-button-group').find('.kng-search-field').val('');
            $(this).closest('.search-button-group').removeClass('filling');
        });
        $(document).on('blur','.kng-ajax-search form .kng-search-field',function(){
            if( !$(this).val() ) {
                $(this).closest('.search-button-group').removeClass('filling');
            }
        });
    }
    
    // header sticky
    function techrona_header_sticky() {
        'use strict';
        if($(document).find('.kng-header-elementor-sticky').length > 0){
            var header_height = $('.kng-header-elementor-main').outerHeight();
            var offset_top = $('.kng-header-elementor-sticky').outerHeight();
            var offset_top_nimation = offset_top + header_height;
             
            if (scroll_top > header_height) {
                $(document).find('.kng-header-elementor-sticky').addClass('h-fixed');
            }else{
                $(document).find('.kng-header-elementor-sticky').removeClass('h-fixed');
            }
        }
        if (window_width < 1200) {
            if($(document).find('.kng-header-elementor-mobile.is-sticky').length > 0){
                var offset_top = $('.kng-header-elementor-mobile').outerHeight();
                var offset_top_nimation = offset_top + 100;

                if (scroll_top > offset_top) {
                    $(document).find('.kng-header-elementor-mobile').addClass('mh-fixed');
                    //$('.kng-header-wraps').css('margin-bottom','70px');
                }else{
                    $(document).find('.kng-header-elementor-mobile').removeClass('mh-fixed');
                }
            }
            if($(document).find('.kng-header-mobile.is-sticky').length > 0){
                var offset_top = $('.kng-header-mobile').outerHeight();
                var offset_top_nimation = offset_top + 100;

                if (scroll_top > offset_top) {
                    $(document).find('.kng-header-mobile').addClass('mh-fixed');
                    //$('.kng-header-wraps').css('margin-bottom','70px');
                }else{
                    $(document).find('.kng-header-mobile').removeClass('mh-fixed');
                }
            }
        }
          
    }
    
     /* =================
     Menu Mobile
     =================== */
    function techrona_open_mobile_menu(){
        'use strict';
        /* Add toggle button to parent Menu */
        $('#kng-primary-menu li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.kng-mobile-menu li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.main-menu-toggle').on('click', function () {
            $(this).toggleClass('open');
            $(this).parent().find('> .sub-menu').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu').slideToggle();
        });
    }
     
    /* =================
     Menu Dropdown Touched Side
     =================== */
    function techrona_dropdown_menu(){
        'use strict';
        var $menu = $('.kng-main-navigation');        
        $menu.find('.kng-primary-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });

        $('.sub-menu .current-menu-item').parents('.menu-item-has-children').addClass('current-menu-ancestor');
    }
    /* =================
     Open Secondary Menu
     =================== */
    function techrona_open_secondary_menu(){
        'use strict';
        $('.kng-secondary-menu-title').on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('active');
            $(this).next('#kng-secondary-menu').toggleClass('open').slideToggle();
        });
    }
    
    /* =================
     Hidden Side bar
    =================== */
    function techrona_header_hidden_sidebar(){
        'use strict';

        $(".kng-header-hidden-sidebar").on('click', function (e) {
            e.preventDefault();
            $('.kng-hidden-sidebar').toggleClass('open');
        });
        $(".kng-hidden-close").on('click', function (e) {
            e.preventDefault();
            $(this).parent().removeClass('open');
        });
    }

    /* =================
     Animation
    =================== */
    function techrona_animation(){
        'use strict';

        $('.case-animate-time').each(function () {
            var eltime = 0;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .slide-in-container > .wow').each(function (index, obj) {
                $(this).css('transition-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 0;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });
    }
    
    /* ====================
      Fixed Footer
     ====================== */
     function techrona_footer_fixed(){
        'use strict';
        var offsetFooter = $('#kng-footer').outerHeight();
        if($('#kng-footer').hasClass('kng-footer-fixed')) {
            $('#kng-page').css({
                'padding-bottom': offsetFooter
            });
        }
     }
    /* ====================
     Scroll To Top
     ====================== */
    function techrona_scroll_to_top() {
        'use strict';
        if (scroll_top < window_height) {
            $('.kng-scroll-top').addClass('off').removeClass('on');
            $('#kng-footer').addClass('scroll-off').removeClass('scroll-on');
        }
        if (scroll_top > window_height) {
            $('.kng-scroll-top').addClass('on').removeClass('off');
            $('#kng-footer').addClass('scroll-on').removeClass('scroll-off');
        }
    }
    /**
     * Media Embed dimensions
     * 
     * Youtube, Vimeo, Iframe, Video, Audio.
     * @author Chinh Duong Manh
     */
    function techrona_video_size() {
        'use strict';
        setTimeout(function(){
            $('.kng-featured iframe , .kng-featured  video, .kng-featured .wp-video-shortcode, .kng-post-content iframe').each(function(){
                var v_width = $(this).parent().width();
                var v_height = Math.floor(v_width / (16/9));
                $(this).attr('width',v_width).css('width',v_width);
                $(this).attr('height',v_height + 59).css('height',v_height + 59);
            });
        }, 100);
    }
    /**
     * Widgets
    ***/
    function techrona_widget_nav_menu(){
        'use strict';
        $('.kng-menu-toggle, a[href="#"]').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('open');
            $(this).parent().find('>ul').toggleClass('submenu-open');
            $(this).parent().find('>ul').slideToggle();
        });

    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
    /**
     * WooCommerce
     * Single Product
    */
    function techrona_shop_view_layout_onload(){
        var shop_col = getUrlParameter('col');
        var type = getUrlParameter('type');

        if(shop_col) return;
        if(type && type == 'list') return;
        
        if ( Cookies.get( 'techrona_shop_col' ) ) { 
            var $this = $(document).find( '.kng-view-layout a[data-col="' + Cookies.get( 'techrona_shop_col' ) + '"]' );
            if(!$this.hasClass('active')){
                $('.kng-view-layout .view-icon').removeClass('active');
                $this.parent('li').addClass('active');
                $this.parents('.kng-content-area').find('ul.products').removeAttr('class').addClass($this.attr('data-cls'));
            }    
        }
    }
    function techrona_shop_view_layout(){
        
        $(document).on('click','.kng-view-layout .view-icon a', function(e){
            e.preventDefault();
            if(!$(this).parent('li').hasClass('active')){
                $('.kng-view-layout .view-icon').removeClass('active');
                $(this).parent('li').addClass('active');
                $(this).parents('.kng-content-area').find('ul.products').removeAttr('class').addClass($(this).attr('data-cls'));
                /*var col = $(this).attr( 'data-col' );
                Cookies.set( 'techrona_shop_col', 3, {
                    expires: 0,
                    path   : '/'
                } );*/
            }
        });
    }
    // open cart popup
    function techrona_open_cart_popup(){
        'use strict';
        $('.kng-header-cart').on('click', function (e) {
            e.preventDefault();
            var shoppingCart     = $(this).parents('body').find('.widget_shopping_cart');
                if ( $( "#wpadminbar" ).length ) {
                    var adminbarHeight = $('#wpadminbar').outerHeight();
                } else {
                    var adminbarHeight = 0;
                }
                if ( $( "#kng-header" ).length ) {
                    var headerHeight = $('#kng-header').outerHeight();
                } else {
                    var headerHeight = 0;
                }
            var offsetTop =  adminbarHeight + headerTopHeight + headerHeight;
            shoppingCart.toggleClass('open').css({'top': offsetTop});
            if(techrona_is_rtl()){
                if (shoppingCart.offset().left + shoppingCart.outerWidth() > $(window).width()) {
                    shoppingCart.css({'left':'0'});
                } else if (shoppingCart.offset().left < 0) {
                    shoppingCart.css({'left':'0'});
                }
            } else {
                if (shoppingCart.offset().left + shoppingCart.outerWidth() > $(window).width()) {
                    shoppingCart.css({'right':'0',});
                } else if (shoppingCart.offset().left < 0) {
                    shoppingCart.css({'right':'0'});
                }
            }
        });
    }
    //quantity number field custom
    function techrona_quantity_plus_minus(){
        "use strict";
        $( ".quantity input" ).wrap( "<div class='kng-quantity'></div>" );
        $('<span class="quantity-button quantity-down"></span>').insertBefore('.quantity input');
        $('<span class="quantity-button quantity-up"></span>').insertAfter('.quantity input');
        // contact form 7 input number
        $('<span class="kng-input-number-spin"><span class="kng-input-number-spin-inner kng-input-number-spin-up"></span><span class="kng-input-number-spin-inner kng-input-number-spin-down"></span></span>').insertAfter('.wpcf7-form-control-wrap input[type="number"]');
    }
    function techrona_ajax_quantity_plus_minus(){
        "use strict";
        $('<span class="quantity-button quantity-down"></span>').insertBefore('.quantity input');
        $('<span class="quantity-button quantity-up"></span>').insertAfter('.quantity input');
    }
    function techrona_quantity_plus_minus_action(){
        "use strict";
        $(document).on('click','.quantity .quantity-button',function () {
            var $this = $(this),
                spinner = $this.closest('.quantity'),
                input = spinner.find('input[type="number"]'),
                step = input.attr('step'),
                min = input.attr('min'),
                max = input.attr('max'),value = parseInt(input.val());
            if(!value) value = 0;
            if(!step) step=1;
            step = parseInt(step);
            if (!min) min = 0;
            var type = $this.hasClass('quantity-up') ? 'up' : 'down' ;
            switch (type)
            {
                case 'up':
                    if(!(max && value >= max))
                        input.val(value+step).change();
                    break;
                case 'down':
                    if (value > min)
                        input.val(value-step).change();
                    break;
            }
            if(max && (parseInt(input.val()) > max))
                input.val(max).change();
            if(parseInt(input.val()) < min)
                input.val(min).change();
        });
        $(document).on('click','.kng-input-number-spin-inner',function () {
            var $this = $(this),
                spinner = $this.parents('.wpcf7-form-control-wrap'),
                input = spinner.find('input[type="number"]'),
                step = input.attr('step'),
                min = input.attr('min'),
                max = input.attr('max'),value = parseInt(input.val());
            if(!value) value = 0;
            if(!step) step=1;
            step = parseInt(step);
            if (!min) min = 0;
            var type = $this.hasClass('kng-input-number-spin-up') ? 'up' : 'down' ;
            switch (type)
            {
                case 'up':
                    if(!(max && value >= max))
                        input.val(value+step).change();
                    break;
                case 'down':
                    if (value > min)
                        input.val(value-step).change();
                    break;
            }
            if(max && (parseInt(input.val()) > max))
                input.val(max).change();
            if(parseInt(input.val()) < min)
                input.val(min).change();
        });
    }
    function techrona_product_single_variations_att(){
        $(document).on('mousedown', '.pro-variation-select', function (e) {
            e.preventDefault();
            var $this_var = $(this).closest('.variations'),
                this_closest = $(this).closest('.techrona-variation-att-terms'),
                target_hidden = $this_var.find('#'+this_closest.attr('data-id'));
            var $this = $(this);
            if (!$this.hasClass('custom-vari-enabled'))
                return;
            var target = $this.attr('data-value');
            if (!target)
                return;
            target_hidden.val(target).change();
            this_closest.find('li.kng-vari-item').removeClass('active');
            $this.parent('li').addClass('active');
        });
    }
    function techrona_table_cart_content(){
        "use strict";
        var table = jQuery('.woocommerce-cart-form__contents'),
            table_head = table.find('thead');
            table_head.find('.product-remove').remove();
            table_head.find('.product-thumbnail').remove();
            table_head.find('.product-name').attr('colspan',2);
            table_head.find('tr').append('<th class="product-remove">&nbsp;</th>');
    }
    //techrona_table_move_column('.woocommerce-cart-form__contents', '.woocommerce-cart-form__cart-item' ,0, 5, '', '.product-subtotal', '');
    function techrona_table_move_column(table, selected ,from, to, remove, colspan, colspan_value) {
        "use strict";
        var rows = jQuery(selected, table);
        var cols;
        rows.each(function() {
            cols = jQuery(this).children('th, td');
            cols.eq(from).detach().insertAfter(cols.eq(to));
        });
        var rows_remove = jQuery(remove, table);
        rows_remove.each(function(){
            jQuery(this).remove(remove);
        });
        var colspan = jQuery(colspan, table);
        colspan.each(function(){
            jQuery(this).attr('colspan',colspan_value);
        });
    }
    // WooCommerce Single Product Gallery 
    function techrona_wc_single_product_gallery(){
        'use strict';
        if(typeof $.flexslider != 'undefined'){
            $('.wc-gallery-sync').each(function() {
                var itemW      = parseInt($(this).attr('data-thumb-w')),
                    itemH      = parseInt($(this).attr('data-thumb-h')),
                    itemN      = parseInt($(this).attr('data-thumb-n')),
                    itemMargin = parseInt($(this).attr('data-thumb-margin')),
                    itemSpace  = itemH - itemW + itemMargin;
                if($(this).hasClass('thumbnail-vertical')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : false,
                        directionNav   : true,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        direction      : 'vertical',
                        slideshow      : false,
                        animationLoop  : false,
                        itemWidth      : itemW, // add thumb image height
                        itemMargin     : itemSpace, // need it to fix transform item
                        move           : 3,
                        start: function(slider){
                            var asNavFor     = slider.vars.asNavFor,
                                height       = $(asNavFor).height(),
                                height_thumb = $(asNavFor).find('.flex-viewport').height(),
                                window_w = $(window).width();
                            if(window_w > 1024) {
                                slider.css({'max-height' : height_thumb, 'overflow': 'hidden'});
                                slider.find('> .flex-viewport > *').css({'height': height, 'width': ''});
                            }
                        }
                    });
                }
                if($(this).hasClass('thumbnail-horizontal')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : true,
                        directionNav   : false,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        slideshow      : false,
                        animationLoop  : false, // Breaks photoswipe pagination if true.
                        itemWidth      : itemW,
                        itemMargin     : itemMargin,
                        start: function(slider){

                        }
                    });
                };
            });
        }
    }
    /**
     * BACKGROUND IMAGE MOVING FUNCTION BY= jquery.bgscroll.js
    */
    (function() {
        'use strict';
        $.fn.bgscroll = $.fn.bgScroll = function( options ) {
            
            if( !this.length ) return this;
            if( !options ) options = {};
            if( !window.scrollElements ) window.scrollElements = {};
            
            for( var i = 0; i < this.length; i++ ) {
                
                var allowedChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var randomId = '';
                for( var l = 0; l < 5; l++ ) randomId += allowedChars.charAt( Math.floor( Math.random() * allowedChars.length ) );
                
                    this[ i ].current = 0;
                    this[ i ].scrollSpeed = options.scrollSpeed ? options.scrollSpeed : 70;
                    this[ i ].direction = options.direction ? options.direction : 'h';
                    window.scrollElements[ randomId ] = this[ i ];
                    
                    eval( 'window[randomId]=function(){var axis=0;var e=window.scrollElements.' + randomId + ';e.current -= 1;if (e.direction == "h") axis = e.current + "px 0";else if (e.direction == "v") axis = "0 " + e.current + "px";else if (e.direction == "d") axis = e.current + "px " + e.current + "px";$( e ).css("background-position", axis);}' );
                                                             
                    setInterval( 'window.' + randomId + '()', options.scrollSpeed ? options.scrollSpeed : 70 );
                }
                
                return this;
            }
    })(jQuery);   
    function techrona_background_moving(){
        "use strict";
        // allow direction v, d
        $('.kng-bg-moving-h').bgscroll({scrollSpeed:20 , direction:'h' });
    }
    /** ====================================================
     Elementer Section Full Width with Left/ Right Spacing
    ======================================================== **/
    function techrona_elementor_section_full_width_with_space(){  
        'use strict';
        var container_width = 1200;
          
        if($(window).width() >= 1200 ){
            setTimeout(function(){
                $('.elementor-section-full_width:not(.kng-full-content-with-space-none)').each(function () {
                    var offset = parseInt($(this).css('left').replace('-','')),
                        main_offset = ($(window).width() - container_width)/2,
                        offset_wide = offset - 115,
                        $section_space_start = $(this).hasClass('kng-full-content-with-space-start'),
                        $section_space_end = $(this).hasClass('kng-full-content-with-space-end'),
                        $section_space_start_wide = $(this).hasClass('kng-full-content-with-space-start-wide'),
                        $section_space_end_wide = $(this).hasClass('kng-full-content-with-space-end-wide');
 
                    if(techrona_is_rtl()){
                        if($section_space_start) {
                            $(this).css({
                                'padding-right': main_offset + 'px',
                            });
                        } else if($section_space_end) {
                            $(this).css({
                                'padding-left': main_offset + 'px',
                            });
                        }
                        if($section_space_start_wide) {
                            $(this).css({
                                'padding-right': offset_wide + 'px',
                            });
                        } else if($section_space_end_wide) {
                            $(this).css({
                                'padding-left': offset_wide + 'px',
                            });
                        }
                    } else {
                        if($section_space_start){
                            $(this).css({
                                'padding-left': main_offset + 'px',
                            });
                        } else if($section_space_end){
                            $(this).css({
                                'padding-right': main_offset + 'px',
                            });
                        }
                        if($section_space_start_wide){
                            $(this).css({
                                'padding-left': offset_wide + 'px',
                            });
                        } else if($section_space_end_wide){
                            $(this).css({
                                'padding-right': offset_wide + 'px',
                            });
                        }
                    }
                });
                // stretched section with space
                $('.elementor-section-stretched').each(function () {
                    var offset = parseInt($(this).css('left').replace('-','')),
                        main_offset = ($(window).width() - 1280)/2,
                        section_w = ($(window).width() - main_offset),
                        $section_space_start = $(this).hasClass('kng-section-stretched-with-space-start'),
                        $section_space_end = $(this).hasClass('kng-section-stretched-with-space-end');
                    if(techrona_is_rtl()){
                        if($section_space_start) {
                            $(this).css({
                                'margin-right': main_offset + offset + 'px',
                                'padding-right': '',
                                'width' : section_w
                            });
                        } else if($section_space_end) {
                            $(this).css({
                                'margin-left': main_offset + offset + 'px',
                                'padding-left': '',
                                'width' : section_w
                            });
                        }
                    } else {
                        if($section_space_start){
                            $(this).css({
                                'margin-left': main_offset + offset + 'px',
                                'padding-left': '',
                                'width' : section_w
                            });
                        } else if($section_space_end){
                            $(this).css({
                                'margin-right': main_offset + offset + 'px',
                                'padding-right': '',
                                'width' : section_w
                            });
                        }
                    }
                });
                // Section overlay
                $('.kng-section-overvlay-with-space').each(function () {
                    var offset = parseInt($(this).css('left').replace('-','')),
                        main_offset = ($(window).width() - 1170)/2,
                        section_space_start = $(this).hasClass('kng-section-overvlay-with-space-start'),
                        section_space_end = $(this).hasClass('kng-section-overvlay-with-space-end'),
                        section_space_between = $(this).hasClass('kng-section-overvlay-with-space-between');
                    if(techrona_is_rtl()){
                        if(section_space_start) {
                            $(this).find('.elementor-background-overlay').css({
                                'right': main_offset  + 'px',
                            });
                        } else if(section_space_end) {
                            $(this).find('.elementor-background-overlay').css({
                                'left': main_offset  + 'px',
                            });
                        } else if(section_space_between){
                            $(this).find('.elementor-background-overlay').css({
                                'left': 3.75  + '%',
                                'right': 3.75  + '%',
                            });
                        }
                    } else {
                        if(section_space_start){
                            $(this).find('.elementor-background-overlay').css({
                                'left': main_offset  + 'px',
                            });
                        } else if(section_space_end){
                            $(this).find('.elementor-background-overlay').css({
                                'right': main_offset  + 'px',
                            });
                        } else if(section_space_between){
                            $(this).find('.elementor-background-overlay').css({
                                'left': 3.75  + '%',
                                'right': 3.75  + '%',
                            });
                        }
                    }
                });
            }, 100 )
        } else {
            $('.elementor-section').each(function () {
                $(this).css({
                    'padding-left': '',
                    'padding-right': '',
                    'margin-left':'',
                    'margin-right' : '',
                    'width' : ''
                });
                $(this).find('.elementor-background-overlay').css({
                    'left' : '',
                    'right' : ''
                });
            })
        }
    }

    function techrona_side_menu_widescreen_resize(){
        if($('.kng-side-menu.widescreen.open').length > 0){
            if($(window).outerWidth() < 1200 ){
                $('.kng-side-menu.widescreen').removeClass('open');
                $('.kng-anchor.side-panel').removeClass('cliked');
                $('.mobile-menu-toggle .bars').addClass('cliked');
                $('.kng-side-mobile').addClass('open');
            }else{
                $('.kng-anchor.side-panel').addClass('cliked');
                $('.kng-side-menu.widescreen').addClass('open');
                $('.mobile-menu-toggle .bars').removeClass('cliked');
                $('.kng-side-mobile').removeClass('open');
            }
        }
        if($('.kng-side-menu.widescreen').length > 0 && $('.kng-side-mobile.open').length > 0){
            if($(window).outerWidth() >= 1200 ){
                $('.kng-anchor.side-panel').addClass('cliked');
                $('.kng-side-menu.widescreen').addClass('open');
                $('.mobile-menu-toggle .bars').removeClass('cliked');
                $('.kng-side-mobile').removeClass('open');
            }else{
                $('.kng-side-menu.widescreen').removeClass('open');
                $('.kng-anchor.side-panel').removeClass('cliked');
                $('.mobile-menu-toggle .bars').addClass('cliked');
                $('.kng-side-mobile').addClass('open');
            }
        }
        if($('.kng-side-menu.widescreen').length <= 0 && $('.kng-side-mobile.open').length > 0){
            if($(window).outerWidth() >= 1200 ){
                $('.kng-anchor.side-panel').addClass('cliked');
                $('.kng-side-menu.widescreen').addClass('open');
                $('.mobile-menu-toggle .bars').removeClass('cliked');
                $('.kng-side-mobile').removeClass('open');
                $('body').removeClass('side-panel-open');
            }
        }
    }
})(jQuery);
  