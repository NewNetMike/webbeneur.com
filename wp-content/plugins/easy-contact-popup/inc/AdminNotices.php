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

class AdminNotices {
	/**
	 * Register function
	 *
	 * @since 2.0.0
	 */
	public function register() {
		add_action( 'admin_notices', array($this, 'ecp_admin_notices') );
		add_action( 'admin_init', array($this, 'get_param_check') );
	}

	/**
	 * [ecp_admin_notices description]
	 * @return [type] [description]
	 */
	public function ecp_admin_notices() {

		global $pagenow;

		if( get_option( "ecp_notice_dismissed" ) ) {
			return;
		}

	if($pagenow == 'plugins.php') { ?>
		<div class="notice updated is-dismissible">
			<p><span style="color: #fe160a; font-weight: bold;"> Notice:</span> We are come up with some major changes and we rewrite the plugin code. <a style="color: #525ddc; font-weight: bold;" href="https://wordpress.org/plugins/easy-contact-popup/" target="_blank">Easy Contact PopUp</a> v2.0.1 now supported with all major contact form plugins. Let us know if you faced any issues.  <a style="color: #525ddc; font-weight: bold;" href="mailto:hello@brainmade.co" target="_top">Contact Us</a></p>
		</div>
	<?
	}

	}

	public function get_param_check() {
		if( isset($_GET['dismissed']) && $_GET['dismissed'] == yes ) {
			update_option( "ecp_notice_dismissed", yes );
		}
	}
}


