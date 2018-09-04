<?php

defined('ABSPATH') or die;

/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'steadyincome'),
				'desc' => '<p class="description">'.__('This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.', 'steadyincome').'</p>',
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'steadyincome');

//Setup custom links in the footer for share icons
if ( ! MTS_THEME_WHITE_LABEL ) {
	//Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
		'link' => 'http://twitter.com/mythemeshopteam',
		'title' => __( 'Follow Us on Twitter', 'steadyincome' ),
		'img' => 'fa fa-twitter-square'
	);
	$args['share_icons']['facebook'] = array(
		'link' => 'http://www.facebook.com/mythemeshop',
		'title' => __( 'Like us on Facebook', 'steadyincome' ),
		'img' => 'fa fa-facebook-square'
	);
}

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = MTS_THEME_NAME;

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'steadyincome');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Theme Options', 'steadyincome');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 62;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
if ( ! MTS_THEME_WHITE_LABEL ) {
	//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition
	$args['help_tabs'][] = array(
		'id' => 'nhp-opts-1',
		'title' => __('Support', 'steadyincome' ),
		'content' => '<p>' . sprintf( __('If you are facing any problem with our theme or theme option panel, head over to our %s.', 'steadyincome' ), '<a href="http://community.mythemeshop.com/">'. __( 'Support Forums', 'steadyincome' ) . '</a>' ) . '</p>'
	);
	$args['help_tabs'][] = array(
		'id' => 'nhp-opts-2',
		'title' => __('Earn Money', 'steadyincome' ),
		'content' => '<p>' . sprintf( __('Earn 70%% commision on every sale by refering your friends and readers. Join our %s.', 'steadyincome' ), '<a href="http://mythemeshop.com/affiliate-program/">' . __( 'Affiliate Program', 'steadyincome' ) . '</a>' ) . '</p>'
	);
}

//Set the Help Sidebar for the options page - no sidebar by default										
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'steadyincome');

$mts_patterns = array(
	'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
	'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
	'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
	'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
	'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
	'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
	'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
	'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
	'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
	'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
	'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
	'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
	'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
	'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
	'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
	'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
	'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
	'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
	'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
	'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
	'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
	'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
	'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
	'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
	'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
	'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
	'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
	'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
	'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
	'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
	'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
	'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
	'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
	'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
	'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
	'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
	'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
	'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
	'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png'),
	'hbg' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg.png'),
	'hbg2' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg2.png'),
	'hbg3' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg3.png'),
	'hbg4' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg4.png'),
	'hbg5' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg5.png'),
	'hbg6' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg6.png'),
	'hbg7' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg7.png'),
	'hbg8' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg8.png'),
	'hbg9' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg9.png'),
	'hbg10' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg10.png'),
	'hbg11' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg11.png'),
	'hbg12' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg12.png'),
	'hbg13' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg13.png'),
	'hbg14' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg14.png'),
	'hbg15' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg15.png'),
	'hbg16' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg16.png'),
	'hbg17' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg17.png'),
	'hbg18' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg18.png'),
	'hbg19' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg19.png'),
	'hbg20' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg20.png'),
	'hbg21' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg21.png'),
	'hbg22' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg22.png'),
	'hbg23' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg23.png'),
	'hbg24' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg24.png'),
	'hbg25' => array('img' => NHP_OPTIONS_URL.'img/patterns/hbg25.png')
);

$sections = array();

