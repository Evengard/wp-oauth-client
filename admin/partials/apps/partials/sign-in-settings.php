<?php

 function sign_in_settings_ui(){
	?>
	<div class="mo_table_layout">
		<h2>Sign in options</h2>

		<h4>Option 1: Use a Widget</h4>
		<ol>
			<li>Go to Appearances > Widgets.</li>
			<li>Select <b>"miniOrange OAuth"</b>. Drag and drop to your favourite location and save.</li>
		</ol>

		<h4>Option 2: Use a Shortcode<small class="premium_feature"> [STANDARD]</small></h4>
		<ul>
			<li>Place shortcode <b>[mo_oauth_login]</b> in wordpress pages or posts.</li>
		</ul>
	</div>
	
	<div class="mo_oauth_premium_option_text"><span style="color:red;">*</span>This is a premium feature. 
		<a href="admin.php?page=mo_oauth_settings&tab=licensing">Click Here</a> to see our full list of Premium Features.</div>
	<div class="mo_table_layout mo_oauth_premium_option">
		<h3>Advanced Settings</h3>
		<br><br>
		<form id="role_mapping_form" name="f" method="post" action="">
		<input disabled="true" type="checkbox" name="restrict_to_logged_in_users" value="1"><strong> Restrict site to logged in users</strong> ( Users will be auto redirected to OAuth login if not logged in )
		<p><input disabled="true" type="checkbox" name="popup_login" value="1"><strong> Open login window in Popup</strong></p>
		<table class="mo_oauth_client_mapping_table" id="mo_oauth_client_role_mapping_table" style="width:90%">
			<tbody><tr>
				<td><font style="font-size:13px;font-weight:bold;">Custom redirect URL after login </font>
				</td>
				<td><input disabled="true" type="text" name="custom_after_login_url" placeholder="" style="width:100%;" value=""></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;">Custom redirect URL after logout </font>
				</td>
				<td><input disabled="true" type="text" name="custom_after_logout_url" placeholder="" style="width:100%;" value=""></td>
			</tr>
			<tr><td>&nbsp;</td></tr>				
			<tr>
				<td><input disabled="true" type="submit" class="button button-primary button-large" value="Save Settings"></td>
				<td>&nbsp;</td>
			</tr>
		</tbody></table>
	</form>
	</div>
		
	<?php
}
