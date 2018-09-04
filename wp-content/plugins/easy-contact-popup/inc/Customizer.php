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

class Customizer {

	/**
	 * Register
	 *
	 * @since 2.0.0
	 */
	public function register() {
		add_action( 'customize_preview_init', array( $this, 'preview_init' ) );
		add_action( 'customize_register', array( $this, 'customizer_options' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_control_init' ) );
	}

	/**
	 * Custom controls
	 *
	 * @since 2.0.0
	 */
	public function customizer_options( $wp_customize ) {

		$wp_customize->add_panel( 'ecp_panel', array(
			'title'				=> __( 'Easy Contact PopUp', 'easy-contact-popup' ),
			'priority'

			=> 160,
		) );

		// Container Styles section
		$wp_customize->add_section( 'ecp_section_content' , array(
				'title' 		=> __( 'Popup Content', 'easy-contact-popup' ),
				'priority' 		=> 5,
				'panel'			=> 'ecp_panel'
			)
		);

		// Container Styles section
		$wp_customize->add_section( 'ecp_section_container' , array(
				'title' 			=> __( 'Popup Styles', 'easy-contact-popup' ),
				'priority' 		=> 10,
				'panel'			=> 'ecp_panel'
			)
		);

		// Heading styles section
		$wp_customize->add_section( 'ecp_section_heading' , array(
				'title' 			=> __( 'Heading Styles', 'easy-contact-popup' ),
				'priority' 		=> 15,
				'panel'			=> 'ecp_panel'
			)
		);

		// Button styles section
		$wp_customize->add_section( 'ecp_section_btn' , array(
				'title' 			=> __( 'Button Styles', 'easy-contact-popup' ),
				'priority' 		=> 20,
				'panel'			=> 'ecp_panel'
			)
		);
	}

	public function customize_register( $wp_customize ) {

		// Settings
		require ECP_PLUGIN_PATH . 'inc/settings/popup-content.php';
		require ECP_PLUGIN_PATH . 'inc/settings/container-styles.php';
		require ECP_PLUGIN_PATH . 'inc/settings/heading-styles.php';
		require ECP_PLUGIN_PATH . 'inc/settings/btn-styles.php';

	}

	function preview_init() {
		// Options refresh
		Options::refresh();

		wp_enqueue_script( 'ecp-customizer-preview-js', ECP_PLUGIN_URL . 'lib/js/customizer-preview.js', array( 'customize-preview' ), null, ECP_PLUGIN_VER );
	}

	function customizer_control_init() {
		wp_enqueue_script( 'ecp-customizer-control-js', ECP_PLUGIN_URL . 'lib/js/customize-controls.js', array(), null, ECP_PLUGIN_VER );
	}
}
