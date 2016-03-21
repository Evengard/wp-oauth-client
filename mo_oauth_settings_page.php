<?php
function mo_register() {
	if( isset( $_GET[ 'tab' ]) && $_GET[ 'tab' ] !== 'register' ) {
		$active_tab = $_GET[ 'tab' ];
	} else if(mo_oauth_is_customer_registered()) {
		$active_tab = 'configure_oauth';
	} else {
		$active_tab = 'register';
	}
		if(mo_oauth_is_curl_installed()==0){ ?>
			<p style="color:red;">(Warning: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP CURL extension</a> is not installed or disabled. Please install/enable it before you proceed.)</p>
		<?php
		}
	?>

<div id="tab">
	<h2 class="nav-tab-wrapper">
			<?php if(!mo_oauth_is_customer_registered()) { ?>
			<a class="nav-tab <?php echo $active_tab == 'register' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Account Setup</a>
		<?php } ?>
		<a class="nav-tab <?php echo $active_tab == 'configure_oauth' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'configure_oauth'), $_SERVER['REQUEST_URI'] ); ?>">Configure OAuth</a>
		<a class="nav-tab <?php echo $active_tab == 'advanced_eve_online_settings' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'advanced_eve_online_settings'), $_SERVER['REQUEST_URI'] ); ?>">Advanced EVE Online Settings</a>
		<a class="nav-tab <?php echo $active_tab == 'pricing' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'pricing'), $_SERVER['REQUEST_URI'] ); ?>">Licensing Plans</a>
		<a class="nav-tab <?php echo $active_tab == 'shortcode' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'shortcode'), $_SERVER['REQUEST_URI'] ); ?>">Shortcode</a>
		
	</h2>
</div>
<div id="mo_oauth_settings">
		
	<div class="miniorange_container">
		<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;">
		<?php
	 if ( $active_tab == 'register') {
	if (get_option ( 'verify_customer' ) == 'true') {
		mo_oauth_show_verify_password_page();
	} else if (trim ( get_option ( 'mo_oauth_admin_email' ) ) != '' && trim ( get_option ( 'mo_oauth_admin_api_key' ) ) == '' && get_option ( 'new_registration' ) != 'true') {
		mo_oauth_show_verify_password_page();
	} else if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS_EMAIL' || get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS_PHONE' || get_option('mo_oauth_registration_status') == 'MO_OTP_VALIDATION_FAILURE_EMAIL' || get_option('mo_oauth_registration_status') == 'MO_OTP_VALIDATION_FAILURE_PHONE' || get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_FAILURE' ){
		mo_oauth_show_otp_verification();
	} else if (! mo_oauth_is_customer_registered()) {
		delete_option ( 'password_mismatch' );
		mo_oauth_show_new_registration_page();
	}
		}else if($active_tab == 'configure_oauth') {
		mo_oauth_apps_config();
	}
	else if($active_tab == 'advanced_eve_online_settings') {
		mo_eve_online_config();
	}
	else if($active_tab == 'pricing') {
		mo_oauth_pricing();
	}	else if($active_tab == 'shortcode') {
		mo_oauth_shortcode();
	}
	?>
			</td>
					<td style="vertical-align:top;padding-left:1%;">
						<?php if(!($active_tab == 'pricing')) echo miniorange_support(); ?>	
					</td>
				</tr>
			</table>
		</div>
		<?php
}
function mo_oauth_show_new_registration_page() {
	update_option ( 'new_registration', 'true' );
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

						<!--<tr>
							<td><b><font color="#FF0000"></font>Phone number:</b></td>
							<td><input class="mo_table_textbox" type="tel" id="phone"
								pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" name="phone" 
								title="Phone with country code eg. +1xxxxxxxxxx"
								placeholder="Phone with country code eg. +1xxxxxxxxxx" autofocus="true"
								value="<?//php echo get_option('mo_oauth_admin_phone');?>" />
							</td>
						</tr>-->
						<tr>
							<td><b>&nbsp;&nbsp;Phone number :</b></td>
							 <td><input class="mo_table_textbox" type="text" name="phone" pattern="[\+]?([0-9]{1,4})?\s?([0-9]{7,12})?" id="phone" title="Phone with country code eg. +1xxxxxxxxxx" placeholder="Phone with country code eg. +1xxxxxxxxxx" value="<?php echo get_option('mo_oauth_admin_phone');?>" />
							 This is an optional field. We will contact you only if you need support.</td>
							</tr>
						<tr>
							<td></td>
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
							<td><br /><input type="submit" name="submit" value="Register" style="width:100px;"
								class="button button-primary button-large" /></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		
		<?php
}
function mo_oauth_show_verify_password_page() {

	?>
			<!--Verify password with miniOrange-->
		<form name="f" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_verify_customer" />
			<div class="mo_table_layout">
			<?php if(!mo_oauth_is_customer_registered()) { ?>
										<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										Please <a href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to enable miniOrange Eveonline Plugin.
										</div>
									<?php } ?>
				<div id="toggle1" class="panel_toggle">
					<h3>Login with miniOrange</h3>
				</div>
				<div id="panel1">
					<p><b>It seems you already have an account with miniOrange. Please enter your miniOrange email and password.<br/> <a href="#mo_oauth_forgot_password_link">Click here if you forgot your password?</a></b></p>
					<br>
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
								class="button button-primary button-large" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="button" name="mo_oauth_goback" id="mo_oauth_goback" value="Back" class="button button-primary button-large" />
								<!--target="_blank"
								<a href="<?php echo get_option('host_name') . "/moas/idp/userforgotpassword"; ?>">Forgot
									your password?</a>-->
									</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<form name="f" method="post" action="" id="mo_oauth_goback_form">
				<input type="hidden" name="option" value="mo_oauth_go_back"/>
		</form>
		<form name="f" method="post" action="" id="mo_oauth_forgotpassword_form">
				<input type="hidden" name="option" value="mo_oauth_forgot_password_form_option"/>
		</form>
		<script>
			jQuery('#mo_oauth_goback').click(function(){
				jQuery('#mo_oauth_goback_form').submit();
			});
			jQuery('a[href=#mo_oauth_forgot_password_link]').click(function(){
				jQuery('#mo_oauth_forgotpassword_form').submit();
			});
		</script>
		<?php
}
function mo_oauth_apps_config() {
	?>
			<!-- Google configurations -->
		<h2 class="mo_heading_margin">
		miniOrange OAuth Settings 
	</h2>	
		<form id="form-google" name="form-google" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_google" /> <input
				type="hidden" name="mo_oauth_google_scope" value="email" />
			<div class="mo_table_layout">
			<?php if(!mo_oauth_is_customer_registered()) { ?>
										<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										Please <a href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to enable miniOrange Eveonline Plugin.
										</div>
									<?php } ?>
									
			<?php if(mo_oauth_is_customer_registered()) { ?>						
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
									<li>At Google, provide <b>https://auth.miniorange.com/moas/oauth/client/callback</b>
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
<?php } else { ?>
<div id="toggle2" class="panel_toggle">
					<h3>Login with Google</h3>
				</div>



	<?php } ?>
				</div>
		</form>
		<!-- Eveonline configurations -->
		<form id="form-eveonline" name="form-eveonline" method="post"
			action="">
			<input type="hidden" name="option" value="mo_oauth_eveonline" /> <input
				type="hidden" name="mo_oauth_eveonline_scope" value="" />
			<!--value of scope?-->
			<div class="mo_table_layout">
			<?php if(mo_oauth_is_customer_registered()) { ?>	
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
							<td><a href="<?php echo add_query_arg( array('tab' => 'advanced_eve_online_settings'), $_SERVER['REQUEST_URI'] ); ?>">Advanced
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
									<li>At EVE Online, set Redirect URL as <b>https://auth.miniorange.com/moas/oauth/client/callback</b></li>
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
				<?php } else { ?>

<div id="toggle3" class="panel_toggle">
					<h3>Login with EVE Online</h3>
				</div>			



	<?php } ?>
			</div>
		</form>
		
		<!-- Facebook -->
		<form id="form-facebook" name="form-facebook" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_facebook" /> 
			<input type="hidden" name="mo_oauth_facebook_scope" value="email" />
			<div class="mo_table_layout">
			<?php if(mo_oauth_is_customer_registered()) { ?>	
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
									<li>Under <b>Client OAuth Settings</b>, enter <b>https://auth.miniorange.com/moas/oauth/client/callback</b> in Valid OAuth redirect URIs and click <b>Save Changes</b>.</li>
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
				<?php } else { ?>
	
<div id="toggle4" class="panel_toggle">
					<h3>Login with Facebook</h3>
				</div>


	<?php } ?>
			</div>
		</form>

</div>

<?php
}
function mo_eve_online_config() {
	
	?>

<?php if(!mo_oauth_is_customer_registered()) { ?>
										<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										Please <a href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to enable miniOrange Eveonline Plugin.
										</div>
									<?php } ?>
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
					<?php if(!get_option('mo_oauth_customer_status_new') || (mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid())) { ?>
					
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
				<?php } else { ?>
				<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										This feature will be activated in <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version of the plugin.
										</div>
				<tr>
					<td class="col1"><strong>Key ID:</strong></td>
					<td><input class="mo_table_textbox" required class="textbox"
						type="text" disabled placeholder="Click on Help to know more"
						name="mo_eve_api_key"
						value="<?php echo get_option('mo_eve_api_key');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Verification Code:</strong></td>
					<td><input class="mo_table_textbox" required type="text"
						disabled placeholder="Click on Help to know more"
						name="mo_eve_verification_code"
						value="<?php echo get_option('mo_eve_verification_code');?>" /></td>
				</tr>
				
					<?php } ?>
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
			<h4>Please choose the Corporations, Alliances, Character Name or Factions to be
				allowed. If none are mentioned, by default all corporations and
				alliances will be allowed.</h4>
			<table class="mo_settings_table">
				<?php if(!get_option('mo_oauth_customer_status_new') || (mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid())) { ?>
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
					<td class="col1"><strong>Allowed Factions:</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Faction name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_allowed_faction"
						value="<?php echo get_option('mo_eve_allowed_faction');?>" /></td>
				</tr>
				
				<tr>
					<td class="col1">&nbsp;</td>
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
								
					<?php } else { ?>
					<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										These features are available in <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version of the plugin.
										</div>
					<tr>
					<td class="col1"><strong>Allowed Corporations:</strong></td>
					<td><input class="mo_eve_table_textbox"
					disabled placeholder="Enter Corporation name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_allowed_corps"
						value="<?php echo get_option('mo_eve_allowed_corps');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Allowed Alliances:</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Alliance name separared by comma( , )"
						type="text" name="mo_eve_allowed_alliances"
						value="<?php echo get_option('mo_eve_allowed_alliances');?>" /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Allowed Characters (Character Name):</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Character Name separared by comma( , )"
						type="text" name="mo_eve_allowed_char_name"
						value="<?php echo get_option('mo_eve_allowed_char_name');?>" /></td>
				</tr>
				<tr>
					<td class="col1"><strong>Allowed Factions:</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Faction name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_allowed_faction"
						value="<?php echo get_option('mo_eve_allowed_faction');?>" /></td>
				</tr>
					<tr>
			  		<td colspan="2"><br /><span style="color:red;">*</span>These features are configurable in the <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version of the plugin.</td>
			 	  </tr>
				<tr>
					<td class="col1">&nbsp;</td>
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
								
					<?php } ?>
					
					<tr>
					<td colspan="2">
					<div style="margin-left: 235px;"><input type="submit" name="submit" value="Save" class="button button-primary button-large"/></div>
					<br><hr><br>
					
					</td>
				
				</tr>
			</form>	
			<form id="mo_eve_save_denied" name="mo_eve_save_denied" method="post" action="">
				<input type="hidden" name="option" value="mo_eve_save_denied" />
		
					<tr><td colspan="2"><strong>  Please choose the Corporations, Alliances, Character Name or Factions to be
				denied. If none are mentioned, by default all corporations and
				alliances will be allowed.<br></strong></td></tr><tr><td><br></td></tr>
				<?php if(mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid()) { ?>
				<tr>	
					<td class="col1"><strong>Denied Corporations:</strong></td>
					<td><input class="mo_eve_table_textbox"
						 placeholder="Enter Corporation name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_denied_corps"
						value="<?php echo get_option('mo_eve_denied_corps');?>" <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/></td>
				</tr>
                
				<tr>
					<td class="col1"><strong>Denied Alliances:</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Alliance name separared by comma( , )"
						type="text" name="mo_eve_denied_alliances"
						value="<?php echo get_option('mo_eve_denied_alliances');?>" <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/></td>
				</tr>

				<tr>
					<td class="col1"><strong>Denied Characters (Character Name):</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Character Name separared by comma( , )"
						type="text" name="mo_eve_denied_char_name"
						value="<?php echo get_option('mo_eve_denied_char_name');?>" <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/></td>
				</tr>
				<tr>
					<td class="col1"><strong>Denied Factions:</strong></td>
					<td><input class="mo_eve_table_textbox"
						placeholder="Enter Faction name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_denied_faction"
						value="<?php echo get_option('mo_eve_denied_faction');?>" <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/></td>
				</tr>
				
				<tr>
					<td colspan="2"><br><hr><br></td>
				</tr>
<?php } else { ?>
					<tr><td colspan="2"><div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">These Features are not available for this version.Please Upgrade to <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version.</div></strong></td></tr><tr><td><br></td></tr>
				
				<tr>	
					<td class="col1"><strong>Denied Corporations:</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Corporation name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_denied_corps"
						 /></td>
				</tr>
                
				<tr>
					<td class="col1"><strong>Denied Alliances:</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Alliance name separared by comma( , )"
						type="text" name="mo_eve_denied_alliances"
						 /></td>
				</tr>

				<tr>
					<td class="col1"><strong>Denied Characters (Character Name):</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Character Name separared by comma( , )"
						type="text" name="mo_eve_denied_char_name"
						 /></td>
				</tr>
				<tr>
					<td class="col1"><strong>Denied Factions:</strong></td>
					<td><input class="mo_eve_table_textbox"
						disabled placeholder="Enter Faction name separared by comma( , )"
						class="textbox" type="text" name="mo_eve_denied_faction"
						/></td>
				</tr>
				<tr>
			  		<td colspan="2"><br /><span style="color:red;">*</span>These features are configurable in the <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version of the plugin.</td>
			 	  </tr>
				<tr>
					<td colspan="2"><br><hr><br></td>
				</tr>
<?php } ?>				
				
				<tr>
					<td colspan="2">
					<strong> Redirection URL after login: </strong>
					</td>
				</tr>
<?php if(mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid()) { ?>
				<tr>
					<td>
						<br><input type="radio" id="login_redirect_same_page" name="mo_eve_login_redirect" value="same" <?php checked( get_option('mo_eve_login_redirect') == 'same' );?> <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/>Same page 
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="radio" id="login_redirect_customurl" name="mo_eve_login_redirect" value="custom"  <?php checked( get_option('mo_eve_login_redirect') == 'custom' );?> <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/>Custom URL
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="url" id="login_redirect_url" style="width:30%" name="mo_eve_login_redirect_url" value="<?php echo get_option('mo_eve_login_redirect_url')?>"/>
					</td>
				</tr>
<?php } else { ?>
<tr><td colspan="2"><strong> These Features are not available for this version.Please Upgrade to Premium version. <br></strong></td></tr>
<tr>
					<td>
						<br><input disabled type="radio" id="login_redirect_same_page" name="mo_eve_login_redirect" value="same" <?php checked( get_option('mo_eve_login_redirect') == 'same' );?>/>Same page 
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input disabled type="radio" id="login_redirect_customurl" name="mo_eve_login_redirect" value="custom"  <?php checked( get_option('mo_eve_login_redirect') == 'custom' );?>/>Custom URL
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input disabled type="url" id="login_redirect_url" style="width:30%" name="mo_eve_login_redirect_url" value="<?php echo get_option('mo_eve_login_redirect_url')?>"/>
					</td>
				</tr>
<?php } ?>
<?php if(mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid()) { ?>        
				<tr>
					<td colspan="2"><br><hr><br>
							<input type="checkbox" id="email_login_enable" name="mo_eve_email_login_enable" value="1"
							<?php checked( get_option('mo_eve_email_login_enable') == 1 );?> <?php if(!mo_oauth_is_customer_registered()) echo 'disabled'?>/> &nbsp;Ask email after login?<br>
					</td>
				</tr>
<?php } else { ?>
				<tr>
					<td colspan="2"><br><hr>
							<input disabled type="checkbox" id="email_login_enable" name="mo_eve_email_login_enable" value="1"
							<?php checked( get_option('mo_eve_email_login_enable') == 1 );?> /> &nbsp;Ask email after login?<br>
					</td>
				</tr>
				<tr>
			  		<td colspan="2"><br /><span style="color:red;">*</span>These features are configurable in the <a href="<?php echo admin_url('admin.php?page=mo_oauth_settings&tab=pricing');?>"><b>premium</b></a> version of the plugin.</td>
			 	  </tr>
<?php } ?>
				<tr>
					<td class="col1"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Save"
						class="button button-primary button-large" /></td>
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
<h4>NOTE: Please first Register with miniOrange and then enable EVE
	Online app to see Advanced EVE Online Settings dashboard.</h4>
<?php
		}
}
function mo_oauth_pricing() { 
?>


	<td style="vertical-align:top;width:100%;float:left;" id="mo_oauth_pricing">
		<div class="mo_oauth_table_layout" id="mo_oauth_pricing">
		<?php if(!mo_oauth_is_customer_registered()) { ?>
										<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										Please <a href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to enable miniOrange Eveonline Plugin.
										</div>
									<?php } ?>
			<table class="mo_oauth_pricing_table">
		<h2>Licensing Plans For Eveonline  
		<span style="float:right">
			<input type="button" name="check_plan" id="check_plan" class="button button-primary button-large" value="Check License" onclick="checkLicense();"/>
			<input type="button" name="ok_btn" id="ok_btn" class="button button-primary button-large" value="OK, Got It" onclick="window.location.href='admin.php?page=mo_oauth_settings&tab=configure_oauth'" />
		</span>
		</h2>
		<!--b>Social Sharing is absolutely free for any number of users.<b/--><hr>
		<tr>
			<?php if(!(mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid())) {?>
			<td><div class="mo_oauth_thumbnail mo_oauth_pricing_free_tab" >
				<h3 class="mo_oauth_pricing_header">Free Trial</h3>
				<h4 class="mo_oauth_pricing_sub_header">(You are automatically on this plan)<br><br></h4>
				<hr>
				<p class="mo_oauth_pricing_text">$0 <br><br>
				</p><hr>
			
				<p class="mo_oauth_pricing_text" style="padding-bottom:66px;">
					Login using eveonline.<br/>
<!--					Disable app which are not required.<br/>-->
					Automatic registration of users.<br/>
					
				
					<br><br><br><br><br><br>
				<hr/>
				<p class="mo_oauth_pricing_text">Basic Support by Email<br/></p>
			</div></td>
			<?php } ?>
			<td><div class="mo_oauth_thumbnail mo_oauth_pricing_free_tab" >
				<h3 class="mo_oauth_pricing_header">Do it yourself</h3>
				<h4 class="mo_oauth_pricing_sub_header" style="padding-bottom:8px !important;"><a class="button button-primary button-large"
				 onclick="upgradeform('wp_oauth_basic_plan')" >Click here to upgrade</a> *</h4>
				<br><hr>
				<p class="mo_oauth_pricing_text">$149 One time payment<br><br>
				</p>
				
				<hr>
				
				<p class="mo_oauth_pricing_text">
				    Login using eveonline.<br/>
<!--					Disable app which are not required.<br/>-->
					Automatic registration of users.<br/>
				
					Allowed fields character,corp,alliance,faction. <br/>
					Administrator can Restrict login<br/>
					Asks for a email after first login.<br/>
				<!--	Most players have more than one character so it multi accounts with same email.<br/>-->
					Option for denied access character,corp,alliance,faction.<br/>
					Shortcode.<br/>
					Redirection url after login.<br/><br/>
				</p>
				
				<hr/>
			
				<p class="mo_oauth_pricing_text">Basic Support by Email<br/></p>
			</div></td>
			 
			
			<td><div class="mo_oauth_thumbnail mo_oauth_pricing_free_tab" >
				<h3 class="mo_oauth_pricing_header">Premium</h3>
				<h4 class="mo_oauth_pricing_sub_header" style="padding-bottom:8px !important;"><a class="button button-primary button-large"
				 onclick="upgradeform('wp_oauth_premium_plan')" >Click here to upgrade</a> *</h4>
				<br><hr>
				<p class="mo_oauth_pricing_text">$149 + One Time Setup Fees <br>
				( $45 per hour )</p>
				
				<hr>
				
				<p class="mo_oauth_pricing_text">
				Login using eveonline.<br/>
<!--					Disable app which are not required.<br/>-->
					Automatic registration of users.<br/>
				
					Allowed fields character,corp,alliance,faction. <br/>
					Administrator can Restrict login<br/>
					Asks for a email after first login.<br/>
				<!--	Most players have more than one character so it multi accounts with same email.<br/>-->
					Option for denied access character,corp,alliance,faction.<br/>
					Shortcode.<br/>
					Redirection url after login.<br/>
					End to End Integration for plugin.<br/>
				</p>
				
				<hr/>
			
				<p class="mo_oauth_pricing_text">Premium Support<br/></p>
			</div></td>
		</td>
		</tr>
		
		
		</table>
		
		<form style="display:none;" id="loginform" action="<?php echo get_option( 'host_name').'/moas/login'; ?>" 
		target="_blank" method="post">
		<input type="email" name="username" value="<?php echo get_option('mo_oauth_admin_email'); ?>" />
		<input type="text" name="redirectUrl" value="<?php echo get_option( 'host_name').'/moas/initializepayment'; ?>" />
		<input type="text" name="requestOrigin" id="requestOrigin"  />
		</form>
		<form method="post" id="checkLicenseForm">
			<input type="hidden" name="option" value="mo_oauth_check_license">
		</form>
		<script>
			function upgradeform(planType){
				jQuery('#requestOrigin').val(planType);
				jQuery('#loginform').submit();
			}
			function checkLicense(){
				jQuery("#checkLicenseForm").submit();
			}
		</script>
		
		<p>* For more details contact us at info@miniorange.com.</p>
		
		<h3>Steps to upgrade to premium plugin -</h3>
		<p>1. You will be redirected to miniOrange Login Console. Enter your password with which you created an account with us. After that you will be redirected to payment page.</p>
		<p>2. Enter you card details and complete the payment. On successful payment completion, you will see your payment listed in the Payment History.</p>
		
		<br>
		
		</div>
	</td>
<?php 
}
	
	function mo_oauth_shortcode(){
		?>
	<div class="mo_eve_table_layout">
	<?php if(!mo_oauth_is_customer_registered()) { ?>
										<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
										Please <a href="<?php echo add_query_arg( array('tab' => 'register'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to enable miniOrange Eveonline Plugin.
										</div>
									<?php } ?>
	<?php if(mo_oauth_is_customer_registered() && mo_oauth_is_customer_valid()) { ?>
	<!--<input type="hidden" name="option" value="mo_eve_disable" />-->

	<h3>Shortcode for MiniOrange Oauth Login</h3>
		<div id="oauth_shortcode" style="font-size:13px !important">
		Use MiniOrange Oauth Login Shortcode in the content of required page/post where you want to display MiniOrange OAuth Login Icons.<br><br>
	<b>Example: </b>
	
	<code name="mo_eve_shortcode_enable"/>[mo_oauth_login]</code></div><br><br>
	<?php } else { ?>
	<!--<input type="hidden" name="option" value="mo_eve_disable" />-->

	<h3>Shortcode for MiniOrange Oauth Login</h3>
		<div class="hidden" id="oauth_shortcode" style="font-size:13px !important">
		Use MiniOrange Oauth Login Shortcode in the content of required page/post where you want to display MiniOrange OAuth Login Icons.<br><br>
	<b>Example: </b>
	
	<code name="mo_eve_shortcode_enable"/>[mo_oauth_login]</code></div><br><br>
	<?php } ?>
	</div>	
		
	<?php } 
	
	function miniorange_support(){
			global $current_user;
		get_currentuserinfo();
?>
		<!--<div class="mo_support_layout">
		
		<div>
			<h3>Support</h3>
			<form method="post" action="">
				<input type="hidden" name="option" value="mo_oauth_contact_us_query_option" />
				<table class="mo_settings_table">
					<tr>
						<td><b><font color="#FF0000"></font></b></td>
						<td><input style="width:105%" type="email" class="mo_table_textbox" required name="mo_oauth_contact_us_email" required placeholder="Enter your Email"value="<?php echo get_option("mo_oauth_admin_email"); ?>"></td>
					</tr>
					<tr>
						<td><b></b></td>
						<td><input style="width:105%" type="tel" id="contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" class="mo_table_textbox" name="mo_oauth_contact_us_phone" value="<?php echo get_option('mo_oauth_admin_phone');?>"></td>
					</tr>
					<tr>
						<td><b><font color="#FF0000"></font></b></td>
						<td><textarea class="mo_table_textbox" style="width:105%" onkeypress="mo_oauth_valid_query(this)" onkeyup="mo_oauth_valid_query(this)" onblur="mo_oauth_valid_query(this)" required name="mo_oauth_contact_us_query" rows="4" style="resize: vertical;"required placeholder="Enter your Query"></textarea></td>
					</tr>
				</table>
				<div style="text-align:center;">
					<input type="submit" name="submit" style="margin:15px; width:100px;" class="button button-primary button-large" />
				</div>
			</form>
		</div>
	</div>-->
	<div class="mo_support_layout">

			<h3>Support</h3>
			<p>Need any help? Just send us a query so we can help you.</p>
			<form method="post" action="">
				<input type="hidden" name="option" value="mo_oauth_contact_us_query_option" />
				<table class="mo_settings_table">
					<tr>
						<td><input type="email" style="width:95%" class="mo_table_textbox" required placeholder="Enter your Email" name="mo_oauth_contact_us_email" value="<?php echo get_option("mo_oauth_admin_email"); ?>"></td>
					</tr>
					<tr>
						<td><input type="tel" id="contact_us_phone" style="width:95%" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" placeholder="Enter your phone number with country code (+1)" class="mo_table_textbox" name="mo_oauth_contact_us_phone" value="<?php echo get_option('mo_oauth_admin_phone');?>"></td>
					</tr>
					<tr>
						<td><textarea class="mo_table_textbox" style="width:95%" onkeypress="mo_oauth_valid_query(this)" onkeyup="mo_oauth_valid_query(this)" placeholder="Write your query here" onblur="mo_oauth_valid_query(this)" required name="mo_oauth_contact_us_query" rows="4" style="resize: vertical;"></textarea></td>
					</tr>
				</table>
				<br>
			<input type="submit" name="submit" value="Submit Query" style="width:110px;" class="button button-primary button-large" />

			</form>
			<p>If you want custom features in the plugin, just drop an email at <a href="mailto:info@miniorange.com">info@miniorange.com</a>.</p>
		</div>
	</div>
	</div>
	</div>
	<script>
	    jQuery("#phone").intlTelInput();
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
		<!--<form name="f" method="post" id="otp_form" action="">
			<input type="hidden" name="option" value="mo_oauth_validate_otp" />
				<div class="mo_table_layout">
					<div id="panel5">
						<table class="mo_settings_table">
							<h3>Verify Your Email</h3>
							<tr>
								<td><b><font color="#FF0000">*</font>Enter OTP:</b></td>
								<td><input class="mo_table_textbox" autofocus="true" type="text" name="mo_oauth_otp_token" required placeholder="Enter OTP" style="width:61%;" pattern="{6,8}"/>
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
		</form>-->
			<!-- Enter otp -->
		<form name="f" method="post" id="otp_form" action="">
			<input type="hidden" name="option" value="mo_oauth_validate_otp" />
			<div class="mo_table_layout">
				<table class="mo_settings_table">
					<h3>Verify Your Email</h3>
					<tr>
						<td><b><font color="#FF0000">*</font>Enter OTP:</b></td>
						<td colspan="2"><input class="mo_table_textbox" autofocus="true" type="text" name="otp_token" required placeholder="Enter OTP" style="width:61%;" pattern="{6,8}"/>
						 &nbsp;&nbsp;<a style="cursor:pointer;" onclick="document.getElementById('resend_otp_form').submit();">Resend OTP</a></td>
					</tr>
					<tr><td colspan="3"></td></tr>
					<tr>

						<td>&nbsp;</td>
						<td style="width:17%">
						<input type="submit" name="submit" value="Validate OTP" class="button button-primary button-large" /></td>

		</form>
		<form name="f" method="post">
						<td style="width:18%">
							<input type="hidden" name="option" value="mo_oauth_go_back"/>
							<input type="submit" name="submit"  value="Back" class="button button-primary button-large" />
						</td>
		</form>
		<form name="f" id="resend_otp_form" method="post" action="">
						<td>
			<?php if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS_EMAIL' || get_option('mo_oauth_registration_status') == 'MO_OTP_VALIDATION_FAILURE_EMAIL') { ?>
				<input type="hidden" name="option" value="mo_oauth_resend_otp_email"/>
			<?php } else { ?>
				<input type="hidden" name="option" value="mo_oauth_resend_otp_phone"/>
			<?php } ?>
						</td>

		</form>
		</tr>
			</table>
		<?php if(get_option('mo_oauth_registration_status') == 'MO_OTP_DELIVERED_SUCCESS_EMAIL' || get_option('mo_oauth_registration_status') == 'MO_OTP_VALIDATION_FAILURE_EMAIL') { ?>
			<hr>

				<h3>I did not recieve any email with OTP . What should I do ?</h3>
				<form id="mo_oauth_register_with_phone_form" method="post" action="">
					<input type="hidden" name="option" value="mo_oauth_register_with_phone_option" />
					 If you can't see the email from miniOrange in your mails, please check your <b>SPAM</b> folder. If you don't see an email even in the SPAM folder, verify your identity with our alternate method.
					 <br><br>
						<b>Enter your valid phone number here and verify your identity using one time passcode sent to your phone.</b><br><br>
						<input class="mo_table_textbox" type="tel" id="phone" style="width:40%;"
								pattern="[\+]\d{11,14}|[\+]\d{1,4}([\s]{0,1})(\d{0}|\d{9,10})" class="mo_table_textbox" name="phone" 
								title="Phone with country code eg. +1xxxxxxxxxx"
								placeholder="Phone with country code eg. +1xxxxxxxxxx" autofocus="true"
								value="<?php echo get_option('mo_oauth_admin_phone');?>" />
						<br /><br /><input type="submit" value="Send OTP" class="button button-primary button-large" />
				
				</form>
		<?php } ?>
	</div>
	

<?php
}
function mo_oauth_is_customer_valid(){
	$valid = get_option('mo_oauth_admin_customer_valid');
	if(isset($valid) && get_option('mo_oauth_admin_customer_plan'))
		return $valid;
	else
		return false;
}

?>