<?php

	function update_app_page($appname){

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
			<tr><td><strong>Redirect / Callback URL</strong></td>
			<td><input class="mo_table_textbox"  type="text" readonly="true" value='<?php if($currentappname != 'eveonline'){ echo $currentapp['redirecturi']; } else { echo "https://auth.miniorange.com/moas/oauth/client/callback";} ?>'></td>
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
			<?php if( isset($currentapp['apptype']) && $currentapp['apptype'] != 'openidconnect') { ?>
				<tr id="mo_oauth_resourceownerdetailsurl_div">
					<td><strong><font color="#FF0000">*</font>Get User Info Endpoint:</strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value="<?php echo $currentapp['resourceownerdetailsurl'];?>"></td>
				</tr>
			<?php } ?>
			<tr><td></td><td><input class="mo_table_textbox" type="checkbox" name="disable_authorization_header" id="disable_authorization_header" <?php (checked( get_option('mo_oauth_client_disable_authorization_header') == true ));?> > (Check if does not require Authorization Header)</td></tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save settings" class="button button-primary button-large" />
					<!-- <?php if($is_other_app){?> -->
						<input type="button" name="button" value="Test Configuration" class="button button-primary button-large" onclick="testConfiguration()" />
					<!-- <?php } ?> -->
				</td>
			</tr>
		</table>
		</form>
		</div>

		<?php if($is_other_app){ ?>
		<div class="mo_table_layout" id="attribute-mapping">
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<h3>Attribute Mapping</h3>
		<p style="font-size:13px;color:#dc2424">Do <b>Test Configuration</b> above to get configuration for attribute mapping.<br></p>
		<input type="hidden" name="option" value="mo_oauth_attribute_mapping" />
		<input class="mo_table_textbox" required="" type="hidden" id="mo_oauth_app_name" name="mo_oauth_app_name" value="<?php echo $currentappname;?>">
		<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">
		<table class="mo_settings_table">
			<tr id="mo_oauth_email_attr_div">
				<td><strong><font color="#FF0000">*</font>Email:</strong></td>
				<td><input class="mo_table_textbox" required="" placeholder="Enter attribute name for Email" type="text" id="mo_oauth_email_attr" name="mo_oauth_email_attr" value="<?php if(isset( $currentapp['email_attr']))echo $currentapp['email_attr'];?>"></td>
			</tr>
			<tr id="mo_oauth_name_attr_div">
				<td><strong><font color="#FF0000">*</font>First Name:</strong></td>
				<td><input class="mo_table_textbox" required="" placeholder="Enter attribute name for First Name" type="text" id="mo_oauth_name_attr" name="mo_oauth_name_attr" value="<?php if(isset( $currentapp['name_attr'])) echo $currentapp['name_attr'];?>"></td>
			</tr>
			
			
		<?php
		echo '<tr>
			<td><strong>Last Name:</strong></td>
			<td>
				<p>Advanced attribute mapping is available in <a href="admin.php?page=mo_oauth_settings&amp;tab=licensing"><b>premium</b></a> version.</p>
				<input type="text" name="oauth_client_am_last_name" placeholder="Enter attribute name for Last Name" style="width: 350px;" value="" readonly /></td>
		  </tr>
		  <tr>
			<td><strong>Username:</strong></td>
			<td><input type="text" name="oauth_client_am_group_name" placeholder="Enter attribute name for Username" style="width: 350px;" value="" readonly /></td>
		  </tr>
		  <tr>
			<td><strong>Group/Role:</strong></td>
			<td><input type="text" name="oauth_client_am_group_name" placeholder="Enter attribute name for Group/Role" style="width: 350px;" value="" readonly /></td>
		  </tr>
		  <tr>
			<td><strong>Display Name:</strong></td>
			<td>
				<select name="oauth_client_am_display_name" id="oauth_client_am_display_name" disabled style="background-color: #eee;">
					<option value="USERNAME"';
					if(get_option('oauth_client_am_display_name') == 'USERNAME') { echo 'selected="selected"' ; }
					echo '>Username</option>
					<option value="FNAME"';
					if(get_option('oauth_client_am_display_name') == 'FNAME') { echo 'selected="selected"' ; }
					echo '>FirstName</option>
					<option value="LNAME"';
					if(get_option('oauth_client_am_display_name') == 'LNAME') { echo 'selected="selected"' ; }
					echo '>LastName</option>
					<option value="FNAME_LNAME"';
					if(get_option('oauth_client_am_display_name') == 'FNAME_LNAME') {
					echo 'selected="selected"' ;}
					echo '>FirstName LastName</option>
					<option value="LNAME_FNAME"';
					if(get_option('oauth_client_am_display_name') == 'LNAME_FNAME') { echo 'selected="selected"' ; }
					echo '>LastName FirstName</option>
				</select>
			</td></tr>';?>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
			</table>
		</form>
		</div>

		<div class="mo_table_layout" id="role-mapping">
		<h3>Role Mapping (Optional)</h3>
		<p>Role mapping is available in <a href="admin.php?page=mo_oauth_settings&amp;tab=licensing"><b>premium</b></a> version.</p>
		<table width="100%">
			<tr><td colspan="2"><b>NOTE: </b>Role will be assigned only to non-admin users (user that do NOT have Administrator privileges). You will have to manually change the role of Administrator users.<br><br></td></tr>
			<tr><td colspan="2"><input disabled type="checkbox" id="dont_create_user_if_role_not_mapped" name="mo_oauth_client_dont_create_user_if_role_not_mapped" value="checked">&nbsp;&nbsp;Do not auto create users if roles are not mapped here.<br></td></tr>
			<tr><td colspan="2"><input disabled type="checkbox" id="dont_allow_unlisted_user_role" name="oauth_client_am_dont_allow_unlisted_user_role" value="checked">&nbsp;&nbsp;Do not assign role to unlisted users.<br></td></tr>
			<tr><td colspan="2"><input disabled type="checkbox" id="dont_update_existing_user_role" name="mo_oauth_client_dont_update_existing_user_role" value="checked">&nbsp;&nbsp;Do not update existing user's roles.<br><br></td></tr>
			<tr>
				<td><b>Default Role:</b></td>
				<td><select disabled id="oauth_client_am_default_user_role" name="oauth_client_am_default_user_role" style="width:150px;">
	<option selected="selected" value="subscriber">Subscriber</option>
	<option value="contributor">Contributor</option>
	<option value="author">Author</option>
	<option value="editor">Editor</option>
	<option value="administrator">Administrator</option>	
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<i>Select the default role to assign to Users.</i>
	</td>
	</tr><tr><td><b>Administrator</b></td><td><input readonly type="text" name="oauth_client_am_group_attr_values_administrator" value="" placeholder="Semi-colon(;) separated Group/Role value for Administrator" style="width: 400px;"></td></tr><tr><td><b>Editor</b></td><td><input readonly type="text" name="oauth_client_am_group_attr_values_editor" value="" placeholder="Semi-colon(;) separated Group/Role value for Editor" style="width: 400px;"></td></tr><tr><td><b>Author</b></td><td><input readonly type="text" name="oauth_client_am_group_attr_values_author" value="" placeholder="Semi-colon(;) separated Group/Role value for Author" style="width: 400px;"></td></tr><tr><td><b>Contributor</b></td><td><input readonly type="text" name="oauth_client_am_group_attr_values_contributor" value="" placeholder="Semi-colon(;) separated Group/Role value for Contributor" style="width: 400px;"></td></tr><tr><td><b>Subscriber</b></td><td><input readonly type="text" name="oauth_client_am_group_attr_values_subscriber" value="" placeholder="Semi-colon(;) separated Group/Role value for Subscriber" style="width: 400px;"></td></tr><tr>
						<td>&nbsp;</td>
						<td><br><input type="submit" disabled style="width:100px;" name="submit" value="Save" class="button button-primary button-large"> &nbsp;
						<br><br>
						</td>
					</tr>
				</tbody></table>
				
				
		<script>
		function testConfiguration(){
			var mo_oauth_app_name = jQuery("#mo_oauth_app_name").val();
			var myWindow = window.open('<?php echo site_url(); ?>' + '/?option=testattrmappingconfig&app='+mo_oauth_app_name, "Test Attribute Configuration", "width=600, height=600");
		}
		</script>
		<?php }
}
