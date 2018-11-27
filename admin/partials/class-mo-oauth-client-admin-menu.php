<?php

require('class-mo-oauth-client-admin-utils.php');
require('account/class-mo-oauth-client-admin-account.php');
require('apps/class-mo-oauth-client-apps.php');
require('licensing/class-mo-oauth-client-license.php');
require('guides/class-mo-oauth-client-guides.php');
require('support/class-mo-oauth-client-support.php');
require('reports/class-mo-oauth-client-reports.php');
require('faq/class-mo-oauth-client-faq.php');

function mo_oauth_client_main_menu() {

	$currenttab = "";
	if(isset($_GET['tab']))
		$currenttab = $_GET['tab'];
	
	Mo_OAuth_Client_Admin_Utils::curl_extension_check();	
	Mo_OAuth_Client_Admin_Menu::show_menu($currenttab);
	echo '<div id="mo_oauth_settings">';
		Mo_OAuth_Client_Admin_Menu::show_idp_link($currenttab);
		echo '
		<div class="miniorange_container">';
		
		echo '<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;" class="mo_oauth_content">';
			
		
				Mo_OAuth_Client_Admin_Menu::show_tab($currenttab);
				
				Mo_OAuth_Client_Admin_Menu::show_support_sidebar($currenttab);
				echo '</tr>
				</table>
				<div class="overlay" id="overlay" hidden></div>
		</div>';
}


function mo_eve_online_config() {
	$currenttab = "";
	if(isset($_GET['tab']))
		$currenttab = $_GET['tab'];
	Mo_OAuth_Client_Admin_Menu::show_menu($currenttab);
	Mo_OAuth_Client_Admin_Apps::eve_settings();
}

function mo_oauth_hbca_xyake(){if(get_option('mo_oauth_admin_customer_key') > 138200)return true;else return false;}

class Mo_OAuth_Client_Admin_Menu {
	
	public static function show_menu($currenttab) {
		?> <div class="wrap">
			<div><img style="float:left;" src="<?php echo dirname(plugin_dir_url( __FILE__ ));?>/images/logo.png"></div>
		</div>
		<div id="tab">
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if($currenttab == 'account') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=account">Account Setup</a>
			<a class="nav-tab <?php if($currenttab == 'config') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=config">Configure OAuth</a>
			<a class="nav-tab <?php if($currenttab == 'customization') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=customization">Customizations</a>
			<?php if(get_option('mo_oauth_eveonline_enable') == 1 ){?><a class="nav-tab <?php if($currenttab == 'mo_oauth_eve_online_setup') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_eve_online_setup">Advanced EVE Online Settings</a><?php } ?>
			<a class="nav-tab <?php if($currenttab == 'signinsettings') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=signinsettings">Sign In Settings</a>
			<a class="nav-tab <?php if($currenttab == 'faq') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=faq">Frequently Asked Questions [FAQ]</a>			
			<a class="nav-tab <?php if($currenttab == 'licensing') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=licensing">Licensing Plans</a>
		</h2>
		</div> 
		<?php
	
	}
	
	
	public static function show_idp_link($currenttab) { 
	if ((! get_option( 'mo_oauth_client_show_mo_server_message' )) ) {
            ?>
            <form name="f" method="post" action="" id="mo_oauth_client_mo_server_form">
                <input type="hidden" name="option" value="mo_oauth_client_mo_server_message"/>
                <div class="notice notice-info" style="padding-right: 38px;position: relative;">
                    <h4>If you are looking for an OAuth Server, you can try out <a href="https://idp.miniorange.com" target="_blank">miniOrange On-Premise OAuth Server</a>.</h4>
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
	}
	
	
	public static function show_tab($currenttab) { 
			if($currenttab == 'account') {
				if (get_option ( 'verify_customer' ) == 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if (trim ( get_option ( 'mo_oauth_admin_email' ) ) != '' && trim ( get_option ( 'mo_oauth_admin_api_key' ) ) == '' && get_option ( 'new_registration' ) != 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS' || get_option('mo_oauth_registration_status')=='MO_OTP_VALIDATION_FAILURE' ||get_option('mo_oauth_registration_status') ==  'MO_OTP_DELIVERED_SUCCESS_PHONE' ||get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_FAILURE_PHONE'){
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
			else if($currenttab == 'faq') 
    			Mo_OAuth_Client_Admin_Faq::faq(); 
			else if($currenttab == '' || $currenttab === 'account') {
					?>
						<a id="goregister" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">

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
			echo Mo_OAuth_Client_Admin_Support::support();
			echo '</td>';
		}
	}
		
}

?>