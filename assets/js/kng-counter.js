( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var KngCounterHandler = function( $scope, $ ) {
        elementorFrontend.waypoint($scope.find('.kng-counter-number'), function () {
            var $number = $(this),
                data = $number.data();

            var decimalDigits = data.toValue.toString().match(/\.(.*)/);

            if (decimalDigits) {
                data.rounding = decimalDigits[1].length;
            }

            $number.numerator(data);
        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/kng_counter.default', KngCounterHandler );
    } );
} )( jQuery );