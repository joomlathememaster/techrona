( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var KngProgressBarHandler = function( $scope, $ ) {
        setTimeout(function(){
            elementorFrontend.waypoint($scope.find('.kng-progress-bar'), function () {
                var $progressbar = $(this);
                //$progressbar.css({'width': $progressbar.data('max') + '%', 'display':'block'});
                $progressbar.css({'width': $progressbar.data('max') + '%'});
            });
        }, 150);
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_progressbar.default', KngProgressBarHandler );
    } );
} )( jQuery );