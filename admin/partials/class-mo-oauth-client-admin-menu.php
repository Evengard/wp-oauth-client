<?php

require('class-mo-oauth-client-admin-utils.php');
require('account/class-mo-oauth-client-admin-account.php');
require('apps/class-mo-oauth-client-apps.php');
require('licensing/class-mo-oauth-client-license.php');
require('guides/class-mo-oauth-client-guides.php');
require('support/class-mo-oauth-client-support.php');
require('guides/class-mo-oauth-client-attribute-mapping.php');
require('reports/class-mo-oauth-client-reports.php');
require('demo/class-mo-oauth-client-demo.php');
require('faq/class-mo-oauth-client-faq.php');
require('addons/class-mo-oauth-client-addons.php');

function mo_oauth_client_plugin_settings_style($hook) {
	if($hook != 'toplevel_page_mo_oauth_settings') {
		return;
	}
	wp_enqueue_style( 'mo_oauth_admin_style', plugin_dir_url( dirname(__FILE__) ) . 'css/admin.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_style', plugin_dir_url( dirname(__FILE__) ) . 'css/style_settings.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_font_awesome', plugin_dir_url( dirname(__FILE__) ) . 'css/font-awesome.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_phone_style', plugin_dir_url( dirname(__FILE__) ) . 'css/phone.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_datatable_style', plugin_dir_url( dirname(__FILE__) ) . 'css/jquery.dataTables.min.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_inteltelinput_style', plugin_dir_url( dirname(__FILE__) ) . 'css/intlTelInput.css' );
	wp_enqueue_style( 'mo_oauth_admin_settings_jquery_ui_style', plugin_dir_url( dirname(__FILE__) ) . 'css/jquery-ui.css' );
}

function mo_oauth_client_plugin_settings_script($hook) {
	if($hook != 'toplevel_page_mo_oauth_settings') {
		return;
	}
	wp_enqueue_script( 'mo_oauth_admin_script', plugin_dir_url( dirname(__FILE__) ) . 'js/admin.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_script', plugin_dir_url( dirname(__FILE__) ) . 'js/settings.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_phone_script', plugin_dir_url( dirname(__FILE__) ) . 'js/phone.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_datatable_script', plugin_dir_url( dirname(__FILE__) ) . 'js/jquery.dataTables.min.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_jquery-2.1.3', plugin_dir_url( dirname(__FILE__) ) . 'js/jquery-2.1.3.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_jquery-ui', plugin_dir_url( dirname(__FILE__) ) . 'js/jquery-ui.js' );
	wp_enqueue_script( 'mo_oauth_admin_settings_inteltelinput', plugin_dir_url( dirname(__FILE__) ) . 'js/intlTelInput.min.js' );
}

function mo_oauth_client_main_menu() {
	$today = date("Y-m-d H:i:s");
	$date = "2020-12-31 23:59:59";
	$currenttab = "";
	if(isset($_GET['tab']))
		$currenttab = $_GET['tab'];

	Mo_OAuth_Client_Admin_Utils::curl_extension_check();
	Mo_OAuth_Client_Admin_Menu::show_menu($currenttab);
	echo '<div id="mo_oauth_settings">';
		Mo_OAuth_Client_Admin_Menu::show_idp_link($currenttab);
		if(get_option('mo_oauth_client_show_rest_api_message'))
			Mo_OAuth_Client_Admin_Menu::show_rest_api_secure_message();
		if ( $today <= $date )
			Mo_OAuth_Client_Admin_Menu::show_bfs_note();
		echo '
		<div class="miniorange_container">';

		echo '<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;" class="mo_oauth_content">';


				Mo_OAuth_Client_Admin_Menu::show_tab($currenttab);

				Mo_OAuth_Client_Admin_Menu::show_support_sidebar($currenttab);
				echo '</tr>
				</table>
				<div class="mo_tutorial_overlay" id="mo_tutorial_overlay" hidden></div>
		</div>';
}


function mo_oauth_hbca_xyake(){if(get_option('mo_oauth_client_admin_customer_key') > 138200)return true;else return false;}

class Mo_OAuth_Client_Admin_Menu {

	public static function logfile_delete(){

		$mo_file_path1=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.get_option('mo_oauth_debug').'.log';
		if(file_exists($mo_file_path1)) {
	 		unlink($mo_file_path1);
	   	}	
	  	
	}

