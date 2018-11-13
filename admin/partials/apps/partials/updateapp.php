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
		<div id="mo_oauth_update_app">
			
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<input type="hidden" name="option" value="mo_oauth_add_app" />
		<table class="mo_settings_table">
			<tr>
			<td><strong><font color="#FF0000">*</font>Application:</strong></td>
			<td>
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_app_name" value="<?php echo $currentappname;?>">
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">
				<input type="hidden" name="mo_oauth_app_type" value="<?php echo $currentapp['apptype'];?>">
				<?php echo $currentappname;?><br><br>
			</td>
			</tr>
			<tr id="mo_oauth_display_app_name_div">
				<td><strong>Display App Name:</strong><br>&emsp;<font color="#FF0000"><small>[STANDARD]</small></font></td>
				<td><input disabled class="mo_table_textbox" type="text"></td>
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
			<?php if( isset($currentapp['apptype']) && $currentapp['apptype'] != 'openidconnect') { 
					$oidc = false;
				} else {
					$oidc = true;
				}
				?>
				<tr id="mo_oauth_resourceownerdetailsurl_div">
					<td><strong><?php if($oidc === false) { echo '<font color="#FF0000">*</font>'; } ?>Get User Info Endpoint:</strong></td>
					<td><input class="mo_table_textbox" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" <?php if($oidc === false) { echo 'required';} ?> value="<?php echo $currentapp['resourceownerdetailsurl'];?>"></td>
				</tr>
			<tr><td></td><td><input class="mo_table_textbox" type="checkbox" name="disable_authorization_header" id="disable_authorization_header" <?php (checked( get_option('mo_oauth_client_disable_authorization_header') == true ));?> > (Check if does not require Authorization Header)</td></tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save settings" class="button button-primary button-large" />
					<!-- <?php if($is_other_app){?> -->
						<input id="mo_oauth_test_configuration" type="button" name="button" value="Test Configuration" class="button button-primary button-large" onclick="testConfiguration()" />
					<!-- <?php } ?> -->
				</td>
			</tr>
		</table>
		</form>
		</div>
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
				<input type="text" placeholder="Enter attribute name for Last Name" style="width: 350px;" disabled /></td>
		  </tr>
		  <tr>
			<td><strong>Username:</strong></td>
			<td><input type="text" placeholder="Enter attribute name for Username" style="width: 350px;" value="" disabled /></td>
		  </tr>
		  <tr>
			<td><strong>Group/Role:</strong></td>
			<td><input type="text" placeholder="Enter attribute name for Group/Role" style="width: 350px;" value="" disabled /></td>
		  </tr>
		  <tr>
			<td><strong>Display Name:</strong></td>
			<td>
				<select disabled style="background-color: #eee;">
					<option>FirstName</option>
				</select>
			</td></tr>
			<tr><td colspan="2">
			<h3>Map Custom Attributes</h3>Map extra OAuth Provider attributes which you wish to be included in the user profile below
			</td><td><input disabled type="button" value="+" class="button button-primary"  /></td>
			<td><input disabled type="button" class="button button-primary"   /></td></tr>
			<tr class="rows"><td><input disabled type="text" placeholder="Enter field meta name" /></td>
			<td><input disabled type="text" placeholder="Enter attribute name from OAuth Provider" style="width:74%;" /></td>
			</tr>';
			?>
			</table>
			<br>
			<input type="submit" name="submit" value="Save settings"
					class="button button-primary button-large" />
			
		</form>
		</div>

		<div class="mo_table_layout" id="role-mapping">
		<h3>Role Mapping (Optional)</h3>
		<p>Role mapping is available in <a href="admin.php?page=mo_oauth_settings&amp;tab=licensing"><b>premium</b></a> version.</p>
		<b>NOTE: </b>Role will be assigned only to non-admin users (user that do NOT have Administrator privileges). You will have to manually change the role of Administrator users.<br>
		<form id="role_mapping_form" name="f" method="post" action="">
		<input disabled class="mo_table_textbox" required="" type="hidden"  name="mo_oauth_app_name" value="<?php echo $currentappname;?>">
		<input disabled  type="hidden" name="option" value="mo_oauth_client_save_role_mapping" />
		
		<p><input disabled type="checkbox"/><strong> Keep existing user roles</strong><br><small>Role mapping won't apply to existing wordpress users.</small></p>
		<p><input disabled type="checkbox" > <strong> Do Not allow login if roles are not mapped here </strong></p><small>We won't allow users to login if we don't find users role/group mapped below.</small></p>

		<div id="panel1">
			<table class="mo_oauth_client_mapping_table" id="mo_oauth_client_role_mapping_table" style="width:90%">
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td><font style="font-size:13px;font-weight:bold;">Default Role </font>
					</td>
					<td>
						<select disabled style="width:100%">
						   <option>Subscriber</option>
						</select>
						
					</td>
				</tr>
				<tr>
					<td colspan=2><i> Default role will be assigned to all users for which mapping is not specified.</i></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td style="width:50%"><b><?php if($is_eveonline) echo 'Eve Online Corporation Name'; else echo 'Group Attribute Value';?></b></td>
					<td style="width:50%"><b>WordPress Role</b></td>
				</tr>
				
				<tr>
					<td><input disabled class="mo_oauth_client_table_textbox" type="text" placeholder="group name" />
					</td>
					<td>
						<select disabled style="width:100%"  >
							<option>Subscriber</option>
						</select>
					</td>
				</tr>
				</table>
				<table class="mo_oauth_client_mapping_table" style="width:90%;">
					<tr><td><a style="cursor:pointer">Add More Mapping</a><br><br></td><td>&nbsp;</td></tr>
					<tr>
						<td><input disabled type="submit" class="button button-primary button-large" value="Save Mapping" /></td>
						<td>&nbsp;</td>
					</tr>
				</table>
				</div>
			</form>
		</div>
				
				
		<script>
		function testConfiguration(){
			var mo_oauth_app_name = jQuery("#mo_oauth_app_name").val();
			var myWindow = window.open('<?php echo site_url(); ?>' + '/?option=testattrmappingconfig&app='+mo_oauth_app_name, "Test Attribute Configuration", "width=600, height=600");
			while(1) {
				if(myWindow.closed()) {
					$(document).trigger("config_tested");
					break;
				} else {continue;}
			}
		}
		</script>
		<?php }
}
