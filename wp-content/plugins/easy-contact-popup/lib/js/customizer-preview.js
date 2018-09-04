/**
 * Dynamic Internal/Embedded Style for a Control
 */
function ecp_add_dynamic_css( control, style ) {
	control = control.replace( '[', '-' );
	control = control.replace( ']', '' );
	jQuery( 'style#' + control ).remove();

	jQuery( 'head' ).append(
		'<style id="' + control + '">' + style + '</style>'
	);
}

// Main title and description.
wp.customize( 'ecp-option[popup-main-title]', function( value ) {
	value.bind( function( to ) {
		$( '.white-popup .header h2' ).text( to );
	});
});

/*
 * Popup width
 */
wp.customize( 'ecp-options[popup-width]', function( setting ) {
	setting.bind( function( popup_width ) {
		var dynamicStyle = '.white-popup  { max-width: ' + popup_width + 'px; }';
		ecp_add_dynamic_css( 'popup-width', dynamicStyle );
	} );
} );

/*
 * Padding top
 */
wp.customize( 'ecp-options[popup-padding-top]', function( setting ) {
	setting.bind( function( popup_padding_top ) {
		var dynamicStyle = '.white-popup .form-wrap { padding-top: ' + popup_padding_top + 'px; }';
		ecp_add_dynamic_css( 'popup-padding-top', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[popup-padding-right]', function( setting ) {
	setting.bind( function( popup_padding_right ) {
		var dynamicStyle = '.white-popup .form-wrap { padding-right: ' + popup_padding_right + 'px; }';
		ecp_add_dynamic_css( 'popup-padding-right', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[popup-padding-bottom]', function( setting ) {
	setting.bind( function( popup_padding_bottom ) {
		var dynamicStyle = '.white-popup .form-wrap { padding-bottom: ' + popup_padding_bottom + 'px; }';
		ecp_add_dynamic_css( 'popup-padding-bottom', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[popup-padding-left]', function( setting ) {
	setting.bind( function( popup_padding_left ) {
		var dynamicStyle = '.white-popup .form-wrap { padding-left: ' + popup_padding_left + 'px; }';
		ecp_add_dynamic_css( 'popup-padding-left', dynamicStyle );
	} );
} );

/*
 * Popup Background Color
 */
wp.customize( 'ecp-options[popup-bg-color]', function( setting ) {
	setting.bind( function( bg_color ) {
	if (bg_color != '') {
		var dynamicStyle = '.white-popup .form-wrap { background-color: ' + bg_color + ' }';
		ecp_add_dynamic_css( 'popup-bg-color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Popup Background Color
 */
wp.customize( 'ecp-options[popup-txt-color]', function( setting ) {
	setting.bind( function( txt_color ) {
	if (txt_color != '') {
		var dynamicStyle = '.white-popup .form-wrap { color: ' + txt_color + ' }';
		ecp_add_dynamic_css( 'popup-txt-color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Heading Background Color
 */
wp.customize( 'ecp-options[heading-bg-color]', function( setting ) {
	setting.bind( function( heading_bg_color ) {
	if ( heading_bg_color != '' ) {
		var dynamicStyle = '.white-popup .header { background-color: ' + heading_bg_color + ' }';
		ecp_add_dynamic_css( 'heading-bg-color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Heading title color
 */
wp.customize( 'ecp-options[heading-title-color]', function( setting ) {
	setting.bind( function( heading_title_color ) {
	if ( heading_title_color != '' ) {
		var dynamicStyle = '.white-popup .header { color: ' + heading_title_color + ' }';
		ecp_add_dynamic_css( 'heading-tiltle-color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Heading Background Color
 */
wp.customize( 'ecp-options[heading-txt-color]', function( setting ) {
	setting.bind( function( heading_txt_color ) {
	if ( heading_txt_color != '' ) {
		var dynamicStyle = '.white-popup .header { color: ' + heading_txt_color + ' }';
		ecp_add_dynamic_css( 'heading-txt-color', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Heaidng text align
 */
wp.customize( 'ecp-options[heading-txt-align]', function( setting ) {
	setting.bind( function( heading_txt_align ) {
	if ( heading_txt_align != '' ) {
		var dynamicStyle = '.white-popup .header { text-align: ' + heading_txt_align + ' }';
		ecp_add_dynamic_css( 'heading-txt-align', dynamicStyle );
	}
		else{
			wp.customize.preview.send( 'refresh' );
		}
	} );
} );

/*
 * Padding top
 */
wp.customize( 'ecp-options[heading-padding-top]', function( setting ) {
	setting.bind( function( heading_padding_top ) {
		var dynamicStyle = '.white-popup .header { padding-top: ' + heading_padding_top + 'px; }';
		ecp_add_dynamic_css( 'heading-padding-top', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[heading-padding-right]', function( setting ) {
	setting.bind( function( heading_padding_right ) {
		var dynamicStyle = '.white-popup .header { padding-right: ' + heading_padding_right + 'px; }';
		ecp_add_dynamic_css( 'heading-padding-right', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[heading-padding-bottom]', function( setting ) {
	setting.bind( function( heading_padding_bottom ) {
		var dynamicStyle = '.white-popup .header { padding-bottom: ' + heading_padding_bottom + 'px; }';
		ecp_add_dynamic_css( 'heading-padding-bottom', dynamicStyle );
	} );
} );

wp.customize( 'ecp-options[heading-padding-left]', function( setting ) {
	setting.bind( function( heading_padding_left ) {
		var dynamicStyle = '.white-popup .header { padding-left: ' + heading_padding_left + 'px; }';
		ecp_add_dynamic_css( 'heading-padding-left', dynamicStyle );
	} );
} );

