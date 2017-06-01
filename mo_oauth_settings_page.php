<?php


function mo_register() {
	
	$currenttab = "";
	if(isset($_GET['tab']))
		$currenttab = $_GET['tab'];
	?>
	<?php
		if(mo_oauth_is_curl_installed()==0){ ?>
			<p style="color:red;">(Warning: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP CURL extension</a> is not installed or disabled. Please install/enable it before you proceed.)</p>
		<?php
		}
	?>
<div id="tab">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php if($currenttab == '') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings">Configure OAuth</a> 
		<a class="nav-tab <?php if($currenttab == 'customization') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=customization">Customizations</a> 
		<a class="nav-tab <?php if($currenttab == 'signinsettings') echo 'nav-tab-active';?>" href="admin.php?page=mo_oauth_settings&tab=signinsettings">Sign In Settings</a> 
		<?php if(get_option('mo_oauth_new_customer')!=1 && get_option('mo_oauth_eveonline_enable') == 1 ){?><a class="nav-tab" href="admin.php?page=mo_oauth_eve_online_setup">Advanced EVE Online Settings</a><?php } ?>
	</h2>
</div>
<div id="mo_oauth_settings">
	
	<div class="miniorange_container">
		<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;">
		<?php
	if (get_option ( 'verify_customer' ) == 'true') {
		mo_oauth_show_verify_password_page();
	} else if (trim ( get_option ( 'mo_oauth_admin_email' ) ) != '' && trim ( get_option ( 'mo_oauth_admin_api_key' ) ) == '' && get_option ( 'new_registration' ) != 'true') {
		mo_oauth_show_verify_password_page();
	} else if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS' || get_option('mo_oauth_registration_status') == 'MO_OTP_VALIDATION_FAILURE' ){
		mo_oauth_show_otp_verification();
	} else if (! mo_oauth_is_customer_registered()) {
		delete_option ( 'password_mismatch' );
		mo_oauth_show_new_registration_page();
	} else {
		
		if($currenttab == 'customization')
			mo_oauth_app_customization();
		else if($currenttab == 'signinsettings')
			mo_oauth_sign_in_settings();
		else
			mo_oauth_apps_config();
	}
	?>
			</td>
					<td style="vertical-align:top;padding-left:1%;">
						<?php echo miniorange_support(); ?>	
					</td>
				</tr>
			</table>
		</div>
		<?php
}
function mo_oauth_show_new_registration_page() {
	update_option ( 'new_registration', 'true' );
	$current_user = wp_get_current_user();
	?>
			<!--Register with miniOrange-->
		<form name="f" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_register_customer" />
			<div class="mo_table_layout">
				<div id="toggle1" class="panel_toggle">
					<h3>Register with miniOrange</h3>
				</div>
				<div id="panel1">
					<!--<p><b>Register with miniOrange</b></p>-->
					<p>Please enter a valid Email ID that you have access to. You will be able to move forward after verifying an OTP that we will be sending to this email.
					</p>
					<table class="mo_settings_table">
						<tr>
							<td><b><font color="#FF0000">*</font>Email:</b></td>
							<td><input class="mo_table_textbox" type="email" name="email"
								required placeholder="person@example.com"
								value="<?php echo get_option('mo_oauth_admin_email');?>" />
							</td>
						</tr>
							<tr>
							<td><b><font color="#FF0000">*</font>Website/Company Name:</b></td>
							<td><input class="mo_table_textbox" type="text" name="company"
							required placeholder="Enter website or company name" 
							value="<?php echo $_SERVER['SERVER_NAME']; ?>"/></td>
						</tr>
						<tr>
							<td><b>&nbsp;&nbsp;First Name:</b></td>
							<td><input class="mo_openid_table_textbox" type="text" name="fname"
							placeholder="Enter first name" value="<?php echo $current_user->user_firstname;?>" /></td>
						</tr>
						<tr>
							<td><b>&nbsp;&nbsp;Last Name:</b></td>
							<td><input class="mo_openid_table_textbox" type="text" name="lname"
							placeholder="Enter last name" value="<?php echo $current_user->user_lastname;?>" /></td>
						</tr>

						<tr>
							<td><b>&nbsp;&nbsp;Phone number :</b></td>
							 <td><input class="mo_table_textbox" type="text" name="phone" pattern="[\+]?([0-9]{1,4})?\s?([0-9]{7,12})?" id="phone" title="Phone with country code eg. +1xxxxxxxxxx" placeholder="Phone with country code eg. +1xxxxxxxxxx" value="<?php echo get_option('mo_oauth_admin_phone');?>" />
							 This is an optional field. We will contact you only if you need support.</td>
							</tr>
						</tr>
						<tr>
							<td></td>
							<td>We will call only if you need support.</td>
						</tr>
						<tr>
							<td><b><font color="#FF0000">*</font>Password:</b></td>
							<td><input class="mo_table_textbox" required type="password"
								name="password" placeholder="Choose your password (Min. length 8)" /></td>
						</tr>
						<tr>
							<td><b><font color="#FF0000">*</font>Confirm Password:</b></td>
							<td><input class="mo_table_textbox" required type="password"
								name="confirmPassword" placeholder="Confirm your password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><br /><input type="submit" name="submit" value="Save" style="width:100px;"
								class="button button-primary button-large" /></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<script>
			jQuery("#phone").intlTelInput();
		</script>
		<?php
}
function mo_oauth_show_verify_password_page() {
	?>
			<!--Verify password with miniOrange-->
		<form name="f" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_verify_customer" />
			<div class="mo_table_layout">
				<div id="toggle1" class="panel_toggle">
					<h3>Login with miniOrange</h3>
				</div>
				<div id="panel1">
					</p>
					<table class="mo_settings_table">
						<tr>
							<td><b><font color="#FF0000">*</font>Email:</b></td>
							<td><input class="mo_table_textbox" type="email" name="email"
								required placeholder="person@example.com"
								value="<?php echo get_option('mo_oauth_admin_email');?>" /></td>
						</tr>
						<td><b><font color="#FF0000">*</font>Password:</b></td>
						<td><input class="mo_table_textbox" required type="password"
							name="password" placeholder="Choose your password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit"
								class="button button-primary button-large" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
								target="_blank"
								href="<?php echo get_option('host_name') . "/moas/idp/userforgotpassword"; ?>">Forgot
									your password?</a></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<?php
}