	public static function show_menu($currenttab) {


		if( get_option('mo_debug_check') ){
			update_option( 'mo_debug_check',0 );
		}

		$log_file_path = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.get_option('mo_oauth_debug').'.log';

		$mo_log_enable = get_option('mo_debug_enable');

		$mo_oauth_debug = get_option('mo_oauth_debug');

		if( $mo_log_enable ){
			$key=604800;
			$mo_debug_times=get_option('mo_debug_time');
			$mo_curr_time=current_time('timestamp');

			$mo_oauth_var=(int)(($mo_curr_time-$mo_debug_times)/($key));
			if($mo_oauth_var>=1)
			{
				update_option('mo_debug_time',$mo_debug_times+($mo_oauth_var*$key));
				update_option('mo_debug_enable',0);
				
	    		self::logfile_delete();
				delete_option('mo_oauth_debug');
			}
		}
		else{
			self::logfile_delete();
			delete_option('mo_oauth_debug');
		}

		if( ( $mo_log_enable && !$mo_oauth_debug ) || ( $mo_log_enable && ( !file_exists( $log_file_path ) ) ) ){

				update_option('mo_oauth_debug','mo_oauth_debug'.uniqid());
				$mo_oauth_debugs=get_option('mo_oauth_debug');
				$mo_file_addr2=dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.$mo_oauth_debugs.'.log';
				$mo_debug_file=fopen($mo_file_addr2,"w");
				chmod($mo_file_addr2,0644);
				update_option( 'mo_debug_check',1 );
				MO_Oauth_Debug::mo_oauth_log('');
				update_option( 'mo_debug_check',0 );			
		}
		
		
		?> <div class="wrap">
			<div><img style="float:left;" src="<?php echo dirname(plugin_dir_url( __FILE__ ));?>/images/logo.png"></div>
		</div>
		        <div class="wrap">
            <h1>

                miniOrange OAuth Single Sign On
                &nbsp
                <a id="license_upgrade" class="add-new-h2 add-new-hover" style="background-color: orange !important; border-color: orange; font-size: 16px; color: #000;" href="<?php echo add_query_arg( array( 'tab' => 'licensing' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>"><?php esc_html_e('Premium plans','miniorange-login-with-eve-online-google-facebook')?></a>
                <a id="faq_button_id" class="add-new-h2" href="https://faq.miniorange.com/kb/oauth-openid-connect/" target="_blank"><?php esc_html_e('Troubleshooting','miniorange-login-with-eve-online-google-facebook')?></a>
                <a id="form_button_id" class="add-new-h2" href="https://forum.miniorange.com/" target="_blank"><?php esc_html_e('Ask questions on our forum','miniorange-login-with-eve-online-google-facebook')?></a>
                <a id="features_button_id" class="add-new-h2" href="https://developers.miniorange.com/docs/oauth/wordpress/client" target="_blank"><?php esc_html_e('Feature Details','miniorange-login-with-eve-online-google-facebook')?></a>
			</h1>
			<?php if ( 'licensing' === $currenttab ) { ?>
				<div id="moc-lp-imp-btns" style="float:right;">
					<a class="btn btn-outline-danger" target="_blank" href="https://plugins.miniorange.com/wordpress-oauth-client"><?php _e('Full Feature List','miniorange-login-with-eve-online-google-facebook');?></a>&emsp;<a class="btn btn-outline-primary" onclick="getlicensekeys()" href="#"><?php _e('Get License Keys','miniorange-login-with-eve-online-google-facebook');?></a>
				</div>
			<?php } /*else { ?>
				<div class="buts" style="float:right;">
					<div id="restart_tour_button" class="mo-otp-help-button static" style="margin-right:10px;z-index:10">
							<a class="button button-primary button-large">
								<span class="dashicons dashicons-controls-repeat" style="margin:5% 0 0 0;"></span>
									Restart Tour
							</a>
					</div>
			</div>
			<?php }*/ ?>
        </div>
        <style>
            .add-new-hover:hover{
                color: white !important;
            }

        </style>
		<div id="tab">
		<h2 class="nav-tab-wrapper">
			<a id="tab-config" class="nav-tab <?php if($currenttab == 'config') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=config"><?php esc_html_e('Configure OAuth','miniorange-login-with-eve-online-google-facebook')?></a>
			<a id="tab-attrmapping" class="nav-tab <?php if($currenttab == 'attributemapping') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=attributemapping"><?php esc_html_e('Attribute/Role Mapping','miniorange-login-with-eve-online-google-facebook')?></a>
			<a id="tab-signinsettings" class="nav-tab <?php if($currenttab == 'signinsettings') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=signinsettings"><?php esc_html_e('Login Settings','miniorange-login-with-eve-online-google-facebook')?></a>
			<a id="tab-customization" class="nav-tab <?php if($currenttab == 'customization') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=customization"><?php esc_html_e('Login Button Customization','miniorange-login-with-eve-online-google-facebook')?></a>
			<a id="tab-requestdemo" class="nav-tab <?php if($currenttab == 'requestfordemo') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=requestfordemo"><?php esc_html_e('Trials Available','miniorange-login-with-eve-online-google-facebook')?></a>
			<!-- <a class="nav-tab <?php //if($currenttab == 'faq') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=faq">Frequently Asked Questions [FAQ]</a>	 -->
			<a id="tab-acc-setup" class="nav-tab <?php if($currenttab == 'account') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=account"><?php esc_html_e('Account Setup','miniorange-login-with-eve-online-google-facebook')?></a>
            <a id="tab-addons" class="nav-tab <?php if($currenttab == 'addons') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=addons"><?php esc_html_e('Add-ons','miniorange-login-with-eve-online-google-facebook')?></a>
			<!-- <a class="nav-tab <?php //if($currenttab == 'licensing') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=licensing">Licensing Plans</a> -->
		</h2>
		</div>
		<?php

	}
public static function show_rest_api_secure_message()
	{
		if ( get_option( 'mo_oauth_client_show_rest_api_message' )) {
            ?>
            <form name="f" method="post" action="" id="mo_oauth_client_rest_api_form">
            	<?php wp_nonce_field('mo_oauth_client_rest_api_form','mo_oauth_client_rest_api_form_field'); ?>
                <input type="hidden" name="option" value="mo_oauth_client_rest_api_message"/>
                <div class="notice notice-info"style="padding-right: 38px;position: relative;border-left-color:red;"><h4><i class="fa fa-exclamation-triangle" style="font-size:20px;color:red;"></i>&nbsp;&nbsp;
                   <b>Security Alert: </b> Looks like your WP REST APIs are not protected from public access. WP REST APIs should be protected and allowed only for authorized access. You can <a href="https://wordpress.org/plugins/wp-rest-api-authentication/" target="_blank">click here</a> to know how it can be handled.</h4>
                    <button type="button" class="notice-dismiss" id="mo_oauth_client_rest_api_button"><span class="screen-reader-text">Dismiss this notice.</span>
                    </button>
                </div>
            </form>
            <script>
                jQuery("#mo_oauth_client_rest_api_button").click(function () {
                    jQuery("#mo_oauth_client_rest_api_form").submit();
                });
            </script>
			<?php
		}
//		self::mo_oauth_client_check_action_messages();
	}

