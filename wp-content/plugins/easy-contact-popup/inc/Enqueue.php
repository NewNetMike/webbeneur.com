<?php
/**
 * @package     EasyContactPopUp
 * @author      Brain Made
 * @copyright   Copyright (c) 2018, Brain Made
 * @link        https://brainmade.co/
 * @since       EasyContactPopUp 1.0.2
 */
namespace Inc;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Enqueue {

	/**
	 * Register function
	 *
	 * @since 2.0.0
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );
		add_action( 'wp_footer', array($this, 'popup_init'), 110 );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_notices_js') );
	}

	/**
	 * Admin menu pages
	 *
	 * @since 2.0.0
	 */
	function enqueue() {
		wp_enqueue_style( 'ecp-popup', ECP_PLUGIN_URL .'lib/css/popup.css');
		wp_add_inline_style( 'ecp-popup', DynamicCSS::retrun_output() );
		wp_enqueue_script( 'ecp-popup-js', ECP_PLUGIN_URL . 'lib/js/popup.min.js', false, false, true );
	}

	/**
	 * Admin menu pages
	 *
	 * @since 2.0.0
	 */
	function admin_notices_js() {
		wp_enqueue_script( 'admin-notice', ECP_PLUGIN_URL . 'lib/js/admin-notice.js', array('jquery'), '2.0.0', true );
	}

	public function popup_init() {
		?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
		         jQuery('.ecp-button').magnificPopup({
					type: 'inline',
					focus: 'input',
					modal: true,
					preloader: false,
					closeOnContentClick: false,
					closeOnBgClick: false,
					showCloseBtn: true,
					overflowY: 'auto'
		         });
				});
			</script>
		<?php
	}

	/**
	 * Trim Css
	 *
	 * @since 2.0.0
	 */
	public static function trim_css( $css = '' ) {
		// Trim white space for faster page loading.
		if ( ! empty( $css ) ) {
			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
			$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
			$css = str_replace( ', ', ',', $css );
		}
		return $css;
	}

	/**
	 * Parse css
	 *
	 * @since 2.0.0
	 */
	public static function parse_css( $css_output = array(), $min_media = '', $max_media = '' ) {
		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {
			foreach ( $css_output as $selector => $properties ) {
				if ( ! count( $properties ) ) {
					continue; }
				$temp_parse_css   = $selector . '{';
				$properties_added = 0;
				foreach ( $properties as $property => $value ) {
					if ( '' === $value ) {
						continue; }
					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}
				$temp_parse_css .= '}';
				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}
			if ( '' != $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {
				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';
				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}
				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}
				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}
				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';
				return $media_css;
			}
		}// End if().
		return $parse_css;
	}
}

