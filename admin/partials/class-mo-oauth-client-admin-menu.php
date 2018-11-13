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
			<a class="nav-tab <?php if($currenttab == '') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings">Configure OAuth</a>
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
	
		if (!mo_oauth_is_customer_registered() && $currenttab!=="register") {
					echo '<div class="error" style="display:block;margin:10px;color:red;background-color:rgba(251, 232, 0, 0.15);border:solid 1px rgba(255, 0, 9, 0.36);position: relative;">
                    <h4 style="margin: 15px 25px; position: relative;"><a href="admin.php?page=mo_oauth_settings&tab=register" >Click Here</a> to Register/Login.</a></h4>
                	</div>
					<div id="toast">You need to Register first to proceed with the configuration!</div>
				<script>
					var mouse;
					jQuery( document ).ready(function() {
						jQuery(".mo_oauth_content :input").prop("disabled", true);
						jQuery("#restart_tour_id").prop("disabled", false);
						// $("#restart_tour_id").removeAttr("disabled") 
						//jQuery(".mo_oauth_content :input[type=text]").val("");
						//jQuery(".mo_oauth_content :input[type=url]").val("");
						jQuery(".mo_oauth_content a").prop("href","javascript:show_reg_toast()");
						jQuery("#mo_oauth_client_default_apps_input").removeProp("disabled");
					});
					function show_reg_toast() {
						var x = document.getElementById("toast");
						placeDiv(mouse.x, mouse.y, "toast");
						x.className = "show";
						setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
					}

					function placeDiv(x_pos, y_pos, divid) {
						var d = document.getElementById(divid);
						d.style.position = "absolute";
						d.style.left = x_pos+"px";
						d.style.top = y_pos+"px";
					  }

					function handler(e) {
						e = e || window.event;
					
						var pageX = e.pageX;
						var pageY = e.pageY;
					
						// IE 8
						if (pageX === undefined) {
							pageX = e.clientX;
							pageY = e.clientY;
						}
						mouse = {
							"x": pageX, 
							"y": pageY,
						}
						console.log(mouse);
					}
					
					// attach handler to the click event of the document
					if (document.attachEvent) document.attachEvent("onclick", handler);
					else document.addEventListener("click", handler);
				</script>
		
		';					
				
		} else if ( mo_oauth_is_customer_registered() && ( $currenttab == 'licensing' || ! get_option( 'mo_oauth_client_show_mo_server_message' )) ) {
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
	
			if($currenttab == 'register') {
				if (get_option ( 'verify_customer' ) == 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if (trim ( get_option ( 'mo_oauth_admin_email' ) ) != '' && trim ( get_option ( 'mo_oauth_admin_api_key' ) ) == '' && get_option ( 'new_registration' ) != 'true') {
					Mo_OAuth_Client_Admin_Account::verify_password();
				} else if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS' || get_option('mo_oauth_registration_status')=='MO_OTP_VALIDATION_FAILURE' ||get_option('mo_oauth_registration_status') ==  'MO_OTP_DELIVERED_SUCCESS_PHONE' ||get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_FAILURE_PHONE'){
					Mo_OAuth_Client_Admin_Account::otp_verification();
				} else if (! mo_oauth_is_customer_registered()) {
					delete_option ( 'password_mismatch' );
					Mo_OAuth_Client_Admin_Account::register();
				} else 
					Mo_OAuth_Client_Admin_Apps::applist();
			} else if($currenttab == 'customization')
				Mo_OAuth_Client_Admin_Apps::customization();
			else if($currenttab == 'signinsettings')
				Mo_OAuth_Client_Admin_Apps::sign_in_settings();
			else if($currenttab == 'licensing')
				Mo_OAuth_Client_Admin_Licesing::license_page();
			else if($currenttab == 'faq') 
    			Mo_OAuth_Client_Admin_Faq::faq(); 
			else
				Mo_OAuth_Client_Admin_Apps::applist();
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