( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaeTestimonialJsHandler = function( $scope, $ ) {

        var slide   =   $scope.find( '.testimonials-slide' );
        var rating  =   $scope.find( '.ct-star-rating' );

        // Testimonial Slider
        $( slide ).slick( {
            prevArrow: '<i class="fas fa-angle-left arrow-left"></i>',
            nextArrow: '<i class="fas fa-angle-right arrow-right"></i>',

            responsive: [
                {
                    breakpoint: 9999,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        } );

        $( rating ).each( function(){
            $(this).starRating();
        } )

    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_testimonial.default', WidgetEaeTestimonialJsHandler );
    } );
} )( jQuery );
