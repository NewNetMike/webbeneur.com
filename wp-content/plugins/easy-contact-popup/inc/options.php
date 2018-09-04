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

class Options {

	public static $db_options;

	public function register() {
		add_action( 'after_setup_theme', array( $this, 'refresh' ) );
	}

	public static function defaults() {
		return apply_filters('ecp_plugin_defaults', array(

			// Popup content
			'popup-main-title'			=> 'Popup Title',
			'popup-desc'				=> 'Popup Description',

			// Popup Container
			'popup-width'				=>	480,
			'popup-bg-color'			=> '#ffffff',
			'popup-txt-color'			=> '#000000',

			'popup-padding-top'			=> 10,
			'popup-padding-right'		=> 10,
			'popup-padding-bottom'		=> 10,
			'popup-padding-left'		=> 10,

			// Heading
			'heading-bg-color'			=> '#000000',

			'heading-title-color'		=> '#ffffff',
			'heading-title-font-size'	=> 24,

			'heading-txt-color'			=> '#ffffff',
			'heading-txt-font-size'		=> 16,
			'heading-txt-align'			=> 'center',

			'heading-padding-top'		=> 10,
			'heading-padding-right'		=> 0,
			'heading-padding-bottom'	=> 10,
			'heading-padding-left'		=> 0,

			// Button
			'btn-bg-color'				=> '#000000',
			'btn-txt-color'				=> '#ffffff',
			'btn-txt-font-size'			=> 16,
			'bbtn-style-type'			=> 'btn-normal',
			'btn-float'					=> 'left-center',
			'btn-title'					=> 'Contact Us'
			)
		);
	}

	public static function get_options() {
		return self::$db_options;
	}

	public function refresh() {
		self::$db_options = wp_parse_args(
			get_option( ECP_PLUGIN_OPTIONS ),
			self::defaults()
		);
	}

}
