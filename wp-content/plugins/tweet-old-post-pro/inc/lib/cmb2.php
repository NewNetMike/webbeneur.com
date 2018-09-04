<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of "yourprefix_" with your project"s prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . "/cmb2/init.php") ) {
	require_once dirname( __FILE__ ) . "/cmb2/init.php";
} elseif ( file_exists( dirname( __FILE__ ) . "/CMB2/init.php") ) {
	require_once dirname( __FILE__ ) . "/CMB2/init.php";
}

add_action("cmb2_admin_init", "add_rop_custom_messages");

function add_rop_custom_messages()
{
	$prefix     = "rop_";
	$post_types = CWP_TOP_Core_PRO::getPostTypes();
	$post_types = is_array($post_types) ? $post_types : array($post_types);
	$cmb_demo = new_cmb2_box( array(
		"id"            => $prefix . "custom-messages-settings",
		"title"         => __("Revive Old Post - Custom Messages", CWP_TEXTDOMAIN),
		"object_types"  => $post_types ,
        "closed"        => false,
	) );

	$group_field_id     = $cmb_demo->add_field( array(
		'id'            => $prefix . 'custom-messages',
		'type'          => 'group',
		'repeatable'    => true,
        'options'     => array(
            'group_title'   => __( 'Custom Message', CWP_TEXTDOMAIN ),
            'add_button'    => __( 'Add Custom Message', CWP_TEXTDOMAIN ),
            'remove_button' => __( 'Remove Custom Message', CWP_TEXTDOMAIN ),
        ),
	) );

	$cmb_demo->add_group_field( $group_field_id, array(
		'name'       => __( 'Message', CWP_TEXTDOMAIN ),
		'id'         => 'message',
		'type'       => 'textarea_small',
		'attributes'    => array(
            'maxlength' => 140
        )
	) );

}