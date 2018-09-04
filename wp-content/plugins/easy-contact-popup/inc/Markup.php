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

class Markup {

	/**
	 * Register function
	 *
	 * @since 2.0.0
	 */
	public function register() {
		add_action( 'wp_footer', array($this, 'output_markup' ) );
	}


	/**
	 * Output Markup
	 *
	 * @since 2.0.0
	 */
	public function output_markup() {
		$this->contact_form_markup();
		$this->contact_button();
	}

	/**
	 * Close Button
	 *
	 * @since 2.0.0
	 */
	public function close_button() {
		$html = '<button title="Close" type="button" class="mfp-close">&#215;</button>';
		return $html;
	}

	/**
	 * Header title
	 *
	 * @since 2.0.0
	 */
	public function header_title() {

		$main_title = ecp_get_option('popup-main-title');
		$main_desc 	= ecp_get_option('popup-desc');

		$html = '<h2> '. $main_title .' </h2>';
		$html .= '<p> '. $main_desc .' </p>';

		return $html;
	}

	/**
	 * Header section
	 *
	 * @since 2.0.0
	 */
	public function header_section() {

		$html = '<header class="header">';
		$html .= $this->header_title();
		$html .= '</header>';
		$html .= $this->close_button();

		return $html;
	}

	/**
	 * Vendor form
	 *
	 * @since 2.0.0
	 */
	public function form_option() {

		$html = '<div class="form-wrap">';

		$form_type = ecp_get_option( 'popup-select-form-type' );

		if( $form_type === 'cf7') {

			$options = ecp_get_option('popup-select-cf7');

			$html .= do_shortcode( '[contact-form-7 id="' . $options . '" ]' );

		} elseif ($form_type === 'gforms') {

			$options = ecp_get_option('popup-select-gravityforms');

			$html .= do_shortcode( '[gravityform id="'. $options .'"]' );

		} elseif ($form_type === 'weforms') {

			$options = ecp_get_option('popup-select-weforms');

			$html .= do_shortcode( '[weforms id="' . $options . '" ]' );

		} elseif ($form_type === 'wpforms') {

			$options = ecp_get_option('popup-select-wpforms');

			$html .= do_shortcode( '[wpforms id="' . $options . '"]' );

		} elseif ($form_type === 'ninjaforms') {

			$options = ecp_get_option('popup-select-ninjaforms');

			$html .= do_shortcode( '[ninja_form id="' . $options . '"]' );
		}
		 else {

			$options = ecp_get_option('');

		}

		$html .= '</div>';

		return $html;

	}

	/**
	 * Contact form
	 *
	 * @since 2.0.0
	 */
	public function contact_form_markup( $echo = true ) {

		$html = '<div id="easy-contact-popup" class="white-popup mfp-hide">';
		$html .= $this->header_section();
		$html .= $this->form_option();
		$html .= '</div>';

		if ( $echo = true ) {
			echo $html;
		} else {
			return $html;
		}
	}

	/**
	 * Contact form
	 *
	 * @since 2.0.0
	 */
	public function contact_button( $echo = true ) {

		$btn_float = ecp_get_option('btn-style-type');
		$btn_type = ecp_get_option('btn-float');
		$btn_title = ecp_get_option('btn-title');

		$html = '<a class="ecp-button ' . $btn_type . ' '. $btn_float .' " data-effect="mfp-zoom-in" href="#easy-contact-popup">';
		$html .= $btn_title;
		$html .= '</a>';

		if ( $echo = true ) {
			echo $html;
		} else {
			return $html;
		}
	}

}
