<?php
/**
 * @package     EasyContactPopUp
 * @author      Brain Made
 * @copyright   Copyright (c) 2018, Brain Made
 * @link        https://brainmade.co/
 * @since       EasyContactPopUp 1.0.2
 */

use Inc\Sanitizes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Popup Width
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-width]', array(
		'default'				=> 480,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[popup-width]', array(
		'type'      => 'number',
		'section'	=> 'ecp_section_container',
		'priority'	=> 5,
		'label'		=> __( 'PopUp Width', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 100,
			'max'  => 1920,
		),
	)
);

// Popup padding
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-padding-top]', array(
		'default'				=> 10,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[popup-padding-top]', array(
		'default'   => ecp_get_option( 'popup-padding-top' ),
		'section'	=> 'ecp_section_container',
		'priority'	=> 10,
		'label'		=> __( 'Popup Padding Top', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-padding-right]', array(
		'default'   			=> ecp_get_option( 'popup-padding-right' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[popup-padding-right]', array(
		'default'	=> 10,
		'type'      => 'number',
		'section'	=> 'ecp_section_container',
		'priority'	=> 20,
		'label'		=> __( 'Popup Padding Right', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-padding-bottom]', array(
		'default'   			=> ecp_get_option( 'popup-padding-bottom' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[popup-padding-bottom]', array(
		'type'      => 'number',
		'section'	=> 'ecp_section_container',
		'priority'	=> 30,
		'label'		=> __( 'Popup Padding Bottom', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-padding-left]', array(
		'default'   			=> ecp_get_option( 'popup-padding-left' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[popup-padding-left]', array(
		'type'      => 'number',
		'section'	=> 'ecp_section_container',
		'priority'	=> 40,
		'label'		=> __( 'Popup Padding Left', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

// Background color of popup container
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-bg-color]', array(
		'default'   			=> ecp_get_option( 'popup-bg-color' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[popup-bg-color]', array(
			'section'	=> 'ecp_section_container',
			'priority'	=> 50,
			'label'		=> __( 'Background Color', 'easy-contact-popup' )
		)
	)
);

// Background color of popup container
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-txt-color]', array(
		'default'   			=> ecp_get_option( 'popup-txt-color' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[popup-txt-color]', array(
			'section'	=> 'ecp_section_container',
			'priority'	=> 60,
			'label'		=> __( 'Popup Text Color', 'easy-contact-popup' )
		)
	)
);

