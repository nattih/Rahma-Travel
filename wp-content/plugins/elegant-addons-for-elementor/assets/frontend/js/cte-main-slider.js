( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaeMainSliderJsHandler = function( $scope, $ ) {

        var slide =   $scope.find( '.ct-slick-slider' );

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function() {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function() {
                    $this.removeClass($animationType);
                });
            });
        }

        // Main Slider
        $( slide ).on('init', function(e, slick) {
            var $firstAnimatingElements = $('div.ct-slick-slide:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });

        $( slide ).on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('div.ct-slick-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });

        $( slide ).slick( {
            dots: true,
            arrows: true,
            fade: true,
            autoplay: true,
            autoplaySpeed: 400000,
            prevArrow: '<i class="fas fa-angle-left arrow-left"></i>',
            nextArrow: '<i class="fas fa-angle-right arrow-right"></i>'
        } );
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_slider.default', WidgetEaeMainSliderJsHandler );
    } );
} )( jQuery );
