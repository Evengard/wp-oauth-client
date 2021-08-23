<?php

	function mo_oauth_client_update_app_page($appname){

	$appslist = get_option('mo_oauth_apps_list');
	$currentappname = $appname;
	$currentapp = null;
	foreach($appslist as $key => $app){
		if($appname == $key){
			$currentapp = $app;
			break;
		}
	}
	if(!$currentapp)
		return;
	$is_other_app = true;

        $currentAppId = $currentapp['appId'];
        $refapp = mo_oauth_client_get_app($currentAppId);
        $valid_discovery = get_option( 'mo_discovery_validation') ? get_option( 'mo_discovery_validation') : "valid";
        $is_invalid = "<i class=\"fa fa-thumbs-down\" style=\"color:#ff000085; font-size: 30px;\"></i>";
        $is_valid = "<i class=\"fa fa-thumbs-up\" style=\"color:#0080007d; font-size: 30px;\"></i>";
		
	?>
		<div id="toggle2" class="mo_panel_toggle">
			<h3><?php _e('Configure OAuth Provider','miniorange-login-with-eve-online-google-facebook'); ?>
			   <span style="float:right">
            <?php
                
                 $refAppId = array("other","openidconnect");
                 $tempappname = !in_array($currentapp['appId'], $refAppId) ? $currentapp['appId'] : "customApp";
                 $app = mo_oauth_client_get_app($tempappname);
					if (isset($app->video))
					{ ?> <a href="<?php echo $app->video; ?>" target="_blank" class="mo-oauth-setup-video-button" style="text-decoration: none;" >Video Guide</a> <?php
					}
					if (isset($app->guide))
					{ ?> <a href="<?php echo $app->guide; ?>" target="_blank" class="mo-oauth-setup-guide-button" style="text-decoration: none;" > Setup Guide </a> <?php
					}
			?>
                </span>
		     </h3>
		</div>
		<div id="mo_oauth_update_app">
			
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=config&action=update&app=<?php echo $currentappname; ?>">
		<?php wp_nonce_field('mo_oauth_add_app_form','mo_oauth_add_app_form_field'); ?>
		<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_app_name" value="<?php echo isset($currentapp['appId']) ? $currentapp['appId'] : "other";?>">
		<input type="hidden" name="option" value="mo_oauth_add_app" />
		<input type="hidden" id="mo_oauth_app_nameid" value="<?php echo $currentappname;?>">
		<input type="hidden" name="mo_oauth_app_type" value="<?php echo $currentapp['apptype'];?>">
		<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">

		<table class="mo_settings_table">
			<tr id="mo_oauth_display_app_name_div">
				<td><strong><?php _e('Display App Name:','miniorange-login-with-eve-online-google-facebook'); ?></strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></font></td>
				<td><input disabled class="mo_table_textbox" type="text" value="Login with <?php echo $currentappname;?>" ></td>
			</tr>
			<tr><td><strong><?php _e('Redirect / Callback URL:','miniorange-login-with-eve-online-google-facebook'); ?> </strong><br>&emsp;<font><small><?php _e('Editable in','miniorange-login-with-eve-online-google-facebook'); ?> <a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></font></td>
			<td><input class="mo_table_textbox" id="callbackurl" readonly="true" type="text" name="mo_oauth_callback_url" value='<?php echo $currentapp['redirecturi'];?>'>
			&nbsp;&nbsp;
			<div class="tooltip" style="display: inline;"><span class="tooltiptext" id="moTooltip">Copy to clipboard</span><i class="fa fa-clipboard fa-border" style="font-size:20px; align-items: center;vertical-align: middle;" aria-hidden="true" onclick="copyUrl()" onmouseout="outFunc()"></i></div>
			</td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font><?php _e('Client ID:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value="<?php echo esc_attr($currentapp['clientid']);?>"></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font><?php _e('Client Secret:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
				<td>
					<input id="mo_oauth_client_secret" class="mo_table_textbox" required="" type="password"  name="mo_oauth_client_secret" value="<?php echo esc_attr($currentapp['clientsecret']);?>">
					
					<i class="fa fa-eye" onclick="showClientSecret()" id="show_button" style="margin-left:-30px; cursor:pointer;"></i>
				</td>
			</tr>
			<tr>
				<?php if($refapp->type != 'oauth1'){ ?>
				<td><strong><?php _e('Scope:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
				<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="<?php echo esc_attr($currentapp['scope']);?>"></td>
			<?php }?>
			</tr>
            <?php if(isset($refapp->discovery) && $refapp->discovery !="" && get_option('mo_existing_app_flow') == true ) { ?>
                <tr>
                    <td><input type="hidden" id="mo_oauth_discovery" name="mo_oauth_discovery" value="<?php echo $refapp->discovery; ?>"></td>
                </tr>
                <?php
                if(isset($currentapp['domain'])) { ?>
                <tr>
                    <td><strong><font color="#FF0000"></font><?php echo $currentappname; ?> <?php _e('Domain:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
                    <td><input <?php if($valid_discovery == 'invalid') echo 'style="border-color:red;"'?> class="mo_table_textbox" type="text" name="mo_oauth_provider_domain"
                               value="<?php echo $currentapp['domain']; ?>">&nbsp;&nbsp;&nbsp;<?php if($valid_discovery == 'valid'){echo $is_valid; } else echo $is_invalid; ?></td>
                </tr>
            <?php } elseif (isset($currentapp['tenant'])) { ?>
                    <tr>
                        <td><strong><font color="#FF0000"></font><?php echo $currentappname; ?> <?php _e('Tenant:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
                        <td><input <?php if($valid_discovery == 'invalid') echo 'style="border-color:red;"'?> class="mo_table_textbox" type="text" name="mo_oauth_provider_tenant"
                                   value="<?php echo $currentapp['tenant']; ?>">&nbsp;&nbsp;&nbsp;<?php if($valid_discovery == 'valid'){echo $is_valid; } else echo $is_invalid; ?></td>
                    </tr>
                    <?php } if(isset($currentapp['policy'])) { ?>
                <tr>
                    <td><strong><font color="#FF0000"></font><?php echo $currentappname; ?> <?php _e('Policy:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
                    <td><input <?php if($valid_discovery == 'invalid') echo 'style="border-color:red;"'?> class="mo_table_textbox" type="text"  name="mo_oauth_provider_policy" 
								value="<?php echo esc_attr($currentapp['policy']); ?>">&nbsp;&nbsp;&nbsp;<?php if($valid_discovery == 'valid'){echo $is_valid; } else echo $is_invalid; ?></td>
                </tr>
                <tr>
					<td><strong><font color="#FF0000"></font><?php esc_html_e('Reset / Forgot Password Policy:','miniorange-login-with-eve-online-google-facebook')?></strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[ALL-INCLUSIVE]</a></small></font></td>
					<td><input class="mo_table_textbox" type="text" disabled readonly="true" placeholder= "<?php echo "Ex. myapp_reset_password"?>"></td>
			</tr>					
			<tr>
				<td></td>
				<td><font><small><strong style="color: rgb(255,0,0);">[This field is necessary to enable 'Forgot Password / Reset Password' flow from Azure's Login page]</strong></small></font></td>
				</tr>
            <?php } elseif(isset($currentapp['realm'])) { ?>
                    <tr>
                        <td><strong><font color="#FF0000"></font><?php echo $currentappname; ?> <?php _e('Realm:','miniorange-login-with-eve-online-google-facebook'); ?></strong>
                        </td>
                        <td><input <?php if($valid_discovery == 'invalid') echo 'style="border-color:red;"'?> class="mo_table_textbox" type="text" name="mo_oauth_provider_realm" value="<?php echo $currentapp['realm']; ?>">&nbsp;&nbsp;&nbsp;<?php if($valid_discovery == 'valid'){echo $is_valid; } else echo $is_invalid; ?></td>
                    </tr>
                    <?php
                }
            }

			    if(!isset($refapp->discovery) || $refapp->discovery =="" || !get_option('mo_existing_app_flow')) { 
			    	if($refapp->type == 'oauth1'){	?>
			    		<tr  id="mo_oauth_requesturl_div">
					<td><strong><font color="#FF0000">*</font><?php _e('Request Endpoint:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_requesturl" name="mo_oauth_requesturl" value="<?php echo esc_attr($currentapp['requesturl']);?>"></td>
				</tr>
			<?php }?>
				<tr  id="mo_oauth_authorizeurl_div">
					<td><strong><font color="#FF0000">*</font><?php _e('Authorize Endpoint:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="<?php echo esc_attr($currentapp['authorizeurl']);?>"></td>
				</tr>
				<tr id="mo_oauth_accesstokenurl_div">
					<td><strong><font color="#FF0000">*</font><?php _e('Access Token Endpoint:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="<?php echo esc_attr($currentapp['accesstokenurl']);?>"></td>
				</tr>
				<?php if( isset($currentapp['apptype']) && $currentapp['apptype'] != 'openidconnect') {
						$oidc = false;
					} else {
						$oidc = true;
					}
					?>
				<tr id="mo_oauth_resourceownerdetailsurl_div">
					<td><strong><?php if($oidc === false) { echo '<font color="#FF0000">*</font>'; } ?><?php _e('Get User Info Endpoint:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
					<td><input class="mo_table_textbox" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" <?php if($oidc === false) { echo 'required';} ?> value="<?php if(isset($currentapp['resourceownerdetailsurl'])) { echo esc_attr($currentapp['resourceownerdetailsurl']); } ?>"></td>
				</tr>
                <?php } if($refapp->type != 'oauth1'){ ?>

                <tr>
                    <td><strong><?php _e('Send client credentials in:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
                    <td><div style="padding:5px;"></div><input type="checkbox" class="mo_table_textbox" name="mo_oauth_authorization_header" <?php if(isset($currentapp['send_headers'])){if($currentapp['send_headers'] == 1){ echo 'checked';}}else {echo 'checked';}?> value="1"> <?php _e('Header','miniorange-login-with-eve-online-google-facebook'); ?><span style="padding:0px 0px 0px 8px;"></span><input type="checkbox" class="mo_table_textbox" name="mo_oauth_body"<?php if(isset($currentapp['send_body'])){if($currentapp['send_body'] == 1){ echo 'checked';}}else {echo 'checked';}?> value="1"> <?php _e('Body','miniorange-login-with-eve-online-google-facebook'); ?><div style="padding:5px;"></div></td>
                </tr>
                <tr>
				<td><strong><?php _e('State Parameter :','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
				<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_state" value ="1" <?php if(isset($currentapp['send_state'])){if($currentapp['send_state'] == 1){ echo 'checked';}}else {echo 'checked';} ?>/><?php _e('Send state parameter','miniorange-login-with-eve-online-google-facebook'); ?></td>
				<td><br></td>
			</tr>
			<tr>
				<td><strong><?php _e('Group User Info Endpoint:','miniorange-login-with-eve-online-google-facebook'); ?></strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[PREMIUM]</a></small></font></td>
				<td><input class="mo_table_textbox" type="text" value="" disabled></td>
			</tr>
			<tr>
				<td><strong><?php _e('JWKS URL:','miniorange-login-with-eve-online-google-facebook'); ?></strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[PREMIUM]</a></small></font></td>
				<td><input class="mo_table_textbox" type="text" value="" disabled></td>
			</tr>
			<?php } ?>
			<tr>
				<td><br></td>
				<td><br></td>
			</tr>
			<tr>
				<tr>
				<td><strong><?php _e('Login Button:','miniorange-login-with-eve-online-google-facebook'); ?></strong></td>
				<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_show_on_login_page" value ="1" <?php if(isset($currentapp['show_on_login_page'])) { if($currentapp['show_on_login_page'] === 1 ) echo 'checked'; } ; ?>/><?php _e('Show on login page','miniorange-login-with-eve-online-google-facebook'); ?></td>
			</tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="<?php _e('Save settings','miniorange-login-with-eve-online-google-facebook'); ?>" class="button button-primary button-large" />
					<!-- <?php if($is_other_app){?> -->
						<input id="mo_oauth_test_configuration" type="button" name="button" value="<?php _e('Test Configuration','miniorange-login-with-eve-online-google-facebook'); ?>" class="button button-primary button-large" onclick="testConfiguration()" />
					<!-- <?php } ?> -->
				</td>
			</tr>
			<tr>
				<td><strong>Note:</strong></td>
				<td colspan="2">
					<b><?php _e('Please configure','miniorange-login-with-eve-online-google-facebook'); ?> <a id="mo_oauth_attr_map" href='<?php echo admin_url( "admin.php?page=mo_oauth_settings&tab=attributemapping" ); ?>'><?php _e('Attribute Mapping','miniorange-login-with-eve-online-google-facebook'); ?></a> <?php _e('before trying Single Sign-On.','miniorange-login-with-eve-online-google-facebook'); ?></b>
				</td>
			</tr>
		</table>
		</form>
		</div>
		</div>
		<?php if($is_other_app){ ?>
		<script>
		function proceedToAttributeMapping() {
			var link = jQuery("#mo_oauth_attr_map").attr("href");
			window.location.href = link;
		}

		function testConfiguration(){
			var mo_oauth_app_name = jQuery("#mo_oauth_app_nameid").val();
			var myWindow = window.open('<?php echo site_url(); ?>' + '/?option=testattrmappingconfig&app='+mo_oauth_app_name, "Test Attribute Configuration", "width=600, height=600");
			try {
				while(1) {
					if(myWindow.closed()) {
						$(document).trigger("config_tested");
						break;
					} else {continue;}
				}
			} catch(err) {
				console.error(err);
			}
		}

		function showClientSecret(){
			var field = document.getElementById("mo_oauth_client_secret");
			var show_button = document.getElementById("show_button");
			if(field.type == "password"){
				field.type = "text";
				show_button.className = "fa fa-eye-slash";
			}
			else{
				field.type = "password";
				show_button.className = "fa fa-eye";
			}
		}
		</script>
		<?php }
		mo_oauth_client_grant_type_settings();
}
