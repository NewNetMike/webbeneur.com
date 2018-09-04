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

class DynamicCSS {

	public static function retrun_output() {

		$dynamic_css = '';

		// Container size option
		$popup_width				=	ecp_get_option( 'popup-width' );

		// Container color Options
		$bg_color					=	ecp_get_option( 'popup-bg-color' );
		$txt_color					=	ecp_get_option( 'popup-txt-color' );

		// Popup padding
		$popup_padding_top			=	ecp_get_option( 'popup-padding-top' );
		$popup_padding_right		=	ecp_get_option( 'popup-padding-right' );
		$popup_padding_bottom		=	ecp_get_option( 'popup-padding-bottom' );
		$popup_padding_left			=	ecp_get_option( 'popup-padding-left' );

		// Heading color
		$heading_bg_color			=	ecp_get_option( 'heading-bg-color' );
		$heading_bg_image			=	ecp_get_option( 'heading-bg-image' );

		$heading_txt_color			=	ecp_get_option( 'heading-txt-color' );
		$heading_title_color		=	ecp_get_option( 'heading-title-color' );

		//Heading font size
		$heading_txt_font_size		=	ecp_get_option( 'heading-txt-font-size' );
		$heading_title_font_size	=	ecp_get_option( 'heading-title-font-size' );

		// Heading txt align
		$heading_txt_align			=	ecp_get_option( 'heading-txt-align' );

		// Heading padding
		$heading_padding_top		=	ecp_get_option( 'heading-padding-top' );
		$heading_padding_right		=	ecp_get_option( 'heading-padding-right' );
		$heading_padding_bottom		=	ecp_get_option( 'heading-padding-bottom' );
		$heading_padding_left		=	ecp_get_option( 'heading-padding-left' );


		// Button css
		$btn_bg_color				=	ecp_get_option( 'btn-bg-color' );
		$btn_txt_color				=	ecp_get_option( 'btn-txt-color' );
		$btn_txt_font_size			=	ecp_get_option( 'btn-txt-font-size' );


		// Css output
		$css_output		=	array(
			//Popup container
			'.white-popup '	=> array(
				'max-width'				=> $popup_width.'px',
			),

			//Form container
			'.white-popup .form-wrap'	=> array(
				'background-color'		=> $bg_color,
				'color'					=> $txt_color,

				'padding-top'			=>	$popup_padding_top.'px',
				'padding-right'			=>	$popup_padding_right.'px',
				'padding-bottom'		=>	$popup_padding_bottom.'px',
				'padding-left'			=>	$popup_padding_left.'px',
			),

			// Popup Heading
			'.white-popup .header'		=> array(
				'background-color'		=>	$heading_bg_color,
				'background-image'		=> "url('$heading_bg_image')",
				'color'					=>	$heading_txt_color,
				'font-size'				=>	$heading_txt_font_size.'px',

				'padding-top'			=>	$heading_padding_top.'px',
				'padding-right'			=>	$heading_padding_right.'px',
				'padding-bottom'		=>	$heading_padding_bottom.'px',
				'padding-left'			=>	$heading_padding_left.'px',

				'text-align'			=> $heading_txt_align,
			),

			'.white-popup .header h2'	=> array(
				'color'					=>	$heading_title_color,
				'font-size'				=>	$heading_title_font_size.'px'
			),

			'.ecp-button'				=> array(
				'background-color'		=>	$btn_bg_color,
				'color'					=>	$btn_txt_color,
				'font-size'				=>	$btn_txt_font_size.'px',
			),

			'.ecp-button:hover'			=> array(
				'background-color'		=>	$btn_bg_color,
				'color'					=>	$btn_txt_color,
				'opacity'				=> '0.8'
			)
		);

		$parse_css = Enqueue::parse_css( $css_output );
		$dynamic_css = $parse_css;
		$dynamic_css = Enqueue::trim_css( $dynamic_css );

		return $dynamic_css;
	}
}
