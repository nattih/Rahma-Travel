( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaeAnimatedHeadlineJsHandler = function( $scope, $ ) {
        /**
         * Animated Headline
         */
        var aHline                  =   $scope.find( '.ct-animate-header' );
        var aDataAnimateType        =   aHline.data( 'animate' );
        var aDataDelay              =   aHline.data( 'delay' );
        var aDataBarDuration        =   aHline.data( 'barduration' );
        var aDataBarWaiting         =   aHline.data( 'barwaiting' );
        var aDataTypeLettersDelay   =   aHline.data( 'typelettersdelay' );
        var aDataTypeStartDelay     =   aHline.data( 'typestartdelay' );
        var aDataRevealDuration     =   aHline.data( 'revealduration' );
        var aDataRevealDelay        =   aHline.data( 'revealdelay' );

        $( aHline ).animatedHeadline( {
            animationType: aDataAnimateType,
            animationDelay: aDataDelay,
            //loading bar effect
            barAnimationDelay: aDataBarDuration,
            barWaiting: aDataBarWaiting,
            //letters effect
            lettersDelay: aDataTypeLettersDelay,
            //type effect
            typeLettersDelay: aDataTypeLettersDelay,
            selectionDuration: 500,
            typeAnimationDelay: aDataTypeStartDelay,
            //clip effect
            revealDuration: aDataRevealDuration,
            revealAnimationDelay: aDataRevealDelay
        } );
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_animated_headline.default', WidgetEaeAnimatedHeadlineJsHandler );
    } );
} )( jQuery );
