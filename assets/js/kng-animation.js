( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    var KngHeadingHandler = function( $scope, $ ) {
        elementorFrontend.waypoint($scope.find('.elementor-invisible'), function () {
            var $heading = $(this),
                data = $heading.data('settings');

            if(typeof data['_animation'] != 'undefined'){
                //$heading.addClass(data['_animation']+' animated').removeClass('elementor-invisible');
                setTimeout(function () {
                    $heading.removeClass('elementor-invisible').addClass('animated ' + data['_animation']);
                }, data['animation_delay']);
            }
        });
        elementorFrontend.waypoint($scope.find('.kng-animate'), function () {
            var $heading = $(this),
                data = $heading.data('settings');
            if(typeof data['animation'] != 'undefined'){
                //$heading.addClass(data['_animation']+' animated').removeClass('elementor-invisible');
                setTimeout(function () {
                    $heading.removeClass('kng-invisible').addClass('animated ' + data['animation']);
                }, data['animation_delay']);
            }
        });
         
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_button.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_heading.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_counter.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_page_title.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_post_carousel.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_imgs_box.default', KngHeadingHandler );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_cta.default', KngHeadingHandler );
    } );
} )( jQuery );