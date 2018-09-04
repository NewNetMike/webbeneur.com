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

/**
 * Queries class
 *
 * @since 2.0.0
 */
class Queries {

	/**
	 * Contact form 7
	 */
	public static function select_wpcf7() {
		$wpcf7_list = get_posts( array(
			'post_type'	=> 'wpcf7_contact_form',
			'showposts' => 999,
			'order' => 'ASC'
		) );

		$post = array();

		if( !empty( $wpcf7_list ) && ! is_wp_error( $wpcf7_list )) {
			foreach ($wpcf7_list as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}

			return $options;

		}
	}

	/**
	 * Contact weforms
	 */
	public static function select_weforms() {

	    $wpuf_form_list = get_posts( array(
	        'post_type' => 'wpuf_contact_form',
	        'showposts' => 999,
			'order' => 'ASC'
	    ));

    	$posts = array();

	    if ( ! empty( $wpuf_form_list ) && ! is_wp_error( $wpuf_form_list ) ) {
	        foreach ( $wpuf_form_list as $post ) {
	            $options[ $post->ID ] = $post->post_title;
	        }
	        return $options;
	   	}
	}

	/**
	 * Contact gravity form
	 */
	public static function select_gravity_form() {

	    $forms = \RGFormsModel::get_forms( null, 'title' );

	    foreach( $forms as $form ) {
	      $options[ $form->id ] = $form->title;
	    }
    	return $options;

	}

		/**
	 * Contact weforms
	 */
	public static function select_wpforms() {

	    $wpforms_list = get_posts( array(
	        'post_type' => 'wpforms',
	        'showposts' => 999,
			'order' => 'ASC'
	    ));

    	$posts = array();

	    if ( ! empty( $wpforms_list ) && ! is_wp_error( $wpforms_list ) ) {
	        foreach ( $wpforms_list as $post ) {
	            $options[ $post->ID ] = $post->post_title;
	        }
	        return $options;
	   	}
	}

	/**
	 * Contact gravity form
	 */
	public static function select_ninja_forms() {

	    $options = array();

		if ( get_option( 'ninja_forms_load_deprecated', false ) ) {
			$forms = Ninja_Forms()->forms()->get_all();

			foreach ( $forms as $form_id ) {
				$options[ $form_id ] = Ninja_Forms()->form( $form_id )->get_setting( 'form_title' );;
			}

		} else {
			$forms = Ninja_Forms()->form()->get_forms();
			foreach ( $forms as $index => $form ) {
				$options[ $form->get_id() ] = $form->get_setting( 'title' );
			}
		}

	    return $options;

	}

}
