(function( $ ) {

	'use strict';

	$(function() {

		$( '.subscribe-plugin' ).each( function () {
			var $this = $(this);
			$this.closest('tr').addClass('hidden');

			if ( $('body').hasClass('wp-subscribe-active-free') ) {
				if ( $this.hasClass('subscribe-free') ) {
					$this.closest('tr').removeClass('hidden');
				}
			} else if ( $('body').hasClass('wp-subscribe-active-pro') ) {
				if ( $this.hasClass('subscribe-pro') ) {
					$this.closest('tr').removeClass('hidden');
				}
			} else if ( $('body').hasClass('wp-subscribe-active-none') ) {
				if ( $this.hasClass('subscribe-none') ) {
					$this.closest('tr').removeClass('hidden');
				}
			}
		});

		$('.mts-child-option').closest('tr').addClass('mts-child-option-tr');

		// Select which shows/hides options based on its value
		function mtsShowHideChildOptions( el ) {
			var $this = $(el),
				tempValue = $this.val(),
				targetSelector = '.mts-mother-id-'+$this.attr('id'),
				activeSelector = '.'+$this.attr('id')+'-'+tempValue;

			$( targetSelector ).closest('tr').removeClass('mts-active');

			if ( tempValue && activeSelector ) {

				$( activeSelector ).closest('tr').addClass('mts-active');
			}
		}

		$('select.mts-mother-select').each(function() {
			mtsShowHideChildOptions( $(this) );
		});

		$(document).on('change', 'select.mts-mother-select', function(e) {
			mtsShowHideChildOptions( $(this) );
		});
	});

})( jQuery );