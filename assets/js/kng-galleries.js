( function( $ ) {
    /**
     * Galleries Load more
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var KngGalleriesHandler = function( $scope, $ ) {
        var galleries = $scope.find(".kng-image-gallery"),
            data_show = galleries.data('show'),
            data_load = galleries.data('loadmore');
            galleries.find(".kng-gallery-item").slice(0, data_show).show();
            galleries.find('.kng-gallery-load').on('click',  function(e) { // click event for load more
                e.preventDefault();
                galleries.find(".kng-gallery-item:hidden").slice(0, data_load).show(300); // select next 10 hidden divs and show them
                if (galleries.find(".kng-gallery-item:hidden").length == 0) { // check if any hidden divs still exist
                  $(this).hide();
                } 
            });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_galleries.default', KngGalleriesHandler );
    } );
} )( jQuery );