function mo_oauth_sign_in_settings(){
	?>
	<div class="mo_table_layout">
		<h2>Sign in options</h2>
		
		<h4>Option 1: Use a Widget</h4>
		<ol>
			<li>Go to Appearances > Widgets.</li>
			<li>Select <b>"miniOrange OAuth"</b>. Drag and drop to your favourite location and save.</li>
		</ol>
		
		<h4>Option 2: Use a Shortcode</h4>
		<ul>
			<li>Place shortcode <b>[mo_oauth_login]</b> in wordpress pages or posts.</li>
		</ul>
	</div>
	<?php
}

function mo_oauth_app_customization(){
	?>
	<div class="mo_table_layout">
	<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=customization">
		<input type="hidden" name="option" value="mo_oauth_app_customization" /> 
		<h2>Customize Icons</h2>
		<table class="mo_settings_table">
			<tr>
				<td><strong>Icon Width:</strong></td>
				<td><input type="text" id="mo_oauth_icon_width" name="mo_oauth_icon_width" value="<?php echo get_option('mo_oauth_icon_width');?>"> e.g. 200px or 100%</td>
			</tr>
			<tr>
				<td><strong>Icon Height:</strong></td>
				<td><input  type="text" id="mo_oauth_icon_height" name="mo_oauth_icon_height" value="<?php echo get_option('mo_oauth_icon_height');?>"> e.g. 50px or auto</td>
			</tr>
			<tr>
				<td><strong>Icon Margins:</strong></td>
				<td><input  type="text" id="mo_oauth_icon_margin" name="mo_oauth_icon_margin" value="<?php echo get_option('mo_oauth_icon_margin');?>"> e.g. 2px 0px or auto</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
		</table>
	</form>
	</div>
	<?php
}

