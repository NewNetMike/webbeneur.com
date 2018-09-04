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
 * Easy Contact PopUp Class
 *
 * @since 2.0.0
 */
final class EasyContactPopup {

	/**
	 * Get Services
	 *
	 * @since 2.0.0
	 */
	public static function get_services() {
		return [
			Markup::class,
			Enqueue::class,
			Options::class,
			Customizer::class,
			Sanitizes::class,
			SettingLinks::class,
			AdminNotices::class
		];
	}

	/**
	 * Register function
	 *
	 * @since 2.0.0
	 */
	public static function register_services() {
		foreach (self::get_services() as $class) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Instantiate function
	 *
	 * @since 2.0.0
	 */
	private static function instantiate( $class ) {
		return new $class();
	}

}
