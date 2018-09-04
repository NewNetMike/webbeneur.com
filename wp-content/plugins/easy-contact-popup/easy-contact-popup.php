<?php
/*
Plugin Name: Easy Contact PopUP
Plugin URI: https://brainmade.co
Description: Highly Customizable, stylish, modern, flexible, responsive, beautiful and easy to use contact pop-up plugin for WordPress.
Version: 2.0.3
Author: Brain Made
Author URI: https://brainmade.co
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: easy-contact-popup
Copyright 2018  Brain Made  (email : hello@brainmade.co)
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Autoload
 *
 * @since 2.0.0
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Define global paths
 *
 * @since 2.0.0
 */
define( 'ECP_PLUGIN_VER'		,	'2.0.2' );
define( 'ECP_PLUGIN_URL'		,	plugin_dir_url( __FILE__ ) );
define( 'ECP_PLUGIN_PATH'		,	plugin_dir_path( __FILE__ ) );
define( 'ECP_PLUGIN_NAME'		,	plugin_basename( __FILE__ ) );
define( 'ECP_PLUGIN_OPTIONS'	,	'ecp-options' );

/**
 * Kicking this off by calling 'register_services()' method
 */
if ( class_exists( 'Inc\\EasyContactPopup' ) ) {
	Inc\EasyContactPopup::register_services();
}

/**
 * Easy Contact PopUp Get_Options
 */
if ( ! function_exists( 'ecp_get_option' ) ) {

	function ecp_get_option( $option, $default = '') {

		$ecp_options = Inc\Options::get_options();

		$value = ( isset( $ecp_options[ $option ] ) && '' !== $ecp_options[ $option ] ) ? $ecp_options[ $option ] : $default;

		return apply_filters( "ecp_get_option_{$option}", $value, $option, $default );
	}
}

/**
 * Deactivation
 *
 * @since v2.0.0
 */
function ecp_deactivation() {
    delete_option( 'ecp_notice_dismissed' );
}

register_deactivation_hook(__FILE__, 'ecp_deactivation');