$sections[] = array(
				'icon' => 'fa fa-cogs',
				'title' => __('General Settings', 'steadyincome'),
				'desc' => '<p class="description">' . __('This tab contains common setting options which will be applied to the whole theme.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_logo',
						'type' => 'upload',
						'title' => __('Logo Image', 'steadyincome'), 
						'sub_desc' => __('Upload your logo using the Upload Button or insert image URL.[Recommended logo height: 44px]', 'steadyincome')
						),
					array(
						'id' => 'mts_favicon',
						'type' => 'upload',
						'title' => __('Favicon', 'steadyincome' ),
						'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s favicon.', 'steadyincome' ), '<strong>32 x 32 px</strong>' )
						),
					array(
						'id' => 'mts_touch_icon',
						'type' => 'upload',
						'title' => __('Touch icon', 'steadyincome' ),
						'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s touch icon for iOS 2.0+ and Android 2.1+ devices.', 'steadyincome' ), '<strong>152 x 152 px</strong>' )
						),
					array(
						'id' => 'mts_metro_icon',
						'type' => 'upload',
						'title' => __('Metro icon', 'steadyincome' ),
						'sub_desc' => sprintf( __('Upload a %s image that will represent your website\'s IE 10 Metro tile icon.', 'steadyincome' ), '<strong>144 x 144 px</strong>' )
						),
					array(
						'id' => 'mts_twitter_username',
						'type' => 'text',
						'title' => __('Twitter Username', 'steadyincome'),
						'sub_desc' => __('Enter your Username here.', 'steadyincome'),
						),
					array(
						'id' => 'mts_feedburner',
						'type' => 'text',
						'title' => __('FeedBurner URL', 'steadyincome' ),
						'sub_desc' => sprintf( __('Enter your FeedBurner\'s URL here, ex: %s and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'steadyincome' ), '<strong>http://feeds.feedburner.com/mythemeshop</strong>' ),
						'validate' => 'url'
						),
					array(
						'id' => 'mts_header_code',
						'type' => 'textarea',
						'title' => __('Header Code', 'steadyincome' ),
						'sub_desc' => wp_kses( __('Enter the code which you need to place <strong>before closing &lt;/head&gt; tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'steadyincome' ), array( 'strong' => '' ) )
						),
					array(
						'id' => 'mts_analytics_code',
						'type' => 'textarea',
						'title' => __('Footer Code', 'steadyincome' ),
						'sub_desc' => wp_kses( __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'steadyincome' ), array( 'strong' => '' ) )
						),
                     array(
                        'id' => 'mts_ajax_search',
                        'type' => 'button_set',
                        'title' => __('AJAX Quick search', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Enable or disable search results appearing instantly below the search form', 'steadyincome' ),
						'std' => '0'
                        ),
					array(
						'id' => 'mts_responsive',
						'type' => 'button_set',
						'title' => __('Responsiveness', 'steadyincome'),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('MyThemeShop themes are responsive, which means they adapt to tablet and mobile devices, ensuring that your content is always displayed beautifully no matter what device visitors are using. Enable or disable responsiveness using this option.', 'steadyincome'),
						'std' => '1'
						),
					array(
						'id' => 'mts_rtl',
						'type' => 'button_set',
						'title' => __('Right To Left Language Support', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Enable this option for right-to-left sites.', 'steadyincome'),
						'std' => '0'
						),
					array(
						'id' => 'mts_shop_products',
						'type' => 'text',
						'title' => __('No. of Products', 'steadyincome' ),
						'sub_desc' => __('Enter the total number of products which you want to show on shop page (WooCommerce plugin must be enabled).', 'steadyincome' ),
						'validate' => 'numeric',
						'std' => '9',
						'class' => 'small-text'
						),
					)
				);

$sections[] = array(
				'icon' => 'fa fa-bolt',
				'title' => __('Performance', 'steadyincome' ),
				'desc' => '<p class="description">' . __('This tab contains performance-related options which can help speed up your website.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_prefetching',
						'type' => 'button_set',
						'title' => __('Prefetching', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Enable or disable prefetching. If user is on homepage, then single page will load faster and if user is on single page, homepage will load faster in modern browsers.', 'steadyincome' ),
						'std' => '0'
						),
					array(
						'id' => 'mts_lazy_load',
						'type' => 'button_set_hide_below',
						'title' => __('Lazy Load', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Delay loading of images outside of viewport, until user scrolls to them.', 'steadyincome' ),
						'std' => '0',
						'args' => array('hide' => 2)
						),
					array(
						'id' => 'mts_lazy_load_thumbs',
						'type' => 'button_set',
						'title' => __('Lazy load featured images', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Enable or disable Lazy load of featured images across site.', 'steadyincome' ),
						'std' => '0'
						),
					array(
						'id' => 'mts_lazy_load_content',
						'type' => 'button_set',
						'title' => __('Lazy load post content images', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Enable or disable Lazy load of images inside post/page content.', 'steadyincome' ),
						'std' => '0'
						),
					array(
						'id' => 'mts_async_js',
						'type' => 'button_set',
						'title' => __('Async JavaScript', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => sprintf( __('Add %s attribute to script tags to improve page download speed.', 'steadyincome' ), '<code>async</code>' ),
						'std' => '1',
						),
					array(
						'id' => 'mts_remove_ver_params',
						'type' => 'button_set',
						'title' => __('Remove ver parameters', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => sprintf( __('Remove %s parameter from CSS and JS file calls. It may improve speed in some browsers which do not cache files having the parameter.', 'steadyincome' ), '<code>ver</code>' ),
						'std' => '1',
						),
					array(
						'id' => 'mts_optimize_wc',
						'type' => 'button_set',
						'title' => __('Optimize WooCommerce scripts', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Load WooCommerce scripts and styles only on WooCommerce pages (WooCommerce plugin must be enabled).', 'steadyincome' ),
						'std' => '1'
						),
					'cache_message' => array(
						'id' => 'mts_cache_message',
						'type' => 'info',
						'title' => __('Use Cache', 'steadyincome' ),
						'desc' => sprintf(
							__('A cache plugin can increase page download speed dramatically. We recommend using %1$s or %2$s.', 'steadyincome' ),
							'<a href="https://community.mythemeshop.com/tutorials/article/8-make-your-website-load-faster-using-w3-total-cache-plugin/" target="_blank" title="W3 Total Cache">W3 Total Cache</a>',
							'<a href="'.admin_url( 'plugin-install.php?tab=plugin-information&plugin=wp-super-cache&TB_iframe=true&width=772&height=574' ).'" class="thickbox" title="WP Super Cache">WP Super Cache</a>'
						),
					),
				)
			);

// Hide cache message on multisite or if a chache plugin is active already
if ( is_multisite() || strstr( join( ';', get_option( 'active_plugins' ) ), 'cache' ) ) {
	unset( $sections[1]['fields']['cache_message'] );
}

$sections[] = array(
				'icon' => 'fa fa-adjust',
				'title' => __('Styling Options', 'steadyincome'),
				'desc' => '<p class="description">' . __('Control the visual appearance of your theme, such as colors, layout and patterns, from here.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_color_scheme',
						'type' => 'color',
						'title' => __('Color Scheme', 'steadyincome'), 
						'sub_desc' => __('The theme comes with unlimited color schemes for your theme\'s styling.', 'steadyincome'),
						'std' => '#3fc5a4'
						),
					array(
						'id' => 'mts_layout',
						'type' => 'radio_img',
						'title' => __('Layout Style', 'steadyincome'), 
						'sub_desc' => wp_kses( __('Choose the <strong>default sidebar position</strong> for your site. The position of the sidebar for individual posts can be set in the post editor.', 'steadyincome' ), array( 'strong' => '' ) ),
						'options' => array(
										'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png'),
										'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png')
											),
						'std' => 'cslayout'
						),
					array(
						'id' => 'mts_background',
						'type' => 'background',
						'title' => __('Site Background', 'steadyincome' ),
						'sub_desc' => __('Set background color, pattern and image from here.', 'steadyincome' ),
						'options' => array(
							'color'         => '',            // false to disable, not needed otherwise
							'image_pattern' => $mts_patterns, // false to disable, array of options otherwise ( required !!! )
							'image_upload'  => '',            // false to disable, not needed otherwise
							'repeat'        => array(),       // false to disable, array of options to override default ( optional )
							'attachment'    => array(),       // false to disable, array of options to override default ( optional )
							'position'      => array(),       // false to disable, array of options to override default ( optional )
							'size'          => array(),       // false to disable, array of options to override default ( optional )
							'gradient'      => '',            // false to disable, not needed otherwise
							'parallax'      => array(),       // false to disable, array of options to override default ( optional )
						),
						'std' => array(
							'color'         => '#ffffff',
							'use'           => 'pattern',
							'image_pattern' => 'nobg',
							'image_upload'  => '',
							'repeat'        => 'repeat',
							'attachment'    => 'scroll',
							'position'      => 'left top',
							'size'          => 'cover',
							'gradient'      => array('from' => '#ffffff', 'to' => '#000000', 'direction' => 'horizontal' ),
							'parallax'      => '0',
						)
					),
					array(
						'id' => 'mts_custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'steadyincome'), 
						'sub_desc' => __('You can enter custom CSS code here to further customize your theme. This will override the default CSS used on your site.', 'steadyincome')
						),
					array(
						'id' => 'mts_lightbox',
						'type' => 'button_set',
						'title' => __('Lightbox', 'steadyincome' ),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'steadyincome' ),
						'std' => '0'
					),
					
					)
				);
$sections[] = array(
				'icon' => 'fa fa-credit-card',
				'title' => __('Header', 'steadyincome'),
				'desc' => '<p class="description">' . __('From here, you can control the elements of header section.', 'steadyincome' ) . '</p>',
				'fields' => array(
                    array(
						'id' => 'mts_sticky_nav',
						'type' => 'button_set',
						'title' => __('Sticky Header', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to keep header visible even when scrolled down.', 'steadyincome'),
						'std' => '0'
						),
					array(
						'id' => 'mts_show_primary_nav',
						'type' => 'button_set',
						'title' => __('Show Primary Menu', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => sprintf( __('Use this button to enable %s.', 'steadyincome' ), '<strong>' . __( 'Primary Navigation Menu', 'steadyincome' ) . '</strong>' ),
						'std' => '1'
						),
					array(
						'id' => 'mts_show_footer_nav',
						'type' => 'button_set',
						'title' => __('Show Footer Menu', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => wp_kses( __('Use this button to enable <strong>Footer Navigation Menu</strong> (footer menu).', 'steadyincome' ), array( 'strong' => '' ) ),
						'std' => '1'
						),
					array(
						'id' => 'mts_header_section2',
						'type' => 'button_set',
						'title' => __('Show Logo', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => wp_kses( __('Use this button to Show or Hide the <strong>Logo</strong> completely.', 'steadyincome' ), array( 'strong' => '' ) ),
						'std' => '1'
						),
					array('id' => 'mts_header_bottom_text',
						'type' => 'text',
						'title' => __('Header Right Side Text', 'steadyincome'), 
						'sub_desc' => __('Appears to the right side of Breadcrumbs', 'steadyincome'),
						'std' => __('Download my Ebook', 'steadyincome'),
                        ), 
					array('id' => 'mts_header_bottom_button_text',
						'type' => 'text',
						'title' => __('Header Right Button Text', 'steadyincome'), 
						'sub_desc' => __('Enter Button label here', 'steadyincome'),
						'std' => __('Start Earning Today!', 'steadyincome'),
                        ), 
					array('id' => 'mts_header_bottom_button_link',
						'type' => 'text',
						'title' => __('Header Right Button Link', 'steadyincome'), 
						'sub_desc' => __('Enter button link here.', 'steadyincome'),
						'std' => '#',
                    ), 
				)
			);
$sections[] = array(
				'icon' => 'fa fa-home',
				'title' => __('Homepage', 'steadyincome'),
				'desc' => '<p class="description">' . __('From here, you can control the elements of the homepage.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_banner_show',
						'type' => 'button_set_hide_below',
						'title' => __('Homepage Banner', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to show banner on Homepage.', 'steadyincome'),
						'std' => '1',
                        'args' => array('hide' => 7)
						),
					array(
                        'id' => 'mts_banner_image',
						'type' => 'upload',
						'title' => __('Homepage Banner Image', 'steadyincome'), 
						'sub_desc' => __('Upload or select an image for homepage banner', 'steadyincome'),
						'std' => get_template_directory_uri().'/images/header.jpg',
						),
					
					array('id' => 'mts_banner_title',
						'type' => 'text',
						'title' => __('Homepage Banner Title', 'steadyincome'), 
						'sub_desc' => __('Choose Title of the homepage banner', 'steadyincome'),
						'std' => __('Start Earning Steady Income Today!','steadyincome'),
                        ), 
					array('id' => 'mts_banner_texts',
						'type' => 'textarea',
						'title' => __('Homepage Banner Description', 'steadyincome'), 
						'sub_desc' => __('Enter your banner description here', 'steadyincome'),
						'std' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at nisl lorem, vel porttitor justo. Nunc non mauris elit. Nam enim massa commodo ut placerat.','steadyincome'),
                        ),
                    array('id' => 'mts_button_text',
						'type' => 'text',
						'title' => __('Homepage Banner Button text', 'steadyincome'), 
						'sub_desc' => __('Enter text for the homepage Button', 'steadyincome'),
						'std' => __('Get Started Here','steadyincome'),
                        ),
                    array(
						'id' => 'mts_banner_button_bg',
						'type' => 'color',
						'title' => __('Button Background Color', 'steadyincome'), 
						'sub_desc' => __('Pick a color for the button present in homepage featured area.', 'steadyincome'),
						'std' => '#FF9742'
						),
                    array(
	                    'id' => 'mts_arrow_image',
						'type' => 'upload',
						'title' => __('Button Arrow Image', 'steadyincome'), 
						'sub_desc' => __('Upload or select an image for an Arrow which appears along with the button.', 'steadyincome'),
						'std' => get_template_directory_uri().'/images/arrow.png',
						), 
                    array(
                        'id' => 'mts_form_image',
						'type' => 'upload',
						'title' => __('Home Subscription Form Image', 'steadyincome'), 
						'sub_desc' => __('Upload or select an image for Subscription form which appears when user click the Button', 'steadyincome'),
						'std' => get_template_directory_uri().'/images/money.png',
						),
                    array(
						'id' => 'mts_ribbon_show',
						'type' => 'button_set',
						'title' => __('FREE Ribbon on form', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to show ribbon on Home Subscription Form', 'steadyincome'),
						'std' => '1',
						),
                    array(
						'id' => 'mts_banner2_show',
						'type' => 'button_set_hide_below',
						'title' => __('Homepage Social Icons & Books Section', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to show Social Icons & Books section on Homepage.', 'steadyincome'),
						'std' => '1',
						'args' => array('hide' => 6)
						),
                    array('id' => 'mts_social_title',
						'type' => 'text',
						'title' => __('Heading for Social Icons', 'steadyincome'), 
						'sub_desc' => __('Heading for social icons', 'steadyincome'),
						'std' => wp_kses( __('Join Over <strong>100,000</strong> People in Our Online Community!', 'steadyincome' ), array( 'strong' => '' ) ),
                        ), 
                    array(
                     	'id' => 'mts_banner_social',
                     	'title' => __('Homepage Social Icons', 'steadyincome'), 
                     	'sub_desc' => __( 'Add Social Media icons on Featured area present on the homepage.', 'steadyincome' ),
                     	'type' => 'group',
                     	'groupname' => __('Banner Icons', 'steadyincome'), // Group name
                     	'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_banner_icon_title',
            						'type' => 'text',
            						'title' => __('Title', 'steadyincome'), 
            						),
								array(
                                    'id' => 'mts_banner_icon',
            						'type' => 'icon_select',
            						'title' => __('Icon', 'steadyincome')
            						),
								array(
                                    'id' => 'mts_banner_icon_link',
            						'type' => 'text',
            						'title' => __('URL', 'steadyincome'), 
            						),
			                	),
                        'std' => array(
            					'facebook' => array(
            						'group_title' => 'Facebook',
            						'group_sort' => '1',
            						'mts_banner_icon_title' => 'Facebook',
            						'mts_banner_icon' => 'facebook',
            						'mts_banner_icon_link' => '#',
            					),
            					'twitter' => array(
            						'group_title' => 'Twitter',
            						'group_sort' => '2',
            						'mts_banner_icon_title' => 'Twitter',
            						'mts_banner_icon' => 'twitter',
            						'mts_banner_icon_link' => '#',
            					),
            					'gplus' => array(
            						'group_title' => 'Google Plus',
            						'group_sort' => '3',
            						'mts_banner_icon_title' => 'Google Plus',
            						'mts_banner_icon' => 'google-plus',
            						'mts_banner_icon_link' => '#',
            					),
            					'youtube' => array(
            						'group_title' => 'YouTube',
            						'group_sort' => '4',
            						'mts_banner_icon_title' => 'YouTube',
            						'mts_banner_icon' => 'youtube-play',
            						'mts_banner_icon_link' => '#',
            					),
            					'rss' => array(
            						'group_title' => 'RSS',
            						'group_sort' => '5',
            						'mts_banner_icon_title' => 'RSS',
            						'mts_banner_icon' => 'rss',
            						'mts_banner_icon_link' => '#',
            					)
            				)
                        ),
					array('id' => 'mts_books_title',
						'type' => 'text',
						'title' => __('Heading for Book Images', 'steadyincome'), 
						'sub_desc' => __('Set heading for Books images', 'steadyincome'),
						'std' => wp_kses( __('Recommended readings by <strong>John Smith</strong>', 'steadyincome' ), array( 'strong' => '' ) ),
                        ), 
					array(
                        'id'        => 'mts_books_image',
                        'type'      => 'group',
                        'title'     => __('Book Images', 'steadyincome'), 
                        'sub_desc'  => __('With this option you can set image for the book.', 'steadyincome'),
                        'groupname' => __('books', 'steadyincome'), // Group name
                        'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_book_image',
            						'type' => 'upload',
            						'title' => __('Book Image', 'steadyincome'), 
            						'sub_desc' => __('Upload or select an image for the book', 'steadyincome'),
                                    'return' => 'id'
            						),	
                                
                                array('id' => 'mts_book_link',
            						'type' => 'text',
            						'title' => __('Book Link', 'steadyincome'),
            						'sub_desc' => __('Insert a link for the book', 'steadyincome'),
                                    'std' => '#'
                                    ),
                            ),
                        ),
					array('id' => 'mts_more_book_link',
						'type' => 'text',
						'title' => __('More Books Link', 'steadyincome'), 
						'sub_desc' => __('Insert a link for the more link', 'steadyincome'),
                        'std' => '#'
                        ),
					array('id' => 'mts_more_book_text',
						'type' => 'text',
						'title' => __('More Books Text', 'steadyincome'), 
						'sub_desc' => __('Insert a text for the more link', 'steadyincome'),
                        'std' => __('More Books','steadyincome')
                        ),
					array(
						'id' => 'mts_featured_posts',
						'type' => 'button_set_hide_below',
						'title' => __('Posts On Homepage', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => wp_kses( __('<strong>Enable or Disable</strong> Featured Post & Latest Post on Homepage.', 'steadyincome' ), array( 'strong' => '' ) ),
						'std' => '1',
						),
						array(
						'id' => 'mts_featured_post_cat',
						'type' => 'cats_multi_select',
						'title' => __('Featured Post Category(s)', 'steadyincome'),
						'sub_desc' => wp_kses( __('Select a category from the drop-down menu, latest articles from this category will be shown <strong>on the homepage</strong> along with latest post.', 'steadyincome' ), array( 'strong' => '' ) ),
						'std' => '1'
						),
						array(
						'id' => 'mts_featured_post_dedup',
						'type' => 'button_set',
						'title' => __('Prevent Featured Post Duplicate', 'steadyincome'),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __( 'Prevent posts in featured categories from appearing in the latest post.', 'steadyincome' ),
						'std' => '0'
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-table',
				'title' => __('Footer', 'steadyincome' ),
				'desc' => '<p class="description">' . __('From here, you can control the elements of Footer section.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_first_footer',
						'type' => 'button_set_hide_below',
						'title' => __('Footer Widgets', 'steadyincome'), 
						'sub_desc' => __('Enable or disable first footer with this option.', 'steadyincome'),
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'std' => '0'
						),
                    array(
						'id' => 'mts_first_footer_num',
						'type' => 'button_set',
                        'class' => 'green',
						'title' => __('Footer Widgets Layout', 'steadyincome'), 
						'sub_desc' => wp_kses( __('Choose the number of widget areas in the <strong>Footer</strong>', 'steadyincome' ), array( 'strong' => '' ) ),
						'options' => array(
							'3' => __( '3 Widgets', 'steadyincome' ),
							'4' => __( '4 Widgets', 'steadyincome' ),
						),
						'std' => '4'
						), 
                    array(
                        'id'        => 'mts_footer_slider',
                        'type'      => 'group',
                        'title'     => __('Footer Carousel', 'steadyincome'), 
                        'sub_desc'  => __('Setup footer carousel using this option.', 'steadyincome'),
                        'groupname' => __('Item', 'steadyincome'), // Group name
                        'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_footer_slider_image',
            						'type' => 'upload',
            						'title' => __('Image', 'steadyincome'), 
            						'sub_desc' => __('Upload or select an image for this slide', 'steadyincome'),
                                    'return' => 'id'
            						),	
                                
                                array('id' => 'mts_footer_slider_link',
            						'type' => 'text',
            						'title' => __('Link', 'steadyincome'), 
            						'sub_desc' => __('Insert a link URL for the slide', 'steadyincome'),
                                    'std' => '#'
                                    ),
                            ),
                        ),
					array(
						'id' => 'mts_copyrights',
						'type' => 'textarea',
						'title' => __('Copyrights Text', 'steadyincome' ),
						'sub_desc' => __( 'You can change or remove our link from footer and use your own custom text.', 'steadyincome' ) . ( MTS_THEME_WHITE_LABEL ? '' : wp_kses( __('(You can also use your affiliate link to <strong>earn 70% of sales</strong>. Ex: <a href="https://mythemeshop.com/go/aff/aff" target="_blank">https://mythemeshop.com/?ref=username</a>)', 'steadyincome' ), array( 'strong' => '', 'a' => array( 'href' => array(), 'target' => array() ) ) ) ),
						'std' => MTS_THEME_WHITE_LABEL ? null : sprintf( __( 'Theme by %s', 'steadyincome' ), '<a href="http://mythemeshop.com/" rel="nofollow">MyThemeShop</a>' )
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-thumb-tack',
				'title' => __('Blog', 'steadyincome'),
				'desc' => '<p class="description">'.__('From here, you can control the elements of the homepage.'.'</p>', 'steadyincome'),
				'fields' => array(
                    array(
						'id' => 'mts_home_post_layout',
						'type' => 'radio_img',
						'title' => __('Blog Page Article Layout', 'steadyincome'), 
						'sub_desc' => __('Choose the Blog Article Layout ( it will be applied to archive pages as well ).', 'steadyincome'),
						'options' => array(
							'layout-1' => array('img' => NHP_OPTIONS_URL.'img/layouts/ap-layout-1.png'),
							'layout-2' => array('img' => NHP_OPTIONS_URL.'img/layouts/ap-layout-2.png'),
							'layout-3' => array('img' => NHP_OPTIONS_URL.'img/layouts/ap-layout-3.png')
						),
						'std' => 'layout-1'
						),
                    array(
                        'id' => 'mts_full_posts',
                        'type' => 'button_set',
                        'title' => __('Posts on blog pages', 'steadyincome' ),
						'options' => array('0' => __('Excerpts','steadyincome'),'1' => __('Full posts','steadyincome')),
						'sub_desc' => __('Show post excerpts or full posts on the homepage and other archive pages.', 'steadyincome' ),
						'std' => '0',
                        'class' => 'green'
                        ),
                    array(
                        'id' => 'mts_pagenavigation_type',
                        'type' => 'radio',
                        'title' => __('Pagination Type', 'steadyincome' ),
                        'sub_desc' => __('Select pagination type.', 'steadyincome' ),
                        'options' => array(
                                        '0'=> __('Default (Next / Previous)', 'steadyincome' ),
                                        '1' => __('Numbered (1 2 3 4...)', 'steadyincome' ),
                                        '2' => __( 'AJAX (Load More Button)', 'steadyincome' ),
                                        '3' => __( 'AJAX (Auto Infinite Scroll)', 'steadyincome' ) ),
                        'std' => '1'
                        ),
					array(
                        'id'       => 'mts_home_headline_meta_info',
                        'type'     => 'layout',
                        'title'    => __('Blog Post Meta Info', 'steadyincome'),
                        'sub_desc' => __('Organize how you want the post meta info to appear on the Blogs', 'steadyincome'),
                        'options'  => array(
                            'enabled'  => array(
                                'author'   => __('Author Name','steadyincome'),
                                'date'     => __('Date','steadyincome'),
                                'comment'  => __('Comment Count','steadyincome')
                            ),
                            'disabled' => array(
                            )
                        ),
                        'std'  => array(
                            'enabled'  => array(
                                'author'   => __('Author Name','steadyincome'),
                                'date'     => __('Date','steadyincome'),
                                'comment'  => __('Comment Count','steadyincome')
                            ),
                            'disabled' => array(
                            )
                        ),
					array(
						'id' => 'mts_breadcrumb',
						'type' => 'button_set',
						'title' => __('Breadcrumbs', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'steadyincome'),
						'std' => '1'
						),
                    ),

                  
					)
				);
$sections[] = array(
				'icon' => 'fa fa-file-text',
				'title' => __('Single Posts', 'steadyincome'),
				'desc' => '<p class="description">' . __('From here, you can control the appearance and functionality of your single posts page.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
                        'id'       => 'mts_single_post_layout',
                        'type'     => 'layout2',
                        'title'    => __('Single Post Layout', 'steadyincome'),
                        'sub_desc' => __('Customize the look of single posts', 'steadyincome'),
                        'options'  => array(
                            'enabled'  => array(
                                'content'   => array(
                                	'label' 	=> __('Post Content','steadyincome'),
                                	'subfields'	=> array(
                                	)
                                ),
                                'subscribes'   => array(
                                	'label' 	=> __('Subscribe Form','steadyincome'),
                                	'subfields'	=> array(
                                		array(
					        				'id' => 'mts_single_subscribe_service',
					        				'type' => 'select',
					        				'title' => __('Service', 'steadyincome') ,
					        				'options' => array(
					        					'feedburner' => 'FeedBurner',
					        					'mailchimp' => 'MailChimp',
					        					'aweber' => 'AWeber'
					        				),
					        				'std' => 'mailchimp',
					        				'class' => 'subscribe-plugin subscribe-free mts-mother-select'
					        			),
					        			array(
		                                    'id' => 'mts_single_subscribe_feedburner_id',
		            						'type' => 'text',
		            						'title' => __('Feedburner ID', 'steadyincome'), 
		            						'sub_desc' => '',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-feedburner'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_mailchimp_api_key',
		            						'type' => 'text',
		            						'title' => __('Mailchimp API key', 'steadyincome'), 
		            						'sub_desc' => '<a href="http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key" target="_blank">'.__('Find your API key here', 'steadyincome').'</a>',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-mailchimp'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_mailchimp_list_id',
		            						'type' => 'text',
		            						'title' => __('Mailchimp List ID', 'steadyincome'), 
		            						'sub_desc' => '<a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">'.__('Find your list ID here', 'steadyincome').'</a>',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-mailchimp'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_aweber_list_id',
		            						'type' => 'text',
		            						'title' => __('AWeber List ID', 'steadyincome'), 
		            						'sub_desc' => '<a href="https://help.aweber.com/entries/61177326-What-Is-The-Unique-List-ID-" target="_blank">'.__('Find your list ID here', 'steadyincome').'</a>',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-aweber'
	            						),
	            						array(
					        				'id' => 'mts_single_subscribe_mailchimp_double_optin',
					        				'type' => 'button_set',
					        				'title' => __('Send Double Opt-in Notification', 'steadyincome') ,
					        				'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
					        				'sub_desc' => '',
					        				'std' => '0',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-mailchimp'
					        			),
					        			array(
					        				'id' => 'mts_single_subscribe_include_name_field',
					        				'type' => 'button_set',
					        				'title' => __('Include Name field', 'steadyincome') ,
					        				'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
					        				'sub_desc' => '',
					        				'std' => '1',
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-mailchimp mts_single_subscribe_service-aweber'
					        			),
					        			array(
		                                    'id' => 'mts_single_subscribe_title',
		            						'type' => 'text',
		            						'title' => __('Title', 'steadyincome'), 
		            						'std' => wp_kses( __('My <strong>FREE</strong> Insider’s Kit will show you how to earn more money!', 'steadyincome' ), array( 'strong' => '' ) ),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_text',
		            						'type' => 'text',
		            						'title' => __('Text', 'steadyincome'), 
		            						'std' => '',
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_name_placeholder',
		            						'type' => 'text',
		            						'title' => __('Name Placeholder', 'steadyincome'), 
		            						'std' => __('Name','steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free mts-child-option mts-mother-id-mts_single_subscribe_service mts_single_subscribe_service-mailchimp mts_single_subscribe_service-aweber'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_email_placeholder',
		            						'type' => 'text',
		            						'title' => __('Email Placeholder', 'steadyincome'), 
		            						'std' => __('Email','steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_button_text',
		            						'type' => 'text',
		            						'title' => __('Button Text', 'steadyincome'), 
		            						'std' => __('Hook Me Up!','steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_success_message',
		            						'type' => 'text',
		            						'title' => __('Success Message', 'steadyincome'), 
		            						'std' => __('Thank you for subscribing.','steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_error_message',
		            						'type' => 'text',
		            						'title' => __('Error Message', 'steadyincome'), 
		            						'std' => __('Something went wrong.','steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_already_subscribed_message',
		            						'type' => 'text',
		            						'title' => __('Error: Already Subscribed', 'steadyincome'),
		            						'std' => __('This email is already subscribed', 'steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_footer_text',
		            						'type' => 'text',
		            						'title' => __('Footer Text', 'steadyincome'), 
		            						'std' => __('100% Privacy. No Spam.', 'steadyincome'),
					        				'class' => 'subscribe-plugin subscribe-free'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_info',
		            						'type' => 'text',
		            						'title' => wp_kses( __('Please configure settings for this section in <strong>Settings -> WP Subscribe Pro -> Single Posts</stron>.', 'steadyincome' ), array( 'strong' => '' ) ),
		            						'desc' => '',
					        				'class' => 'subscribe-plugin subscribe-pro hidden'
	            						),
	            						array(
		                                    'id' => 'mts_single_subscribe_info_2',
		            						'type' => 'text',
		            						'title' => sprintf( __('Either %1$s or %2$s plugin is required for this section.', 'steadyincome' ),
		            							'<a href="https://wordpress.org/plugins/wp-subscribe/" target="_blank">WP Subscribe</a>',
		            							'<a href="https://mythemeshop.com/plugins/wp-subscribe-pro/" target="_blank">WP Subscribe Pro</a>'),
		            						'desc' => '',
					        				'class' => 'subscribe-plugin subscribe-none hidden'
	            						),
                                	)
                                ),
                                'related'   => array(
                                	'label' 	=> __('Related Posts','steadyincome'),
                                	'subfields'	=> array(
					        			array(
					        				'id' => 'mts_related_posts_taxonomy',
					        				'type' => 'button_set',
					        				'title' => __('Related Posts Taxonomy', 'steadyincome'),
					        				'options' => array(
					        					'tags' => __('Tags', 'steadyincome'),
					        					'categories' => __('Categories','steadyincome'),
					        				) ,
					        				'class' => 'green',
					        				'sub_desc' => __('Related Posts based on tags or categories.', 'steadyincome') ,
					        				'std' => 'categories'
					        			),
					        			array(
					        				'id' => 'mts_related_postsnum',
					        				'type' => 'text',
					        				'class' => 'small-text',
					        				'title' => __('Number of related posts', 'steadyincome') ,
					        				'sub_desc' => __('Enter the number of posts to show in the related posts section.', 'steadyincome') ,
					        				'std' => '4',
					        				'args' => array(
					        					'type' => 'number'
					        				)
					        			),
                                	)
                                ),
                                'author'   => array(
                                	'label' 	=> __('Author Box','steadyincome'),
                                	'subfields'	=> array(
                                	)
                                ),
                            ),
                            'disabled' => array(
                            	'tags'   => array(
                                	'label' 	=> __('Tags','steadyincome'),
                                	'subfields'	=> array(
                                	)
                                ),
                            )
                        )
                    ),
					array(
	                    'id'       => 'mts_single_headline_meta_info',
	                    'type'     => 'layout',
	                    'title'    => __('Meta Info to Show', 'steadyincome'),
	                    'sub_desc' => __('Organize how you want the post meta info to appear', 'steadyincome'),
	                    'options'  => array(
	                        'enabled'  => array(
	                            'author'   => __('Author Name','steadyincome'),
	                            'date'     => __('Date','steadyincome'),
	                            'category' => __('Categories','steadyincome'),
	                            'comment'  => __('Comment Count','steadyincome')
	                        ),
	                        'disabled' => array(
	                        	
	                        )
	                    ),
	                    'std'  => array(
	                        'enabled'  => array(
	                            'author'   => __('Author Name','steadyincome'),
	                            'date'     => __('Date','steadyincome'),
	                           	'category' => __('Categories','steadyincome'),
	                            'comment'  => __('Comment Count','steadyincome')
	                        ),
	                        'disabled' => array(
	                        	
	                        )
	                    )
	                ),
					array(
						'id' => 'mts_breadcrumb',
						'type' => 'button_set',
						'title' => __('Breadcrumbs', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'steadyincome'),
						'std' => '1'
						),
					array(
						'id' => 'mts_author_comment',
						'type' => 'button_set',
						'title' => __('Highlight Author Comment', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to highlight author comments.', 'steadyincome'),
						'std' => '1'
						),
					array(
						'id' => 'mts_comment_date',
						'type' => 'button_set',
						'title' => __('Date in Comments', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to show the date for comments.', 'steadyincome'),
						'std' => '1'
						),
					
					)
				);
$sections[] = array(
				'icon' => 'fa fa-group',
				'title' => __('Social Buttons', 'steadyincome'),
				'desc' => '<p class="description">' . __('Enable or disable social sharing buttons on single posts using these buttons.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_home_social_buttons',
						'type' => 'button_set',
						'title' => __('Social Share Buttons on Blog Page', 'steadyincome'), 
						'options' => array( '0' => __( 'Off', 'steadyincome' ), '1' => __( 'On', 'steadyincome' ) ),
						'sub_desc' => __('Use this button to show social share buttons on Blog Page', 'steadyincome'),
						'std' => '1'
						),
					array(
						'id' => 'mts_social_button_position',
						'type' => 'button_set',
						'title' => __('Social Sharing Buttons Position', 'steadyincome'), 
						'options' => array('top' => __('Above Content','steadyincome'), 'bottom' => __('Below Content','steadyincome'), 'floating' => __('Floating','steadyincome')),
						'sub_desc' => __('Choose position for Social Sharing Buttons.', 'steadyincome'),
						'std' => 'top',
						'class' => 'green'
					),
					array(
                        'id'       => 'mts_social_buttons',
                        'type'     => 'layout',
                        'title'    => __('Social Media Buttons', 'steadyincome'),
                        'sub_desc' => __('Organize how you want the social sharing buttons to appear on single posts', 'steadyincome'),
                        'options'  => array(
                            'enabled'  => array(
                            	'facebookshare'   => __('Facebook Share', 'steadyincome' ),
                            	'facebook'  => __('Facebook Like', 'steadyincome' ),
                                'twitter'   => __('Twitter', 'steadyincome' ),
                                'gplus'     => __('Google Plus', 'steadyincome' ),
                                'pinterest' => __('Pinterest', 'steadyincome' ),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn', 'steadyincome' ),
                                'stumble'   => __('StumbleUpon', 'steadyincome' ),
                            )
                        ),
                        'std'  => array(
                            'enabled'  => array(
                            	'facebookshare'   => __('Facebook Share', 'steadyincome' ),
                            	'facebook'  => __('Facebook Like', 'steadyincome' ),
                                'twitter'   => __('Twitter', 'steadyincome' ),
                                'gplus'     => __('Google Plus', 'steadyincome' ),
                                'pinterest' => __('Pinterest', 'steadyincome' ),
                            ),
                            'disabled' => array(
                            	'linkedin'  => __('LinkedIn', 'steadyincome' ),
                                'stumble'   => __('StumbleUpon', 'steadyincome' ),
                            )
                        )
                    ),
				)
			);
$sections[] = array(
				'icon' => 'fa fa-bar-chart-o',
				'title' => __('Ad Management', 'steadyincome'),
				'desc' => '<p class="description">' . __('Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.', 'steadyincome' ) . '</p>',
				'fields' => array(
					array(
						'id' => 'mts_posttop_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Title', 'steadyincome'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'steadyincome')
						),
					array(
						'id' => 'mts_posttop_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'steadyincome'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'steadyincome'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text',
                        'args' => array('type' => 'number')
						),
					array(
						'id' => 'mts_postend_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Content', 'steadyincome'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'steadyincome')
						),
					array(
						'id' => 'mts_postend_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'steadyincome'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad. Enter 0 to disable this feature.', 'steadyincome'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text',
                        'args' => array('type' => 'number')
						),
					)
				);
$sections[] = array(
				'icon' => 'fa fa-columns',
				'title' => __('Sidebars', 'steadyincome'),
				'desc' => '<p class="description">' . __('Now you have full control over the sidebars. Here you can manage sidebars and select one for each section of your site, or select a custom sidebar on a per-post basis in the post editor.', 'steadyincome' ) . '<br></p>',
                'fields' => array(
                    array(
                        'id'        => 'mts_custom_sidebars',
                        'type'      => 'group', //doesn't need to be called for callback fields
                        'title'     => __('Custom Sidebars', 'steadyincome'), 
                        'sub_desc'  => wp_kses( __('Add custom sidebars. <strong style="font-weight: 800;">You need to save the changes to use the sidebars in the dropdowns below.</strong><br />You can add content to the sidebars in Appearance &gt; Widgets.', 'steadyincome' ), array( 'strong' => '', 'br' => '' ) ),
                        'groupname' => __('Sidebar', 'steadyincome'), // Group name
                        'subfields' => 
                            array(
                                array(
                                    'id' => 'mts_custom_sidebar_name',
            						'type' => 'text',
            						'title' => __('Name', 'steadyincome'), 
            						'sub_desc' => __('Example: Homepage Sidebar', 'steadyincome')
            						),	
                                array(
                                    'id' => 'mts_custom_sidebar_id',
            						'type' => 'text',
            						'title' => __('ID', 'steadyincome'), 
            						'sub_desc' => __('Enter a unique ID for the sidebar. Use only alphanumeric characters, underscores (_) and dashes (-), eg. "sidebar-home"', 'steadyincome'),
            						'std' => 'sidebar-'
            						),
                            ),
                        ),
                    array(
						'id' => 'mts_sidebar_for_home',
						'type' => 'sidebars_select',
						'title' => __('Blog Page', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the Blog page.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_post',
						'type' => 'sidebars_select',
						'title' => __('Single Post', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'steadyincome'),
                        'args' => array('exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_page',
						'type' => 'sidebars_select',
						'title' => __('Single Page', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'steadyincome'),
                        'args' => array('exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_archive',
						'type' => 'sidebars_select',
						'title' => __('Archive', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_category',
						'type' => 'sidebars_select',
						'title' => __('Category Archive', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the category archives.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_tag',
						'type' => 'sidebars_select',
						'title' => __('Tag Archive', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the tag archives.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_date',
						'type' => 'sidebars_select',
						'title' => __('Date Archive', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the date archives.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_author',
						'type' => 'sidebars_select',
						'title' => __('Author Archive', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the author archives.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_search',
						'type' => 'sidebars_select',
						'title' => __('Search', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the search results.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_notfound',
						'type' => 'sidebars_select',
						'title' => __('404 Error', 'steadyincome'), 
						'sub_desc' => __('Select a sidebar for the 404 Not found pages.', 'steadyincome'),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner', 'product-sidebar', 'shop-sidebar')),
                        'std' => ''
						),
                    array(
						'id' => 'mts_sidebar_for_shop',
						'type' => 'sidebars_select',
						'title' => __('Shop Pages', 'steadyincome' ),
						'sub_desc' => wp_kses( __('Select a sidebar for Shop main page and product archive pages (WooCommerce plugin must be enabled). Default is <strong>Shop Page Sidebar</strong>.', 'steadyincome' ), array( 'strong' => '' ) ),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner','shop-sidebar', 'product-sidebar')),
                        'std' => 'shop-sidebar'
						),
                    array(
						'id' => 'mts_sidebar_for_product',
						'type' => 'sidebars_select',
						'title' => __('Single Product', 'steadyincome' ),
						'sub_desc' => wp_kses( __('Select a sidebar for single products (WooCommerce plugin must be enabled). Default is <strong>Single Product Sidebar</strong>.', 'steadyincome' ), array( 'strong' => '' ) ),
                        'args' => array('allow_nosidebar' => false, 'exclude' => array('sidebar', 'footer-first', 'footer-first-2', 'footer-first-3', 'footer-first-4', 'footer-second', 'footer-second-2', 'footer-second-3', 'footer-second-4', 'widget-header','banner','shop-sidebar', 'product-sidebar')),
                        'std' => 'product-sidebar'
						),              
                 
                    ),
				);

$sections[] = array(
	'icon' => 'fa fa-list-alt',
	'title' => __('Navigation', 'steadyincome' ),
	'desc' => '<p class="description"><div class="controls">' . sprintf( __('Navigation settings can now be modified from the %s.', 'steadyincome' ), '<a href="nav-menus.php"><b>' . __( 'Menus Section', 'steadyincome' ) . '</b></a>' ) . '<br></div></p>'
);
				
				
	$tabs = array();
    
    $args['presets'] = array();
    include('theme-presets.php');
    
	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function

/*--------------------------------------------------------------------
 * 
 * Default Font Settings
 *
 --------------------------------------------------------------------*/
if(function_exists('mts_register_typography')) { 
  mts_register_typography(array(
    'navigation_font' => array(
		'preview_text' => __('Navigation Font','steadyincome'),
		'preview_color' => 'dark',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '16px',
		'font_color' => '#6b6f6e',
		'css_selectors' => '.menu li, .menu li a',
		'additional_css' => 'text-transform: uppercase;'
    ),
    'home_title_font' => array(
		'preview_text' => __('Home Article Title','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_size' => '28px',
		'font_variant' => '500',
		'font_color' => '#2a2f2d',
		'css_selectors' => '.latestpost_wrap .front-view-title a',
		'additional_css' => 'text-transform: initial'
    ),
    'single_title_font' => array(
		'preview_text' => __('Single Article Title','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_size' => '36px',
		'font_variant' => '500',
		'font_color' => '#2A2F2D',
		'css_selectors' => '.single-title',
		'additional_css' => 'text-transform: initial'
    ),
    'content_font' => array(
		'preview_text' => __('Content Font','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_size' => '16px',
		'font_variant' => 'normal',
		'font_color' => '#444b49',
		'css_selectors' => 'body'
    ),
	'sidebar_font' => array(
		'preview_text' => __('Sidebar Font','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Open Sans',
		'font_variant' => '500',
		'font_size' => '15px',
		'font_color' => '#9C9C9C',
		'css_selectors' => '#sidebars .widget'
    ),
	'footer_font' => array(
		'preview_text' => __('Footer Font','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Open Sans',
		'font_variant' => 'normal',
		'font_size' => '14px',
		'font_color' => '#888888',
		'css_selectors' => '.footer-widgets'
    ),
    'h1_headline' => array(
		'preview_text' => __('Content H1','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '28px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h1',
		'additional_css' => 'text-transform: uppercase;'
    ),
	'h2_headline' => array(
		'preview_text' => __('Content H2','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '24px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h2',
		'additional_css' => 'text-transform: uppercase;'
    ),
	'h3_headline' => array(
		'preview_text' => __('Content H3','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '22px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h3',
		'additional_css' => 'text-transform: uppercase;'
    ),
	'h4_headline' => array(
		'preview_text' => __('Content H4','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '20px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h4',
		'additional_css' => 'text-transform: uppercase;'
    ),
	'h5_headline' => array(
		'preview_text' => __('Content H5','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '18px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h5',
		'additional_css' => 'text-transform: uppercase;'
    ),
	'h6_headline' => array(
		'preview_text' => __('Content H6','steadyincome'),
		'preview_color' => 'light',
		'font_family' => 'Roboto',
		'font_variant' => '500',
		'font_size' => '16px',
		'font_color' => '#2A2F2D',
		'css_selectors' => 'h6',
		'additional_css' => 'text-transform: uppercase;'
    )
  ));
}

?>
