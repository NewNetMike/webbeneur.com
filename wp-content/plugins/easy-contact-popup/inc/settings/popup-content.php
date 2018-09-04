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

// Main Title
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-main-title]', array(
		'default'           => ecp_get_option( 'popup-main-title' ),
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_text' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-main-title]', array(
		'type'     	=> 'text',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 1,
		'label'		=> __( 'Main Title', 'easy-contact-popup' ),
	)
);

// Main Desc
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-desc]', array(
		'default'           => ecp_get_option( 'popup-desc' ),
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_text' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-desc]', array(
		'type'     	=> 'text',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 5,
		'label'		=> __( 'Main Description', 'easy-contact-popup' ),
	)
);

// Background color of popup container
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-select-form-type]', array(
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-select-form-type]', array(
		'type'     	=> 'select',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 10,
		'label'		=> __( 'Select Form Type', 'easy-contact-popup' ),
		'choices'  	=> array(
			'cf7' 			=> __( 'Contact Form 7', 'easy-contact-popup' ),
			'wpforms'		=> __( 'WPForms', 'easy-contact-popup' ),
			'gforms'		=> __( 'Gravity Forms', 'easy-contact-popup' ),
			'ninjaforms'	=> __( 'Ninja Forms', 'easy-contact-popup' ),
			'weforms' 		=> __( 'WeForms', 'easy-contact-popup' ),
		),
	)
);

// Contact form 7
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-select-cf7]', array(
		'type'					=> 'option',
		'transport'				=> 'refresh',
		'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-select-cf7]', array(
		'type'     	=> 'select',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 20,
		'label'		=> __( 'Select Contact Form 7', 'easy-contact-popup' ),
		'choices'  	=> Inc\Queries::select_wpcf7()
	)
);

// weForms
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-select-wpforms]', array(
		'type'				=> 'option',
		'transport'			=> 'refreash',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-select-wpforms]', array(
		'type'     	=> 'select',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 30,
		'label'		=> __( 'Select WPForms', 'easy-contact-popup' ),
		'choices'  	=> Inc\Queries::select_wpforms()
	)
);

// Gravity Forms
if( class_exists( 'GFForms' ) ) {

	$wp_customize->add_setting(
		ECP_PLUGIN_OPTIONS . '[popup-select-gravityforms]', array(
			'type'					=> 'option',
			'transport'				=> 'refreash',
			'sanitize_callback' 	=> array( 'Inc\Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		ECP_PLUGIN_OPTIONS . '[popup-select-gravityforms]', array(
			'type'     	=> 'select',
			'section'	=> 'ecp_section_content',
			'priority' 	=> 40,
			'label'		=> __( 'Select Gravity Forms', 'easy-contact-popup' ),
			'choices'  	=> Inc\Queries::select_gravity_form()
		)
	);
}

// Ninja Forms
if( function_exists('Ninja_Forms')) {
	$wp_customize->add_setting(
		ECP_PLUGIN_OPTIONS . '[popup-select-ninjaforms]', array(
			'type'				=> 'option',
			'transport'			=> 'refreash',
			'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
		)
	);

	$wp_customize->add_control(
		ECP_PLUGIN_OPTIONS . '[popup-select-ninjaforms]', array(
			'type'     	=> 'select',
			'section'	=> 'ecp_section_content',
			'priority' 	=> 60,
			'label'		=> __( 'Select Ninja Forms', 'easy-contact-popup' ),
			'choices'  	=> Inc\Queries::select_ninja_forms()
		)
	);
}

// weForms
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[popup-select-weforms]', array(
		'type'				=> 'option',
		'transport'			=> 'refreash',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_choices' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[popup-select-weforms]', array(
		'type'     	=> 'select',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 50,
		'label'		=> __( 'Select WeForms', 'easy-contact-popup' ),
		'choices'  	=> Inc\Queries::select_weforms()
	)
);

// Main Title
$wp_customize->add_setting(
	ECP_PLUGIN_OPTIONS . '[btn-title]', array(
		'default'           => __( 'Contact Us', 'easy-contact-popup' ),
		'type'				=> 'option',
		'transport'			=> 'refresh',
		'sanitize_callback' => array( 'Inc\Sanitizes', 'sanitize_text' ),
	)
);

$wp_customize->add_control(
	ECP_PLUGIN_OPTIONS . '[btn-title]', array(
		'type'     	=> 'text',
		'section'	=> 'ecp_section_content',
		'priority' 	=> 60,
		'label'		=> __( 'Button Title', 'easy-contact-popup' ),
	)
);
