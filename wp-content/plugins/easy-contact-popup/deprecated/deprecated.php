<?php
/**
 * Easy Contact Popup Deprecated version
 *
 * @author Mohammad Fahim
 *
 * @since 2.0.0
 */

/*** Global Paths and Folders ***/
define( 'ECP_PLUGIN_MAIN_PATH' 	, 	 plugin_basename( __FILE__ ));
define( 'ECP_LIB_FOLDER'       	, 	 ECP_PLUGIN_URL	. './deprecated/lib/');
define( 'ECP_CSS_FOLDER'       	, 	 ECP_LIB_FOLDER	. 'css/');
define( 'ECP_JS_FOLDER'       	, 	 ECP_LIB_FOLDER	. 'js/');
define( 'ECP_INC_FOLDER'       	, 	 ECP_PLUGIN_PATH	. './deprecated/inc/');

/** Functions File Load **/
require(ECP_INC_FOLDER . 'functions.php');

/** Load All Scripts and CSS files **/
require(ECP_INC_FOLDER . 'enqueue-script.php');

/** Load ECP Options **/
require_once(ECP_INC_FOLDER . 'class.options-api.php');

require(ECP_INC_FOLDER . 'options.php');

/** Load All Hooks **/
require(ECP_INC_FOLDER . 'hooks.php');