function mo_oauth_apps_config() {
	?>
	<style>
		.tableborder {
			border-collapse: collapse;
			width: 100%;
			border-color:#eee;
		}

		.tableborder th, .tableborder td {
			text-align: left;
			padding: 8px;
			border-color:#eee;
		}

		.tableborder tr:nth-child(even){background-color: #f2f2f2}
	</style>
	<div class="mo_table_layout">
	<?php
	
		if(isset($_GET['action']) && $_GET['action']=='delete'){
			if(isset($_GET['app']))
				delete_app($_GET['app']);
		} else if(isset($_GET['action']) && $_GET['action']=='instructions'){
			if(isset($_GET['app']))
				instructions($_GET['app']);
		}
		
		if(isset($_GET['action']) && $_GET['action']=='add'){
			add_app();
		} 
		else if(isset($_GET['action']) && $_GET['action']=='update'){
			if(isset($_GET['app']))
				update_app($_GET['app']);
		}
		else if(get_option('mo_oauth_apps_list'))
		{	
			$appslist = get_option('mo_oauth_apps_list');
			echo "<br><a href='admin.php?page=mo_oauth_settings&action=add'><button style='float:right'>Add Application</button></a>";
			echo "<h3>Applications List</h3>";
			echo "<table class='tableborder'>";
			echo "<tr><th><b>Name</b></th><th>Action</th></tr>";
			foreach($appslist as $key => $app){
				echo "<tr><td>".$key."</td><td><a href='admin.php?page=mo_oauth_settings&action=update&app=".$key."'>Update</a> | <a href='admin.php?page=mo_oauth_settings&action=delete&app=".$key."'>Delete</a> | <a href='admin.php?page=mo_oauth_settings&action=instructions&app=".$key."'>How to Configure?</a></td></tr>";
			}
			echo "</table>";
			echo "<br><br>";
	
		} else {
			add_app();
		 } ?>
		</div>
<?php
	if(get_option('mo_oauth_eveonline_enable'))
		mo_oauth_apps_config_old();
}

function add_app(){
	?>

		<script>
			function selectapp() {
				var appname = document.getElementById("mo_oauth_app").value;
				document.getElementById("instructions").innerHTML  = "";
				if(appname=="google"){
					document.getElementById("instructions").innerHTML  = '<br><strong>Instructions to configure Google :</strong><ol><li>Visit the Google website for developers <a href="https://console.developers.google.com/project"target="_blank">console.developers.google.com</a>.</li><li>Open the Google API Console Credentials page and go to API Manager -> Credentials</li><li>From the project drop-down, choose Create a new project, enter a name for the project, and optionally, edit the provided Project ID. Click Create.</li><li>On the Credentials page, select Create credentials, then select OAuth client ID.</li><li>You may be prompted to set a product name on the Consent screen. If so, click Configure consent screen, supply the requested information, and click Save to return to the Credentials screen.</li><li>Select Web Application for the Application Type. Follow the instructions to enter JavaScript origins, redirect URIs, or both. provide <b><?php echo site_url()."/oauthcallback";?></b> for the Redirect URI.</li><li>Click Create.</li><li>On the page that appears, copy the client ID and client secret to your clipboard, as you will need them to configure above.</li><li>Enable the Google+ API.</li><li>Go to Appearance->Widgets. Among the available widgets youwill find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
				} else if(appname=="facebook"){
					document.getElementById("instructions").innerHTML  = '<br><strong>Instructions to configure Facebook : </strong><ol><li>Go to Facebook developers console <a href="https://developers.facebook.com/apps/" target="_blank">https://developers.facebook.com/apps/</a>.</li><li>Click on Create a New App/Add new App button. You will need to register as a Facebook developer to create an App.</li><li>Enter <b>Display Name</b>. And choose category.</li><li>Click on <b>Create App ID</b>.</li><li>From the left pane, select <b>Settings</b>.</li><li>From the tabs above, select <b>Advanced</b>.</li><li>Under <b>Client OAuth Settings</b>, enter <b><?php echo site_url()."/oauthcallback";?></b> in Valid OAuth redirect URIs and click <b>Save Changes</b>.</li><li>Paste your App ID/Secret provided by Facebook into the fields above.</li><li>Click on the Save settings button.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
				} else if(appname=="eveonline"){
					document.getElementById("instructions").innerHTML  = '<strong>Instructions:</strong><ol><li>Log in to your EVE Online account</li><li>At EVE Online, go to Support. Request for enabling OAuthfor a third-party application.</li><li>At EVE Online, add a new project/application. GenerateClient ID and Client Secret.</li><li>At EVE Online, set Redirect URL as <b><?php echo site_url()."/oauthcallback";?></b></li><li>Enter your Client ID and Client Secret above.</li><li>Click on the Save settings button.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
				} else{
					document.getElementById("instructions").innerHTML  = '<strong>Instructions to configure custom OAuth Server:</strong><ol><li>Enter your Client ID and Client Secret above.</li><li>Click on the Save settings button.</li><li>Provide <b><?php echo site_url()."/oauthcallback";?></b> for your OAuth server Redirect URI.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
				}
				
				if(appname=="other"){
					jQuery("#mo_oauth_custom_app_name_div").show();
					jQuery("#mo_oauth_authorizeurl_div").show();
					jQuery("#mo_oauth_accesstokenurl_div").show();
					jQuery("#mo_oauth_resourceownerdetailsurl_div").show();
					jQuery("#mo_oauth_email_attr_div").show();
					jQuery("#mo_oauth_name_attr_div").show();
					jQuery("#mo_oauth_custom_app_name").attr('required','true');
					jQuery("#mo_oauth_authorizeurl").attr('required','true');
					jQuery("#mo_oauth_accesstokenurl").attr('required','true');
					jQuery("#mo_oauth_resourceownerdetailsurl").attr('required','true');
					jQuery("#mo_oauth_email_attr").attr('required','true');
					jQuery("#mo_oauth_name_attr").attr('required','true');
				} else {
					jQuery("#mo_oauth_custom_app_name_div").hide();
					jQuery("#mo_oauth_authorizeurl_div").hide();
					jQuery("#mo_oauth_accesstokenurl_div").hide();
					jQuery("#mo_oauth_resourceownerdetailsurl_div").hide();
					jQuery("#mo_oauth_email_attr_div").hide();
					jQuery("#mo_oauth_name_attr_div").hide();
					jQuery("#mo_oauth_custom_app_name").removeAttr('required');
					jQuery("#mo_oauth_authorizeurl").removeAttr('required');
					jQuery("#mo_oauth_accesstokenurl").removeAttr('required');
					jQuery("#mo_oauth_resourceownerdetailsurl").removeAttr('required');
					//jQuery("#mo_oauth_email_attr").removeAttr('required');
					//jQuery("#mo_oauth_name_attr").removeAttr('required');
				}
				
			}

		</script>	
		<div id="toggle2" class="panel_toggle">
			<h3>Add Application</h3>
		</div>
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<input type="hidden" name="option" value="mo_oauth_add_app" /> 
		<table class="mo_settings_table">
			<tr>
			<td><strong><font color="#FF0000">*</font>Select Application:</strong></td>
			<td>
				<select class="mo_table_textbox" required="true" name="mo_oauth_app_name" id="mo_oauth_app" onchange="selectapp()">
				  <option value="">Select Application</option>
				  <option value="google">Google</option>
				  <option value="facebook">Facebook</option>
				  <option value="windows">Windows Account</option>
				  <option value="eveonline">Eve Online</option>
				  <option value="other">Other</option>
				</select>
			</td>
			</tr>
			<tr  style="display:none" id="mo_oauth_custom_app_name_div">
				<td><strong><font color="#FF0000">*</font>Custom App Name:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_custom_app_name" name="mo_oauth_custom_app_name" value=""></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value=""></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text"  name="mo_oauth_client_secret" value=""></td>
			</tr>
			<tr>
				<td><strong>Scope:</strong></td>
				<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="email"></td>
			</tr>
			<tr style="display:none" id="mo_oauth_authorizeurl_div">
				<td><strong><font color="#FF0000">*</font>Authorize Endpoint:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value=""></td>
			</tr>
			<tr style="display:none" id="mo_oauth_accesstokenurl_div">
				<td><strong><font color="#FF0000">*</font>Access Token Endpoint:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value=""></td>
			</tr>
			<tr style="display:none" id="mo_oauth_resourceownerdetailsurl_div">
				<td><strong><font color="#FF0000">*</font>Get User Info Endpoint:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value=""></td>
			</tr>
			<!--<tr style="display:none" id="mo_oauth_email_attr_div">
				<td><strong><font color="#FF0000">*</font>Email Attribute:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_email_attr" name="mo_oauth_email_attr" value=""></td>
			</tr>
			<tr style="display:none" id="mo_oauth_name_attr_div">
				<td><strong><font color="#FF0000">*</font>Name Attribute:</strong></td>
				<td><input class="mo_table_textbox" type="text" id="mo_oauth_name_attr" name="mo_oauth_name_attr" value=""></td>
			</tr>-->
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
			</table>
		</form>
		
		<div id="instructions">
			
		</div>
		
		<?php
}

function update_app($appname){
	
	$appslist = get_option('mo_oauth_apps_list');
	foreach($appslist as $key => $app){
		if($appname == $key){
			$currentappname = $appname;
			$currentapp = $app;
			break;
		}
	}
	
	if(!$currentapp)
		return;
	
	$is_other_app = false;
	if(!in_array($currentappname, array("facebook","google","eveonline","windows")))
		$is_other_app = true;
	
	?>
		
		<div id="toggle2" class="panel_toggle">
			<h3>Update Application</h3>
		</div>
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<input type="hidden" name="option" value="mo_oauth_add_app" /> 
		<table class="mo_settings_table">
			<tr>
			<td><strong><font color="#FF0000">*</font>Application:</strong></td>
			<td>
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_app_name" value="<?php echo $currentappname;?>">
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">
				<?php echo $currentappname;?><br><br>
			</td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value="<?php echo $currentapp['clientid'];?>"></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_secret" value="<?php echo $currentapp['clientsecret'];?>"></td>
			</tr>
			<tr>
				<td><strong>Scope:</strong></td>
				<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="<?php echo $currentapp['scope'];?>"></td>
			</tr>
			<?php if($is_other_app){ ?>
			<tr  id="mo_oauth_authorizeurl_div">
				<td><strong><font color="#FF0000">*</font>Authorize Endpoint:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="<?php echo $currentapp['authorizeurl'];?>"></td>
			</tr>
			<tr id="mo_oauth_accesstokenurl_div">
				<td><strong><font color="#FF0000">*</font>Access Token Endpoint:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="<?php echo $currentapp['accesstokenurl'];?>"></td>
			</tr>
			<tr id="mo_oauth_resourceownerdetailsurl_div">
				<td><strong><font color="#FF0000">*</font>Get User Info Endpoint:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value="<?php echo $currentapp['resourceownerdetailsurl'];?>"></td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save settings" class="button button-primary button-large" />
					<?php if($is_other_app){?><input type="submit" name="button" value="Test Configuration" class="button button-primary button-large" onclick="testConfiguration()" /><?php } ?>
				</td>
			</tr>
		</table>
		</form>
		
		<?php if($is_other_app){ ?>
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<h3>Attribute Mapping</h3>
		<p style="font-size:10px">Do <b>Test Configuration</b> above to configure attribute mapping.<br></p>
		<input type="hidden" name="option" value="mo_oauth_attribute_mapping" />
		<input class="mo_table_textbox" required="" type="hidden" id="mo_oauth_app_name" name="mo_oauth_app_name" value="<?php echo $currentappname;?>">
		<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">
		<table class="mo_settings_table">		
			<tr id="mo_oauth_email_attr_div">
				<td><strong><font color="#FF0000">*</font>Email Attribute:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_email_attr" name="mo_oauth_email_attr" value="<?php echo $currentapp['email_attr'];?>"></td>
			</tr>
			<tr id="mo_oauth_name_attr_div">
				<td><strong><font color="#FF0000">*</font>Name Attribute:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_name_attr" name="mo_oauth_name_attr" value="<?php echo $currentapp['name_attr'];?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
			</table>
		</form>
		<script>
		function testConfiguration(){
			var mo_oauth_app_name = jQuery("#mo_oauth_app_name").val();
			var myWindow = window.open('<?php echo site_url(); ?>' + '/?option=testattrmappingconfig&app='+mo_oauth_app_name, "Test Attribute Configuration", "width=600, height=600");	
		}
		</script>
		<?php } 
}

function delete_app($appname){
	$appslist = get_option('mo_oauth_apps_list');
	foreach($appslist as $key => $app){
		if($appname == $key){
			unset($appslist[$key]);
			if($appname=="eveonline")
				update_option( 'mo_oauth_eveonline_enable', 0);
		}
	}
	update_option('mo_oauth_apps_list', $appslist);
}

function instructions($appname){
	if($appname=="google"){
		echo '<br><strong>Instructions to configure Google :</strong><ol><li>Visit the Google website for developers <a href="https://console.developers.google.com/project"target="_blank">console.developers.google.com</a>.</li><li>Open the Google API Console Credentials page and go to API Manager -> Credentials</li><li>From the project drop-down, choose Create a new project, enter a name for the project, and optionally, edit the provided Project ID. Click Create.</li><li>On the Credentials page, select Create credentials, then select OAuth client ID.</li><li>You may be prompted to set a product name on the Consent screen. If so, click Configure consent screen, supply the requested information, and click Save to return to the Credentials screen.</li><li>Select Web Application for the Application Type. Follow the instructions to enter JavaScript origins, redirect URIs, or both. provide <b>'.site_url().'/oauthcallback</b> for the Redirect URI.</li><li>Click Create.</li><li>On the page that appears, copy the client ID and client secret to your clipboard, as you will need them to configure above.</li><li>Enable the Google+ API.</li><li>Go to Appearance->Widgets. Among the available widgets youwill find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
	} else if($appname=="facebook"){
		echo '<br><strong>Instructions to configure Facebook : </strong><ol><li>Go to Facebook developers console <a href="https://developers.facebook.com/apps/" target="_blank">https://developers.facebook.com/apps/</a>.</li><li>Click on Create a New App/Add new App button. You will need to register as a Facebook developer to create an App.</li><li>Enter <b>Display Name</b>. And choose category.</li><li>Click on <b>Create App ID</b>.</li><li>From the left pane, select <b>Settings</b>.</li><li>From the tabs above, select <b>Advanced</b>.</li><li>Under <b>Client OAuth Settings</b>, enter <b>'.site_url().'/oauthcallback</b> in Valid OAuth redirect URIs and click <b>Save Changes</b>.</li><li>Paste your App ID/Secret provided by Facebook into the fields above.</li><li>Click on the Save settings button.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
	} else if($appname=="eveonline"){
		echo '<strong>Instructions:</strong><ol><li>Log in to your EVE Online account</li><li>At EVE Online, go to Support. Request for enabling OAuthfor a third-party application.</li><li>At EVE Online, add a new project/application. GenerateClient ID and Client Secret.</li><li>At EVE Online, set Redirect URL as <b>'.site_url().'/oauthcallback</b></li><li>Enter your Client ID and Client Secret above.</li><li>Click on the Save settings button.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
	} else{
		echo '<br><strong>Instructions to configure custom OAuth Server:</strong><ol><li>Enter your Client ID and Client Secret above.</li><li>Click on the Save settings button.</li><li>Provide <b>'.site_url().'/oauthcallback</b> for your OAuth server Redirect URI.</li><li>Go to Appearance->Widgets. Among the available widgets you will find miniOrange OAuth, drag it to the widget area where you want it to appear.</li><li>Now logout and go to your site. You will see a login link where you placed that widget.</li></ol>';
	}
}

function mo_oauth_apps_config_old() {
	?>
			<!-- Google configurations -->
		<form id="form-google" name="form-google" method="post" action="" style="display:none">
			<input type="hidden" name="option" value="mo_oauth_google" /> 
			<input type="hidden" name="mo_oauth_google_scope" value="email" />
			<div class="mo_table_layout">
				<div id="toggle2" class="panel_toggle">
					<h3>Login with Google</h3>
				</div>
				<div id="panel2">
					<table class="mo_settings_table">
						<tr>
							<td class="mo_table_td_checkbox"><input type="checkbox"
								id="google_enable" name="mo_oauth_google_enable" value="1"
								<?php checked( get_option('mo_oauth_google_enable') == 1 );?> /><strong>Enable
									Google</strong></td>
							<td></td>
						</tr>
						<tr>
							<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
							<td><input class="mo_table_textbox" required class="textbox"
								type="text" placeholder="Click on Help to know more"
								name="mo_oauth_google_client_id"
								value="<?php echo get_option('mo_oauth_google_client_id'); ?>" /></td>
						</tr>

						<tr>
							<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
							<td><input class="mo_table_textbox" required type="text"
								placeholder="Click on Help to know more"
								name="mo_oauth_google_client_secret"
								value="<?php echo get_option('mo_oauth_google_client_secret'); ?>" /></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit" value="Save settings"
								class="button button-primary button-large" />&nbsp;&nbsp; <input
								type="button" id="google_help" class="help" value="Help" /></td>
						</tr>
						<tr>
							<td colspan="2" id="google_instru" hidden>
								<p>
									<strong>Instructions:</strong>
								
								<ol>
									<li>Visit the Google website for developers <a
										href='https://console.developers.google.com/project'
										target="_blank">console.developers.google.com</a>.
									</li>
									<li>At Google, create a new Project and enable the Google+ API.
										This will enable your site to access the Google+ API.</li>
									<li>At Google, provide <b><?php echo site_url()."/oauthcallback";?></b>
										for the new Project's Redirect URI.
									</li>
									<li>At Google, you must also configure the Consent Screen with
										your Email Address and Product Name. This is what Google will
										display to users when they are asked to grant access to your
										site/app.</li>
									<li>Paste your Client ID/Secret provided by Google into the
										fields above.</li>
									<li>Click on the Save settings button.</li>
									<li>Go to Appearance->Widgets. Among the available widgets you
										will find miniOrange OAuth, drag it to the widget area where
										you want it to appear.</li>
									<li>Now logout and go to your site. You will see a login link
										where you placed that widget.</li>
								</ol>
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<!-- Eveonline configurations -->
		<form id="form-eveonline" name="form-eveonline" method="post"
			action="">
			<input type="hidden" name="option" value="mo_oauth_eveonline" /> <input
				type="hidden" name="mo_oauth_eveonline_scope" value="" />
			<!--value of scope?-->
			<div class="mo_table_layout">
				<div id="toggle3" class="panel_toggle">
					<h3>Login with EVE Online</h3>
				</div>
				<div id="panel3">
					<table class="mo_settings_table">
						<tr>
							<td class="mo_table_td_checkbox"><input type="checkbox"
								id="eve_enable" name="mo_oauth_eveonline_enable" value="1"
								<?php checked( get_option('mo_oauth_eveonline_enable') == 1 );?> /><strong>Enable
									Eveonline</strong></td>
							<td></td>
						</tr>
						<tr>
							<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
							<td><input class="mo_table_textbox" required type="text"
								placeholder="Click on Help to know more"
								name="mo_oauth_eveonline_client_id"
								value="<?php echo get_option('mo_oauth_eveonline_client_id'); ?>" /></td>
						</tr>

						<tr>
							<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
							<td><input class="mo_table_textbox" type="text" required
								placeholder="Click on Help to know more"
								name="mo_oauth_eveonline_client_secret"
								value="<?php echo get_option('mo_oauth_eveonline_client_secret'); ?>" /></td>
						</tr>
						<tr>
							<td><a href="admin.php?page=mo_oauth_eve_online_setup">Advanced
									Settings</a></td>
							<td><input type="submit" name="submit" value="Save settings"
								class="button button-primary button-large" />&nbsp;&nbsp; <input
								type="button" id="eve_help" value="Help" /></td>
						</tr>
						<tr>
							<td colspan="2" id="eve_instru" hidden>
								<p>
									<strong>Instructions:</strong>
								
								<ol>
									<li>Log in to your EVE Online account</li>
									<li>At EVE Online, go to Support. Request for enabling OAuth
										for a third-party application.</li>
									<li>At EVE Online, add a new project/application. Generate
										Client ID and Client Secret.</li>
									<li>At EVE Online, set Redirect URL as <b><?php echo site_url()."/oauthcallback";?></b></li>
									<li>Enter your Client ID and Client Secret above.</li>
									<li>Click on the Save settings button.</li>
									<li>Go to Appearance->Widgets. Among the available widgets you
										will find miniOrange OAuth, drag it to the widget area where
										you want it to appear.</li>
									<li>Now logout and go to your site. You will see a login link
										where you placed that widget.</li>
								</ol>
								</p>
							</td>

						</tr>
					</table>
				</div>
			</div>
		</form>
		
		<!-- Facebook -->
		<form id="form-facebook" name="form-facebook" method="post" action=""  style="display:none">
			<input type="hidden" name="option" value="mo_oauth_facebook" /> 
			<input type="hidden" name="mo_oauth_facebook_scope" value="email" />
			<div class="mo_table_layout">
				<div id="toggle4" class="panel_toggle">
					<h3>Login with Facebook</h3>
				</div>
				<div id="panel4">
					<table class="mo_settings_table">
						<tr>
							<td class="mo_table_td_checkbox"><input type="checkbox"
								id="facebook_enable" name="mo_oauth_facebook_enable" value="1"
								<?php checked( get_option('mo_oauth_facebook_enable') == 1 );?> /><strong>Enable
									Facebook</strong></td>
							<td></td>
						</tr>
						<tr>
							<td><strong><font color="#FF0000">*</font>App ID:</strong></td>
							<td><input class="mo_table_textbox" required class="textbox"
								type="text" placeholder="Click on Help to know more"
								name="mo_oauth_facebook_client_id"
								value="<?php echo get_option('mo_oauth_facebook_client_id'); ?>" /></td>
						</tr>

						<tr>
							<td><strong><font color="#FF0000">*</font>App Secret:</strong></td>
							<td><input class="mo_table_textbox" required type="text"
								placeholder="Click on Help to know more"
								name="mo_oauth_facebook_client_secret"
								value="<?php echo get_option('mo_oauth_facebook_client_secret'); ?>" /></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit" value="Save settings"
								class="button button-primary button-large" />&nbsp;&nbsp; <input
								type="button" id="facebook_help" class="help" value="Help" /></td>
						</tr>
						<tr>
							<td colspan="2" id="facebook_instru" hidden>
								<p>
									<strong>Instructions:</strong>
								
								<ol>
									<li>Go to Facebook developers console <a
										href='https://developers.facebook.com/apps/'
										target="_blank">https://developers.facebook.com/apps/</a>.
									</li>
									<li>Click on Create a New App/Add new App button. You will need to register as a Facebook developer to create an App.</li>
									<li>Enter <b>Display Name</b>. And choose category.</li>
									<li>Click on <b>Create App ID</b>.</li>
									<li>From the left pane, select <b>Settings</b>.</li>
									<li>From the tabs above, select <b>Advanced</b>.</li>
									<li>Under <b>Client OAuth Settings</b>, enter <b><?php echo site_url()."/oauthcallback";?></b> in Valid OAuth redirect URIs and click <b>Save Changes</b>.</li>
									<li>Paste your App ID/Secret provided by Facebook into the
										fields above.</li>
									<li>Click on the Save settings button.</li>
									<li>Go to Appearance->Widgets. Among the available widgets you
										will find miniOrange OAuth, drag it to the widget area where
										you want it to appear.</li>
									<li>Now logout and go to your site. You will see a login link
										where you placed that widget.</li>
								</ol>
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>

</div>

<?php
}
function mo_eve_online_config() {
	?>
<div id="tab">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="admin.php?page=mo_oauth_settings">Configure OAuth</a> <a class="nav-tab  nav-tab-active"
			href="admin.php?page=mo_oauth_eve_online_setup">Advanced EVE Online Settings</a>
	</h2>
</div>
<div id="mo_eve_online_config">
		<?php
	$customerRegistered = mo_oauth_is_customer_registered ();
	if ($customerRegistered) {
		if (! get_option ( 'mo_oauth_eveonline_enable' )) {
			?>
				<h4>NOTE: Please enable EVE Online app to see Advanced EVE Online Settings dashboard.</h4>
				<?php
		} else {
			?>
				<!--Get API Key details-->
	<form id="mo_eve_save_api_key" name="mo_eve_save_api_key" method="post"
		action="">
		<input type="hidden" name="option" value="mo_eve_save_api_key" />
		<div class="mo_eve_table_layout">
			<h4>Please enter your API Key details below.</h4>
			<table class="mo_settings_table">
				<tr>
					<td class="col1"><strong>Key ID:</strong></td>
					<td><input class="mo_table_textbox" required class="textbox"
						type="text" placeholder="Click on Help to know more"
						name="mo_eve_api_key"
						value="<?php echo get_option('mo_eve_api_key');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Verification Code:</strong></td>
					<td><input class="mo_table_textbox" required type="text"
						placeholder="Click on Help to know more"
						name="mo_eve_verification_code"
						value="<?php echo get_option('mo_eve_verification_code');?>" /></td>
				</tr>
				<tr>
					<td class="col1">&nbsp;</td>
					<td><input type="submit" name="submit" value="Save"
						class="button button-primary button-large" />&nbsp;&nbsp; <input
						type="button" id="api_help" class="help" value="Help" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="api_instru" hidden>
							<p>
								<strong>Why do I need to enter API Key?</strong> <br /> API Key
								is required to get access to user public information. API Key
								will help filtering of users according to Corporation, Alliance
								or Character Name.
							</p>
							<p>
								<strong>How to get Key ID and Verification Code:</strong>
							
							
							<ol>
								<li>Login to your EVE Online account from <a
									href="https://community.eveonline.com/support/api-key/"
									target="_blank">https://community.eveonline.com/support/api-key/</a>.
								</li>
								<li>If you have already configured API KEY, paste it above.</li>
								<li>If you don't have an API KEY, click on CREATE NEW API KEY.</li>
								<li>Fill in the Name, Verification Code, Character and Type. Set
									Character to All.</li>
								<li>Select All for Account and Market, Communications, Private
									Information, Public Information and Science and Industry.</li>
								<li>Click on Submit. You will now see the KeyID and Verification
									Code on your screen with the new API Key added. Paste it above.</li>
							</ol>
							</p>
						</div>
					</td>

				</tr>
			</table>
		</div>
	</form>
	<!--Get list of allowed and denied corporations-->
	<form id="mo_eve_save_allowed" name="mo_eve_save_allowed" method="post"
		action="">
		<input type="hidden" name="option" value="mo_eve_save_allowed" />
		<div class="mo_eve_table_layout">
			<h4>Please choose the Corporations, Alliances or Character Name to be allowed. If none are mentioned, by default all corporations and alliances will be allowed.</h4>
			<table class="mo_settings_table">
				<tr>
					<td class="col1"><strong>Allowed Corporations:</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Corporation name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_allowed_corps"
						value="<?php echo get_option('mo_eve_allowed_corps');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Allowed Alliances:</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Alliance name separared by comma( , )"
						type="text" name="mo_eve_allowed_alliances"
						value="<?php echo get_option('mo_eve_allowed_alliances');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Allowed Characters (Character Name):</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Character Name separared by comma( , )"
						type="text" name="mo_eve_allowed_char_name"
						value="<?php echo get_option('mo_eve_allowed_char_name');?>" /></td>
				</tr>
				<tr>
					<td class="col1">&nbsp;</td>
					<td><input type="submit" name="submit" value="Save"
						class="button button-primary button-large" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<p>
							<strong>How do I see my Corporation, Alliance and Character Name
								from EVE Online?</strong> <br /> You can view your Corporation,
							Alliance and Character Name in your Edit Profile. Copy the
							following code in the end of your theme's `Theme
							Functions(functions.php)`. You can find `Theme
							Functions(functions.php)` in `Appearance->Editor`. <br />
							<br />
							<code>
								add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );<br />
								add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
							</code>
						</p>
					</td>

				</tr>
			</table>
		</div>
	</form>
				<?php
			}
			?>
			</div>
<?php
		} else {
			?>
<h4>NOTE: Please first Register with miniOrange and then enable EVE Online app to see Advanced EVE Online Settings dashboard.</h4>
<?php
		}
	}
	function miniorange_support(){
?>
	<div class="mo_support_layout">
		<!--<h3>Support</h3>
		<div >
			<p>Your general questions can be asked in the plugin <a href="https://wordpress.org/support/plugin/miniorange-login-with-eve-online-google-facebook" target="_blank">support forum</a>.</p>
		</div>
		<div style="text-align:center;">
			<h4>OR</h4>
		</div>-->
		<div>
			<h3>Contact Us</h3>
			<form method="post" action="">
				<input type="hidden" name="option" value="mo_oauth_contact_us_query_option" />
				<table class="mo_settings_table">
					<tr>
						<td><b><font color="#FF0000">*</font>Email:</b></td>
						<td><input type="email" class="mo_table_textbox" required name="mo_oauth_contact_us_email" value="<?php echo get_option("mo_oauth_admin_email"); ?>"></td>
					</tr>
					<tr>
						<td><b>Phone:</b></td>
						<td><input type="tel" id="contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" class="mo_table_textbox" name="mo_oauth_contact_us_phone" value="<?php echo get_option('mo_oauth_admin_phone');?>"></td>
					</tr>
					<tr>
						<td><b><font color="#FF0000">*</font>Query:</b></td>
						<td><textarea class="mo_table_textbox" onkeypress="mo_oauth_valid_query(this)" onkeyup="mo_oauth_valid_query(this)" onblur="mo_oauth_valid_query(this)" required name="mo_oauth_contact_us_query" rows="4" style="resize: vertical;"></textarea></td>
					</tr>
				</table>
				<div style="text-align:center;">
					<input type="submit" name="submit" style="margin:15px; width:100px;" class="button button-primary button-large" />
				</div>
			</form>
		</div>
	</div>
	<script>
		jQuery("#contact_us_phone").intlTelInput();
		function mo_oauth_valid_query(f) {
			!(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
					/[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
		}
	</script>
<?php
}

function mo_oauth_show_otp_verification(){
	?>
		<!-- Enter otp -->
		<form name="f" method="post" id="otp_form" action="">
			<input type="hidden" name="option" value="mo_oauth_validate_otp" />
				<div class="mo_table_layout">
					<div id="panel5">
						<table class="mo_settings_table">
							<h3>Verify Your Email</h3>
							<tr>
								<td><b><font color="#FF0000">*</font>Enter OTP:</b></td>
								<td><input class="mo_table_textbox" autofocus="true" type="text" name="mo_oauth_otp_token" required placeholder="Enter OTP" style="width:61%;" pattern="[0-9]{6,8}"/>
								 &nbsp;&nbsp;<a style="cursor:pointer;" onclick="document.getElementById('mo_oauth_resend_otp_form').submit();">Resend OTP</a></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><br /><input type="submit" name="submit" value="Validate OTP" class="button button-primary button-large" />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="button" name="back-button" id="mo_oauth_back_button" onclick="document.getElementById('mo_oauth_change_email_form').submit();" value="Back" class="button button-primary button-large" />
								</td>
							</tr>
						</table>
					</div>
				</div>
		</form>
		<form name="f" id="mo_oauth_resend_otp_form" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_resend_otp"/>
		</form>	
		<form id="mo_oauth_change_email_form" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_change_email" />
		</form>
<?php
}
?>