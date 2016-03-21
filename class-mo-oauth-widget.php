<?php

include_once dirname( __FILE__ ) . '/eveonline/vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

class Mo_Oauth_Widget extends WP_Widget {
	
	public function __construct() {
		update_option( 'host_name', 'https://auth.miniorange.com' );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'init', array( $this, 'mo_oauth_start_session' ) );
		add_action( 'wp_logout', array( $this, 'mo_oauth_end_session' ) );
		parent::__construct( 'mo_oauth_widget', 'miniOrange OAuth', array( 'description' => __( 'Login to Apps with OAuth', 'flw' ), ) );
	 }
	 
	function mo_oauth_start_session() {
		if( ! session_id() ) {
			session_start();
		}
	}

	function mo_oauth_end_session() {
		session_destroy();
	}
	 
	public function widget( $args, $instance ) {
		extract( $args );
		
		echo $args['before_widget'];
		if ( ! empty( $wid_title ) ) {
			echo $args['before_title'] . $wid_title . $args['after_title'];
		}
		$this->mo_oauth_login_form();
		echo $args['after_widget'];
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
		return $instance;
	}
	
	public function mo_oauth_login_form() {
		global $post;
		$this->error_message();
		$appsConfigured = get_option('mo_oauth_google_enable') | get_option('mo_oauth_eveonline_enable') | get_option('mo_oauth_facebook_enable');
		if( ! is_user_logged_in() ) {
			?>
			<a href="http://miniorange.com/cloud-identity-broker-service" style="display: none;">EVE Online OAuth SSO login</a>
			<?php
			if( $appsConfigured ) {
				if( get_option('mo_oauth_google_enable') ) {
					$this->mo_oauth_load_login_script();
				?>
				<p>
				<a href="javascript:void(0)" onClick="moOAuthLogin('google');"><img src="<?php echo plugins_url( 'images/icons/google.jpg', __FILE__ )?>"></a>
					
				<?php
				}
				if( get_option('mo_oauth_eveonline_enable') ) {
					$this->mo_oauth_load_login_script();
				?>
					<a href="javascript:void(0)" onClick="moOAuthLogin('eveonline');"><img src="<?php echo plugins_url( 'images/icons/eveonline.png', __FILE__ )?>"></a>
				<?php
				}
				if( get_option('mo_oauth_facebook_enable') ) {
					$this->mo_oauth_load_login_script();
				?>
				<a href="javascript:void(0)" onClick="moOAuthLogin('facebook');"><img src="<?php echo plugins_url( 'images/icons/facebook.png', __FILE__ )?>"></a>
					
				<?php
				}
			} else if($_SERVER['HTTP_EVE_CHARID']){
				$this->mo_oauth_load_login_script();
				?>
				<script type='text/javascript'> window.onload=moOAuthLogin('eveonline'); </script>;
								
				<?php
			}
			else {
				?>
				<div>No apps configured. Please contact your administrator.</div>
				<?php
			}
			?>
			</p>
			<?php 
		} else {
			global $current_user;
	     	get_currentuserinfo();
			$link_with_username = __('Howdy, ', 'flw') . $current_user->display_name;
			?>
			<div id="logged_in_user" class="login_wid">
				<li><?php echo $link_with_username;?> | <a href="<?php echo wp_logout_url( site_url() ); ?>" title="<?php _e('Logout','flw');?>"><?php _e('Logout','flw');?></a></li>
			</div>
			<?php
		}
	}
	
	private function mo_oauth_load_login_script() {
	?>
	<script type="text/javascript">
	function moOAuthLogin(app_name) {
			
			if(app_name=='eveonline')
			{
				 window.location.href = '<?php echo site_url() ?>' + '/?option=generateDynmicUrl&app_name=' + app_name;
								 
			}
			else
			{
				window.location.href = '<?php echo site_url() ?>' + '/?option=generateDynmicUrl&app_name=' + app_name;
			}
		}
		</script>
	<?php
	}
	
	public function oauthloginFormShortCode( $atts ){
		global $post;
				$appsConfigured = get_option('mo_oauth_google_enable') | get_option('mo_oauth_eveonline_enable') | get_option('mo_oauth_facebook_enable');
		$html = '';
		if( ! is_user_logged_in() ) {
			if( $appsConfigured ) {
					$this->mo_oauth_load_login_script();
					$html .= "<a href='http://miniorange.com/single-sign-on-sso' hidden></a>
					<div>";
					
				if(get_option('mo_oauth_google_enable')){

					$html .= "<a href='".'javascript:void(0)'."' onClick='moOAuthLogin(".'"google"'.");'><img src='".plugins_url( 'images/icons/google.jpg', __FILE__ )."'></a>";	
				}
				if( get_option('mo_oauth_eveonline_enable') ) {
				
					$html .= "<a href='".'javascript:void(0)'."' onClick='moOAuthLogin(".'"eveonline"'.");'><img src='".plugins_url( 'images/icons/eveonline.png', __FILE__ )."'></a>";
				}
				if(get_option('mo_oauth_facebook_enable') ){
				
					$html .= "<a href='".'javascript:void(0)'."' onClick='moOAuthLogin(".'"facebook"'.");'><img src='".plugins_url( 'images/icons/facebook.png', __FILE__ )."'></a>";
					
					
				}
				$html .="</div>";
			}else{
				$html .='<div>No apps configured. Please contact your administrator.</div>';
			}
		}	
	return $html;	
		
	}
	
	public function error_message() {
		if( isset( $_SESSION['msg'] ) and $_SESSION['msg'] ) {
			echo '<div class="' . $_SESSION['msg_class'] . '">' . $_SESSION['msg'] . '</div>';
			unset( $_SESSION['msg'] );
			unset( $_SESSION['msg_class'] );
		}
	}
	
	public function register_plugin_styles() {
		wp_enqueue_style( 'style_login_widget', plugins_url( 'style_login_widget.css', __FILE__ ) );
	}
	
	
}
	function mo_oauth_login_validate(){
		
		if( isset( $_REQUEST['option'] ) and strpos( $_REQUEST['option'], 'generateDynmicUrl' ) !== false ) {
			$client_id = get_option('mo_oauth_' . $_REQUEST['app_name'] . '_client_id');
			$timestamp = round( microtime(true) * 1000 );
			$api_key = get_option('mo_oauth_admin_api_key');
			$token = $client_id . ':' . number_format($timestamp, 0, '', '') . ':' . $api_key;
			
			$customer_token = get_option('customer_token');
			$blocksize = 16;
			$pad = $blocksize - ( strlen( $token ) % $blocksize );
			$token =  $token . str_repeat( chr( $pad ), $pad );
			$token_params_encrypt = mcrypt_encrypt( MCRYPT_RIJNDAEL_128, $customer_token, $token, MCRYPT_MODE_ECB );
			$token_params_encode = base64_encode( $token_params_encrypt );
			$token_params = urlencode( $token_params_encode );
			
			$return_url = urlencode( site_url() . '/?option=mooauth' );
			$url = get_option('host_name') . '/moas/oauth/client/authorize?token=' . $token_params . '&id=' . get_option('mo_oauth_admin_customer_key') . '&encrypted=true&app=' . $_REQUEST['app_name'] . '_oauth&returnurl=' . $return_url;
			wp_redirect( $url );
			exit;
		}
			
		if( isset( $_REQUEST['option'] ) and strpos( $_REQUEST['option'], 'mooauth' ) !== false ){
					if( ! session_id() || session_id() == '' || !isset($_SESSION) ) {
			session_start();
			//print_r($_SESSION);
			//exit();
		}			
			//do stuff after returning from oAuth processing
			$access_token 	= $_POST['access_token'];
			$token_type	 	= $_POST['token_type'];
			$user_email = '';
			if(array_key_exists('email', $_POST))
				$user_email 	= $_POST['email'];
			
			
			if( $user_email ) {
				if( email_exists( $user_email ) ) { // user is a member 
					  $user 	= get_user_by('email', $user_email );
					  $user_id 	= $user->ID;
					  wp_set_auth_cookie( $user_id, true );
				} else { // this user is a guest
					  $random_password 	= wp_generate_password( 10, false );
					  $user_id 			= wp_create_user( $user_email, $random_password, $user_email );
					  wp_set_auth_cookie( $user_id, true );
				}
			} if( $_POST['CharacterID'] ) {		//the user is trying to login through eve online
				
				$_SESSION['character_id'] = $_POST['CharacterID'];
				$_SESSION['character_name'] = $_POST['CharacterName'];
				Config::getInstance()->access = new \Pheal\Access\StaticCheck();
				
				$keyID = get_option('mo_eve_api_key');
				$vCode = get_option('mo_eve_verification_code');
				
				if( $keyID && $vCode ) {
					
			
					$pheal = new Pheal( $keyID, $vCode, "eve" );
			
					try{
						$response = $pheal->CharacterInfo(array("characterID" => $_SESSION['character_id']));
						
						$_SESSION['corporation_name']	= isset($response->corporation) ? $response->corporation : '';
						$_SESSION['alliance_name'] 		= isset($response->alliance) ? $response->alliance : '' ;
						$_SESSION['faction_name']       = isset($response->faction) ? $response->faction : '' ;
						} catch (\Pheal\Exceptions\PhealException $e) {
					/*	echo sprintf(
							"an exception was caught! Type: %s Message: %s",
							get_class($e),
							$e->getMessage()
						);*/
					}

					
					$corporations 	  = get_option('mo_eve_allowed_corps') ? get_option('mo_eve_allowed_corps') : false;
					$alliances 		  = get_option('mo_eve_allowed_alliances') ? get_option('mo_eve_allowed_alliances') : false;
					$characterNames   = get_option('mo_eve_allowed_char_name') ? get_option('mo_eve_allowed_char_name') : false;
					$factions         = get_option('mo_eve_allowed_faction') ? get_option('mo_eve_allowed_faction') : false;
					$valid_char 	  = false;
					$decorporations   = get_option('mo_eve_denied_corps') ? get_option('mo_eve_denied_corps') : false;
					$dealliances 	  = get_option('mo_eve_denied_alliances') ? get_option('mo_eve_denied_alliances') : false;
					$decharacterNames = get_option('mo_eve_denied_char_name') ? get_option('mo_eve_denied_char_name') : false;
					$defactions       = get_option('mo_eve_denied_faction') ? get_option('mo_eve_denied_faction') : false;
					$invalid_char 	  = false;					
					
					if( (! $corporations && ! $alliances && ! $characterNames && ! $factions) && (! $decorporations && ! $dealliances && ! $decharacterNames && ! $defactions )) {
						$valid_char = true;
						$invalid_char = false;
					} else {
						$valid_corp 			= mo_oauth_check_validity_of_entity(get_option('mo_eve_allowed_corps'), $_SESSION['corporation_name'], 'corporation_name');
						$valid_alliance 		= mo_oauth_check_validity_of_entity(get_option('mo_eve_allowed_alliances'), $_SESSION['alliance_name'], 'alliance_name');
						$valid_character_name 	= mo_oauth_check_validity_of_entity(get_option('mo_eve_allowed_char_name'), $_SESSION['character_name'], 'character_name');
						$valid_faction 			= mo_oauth_check_validity_of_entity(get_option('mo_eve_allowed_faction'), $_SESSION['faction_name'], 'faction_name');						
						$valid_char = $valid_corp || $valid_alliance || $valid_character_name || $valid_faction;
						$invalid_corp 			= mo_oauth_check_validity_of_entity(get_option('mo_eve_denied_corps'), $_SESSION['corporation_name'], 'corporation_name');
						$invalid_alliance 		= mo_oauth_check_validity_of_entity(get_option('mo_eve_denied_alliances'), $_SESSION['alliance_name'], 'alliance_name');
						$invalid_character_name 	= mo_oauth_check_validity_of_entity(get_option('mo_eve_denied_char_name'), $_SESSION['character_name'], 'character_name');
						$invalid_faction 			= mo_oauth_check_validity_of_entity(get_option('mo_eve_denied_faction'), $_SESSION['faction_name'], 'faction_name');						
						$invalid_char = $invalid_corp || $invalid_alliance || $invalid_character_name || $invalid_faction;
					} 
						
						
					
					if( $valid_char && ! $invalid_char ) {			//if corporation or alliance or character name is valid
						$characterName = $_SESSION['character_name'];
						$characterID = $_SESSION['character_id'];
						$characterName1 = preg_replace('/\s+/', '', $characterName);
						$eveonline_email = $characterName1 . '.eveonline@wordpress.com';
						if( username_exists( $characterName ) ) {
							$user = get_user_by( 'login', $characterName );
							$user_id = $user->ID;
							
							
	/*update_user_meta( $user_id, 'user_eveonline_corporation_name', $_SESSION['corporation_name'] );
							update_user_meta( $user_id, 'user_eveonline_alliance_name', $_SESSION['alliance_name'] );
							update_user_meta( $user_id, 'user_eveonline_character_name', $_SESSION['character_name'] );
							update_user_meta($user_id, 'user_eveonline_faction_name', $_SESSION['faction_name']);*/	
							set_avatar( $user_id, $characterID );
							wp_set_auth_cookie( $user_id, true );
						} else {
							
								if(get_option('mo_eve_email_login_enable') && mo_oauth_is_customer_valid()){
									//print_r($_SESSION);
									?>
										<table>			
											<form id="mo_eve_email" name="mo_eve_email"  method="post" action="">
												<div class="rectangle" style="width:700px; height:180px; background:#F1F1F1 ; padding-top:1%; padding-left:30px; margin-top:15%; margin-left:20%;border:1.5px solid grey;  box-shadow: 10px 10px 5px grey; ">
												<div style="font-size:17px; color:#3A2C2C;padding-left:10px;">Please Enter Your Email-ID. This Email-ID will be registered in your wordpress account.<br><br></div>
													<label for="mo_eve_login_email" style="font-size:17px; color:#777">Email-ID  <br><div>  </div>
													<input type="hidden" name="option" value="mo_eve_email" />
													<input type="text" id="mo_eve_login_email" style="border:1.5px solid #ddd; font-family: sans-serif; height:40px; width:90%; text-align:center;"name="mo_eve_login_email" value="<?php echo get_option ('mo_eve_login_email');?>" placeholder="<?php echo $eveonline_email; ?>"/></label><br><br>
												<div style="padding-left:45%;"><input type="submit" name="submit" value="Submit" style="color: white; background-color:#6666FF; display: inline-block; margin-bottom: 0; font-size: 14px; font-weight: 400; line-height: 1.4; text-align: center; white-space: nowrap;  vertical-align: middle; border: 1px solid transparent; border-radius: 4px; cursor: pointer;"  class="mo_eve_form_button" /></div>
												</div>
											</form>
									
										</table>
								<?php
						
								}
								else{
									$random_password = wp_generate_password( 10, false );
							
									$userdata = array(
										'user_login'		=>	$_SESSION['character_name'],
										'user_email'	=>	$eveonline_email,
										'user_pass'		=>	$random_password,
										'display_name'	=>	$_SESSION['character_name']
										
									);

									$user_id = wp_insert_user( $userdata ) ;
									update_user_meta($user_id, 'user_eveonline_corporation_name', $_SESSION['corporation_name']);
									update_user_meta($user_id, 'user_eveonline_alliance_name', $_SESSION['alliance_name']);
									update_user_meta($user_id, 'user_eveonline_character_name', $_SESSION['character_name']);
									update_user_meta($user_id, 'user_eveonline_faction_name', $_SESSION['faction_name']);
									set_avatar( $user_id, $characterID );
									wp_set_auth_cookie( $user_id, true );
									
								}		
							
							
														if(get_option('mo_eve_email_login_enable') && mo_oauth_is_customer_valid()) 
							exit(0);
						}	
					} 
					

								
				} else {
					// If API and vCode is not setup - login the user using Character ID
					$characterID = $_SESSION['character_id'];
					$characterName = $_SESSION['character_name'];
					$characterName1 = preg_replace('/\s+/', '', $characterName);
					$eveonline_email = $characterName1 . '.eveonline@wordpress.com';
					if( username_exists( $characterName ) ) {
						$user = get_user_by( 'login', $characterName );
						$user_id = $user->ID;
					
					update_user_meta( $user_id, 'user_eveonline_character_name', $_SESSION['character_name'] );
						set_avatar( $user_id, $characterID );
						wp_set_auth_cookie( $user_id, true );
					} else {
						if(get_option('mo_eve_email_login_enable') && mo_oauth_is_customer_valid()){
	                            ?>
						<table>			
							<form id="mo_eve_email" name="mo_eve_email"  method="post" action="">
								<div class="rectangle" style="width:700px; height:180px; background:#F1F1F1 ; padding-top:1%; padding-left:30px; margin-top:15%; margin-left:20%;border:1.5px solid grey;  box-shadow: 10px 10px 5px grey; ">
												<div style="font-size:17px; color:#3A2C2C;padding-left:10px;">Please Enter Your Email-ID. This Email-ID will be registered in your wordpress account.<br><br></div>
													<label for="mo_eve_login_email" style="font-size:17px; color:#777">Email-ID  <br><div>  </div>
													<input type="hidden" name="option" value="mo_eve_email" />
													<input type="text" id="mo_eve_login_email" style="border:1.5px solid #ddd; font-family: sans-serif; height:40px; width:90%; text-align:center;"name="mo_eve_login_email" value="<?php echo get_option ('mo_eve_login_email');?>" placeholder="<?php echo $eveonline_email; ?>"/></label><br><br>
												<div style="padding-left:45%;"><input type="submit" name="submit" value="Submit" style="color: white; background-color:#6666FF; display: inline-block; margin-bottom: 0; font-size: 14px; font-weight: 400; line-height: 1.4; text-align: center; white-space: nowrap;  vertical-align: middle; border: 1px solid transparent; border-radius: 4px; cursor: pointer;"  class="mo_eve_form_button" /></div>
												</div>
							</form>
							
						</table>
				<?php		}
						else{
						
						$random_password = wp_generate_password( 10, false );
					
						$userdata = array(
							
							'user_email'	=>	$eveonline_email,
							'user_pass'		=>	$random_password,
							'display_name'	=>	$_SESSION['character_name'],
							'user_login'	=>	$_SESSION['character_name']
						);
						$user_id = wp_insert_user( $userdata ) ;
						update_user_meta( $user_id, 'user_eveonline_character_name', $_SESSION['character_name'] );
						set_avatar( $user_id, $characterID );
						wp_set_auth_cookie( $user_id, true );
						
						}
						
						if(get_option('mo_eve_email_login_enable') /*&& mo_oauth_is_customer_valid()*/) 
						exit(0);
					}
				}
				
				

			}
			

			$redirect_url=mo_eve_get_redirect_url();
			wp_redirect( $redirect_url );
			exit;
		}
	}
	
	function mo_eve_get_redirect_url() {
		$option = get_option( 'mo_eve_login_redirect' );
		
		if( $option == 'same' ) {
			$redirect_url = site_url();
		} else if( $option == 'custom' ) {
			$redirect_url = get_option('mo_eve_login_redirect_url');
		}else{
		 $redirect_url = site_url();
		}
		
		return $redirect_url;
	}
	//here entity is corporation, alliance or character name. The administrator compares these when user logs in
	function mo_oauth_check_validity_of_entity($entityValue, $entitySessionValue, $entityName) {
		
		$entityString = $entityValue ? $entityValue : false;
		$valid_entity = false;
		if( $entityString ) {			//checks if entityString is defined
			if ( strpos( $entityString, ',' ) !== false ) {			//checks if there are more than 1 entity defined
				$entity_list = array_map( 'trim', explode( ",", $entityString ) );
				foreach( $entity_list as $entity ) {			//checks for each entity to exist
					if( $entity == $entitySessionValue ) {
						$valid_entity = true;
						break;
					}
				}
			} else {		//only one entity is defined
				if( $entityString == $entitySessionValue ) {
					$valid_entity = true;
				}
			}
		} else {			//entity is not defined
			$valid_entity = false;
		}
		return $valid_entity;
	}

	function register_mo_oauth_widget() {
		register_widget('mo_oauth_widget');
	}
	
	add_action('widgets_init', 'register_mo_oauth_widget');
	add_action( 'init', 'mo_oauth_login_validate' );
?>