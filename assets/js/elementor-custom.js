(function($) {
    "use strict";

    $( window ).on( 'elementor/frontend/init', function() {
    	var _elementor = typeof elementor != 'undefined' ? elementor : elementorFrontend;
    	
		_elementor.hooks.addFilter( 'kng-custom-section-classes', function( settings ) {
			let custom_classes = [];
			if(typeof settings.custom_style != 'undefined' && settings.custom_style != ''){
				custom_classes.push('style-' + settings.custom_style);
			}

        	return custom_classes;
		} );

		_elementor.hooks.addFilter( 'kng-custom-column-classes', function( settings ) {
			let custom_classes = [];
			if(typeof settings.custom_style != 'undefined' && settings.custom_style != ''){
				custom_classes.push('style-' + settings.custom_style);
			}

        	return custom_classes;
		} );

		$(window).on('resize', function () {
	        // elementor
	        techrona_elementor_section_full_width_with_space();
	    });
		/** ====================================================
	     Elementer Section Full Width with Left/ Right Spacing
	    ======================================================== **/
	    /**
	     * Check right to left
	    */
	    function techrona_is_rtl(){
	    	'use strict';
	        var rtl = $('html[dir="rtl"]'),
	            is_rtl = rtl.length ? true : false;
	        return is_rtl;
	    }
	    techrona_elementor_section_full_width_with_space();
	    function techrona_elementor_section_full_width_with_space(){
	        'use strict';
	        if($(window).width() > 1199 ){
	            setTimeout(function(){
	                $('.elementor-section-full_width').each(function () {
	                    var offset = parseInt($(this).css('left').replace('-','')),
	                        $section_space_start = $(this).hasClass('kng-full-content-with-space-start'),
	                        $section_space_end = $(this).hasClass('kng-full-content-with-space-end');

	                    if(techrona_is_rtl()){
	                        if($section_space_start) {
	                            $(this).css({
	                                'padding-right': offset + 'px',
	                            });
	                        } else if($section_space_end) {
	                            $(this).css({
	                                'padding-left': offset + 'px',
	                            });
	                        }
	                    } else {
	                        if($section_space_start){
	                            $(this).css({
	                                'padding-left': offset + 'px',
	                            });
	                        } else if($section_space_end){
	                            $(this).css({
	                                'padding-right': offset + 'px',
	                            });
	                        }
	                    }
	                })
	            }, 10 );
	        } else {
	            $('.elementor-section-full_width').each(function () {
	                $(this).css({
	                    'padding-left': '',
	                    'padding-right': ''
	                });
	            })
	        }
	    }
    } );
}(jQuery));