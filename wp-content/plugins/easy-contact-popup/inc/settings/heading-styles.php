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

// Background color of popup container
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-bg-color]', array(
		'default'           	=> ecp_get_option( 'heading-bg-color' ),
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[heading-bg-color]', array(
			'section'			=> 'ecp_section_heading',
			'priority'			=> 5,
			'label'				=> __( 'Heading Backgorund Color', 'easy-contact-popup' )
		)
	)
);


/**
 * Option: Heading txt align
 */
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-txt-align]', array(
		'default'           => ecp_get_option( 'site-content-layout' ),
		'type'              => 'option',
		'transport'			  => 'postMessage',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[heading-txt-align]', array(
		'default' 			 => ecp_get_option( 'heading-txt-align' ),
		'type'     			 => 'select',
		'section'  			 => 'ecp_section_heading',
		'priority' 			 => 10,
		'label'    			 => __( 'Heading Text Align', 'easy-contact-popup' ),
		'choices'  			 => array(
			'left' 		=> __( 'Left', 'easy-contact-popup' ),
			'center'	=> __( 'Center', 'easy-contact-popup' ),
			'right' 	=> __( 'Right', 'easy-contact-popup' ),
		),
	)
);

// Heading title color
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-title-color]', array(
		'default' 			 	=> ecp_get_option( 'heading-title-color' ),
		'default'				=> '#FFF',
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[heading-title-color]', array(
			'section'			=> 'ecp_section_heading',
			'priority'			=> 20,
			'label'				=> __( 'Heading Title Color', 'easy-contact-popup' )
		)
	)
);

// Heading txt color
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-txt-color]', array(
		'default'				=> '#FFF',
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_hex_color' ),
	)
);

$wp_customize->add_control(
	new \WP_Customize_Color_Control(
		$wp_customize, ECP_PLUGIN_OPTIONS . '[heading-txt-color]', array(
			'section'			=> 'ecp_section_heading',
			'priority'			=> 30,
			'label'				=> __( 'Heading Text Color', 'easy-contact-popup' )
		)
	)
);

// Heading Padding
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-padding-top]', array(
		'default'				=> 10,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[heading-padding-top]', array(
		'default'	=> ecp_get_option( 'heading-padding-top' ),
		'type'      => 'number',
		'section'	=> 'ecp_section_heading',
		'priority'	=> 40,
		'label'		=> __( 'Heading Padding Top', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-padding-right]', array(
		'default'				=> 10,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[heading-padding-right]', array(
		'default'	=> ecp_get_option( 'heading-padding-right' ),
		'type'      => 'number',
		'section'	=> 'ecp_section_heading',
		'priority'	=> 50,
		'label'		=> __( 'Heading Padding Right', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-padding-bottom]', array(
		'default'				=> 10,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[heading-padding-bottom]', array(
		'default'	=> ecp_get_option( 'heading-padding-bottom' ),
		'type'      => 'number',
		'section'	=> 'ecp_section_heading',
		'priority'	=> 60,
		'label'		=> __( 'Heading Padding Bottom', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);

$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[heading-padding-left]', array(
		'default'				=> 10,
		'type'					=> 'option',
		'transport'				=> 'postMessage',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_integer' ),
	)
);

$wp_customize->add_control( ECP_PLUGIN_OPTIONS . '[heading-padding-left]', array(
		'default'	=> ecp_get_option( 'heading-padding-left' ),
		'type'      => 'number',
		'section'	=> 'ecp_section_heading',
		'priority'	=> 70,
		'label'		=> __( 'Heading Padding Left', 'easy-contact-popup' ),
		'input_attrs' => array(
			'min'  => 0,
			'step' => 1,
			'max'  => 800,
		),
	)
);
