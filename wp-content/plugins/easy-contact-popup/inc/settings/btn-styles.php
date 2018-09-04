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

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-style-type]', array(
		'default'   		=> ecp_get_option( 'btn-style-type' ),
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[btn-style-type]', array(
		'type'     			=> 'select',
		'section'			=> 'ecp_section_btn',
		'priority' 			=> 10,
		'label'				=> __( 'Button Style Type', 'easy-contact-popup' ),
		'choices'  			=> array(
			'btn-normal'	=> __( 'Normal', 'easy-contact-popup' ),
			'btn-round'		=> __( 'Round', 'easy-contact-popup' ),
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-float]', array(
		'default'           => ecp_get_option( 'btn-float' ),
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[btn-float]', array(
		'type'     	=> 'select',
		'section'	=> 'ecp_section_btn',
		'priority' 	=> 20,
		'label'		=> __( 'Button Float', 'easy-contact-popup' ),
		'choices'  	=> array(
			'left-center' 		=> __( 'Left Center', 'easy-contact-popup' ),
			'right-center'		=> __( 'Right Center', 'easy-contact-popup' ),
		),
	)
);

// Background color of popup container
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-bg-color]', array(
		'default'           	=> ecp_get_option( 'btn-bg-color' ),
		'type'					=> 'option',
		'transport'				=> 'refresh',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[btn-bg-color]', array(
			'section'			=> 'ecp_section_btn',
			'priority'			=> 30,
			'label'				=> __( 'Button Backgorund Color', 'easy-contact-popup' )
		)
	)
);

// Button txt color
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-txt-color]', array(
		'default'           	=> ecp_get_option( 'btn-txt-color' ),
		'type'					=> 'option',
		'transport'				=> 'refresh',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[btn-txt-color]', array(
			'section'			=> 'ecp_section_btn',
			'priority'			=> 40,
			'label'				=> __( 'Button Text Color', 'easy-contact-popup' )
		)
	)
);

// Button Padding
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-txt-font-size]', array(
		'default'           	=> ecp_get_option( 'btn-txt-font-size' ),
		'type'					=> 'option',
		'transport'				=> 'refresh',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[btn-txt-font-size]', array(
		'type'      => 'number',
		'section'	=> 'ecp_section_btn',
		'priority'	=> 50,
		'label'		=> __( 'Button Font Size', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);
