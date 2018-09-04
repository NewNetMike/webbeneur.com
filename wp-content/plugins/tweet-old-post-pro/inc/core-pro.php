<?php
if (!class_exists('CWP_TOP_Core_PRO')) {
	class CWP_TOP_Core_PRO  {
		public $notices;
		function __construct(){

			$this->topLoadHooks();

		}

        public static  function addNotice($msg,$type){

			CWP_TOP_Core::addNotice($msg,$type);
		}

		public function tweetPostPro($tweet,$network,$post,$user){
				if($network == $user['service']  ) {

					switch ( $user['service'] ) {
						case 'xing':

							$connection = new RopTwitterOAuth( $user['consumer_key'],$user['consumer_secret'], $user['oauth_token'], $user['oauth_token_secret'] );
							$connection->oauth_host = "https://api.xing.com/v1/";
							$args       = array( 'uri' => $tweet['link'] ,"text" =>$tweet['message'] );
                            $response = $connection->post( 'https://api.xing.com/v1/users/me/share/link', $args );
							if ( $response !== false ) {

								if ( $connection->http_code == 201 ) {
									self::addNotice( sprintf( __("Post %s has been successfully sent to XING.",CWP_TEXTDOMAIN),$post->post_title), 'notice' );
								}
							}
							break;
						case 'tumblr':

							$connection = new RopTwitterOAuth( $user['consumer_key'],$user['consumer_secret'], $user['oauth_token'], $user['oauth_token_secret'] );
							$connection->oauth_host = "http://www.tumblr.com/oauth/";
							global $CWP_TOP_Core;
							$args = array();
							$args["tags"] = isset($tweet['tags'] ) ? $tweet["tags"] : "";
							if($CWP_TOP_Core->isPostWithImageEnabled($network) && CWP_TOP_PRO) {
								$args["type"] = "photo";
								$args["link"] = $tweet['link'];
								$args["caption"] = $tweet['message'];
								$image = $this->getPostImage($post->ID, $network);
								if(!empty($image))
									$args["source"] = $this->strip_https($image);
							}else{
								$args['type'] = "link";
								$args['url'] = $tweet['link'];
								$args['title'] = $tweet['message'];
							}
                            $response = $connection->post( "http://api.tumblr.com/v2/blog/".$user['consumer_url']."/post", $args );
							if ( $response !== false ) {

								if ( $connection->http_code == 201 ) {
									self::addNotice( sprintf( __("Post %s has been successfully sent to Tumblr.",CWP_TEXTDOMAIN),$post->post_title), 'notice' );
								}
							}
							break;

					}
				}

		}
		public function afterCheckPro(){
			$cnetwork = CWP_TOP_Core::getCurrentNetwork();
			if(isset($_REQUEST['oauth_token']) &&  $cnetwork == 'xing'  ) {


				$xing = new RopTwitterOAuth(get_option("cwp_top_consumer_key_xing"), get_option("cwp_top_consumer_secret_xing"), get_option("cwp_top_oauth_token_xing"), get_option("cwp_top_oauth_token_secret_xing"));
				$xing->oauth_host = "https://api.xing.com/v1/";
				$access_token = $xing->getAccessToken($_REQUEST['oauth_verifier'],"POST");
				//print_r($access_token);
				//die();
				$user_details = $xing->get('https://api.xing.com/v1/users/me');
				$user_details = $user_details->users[0];
				$user_details->name = $user_details->display_name;
				$user_details->profile_image_url = $user_details->photo_urls->thumb;

				$newUser = array(
					'user_id'				=> $user_details->id,
					'oauth_token'			=> $access_token['oauth_token'],
					'oauth_token_secret'	=> $access_token['oauth_token_secret'],
					'oauth_user_details'	=> $user_details,
					'consumer_key'	=> get_option("cwp_top_consumer_key_xing"),
					'consumer_secret'	=> get_option("cwp_top_consumer_secret_xing"),
					'service'				=> 'xing'
				);

				$loggedInUsers = get_option('cwp_top_logged_in_users');
				if(empty($loggedInUsers)) { $loggedInUsers = array(); }

				if(in_array($newUser, $loggedInUsers)) {
					 $this->addNotice(__("You already added that user",CWP_TEXTDOMAIN),'error');
				} else {
					array_push($loggedInUsers, $newUser);
					update_option('cwp_top_logged_in_users', $loggedInUsers);
				}

				header("Location: " . top_settings_url());
				exit;
			}
			if(isset($_REQUEST['oauth_token']) &&  $cnetwork == 'tumblr'  ) {


				$tumblr = new RopTwitterOAuth(get_option("cwp_top_consumer_key_tumblr"), get_option("cwp_top_consumer_secret_tumblr"), get_option("cwp_top_oauth_token_tumblr"), get_option("cwp_top_oauth_token_secret_tumblr"));

				$tumblr->oauth_host = "http://www.tumblr.com/oauth/";
				$access_token = $tumblr->getAccessToken($_REQUEST['oauth_verifier'],"GET");

				$user_details = $tumblr->get('http://api.tumblr.com/v2/blog/'.get_option("cwp_top_consumer_url_tumblr").'/avatar/64');
				$user_details->name = get_option("cwp_top_consumer_url_tumblr");
				$user_details->profile_image_url = $user_details->response->avatar_url;
				$newUser = array(
					'user_id'				=> md5(get_option("cwp_top_consumer_url_tumblr")),
					'oauth_token'			=> $access_token['oauth_token'],
					'oauth_token_secret'	=> $access_token['oauth_token_secret'],
					'oauth_user_details'	=> $user_details,
					'consumer_key'	=> get_option("cwp_top_consumer_key_tumblr"),
					'consumer_secret'	=> get_option("cwp_top_consumer_secret_tumblr"),
					'consumer_url'	=> get_option("cwp_top_consumer_url_tumblr"),
					'service'				=> 'tumblr'
				);

				$loggedInUsers = get_option('cwp_top_logged_in_users');
				if(empty($loggedInUsers)) { $loggedInUsers = array(); }

				if(in_array($newUser, $loggedInUsers)) {
					 $this->addNotice(__("You already added that user",CWP_TEXTDOMAIN),'error');
				} else {
					array_push($loggedInUsers, $newUser);
					update_option('cwp_top_logged_in_users', $loggedInUsers);
				}

				header("Location: " . top_settings_url());
				exit;
			}
		}


		function topProAddNewAccount(){

			if(!is_admin()) return false;
			$social_network = $_POST['social_network'];
			$response = array();
			switch ($social_network) {
				case 'linkedin':
					if ( empty( $_POST['extra']['app_id'] ) ) {
						self::addNotice( __( "Could not connect to Linkedin! You need to add the App ID", CWP_TEXTDOMAIN ), 'error' );
					} else if ( empty( $_POST['extra']['app_secret'] ) ) {
						self::addNotice( __( "Could not connect to Linkedin! You need to add the App Secret", CWP_TEXTDOMAIN ), 'error' );

					} else {
						$top_session_state = uniqid( '', true );
						$url               = 'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=' . $_POST['extra']["app_id"] . '&scope=w_share&state=' . $top_session_state . '&redirect_uri=' . top_settings_url();

						update_option( 'top_lk_session_state', $top_session_state );
						update_option( 'cwp_top_lk_app_id', $_POST['extra']['app_id'] );
						update_option( 'cwp_top_lk_app_secret', $_POST['extra']['app_secret'] );

						$response['url'] = $url;


					}


					break;

				case 'xing':
					if ( empty( $_POST['extra']['app_id'] ) ) {
						self::addNotice( __( "Could not connect to XING! You need to add the Consumer Key", CWP_TEXTDOMAIN ), 'error' );
					} else if ( empty( $_POST['extra']['app_secret'] ) ) {
						self::addNotice( __( "Could not connect to XING! You need to add the Consumer Secret", CWP_TEXTDOMAIN ), 'error' );
					} else {
						$this->oAuthCallback = $_POST['currentURL'];
						$xing = new RopTwitterOAuth(trim($_POST['extra']['app_id']), trim($_POST['extra']['app_secret']));
						$xing->oauth_host = "https://api.xing.com/v1/";
						$requestToken = $xing->getRequestToken($this->oAuthCallback );

						update_option('cwp_top_oauth_token_xing', $requestToken['oauth_token']);
						update_option('cwp_top_oauth_token_secret_xing', $requestToken['oauth_token_secret']);
						update_option('cwp_top_consumer_key_xing', $_POST['extra']['app_id']);
						update_option('cwp_top_consumer_secret_xing', $_POST['extra']['app_secret']);

						switch ($xing->http_code) {
							case 201:
								$url = $xing->getAuthorizeURL($requestToken['oauth_token'],"");
								$response['url'] = $url;
								break;

							default:
								self::addNotice(__("Could not connect to XING!"),CWP_TEXTDOMAIN);

								break;
						}
						break;


					}
					break;
				case 'tumblr':
					if ( empty( $_POST['extra']['app_id'] ) ) {
						self::addNotice( __( "Could not connect to Thumblr! You need to add the Consumer Key", CWP_TEXTDOMAIN ), 'error' );
					} else if ( empty( $_POST['extra']['app_secret'] ) ) {
						self::addNotice( __( "Could not connect to Thumblr! You need to add the Consumer Secret", CWP_TEXTDOMAIN ), 'error' );

					} else if ( empty( $_POST['extra']['app_url'] ) ) {
						self::addNotice( __( "Could not connect to Thumblr! You need to add the Tumblr Url", CWP_TEXTDOMAIN ), 'error' );

					} else {
						$_POST['extra']['app_id'] = trim($_POST['extra']['app_id']);
						$_POST['extra']['app_secret'] =  trim($_POST['extra']['app_secret']);
						$this->oAuthCallback = $_POST['currentURL'];
						$url = parse_url($_POST['extra']['app_url']);
						$url = isset($url['host']) ? $url['host'] : $_POST['extra']['app_url'];
						$tumblr = new RopTwitterOAuth($_POST['extra']['app_id'], $_POST['extra']['app_secret']);
						$tumblr->oauth_host = "http://www.tumblr.com/oauth/";
						$requestToken = $tumblr->getRequestToken($this->oAuthCallback );

						update_option('cwp_top_oauth_token_tumblr', $requestToken['oauth_token']);
						update_option('cwp_top_oauth_token_secret_tumblr', $requestToken['oauth_token_secret']);
						update_option('cwp_top_consumer_key_tumblr', $_POST['extra']['app_id']);
						update_option('cwp_top_consumer_secret_tumblr', $_POST['extra']['app_secret']);
						update_option('cwp_top_consumer_url_tumblr', $url);

						switch ($tumblr->http_code) {
							case 200:
								$url = $tumblr->getAuthorizeURL($requestToken['oauth_token'],"");
								$response['url'] = $url;
								break;

							default:
								self::addNotice(__("Could not connect to Thumblr!"),CWP_TEXTDOMAIN);

								break;
						}
						break;


					}
					break;
			}
			echo json_encode($response);

			die();

		}

        function test(){
            $this->url_get_contents("http://localhost/test.jpg");
        }

        // Added by Ash/Upwork
        function curl_redirect_exec($ch, &$redirects = null, $curlopt_header = false){
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == 301 || $http_code == 302) {
                list($header) = explode("\r\n\r\n", $data, 2);

                $matches = array();
                preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
                $url = trim(str_replace($matches[1], "", $matches[0]));

                $url_parsed = parse_url($url);
                if (isset($url_parsed)) {
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $redirects++;
                    return $this->curl_redirect_exec($ch, $redirects, $curlopt_header);
                }
            }

            if ($curlopt_header) {
                return $data;
            } else {
                list(, $body) = explode("\r\n\r\n", $data, 2);
                return $body;
            }
        }
        // Added by Ash/Upwork

		function url_get_contents ($Url) {
			$Url = $this->strip_https($Url);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $Url);

            // Added by Ash/Upwork
            $safeMode       = @ini_get('safe_mode');
            $openBasedir    = @ini_get('open_basedir');
            $autoRedirect   = empty($safeMode) && empty($openBasedir);
            if($autoRedirect){
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            }
            curl_setopt($ch, CURLOPT_HEADER, true);
            // Added by Ash/Upwork

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
			$output = curl_exec($ch);

            // Added by Ash/Upwork
            if(!$autoRedirect){
                $output   = $this->curl_redirect_exec($ch);
            }
            // Added by Ash/Upwork

			if($output === false || $output === "") {
				$url_parts = parse_url($Url);

				$output = file_get_contents( get_home_path().substr($url_parts["path"],1));
				if($output === false){
					self::addNotice(__("Problem fetching image: ",CWP_TEXTDOMAIN).$Url. " : ".curl_error($ch),"error");
					$output = null;
				}

			}else{
                // Added by Ash/Upwork
                $contentType    = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
                if(!(strpos(trim($contentType), "image/") === 0)){
                    // not an image
                    self::addNotice(__("Problem fetching image: ", CWP_TEXTDOMAIN).$Url. " : " . __("Incorrect content type", CWP_TEXTDOMAIN) ,"error");
                    $output = null;
                }
				if($autoRedirect){
					$header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
					$header = substr($output, 0, $header_len);
					$body = substr($output, $header_len);
					$output = $body;
				}
				// Added by Ash/Upwork
            }
			curl_close($ch);
			return $output;
		}

		function topProGetCustomCategories($postQuery, $maximum_hashtag_length){
			$taxonomi = get_object_taxonomies( $postQuery->post_type, 'objects' );
			$newHashtags = "";
			foreach ($taxonomi as $key => $value) {
				if (strpos($key,"cat")) {
					$postCategories = get_the_terms($postQuery->ID,$key);

					foreach ($postCategories as $category) {
						if(strlen($category->slug.$newHashtags) <= $maximum_hashtag_length || $maximum_hashtag_length == 0) {
							$newHashtags = $newHashtags . " #" . preg_replace('/-/','',strtolower($category->slug));
						}
					}
				}
			}
			return $newHashtags;
		}

		function strip_https($url){

			return str_replace("https://","http://",$url);
		}
		function getImageSize(){
			 global $cwp_top_fields;

			return get_option($cwp_top_fields["image-size"]["option"],$cwp_top_fields["image-size"]["default_value"]);
		}
		function getPostImage($id, $network){
			$image = '';
			if (has_post_thumbnail($id)) :
				$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ),$this->getImageSize() );

				$image = $image_array[0];
			else :
				$post = get_post($id);
				$image = '';
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

				if(isset($matches [1] [0]))
					$image = $matches [1] [0];
			endif;

            // Added by Ash/Upwork
            $top_opt_saved_images   = get_option("top_opt_saved_images");
            if($top_opt_saved_images && is_array($top_opt_saved_images) && in_array($id, $top_opt_saved_images)){
                $imageID            = get_post_meta($id, "top_opt_saved_post_image_" . $network, true);
                if($imageID){
                    $image          = wp_get_attachment_url($imageID);
                }
            }
            // Added by Ash/Upwork

			return $image;
		}
		function topProImage($connection, $finalTweet, $id,$service='twitter') {
			//global $post, $posts;
			//$plugin_data = get_plugin_data( PLUGINPATH.'/tweet-old-post.php', $markup = true, $translate = true );
			//print_r($post);
			//print_r($plugin_data);

			//if ($plugin_data['Version']=='6.7.7'&&$plugin_data['Version']=='6.7.8'&&$plugin_data['Version']=='6.7.9'&&$plugin_data['Version']=='6.8'){
			//	$fullTweet = $finalTweet;
			//	$finalTweet = $finalTweet['message'];
			//}
			//echo has_post_thumbnail( $id );
			$image = $this->getPostImage($id, $service);
			$args = array();
			if(is_null($image)) $image = '';
			switch($service){
				case 'twitter':
						$message = isset($finalTweet['link']) ? ($finalTweet['message']." ".$finalTweet['link']) : ($finalTweet['message']);
						if ($image == ''){
							$args =     array('status' => $message);
						}else{
                            // Added by Ash/Upwork
                            $media = $this->url_get_contents($image);
                            if($media){
							    $args =     array('status' => $message, 'media[]' => $media);
                            }else{
							    $args =     array('status' => $message);
                            }
                            // Added by Ash/Upwork
						}
					break;
				case 'facebook':
					if ($image == ''){
						     $args =  array(

								'body' => array( 'message' => $finalTweet['message'],'link' => $finalTweet['link']),

							);
						}else{
							$args =  array(

								'body' => array( 'message' => $finalTweet['message'],'link' => $finalTweet['link'],'picture'=>$image),

							);
					}
					break;
				case 'thumblr':
					 return $image;
					break;
			}
			return $args;
		}

		function topLoadStyles()
		{
			global $cwp_top_settings; // Global Tweet Old Post Settings

			// Enqueue and register all scripts on plugin's page
			if(isset($_GET['page'])) {
				if ($_GET['page'] == $cwp_top_settings['slug'] || $_GET['page'] == "ExcludePosts") {

					// Enqueue and Register Main CSS File
					wp_register_style( 'cwp_top_pro_stylesheet', plugins_url( 'css/style.css', dirname(__FILE__) ), false, time() );
					wp_enqueue_style( 'cwp_top_pro_stylesheet' );

                    // Added by Ash/Upwork
                    if(apply_filters('rop_is_business_user', false)){
                        wp_enqueue_script( 'cwp_top_js_scheduling', plugins_url( 'js/scheduling.js', dirname(__FILE__) ), array(), time(), true );
                        wp_localize_script('cwp_top_js_scheduling', 'cwp', array(
                            "save_content_action"   => "quick_edit_save_post",
                            "save_image_action"     => "quick_edit_save_image",
                            "delete_action"         => "quick_delete",
                            'ajaxnonce'             => wp_create_nonce("cwp-top-pro-" . ROP_VERSION),
                            "noTweets"              => __("There is no suitable post to tweet make sure you excluded correct categories and selected the right dates", "tweet-old-post"),
                        )) ;
                        wp_enqueue_media();
                        add_thickbox();
                    }
                    // Added by Ash/Upwork
				}
			}

		}

        // Added by Ash/Upwork
        function isBusinessUser($value=null){
	        $option = get_option('tweet_old_post_pro_license_data',false);

	        if(isset($option->plan)){
		        if($option->plan > 0){
			        return true;
		        }
	        }else{
		        if(isset($option->license)){

			        if($option->license=='valid')
				        return true;

		        }
	        }
	        return true;
        }
        // Added by Ash/Upwork

		function topLoadHooks()
		{
			add_action('admin_enqueue_scripts', array($this,'topLoadStyles'));
			add_action( 'admin_notices', array($this, 'adminNotice') );
			add_action( 'init', array($this, 'pluginInit') );

            // Added by Ash/Upwork
            $this->loadDependencies();
            register_deactivation_hook(ROPPROPLUGINFILE , array($this, "deactivatePlugin"));
			add_action('wp_ajax_quick_edit_save_post', array($this, 'ajax'));
			add_action('wp_ajax_quick_edit_save_image', array($this, 'ajax'));
			add_action('wp_ajax_quick_delete', array($this, 'ajax'));
			add_action('wp_ajax_custom_messages', array($this, 'ajax'));
            add_action('rop_pro_deactivateFree', array($this, "deactivateFreePlugin"));

            add_filter('rop_is_business_user', array($this, 'isBusinessUser'), 10, 1);
            add_filter('rop_add_to_sidebar', array($this, 'addToSidebar'));
            add_filter('rop_override_tweet', array($this, 'getCustomMessage'), 10, 2);
            // Added by Ash/Upwork
		}

        function getCustomMessage($finalTweet, $post)
        {
            $text               = $finalTweet;
			$custom_messages    = get_option("cwp_rop_custom_messages", "off");
            if ($custom_messages == "on") {
                $messages       = get_post_meta($post->ID, "rop_custom-messages");
                if (!empty($messages) && is_array($messages)) {
                    $messages   = $messages[0];
                    $text       = $messages[rand(0, count($messages) - 1)]["message"];
                }
            }
            return $text;
        }

        function pluginInit()
        {
            $this->addCustomMessages();
        }

        public static function getPostTypes()
        {
            return get_option("top_opt_post_type");
        }

        private function addCustomMessages()
        {
			$custom_messages    = get_option("cwp_rop_custom_messages", "off");
            if ($custom_messages == "on") {
                include_once ROPPROPLUGINPATH . "/inc/lib/cmb2.php";
            }
        }

        function addToSidebar()
        {
			$custom_messages    = get_option("cwp_rop_custom_messages", "off");
            return '<li class="rop-beta-user"><div class="rop-left">' . __("Custom Share Messages",'tweet-old-post') . '</div><a href="#" id="rop_custom_messages" class="' . $custom_messages . ' rop-right "></a><div class="rop-clear" ></div><span class="rop-beta-desc">' . __("These messages will override the post format settings. You can go to each post and add multiple custom messages.",'tweet-old-post') . '</span> </li>';
        }

        function ajax() {
            if (!apply_filters("cwp_check_ajax_capability", false)) wp_die();
            check_ajax_referer("cwp-top-pro-" . ROP_VERSION, "security");

            switch ($_POST["action"]) {
                case 'quick_edit_save_post':
                    $this->quickEditSavePost();
                    break;
                case 'quick_edit_save_image':
                    $this->quickEditSaveImage();
                    break;
                case 'quick_delete':
                    $this->quickDelete();
                    break;
                case 'custom_messages':
                    $this->customMessages();
                    break;
            }

            wp_die();
        }

        // Added by Ash/Upwork
        function customMessages()
        {
			if(!is_admin()) return false;
			$state = $_POST["state"];
			if(!empty($status)) $state = $status;

			if(!empty($state) &&( $state == "on" || $state == "off")){
				update_option("cwp_rop_custom_messages", $state);
			}
            die();
        }

        function loadDependencies(){
            require_once ROPPROPLUGINPATH . "/inc/lib/dependencies/tgm-activation.php";
        }

        function deactivatePlugin(){
            delete_option("cwp_top_delete_type");
        }

        function deactivateFreePlugin(){
            delete_option("cwp_top_delete_type");
        }

        function quickDelete(){
            $postID     = $_POST["id"];
            $type       = $_POST["type"];
            $network    = $_POST["network"];
            $exclude    = array();
            switch(intval($type)){
                case 0:
			        $all = $this->getAllNetworks();
			        foreach($all as $n ){
                        $exclude[]  = $n;
                    }
                    break;
                case 1:
                    $exclude[]  = $network;
                    break;
                case 2:
                    CWP_TOP_Core::setAlreadyTweetedPosts($network, $postID);
                    break;
            }
            foreach($exclude as $n){
                $array  = get_option("cwp_top_exclude_from_" . $n);
                if(!$array){
                    $array  = array();
                }
                if(!in_array($postID, $array)){
                    $array[]    = $postID;
                }
                update_option("cwp_top_exclude_from_" . $n, $array);
            }
            update_option("cwp_top_delete_type", $type);
            die();
        }

        function quickEditSaveImage(){
            $postID     = $_POST["id"];
            $imageID    = $_POST["image"];
            $network    = $_POST["network"];
            $array      = get_option("top_opt_saved_images");
            if(!$array){
                $array  = array();
            }
            if(!in_array($postID, $array)){
                $array[]    = $postID;
            }
            update_post_meta($postID, "top_opt_saved_post_image_" . $network, $imageID);
            update_option("top_opt_saved_images", $array);
            die();
        }

        function quickEditSavePost(){
            $postID     = $_POST["id"];
            $content    = $_POST["content"];
            $network    = $_POST["network"];
            $array      = get_option("top_opt_saved_posts");
            if(!$array){
                $array  = array();
            }
            if(!in_array($postID, $array)){
                $array[]    = $postID;
            }
            $content    = $this->shortenUrlIfRequired($network, $postID, $content);
            update_post_meta($postID, "top_opt_saved_post_content_" . $network, $content);
            update_option("top_opt_saved_posts", $array);
            echo wp_send_json_success(array(
                "content"       => $content
            ));
            wp_die();
        }

        function shortenUrlIfRequired($network, $postID, $content)
        {
			$formats                = get_option('top_opt_post_formats');
			$use_url_shortner       =  isset($formats[$network."_"."top_opt_use_url_shortner"]) ? $formats[$network."_"."top_opt_use_url_shortner"] : get_option( 'top_opt_use_url_shortner' );
			$url_shortner_service   = isset($formats[$network."_"."top_opt_url_shortner"]) ? $formats[$network."_"."top_opt_url_shortner"] : get_option( 'top_opt_url_shortner' );

            if ($use_url_shortner == 'on' && !empty($url_shortner_service) && strpos($content, "[$url_shortner_service]") !== FALSE) {
                $bitly_key          = isset($formats[$network."_"."top_opt_bitly_key"]) ? $formats[$network."_"."top_opt_bitly_key"] : get_option( 'top_opt_bitly_key' );
                $bitly_user         = isset($formats[$network."_"."top_opt_bitly_user"]) ? $formats[$network."_"."top_opt_bitly_user"] : get_option( 'top_opt_bitly_user' );

                $post_url           = get_post_meta($postID, "rop_post_url_" . $network, true);
                $post_url           = CWP_TOP_Core::shortenURL( $post_url, $url_shortner_service, $postID, $bitly_key, $bitly_user );

                $content            = str_replace("[$url_shortner_service]", $post_url, $content);
            }
            return $content;
        }
        // Added by Ash/Upwork

		public function adminNotice(){
			if(is_array($this->notices)){
				foreach($this->notices as $n){
					?>
					<div class="error">
	                         <p><?php _e( $n, CWP_TEXTDOMAIN ); ?></p>
	                 </div>
				<?php
				}
			}

		}

		function updateTopProAjax(){
			global $CWP_TOP_Core;
			if(! apply_filters("rop_is_business_user",false)) return false;
			if( method_exists($CWP_TOP_Core,"getAvailableNetworks"))
			{
				$cwp_top_networks = $CWP_TOP_Core->getAvailableNetworks();
			}
			else
			{
				global $cwp_top_networks;
			}
			$dataSent = html_entity_decode($_POST['dataSent']['dataSent']);

			$options = array();
			parse_str($dataSent, $options);
			$optionsdb = array();
			foreach($cwp_top_networks as $n){
				if($options[$n.'_schedule_type_selected'] == 'each'){

					$optionsdb[$n.'_schedule_type_selected'] = 'each';
					$optionsdb[$n.'_top_opt_interval']  = $options[$n."_top_opt_interval"];
				}else{

					$optionsdb[$n.'_schedule_type_selected'] = 'custom';
					$optionsdb[$n.'_top_opt_interval']["days"] = $options[$n."_top_schedule_days"];
					$optionsdb[$n.'_top_opt_interval']['times'] = array();

					foreach($options[$n."_time_choice_min"] as $k=>$min){
						$optionsdb[$n.'_top_opt_interval']['times'][] = array("minute"=>$min,"hour"=>$options[$n."_time_choice_hour"][$k]);
					}
					$mins = array();
					$hour = array();
					foreach ($optionsdb[$n.'_top_opt_interval']['times'] as $key => $row) {
						$hour[$key]  = $row['hour'];
						$mins[$key] = $row['minute'];
					}
					array_multisort($hour, SORT_ASC, $mins, SORT_ASC, $optionsdb[$n.'_top_opt_interval']['times']);
					if(count($optionsdb[$n.'_top_opt_interval']['times']) == 0){

						$optionsdb[$n.'_schedule_type_selected'] = 'each';
						$optionsdb[$n.'_top_opt_interval']  = $options[$n."_top_opt_interval"];

					}

				}

			}
			update_option("cwp_top_global_schedule",$optionsdb);
		}
	}
}
if(class_exists('CWP_TOP_Core_PRO')) {
	$CWP_TOP_Core_PRO = new CWP_TOP_Core_PRO;
}