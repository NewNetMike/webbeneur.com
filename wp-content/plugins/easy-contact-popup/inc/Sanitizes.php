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

/**
 * Customizer Sanitizes Initial setup
 */
class Sanitizes {

	/**
	 * Sanitize Integer
	 *
	 * @param  number $input Customizer setting input number.
	 * @return number        Absolute number.
	 */
	static public function sanitize_integer( $input ) {
		return absint( $input );
	}

	/**
	 * Sanitize checkbox
	 *
	 * @param  number $input setting input.
	 * @return number        setting input value.
	 */
	static public function sanitize_checkbox( $input ) {
		if ( $input ) {
			$output = '1';
		} else {
			$output = false;
		}
		return $output;
	}

	/**
	 * Sanitize HEX color
	 */
	static public function sanitize_hex_color( $color ) {

		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return '';
	}

	/**
	 * Sanitize html
	 *
	 * @param  string $input    setting input.
	 * @return mixed            setting input value.
	 */
	static public function sanitize_html( $input ) {
		return wp_kses_post( $input );
	}

	/**
	 * Sanitize Select choices
	 */
	static public function sanitize_choices( $input, $setting ) {

		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Sanitize text
	 */
	static public function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}

}

