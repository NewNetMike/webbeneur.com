<?php
/**
 * @package     EasyContactPopUp
 * @author      Brain Made
 * @copyright   Copyright (c) 2018, Brain Made
 * @link        https://brainmade.co/
 * @since       @since 2.0.0
 */
namespace Inc;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SettingLinks {

	private $plugin = ECP_PLUGIN_NAME;

	/**
	 * Register
	 *
	 * @since 2.0.0
	 */
	public function register() {
		add_filter( "plugin_action_links_$this->plugin", array($this, 'ecp_setting_links'));
	}

	public function ecp_setting_links( $links ) {

		$settings_link = sprintf( '<a href="customize.php?autofocus[panel]=ecp_panel">' . __( 'Settings' ) . '</a>' );

		array_push( $links, $settings_link );

		// Return all links
   		return $links;
	}

}
