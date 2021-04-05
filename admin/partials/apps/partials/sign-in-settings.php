<?php

 function mo_oauth_client_sign_in_settings_ui(){
	?>
	<div id="wid-shortcode" class="mo_table_layout">
		<div style="padding:15px 0px 5px;"><h2 style="display: inline;"><?php _e('Sign in options','miniorange-login-with-eve-online-google-facebook'); ?></h2><span style="float: right;">[ <a href="https://developers.miniorange.com/docs/oauth/wordpress/client/login-options" target="_blank"><?php _e('Click here','miniorange-login-with-eve-online-google-facebook'); ?></a><?php _e(' to know how this is useful','miniorange-login-with-eve-online-google-facebook')?>. ]</span></div>
		<h4><?php _e('Option 1: Use a Widget','miniorange-login-with-eve-online-google-facebook'); ?></h4>
		<ol>
			<li><?php _e('Go to Appearances > Widgets.','miniorange-login-with-eve-online-google-facebook'); ?></li>
			<li>Select <b>"<?php echo MO_OAUTH_ADMIN_MENU; ?>"</b>. <?php _e('Drag and drop to your favourite location and save.','miniorange-login-with-eve-online-google-facebook'); ?></li>
		</ol>

		<h4><?php _e('Option 2: Use a Shortcode','miniorange-login-with-eve-online-google-facebook'); ?> <small class=""><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></h4>
		<ul>
			<li><?php _e('Place shortcode','miniorange-login-with-eve-online-google-facebook'); ?> <b>[mo_oauth_login]</b> <?php _e('in wordpress pages or posts.','miniorange-login-with-eve-online-google-facebook'); ?></li>
		</ul>
	</div>

	<!--div class="mo_oauth_premium_option_text"><span style="color:red;">*</span>This is a premium feature.
		<a href="admin.php?page=mo_oauth_settings&tab=licensing">Click Here</a> to see our full list of Premium Features.</div-->
	<div id="advanced_settings_sso" class="mo_table_layout ">
		<div style="padding:15px 0px 10px;"><h3 style="display: inline;"><?php _e('Advanced Settings','miniorange-login-with-eve-online-google-facebook'); ?> </h3><span style="float: right;">[ <a href="https://developers.miniorange.com/docs/oauth/wordpress/client/forced-authentication" target="_blank"><?php _e('Click here','miniorange-login-with-eve-online-google-facebook'); ?></a> <?php _e('to know how this is useful.','miniorange-login-with-eve-online-google-facebook'); ?> ]</span></div>
		<!--br><br-->
		<ul class="mo_premium_features_notice">
			<li><?php _e('Custom redirect URL, Logging Out Confirmation, Allow Restricted Domains are available in','miniorange-login-with-eve-online-google-facebook'); ?> <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Standard</a> <?php _e('version and above.','miniorange-login-with-eve-online-google-facebook'); ?></li>
			<li><?php _e('Dynamic Callback URL, Single Login Flow, Hide & Disable WP Login and User Analytics are available in the','miniorange-login-with-eve-online-google-facebook'); ?> <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Enterprise</a> version.</li>
			<li><?php _e('Other features are available in the','miniorange-login-with-eve-online-google-facebook'); ?> <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">Premium</a> <?php _e('version and above.','miniorange-login-with-eve-online-google-facebook'); ?></li>
		</ul>
		<form id="role_mapping_form" name="f" method="post" action="">
		<br>
		<input disabled="true" type="checkbox"><strong> <?php _e('Restrict site to logged in users','miniorange-login-with-eve-online-google-facebook'); ?></strong> <?php _e('(Users will be auto redirected to OAuth login if not logged in)','miniorange-login-with-eve-online-google-facebook'); ?> [<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/forced-authentication" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]
		<p><input disabled="true" type="checkbox"><strong> <?php _e('Open login window in Popup','miniorange-login-with-eve-online-google-facebook'); ?></strong></p>

		<p><input checked disabled="true" type="checkbox"> <strong> <?php _e('Auto register Users','miniorange-login-with-eve-online-google-facebook'); ?> </strong><?php _e('(If unchecked, only existing users will be able to log-in)','miniorange-login-with-eve-online-google-facebook'); ?> [<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/auto-create-users" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]</p>
		<p><input disabled="true" type="checkbox"> <strong> <?php _e('Keep Existing Users','miniorange-login-with-eve-online-google-facebook'); ?> </strong><?php _e('(If checked, existing users\' attributes will','miniorange-login-with-eve-online-google-facebook'); ?> <strong><?php _e('NOT','miniorange-login-with-eve-online-google-facebook'); ?></strong> <?php _e('be overwritten when they log-in)','miniorange-login-with-eve-online-google-facebook'); ?> [<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/account-linking" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]</p>
		<p><input disabled="true" type="checkbox"> <strong> <?php _e('Confirm when logging out','miniorange-login-with-eve-online-google-facebook'); ?> </strong><?php _e('(If checked, users will be','miniorange-login-with-eve-online-google-facebook'); ?> <strong><?php _e('ASKED','miniorange-login-with-eve-online-google-facebook'); ?></strong> <?php _e('to confirm if they want to log-out, when they click the widget/shortcode logout button)','miniorange-login-with-eve-online-google-facebook'); ?></p>
		<p><input disabled type="checkbox"><b> <?php _e('Enable User login reports','miniorange-login-with-eve-online-google-facebook'); ?> </b> [<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/user-analytics" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]</p>
		<p><input disabled type="checkbox"><b> <?php _e('Hide & Disable WP Login','miniorange-login-with-eve-online-google-facebook'); ?> </b></p>
		<p><input disabled="true" type="checkbox"> <strong> <?php _e('Allow Restricted Domains','miniorange-login-with-eve-online-google-facebook'); ?> </strong><?php _e('(By default, all domains in','miniorange-login-with-eve-online-google-facebook'); ?> <strong><?php _e('Restricted Domains','miniorange-login-with-eve-online-google-facebook'); ?></strong> <?php _e('field will be restricted. This option will invert this feature by allowing ONLY these domains)','miniorange-login-with-eve-online-google-facebook'); ?> </p>

		<table class="mo_oauth_client_mapping_table" style="width:90%">
			<tbody>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;"><?php _e('Restricted Domains','miniorange-login-with-eve-online-google-facebook'); ?> </font>[<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/domain-restriction" target="_blank">Learn more</a>]<br>(Comma separated domains ex. domain1.com,domain2.com etc)
				</td>
				<td><input disabled="true" type="text"placeholder="domain1.com,domain2.com" style="width:100%;" ></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;"><?php _e('Custom redirect URL after login','miniorange-login-with-eve-online-google-facebook'); ?> </font>[<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/custom-redirection#post-login-redirection" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]<br><?php _e('(Keep blank in case you want users to redirect to page from where SSO originated)','miniorange-login-with-eve-online-google-facebook'); ?>
				</td>
				<td><input disabled="true" type="text" placeholder="" style="width:100%;"></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;"><?php _e('Custom redirect URL after logout','miniorange-login-with-eve-online-google-facebook'); ?> </font>[<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/custom-redirection#post-logout-redirection" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]
				</td>
				<td><input disabled="true" type="text" style="width:100%;"></td>
			</tr>
			<tr>
				<td><font style="font-size:13px;font-weight:bold;"><?php _e('Dynamic Callback URL','miniorange-login-with-eve-online-google-facebook'); ?> </font>[<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/dynamic-callback-url" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a>]</small>
				</td>
				<td><input disabled type="text"  placeholder="Callback / Redirect URI" style="width:100%;"></td>
			</tr>
			<tr></tr><tr>
				<td><input disabled type="checkbox"><font style="font-size:13px;font-weight:bold;"> <?php _e('Enable Single Login Flow','miniorange-login-with-eve-online-google-facebook'); ?> </font>[<a href="https://developers.miniorange.com/docs/oauth/wordpress/client/enable-single-sign-in-flow" target="_blank"><?php _e('Learn more','miniorange-login-with-eve-online-google-facebook'); ?></a> ]</small></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td><input disabled="true" type="submit" class="button button-primary button-large" value="<?php _e('Save Settings','miniorange-login-with-eve-online-google-facebook'); ?>"></td>
				<td>&nbsp;</td>
			</tr>
		</tbody></table>
	</form>
	</div>

	<?php
}
