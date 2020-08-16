( function( api ) {

	// Extends our custom "writer" section.
	api.sectionConstructor['apex-business-notify'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function ($) {
    $( document ).on( 'click', '.js-customizer-notice-get-started-class .notice-dismiss', function () {
        // Read the "data-notice" information to track which notice
        // is being dismissed and send it via AJAX
        var type = $( this ).closest( '.js-customizer-notice-get-started-class' ).data( 'notice' );
        // Make an AJAX call
        $.ajax( ct_customizer_notice_data.ajaxurl,
          {
            type: 'POST',
            data: {
              action: 'apex_business_customizer_dismissed_notice_handler',
              type: type,
            },
            success: function (data) {
                $( '.js-customizer-notice-get-started-class' ).parent( '#accordion-section-apex-business-notify' ).hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
            }
          } );

        if ( $( this ).data( 'hide' ) == 'hide-accordian' ) {
            $( this ).parents( 'li' ).addClass( 'ct-accordian-hidden' );;
        }
    } );
});
