( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var KngAccordionHandler = function( $scope, $ ) {
        $scope.find(".kng-accordion .kng-accordion-item").on("click", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var parent = $(this).parent(".kng-accordion");
            var active_items = parent.find(".kng-accordion-item.active");
            $.each(active_items, function (index, item) {
                var item_target = $(item).data("target");
                if(item_target != target){
                    $(item).removeClass("active");
                    $(this).parent().removeClass("active");
                    $(item_target).slideUp(400);
                }
            });
            $(this).parent().toggleClass("active");
            $(this).toggleClass("active");
            $(target).slideToggle(400);
        });
    };

    var KngFaqHandler = function( $scope, $ ) {

        $scope.find(".faq-filter-item a").on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            var parent = $(this).parents(".kng-faq");
            var target = $(this).attr('href');
            if($(this).hasClass('active') == false){
                parent.find('.faq-filter-item a.active').removeClass('active');
                $(this).addClass('active');

                parent.find('.faq-pane.active').removeClass('active');
                $(target).addClass('active');
            }
        });

        $scope.find(".kng-faq .kng-faq-item").on("click", function(e){
            e.preventDefault();
            var target = $(this).attr("data-target");
            var parent = $(this).parents(".faq-pane");
            var active_items = parent.find(".kng-faq-item.active");
            $.each(active_items, function (index, item) {
                var item_target = $(item).data("target");
                if(item_target != target){
                    $(item).removeClass("active");
                    $(item_target).slideUp(400);
                }
            });
            $(this).toggleClass("active");
            $(target).slideToggle(400);

        });


    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_accordion.default', KngAccordionHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_faq.default', KngFaqHandler );
    } );
} )( jQuery );