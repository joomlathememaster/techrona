( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    var KngPostMasonryHandler = function( $scope, $ ) { 
        $('.kng-grid-masonry').imagesLoaded(function(){ 
            $.sep_grid_refresh();
              
        });
 
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_post_grid.default', KngPostMasonryHandler );
    } );
} )( jQuery );