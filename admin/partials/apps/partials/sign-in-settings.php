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

		<h4>Option 2: Use a Shortcode <small class=""><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></h4>
		<ul>
			<li>Place shortcode <b>[mo_oauth_login]</b> in wordpress pages or posts.</li>
		</ul>
	</div>
	
	<!--div class="mo_oauth_premium_option_text"><span style="color:red;">*</span>This is a premium feature. 
		<a href="admin.php?page=mo_oauth_settings&tab=licensing">Click Here</a> to see our full list of Premium Features.</div-->
	<div class="mo_table_layout ">
		<h3>Advanced Settings </h3>
		<!--br><br-->
		<ul class="mo_premium_features_notice">
			<li>Custom redirect URL is available in <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Standard</a> version and above.</li>
			<li>Dynamic Callback URL, Single Login Flow and User Analytics are available in the <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Enterprise</a> version.</li>
			<li>Other features are available in the <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Premium</a> version and above.</li>
		</ul>
		<form id="role_mapping_form" name="f" method="post" action="">
		<br>
		<input disabled="true" type="checkbox"><strong> Restrict site to logged in users</strong> ( Users will be auto redirected to OAuth login if not logged in )
		<p><input disabled="true" type="checkbox"><strong> Open login window in Popup</strong></p>
		
		<p><input checked disabled="true" type="checkbox"> <strong> Auto register Users </strong>(If unchecked, only existing users will be able to log-in)</p>
		<p><input disabled type="checkbox"><b> Enable User Analytics </b></p>

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
			<tr>
				<td><font style="font-size:13px;font-weight:bold;">Dynamic Callback URL </font></small>
				</td>
				<td><input disabled type="text"  placeholder="Callback / Redirect URI" style="width:100%;"></td>
			</tr>
			<tr></tr><tr>
				<td><input disabled type="checkbox"><font style="font-size:13px;font-weight:bold;"> Enable Single Login Flow </font></small></td>
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
