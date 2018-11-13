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

		<h4>Option 2: Use a Shortcode <small class="premium_feature">[STANDARD]</small></h4>
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
		<h4>Select Grant Type</h4>
		<input disabled checked type="checkbox"> Authorization Code Grant&nbsp;&nbsp;
		<input disabled type="checkbox"> Password Grant&nbsp;&nbsp;
		<input disabled type="checkbox"> Client Credentials Grant&nbsp;&nbsp;
		<input disabled type="checkbox"> Implicit Grant&nbsp;&nbsp;
		<input disabled type="checkbox"> Refresh Token Grant
		<br><br><hr><br>
		<input disabled="true" type="checkbox"><strong> Restrict site to logged in users</strong> ( Users will be auto redirected to OAuth login if not logged in )
		<p><input disabled="true" type="checkbox"><strong> Open login window in Popup</strong></p>
		
		<p><input disabled="true" type="checkbox"> <strong> Auto register Users </strong>(If unchecked, only existing users will be able to log-in)</p>

		<table class="mo_oauth_client_mapping_table" style="width:90%">
			<tbody>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;">Restricted Domains </font><br>(Comma separated domains ex. domain1.com,domain2.com etc)
				</td>
				<td><input disabled="true" type="text"placeholder="domain1.com,domain2.com" style="width:100%;" ></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;">Custom redirect URL after login </font><br>(Keep blank in case you want users to redirect to page from where SSO originated)
				</td>
				<td><input disabled="true" type="text" placeholder="" style="width:100%;"></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;">Custom redirect URL after logout </font>
				</td>
				<td><input disabled="true" type="text" style="width:100%;"></td>
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
