<?php
/**
 *  Main Loder for ROP_PRO
 *
 * @package ROP_PRO
 * @author ReviveSocial
 * @since 1.0.0
 */

/**
 * Plugin Name: Revive old post Pro Add-on
 * Plugin URI: https://revive.socia/plugins/revive-old-post
 * Description: This addon enable the pro functions of Revive Old Post plugin.For questions, comments, or feature requests, <a href="http://reviev.social/support/">contact </a> us!
 * Author: ReviveSocial
 * Version: 1.9.0
 * Author URI: http://revive.social
 */

if ( ! defined( 'CWP_TEXTDOMAIN' ) ) {
	define( 'CWP_TEXTDOMAIN','tweet-old-post' );
}
// Added by Ash/Upwork
define( 'ROPPROPLUGINFILE', __FILE__ );
// Added by Ash/Upwork
define( 'ROPPROPLUGINPATH' ,realpath( dirname( __FILE__ ) ) );
define( 'VERSION_CHECK' ,true );
define( 'ROP_IMAGE_CHECK' ,true );
define( 'ROP_PRO_1_5', true );
define( 'ROP_PRO_VERSION' ,'1.9.0' );
require_once( ROPPROPLUGINPATH.'/inc/core-pro.php' );



function tweet_old_post_pro_themeisle_sdk(){
	require 'vendor/themeisle/load.php';
	themeisle_sdk_register (
		array(
			'product_slug'=>'tweet-old-post-pro',
			'store_url'=>'http://revive.social',
			'store_name'=>'ReviveSocial',
			'product_type'=>'plugin',
			'wordpress_available'=>false,
			'paid'=>true,
		)
	);
}

tweet_old_post_pro_themeisle_sdk(); 

 