	public static function show_bfs_note()
	{
        ?>
            <form name="f" method="post" action="" id="mo_oauth_client_bfs_note_form">
            	<?php wp_nonce_field('mo_oauth_client_bfs_note_form','mo_oauth_client_bfs_note_form_field'); ?>
				<input type="hidden" name="option" value="mo_oauth_client_bfs_note_message"/>	
                <div class="notice notice-info"style="padding-right: 38px;position: relative;border-color:red; background-color:black"><h4><center><i class="fa fa-gift" style="font-size:50px;color:red;"></i>&nbsp;&nbsp;
				<big><font style="color:white; font-size:30px;"><b>END OF YEAR SALE: </b><b style="color:yellow;">UPTO 50% OFF!</b></font> <br><br></big><font style="color:white; font-size:20px;">Contact us @ oauthsupport@xecurify.com for more details.</font></center></h4>
				<p style="text-align: center; font-size: 60px; margin-top: 0px; color:white;" id="demo"></p>
				</div>
			</form>
		<script>
		var countDownDate = <?php echo strtotime('Dec 31, 2020 23:59:59') ?> * 1000;
		var now = <?php echo time() ?> * 1000;
		var x = setInterval(function() {
			now = now + 1000;
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			}
		}, 1000);
		</script>
		<?php
	}

	public static function show_idp_link($currenttab) {
	if ((! get_option( 'mo_oauth_client_show_mo_server_message' )) ) {
            ?>
            <form name="f" method="post" action="" id="mo_oauth_client_mo_server_form">
            	<?php wp_nonce_field('mo_oauth_mo_server_message_form','mo_oauth_mo_server_message_form_field'); ?>
                <input type="hidden" name="option" value="mo_oauth_client_mo_server_message"/>
                <div class="notice notice-info" style="padding-right: 38px;position: relative;">
                    <h4><?php _e('Looking for a User Storage/OAuth Server? We have a B2C Service(Cloud IDP) which can scale to hundreds of millions of consumer identities. You can','miniorange-login-with-eve-online-google-facebook');?> <a href="https://idp.miniorange.com/b2c-pricing" target="_blank"><?php _e('click here','miniorange-login-with-eve-online-google-facebook');?></a> <?php _e('to find more about it.','miniorange-login-with-eve-online-google-facebook');?></h4>
                    <button type="button" class="notice-dismiss" id="mo_oauth_client_mo_server"><span class="screen-reader-text">Dismiss this notice.</span>
                    </button>
                </div>
            </form>
            <script>
                jQuery("#mo_oauth_client_mo_server").click(function () {
                    jQuery("#mo_oauth_client_mo_server_form").submit();
                });
            </script>
			<?php
		}
		self::mo_oauth_client_check_action_messages();
	}


	public static function mo_oauth_client_check_action_messages() {
		$notices = get_option( 'mo_oauth_client_notice_messages' );

		if( empty( $notices ) ) {
			return;
		}
		foreach( $notices as $key => $notice ) {
			echo '<div class="notice notice-info" style="padding-right: 38px;position: relative;"><h4>' . $notice .'</h4></div>';
		}
	}

	public static function show_tab($currenttab) {
			if($currenttab == 'account') {
				if (get_option ( 'mo_oauth_client_verify_customer' ) == 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if (trim ( get_option ( 'mo_oauth_admin_email' ) ) != '' && trim ( get_option ( 'mo_oauth_client_admin_api_key' ) ) == '' && get_option ( 'mo_oauth_client_new_registration' ) != 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if(get_option('mo_oauth_client_registration_status') == 'MO_OTP_DELIVERED_SUCCESS' || get_option('mo_oauth_client_registration_status')=='MO_OTP_VALIDATION_FAILURE' ||get_option('mo_oauth_client_registration_status') ==  'MO_OTP_DELIVERED_SUCCESS_PHONE' ||get_option('mo_oauth_client_registration_status') == 'MO_OTP_DELIVERED_FAILURE_PHONE'){
					Mo_OAuth_Client_Admin_Account::otp_verification();
				} else {
					Mo_OAuth_Client_Admin_Account::register();
				}
			} else if($currenttab == 'customization')
				Mo_OAuth_Client_Admin_Apps::customization();
			else if($currenttab == 'signinsettings')
				Mo_OAuth_Client_Admin_Apps::sign_in_settings();
			else if($currenttab == 'licensing')
				Mo_OAuth_Client_Admin_Licensing::show_licensing_page();
			else if($currenttab == 'requestfordemo')
    			Mo_OAuth_Client_Admin_RFD::requestfordemo();
			else if($currenttab == 'faq')
    			Mo_OAuth_Client_Admin_Faq::faq();
            else if($currenttab == 'addons')
				Mo_OAuth_Client_Admin_Addons::addons();
			else if($currenttab == 'attributemapping')
				Mo_OAuth_Client_Admin_Apps::attribute_role_mapping();
			else if($currenttab == '') {
					?>
						<a id="goregister" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'config' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">

						<script>
							location.href = jQuery('#goregister').attr('href');
						</script>
					<?php
			} else {
				Mo_OAuth_Client_Admin_Apps::applist();
			}
		//}
	}

	public static function show_support_sidebar($currenttab) {
		if($currenttab != 'licensing') {
			echo '<td style="vertical-align:top;padding-left:1%;" class="mo_oauth_sidebar">';
			if ( 'attributemapping' === $currenttab ) {
				echo Mo_OAuth_Client_Admin_Attribute_Mapping::emit_attribute_table();
			}
			echo Mo_OAuth_Client_Admin_Support::support();
			echo '</td>';
		}
	}

}

?>