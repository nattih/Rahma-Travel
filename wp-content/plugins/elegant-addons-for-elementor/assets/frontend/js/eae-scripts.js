( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaePostgridJsHandler = function( $scope, $ ) {
        var eae_grid          =   $scope.find( '.eae-grid' );
        var eae_data_padding  =   eae_grid.data( 'padding-right' );

        $(window).load(function () {
          $( eae_grid ).masonry({
            // options
            itemSelector: '.eae-grid-item',
          });
        });

        $('.single-blog').css( 'padding-left', eae_data_padding + 'px' );
        $('.eae-postgrid').css('margin-left', -eae_data_padding + 'px' );
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_postgrid.default', WidgetEaePostgridJsHandler );
    } );

    /**
    *  Switcher
    ******************************************************************/

    var WidgetEaeSwitcherJsHandler = function( $scope, $ ) {
        $("document").ready(function(){
          var eae_tab_toggle_item =   $scope.find( '.eae-tab-toggle-item' );

          $( eae_tab_toggle_item ).on( 'click', function(){
            $( this ).addClass( 'active' );
            $( this ).siblings().removeClass( 'active' );

            var tab_id = $( this ).data( 'tab' );

            $( this ).parent( '.eae-tab-toggler' ).parent( '.eae-tab-container' ).siblings( '.eae-tab-content' ).children( '.' + tab_id ).addClass( 'eae-show' ).siblings().removeClass( 'eae-show' ).addClass( 'eae-hide' );
          } );

        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_switcher.default', WidgetEaeSwitcherJsHandler );
    } );

    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetEaeFilterizrJsHandler = function( $scope, $ ) {
        /**
         * Filterizer
         */
        var filter =   $scope.find( '.filter-container' );
        var f_layout    =   filter.data( 'layout' );

        if ( $( filter ).length >0  ) {
            //Initialize filterizr
            $( filter ).filterizr( { layout: f_layout } );
        }

        var $filter = $scope.find( '.controls .filter' );

        //Simple filter controls
        $filter.on( 'click', function( e ) {
            e.preventDefault();
            $filter.removeClass( 'active' );
            $( this ).addClass( 'active' );
        } );
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_portfolio.default', WidgetEaeFilterizrJsHandler );
    } );

    /**
     *  Eae Lightbox
     **************************************************************************/
    var WidgetEaeLightboxJsHandler = function( $scope, $ ) {
        var trigger =   $scope.find( '.ct-lightbox' );

        $( trigger ).on( 'click', function( e ) {
            var data_type       =   $( this ).data( 'popup-type' );
            var data_url        =   $( this ).data( 'popup-url' );
            var data_autoplay   =   $( this ).data( 'autoplay' );
            var data_animation  =   $( this ).data( 'animation' );

            if ( data_autoplay == 'yes' ) {
                data_autoplay = 1;

                if ( data_type == 'video' ) {
                    data_autoplay = 'autoplay';
                }
            }

            if( data_type == 'image' ) {
                $( '#lightbox-overlay' ).append( '<img src="'+ data_url +'">' );
            } else if( data_type == 'youtube' ) {
                $( '#lightbox-overlay' ).append( '<iframe width="640" height="360" src="https://www.youtube.com/embed/' + YouTubeGetID( data_url ) + '?autoplay=' + data_autoplay + '" frameborder="0" allowfullscreen></iframe>' );
            } else if ( data_type == 'vimeo' ) {
                $( '#lightbox-overlay' ).append( '<iframe src="https://player.vimeo.com/video/' + GetVimeoIDbyUrl( data_url ) + '?autoplay=' + data_autoplay + '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>' );
            } else if ( data_type == 'video' ) {
                $( '#lightbox-overlay' ).append( '<video controls="" ' + data_autoplay + ' width="640" height="360" ><source src="' + data_url + '" type="video/mp4"></video>' );
            }

            $( '#lightbox-overlay' ).addClass( 'open ' + data_animation );
        });

        /**
         * Get and set video id in the backend editor
         */
        function YouTubeGetID( $url ){
          var ID = '';
          $url = $url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
          if($url[2] !== undefined) {
            ID = $url[2].split(/[^0-9a-z_\-]/i);
            ID = ID[0];
          }
          else {
            ID = $url;
          }
            return ID;
        }

        function GetVimeoIDbyUrl( url ) {
          var id = false;
          $.ajax({
            url: 'https://vimeo.com/api/oembed.json?url='+url,
            async: false,
            success: function(response) {
              if(response.video_id) {
                id = response.video_id;
              }
            }
          });
          return id;
        }


        $( '.lightbox-overlay, .lightbox-overlay-close' ).on( 'click', function( e ) {
            e.preventDefault();
            close_video();
        } );

        $( document ).keyup( function( e ) {
            if( e.keyCode === 27 ) { close_video(); }
        } );

        function close_video() {
            $( '.lightbox-overlay.open' ).removeClass( 'open' ).find( 'iframe, img, video' ).remove();
        };
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/eae_lightbox.default', WidgetEaeLightboxJsHandler );
    } );

} )( jQuery );
